<?php

include_once('/var/www/html/controllers/viewInterface.php');

/**
 * Register inferface
 * 
 * @author Luis Pardiñas
 *
 */
interface RegisterInterface extends ViewInterface
{
    /**
     * Register function definition
     * 
     * @param string $username
     * @param string $email
     * @param string $phone
     * @param string $password
     */
    public function register(string $username, string $email, string $phone, string $password);
}
