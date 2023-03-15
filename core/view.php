<?php
  
class View{

    static public  function render($template, $data = []){
        $TwigExtension = new Twig_extension;
        $TwigExtension->view($template, $data);
    } 
}   
