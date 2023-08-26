<?php

namespace app\widgets;

use app\database\CategoryDataGateway;
use app\database\DB;

class Menu {
    public function getCategories() {
        $connect = new CategoryDataGateway((new DB())->connect());
        $categories = $connect->getAllCategories();
        return $categories;
    }
}