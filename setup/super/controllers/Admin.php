<?php
class Admin extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('website');
        $this->load->model('BlockModel');
        $this->load->model('PlanModel');
        if(!$this->session->has_userdata('super-admin')){
            redirect('admin-login');
        }
        $this->load->library('form_validation');

    }
    public function change_status(){
        $id = intval($_GET['id']);
        $data = ['status'=>intval($_GET['new_status'])];
        $this->website->update(['id'=>$id],$data);
        $this->session->set_flashdata('success_msg','Saved successfully.');
        redirect('admin/website');
    }
    public function backup_both_databases()
    {
        $this->load->helper(['file', 'download']);
    
        // Backup Default DB
        $this->load->dbutil(); // Uses default DB
        $backup1 = $this->dbutil->backup([
            'format' => 'zip',
            'filename' => 'main_db_backup.sql'
        ]);
        $filename1 = 'main_db_backup_' . date('Y-m-d_H-i-s') . '.zip';
        write_file(FCPATH . 'backups/' . $filename1, $backup1);
    
        // Backup Second DB
        $this->second_db = $this->load->database('second_db', TRUE);
        $this->load->dbutil($this->second_db);
        $dbutil2 = $this->load->dbutil($this->second_db);
        $backup2 = $dbutil2->backup([
            'format' => 'zip',
            'filename' => 'second_db_backup.sql'
        ]);
        $filename2 = 'second_db_backup_' . date('Y-m-d_H-i-s') . '.zip';
        write_file(FCPATH . 'backups/' . $filename2, $backup2);
    
        // Optional: Download first file
        force_download($filename1, $backup1);
    
        // Optional: Just output confirmation
        // echo "Backups created: $filename1, $filename2";
    }


    
    function index(){
        $this->load->view('admin/header');
        $this->load->view('admin/home');
        $this->load->view('admin/footer');
    }
    function delete_wizard() {
        if (!isset($_GET['id'])) redirect('admin/website');
        $this->_render('website/delete_wizard');
    }

    function execute_delete_website() {
        if ($post = $this->input->post()) {
            $wid = intval($post['wid']);
            $w = $this->website->get(['id'=>$wid])->row();
            if (!$w) redirect('admin/website');

            $this->load->library('CpanelService');

            // 1. Remove Addon
            if (isset($post['remove_addon']) && $w->addon_status === 'Added') {
                $this->cpanelservice->deleteAddonDomain($w->domain, explode('.', $w->domain)[0]);
            }
            // 2. Remove Subdomains (Placeholder, assumes matching subdomains)
            if (isset($post['remove_subdomains'])) {
                // ... fetch & delete subdomains logic
            }
            // 3. Remove Emails
            if (isset($post['remove_emails'])) {
                $emails = $this->db->get_where('ab_email_accounts', ['website_id' => $wid])->result();
                foreach($emails as $e) {
                    $this->cpanelservice->deleteEmail($e->email_address);
                }
                $this->db->where('website_id', $wid)->delete('ab_email_accounts');
            }

            // 4. Record Only / Final cleanup
            if (isset($post['remove_record'])) {
                $deleteDir = isset($post['remove_dir']);
                $this->website->delete_website($wid, $deleteDir);
            }

            $this->session->set_flashdata('success_msg', 'Website cleanup executed successfully.');
            redirect('admin/website');
        }
    }
    function theme($page='index'){
        $this->_render('theme/'.$page);
    }
    function load_templates(){
        if($post = $this->input->post()){
            $id = intval($post['id']);
            $path = htmlspecialchars($post['path']);
            $html = '<table class="table table bordered table-striped">
                <thead> 
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Block Id</th>
                        <th>Label</th>
                        <th>Media</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
            ';
            $i = 1;
            $get = $this->BlockModel->get(['theme_id'=>$id]);
            foreach($get->result() as $row){
                $html .= '<tr>
                    <td>'.$i++.'</td>
                    <td>'.$row->category_id.'</td>
                    <td>'.$row->blockid.'</td>
                    <td>'.$row->label.'</td>
                    <td>'.$row->media.'</td>
                    <td>'.$row->status.'</td>
                    <td>
                        <a href="'.base_url('admin/theme/view-template?blockid=').$row->id.'&path='.$path.'" class="btn btn-sm btn-primary" >View</a>
                    </td>
                </tr>';
            }
            $html .= '</tbody></table>';
            echo $html;
        }
    }

    function create_website(){
        if($post = $this->input->post()){
            $name = htmlspecialchars($post['name']);
            $email = htmlspecialchars($post['email']);
            $password = htmlspecialchars($post['password']);
            $domain = cleanDomain(htmlspecialchars($post['domain']));
            $address = htmlspecialchars($post['address']);
            $mobile = intval($post['mobile']);
            $wid = intval($post['wid']);
            $planid = isset($post['planid']) ? intval($post['planid']) : 0;
            $start_time = time();
            $plan_years = isset($post['plan_years']) ? intval($post['plan_years']) : 0;
            
            if ($planid <= 0 || $plan_years <= 0) {
                $this->session->set_flashdata('error_msg', 'Please select a valid Plan and Plan Duration.');
                redirect(base_url('admin/website/create'));
                return;
            }
            
            $end_time = strtotime("+$plan_years year", $start_time);
            
            $parts = explode('.', $domain);
            $domain_type = (count($parts) > 2) ? 'subdomain' : 'domain';
            
            $data = [
                'name' => $name,
                '_email' => $email,
                'mobile' => $mobile,
                'address' => $address,
                '_pass' => $password,
                'domain' => $domain,
                'domain_type' => $domain_type,
                'addon_status' => 'Pending', // Will be created by Cron
                'start_time' => $start_time,
                'end_time' => $end_time,
                'rid'=>RID,
                'planid' => $planid
            ];
            $this->website->create($data,$wid);
            $this->session->set_flashdata('success_msg','Website Created successfully.');
            redirect(base_url('admin/website'));
        }
    }
    /*
    public function create_website()
    {
        // Load the form validation library if not autoloaded
        $this->load->library('form_validation');
    
        // Set validation rules
        $this->form_validation->set_rules('name', 'Client Name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('domain', 'Domain', 'required|trim|callback_domain_check');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('planid', 'Plan', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('plan_years', 'Plan Years', 'required|numeric|greater_than[0]');
    
        if ($this->form_validation->run() == FALSE) {
            // Reload the form with error messages
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect(base_url('admin/website/create')); // Adjust form URL as needed
        } else {
            $post = $this->input->post();
            $name = htmlspecialchars($post['name']);
            $email = htmlspecialchars($post['email']);
            $password = htmlspecialchars($post['password']);
            $domain = cleanDomain(htmlspecialchars($post['domain']));
            $address = htmlspecialchars($post['address']);
            $mobile = intval($post['mobile']);
            $wid = intval($post['wid']);
            $planid = intval($post['planid']);
            $plan_years = intval($post['plan_years']);
    
            $start_time = time();
            $end_time = strtotime("+$plan_years year", $start_time);
    
            $data = [
                'name' => $name,
                '_email' => $email,
                'mobile' => $mobile,
                'address' => $address,
                '_pass' => password_hash($password, PASSWORD_BCRYPT), // hash for security
                'domain' => $domain,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'rid' => RID,
                'planid' => $planid
            ];
    
            $this->website->create($data, $wid);
            $this->session->set_flashdata('success_msg', 'Website created successfully.');
            redirect(base_url('admin/website'));
        }
    }
        */
    public function domain_check($domain)
    {
        // Simple check for valid domain format
        if (!preg_match("/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $domain)) {
            $this->form_validation->set_message('domain_check', 'The {field} format is not valid.');
            return false;
        }
    
        // Optionally check if domain already exists in DB
        $exists = $this->website->checkDomainExists($domain);
        if ($exists) {
            $this->form_validation->set_message('domain_check', 'This domain is already registered.');
            return false;
        }
    
        return true;
    }
    public function checkDomainExists($domain)
    {
        return $this->db->where('domain', $domain)->count_all_results('websites') > 0;
    }

    public function test_sync($id) {
        $this->load->library('HostingSyncService');
        $this->load->library('CpanelService');
        
        echo "Testing Sync for ID: $id\n";
        $res = $this->hostingsyncservice->syncWebsiteDomainStatus($id);
        echo "Sync Result: " . ($res ? 'Success' : 'Failed') . "\n";
        
        $website = $this->db->get_where('ab_websites', ['id' => $id])->row_array();
        print_r($website);
        
        echo "\nSubdomains:\n";
        $sub = $this->cpanelservice->listSubdomains();
        if ($sub['status']) {
            foreach ($sub['data'] as $s) echo $s['domain'] . "\n";
        }
        
        echo "\nAddons:\n";
        $add = $this->cpanelservice->listAddonDomains();
        if ($add['status']) {
            foreach ($add['data'] as $a) echo $a['domain'] . "\n";
        }
    }

    public function check_domain_preflight() {
        $domain = $this->input->post('domain');
        if (!$domain) {
            echo json_encode(['status' => false, 'message' => 'No domain provided']);
            return;
        }
        $domain = strtolower(trim($domain));
        
        $this->load->library('DomainService');
        $this->load->library('CpanelService');
        
        $inPanel = $this->db->where('domain', $domain)->count_all_results('ab_websites') > 0;
        
        // Is it a subdomain or domain?
        $parts = explode('.', $domain);
        $isSubdomain = count($parts) > 2;

        $inCpanel = false;
        if ($isSubdomain) {
            $subdomains = $this->cpanelservice->listSubdomains();
            if ($subdomains['status']) {
                foreach ($subdomains['data'] as $sub) {
                    if ($sub['domain'] === $domain) {
                        $inCpanel = true; break;
                    }
                }
            }
        } else {
            $inCpanel = $this->cpanelservice->addonExists($domain);
        }

        $dnsResult = $this->domainservice->checkDns($domain, $isSubdomain);

        echo json_encode([
            'status' => true,
            'data' => [
                'inPanel' => $inPanel,
                'inCpanel' => $inCpanel,
                'dnsConnected' => $dnsResult['status']
            ]
        ]);
    }

    function copy_website($wid,$nwid){
        // $this->website->copy_website($wid,$nwid);
    }
    function logout(){
        unset($_SESSION['super-admin']);
        redirect('/');
    }
    
    function website($page='index'){
        if($post = $this->input->post()){
            $action = $post['action'];unset($post['action']);
            switch($action){
                case 'update-website':
                    if(isset($_GET['id'])){
                        $id = intval($_GET['id']);
                        
                        $old_website = $this->db->get_where('ab_websites', ['id' => $id])->row_array();
                        if ($old_website) {
                            $old_domain = $old_website['domain'];
                            $new_domain = cleanDomain(htmlspecialchars($post['domain']));
                            $post['domain'] = $new_domain;
                            
                            if ($old_domain !== $new_domain) {
                                // Domain changed. Delete old from cPanel via Cron?
                                // For now, just mark the domain_type and set addon_status = Pending
                                // The HostingSyncService should detect it's missing and create the new one.
                                // However, deleting the old one is trickier asynchronously. We'll leave it in cPanel for now, 
                                // but we will create the new one via Cron.
                                $new_parts = explode('.', $new_domain);
                                $domain_type = (count($new_parts) > 2) ? 'subdomain' : 'domain';
                                $post['domain_type'] = $domain_type;
                                $post['addon_status'] = 'Pending';
                                
                                // We delete the old domain synchronously if possible, or just let it orphan.
                                // The user said "create newly added website into addon and update their status don't do on create or update on fly"
                                // So we will skip deleting the old one synchronously to avoid timeouts.
                            }
                        }
                        
                        $this->website->update(['id'=>$id],$post);
                        $this->session->set_flashdata('success_msg','Saved successfully.');
                        redirect('admin/website/edit?id='.$id);
                    }else{
                        $this->session->set_flashdata('error_msg','Something went wrong.');
                        redirect(current_url());
                    }
                break;
                default:
                break;
            }
        }else{
            $this->_render('website/'.$page);
        }
    }
    
    function _render($page,$data=[]){
        $this->load->view('admin/header',$data);
        $this->load->view('admin/'.$page);
        $this->load->view('admin/footer');
    }
    
}