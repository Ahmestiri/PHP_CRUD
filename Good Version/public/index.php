<?php
    //Import Autoloader and the 2 classes
    require_once __DIR__.'/../vendor/autoload.php   ';
    use app\controllers\ProductController;
    use app\Router;
    //Initialisation
    $router = new Router();
    //Configuration of routes
    $router -> get('/',[ProductController::class, 'index']);
    $router -> get('/crud 1',[ProductController::class, 'index']);
    $router -> get('/crud 1/create',[ProductController::class, 'create']);
    $router -> post('/crud 1/create',[ProductController::class, 'create']);
    $router -> get('/crud 1/update',[ProductController::class, 'update']);
    $router -> post('/crud 1/update',[ProductController::class, 'update']);
    $router -> post('/crud 1/delete',[ProductController::class, 'delete']);
    //Detect which route and execute its function
    $router -> resolve();
?>