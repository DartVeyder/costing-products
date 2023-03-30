<?php
    define("ROOT_DIR" ,str_replace('config' , "" , realpath(dirname(__FILE__) ))) ;
    
    const URL_APP = 'http://modules/costing-products';
    const URL_ASSETS = URL_APP . '/assets';
    define("DIR_ACTIVE" , URL_APP . str_replace('/costing-products' , "" , $_SERVER["REQUEST_URI"] )) ;
    const PATH_CORE = ROOT_DIR . 'core/';
    const PATH_VIEWS = ROOT_DIR . 'app/views/';
    const PATH_CONTROLLERS = ROOT_DIR . 'app/controllers/';
    const PATH_MODELS = ROOT_DIR . 'app/models/';
    

    
    
?>