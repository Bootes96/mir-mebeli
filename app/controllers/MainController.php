<?php 

namespace app\controllers;

use app\database\ProductDataGateway;
use app\models\BaseModel;
use app\database\Connection;

class MainController extends BaseController {
    public function indexAction() {
        new BaseModel();
        $connect = new ProductDataGateway((new Connection)->make());
        $hits = $connect->getHits();
        $this->set(compact('hits'));
    }
}