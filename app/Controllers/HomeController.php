<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;

class HomeController
{
    public function index(): void
{
    $db = \App\Core\Database::getInstance();

    $categories = $db->fetchAll("
        SELECT DISTINCT c.*
        FROM categories c
        INNER JOIN post_category pc
            ON pc.category_id = c.id
        ORDER BY c.title
    ");

    foreach ($categories as &$category) {

        $category['posts'] = $db->fetchAll("
            SELECT p.*
            FROM posts p
            INNER JOIN post_category pc
                ON pc.post_id = p.id
            WHERE pc.category_id = ?
            ORDER BY p.created_at DESC
            LIMIT 3
        ", [$category['id']]);

    }

    $view = new View();

    $view->render(
    'home.tpl',
    [
        'title' => 'Главная',
        'categories' => $categories
    ]
);
}
}