<?php

class Movie extends Controller {
    public function index() {
        $this->view('movie/index');
    }

    public function search() {
        $title = trim($_GET['movie'] ?? '');
        if ($title === '') {
            header('Location: /movie');
            exit;
        }

        // instantiate the model and call the search method which calls OMDB API and gets list of matching results
        $movieModel = $this->model('OMDB');
        $results = $movieModel->search($title);

        // render the view and pass down the results and the query to the view
        $this->view('movie/index', [
            'query' => $title,
            'results' => $results
        ]);
    }

    public function detail() {
        $title = trim($_GET['movie'] ?? '');
        if ($title === '') {
            header('Location: /movie');
            exit;
        }

        // Fetch the full details via the OMDB model
        $movieModel = $this->model('OMDB');
        $movie = $movieModel->fetchByTitle($title);

        // Load the GeminiAI model and call generate()
        $geminiModel = $this->model('GeminiAI');
        $aiReview = $geminiModel->generate($title);

        // fetch the ratings detail for the movie
        $ratingModel = $this->model('Rating');
        $reviews = $ratingModel->getAllRatingsForMovie($title);
        $average = $ratingModel->getAverageRating($title);
        $count = $ratingModel->getTotalRatingsByMovie($title);

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        // Render the dynamic detail view
        $this->view('movie/detail', [
            'movie' => $movie,
            'flash' => $flash,
            'average' => $average,
            'count' => $count,
            'reviews' => $reviews,
            'aiReview' => $aiReview
        ]);
    }

    public function rate() {
        $title  = trim($_POST['movie']  ?? '');
        $rating = (int) ($_POST['rating'] ?? 0);

        // validate to ensure its between 1 to 5
        if ($title !== '' && $rating >= 1 && $rating <= 5) {
            $ratingModel = $this->model('Rating');
            $ratingModel->rate($title, $rating);
            $_SESSION['flash'] = "Thank you! You rated “{$title}” {$rating}/5.";
        } else {
            $_SESSION['flash'] = 'Your rating must be an integer from 1 to 5.';
        }

        header('Location: /movie/detail?movie=' . urlencode($title));
        exit;
    }

    // public function review() {
    //     $title = trim($_GET['movie'] ?? '');

    //     if ($title === '') {
    //         header('Location: /movie');
    //         exit;
    //     }

    //     // Load the GeminiAI model and call generate()
    //     $aiModel = $this->model('GeminiAI');
    //     $review = $aiModel->generate($title);

    //     // print for now to check if its wired up correctly
    //     print_r($review);
    //     exit;
    // }

}
