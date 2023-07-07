<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Kang\Phpmvc\App\Router;
use Kang\Phpmvc\Config\Database;
use Kang\Phpmvc\Controller\HomeController;
use Kang\Phpmvc\Controller\UserController;

Database::getConnection('prod');

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

// Auth Controller
Router::add('GET', '/register', UserController::class, 'register', []);
Router::add('POST', '/register', UserController::class, 'postRegister', []);

Router::run();
