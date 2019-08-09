<?php

require '../controllers/UserController.php';
require '../models/DB.php';

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
} elseif ($splitUrl[1] === "file") {

} else {
    error404();
}

function error404()
{
    header("HTTP/1.1 404 Not Found");
}
