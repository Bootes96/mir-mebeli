<?php

namespace app\controllers;

use app\database\ProductDataGateway;
use app\models\Cart;

class CartController extends BaseController {
    public function addAction() {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $alias = !empty($_GET['alias']) ? $_GET['alias'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mods = !empty($_GET['modification']) ? json_decode($_GET['modification'], true) : null;

        if($id) {
            $connect = new ProductDataGateway($this->connection);
            $product = $connect->getSingleProduct($alias);
        }
        if($mods) {
            $connect = new ProductDataGateway($this->connection);
            $mods = $connect->getMods($mods, $id);   
        }
        $cart = new Cart();
        $cart->addToCart($product, $qty, $mods);
        if($this->isAjax()) {
            require APP . "/views/{$this->controller}/cart_modal.php";
            die;
        }
        redirect();
    }

    public function showAction() {
        require APP . "/views/{$this->controller}/cart_modal.php";
        die;
    }

    public function deleteAction() {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if(isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }
        if($this->isAjax()) {
            require APP . "/views/{$this->controller}/cart_modal.php";
            die;
        }
        redirect();
    }

    public function clearAction() {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        if($this->isAjax()) {
            require APP . "/views/{$this->controller}/cart_modal.php";
            die;
        }
        redirect();
    }

    public function recalcAction() {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? $_GET['qty'] : null;
        $cart = new Cart();
        $cart->recalc($id, $qty);
        if($this->isAjax()) {
            require APP . "/views/{$this->controller}/cart_modal.php";
            die;
        }
        redirect();
    }
}