<?php
class Movie extends Controller {
    
    public function index() {
        // simply rendering the search page
        $this->view('movie/search');
    }
}
