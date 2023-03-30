<?php
class AttributeTypeModel extends Model
{ 
    public static $table =  'attribute_type';
   
    public static function index(){
        Model::$table = self::$table;
    }
 
}

AttributeTypeModel::index();
