<?php 

namespace app\controllers;

use app\database\Connection;
use app\database\ProductDataGateway;

class ProductController extends BaseController {
    public function indexAction() {
        $connect = new ProductDataGateway((new Connection)->make());
        $product = $connect->getSingleProduct($this->route['alias']);
    
        //связанные товары
        $related = $connect->getRelatedProduct($product['id']);
        
        //категория товара 
        $category = $connect->getCategory($product['category_id']);

        $this->set(compact('product', 'related', 'category'));
    }
}