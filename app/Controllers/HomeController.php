<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Category;

class HomeController
{
    public function index(): void
    {
        $view = new View();

        $view->render('home.tpl', [
            'pageTitle' => 'Главная',
            'categories' => Category::withLatestPosts(3),
        ]);
    }
}