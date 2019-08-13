<?php

namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class File extends Eloquent
{
    const ERROR_EMPTY_FIELD = 1;
    const ERROR_FILE_UPLOAD = 2;
    const ERROR_INCORRECT_AGE = 3;

    protected $errors;
    public $timestamps = false;

    public function fileUpload(array $file)
    {
        $tmpFile = file_get_contents($file["userfile"]["tmp_name"]);
        $filePath = "/files/" . $file["userfile"]["name"];
        file_put_contents(__DIR__ . "/../public" . $filePath, $tmpFile);

        $newFile = new File();
        $newFile->name = $file["userfile"]["name"];
        $newFile->url = $filePath;
        $newFile->save();
    }
}