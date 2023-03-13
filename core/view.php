<?php


class View
{
static public  function render($template, $data = []){ 
    try {

        $file =  PATH_VIEWS. str_replace('.' , '/', $template) .  '.php';
        if (file_exists($file)) {
            include_once($file);
        } else {
            echo('Template ' . $template . ' not found!');
            
        }
    } catch (\Throwable $e) {
        //throw $th;
    }
} 
}
?>