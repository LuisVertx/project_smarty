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
}