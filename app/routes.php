<?php
    // Додаємо маршрути 
    $router->get('/', 'ProductController@index'); 
    $router->mount('/products', function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->get('/{id}', 'ProductController@show');
        $router->post('/', 'ProductController@store');
        $router->delete('/(\d+)', 'ProductController@delete');
    });
    $router->mount('/costs', function () use ($router) {
        $router->get('/', 'CostController@index');
        $router->post('/', 'CostController@store');
        $router->delete('/(\d+)', 'CostController@delete');
    });

    