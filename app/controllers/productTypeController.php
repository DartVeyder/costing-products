<?php
class ProductTypeController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $product_types = productTypeModel::all();  
    View::render('product.type.index', compact('product_types'));
  } 

  public function edit($product_type_id){
    $attribute_types = AttributeTypeModel::allJoin(
      ['*'], 
      ['product_type_id' =>  $product_type_id], 
      [
        ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']],
      ],
      ['attributes.name' => 'name','attributes.unit_id' => 'unit_id']
    );  
    $attributes = AttributeModel::all();

    $data = [
      'attribute_types' => $attribute_types,
      'attributes' =>$attributes
    ];

    // Helper::dd($data);

    View::render('product.type.edit',  $data);
  }

  public function store(){ 
    productTypeModel::create($_POST);
    redirect('/products/types/');
  }

  public function delete($product_type_id){ 
    productTypeModel::delete(["id = $product_type_id"]);
    redirect('/products/types/');
  }
}
