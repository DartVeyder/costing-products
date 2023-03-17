<?php
class CostModel extends Model
{ 
    public static $table =  'costs';
   
    public static function index(){
        Model::$table = self::$table;
    }
}

CostModel::index();
