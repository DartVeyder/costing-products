<?php
class ProductController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {  
    View::render('product.index');
  }

  public function show($id)
  {
    View::render('product.show');
  }
}
