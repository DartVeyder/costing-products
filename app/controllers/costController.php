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
        ['table' => 'units', 'on' => ['with' => 'unit_id', 'on' => 'id']] 
      ],
      ['cost_categories.name' => 'cost_categories_name','units.name' => 'unit_name']);
    $data['categories'] = CostCategoryModel::all();
    $data['units'] = UnitsModel::all(); 
   
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
