<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

Database::connect();

echo "Database connected successfully!";
use App\Models\Category;

echo "<pre>";

print_r(Category::all());

die();