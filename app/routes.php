<?php
    // Додаємо маршрути 
    // Контролер "products"
    $router->get('/', 'ProductController@index');
    $router->get('/product', 'ProductController@index');
    $router->get('/product{id}', 'ProductController@show');
    
    $router->mount('/products', function () use ($router) {

        // Перегляд списку товарів
        $router->get('/', 'ProductController@index');
    
        // Перегляд товару за ID
        $router->get('/{id}', 'ProductController@show');
    });

    $router->get('/expense', 'ExpenseController@index');