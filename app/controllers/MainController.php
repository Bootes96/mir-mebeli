<?php 

namespace app\controllers;

use app\database\CategoryDataGateway;
use app\database\ProductDataGateway;
use app\models\BaseModel;


class MainController extends BaseController {
    public function indexAction() {
        new BaseModel();
        $connect = new ProductDataGateway($this->connection);
        $hits = $connect->getHits();

        $connect2 = new CategoryDataGateway($this->connection);
        $categories = $connect2->getCategories();

        $this->set(compact('hits', 'categories'));
    }
}