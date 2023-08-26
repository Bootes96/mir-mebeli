<?php

namespace app\database;


class CategoryDataGateway {
    
    private $conn;
    
    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function getAllCategories() {
        $sql = "SELECT * from category";
        $categories = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        $tree = [];
        
        foreach ($categories as $id=>&$node) {
            if (!$node['parent_id']){
                //делаем ключом массива id категории
                $tree += [$node['id']=>$node];
            }
        }
        foreach($categories as $id=>&$node) {
            if (!empty($node['parent_id'])) {
                $tree[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    public function getCategory($alias) {
        $sql = "SELECT * from category WHeRE alias = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$alias]);
        $category = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $category;
    }
}