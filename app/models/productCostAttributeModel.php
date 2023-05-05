<?php
class ProductCostAttributeModel extends Model
{ 
    public static $table =  'product_cost_atrributes';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

ProductCostAttributeModel::index();
