<?php
class CostUnitsModel extends Model
{ 
    public static $table =  'cost_units';
    public static function index(){
        Model::$table = self::$table;
    } 
}

CostUnitsModel::index();
