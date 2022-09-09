<?php

namespace models;

include_once('/var/www/html/models/Json.php');

use models\Json;

/**
 * Manage the json file for the movie list
 * 
 * @author Luis Pardiñas
 *
 */
class Movies extends Json
{

    /**
     * Verify the existence of the movies in the list
     * 
     * @param string $id
     * @return boolean
     */
    public function verifyExistence(string $id)
    {
        $data = $this->read();
        if ($data) {
            foreach ($data AS $d) {
                if ($d->id == $id) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Receive the information that will be added in the movie list json file.
     * Save the information in the json file. 
     * 
     * @param string $id
     * @param string $title
     * @param int $year
     * @param string $type
     * @param string $poster
     */
    public function createMovie(string $id, string $title, int $year, string $type, string $poster)
    {
        $json = [
            'id' => $id,
            'title' => $title,
            'year' => $year,
            'type' => $type,
            'poster' => $poster
        ];
        $this->create($json);
    }
}
