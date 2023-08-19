<?php 

namespace app\controllers;

use app\database\Connection;
use app\database\ProductDataGateway;
use app\models\Product;

class ProductController extends BaseController {
    public function indexAction() {
        $connect = new ProductDataGateway((new Connection)->make());
        $product = $connect->getSingleProduct($this->route['alias']);
        //связанные товары
        $related = $connect->getRelatedProduct($product['id']);
        
        //категория товара 
        $category = $connect->getCategory($product['category_id']);

        //просмотренные товары
        $product_model = new Product();
        $product_model->setViewed($product['id']);
        $lastViewedIds = $product_model->getLastViewedIds();

        //Не показываем в просмотренных товарах текущий товар
        if(!empty($lastViewedIds)) {
            if (($key = array_search($product['id'], $lastViewedIds)) !== false) {
                unset($lastViewedIds[$key]);
                //переиндексируем массив, чтобы не было ошибки в PDO
                $lastViewedIds = array_values($lastViewedIds);
            }
        }

        //получаем из бд просмотренные товары
        $lastViewedProducts = $connect->getLastViewed($lastViewedIds);


        printR($product);

        $this->set(compact('product', 'related', 'category', 'lastViewedProducts'));
    }

}