<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\ArticleController;
use App\Controllers\CategoryController;

$route = $_GET['route'] ?? 'home';

switch ($route) {

    case 'article':
        (new ArticleController())->show((int)($_GET['id'] ?? 0));
        break;

    case 'category':
        (new CategoryController())->show((int)($_GET['id'] ?? 0));
        break;

    default:
        (new HomeController())->index();
        break;
}