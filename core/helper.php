<?php
class Helper{

    public static function dd ($array)
    {
        echo "<pre>";
        print_r($array);
        exit;
    }
}