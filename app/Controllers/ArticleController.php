<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;

class ArticleController
{
    public function show(int $id): void
    {
        $db = Database::getInstance();

        $post = $db->fetch("
            SELECT *
            FROM posts
            WHERE id = ?
        ", [$id]);

        if (!$post) {
            http_response_code(404);
            exit('Post not found');
        }

        $categories = $db->fetchAll("
            SELECT c.*
            FROM categories c
            INNER JOIN post_category pc ON pc.category_id = c.id
            WHERE pc.post_id = ?
            ORDER BY c.title
        ", [$id]);

        $db->execute("
            UPDATE posts
            SET views = views + 1
            WHERE id = ?
        ", [$id]);

        $post['views'] = (int)$post['views'] + 1;

        $relatedPosts = $db->fetchAll("
            SELECT DISTINCT p.*
            FROM posts p
            INNER JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id IN (
                SELECT category_id
                FROM post_category
                WHERE post_id = ?
            )
            AND p.id <> ?
            ORDER BY p.created_at DESC, p.id DESC
            LIMIT 3
        ", [$id, $id]);

        $view = new View();

        $view->render('article.tpl', [
            'title' => $post['title'],
            'post' => $post,
            'categories' => $categories,
            'primaryCategory' => $categories[0] ?? null,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}