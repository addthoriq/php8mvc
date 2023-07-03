<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Kang\Phpmvc\App\Router;
use Kang\Phpmvc\Controller\AboutController;
use Kang\Phpmvc\Controller\HomeController;

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/about', AboutController::class, 'index');

Router::run();
