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

    $data['costs'] = CostModel::allJoin(
      ['*'], 
      [], 
      [
        ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
        ['table' => 'units', 'on' => ['with' => 'unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','units.name' => 'unit_name']);
     //Helper::dd($data);
    View::render('product.costs.index', $data);
  }
  
  public function store($product_id){
  
    $data = $_POST;
    $data_cost = explode("|" , $data["cost_id"]);
    $data["cost_id"] = $data_cost[0];
    
    $data['product_id'] = $product_id;
    $cost =  CostModel::find("id =  $data[cost_id]" , 'name, unit_cost');
    $data['total_cost'] = $cost['unit_cost']  * $data['quantity'];
    $data["quantity"] = $data["quantity"] . ' ' . $data_cost[1];
   
    ProductCostModel::create($data);
      
    redirect("/products/$product_id/costs");
  }

  public function delete($product_id, $product_cost_id){ 
    ProductCostModel::delete(["id = $product_cost_id"]);
    redirect("/products/$product_id/costs/");
  }
 
}
