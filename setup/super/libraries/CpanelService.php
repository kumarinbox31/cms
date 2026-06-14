<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CpanelService {
    
    private $host;
    private $port;
    private $username;
    private $token;
    private $protocol;

    public function __construct() {
        // Assume env() is globally available from config.php
        $this->host = env('CPANEL_HOST');
        $this->port = env('CPANEL_PORT', '2083');
        $this->username = env('CPANEL_USERNAME');
        $this->token = env('CPANEL_API_TOKEN');
        $this->protocol = env('CPANEL_SSL', true) ? 'https' : 'http';
    }

    private function request($module, $function, $params = []) {
        if (!$this->host || !$this->username || !$this->token) {
            return ['status' => false, 'error' => 'cPanel API credentials missing in .env'];
        }

        $query = http_build_query($params);
        $url = "{$this->protocol}://{$this->host}:{$this->port}/execute/{$module}/{$function}?{$query}";

        $header[0] = "Authorization: cpanel {$this->username}:{$this->token}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['status' => false, 'error' => 'cURL Error: ' . $error];
        }

        $result = json_decode($response, true);
        if (isset($result['errors']) && $result['errors'] !== null) {
            return ['status' => false, 'error' => implode(', ', $result['errors'])];
        }

        return ['status' => true, 'data' => $result['data'] ?? []];
    }

    // --- Domain Management ---

    public function listAddonDomains() {
        $res = $this->request('AddonDomain', 'listaddondomains');
        if (!$res['status']) return $res;
        
        return ['status' => true, 'data' => $res['data']];
    }

    public function addonExists($domain) {
        $domains = $this->listAddonDomains();
        if (!$domains['status']) return false;

        foreach ($domains['data'] as $d) {
            if (isset($d['domain']) && $d['domain'] === $domain) {
                return true;
            }
        }
        return false;
    }

    public function addAddonDomain($domain, $subdomain = null, $documentRoot = null) {
        if (!$subdomain) {
            $parts = explode('.', $domain);
            $subdomain = $parts[0];
        }
        if (!$documentRoot) {
            $documentRoot = "public_html/{$domain}";
        }
        
        return $this->request('AddonDomain', 'addaddondomain', [
            'dir' => $documentRoot,
            'newdomain' => $domain,
            'subdomain' => $subdomain
        ]);
    }

    public function deleteAddonDomain($domain, $subdomain) {
        return $this->request('AddonDomain', 'deladdondomain', [
            'domain' => $domain,
            'subdomain' => $subdomain
        ]);
    }

    // --- Subdomain Management ---

    public function listSubdomains() {
        return $this->request('SubDomain', 'listsubdomains');
    }

    public function addSubdomain($domain, $rootDomain, $documentRoot = null) {
        if (!$documentRoot) {
            $documentRoot = "public_html/{$domain}";
        }
        return $this->request('SubDomain', 'addsubdomain', [
            'domain' => $domain,
            'rootdomain' => $rootDomain,
            'dir' => $documentRoot
        ]);
    }

    public function deleteSubdomain($domain) {
        return $this->request('SubDomain', 'delsubdomain', [
            'domain' => $domain
        ]);
    }

    // --- Email Management ---

    public function listEmails($domain = null) {
        $params = [];
        if ($domain) {
            $params['domain'] = $domain;
        }
        return $this->request('Email', 'list_pops_with_disk', $params);
    }

    public function emailExists($email) {
        list($user, $domain) = explode('@', $email);
        $emails = $this->listEmails($domain);
        if (!$emails['status']) return false;

        foreach ($emails['data'] as $e) {
            if ($e['email'] === $email) {
                return true;
            }
        }
        return false;
    }

    public function createEmail($email, $password, $quota = 0) {
        list($user, $domain) = explode('@', $email);
        return $this->request('Email', 'add_pop', [
            'email' => $user,
            'password' => $password,
            'domain' => $domain,
            'quota' => $quota
        ]);
    }

    public function updateEmailPassword($email, $password) {
        list($user, $domain) = explode('@', $email);
        return $this->request('Email', 'passwd_pop', [
            'email' => $user,
            'password' => $password,
            'domain' => $domain
        ]);
    }

    public function updateEmailQuota($email, $quota) {
        list($user, $domain) = explode('@', $email);
        return $this->request('Email', 'edit_quota', [
            'email' => $user,
            'domain' => $domain,
            'quota' => $quota
        ]);
    }

    public function suspendEmail($email) {
        return $this->request('Email', 'suspend_incoming', [
            'email' => $email
        ]);
    }

    public function unsuspendEmail($email) {
        return $this->request('Email', 'unsuspend_incoming', [
            'email' => $email
        ]);
    }

    public function deleteEmail($email) {
        list($user, $domain) = explode('@', $email);
        return $this->request('Email', 'delete_pop', [
            'email' => $user,
            'domain' => $domain
        ]);
    }
}
