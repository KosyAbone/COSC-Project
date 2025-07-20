<?php

class OMDB {
    public function __construct() {
    }
    
    public function fetchByTitle(string $title): ?array {
        if (empty(OMDB_API_KEY)) {
            echo "ERROR: OMDB_API_KEY is empty!<br>";
            return null;
        }
        
        // build the url
        $url = OMDB_API_URL
             . '?apikey='. OMDB_API_KEY
             . '&t=' . urlencode($title);
        
        // fetch the JSON response
        $json = @file_get_contents($url);
        if ($json === false) {
            echo "Failed to fetch data from API<br>"; 
            return null;
        }

        // then decode and verify
        $data = json_decode($json, true);
        
        return (isset($data['Response']) && $data['Response'] === 'True')
             ? $data
             : null;
    }
}