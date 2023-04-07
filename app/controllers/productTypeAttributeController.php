<?php
    class ProductTypeAttributeController{
        public function index($product_type_id)
        {   
            $units = UnitsModel::all(); 
            $attribute_types = AttributeTypeModel::allJoin(
                ['*'], 
                ['product_type_id' =>  $product_type_id], 
                [
                    ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']],
                ],
                ['attributes.name' => 'name','attributes.unit_id' => 'unit_id']
                );  
                
                $units = array_column($units, 'name' , 'id');
                $attribute_types = array_map(function($item) use ($units) {
                    $item['unit_name'] = $units[$item['unit_id']];
                    return $item;
                }, $attribute_types);

                $attributes = AttributeModel::all();
                
                $data = [
                    'attribute_types' => $attribute_types,
                    'attributes' =>$attributes
                ];
            
                //Helper::dd($attribute_types);
            
                View::render('product.type.attribute.index',  $data);
        } 

        public function update($product_type_id){
            $data = $_POST;
            unset($data['PATCH']);
            foreach ($data as $key => $item) { 
                $clauses = [
                    "id = '$key'"
                ];

                $array = ['value' => $item]; 
                AttributeTypeModel::update($array, $clauses);
                
            } 
            redirect("/products/types/$product_type_id/attributes/");
        }

    }

?>