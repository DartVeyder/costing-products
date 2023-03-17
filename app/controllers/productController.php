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

    $data['product'] = ProductModel::find($id);
    $data['product_costs'] = ProductCostModel::allJoin(
      ['id', 'unit_cost', 'quantity', 'total_cost'], 
      ['product_id' => $id], 
      [
        ['table' => 'costs',  'on' => ['with' => 'cost_id', 'on' => 'id']],
      ],
      ['costs.name' => 'cost_name' ]
    ); 
    View::render('product.show', $data);
  }

  public function store(){ 
    ProductModel::create($_POST);
    redirect('/products');
  }

  public function delete($id){ 
    ProductModel::delete(["id = $id"]);
    redirect('/products');
  }
}
