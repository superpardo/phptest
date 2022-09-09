<?php

require_once('controllers/RouteController.php');
require_once('controllers/SessionsController.php');
require_once("config/config.php");

use controllers\RouteController;
use controllers\SessionsController;

$route = new RouteController();
$route->view();

$session = new SessionsController();
