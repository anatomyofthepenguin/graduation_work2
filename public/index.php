<?php

require '../vendor/autoload.php';
require '../controllers/UserController.php';
require '../config/orm_settings.php';
require '../models/File.php';
require '../models/User.php';

use Controller\UserController;

session_start();

$currentUrl = strtolower($_SERVER["REQUEST_URI"]);

$splitUrl = explode('/', $currentUrl);

$userController = new UserController();

if ($currentUrl === "/") {
    $userController->indexAction();
} elseif ($splitUrl[1] === "user") {
    $action = $splitUrl[2] . "Action";

    if (method_exists($userController, $action)) {
        $arg = $splitUrl[3] ?? false;
        $userController->$action($arg);
    } else {
        error404();
    }
} else {
    error404();
}

function error404()
{
    header("HTTP/1.1 404 Not Found");
}
