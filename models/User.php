<?php

namespace Models;

class User
{
    protected $authUser;
    protected $errors;

    public function getUserById(int $id)
    {
        /* @var $db \PDO*/
        $db = DB::getConnect();
        $result = $db->query("SELECT * FROM users WHERE id = " . $id);
        $user = $result->fetch();

        return $user;
    }

    public function getUserByName(string $name)
    {
        /* @var $db \PDO*/
        $db = DB::getConnect();
        $result = $db->prepare("SELECT * FROM users WHERE name LIKE ?");
        $result->execute([$name]);
        $user = $result->fetch();
        return $user;
    }

    public function register($userData)
    {
        $userData["name"] = trim($userData["name"]);
    }

    public function validate($userData)
    {
        foreach ($userData as &$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        }

        $userData["name"] = strip_tags($userData["name"]);
        if (empty($userData["name"])) {
            $error = "Пустое имя";
            return false;
        }

        $userData["password"] = strip_tags($userData["name"]);
        if (empty($userData)) {
            $error = "Пустое имя";
            return false;
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}