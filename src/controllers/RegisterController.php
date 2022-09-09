<?php

namespace controllers;

include_once('/var/www/html/controllers/RegisterInterface.php');
include_once('/var/www/html/models/Usuarios.php');

use registerInterface;
use models\usuarios;

/**
 * Manage the register page form
 * 
 * @author Luis Pardiñas
 *
 */
class RegisterController implements RegisterInterface
{
    private $usuarios;

    /**
     * Construct of the class 
     */
    public function __construct()
    {
        $this->usuarios = new Usuarios(USERS_FILE);
    }

    /**
     * Call the function for save the new user
     * 
     * @param string $username
     * @param string $email
     * @param string $phone
     * @param string $password
     */
    public function register(string $username, string $email, string $phone, string $password){
        $this->usuarios->createUser($username, $email, $phone, $password);
    }

    /**
     * Validate the information submitted by the user and the existence of the user.
     * 
     * @return array|array
     */
    public function validate()
    {
        $errors = [];
        $data = [
            'username' => '',
            'phone' => '',
            'email' => '',
            'password' => ''
        ];

        if (isset($_POST['username'])) {
            $data['username'] = $_POST['username'];
            if (preg_match("/\d/", $data['username'])) {
                $errors['username'] = "Username can't contains numbers";
            }
            $exists = $this->usuarios->verifyExistence($data['username']);
            if ($exists) {
                $errors['username'] = "Username already exists";
            }
        } else {
            $errors['username'] = "Username can't be empty";
        }

        if (isset( $_POST['phone'])) {
            $data['phone'] = $_POST['phone'];
            if (preg_match("/^\+[1-9][0-9]{7,11}$/", $data['phone'])) {

            } else {
                $errors['phone'] = "Phone must start with +";
            }
        } else {
            $errors['phone'] = "Phone number can't be empty";
        }

        if (isset($_POST['email'])) {
            $data['email'] = $_POST['email'];
            if (preg_match("/^\S+@\S+\.[a-z]+$/", $data['email'])) {

            } else {
                $errors['email'] = "E-mail is not valid";
            }
        } else {
            $errors['email'] = "E-mail can't be empty";
        }

        if (isset($_POST['password'])) {
            $data['password'] = $_POST['password'];
            if (preg_match("/\S*(?=\S{6,})(?=\S*[A-Z])(?=\S*[*-.])\S*/", $data['password'])) {

            } else {
                $errors['password'] = "Password must be at least 6 characters length, contains at least one uppercase letter and any of this characters * - . ";
            }
        } else {
            $errors['password'] = "Password can't be empty";
        }
        return ['errors' => $errors, 'data' => $data];
    }

    /**
     * Processes information and call the view
     */
    public function set()
    {
        $username = '';
        $phone = '';
        $email = '';
        $password = '';
        $title = "Register";
        $errors = [];
        if (
            isset($_POST['action'])
            && $_POST['action'] == 'register'
        ){
            $info = $this->validate();
            $errors = $info['errors'];
            $data = $info['data'];
            $username = $data['username'];
            $phone = $data['phone'];
            $email = $data['email'];
            $password = $data['password'];
            if (empty($errors)) {
                $this->register($username, $email, $phone, $password);
                header("Location: index.php?q=login");
            }
        }
        include_once('/var/www/html/views/register.php');
    }
}
