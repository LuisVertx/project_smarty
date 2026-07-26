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
}