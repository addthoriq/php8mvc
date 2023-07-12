<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Kang\Phpmvc\App\Router;
use Kang\Phpmvc\Config\Database;
use Kang\Phpmvc\Controller\HomeController;
use Kang\Phpmvc\Controller\UserController;
use Kang\Phpmvc\Middleware\MustLoginMiddleware;
use Kang\Phpmvc\Middleware\MustNotLoginMiddleware;

Database::getConnection('prod');

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

// Auth Controller
Router::add('GET', '/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::run();
