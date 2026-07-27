<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Category
{
    public static function all(): array
    {
        $db = Database::connect();

        $sql = "
            SELECT *
            FROM categories
            ORDER BY title
        ";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): array|false
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT *
            FROM categories
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function withLatestPosts(int $limit = 3): array
    {
        $db = Database::connect();

        $stmt = $db->query("
            SELECT c.id, c.title, c.description
            FROM categories c
            WHERE EXISTS (
                SELECT 1
                FROM post_category pc
                WHERE pc.category_id = c.id
            )
            ORDER BY c.title
        ");

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as &$category) {
            $category['posts'] = Post::latestByCategory((int)$category['id'], $limit);
        }

        unset($category);

        return $categories;
    }
}