<?php
    class ProductTypeAttributeController{
        private $product_type_attributes;

        public function __construct(){
            $this->product_type_attributes = new ProductTypeAttributeService;
        }
        public function index($product_type_id)
        {   
            $attribute_types = $this->product_type_attributes->index($product_type_id);
            $attributes = AttributeModel::all();

            $data['attribute_types'] = $attribute_types;
            $data['attributes'] = $attributes; 
        
            //Helper::dd($data);
        
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