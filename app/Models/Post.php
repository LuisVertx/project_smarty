<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Post
{
    public static function latest(int $limit = 3): array
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT *
            FROM posts
            ORDER BY created_at DESC
            LIMIT ?
        ");

        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): array|false
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT *
            FROM posts
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function latestByCategory(int $categoryId, int $limit = 3): array
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT p.*
            FROM posts p
            INNER JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = :category_id
            ORDER BY p.created_at DESC, p.id DESC
            LIMIT :limit
        ");

        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}