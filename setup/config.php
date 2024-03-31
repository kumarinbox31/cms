<?php

    require_once __DIR__.'/system/libraries/Web_api.php';
	define('main_dir',__DIR__.'/main/');
	function _ago($ptime)
	{
	    $etime = time() - strtotime($ptime);

	    if ( $etime < 1 )
	    {
	        return 'JUST NOW.';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs; 
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}
    
    $api = new Web_api(
    						[
    							'ENVIRONMENT'		=>	isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development',
    							'HOST'				=>	'sdb-w.hosting.stackcp.net',
    							'HOST_USER'			=>	'webfire_main',
    				            'DB_PASSWORD'       =>  '_l/RwI_0]ZeJ',
    							'DB_NAME'			=>	'webfire_main-323133ec33',
    							'DB_PREFIX'			=>	'w999_',
    							'MAIN_SITE'			=>	'https://webfire.in/',
    							'domain_name'		=>	$_SERVER['HTTP_HOST'],
    							'EDB_NAME'			=>	'website9_ecommerce_001',
    							'PREFIX'			=>	'ab',
    							'reseller'			=>	true,
    							'RESELLER_PREFIX'	=>	'ab_',
    							'RESELLER_DB'       =>  'webfire_super-313834a166',
    						]
    				);
    
    // print_r($api);
	$api->setDomain();
    
// 	$anOtherData = [ 
// 						'OLD_MAIN' 				=> 		'sndparas_master', 
// 						'OLD_DB_PASSWORD' 		=> 		'q;V0#*Vi%&H3' , 
// 						'OLD_DB_ADMIN' 			=> 		'sndparas_admin', 
// 						'OLD_DB_CLIENT' 		=> 		'sndparas_clients' 
// 				];

	if($api->isDomainSet){
	    
	    $api->client();
		$api->setTheme();
		$api->setDir();

		/*
			This is most useful api  for running process.
		*/

	}
	else if($api->setResellerDomain){
    
		$api->setTheme('reseller');
		$api->setDir();//exit('loading..');
	
// 		$api->setOldDB($anOtherData);
	}
	else if($api->getSubDomain() === 'api'){
	    
	   // exit('Api Running...');
	    

	    $api->runAPI();
	    
	    ///  $api->setOldDB($anOtherData);
	}
	else{
	    $api->setOldDB($anOtherData);
	    
	}

   define('ERROR_SHOW',$api->ERROR_SHOW);
?>