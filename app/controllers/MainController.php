<?php 

namespace app\controllers;

use app\database\ProductDataGateway;
use app\models\BaseModel;


class MainController extends BaseController {
    public function indexAction() {
        new BaseModel();
        $connect = new ProductDataGateway($this->connection);
        $hits = $connect->getHits();
        $this->set(compact('hits'));
    }
}