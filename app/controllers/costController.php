<?php
class CostController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $data['costs'] = CostModel::allJoin(
      ['*'], 
      [], 
      [
        ['table' => 'cost_categories',  'on' => ['with' => 'cost_category_id', 'on' => 'id']],
        ['table' => 'cost_units', 'on' => ['with' => 'cost_unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','cost_units.name' => 'unit_name']);
    $data['categories'] = CostCategoryModel::all();
    $data['units'] = CostUnitsModel::all(); 
   
    View::render('cost.index', $data); 
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
