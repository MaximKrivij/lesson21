<?php
namespace App\DataBase;

use PDO;

class Connection
{
    /**
     * @var PDO
     */
    private static $pdo;

    public static function createConnect(): PDO
    {
        if (!self::$pdo instanceof PDO) {
            $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=notify_test;charset=utf8';
            $user = 'root';
            $pass = '';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            self::$pdo = new PDO($dsn, $user, $pass, $options);
        }

        return self::$pdo;
    }
}
