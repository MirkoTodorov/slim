<?php
    require __DIR__.'/vendor/autoload.php';

    // use \App;

use App\Controllers\UserController;

$app = new App\Application();

    $c = $app->getContainer();
    $userController = new UserController($c['twig'], $c['userService']);

    // Routes

    // $app->get('/', UserController::class.':listUsers');
    $app->get('/', [$userController, 'listUsers']);

    $app->get('/user/create', [$userController, 'createDisplay']);
    $app->post('/user/create', [$userController, 'createUser']);
    
    $app->get('/user/edit/{id}', [$userController, 'editDisplay']);
    $app->post('/user/edit/{id}', [$userController, 'editUser']);

    $app->get('/user/delete/{id}', [$userController, 'deleteUser']);




    $app->run();