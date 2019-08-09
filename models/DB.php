<?php

namespace Models;

class DB
{
    public static function getConnect()
    {
        $dbConfig = __DIR__ . "../config/db_config.php";

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
        $db = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);

        return $db;
    }
}
