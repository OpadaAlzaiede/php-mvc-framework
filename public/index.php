<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application(rootDirectory: dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'create']);
$app->router->post('/contact', [SiteController::class, 'store']);

$app->router->get('/login', [AuthController::class, 'renderLogin']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'renderRegister']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();