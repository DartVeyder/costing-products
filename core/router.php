<?php
    use Bramus\Router\Router;
// Створюємо екземпляр роутера Bramus
    $router = new Router();

    // Встановлюємо базовий шлях
    $router->setBasePath('/costing');

    // Додаємо маршрути 
  //  $router->get('/home', 'HomeController@index');
    include ROOT_DIR . '/app/routes.php';
    // Запускаємо роутер
    $router->run();
    // Створюємо клас HomeController
  
?>