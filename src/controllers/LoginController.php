<?php

namespace controllers;

include_once('/var/www/html/controllers/ViewInterface.php');
include_once('/var/www/html/models/Usuarios.php');

use models\Usuarios;

/**
 * Manage the login form page
 * 
 * @author Luis Pardiñas
 *
 */
class LoginController implements \ViewInterface
{

    private $usuarios;
    private $session;

    /**
     * Construct of the class 
     */
    public function __construct()
    {
        $this->usuarios = new Usuarios(USERS_FILE);
        $this->session = new SessionsController();
    }

    /**
     * Send the information to start a new user session 
     */
    public function login()
    {
        $this->session->start($_POST['username']);
        header("Location: index.php?q=movies");
    }

    /**
     * Send to call the logout 
     */
    public function logout()
    {
        $this->session->abort();
    }

    /**
     * Validate the information submitted by the user.
     * Return errors if exists. 
     *
     * @return array
     */
    public function validate()
    {
        $errors = [];
        $exists = false;
        if (isset($_POST['username'])) {
            $exists = $this->usuarios->verifyExistence($_POST['username']);
            if (!$exists) {
                $errors['username'] = "Username doesn't exists";
            }
        } else {
            $errors['username'] = "Username can't be empty";
        }
        if (
            $exists
            && isset($_POST['password'])
        ) {
            $password = $this->usuarios->getPassword($_POST['username'] );
            if ($password == $_POST['password']) {
                $this->login();
            } else {
                $errors['password'] = "Password incorrect";
            }
        } elseif (!isset($_POST['password'])) {
            $errors['password'] = "Password can't be empty";
        }
        return ['errors' => $errors];
    }

    /**
     * Processes information and call the view
     */
    public function set()
    {
        $errors = [];
        $title = "Login";
        if (
            isset($_POST['action'])
            && $_POST['action'] == 'login'
        ) {
            $info = $this->validate();
            $errors = $info['errors'];
        }
        if (
            isset($_POST['action'])
            && $_POST['action'] == 'logout'
        ) {
            $this->logout();
        }
        include_once('/var/www/html/views/login.php');
    }
}
