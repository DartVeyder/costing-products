<?php
class ExpenseController
{

  // Метод index буде обробляти запити користувачів
  public function index()
  {  
    View::render('expense.index');
  }
}
