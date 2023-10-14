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
        $sql = "SELECT * from category WHERE alias = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$alias]);
        $category = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $category;
    }

    public function getSubcategory($categoryId) {
        $sql = "SELECT id from category WHERE parent_id = $categoryId";
        $subcategories = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $subcategories;
    }

    public function getCategories() {
        //выводим категории без подкатегорий
        $sql = "SELECT * from category WHERE parent_id IS NULL";
        $categories = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }

    public function getParentCategoryId($alias) {
        $sql = "SELECT * from category WHERE alias = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$alias]);
        $categoryId = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $categoryId;
    }

    public function getCategoryProduct($categoryId) {
        $sql = "SELECT product_id from product_category WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        $productIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $productIds;
    }

    public function getGroups($categoryId) {
        $sql = "SELECT * from attribute_group INNER JOIN attribute_group_category ON attribute_group.id = attribute_group_category.attribute_group_id AND attribute_group_category.category_id = $categoryId";
        $groups = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $groups;
    }

    public function getAttrs($categoryId) {
        $sql = "SELECT * from attribute_value INNER JOIN attribute_value_category ON attribute_value.id = attribute_value_category.attribute_value_id AND attribute_value_category.category_id = $categoryId";
        $attrs = $this->conn->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $attrs;
    }
}