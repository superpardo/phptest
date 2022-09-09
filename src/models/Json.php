<?php

namespace models;

include_once('/var/www/html/models/ModelInterface.php');

use modelInterface;

/**
 * Manage the json file
 * 
 * @author Luis Pardiñas
 *
 */
class Json implements ModelInterface
{
    protected $data;
    protected $file_route;

    /**
     * Construct of the class.
     * Sets the json file that will be managed.
     * If file doesn't exists create one.
     * 
     * @param string $file_route
     */
    public function __construct(string $file_route)
    {
        $this->file_route = $file_route;
        if (!is_file($this->file_route)) {
            file_put_contents($this->file_route, '');
        }
    }

    /**
     * Add new information in the json file.
     * 
     * @param array $json
     */
    public function create(array $json)
    {
        $data = $this->read();
        $data[] = $json;
        $file = fopen($this->file_route, 'w+');
        fwrite($file, json_encode($data));
        fclose($file);
    }

    /**
     * Return all the information from the json file.
     * 
     * @return array|mixed
     */
    public function read()
    {
        $data = [];
        $contenido = file_get_contents($this->file_route);
        if (!empty($contenido)) {
            $data = json_decode($contenido);
        }
        return $data;
    }

    /**
     * Update information from json file 
     */
    public function update()
    {

    }

    /**
     * Delete information from json file
     */
    public function delete()
    {

    }
}
