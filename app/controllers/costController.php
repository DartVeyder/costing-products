<?php
class CostController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {  
    //$costs = ProductModel::all();
   /* $costs = CostModel::all();
    
    foreach ($costs as $key => $cost) {
      $id =  $cost['cost_category_id'];  
      $costs[$key]['cost_categories_name'] =  CostCategoryModel::find(["id = $id"])['name'];
    }*/ 
    
    $costs['items'] = CostModel::allJoin(
      ['*'], 
      [], 
      [
        ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
        ['table' => 'cost_units', 'on' => ['with' => 'cost_unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','cost_units.name' => 'cost_unit_name']);
    $costs['categories'] = CostCategoryModel::all();
    $costs['units'] = CostUnitsModel::all();
  
    View::render('cost.index', compact('costs')); 
  }

  public function store()
  {   
    CostModel::create($_POST);
    redirect('/costs');
  }

  public function delete($id){ 
    CostModel::delete(["id = $id"]);
    redirect('/costs');
  }
}
