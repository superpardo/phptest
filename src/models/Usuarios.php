<?php

namespace models;

include_once('/var/www/html/models/Json.php');

use models\Json;

/**
 * Manage the json file of registered users
 * 
 * @author Luis Pardiñas
 *
 */
class Usuarios extends Json
{

    /**
     * Return the password of specific user
     * 
     * @param string $username
     * @return array
     */
    public function getPassword(string $username)
    {
        $data = $this->read();
        foreach ($data AS $d) {
            if ($d->username == $username) {
                return $d->password;
            }
        }
        return [];
    }

    /**
     * Verify existence of user in the list
     * 
     * @param string $username
     * @return boolean
     */
    public function verifyExistence(string $username)
    {
        $data = $this->read();
        foreach ($data AS $d) {
            if ($d->username == $username) {
                return true;
            }
        }
        return false;
    }

    /**
     * Receive the information that will be added in the users json file.
     * Save the information in the json file.
     *  
     * @param string $username
     * @param string $email
     * @param string $phone
     * @param string $password
     */
    public function createUser(string $username, string $email, string $phone, string $password)
    {
        $json = [
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'password' => $password
        ];
        $this->create($json);
    }
}
