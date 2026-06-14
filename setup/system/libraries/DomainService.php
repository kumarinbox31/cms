<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DomainService {

    private $mainIp;
    private $nameservers;

    public function __construct() {
        $this->mainIp = env('HOSTING_MAIN_IP', '103.108.220.15');
        
        $this->nameservers = [
            env('HOSTING_NS1', 'sg.solidhosting.pro'),
            env('HOSTING_NS2', 'in.solidhosting.pro'),
            env('HOSTING_NS3', 'us.solidhosting.pro'),
            env('HOSTING_NS4', 'eu.solidhosting.pro')
        ];
        
        // Remove empty nameservers if any
        $this->nameservers = array_filter($this->nameservers);
    }

    /**
     * Checks if a domain's DNS is pointed correctly via Nameservers or A Record
     */
    public function checkDns($domain, $isSubdomain = false) {
        $domain = trim(strtolower($domain));
        
        if ($isSubdomain) {
            return $this->checkSubdomainDns($domain);
        }

        // 1. Check Nameservers
        $nsRecords = @dns_get_record($domain, DNS_NS);
        if ($nsRecords) {
            $matchedNs = 0;
            foreach ($nsRecords as $record) {
                if (in_array($record['target'], $this->nameservers)) {
                    $matchedNs++;
                }
            }
            if ($matchedNs >= 2) { // At least 2 nameservers matched
                return ['status' => true, 'type' => 'NS', 'message' => 'Nameservers connected successfully.'];
            }
        }

        // 2. Check A Record
        $aRecords = @dns_get_record($domain, DNS_A);
        if ($aRecords) {
            foreach ($aRecords as $record) {
                if ($record['ip'] === $this->mainIp) {
                    return ['status' => true, 'type' => 'A', 'message' => 'A Record connected successfully.'];
                }
            }
        }

        return ['status' => false, 'message' => 'DNS not pointed to our servers yet.'];
    }

    /**
     * Checks if a subdomain's DNS is pointed via A Record or CNAME
     */
    public function checkSubdomainDns($subdomain) {
        // Check A Record
        $aRecords = @dns_get_record($subdomain, DNS_A);
        if ($aRecords) {
            foreach ($aRecords as $record) {
                if ($record['ip'] === $this->mainIp) {
                    return ['status' => true, 'type' => 'A', 'message' => 'A Record connected successfully.'];
                }
            }
        }

        // Check CNAME (It might point to the main domain which resolves to our IP)
        $cnameRecords = @dns_get_record($subdomain, DNS_CNAME);
        if ($cnameRecords) {
            foreach ($cnameRecords as $record) {
                // If it points to something, we assume it's valid if the target resolves to our IP, 
                // but for simplicity, we just check if it resolves eventually
                $targetIp = gethostbyname($record['target']);
                if ($targetIp === $this->mainIp) {
                    return ['status' => true, 'type' => 'CNAME', 'message' => 'CNAME connected successfully.'];
                }
            }
        }

        return ['status' => false, 'message' => 'Subdomain DNS not pointed correctly.'];
    }

    /**
     * Generates HTML guide for users to connect their domains
     */
    public function getDnsGuide($domain, $isSubdomain = false) {
        $html = '<div class="dns-guide">';
        
        if ($isSubdomain) {
            $html .= '<h4>Subdomain Connection Guide</h4>';
            $html .= '<p>To connect your subdomain <strong>' . htmlspecialchars($domain) . '</strong>, create an A Record in your main domain\'s DNS settings.</p>';
            $html .= '<table class="table table-bordered">
                        <tr><th>Type</th><th>Name</th><th>Value (IP)</th></tr>
                        <tr><td>A Record</td><td>' . htmlspecialchars(explode('.', $domain)[0]) . '</td><td>' . $this->mainIp . '</td></tr>
                      </table>';
        } else {
            $html .= '<h4>Main Domain Connection Guide</h4>';
            $html .= '<p>To connect your domain <strong>' . htmlspecialchars($domain) . '</strong>, you have two options:</p>';
            
            $html .= '<h5>Option 1: Nameservers (Recommended)</h5>';
            $html .= '<p>Login to your domain registrar and replace your existing nameservers with:</p>';
            $html .= '<ul>';
            foreach ($this->nameservers as $ns) {
                $html .= '<li>' . $ns . '</li>';
            }
            $html .= '</ul>';

            $html .= '<h5>Option 2: A Record</h5>';
            $html .= '<p>If you want to keep your existing nameservers (e.g., using Cloudflare or Google Workspace), create A Records pointing to our server IP:</p>';
            $html .= '<table class="table table-bordered">
                        <tr><th>Type</th><th>Name</th><th>Value (IP)</th></tr>
                        <tr><td>A Record</td><td>@ (Root)</td><td>' . $this->mainIp . '</td></tr>
                        <tr><td>A Record</td><td>www</td><td>' . $this->mainIp . '</td></tr>
                      </table>';
        }
        
        $html .= '<div class="alert alert-info">Note: DNS changes may take up to 24-48 hours to fully propagate worldwide.</div>';
        $html .= '</div>';
        
        return $html;
    }
}
