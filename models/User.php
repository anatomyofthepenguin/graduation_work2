<?php

namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $errors;
    protected $guarded = ['id'];
    public $timestamps = false;

    const ERROR_EMPTY_FIELD = 1;
    const ERROR_FILE_UPLOAD = 2;
    const ERROR_INCORRECT_AGE = 3;
    const ERROR_USER_EXIST = 4;
    const ERROR_USER_NOT_FOUND = 5;
    const ERROR_PASSWORD_CONFIRM = 6;
    const ERROR_UPDATE_DATA = 7;
    const ERROR_EMPTY_REQUIRED = 8;

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
        $userId = $_SESSION["user_id"];

        $result = User::where("id", $userId)->update($userData);

        if (!$result) {
            $this->errors[] = self::ERROR_UPDATE_DATA;
        }

        return $result;
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

        $user = User::firstOrNew(['login' => $userData["login"]]);

        if (!$user->id) {
            $user->password = $userData["password"];
            $user->save();
        } else {
            $this->errors[] = self::ERROR_USER_EXIST;
            return false;
        }

        return $user->id;
    }

    public function userAuth($userData)
    {
        $userData["login"] = trim($userData["login"]);
        $userData["password"] = trim($userData["password"]);

        if (!$userData["login"] && !$userData["password"]) {
            $this->errors[] = self::ERROR_EMPTY_FIELD;
            return false;
        }

        $exUser =
            User::where('login', 'like', $userData["login"])->where('password', '=', $userData["password"])->first();
        if ($exUser) {
            return $exUser->id;
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

    public static function checkData(array $formData, array $requiredField = null)
    {
        $result = [];

        foreach ($formData as &$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        }

        $result["age"] = (int) $formData["age"];
        if ($result["age"] < 1) {
            unset($result["age"]);
        }

        if ($formData["descr"]) {
            $result["descr"] = htmlspecialchars($formData["descr"]);
        }

        if (filter_var($formData["avatar"], FILTER_VALIDATE_URL)) {
            $result["avatar"] = $formData["avatar"];
        }

        if ($formData["name"]) {
            $result["name"] = $formData["name"];
        }

        if ($formData["login"]) {
            $result["login"] = $formData["login"];
        }

        if (!$requiredField) {
            return $result;
        }

        foreach ($requiredField as $field) {
            if (!isset($result[$field])) {
                $result["error"] = self::ERROR_EMPTY_REQUIRED;
                break;
            }
        }
        return $result;
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