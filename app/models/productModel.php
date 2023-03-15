<?php
class ProductModel
{

    public static function get_data()
    {
        return  [
            1 => [
                'id' => 1,
                'sku' => 'mz0001',
                'name' => 'Product A',
                'category_id' => 1,
                'created_at' => '2022-01-01 10:00:00',
                'updated_at' => '2022-01-01 10:00:00'
            ],
            2 => [
                'id' => 2,
                'sku' => 'mz0002',
                'name' => 'Product B',
                'category_id' => 2,
                'created_at' => '2022-01-02 11:00:00',
                'updated_at' => '2022-01-03 12:00:00'
            ],
            3 => [
                'id' => 3,
                'sku' => 'mz0003',
                'name' => 'Product C',
                'category_id' => 1,
                'created_at' => '2022-01-05 13:00:00',
                'updated_at' => '2022-01-06 14:00:00'
            ]

        ];
    }

    public static function all()
    {
        $products =  self::get_data();
        return $products;
    }

    public static function find($id){
        
    }
}
