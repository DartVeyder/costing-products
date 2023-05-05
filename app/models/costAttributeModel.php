<?php
class CostAttributeModel extends Model
{ 
    public static $table =  'cost_attributes';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

CostAttributeModel::index();
