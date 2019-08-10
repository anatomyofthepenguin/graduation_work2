<?php

namespace Models;

class File
{
    const ERROR_EMPTY_FIELD = 1;
    const ERROR_FILE_UPLOAD = 2;
    const ERROR_INCORRECT_AGE = 3;
    /* @var $db \PDO*/
    protected $db;
    protected $errors;

    public function __construct()
    {
        $this->db = DB::getConnect();
    }

    public function getUserFiles(int $id)
    {
        $query = "SELECT * FROM files WHERE user_id = $id";
        $result = $this->db->query($query);
        $files = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $files;
    }

    public function fileUpload(array $file)
    {
        $tmpFile = file_get_contents($file["userfile"]["tmp_name"]);
        $filePath = "/files/" . $file["userfile"]["name"];
        file_put_contents(__DIR__ . "/../public" . $filePath, $tmpFile);
        $fileUrl = $filePath;

        $query = "INSERT INTO files SET user_id = ?, name = ?, url = ?";
        $result = $this->db->prepare($query);
        $result->execute([User::getAuthUser(), $file["userfile"]["name"], $fileUrl]);
    }
}