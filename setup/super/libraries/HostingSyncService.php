<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HostingSyncService {

    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('CpanelService');
        $this->CI->load->library('DomainService');
        $this->CI->load->database();
    }

    /**
     * Syncs a single website's domain status
     */
    public function syncWebsiteDomainStatus($website_id) {
        $website = $this->CI->db->get_where('ab_websites', ['id' => $website_id])->row_array();
        if (!$website) return false;

        $domain = $website['domain'];
        $isSubdomain = false;
        if (!empty($website['domain_type'])) {
            $isSubdomain = ($website['domain_type'] === 'subdomain');
        } else {
            $parts = explode('.', $domain);
            $isSubdomain = (count($parts) > 2);
        }

        // 1. Check DNS
        $dnsResult = $this->CI->domainservice->checkDns($domain, $isSubdomain);
        $dnsStatus = $dnsResult['status'] ? 'Connected' : 'Pending';
        $lastError = $dnsResult['status'] ? null : $dnsResult['message'];

        // 2. Check Addon Domain if not a main reseller domain or subdomain
        $addonStatus = 'Missing';
        if ($isSubdomain) {
            $subdomains = $this->CI->cpanelservice->listSubdomains();
            if ($subdomains['status']) {
                foreach ($subdomains['data'] as $sub) {
                    if ($sub['domain'] === $domain) {
                        $addonStatus = 'Added';
                        break;
                    }
                }
            } else {
                $lastError = $subdomains['error'];
            }
            
            // Fallback: Check if they manually added this subdomain as an Addon Domain
            if ($addonStatus === 'Missing' && $this->CI->cpanelservice->addonExists($domain)) {
                $addonStatus = 'Added';
            }
            
            // Auto-provision if still missing
            if ($addonStatus === 'Missing' || $website['addon_status'] === 'Pending') {
                $parts = explode('.', $domain);
                $sub = array_shift($parts);
                $rootDomain = implode('.', $parts);
                $res = $this->CI->cpanelservice->addSubdomain($sub, $rootDomain, 'public_html/');
                if ($res['status']) {
                    $addonStatus = 'Added';
                } else {
                    $lastError = 'Auto-Create Failed: ' . $res['error'];
                }
            }
        } else {
            // Assume if it's the main domain it doesn't need to be an addon,
            // but for simplicity, we check if it exists in addon list
            if ($this->CI->cpanelservice->addonExists($domain)) {
                $addonStatus = 'Added';
            }
            
            // Auto-provision if missing
            if ($addonStatus === 'Missing' || $website['addon_status'] === 'Pending') {
                $res = $this->CI->cpanelservice->addAddonDomain($domain, explode('.', $domain)[0], 'public_html/');
                if ($res['status']) {
                    $addonStatus = 'Added';
                } else {
                    $lastError = 'Auto-Create Failed: ' . $res['error'];
                }
            }
        }

        // Update database
        $this->CI->db->where('id', $website_id)->update('ab_websites', [
            'dns_status' => $dnsStatus,
            'addon_status' => $addonStatus,
            'last_checked' => date('Y-m-d H:i:s'),
            'last_error' => $lastError
        ]);

        $this->recalculateHealthScore($website_id);
        
        $this->logAction($website_id, 'Domain Sync', "DNS: $dnsStatus, Addon: $addonStatus");
        return true;
    }

    /**
     * Syncs emails for a website
     */
    public function syncWebsiteEmails($website_id) {
        $website = $this->CI->db->get_where('ab_websites', ['id' => $website_id])->row_array();
        if (!$website) return false;

        $domain = $website['domain'];
        $cpanelEmailsResponse = $this->CI->cpanelservice->listEmails($domain);
        
        if (!$cpanelEmailsResponse['status']) {
            return false;
        }

        $cpanelEmails = $cpanelEmailsResponse['data'];
        $syncedCount = 0;

        foreach ($cpanelEmails as $ce) {
            $fullEmail = $ce['email'];
            $used = $ce['diskused'] ?? 0;
            $quota = $ce['diskquota'] ?? 'unlimited';
            
            $existing = $this->CI->db->get_where('ab_email_accounts', ['email_address' => $fullEmail])->row_array();
            
            if ($existing) {
                $this->CI->db->where('id', $existing['id'])->update('ab_email_accounts', [
                    'used_space' => $used,
                    'quota' => $quota,
                    'last_sync' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->CI->db->insert('ab_email_accounts', [
                    'website_id' => $website_id,
                    'domain' => $domain,
                    'email_address' => $fullEmail,
                    'used_space' => $used,
                    'quota' => $quota,
                    'status' => 'Active',
                    'last_sync' => date('Y-m-d H:i:s')
                ]);
            }
            $syncedCount++;
        }
        
        $this->recalculateHealthScore($website_id);
        return $syncedCount;
    }

    /**
     * Finds orphan domains (in cPanel but not in DB)
     */
    public function findOrphanDomains() {
        $dbDomains = array_column($this->CI->db->select('domain')->get('ab_websites')->result_array(), 'domain');
        $cpanelResponse = $this->CI->cpanelservice->listAddonDomains();
        
        $orphans = [];
        if ($cpanelResponse['status']) {
            foreach ($cpanelResponse['data'] as $addon) {
                if (!in_array($addon['domain'], $dbDomains)) {
                    $orphans[] = $addon['domain'];
                }
            }
        }
        return $orphans;
    }

    /**
     * Recalculates the health score for a website
     */
    public function recalculateHealthScore($website_id) {
        $website = $this->CI->db->get_where('ab_websites', ['id' => $website_id])->row_array();
        if (!$website) return 0;

        $score = 0;
        
        // Check 1: DNS
        if ($website['dns_status'] === 'Connected') $score += 25;
        
        // Check 2: Addon
        if ($website['addon_status'] === 'Added') $score += 25;
        
        // Check 3: Cron Checked Recently (last 24 hours)
        if ($website['last_checked'] && strtotime($website['last_checked']) > strtotime('-24 hours')) {
            $score += 25;
        }

        // Check 4: Status is active
        if ($website['status'] == '1') $score += 25;

        $this->CI->db->where('id', $website_id)->update('ab_websites', ['health_score' => $score]);
        
        $this->CI->db->insert('ab_hosting_audit', [
            'website_id' => $website_id,
            'health_score' => $score,
            'details' => 'Score recalculated automatically'
        ]);

        return $score;
    }

    private function logAction($website_id, $action, $response) {
        $this->CI->db->insert('ab_domain_logs', [
            'user_id' => 0, // System
            'ip_address' => '127.0.0.1',
            'action' => "Website ID {$website_id}: {$action}",
            'response' => $response
        ]);
    }
}
