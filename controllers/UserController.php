<?php

namespace Controller;

use Models\File;
use Models\User;

class UserController
{
    public function indexAction()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($_POST['login'] && $_POST["password"]) {
                $user = new User();
                $exUser = $user->userAuth($_POST);
                if ($user->getErrors()[0] === 5) {
                    $errorMessage = "Пользователь Не найден";
                }
            } else {
                $errorMessage = "Пароль или логин пустые";
            }
        }
        if ($exUser) {
            $_SESSION["user_id"] = $exUser;
            header('Location: /user/list');
        } else {
            include '../views/index.php';
        }
    }

    public function formAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if ($_FILES["avatar"]) {
                $formData["avatar"] = $_FILES["avatar"];
            }

            $user = new User();
            $user->saveUserData($formData);

        }
        include '../views/form.php';
    }

    public function registerAction()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($_POST['login'] && $_POST["password"]) {
                $user = new User();
                $userId = $user->register($_POST);
                if ($user->getErrors()[0] === 4) {
                    $errorMessage = "Пользователь существует";
                } elseif ($user->getErrors()[0] === 6) {
                    $errorMessage = "Пароли не совпадают";
                }
            } else {
                $errorMessage = "Пароль или логин пустые";
            }
        }

        if ($userId) {
            $_SESSION["user_id"] = $userId;
            header('Location: /user/list');
        } else {
            include '../views/reg.php';
        }
    }
    public function listAction()
    {
        if (!$_SESSION["user_id"]) {
            header('Location: /');
            return false;
        }
        $user = new User();
        $users = $user->getUsers();

        include '../views/list.php';
    }

    public function filesAction()
    {
        if (!$_SESSION["user_id"]) {
            header('Location: /');
            return false;
        }
        $files = new File();
        $userId = $_SESSION["user_id"];
        if ($userId) {
            $userFiles = $files->getUserFiles($userId);
        }
        include '../views/filelist.php';
    }

    public function fileUpload()
    {
        $file = new File();
        $filesData = $_FILES;
        foreach ($filesData as $fileData) {
            $file->fileUpload($fileData);
        }
    }
}
