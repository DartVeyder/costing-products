<?php
class ProductController
{
  private $product;

  public function __construct()
  {
    $this->product = New ProductModel; 
  }

  // Метод index буде обробляти запити користувачів
  public function index()
  {  
    $products = ProductModel::all(); 
    View::render('product.index', compact('products'));
  }

  public function show($id)
  {
      View::render('product.show');
  }
}
