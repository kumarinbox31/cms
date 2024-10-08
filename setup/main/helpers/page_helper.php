<?php
$ci = &get_instance(); 

$file = APPPATH."views/includes/".THEMEPATH."/functions.php";
if(file_exists($file)){
    require $file;
}else{
    die('functions.php file not exists in theme folder.');
}


$installedPlugins = $ci->PluginModel->getAllInstalledPlugins(['status' => '1'])->result();
foreach ($installedPlugins as $row) {
    $pluginInfo = $ci->PluginModel->pluginInfo($row->plugin_id)->row();
    $filePath = APPPATH . "views/plugins/{$pluginInfo->path}/";

    if (file_exists($filePath)) {
        // Load hooks if available
        $hooksFilePath = $filePath . 'hooks.php';
        if (file_exists($hooksFilePath)) {
            include $hooksFilePath;
        }

        // Load views
        $ci->load->add_package_path($filePath);
    } else {
        // Log an error or handle accordingly
        log_message('error', "File not found: {$pluginInfo->path}/hooks.php or views not available");
    }
}


function view($data=[]){
    $CI = &get_instance();
    $CI->load->view("includes/".THEMEPATH."/header",$data);
    $CI->load->view("includes/".THEMEPATH."/home");
    $CI->load->view("includes/".THEMEPATH."/footer");
}



function beforeHeadContent($flag=false,$admin=false){
    $get = '';
    $ci = &get_instance();
    $ci->load->model('WebsiteData');
    $wd = $ci->WebsiteData->get(['admin_id'=>CLIENT_ID]);
    // getting meta tags
    if($wd->num_rows()){
        $wd = $wd->row();
        if(!defined('LOGO')) {
            define('LOGO', '');
        }
        $get .= '<meta property="title" content="'.$wd->title.'">
                <meta property="keywords" content="'.$wd->keywords.'">
            	<meta property="og:locale" content="en_GB" />
            	<meta property="og:url" content="'.base_url().'">
            	<meta property="og:type" content="article" />
            	<meta property="og:title" content="'.$wd->title.'">
                <meta property="og:description" content="'.$wd->desc.'" > 
                <meta property="og:image" content="'.LOGO.'">
                <meta property="og:image:url" itemprop="image" content="'.LOGO.'" />
                <meta property="og:image:type" content="image/png" />
                <meta property="og:image:width" content="600" />
                <meta property="og:image:height" content="600" />
                <meta itemprop="title" description="'.$wd->title.'">
                <meta itemprop="description" description="">
                <meta name="description" content="'.$wd->desc.'">
                <link rel="sitemap" type="text/html" href="'.current_url().'sitemap.html" >
                <link rel="sitemap" type="application/xml" href="'.current_url().'sitemap.xml">
                <link rel="canonical" href="'.base_url().'"/ >
                <link rel="stylesheet" href="'.base_url('public/style.css').'">
                <link rel="icon" type="image/x-icon" href="'.LOGO.'" />';
                if($admin == false){
                    $get .= '<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">';
                }
                $get .= '
                <!--<script src="https://cdn.tailwindcss.com"></script> 
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twind/0.16.16/twind.js"></script>
                <script src="https://cdn.tailwindcss.com"></script>-->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>';
    }
    $get .= do_action('ab_head');
    $get .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>var base_url = "'.base_url().'";</script>
            <!-- <script src="https://cdn.tailwindcss.com"></script> -->
                ';
    if($flag){
        return $get;
    }else{
        echo $get;
    }
}
function AfterFooterContent($flag=false){
    $get = do_action('ab_footer');
    $get .= '<script src="'.base_url('public/admin/custom/js/custom.js').'"></script>
    </script><script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>';
    if($get){
        return $get;
    }else{
        echo $get;
    }
}

function bodyClass(){
    do_action('ab_body_class');
}


function OtherContent($type,$key='content',$flag=false){
    $ci = &get_instance();
    $get = $ci->db->get_where('other_content',['type'=>$type,'admin_id'=>CLIENT_ID]);
    $data = $get->num_rows() ? htmlDecode($get->row()->$key) : '';
    if($flag){
        return $data;
    }
    if($key == 'cssdata' ){
        echo '<style>'.$data.'</style>';
    }else{
        return do_shortcode($data);
    }
}

function theContent($pageid,$key='content',$flag=false,$uri='home'){
    $html = '';
    $ci = &get_instance();
    $get = $ci->db->get_where('page_content',['page_id'=>$pageid,'admin_id'=>CLIENT_ID]);
    $html = $get->num_rows() ? htmlDecode($get->row()->$key) : '';
    if($html == '' && $key != 'cssdata'){
        if(file_exists(APPPATH.'views/includes/'.THEMEPATH.'/'.strtolower($uri).'-content.php')){
            $html = $ci->load->view('includes/'.THEMEPATH.'/'.strtolower($uri).'-content',[],true);
        }else{
            $html = $ci->load->view('includes/'.THEMEPATH.'/home-content',[],true);
        }
    }
    if($flag){
        return $html;
    }
    if($key == 'cssdata' ){
        echo '<style>'.$html.'</style>';
    }else{
        return do_shortcode($html);
    }
}

function theTitle(){
    $ci = &get_instance();
    $ci->load->model('WebsiteData');
    $get = '';
    $wd = $ci->WebsiteData->get(['admin_id'=>CLIENT_ID]);
    if($wd->num_rows()){
        $wd = $wd->row();
        return PAGE_NAME.' | '.$wd->title;
    }
}

