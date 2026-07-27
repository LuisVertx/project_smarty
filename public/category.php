<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\CategoryController;

$id = (int)($_GET['id'] ?? 0);

$controller = new CategoryController();
$controller->show($id);