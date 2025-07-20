<?php

class Rating {

    public function __construct() {
        // no setup needed
    }

    public function rate(string $movieTitle, int $rating): bool {
        // ensure user input is between 1–5 (integer check will be done in controller)
        if ($rating < 1 || $rating > 5) {
            return false;
        }

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
