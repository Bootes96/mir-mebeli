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
        $sql = "SELECT * from hits";
        $hits = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $hits;
    }

    public function getProductId(string $alias) {
        $sql = "SELECT id from product WHERE alias = ? AND status = '1'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$alias]);
        $id = $stmt->fetch(\PDO::FETCH_ASSOC);
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
            //если массив еще не создан, то создаем и заносим дополнительные характеристики
            if(!array_key_exists($item['attribute_title'], $product)) {
                $product[$item['attribute_title']] = [];
                $product[$item['attribute_title']][$item['attribute_value']] = $item['price'];
            } else { 
                $product[$item['attribute_title']][$item['attribute_value']] = $item['price'];
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

    //Просмотренные товары
    public function getLastViewed($ids) {
        if(!empty($ids)) {
            $qMarks = str_repeat('?,', count($ids) - 1) . '?';
            $sql = "SELECT * from product WHERE id in ($qMarks)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($ids);
            $product = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $product;
        }
    }

    //Товары, которые относятся к категории
    public function getCategoryProduct($productIds) {

        $productIds = array_column($productIds, 'product_id');
        $inQuery = str_repeat('?,', count($productIds) - 1) . '?';
        $sql = "SELECT * FROM product WHERE id IN ($inQuery)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($productIds);
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $products;
    }
    
    //Вывод отфильтрованных товаров
    public function getFilteredProducts($categoryId, $sql_part) {              
        $sql = "SELECT * FROM product INNER JOIN product_category WHERE product.id IN ($sql_part) AND product.id = product_category.product_id AND product_category.category_id = $categoryId";
        $products = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $products;
    }

    //Поиск
    public function searchProduct($search) {
        $sql = "SELECT * from product WHERE title LIKE ? LIMIT 10";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%{$search}%"]);
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $products;
    }

    //Модификации товара
    public function getMods($mods, $id) {
        $sql = [];
        foreach($mods as $k => $v) {
            $sql[] = "SELECT * from attribute_product WHERE attribute_value = '$v' AND product_id = :id "; 
        }
        $sql = implode('UNION ALL ', $sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $products;
    }
}

