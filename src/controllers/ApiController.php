<?php

namespace controllers;

include_once('/var/www/html/models/Movies.php');

use models\Movies;

/**
 * Manage the use of the api of omdb 
 * 
 * @author Luis Pardiñas
 *
 */
class ApiController
{
    private $api_url;
    private $category;
    private $data;
    private $movies;

    /**
     *  Construct of the class
     * 
     * @param string $category
     */
    public function __construct(string $category)
    {
        $this->movies = new Movies(MOVIES_FILE);
        $this->api_url = api_url;
        $this->category = $category;
    }

    /**
     * Create the url to make api call.
     * Return the url.
     * 
     * @return string
     */
    private function createUrl()
    {
        return $this->api_url . '&s=' . $this->category;
    }

    /**
     *  Get the result of the api call
     */
    public function getResults()
    {
        $json = file_get_contents( $this->createUrl() );
        $this->data = json_decode($json);
        if (isset($this->data->Search)) {
            $this->data = $this->data->Search;
            $this->saveResults();
        }
    }

    /**
     *  Save the result of the api call in a json file.
     *  Verify that the movie doesn't exists before save.
     */
    private function saveResults(){
        foreach ($this->data AS $d) {
            if (!$this->movies->verifyExistence($d->imdbID)) {
                $id = $d->imdbID;
                $title = $d->Title;
                $year = (int) $d->Year;
                $type = $d->Type;
                $poster = $d->Poster;
                $this->movies->createMovie($id, $title, $year, $type, $poster);
            }
        }
    }
}
