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

        $users = User::all();

        include '../views/list.php';
    }

    public function filesAction()
    {
        if (!$_SESSION["user_id"]) {
            header('Location: /');
            return false;
        }

        $userId = $_SESSION["user_id"];
        if ($userId) {
            $userFiles = File::where("user_id", $_SESSION["user_id"])->get();
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

    public function addAction()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $checkData = User::checkData($_POST, ["login", "avatar"]);

            if ($checkData["error"] === User::ERROR_EMPTY_REQUIRED) {
                $errorMessage = "Поля логин и аватар обязательны!";
            } else {
                $exUser = User::where('login', 'like', $checkData["login"])->first();
                if (!$exUser) {
                    User::create($checkData);
                    header('Location: /user/list');
                    return true;
                } else {
                    $errorMessage = "Пользователь существует";
                }
            }


        }

        include '../views/adduser.php';
        return true;
    }

    public function editAction(int $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            header("HTTP/1.1 404 Not Found");
            return false;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $checkData = User::checkData($_POST);

            if (!empty($checkData)) {
                User::where("id", $userId)->update($checkData);
                header('Location: /user/list');
                return true;

            } else {
                $errorMessage = "Ни одно из полей не было обновлено, убедитесь в правильности заполнения";
            }
        }

        include '../views/edituser.php';
        return true;
    }
}
