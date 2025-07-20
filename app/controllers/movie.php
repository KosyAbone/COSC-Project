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

        // Render the dynamic detail view
        $this->view('movie/detail', [
            'movie' => $movie
        ]);
    }
}
