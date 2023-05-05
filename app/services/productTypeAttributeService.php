<?php

class ProductTypeAttributeService{
    public function index($product_type_id){
        // Отримання списку одиниць виміру
        $units = UnitsModel::all(); 

        // Отримання списку атрибутів типу продукту з приєднанням до таблиці атрибутів
        $attribute_types = AttributeTypeModel::allJoin(
            ['*'], 
            ['product_type_id' =>  $product_type_id], 
            [
                ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']],
            ],
            ['attributes.name' => 'name','attributes.unit_id' => 'unit_id']
            );  

        // Мапування одиниць виміру на їх назви
        $units = array_column($units, 'name' , 'id');

        // Додавання назв одиниць виміру до списку атрибутів типу продукту
        $attribute_types = array_map(function($item) use ($units) {
            $item['unit_name'] = $units[$item['unit_id']];
            return $item;
        }, $attribute_types);

        return $attribute_types;
    }
}