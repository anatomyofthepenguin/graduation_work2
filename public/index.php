<?php

require '../controllers/UserController.php';
require '../models/DB.php';
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
        $userController->$action();
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
