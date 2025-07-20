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

        // instantiate the model and call the fetch method which calls OMDB API
        $movieModel = $this->model('OMDB');
        $results = $movieModel->search($title);

        // print the array
        $this->view('movie/index', [
            'query' => $title,
            'results' => $results
        ]);
    }
}
