<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;

class CategoryController
{
    public function show(int $id): void
    {
        $db = Database::getInstance();

        // Категория
        $category = $db->fetch(
            "SELECT * FROM categories WHERE id = ?",
            [$id]
        );

        if (!$category) {
            http_response_code(404);
            exit('Category not found');
        }

        // Все статьи категории
        $posts = $db->fetchAll(
            "SELECT p.*
             FROM posts p
             INNER JOIN post_category pc
                ON pc.post_id = p.id
             WHERE pc.category_id = ?
             ORDER BY p.created_at DESC",
            [$id]
        );

        $view = new View();

        $view->render('category.tpl', [
            'title' => $category['title'],
            'category' => $category,
            'posts' => $posts
        ]);
    }
}