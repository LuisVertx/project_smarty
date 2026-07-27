<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ArticleController;

$id = (int)($_GET['id'] ?? 0);

$controller = new ArticleController();
$controller->show($id);