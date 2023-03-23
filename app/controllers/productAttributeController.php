<?php
class ProductAttributeController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {   
    $product_attributes = productAttributeModel::all(); 
    View::render('product.attribute.index', compact('product_attributes'));
  } 

  public function store(){ 
    productAttributeModel::create($_POST);
    redirect('/products/attributes/');
  }

  public function delete($product_attribute_id){ 
    productAttributeModel::delete(["id = $product_attribute_id"]);
    redirect('/products/attributes/');
  }
}
