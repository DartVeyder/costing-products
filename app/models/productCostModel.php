<?php
class ProductCostModel extends Model
{ 
    public static $table =  'product_costs';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

ProductCostModel::index();
