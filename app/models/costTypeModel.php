<?php
class CostTypeModel extends Model
{ 
    public static $table =  'cost_types';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

CostTypeModel::index();
