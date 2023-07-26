<?php

namespace app\database;


class ProductDataGateway {
    
    private $conn;
    
    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function getHits() {
        $sql = "SELECT * from product WHERE hit = '1'";
        $hits = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $hits;
    }
}