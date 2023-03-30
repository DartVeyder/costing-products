<?php
class ProductController
{
  // Метод index буде обробляти запити користу вачів
  public function index()
  {
    $products = ProductModel::all(['delete_at  IS NULL']);
    View::render('product.index', compact('products'));
  }

  /*public function show($id)
  { 

    $data['product'] = ProductModel::find($id);
    $data['product_costs'] = ProductCostModel::allJoin(
      ['id', 'quantity', 'total_cost'], 
      ['product_id' => $id], 
      [
        ['table' => 'costs',  'on' => ['with' => 'cost_id', 'on' => 'id']],
      ],
      ['costs.name' => 'name', 'costs.unit_cost' => 'unit_cost' ]
    ); 
  //  Helper::dd($data);
    View::render('product.costs.index', $data);
  }*/

  public function store(){ 
    ProductModel::create($_POST);
    redirect('/products');
  }

  public function edit($product_id){
    $product = ProductModel::find(["id = $product_id"]);
    $product_type = ProductTypeModel::find(["id = $product[product_type_id]"]); 
    $product_attribute = ProductAttributeModel::all(["product_id = $product_id"]);
    
    $units = UnitsModel::all(); 
    $attribute_types = AttributeTypeModel::allJoin(
    ['*'], 
    ['product_type_id' =>  $product["product_type_id"]], 
    [
      ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']],
    ],
    ['attributes.name' => 'name','attributes.unit_id' => 'unit_id']
  );  
  
     $attribute_types = array_column($attribute_types, null , 'attribute_id');
     $product_attribute = array_column($product_attribute, null , 'attribute_id');
  
     foreach ($attribute_types as $key => $item) {
       $attribute_types[$key]["value"] = $product_attribute[$item['attribute_id']]['value'];
       $attribute_types[$key]["unit"] =  $units[$item['unit_id'] - 1]['name'];
    } 
    $data['product'] = $product ;
    $data['type'] = $product_type;
    $data['product_attibutes'] = $attribute_types;  
    $data['costs'] = CostModel::allJoin(
      ['*'], 
      ['cost_category_id'=> '2'], 
      [
        ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
        ['table' => 'units', 'on' => ['with' => 'unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','units.name' => 'unit_name']);
      
      
    View::render('product.edit', $data);
  }

  public function update($product_id){ 
    $cost = CostModel::find("id = $_POST[cost_id]" , ['unit_cost']);
    $product_attributes = $_POST['product_attributes'];
    $post_desc = $_POST['description'];
    
    $waste =  $product_attributes[8]; // відсоток відходів
    $quantity = Calculate::volume($product_attributes[1], $product_attributes[2], $product_attributes[9] , 3 , 1);
    $cost_price_raw =  Calculate::cost_price_raw($cost['unit_cost'], $quantity,  $waste );
    $description =  $post_desc;
    $description[] =  "Ціна за штуку = " .$cost_price_raw['formula'] . " = " .  round($cost_price_raw['result'], 2)  ;
    $product_costs = [
      "cost_id" => $_POST['cost_id'],
      "product_id" => $product_id,
      'quantity' =>  $quantity,
      'total_cost' =>  $cost_price_raw['result'],
      'description' => implode("</br>" , $description)
    ] ; 
   // Helper::dd($product_costs);
 
    foreach ($product_attributes as $key => $attribute) {
      $data = [ 
        "attribute_id" =>  $key,
        "value" => $attribute,
        "product_id" => $product_id,
      ]; 
      
      ProductAttributeModel::replace($data);
    }  
    ProductCostModel::replace($product_costs);
    redirect("/products/{$product_id}/edit" );
  }

  public function delete($id){ 
    ProductModel::softDelete(["id = $id"]);
    redirect('/products');
  }
  
}
