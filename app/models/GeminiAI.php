<?php

class GeminiAI {
    public function __construct() {}

    public function generate(string $movieTitle, ?float $rating): string {
            // Build the prompt 
            $prompt = "Write a friendly, concise review for the movie '{$movieTitle}'. "
                    . "The average viewer rating is {$rating} out of 5. "
                    . "Mention this rating naturally in your review.";

            // Prepare the API payload
            $data = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ];

            // Send API call using cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, GEMINI_API_URL . '?key=' . GEMINI_API_KEY);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);

            if ($response === false) {
                return 'Error in reaching service.';
            }

            curl_close($ch);

            // Parse response
            $result = json_decode($response, true);
            
            return $result['candidates'][0]['content']['parts'][0]['text'] 
                ?? 'AI could not generate a review at this time.';
        }
}
