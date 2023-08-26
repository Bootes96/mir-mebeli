<?php 

namespace app\database;

class DB {
    private static $db;
 
    static public function connect() {
        if (self::$db === null) {
            $conf = require_once CONFIG . '/config_db.php';
            self::$db = new \PDO($conf['dsn'], $conf['user'], $conf['password']);
        }
         return static::$db;
    }
}
 

