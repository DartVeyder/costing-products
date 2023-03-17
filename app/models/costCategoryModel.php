<?php
class CostCategoryModel extends Model
{ 
    public static $table =  'cost_categories';
    public static function index(){
        Model::$table = self::$table;
    } 
}

CostCategoryModel::index();
