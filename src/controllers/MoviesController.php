<?php

namespace controllers;

include_once('/var/www/html/models/Movies.php');
include_once('/var/www/html/controllers/ApiController.php');

use models\Movies;
use controllers\ApiController;

/**
 * Manage the list of movies page
 * 
 * @author Luis Pardiñas
 *
 */
class MoviesController
{
    private $movies;
    private $api;

    /**
     * Construct of the class. 
     */
    public function __construct()
    {
        $this->movies = new Movies(MOVIES_FILE);
    }

    /**
     * Update the list of movies
     * 
     * @param string $category
     */
    public function update(string $category)
    {
        $this->api = new ApiController($category);
        $this->api->getResults();
    }

    /**
     * Contains the logic of the search.
     * Returns an array of movies.
     * 
     * @return array
     */
    public function search()
    {
        $movies = $this->movies->read();
        $movie_title = $_POST['movie_title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $sort = $_POST['sort'];
        $order = $_POST['order'];
        if ($movie_title != '') {
            $aux_search_movies = [];
            foreach ($movies AS $movie) {
                if (stripos($movie->title, $movie_title ) !== false) {
                    $aux_search_movies[] = $movie;
                }
            }
            $movies = $aux_search_movies;
        }
        if (
            $start != ''
            && $end != ''
        ) {
            $aux_search_movies = [];
            foreach ($movies AS $movie) {
                if (
                    $movie->year >= $start
                    && $movie->year <= $end
                ) {
                    $aux_search_movies[] = $movie;
                }
            }
            $movies = $aux_search_movies;
        }
        if ($sort == 'year') {
            $column = array_column($movies, 'year');
            $sort_type = SORT_NUMERIC;
        } else {
            $column = array_column($movies, 'title');
            $sort_type = SORT_STRING;
        }
        if ($order == 'asc') {
            $order_type = SORT_ASC;
        } else {
            $order_type = SORT_DESC;
        }
        array_multisort($column, $order_type, $sort_type, $movies);
        return $movies;
    }

    /**
     * Validate the information submitted by the user.
     * Return an array of errors if exists.
     * 
     * @return array
     */
    public function validate(){
        $errors = [];
        $start = $_POST['start'];
        $end = $_POST['end'];
        if (
            $start == ''
            && $end != ''
        ) {
            $errors['years'] = "Start year can't be empty";
        }
        if (
            $start != ''
            && $end == ''
        ) {
            $errors['years'] = "End year can't be empty";
        }
        return $errors;
    }

    /**
     * Processes information and call the view
     */
    public function set()
    {
        $title = "Movies";
        $movie_title = '';
        $start = '';
        $end = '';
        $sort = 'title';
        $order = 'desc';
        $movies = [];
        $errors = [];
        if (
            isset( $_POST['action'] )
            && $_POST['action'] == 'update'
        ) {
            if ($_POST['category'] != '') {
                $this->update($_POST['category']);
            }
        }
        if (
            isset($_POST['action'])
            && $_POST['action'] == 'search'
        ) {
            $errors = $this->validate();
            $movie_title = $_POST['movie_title'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $sort = $_POST['sort'];
            $order = $_POST['order'];
            if (empty( $errors )) {
                $movies = $this->search();
            }
        } else {
            $movies = $this->movies->read();
        }
        include_once('/var/www/html/views/movies.php');
    }
}
