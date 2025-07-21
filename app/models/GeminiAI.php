<?php

class GeminiAI {
    public function __construct() {}

    public function generate(string $movieTitle, ?float $rating): string {
        return 'Analyzing ' . $movieTitle . ' with average rating of ' . $rating . ' out of 5. AI review coming soon!';
    }
}
