<?php

namespace controllers;

/**
 * Manage the sessions
 * 
 * @author Luis Pardiñas
 *
 */
class SessionsController
{
    /**
     * Construc of the class 
     */
    public function __construct()
    {
        if (
            session_id() == ''
            || !isset($_SESSION)
            || session_status() === PHP_SESSION_NONE
        ) {
            ob_start();
            session_start();
        }
    }

    /**
     * Initiate the session of logged user 
     * 
     * @param string $username
     */
    public function start(string $username)
    {
        $_SESSION['username'] = $username;
    }

    /**
     * Verify existence of current logged user
     * 
     * @return boolean
     */
    public function exists()
    {
        if (
            session_id() != ''
            && isset($_SESSION)
            && session_status() === PHP_SESSION_ACTIVE
            && !empty( $_SESSION ) 
        ) {
            return true;
        }
        return false;
    }

    /**
     * Close the user session 
     */
    public function abort()
    {
        session_destroy();
    }
}
