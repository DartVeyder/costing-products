<?php
class ProductModel extends Model
{ 
    public static $table =  'products';
   
    public static function product(){
        Model::$table = self::$table;
    }
}

ProductModel::product();
