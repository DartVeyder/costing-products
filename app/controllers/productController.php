<?php
class ProductController
{
  // Метод index буде обробляти запити користу вачів
  public function index()
  {
    $products = ProductModel::all(['delete_at  IS NULL']);
    View::render('product.index', compact('products'));
  }

  /*public function show($id)
  { 

    $data['product'] = ProductModel::find($id);
    $data['product_costs'] = ProductCostModel::allJoin(
      ['id', 'quantity', 'total_cost'], 
      ['product_id' => $id], 
      [
        ['table' => 'costs',  'on' => ['with' => 'cost_id', 'on' => 'id']],
      ],
      ['costs.name' => 'name', 'costs.unit_cost' => 'unit_cost' ]
    ); 
  //  Helper::dd($data);
    View::render('product.costs.index', $data);
  }*/

  public function store(){ 
    ProductModel::create($_POST);
    redirect('/products');
  }

  public function delete($id){ 
    ProductModel::softDelete(["id = $id"]);
    redirect('/products');
  }
  
}
