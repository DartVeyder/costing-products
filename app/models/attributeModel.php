<?php
class AttributeModel extends Model
{ 
    public static $table =  'attributes';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

AttributeModel::index();
