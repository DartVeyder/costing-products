<?php
class ProductCostController
{
  // Метод index буде обробляти запити користу вачів
  public function index($product_id)
  { 
    $data['product'] = ProductModel::find(["id = $product_id"]);
    $product_costs = ProductCostModel::allJoin(
      ['id', 'quantity', 'total_cost', 'cost_id', 'description'], 
      ['product_id' => $product_id], 
      [
        ['table' => 'costs',  'on' => ['with' => 'cost_id', 'on' => 'id']],
      ],
      ['costs.name' => 'name', 'costs.unit_cost' => 'unit_cost' ]
    ); 
    $data['product_costs'] = $product_costs;
    $data['total_costs'] = array_sum(array_column($product_costs, 'total_cost'));
    $data['types'] = CostTypeModel::all();
    $data['costs'] = CostModel::allJoin(
      ['*'], 
      [], 
      [
        ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
        ['table' => 'units', 'on' => ['with' => 'unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','units.name' => 'unit_name']);
   // Helper::dd($data);
    View::render('product.costs.index', $data);
  }
  
  public function store($product_id){
  
    $data = $_POST;
    $data_cost = explode("|" , $data["cost_id"]);
    $cost_id = $data_cost[0];
    $data["cost_id"] = $cost_id;
    
    $data['product_id'] = $product_id;
    $cost =  CostModel::find("id =  $data[cost_id]" , 'name, unit_cost');
    $data['total_cost'] = $cost['unit_cost']  * floatval($data['quantity']);
    $data["quantity"] =  floatval($data["quantity"]) . ' ' . $data_cost[1];
   
    //Helper::dd($data);
    ProductCostModel::create($data);
      
    redirect("/products/$product_id/costs/$cost_id/edit");
  }

  public function edit($product_id, $product_cost_id){ 
      $data['product_cost_attributes'] =  ProductCostAttributeModel::allJoin(
        ['*'], 
        ['product_cost_id' => $product_cost_id], 
        [
          ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']], 
          ['table' => 'units',  'on' => ['table' => 'attributes','with' => 'unit_id', 'on' => 'id']], 
        ],
        ['attributes.name' => 'attributes_name', 'units.name' => 'unit_name','units.id' => 'unit_id']);
      
      $data['product_cost'] = ProductCostModel::findJoin(
        ['*'], 
        ['id' => $product_cost_id], 
        [
          ['table' => 'costs',  'on' => ['with' => 'cost_id', 'on' => 'id']],
        ],
        ['costs.name' => 'name', 'costs.unit_cost' => 'unit_cost' ]
      ); 
      View::render('product.costs.edit', $data);
    Helper::dd($data);
  }

  public function update($product_id, $product_cost_id){
    $data_post =  $_POST;
    
    $cost = CostModel::find(["id = $data_post[cost_id]"]);
    $cost_attributes = CostAttributeModel::allJoin(
      ['*'], 
      ["cost_id" => $data_post['cost_id']], 
      [
        ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']], 
        ['table' => 'units',  'on' => ['table' => 'attributes','with' => 'unit_id', 'on' => 'id']], 
      ],
      ['attributes.name' => 'name', 'units.name' => 'unit' ],);

      $quantity =  $cost_attributes[0]['value'] / $data_post['cost_atrributes_value'];
      $total_cost = $cost['unit_cost'] / $quantity ;
      $quantity = 1 /   $quantity ;


      $data['quantity'] = $quantity ;
      $data['total_cost'] = $total_cost; 
      ProductCostAttributeModel::update(['value' =>  $data_post['cost_atrributes_value']], ["id = $data_post[cost_atrribute_id]"]);
      ProductCostModel::update($data, ["id = $product_cost_id"]);
      $data['post']  =  $data_post;
      $data['cost_attributes'] = $cost_attributes;
      $data['cost'] = $cost;
      redirect("/products/$product_id/costs/");
  }

  public function delete($product_id, $product_cost_id){ 
    ProductCostModel::delete(["id = $product_cost_id"]);
    redirect("/products/$product_id/costs/");
  }
}
