<?php

namespace controllers;

/**
 * It manages the views that have to be seen depending on the page that the user is visiting.
 * 
 * @author Luis Pardiñas
 *
 */
class RouteController
{
    private $section = '';

    /**
     * Construct of the class.
     * Set the section that user is going to visit.
     */
    public function __construct()
    {
        $session = new SessionsController();
        $q = 'login';
        $action = '';
        $entra = true;
        if (
            isset($_GET['q'])
            || isset($_POST['q']) 
        ) {
            $q = isset($_POST['q']) ? $_POST['q'] : $_GET['q']; 
        }
        if (
            $q == 'login'
            && isset($_POST['action'])
            && $_POST['action'] == 'logout'
        ) {
            $entra = false;
        }
        if (
            $session->exists()
            && $entra
        ) {
            $q = 'movies';
        }
        $this->section = $q;
    }

    /**
     * Call the controller of specific page.
     */
    public function view()
    {
        if ($this->section != '') {
            include_once( '/var/www/html/controllers/' . ucfirst($this->section) . 'Controller.php' );
            $controller_name = 'controllers\\' . $this->section . 'Controller';
            $controller = new $controller_name();
            $controller->set();
        }
    }
}
