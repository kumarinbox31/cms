<?php
class Web_api{
    
    public $domain_name;
    public $controller = '';
    public $APPDIR = 'setup/super';
    public $DIR = 'default';
    public $page_id = 0;
    public $viewpath = 'views'; 
    public $db,$resellerDB; 
    public $isDomainSet = false;
    private $client = [];
    private $reseller = [];
    public $ERROR_SHOW = false;
    public $setResellerDomain = false;

    function __construct($defined999){
        
        
        
        $this->domain_name = $defined999['domain_name'];
        
        define('FRESH_DOMAIN',str_replace('www.','',$this->domain_name));
        // print_r($defined999);exit;
        $this->connect($defined999['HOST'],
                        $defined999['HOST_USER'],
                        $defined999['DB_PASSWORD'],
                        $defined999['DB_NAME']);
         $__lw = $this->init(); //("SELECT * FROM w999_websites WHERE domain_name LIKE '".FRESH_DOMAIN."'");
         
        //  if(!$__lw->num_rows AND FRESH_DOMAIN != 'website999.in.net' ){
        //      $defined999['DB_NAME'] = 'website9_old';
        //      $this->connect('localhost',
        //                 $defined999['HOST_USER'],
        //                 $defined999['DB_PASSWORD'],
        //                 $defined999['DB_NAME']);
        //         $__lw = $this->init();
        //  }
         
         foreach ($defined999 as $k => $m) 
            define($k,$m);
         
         
         $this->isDomainSet = $__lw->num_rows;
         
         
        if($this->isDomainSet)
             $this->client = $__lw->fetch_assoc();
             
        $this->ERROR_SHOW = $this->db->query("SELECT show_error as value FROM ".PREFIX."_auth WHERE id = 1 ")->fetch_assoc()['value'];
        

        if(!@$this->client['status'] && @$this->isDomainSet){
            require 'template/deactive-website.php';
            exit;
            
        }

        if(reseller ){ //&& domain_name == 'developer.ajaydemo.in.net'){
            // die();
             $this->resellerDB = mysqli_connect(HOST,HOST_USER,DB_PASSWORD, RESELLER_DB) or die('ERRORS = '. mysqli_connect_error());

            $getREseller = $this->resellerDB->query("SELECT * FROM  ".RESELLER_PREFIX."admins WHERE domain = '".FRESH_DOMAIN."' ");

            if($this->setResellerDomain = $getREseller->num_rows)
            {
                $get = (object) $getREseller->fetch_assoc();
                define('RID',$get->id);
                define('WALLET',$get->type);
                $this->reseller = (array) $get;  
                
                if(!$this->reseller['status'])
                    require 'setup/reseller/inActive.php';

                unset($get);
            }

        }




    }
    function connect($host , $user , $pass , $db_name){
        $this->db = mysqli_connect(
                                    $host,
                                    $user,
                                    $pass,
                                    $db_name
                                 ) or die('ERRORS = ' . mysqli_connect_error() );
    }
    function query($query){
        return $this->db->query($query);
    }
    function init(){
        return $this->query("SELECT * FROM ab_websites WHERE domain LIKE '".FRESH_DOMAIN."'");
    }
    function setDomain(){
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            define('base_url','https://'.$this->domain_name);
        else 
            define('base_url','http://'.$this->domain_name);
    }
    function run(){
        require_once BASEPATH.'core/CodeIgniter.php';
    }
    function client(){
        define('CLIENT_ID',$this->client['id']);
        define('SYSTEM_EMAIL',$this->client['_email']);
        // define('RESELLER_ID',$this->client['reseller_id']);
        define('AdminNAME',ucwords($this->client['name']));
        define('AdminProfile',base_url.'/public/user.png');
        define('AdminPass',$this->client['_pass']);
        define('FOLDER','public/temp/'.CLIENT_ID);
        define('CUSTOMER_SESSION',$this->client['last_login_session']);
        define('DEFAULTPAGE',$this->client['defualt_page']);
        // define('COMMING_SOON',$this->client['comming_soon']);
        
        // define('starttime',$this->client['start_time']);
        // $date = $this->client['expire_time'];
        // if(empty($this->client['expire_time']))
        //     $date = strtotime( date( 'Y-m-d H:i:s', $this->client['start_time'] )  . ('+1 year'));
        // define('endtime',$date);
      
        // if($this->isDomainSet){
        //     if( time() >= endtime ){
        //         header('HTTP/1.1 503 Service Temporarily Unavailable');
        //         header('Status: 503 Service Temporarily Unavailable');
        //         header('Retry-After: 300');//300 seconds
        //         die();
        //     }
        // }
        
    }
    function setTheme($type = 'client'){


        if($type == 'reseller'){

                if(isset($this->reseller['theme_id'])){
                   $this->DIR      =  $this->controller  = 'reseller';                    
                }
        }
        else{

            // $__mainTheme = $this->db->query("SELECT ".PREFIX."_themes.*,".PREFIX."_theme_types.*,".PREFIX."_web_themes.id as web_id FROM ".PREFIX."_web_themes,".PREFIX."_theme_types WHERE ".PREFIX."_web_themes.id = '".$this->client['theme_id']."' AND ".PREFIX."_theme_types.id=".PREFIX."_web_themes.type");  
            $__mainTheme = $this->db->query("SELECT * FROM ".PREFIX."_themes WHERE id = '".$this->client['theme_id']."'");
            if($__mainTheme->num_rows){
                $_r = $__mainTheme->fetch_assoc();
            //   define($_r['type_name'],$_r['theme_name']);
               define('THEME_NAME',$_r['title']);
                // switch($_r['type_name']){
                //     case 'custom': case 'ecommerce':
                //         $this->APPDIR           = 'setup/'.$_r['type_name'].'/'.$_r['path'];
                //         $this->viewpath         = $this->APPDIR.'/html/';
                //     break;
                //     // case 'myecommerce':
                //     //     $this->APPDIR           = 'setup/'.$_r['type_name'];
                //     //     $this->viewpath         = $this->APPDIR.'/views';
                //     // break;
                //     case 'computer':
                //         $this->APPDIR           = 'setup/'.$_r['type_name'].'/'.$_r['path'].'/application';
                //         $this->viewpath         = $this->APPDIR.'/views';
                //     break;
                //     default:
                        $this->APPDIR           = 'setup/main'; 
                        $this->viewpath        = $this->APPDIR.'/views';
                // }
                $this->DIR = $_r['path'];
                define('THEMEPATH',$this->DIR);
                // define('isCustom', $_r['isCustom']);
                define('THEME_ID',$_r['id']);
                define('PRELOADER', @$_r['preloader']);
                
                
                if($this->client['id'] == 194){
//                     echo 'wait. running';
//                     echo "<br>$this->APPDIR <br>
// $this->viewpath";
//                     exit;
                    
                }
                
                
                if($this->client['defualt_page']){
                    
                    $__default_p = $this->db->query("SELECT * FROM ".PREFIX."_pages WHERE id = '".$this->client['defualt_page']."'");
                    
                    if($__default_p->num_rows)
                        $this->page_id = $__default_p->fetch_assoc()['id'];
                    
                    
                }
            }
        }
    }
    function setOldDB($data = array()){
        foreach($data as $k => $d)
            define($k,$d);
    }
    function runAPI(){
        $this->DIR = 'setup/api';
        $this->APPDIR = 'setup/api/main';
        $this->viewpath = 'views';
    }
    function setDir(){
        define('FileDirecory',$this->DIR);
        define('DefaultPage',$this->page_id); 
        define('controllerDefault',$this->controller);
    }
    function getSubDomain() {

        list($subdomain,$host) = explode('.', $_SERVER["SERVER_NAME"]);

        return (checkdnsrr( str_replace($subdomain.'.', '', domain_name) , 'A' ))
                ?   $subdomain
                :   false;
    }
    
    
}



?>
