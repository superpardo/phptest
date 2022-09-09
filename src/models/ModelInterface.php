<?php

/**
 * CRUD interface
 * 
 * @author Luis Pardiñas
 *
 */
interface ModelInterface
{
    /**
     * Save json data in specific file
     * 
     * @param array $json
     */
    public function create(array $json);

    /**
     * Read all the information from specific json file 
     */
    public function read();

    /**
     * Update information from specific json file 
     */
    public function update();

    /*
     * Delete information from specific json file
     */
    public function delete();
}
