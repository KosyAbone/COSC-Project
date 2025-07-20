<?php

class Movie {
    public static function fetchByTitle(string $title): ?array {
        // build the url
        $url = OMDB_API_URL
             . '?apikey=' . urlencode(OMDB_API_KEY)
             . '&t=' . urlencode($title);

        // fetch the JSON response
        $json = @file_get_contents($url);
        if ($json === false) {
            // network error or invalid URL
            return null;
        }

        // then decode and verify
        $data = json_decode($json, true);
        return (isset($data['Response']) && $data['Response'] === 'True')
             ? $data
             : null;
    }
}