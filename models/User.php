<?php

namespace Models;

class User
{
    protected $errors;
    /* @var $db \PDO*/
    protected $db;

    const ERROR_EMPTY_FIELD = 1;
    const ERROR_FILE_UPLOAD = 2;
    const ERROR_INCORRECT_AGE = 3;
    const ERROR_USER_EXIST = 4;
    const ERROR_USER_NOT_FOUND = 5;
    const ERROR_PASSWORD_CONFIRM = 6;

    public function __construct()
    {
        $this->db = DB::getConnect();
    }

    public function getUserByLogin(string $login)
    {
        $query = "SELECT * FROM users WHERE login LIKE ?";
        $result = $this->db->prepare($query);
        $result->execute([$login]);
        $user = $result->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function getUsers(string $sortMethod = "ASC")
    {
        $query = "SELECT * FROM users ORDER BY age $sortMethod";
        $result = $this->db->query($query);
        $users = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $users;
    }

    public function saveUserData(array $userData)
    {
        $userData = $this->validateForm($userData);

        if (!empty($this->errors)) {
            return false;
        }

        $requestParams = '';
        foreach ($userData as $field => $value) {
            $requestParams .= "`$field` = :$field, ";
        }

        $requestParams = trim($requestParams, " ,");
        $request = "UPDATE users SET $requestParams " . "WHERE id=1";

        $result = $this->db->prepare($request);
        $result->execute($userData);
    }


    public function register(array $userData)
    {
        $userData["login"] = trim($userData["login"]);
        $userData["password"] = trim($userData["password"]);
        $userData["confirm_password"] = trim($userData["confirm_password"]);

        if (!$userData["login"] && !$userData["password"]) {
            $this->errors[] = self::ERROR_EMPTY_FIELD;
            return false;
        }
        if ($userData["password"] !== $userData["confirm_password"]) {
            $this->errors[] = self::ERROR_PASSWORD_CONFIRM;
            return false;
        }

        $exUser = $this->getUserByLogin($userData["login"]);

        if (!$exUser) {
            $password = $this->passwordHash($userData["password"]);
            $query = "INSERT INTO `users` SET `login` = ?, `password` = ?";
            $result = $this->db->prepare($query);
            $result->execute([$userData["login"], $password]);
        } else {
            $this->errors[] = self::ERROR_USER_EXIST;
            return false;
        }

        return $this->db->lastInsertId();
    }

    public function userAuth($userData)
    {
        $userData["login"] = trim($userData["login"]);
        $userData["password"] = trim($userData["password"]);

        if (!$userData["login"] && !$userData["password"]) {
            $this->errors[] = self::ERROR_EMPTY_FIELD;
            return false;
        }

        $exUser = $this->getUserByLogin($userData["login"]);
        $password = $this->passwordHash($userData["password"]);
        if ($exUser && ($exUser["password"] === $password)) {
            return $exUser["id"];
        } else {
            $this->errors[] = self::ERROR_USER_NOT_FOUND;
            return false;
        }
    }

    protected function validateForm($userData)
    {
        $validateArray = [];

        foreach ($userData as &$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        }

        $userData["name"] = strip_tags($userData["name"]);
        if (empty($userData["name"])) {
            $this->errors["name"] = self::ERROR_EMPTY_FIELD;
            return false;
        }
        $validateArray["name"] = $userData["name"];

        $userData["age"] = (int) $userData["age"] ;
        if ($userData < 1) {
            $this->errors[] = self::ERROR_INCORRECT_AGE;
            return false;
        }
        $validateArray["age"] = $userData["age"];

        if ($userData["avatar"]) {
            if ($userData['avatar']['error'] === UPLOAD_ERR_OK) {
                $fileExt = end(explode("/", $userData['avatar']["type"]));

                if ($fileExt === 'jpg' || $fileExt === 'jpeg' || $fileExt === 'png') {
                    $tmpFile = file_get_contents($userData["avatar"]["tmp_name"]);
                    $avatarPath = "/files/avatar/" . $userData["avatar"]["name"];
                    file_put_contents(__DIR__ . "/../public" . $avatarPath, $tmpFile);
                    $validateArray["avatar"] = $avatarPath;
                }

            } else {
                $this->errors[] = self::ERROR_FILE_UPLOAD;
                return false;
            }
        }

        if ($userData["descr"]) {
            $validateArray["descr"] = htmlspecialchars($userData["descr"]);
        }

        return $validateArray;
    }

    protected function passwordHash(string $password)
    {
        return sha1($password . "q32ty") ;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}