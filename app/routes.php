<?php
    // Додаємо маршрути 
    $router->get('/', 'ProductController@index'); 
    $router->mount('/products', function () use ($router) {
        $router->get('/', 'ProductController@index');
        //$router->get('/(\d+)/', 'ProductController@show');
        $router->post('/', 'ProductController@store');
        $router->delete('/(\d+)', 'ProductController@delete');

        $router->mount('/(\d+)', function () use ($router) {
            $router->get('/costs', 'ProductCostController@index'); 
            $router->post('/costs', 'ProductCostController@store'); 
            $router->delete('/costs/(\d+)', 'ProductCostController@delete');
        });

        $router->mount('/types', function () use ($router) {
            $router->get('/', 'ProductTypeController@index');
            $router->post('/', 'ProductTypeController@store'); 
            $router->delete('/(\d+)', 'ProductTypeController@delete'); 
        });

        $router->mount('/attributes', function () use ($router) {
            $router->get('/', 'ProductAttributeController@index'); 
            $router->post('/', 'ProductAttributeController@store'); 
            $router->delete('/(\d+)', 'ProductAttributeController@delete');
        });
    });
    
    $router->mount('/costs', function () use ($router) {
        $router->get('/', 'CostController@index');
        $router->post('/', 'CostController@store');
        $router->delete('/(\d+)', 'CostController@delete');
    });

    
 


    