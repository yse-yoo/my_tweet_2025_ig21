<?php
class Database
{
    private static $pdo = null;

    public static function getInstance()
    {
        if (self::$pdo === null) {
            $dsn = "mysql:dbname=" . DB_DATABASE . ";host=" . DB_HOST . ";charset=utf8;port=" . DB_PORT;
            try {
                self::$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return self::$pdo;
            } catch (PDOException $e) {
                error_log("接続失敗: " . $e->getMessage());
            }
        }
    }
}
