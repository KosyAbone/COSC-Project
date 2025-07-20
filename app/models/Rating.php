<?php

class Rating {

    public function __construct() {
        
    }

    public function rate(string $movieTitle, int $rating): bool {
        
        $db = db_connect();
        $stmt = $db->prepare(
            'INSERT INTO ratings 
                (movie_title, rating, user_id, created_at)
             VALUES 
                (:movie_title, :rating, :user_id, NOW())'
        );

        // grab the logged‑in user ID, or NULL for guest
        $userId = $_SESSION['user_id'] ?? null;

        return $stmt->execute([
            ':movie_title' => $movieTitle,
            ':rating'      => $rating,
            ':user_id'     => $userId,
        ]);
    }

}
