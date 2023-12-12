<?php 

namespace app\controllers;
use app\database\CategoryDataGateway;
use app\database\ProductDataGateway;
use app\database\DB;
use libraries\Pagination;
use app\widgets\filter\Filter;

class CategoryController extends BaseController {
    public function indexAction() {
        //родительская категория. Например: диваны
        $alias = $this->route['alias'];
        //подкатегория. Например: угловые диваны
        $subalias = $this->route['subalias'] ?? null;

        $connect = new CategoryDataGateway((new DB())->connect());

        $conn = new ProductDataGateway((new DB())->connect());

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        $perpage = 5;    
        
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
            $totalProducts = $conn->countFilteredProduct($category['id'], $sql_part);
            $pagination = new Pagination($page, $perpage, $totalProducts);
            $start = $pagination->getStart();
            $products = $conn->getFilteredProducts($category['id'], $sql_part, $start, $perpage);
        } else {
            $totalProducts = $conn->countCategoryProduct($categoryProducts);
            $pagination = new Pagination($page, $perpage, $totalProducts);
            $start = $pagination->getStart();
            $products = $conn->getCategoryProduct($categoryProducts, $start, $perpage);
        }

        if($this->isAjax()) {
            $this->loadView('filter', compact('products'));
        }

        $this->set(compact('products', 'category', 'pagination'));

    }
}