<?php

use Twig\Environment;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;



class Twig_extension{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(PATH_VIEWS);
        $this->twig = new Environment($loader);   
        $this->asset();
        $this->path();
    }
    
    public function view($template, $data = []){ 
        $file =  str_replace('.', '/', $template) .  '.twig';
        echo $this->twig->render($file, $data);
    }

    public function asset(){
        $this->twig->addFunction(new TwigFunction('asset', function ($asset) {
            // або використовуйте ваш власний шлях до каталогу з ресурсами
            $publicPath = URL_ASSETS; 
            // шлях до ресурсу
            $path = $publicPath.'/'.$asset;
            return $path;
        }));
    }

    public function path(){
        
        $this->twig->addFunction(new TwigFunction('path', function ($path, $router = '') {
            // або використовуйте ваш власний шлях до каталогу з ресурсами
            $publicPath = URL_APP; 
            // шлях до ресурсу
            $path = $publicPath .$path. $router;
            return $path;
        }));
    }
}
