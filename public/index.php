<?php

require_once __DIR__ . './../vendor/autoload.php';

use app\controllers\AppController;
use app\controllers\UserController;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [AppController::class, 'home']);
$app->router->get('/about', [AppController::class, 'about']);

// User routes
$app->router->get('/admin', [UserController::class, 'dashboard']);
$app->router->get('/admin/profile/{id:\d+}', [UserController::class, 'profile']);
$app->router->get('/login', [UserController::class, 'login']);
$app->router->post('/login', [UserController::class, 'login']);
$app->router->get('/register', [UserController::class, 'register']);
$app->router->post('/register', [UserController::class, 'register']);

$app->run();