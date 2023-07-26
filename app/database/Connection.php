<?php 

namespace app\database;

class Connection {

    private static $instance;

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function make() {
        try {
            $db = require_once CONFIG . '/config_db.php';
            return $pdo = new \PDO($db['dsn'], $db['user'], $db['password']);
        } catch (\PDOException $e) {
            throw new \Exception("Нет соединения с БД, ошибка {$e}", 500);
        }
    }
}