<?php

namespace app\database;


class ProductDataGateway {
    
    private $conn;
    
    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    //Получаем популярные товары
    public function getHits() {
        $sql = "SELECT * from product WHERE hit = '1'";
        $hits = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $hits;
    }

    public function getSingleProduct(string $alias) {
        $sql = "SELECT * from product WHERE alias = ? AND status = '1'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$alias]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        //Получаем специфичные характеристики товара
        $sql1 = "SELECT * FROM product JOIN attribute_product ON product.id = product_id WHERE product_id ={$product['id']};";
        $attribute = $this->conn->query($sql1)->fetchAll(\PDO::FETCH_ASSOC);
        
        //добавляем к основным характеристикам
        foreach($attribute as $item) {
           foreach ($item as $k => $v) {
            $product[$item['attribute_title']] = $v;
           }
        }

        return $product;
    }

    //Связанные товары
    public function getRelatedProduct($id) {
        $sql = "SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = $id";
        $related = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $related;
    }

    //Получаем категорию
    public function getCategory($categoryId) {
        $sql = "SELECT alias FROM category WHERE category.id = $categoryId";
        $category = $this->conn->query($sql)->fetch(\PDO::FETCH_ASSOC);
        return $category;
    }
}