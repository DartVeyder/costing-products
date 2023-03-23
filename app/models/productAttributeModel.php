<?php
class ProductAttributeModel extends Model
{ 
    public static $table =  'product_attributes';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

ProductAttributeModel::index();
