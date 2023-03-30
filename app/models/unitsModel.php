<?php
class UnitsModel extends Model
{ 
    public static $table =  'units';
    public static function index(){
        Model::$table = self::$table;
    } 
}

UnitsModel::index();
