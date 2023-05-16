<?php
    // Додаємо маршрути 
    $router->get('/', 'ProductController@index'); 
    $router->mount('/products', function () use ($router) {
        $router->get('/', 'ProductController@index');
        //$router->get('/(\d+)/', 'ProductController@show');
        $router->post('/', 'ProductController@store');
        $router->get('/(\d+)/edit', 'ProductController@edit');
        $router->patch('/(\d+)', 'ProductController@update');
        $router->delete('/(\d+)', 'ProductController@delete');

        $router->mount('/(\d+)', function () use ($router) {
            $router->get('/costs', 'ProductCostController@index'); 
            $router->post('/costs', 'ProductCostController@store'); 
            $router->delete('/costs/(\d+)', 'ProductCostController@delete');
            $router->get('/costs/(\d+)/edit', 'ProductCostController@edit'); 
            $router->patch('costs/(\d+)/edit/update', 'ProductCostController@update');
        });

        $router->mount('/types', function () use ($router) {
            $router->get('/', 'ProductTypeController@index');
            $router->get('/(\d+)/edit', 'ProductTypeController@edit'); 
            $router->post('/', 'ProductTypeController@store'); 
            $router->delete('/(\d+)', 'ProductTypeController@delete'); 
            
            $router->mount('/(\d+)/attributes', function () use ($router) {
                $router->get('/', 'ProductTypeAttributeController@index');
                $router->patch('/', 'ProductTypeAttributeController@update');
            });
            
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
        $router->get('/(\d+)/edit', 'CostController@edit');
        $router->patch('/(\d+)/edit/update', 'CostController@update');

        $router->mount('/types', function () use ($router) {
            $router->get('/', 'CostTypeController@index');
            $router->post('/', 'CostTypeController@store');
            $router->delete('/(\d+)', 'CostTypeController@delete');  
        });
    });

    
 


    