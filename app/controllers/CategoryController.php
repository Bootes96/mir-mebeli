<?php 

namespace app\controllers;
use app\database\CategoryDataGateway;
use app\database\ProductDataGateway;
use app\database\DB;


class CategoryController extends BaseController {
    public function indexAction() {
        $alias = $this->route['alias'];
        $connect = new CategoryDataGateway((new DB())->connect());
        $category = $connect->getCategory($alias);

        $conn = new ProductDataGateway((new DB())->connect());
        $products = $conn->getCategoryProduct($category['id']);
        $this->set(compact('products'));
    }
}