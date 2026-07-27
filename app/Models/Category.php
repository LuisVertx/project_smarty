<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;

class CategoryController
{
    public function show(int $id): void
    {
        $db = Database::getInstance();

        $category = $db->fetch(
            "SELECT * FROM categories WHERE id = ?",
            [$id]
        );

        if (!$category) {
            http_response_code(404);
            exit('Category not found');
        }

        $sort = $_GET['sort'] ?? 'date';

        $sortMap = [
            'date' => 'p.created_at DESC, p.id DESC',
            'views' => 'p.views DESC, p.created_at DESC, p.id DESC',
        ];

        if (!isset($sortMap[$sort])) {
            $sort = 'date';
        }

        $page = (int)($_GET['page'] ?? 1);
        if ($page < 1) {
            $page = 1;
        }

        $perPage = 6;

        $totalRow = $db->fetch(
            "
            SELECT COUNT(*) AS total
            FROM posts p
            INNER JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = ?
            ",
            [$id]
        );

        $totalPosts = (int)($totalRow['total'] ?? 0);
        $totalPages = max(1, (int)ceil($totalPosts / $perPage));

        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $perPage;

        $posts = $db->fetchAll("
            SELECT p.*
            FROM posts p
            INNER JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = ?
            ORDER BY {$sortMap[$sort]}
            LIMIT {$perPage} OFFSET {$offset}
        ", [$id]);

        $view = new View();

        $view->render('category.tpl', [
            'title' => $category['title'],
            'category' => $category,
            'posts' => $posts,
            'sort' => $sort,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalPosts' => $totalPosts,
        ]);
    }
}