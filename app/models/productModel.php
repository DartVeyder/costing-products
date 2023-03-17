<?php
class ProductModel extends Model
{ 
    public static $table =  'products';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

ProductModel::index();
