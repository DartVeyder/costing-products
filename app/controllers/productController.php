<?php
class ProductController
{
  

  // Метод index буде обробляти запити користу вачів
  public function index()
  {  
    $products = ProductModel::all();      
    View::render('product.index', compact('products'));
  }

  public function show($id)
  {  
    $product = ProductModel::find($id)[0];  
    View::render('product.show', compact('product'));
  }

}
