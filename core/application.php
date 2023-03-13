<?php 

class Application {
    
    public function run(){
        $this->Loader(); 
    }
    
    public function Loader(){
        //Підключення файлу конфігурацій
        require_once('config/config.php'); 

        //Підключення файлу автозагрузки бібліотек
        require_once ROOT_DIR . '/vendor/autoload.php';  

        //Підключення файлу автозагрузки класів
        require_once PATH_CORE . '/autoload.php';
        spl_autoload_register(['ClassLoader', 'autoload'], true, false);
        
        //Підключення файлу для маршрутизаціїї запитів
        require_once PATH_CORE . '/router.php'; 
        
    }
    
}