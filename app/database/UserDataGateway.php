<?php

namespace app\database;

class UserDataGateway
{
    private $conn;

    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function checkEmailExist(string $email): bool
    {
        $query = $this->conn->prepare("SELECT `email` FROM `user` WHERE `email` = ?");
        $query->bindValue(1, $email);
        $query->execute();

        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function save(array $attributes): int
    {
        $sql = "INSERT INTO user (name, lastname, phone, email, password) VALUES (:name, :lastname, :phone, :email, :password)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($attributes);
        return $this->conn->lastInsertId();
    }
}
