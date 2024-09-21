<?php
namespace app\libs;

use PDO;

class Db {
    private static $instance;
    public PDO $connection;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }
    private function __construct__(){
        $dbConfig = require_once("../config/db.php");
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['db']};charset={$dbConfig['charset']}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->connection = new PDO($dsn, $dbConfig['user'], $dbConfig['pass'], $options);
    }
}