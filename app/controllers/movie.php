<?php

class Movie extends Controller {
    public function index() {
        // Get the list of rated titles from the DB
        $ratingModel = $this->model('Rating');
        $titles = $ratingModel->getRatedMovies();

        // Fetch each movie’s details from OMDB using their titles
        $omdb = $this->model('OMDB');
        $trendingMovies = [];
        foreach ($titles as $title) {
            $movie = $omdb->fetchByTitle($title);
            if ($movie) {
                $trendingMovies[] = $movie;
            }
        }

        // Render same view, and pass the movie list
        $this->view('movie/index', [
            'trendingMovies' => $trendingMovies
        ]);
    }
    

    public function search() {
        $title = trim($_GET['movie'] ?? '');
        if ($title === '') {
            header('Location: /movie');
            exit;
        }

        // instantiate model and call search method to call OMDB API and gets list of matching results
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

        // Fetch the full movie details via the OMDB model
        $movieModel = $this->model('OMDB');
        $movie = $movieModel->fetchByTitle($title);

        // fetch the ratings details for the movie
        $ratingModel = $this->model('Rating');
        $reviews = $ratingModel->getAllRatingsForMovie($title);
        $average = $ratingModel->getAverageRating($title);
        $count = $ratingModel->getTotalRatingsByMovie($title);

        // Calculate fallback rating using the IMDb (prorate to /5)
        $imdbRaw = $movie['imdbRating'] ?? null;
        $imdbNum = is_numeric($imdbRaw) ? (float)$imdbRaw : null;
        $imdbOutOfFive = $imdbNum !== null ? round($imdbNum / 2, 2) : null;

        $aiReview = null;
        if (isset($_GET['genAI'])) {
            $ratingForAI = $count > 0 ? $average : $imdbOutOfFive;
            // Load the GeminiAI model and call generate()
            $geminiModel = $this->model('GeminiAI');
            $aiReview = $geminiModel->generate($title, $ratingForAI);
        }

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        // Render the dynamic detail view
        $this->view('movie/detail', [
            'movie' => $movie,
            'flash' => $flash,
            'average' => $average,
            'count' => $count,
            'reviews' => $reviews,
            'aiReview' => $aiReview,
            'imdbOutOfFive' => $imdbOutOfFive,
            'generated'   => isset($_GET['genAI']),
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
}
