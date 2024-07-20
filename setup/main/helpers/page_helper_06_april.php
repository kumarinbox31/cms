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



function beforeHeadContent($flag=false){
    $get = '';
    $ci = &get_instance();
    $ci->load->model('WebsiteData');
    $wd = $ci->WebsiteData->get(['admin_id'=>CLIENT_ID]);
    // getting meta tags
    if($wd->num_rows()){
        $wd = $wd->row();
        $get .= '<meta property="title" content="'.$wd->title.'">
                <meta property="keywords" content="'.$wd->keywords.'">
            	<meta property="og:locale" content="en_GB" />
            	<meta property="og:url" content="'.base_url().'">
            	<meta property="og:type" content="article" />
            	<meta property="og:title" content="'.$wd->title.'">
                <meta property="og:description" content="'.$wd->desc.'" > 
                <meta property="og:image" content="">
                <meta property="og:image:url" itemprop="image" content="" />
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
                ';
    }
    $get .= do_action('ab_head');
    $get .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>var base_url = "'.base_url().'";</script>
            <link href="https://cdn.tailwindcss.com" rel="stylesheet">
            ';
    if($flag){
        return $get;
    }else{
        echo $get;
    }
}
function AfterFooterContent($flag=false){
    $get = do_action('ab_footer');
    $get .= '<script src="'.base_url('public/admin/custom/js/custom.js').'"></script>';
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

