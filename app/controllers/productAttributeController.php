<?php
class ProductAttributeController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $product_attributes = AttributeModel::all(); 
    View::render('product.attribute.index', compact('product_attributes'));
  } 

  public function store(){ 
   AttributeModel::create($_POST);
    redirect('/products/attributes/');
  }

  public function delete($product_attribute_id){ 
    AttributeModel::delete(["id = $product_attribute_id"]);
    redirect('/products/attributes/');
  }
}
