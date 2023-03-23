<?php
class ProductTypeModel extends Model
{ 
    public static $table =  'product_types';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

ProductTypeModel::index();
