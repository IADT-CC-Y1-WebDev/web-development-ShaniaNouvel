<?php

class Publishers {
    // Check if a relationship exists
    public static function exists($bookId, $publisherId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            // SELECT COUNT(*) as count
            // FROM game_platform
            // WHERE game_id = :game_id AND platform_id = :platform_id
            SELECT p.*
            FROM platforms p
            INNER JOIN game_platform gp ON p.id = gp.platform_id
            WHERE gp.game_id = :game_id
            ORDER BY p.name
        ");
        $stmt->execute([
            'game_id' => $bookId,
            'platform_id' => $publisherId
        ]);

        $row = $stmt->fetch();
        return $row['count'] > 0;
    }

    // Create a new game-platform relationship
    public static function create($bookId, $publisherId) {
        // Check if relationship already exists
        if (self::exists($bookId, $publisherId)) {
            return false;
        }

        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO game_platform (game_id, platform_id)
            VALUES (:game_id, :platform_id)
        ");

        return $stmt->execute([
            'game_id' => $bookId,
            'platform_id' => $publisherId
        ]);
    }

    // Delete a specific game-platform relationship
    public static function remove($bookId, $publisherId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM game_platform
            WHERE game_id = :game_id AND platform_id = :platform_id
        ");

        return $stmt->execute([
            'game_id' => $bookId,
            'platform_id' => $publisherId
        ]);
    }

    // Delete all platform relationships for a specific game
    public static function deleteByGame($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM game_platform
            WHERE game_id = :game_id
        ");
        return $stmt->execute(['game_id' => $bookId]);
    }
}
