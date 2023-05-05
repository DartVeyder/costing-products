<?php
class CostTypeController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $cost_types = CostTypeModel::all();

    View::render('cost.type.index', compact('cost_types'));
  } 

  public function store(){  
    CostTypeModel::create($_POST);
    redirect('/costs/types/');
  }

  public function delete($cost_type_id){ 
    CostTypeModel::delete(["id = $cost_type_id"]);
    redirect('/costs/types/');
  }
}
