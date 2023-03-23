<?php
class ProductTypeController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $product_types = productTypeModel::all();  
    View::render('product.type.index', compact('product_types'));
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
