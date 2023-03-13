<?php
class ProductController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {  
    View::render('product.index', ['name' => 'Admin']);
  }
}
