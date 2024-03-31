<?php
class Admin extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('website');
        $this->load->model('BlockModel');
        if(!$this->session->has_userdata('super-admin')){
            redirect('admin-login');
        }
    }
    
    function index(){
        $this->load->view('admin/header');
        $this->load->view('admin/home');
        $this->load->view('admin/footer');
    }
    function delete_website($wid){
        // $this->website->delete_website($wid);
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
            $start_time = time();
            $end_time = strtotime("+1 year", $start_time);
            $data = [
                'name' => $name,
                '_email' => $email,
                'mobile' => $mobile,
                'address' => $address,
                '_pass' => $password,
                'domain' => $domain,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ];
            $this->website->create($data,$wid);
            $this->session->set_flashdata('success_msg','Website Created successfully.');
            redirect(base_url('admin/website'));
        }
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