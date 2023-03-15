<?php
    // Додаємо маршрути 
    // Контролер "products"
    $router->get('/', 'ProductController@index'); 
    $router->mount('/products', function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->get('/{id}', 'ProductController@show');
    });

    $router->get('/expense', 'ExpenseController@index');