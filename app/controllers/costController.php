<?php
class CostController
{
  private $product_cost_service;

  public function __construct(){
      $this->product_cost_service = new ProductCostService;
  }

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $data['costs'] = CostModel::allJoin(
      ['*'], 
      [], 
      [
        ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
        ['table' => 'units', 'on' => ['with' => 'unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','units.name' => 'unit_name']);
    $data['categories'] = CostCategoryModel::all();
    $data['types'] = CostTypeModel::all();
    $data['units'] = UnitsModel::all(); 
    View::render('cost.index', $data); 
  }

  public function store()
  {   
    CostModel::create($_POST);
    redirect('/costs');
  }

  public function edit($id)
  {   
    $data['cost_attributes'] = CostAttributeModel::allJoin(
      ['*'], 
      ["cost_id" => $id], 
      [
        ['table' => 'attributes',  'on' => ['with' => 'attribute_id', 'on' => 'id']], 
        ['table' => 'units',  'on' => ['table' => 'attributes','with' => 'unit_id', 'on' => 'id']], 
      ],
      ['attributes.name' => 'name', 'units.name' => 'unit' ],);

      $data['cost'] = CostModel::findJoin(
        ['*'], 
        ["id" => $id], 
        [
          ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
          ['table' => 'units', 'on' => ['with' => 'unit_id', 'on' => 'id']] 
        ],
        ['cost_categories.name' => 'cost_categories_name','units.name' => 'unit_name']);
 //   Helper::dd($data);
    View::render('cost.edit',$data); 
  }

  public function update($cost_id){
    $post = $_POST;
    $response['post'] = $post ; 

    if($post['costs']['unit_cost']){
      CostModel::update(['unit_cost' => $post['costs']['unit_cost']], ["id = $cost_id"]);
    }  

    if( $post['cost_attribute']){
      $product_cost_attributes = ProductCostAttributeModel::all(["cost_id = $cost_id"]);
      $response['product_cost_attributes'] = $product_cost_attributes; 
      CostAttributeModel::update(['value' => $post['cost_attribute']['value']], ["id =" .  $post['cost_attribute']['id']]);
      
      foreach ($product_cost_attributes as $attribute) { 
        $response_calculation = $this->product_cost_service->calculate__total_cost_quantity($post['costs']['unit_cost'], $attribute['value'],$post['cost_attribute']['value']);
        $data = [
          'quantity' =>  $response_calculation['quantity']['result'] , 
          'total_cost' => $response_calculation['total_cost']['result']
        ];  
        ProductCostModel::update($data, ["id = $attribute[product_cost_id]"]);
      }  
    }else{
      $product_costs = ProductCostModel::all(["cost_id = $cost_id"]);
      $response['product_costs'] = $product_costs;

      foreach ($product_costs as $product_cost) {
        $total_cost = $product_cost['quantity'] * $post['costs']['unit_cost'];
        $data = [ 
          'total_cost' => $total_cost
        ];  
        ProductCostModel::update($data, ["id = $product_cost[id]"]);
      }

    } 
    $response['data'] = $data;
      //Helper::dd($response);
    redirect("/costs/$cost_id/edit");
  }

  public function delete($id){ 
    
    CostModel::delete(["id = $id"]);
  redirect('/costs');
  }
}
