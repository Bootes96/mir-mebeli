<?php 

namespace app\controllers;
use app\database\CategoryDataGateway;
use app\database\ProductDataGateway;
use app\database\DB;
use app\widgets\filter\Filter;

class CategoryController extends BaseController {
    public function indexAction() {
        //родительская категория. Например: диваны
        $alias = $this->route['alias'];
        //подкатегория. Например: угловые диваны
        $subalias = $this->route['subalias'] ?? null;

        $connect = new CategoryDataGateway((new DB())->connect());
        
        if($subalias) {
            $category = $connect->getCategory($subalias);
        } else {
            $category = $connect->getCategory($alias);
        }

        $subcategory = $connect->getSubcategory($category['id']);
        $sql_part = '';

        $categoryProducts = $connect->getCategoryProduct($category['id']);

        $conn = new ProductDataGateway((new DB())->connect());

        if(!empty($_GET['filter'])) {
            $filter = Filter::getFilter();
            if($filter) {
                $cnt = Filter::getCountGroups($filter, $category, $connect);
            }
            $sql_part = "SELECT product_id FROM attribute_product WHERE attribute_value_id IN ($filter) GROUP BY product_id HAVING COUNT(product_id) = $cnt";
            $products = $conn->getFilteredProducts($category['id'], $sql_part);
        } else {
            $products = $conn->getCategoryProduct($categoryProducts);
        }

        if($this->isAjax()) {
            $this->loadView('filter', compact('products'));
        }

        $this->set(compact('products', 'category'));

    }
}