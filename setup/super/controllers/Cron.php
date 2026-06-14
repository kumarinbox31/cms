<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Restrict to command line execution for security, but allow a secret key if needed for web cron
        if (!is_cli() && $this->input->get('secret') !== 'ab_cron_secret') {
            show_error('Command Line Only');
        }
        
        $this->load->library('HostingSyncService');
        $this->load->database();
    }

    /**
     * Run every 15 Minutes
     * Checks: DNS, Addon status, Missing domains
     */
    public function domain_status() {
        echo "Starting Domain Status Cron...\n";
        
        // Log sync start
        $this->db->insert('ab_sync_history', [
            'type' => 'domain',
            'start_time' => date('Y-m-d H:i:s'),
            'status' => 'Running'
        ]);
        $sync_id = $this->db->insert_id();

        $batch_size = env('DOMAIN_CHECK_BATCH_SIZE', 100);
        // Only check domains that haven't been checked in the last 15 mins
        $fifteenMinsAgo = date('Y-m-d H:i:s', strtotime('-15 minutes'));
        
        $this->db->where('last_checked <', $fifteenMinsAgo);
        $this->db->or_where('last_checked IS NULL');
        $this->db->limit($batch_size);
        $websites = $this->db->get('ab_websites')->result();

        $count = 0;
        foreach($websites as $w) {
            $this->hostingsyncservice->syncWebsiteDomainStatus($w->id);
            $count++;
        }

        // Log end
        $this->db->where('id', $sync_id)->update('ab_sync_history', [
            'end_time' => date('Y-m-d H:i:s'),
            'status' => 'Completed',
            'items_synced' => $count
        ]);

        echo "Completed. Synced $count domains.\n";
    }

    /**
     * Run every 1 Hour
     * Checks: Email accounts, Quotas, Usage
     */
    public function email_sync() {
        echo "Starting Email Sync Cron...\n";

        $this->db->insert('ab_sync_history', [
            'type' => 'email',
            'start_time' => date('Y-m-d H:i:s'),
            'status' => 'Running'
        ]);
        $sync_id = $this->db->insert_id();

        $batch_size = env('EMAIL_SYNC_BATCH_SIZE', 100);
        
        // Get active websites
        $this->db->where('status', '1');
        $this->db->limit($batch_size);
        $websites = $this->db->get('ab_websites')->result();

        $emails_synced = 0;
        foreach($websites as $w) {
            $synced = $this->hostingsyncservice->syncWebsiteEmails($w->id);
            if ($synced !== false) {
                $emails_synced += $synced;
            }
        }

        $this->db->where('id', $sync_id)->update('ab_sync_history', [
            'end_time' => date('Y-m-d H:i:s'),
            'status' => 'Completed',
            'items_synced' => $emails_synced
        ]);

        echo "Completed. Synced $emails_synced email accounts.\n";
    }

    /**
     * Run Daily at 2 AM
     * Checks: Orphan domains, emails, cleanup reports, health score recalculation
     */
    public function full_audit() {
        echo "Starting Full Audit Cron...\n";

        $this->db->insert('ab_sync_history', [
            'type' => 'full',
            'start_time' => date('Y-m-d H:i:s'),
            'status' => 'Running'
        ]);
        $sync_id = $this->db->insert_id();

        // 1. Find Orphan Domains
        $orphans = $this->hostingsyncservice->findOrphanDomains();
        foreach($orphans as $orphan) {
            // Check if it already exists in cleanup logs so we don't spam
            $existing = $this->db->get_where('ab_cleanup_logs', [
                'type' => 'orphan_domain',
                'entity' => $orphan,
                'action_taken' => 'Detected'
            ])->row();
            
            if (!$existing) {
                $this->db->insert('ab_cleanup_logs', [
                    'type' => 'orphan_domain',
                    'entity' => $orphan,
                    'action_taken' => 'Detected',
                    'details' => 'Found during daily full audit'
                ]);
            }
        }

        // 2. Recalculate Health Scores for all websites
        $websites = $this->db->get('ab_websites')->result();
        foreach($websites as $w) {
            $this->hostingsyncservice->recalculateHealthScore($w->id);
        }

        $this->db->where('id', $sync_id)->update('ab_sync_history', [
            'end_time' => date('Y-m-d H:i:s'),
            'status' => 'Completed',
            'items_synced' => count($websites),
            'log' => count($orphans) . " orphans detected."
        ]);

        echo "Completed Full Audit.\n";
    }
}
