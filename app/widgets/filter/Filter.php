<?php 

namespace app\widgets\filter;
use app\database\CategoryDataGateway;
use app\database\DB;

class Filter {

    public $groups;
    public $attrs;
    public $view;
    public $category;
    public $connect;

    public function __construct($category)
    {
        $this->view = __DIR__ . '/filter_view.php';
        $this->connect = new CategoryDataGateway((new DB())->connect());
        if(isset($category['parent_alias'])) {
            $this->category = $this->connect->getParentCategoryId($category['parent_alias']);   
        } else {
            $this->category = $category;
        }
        $this->run();
    }

    protected function run() {
        $this->groups = $this->connect->getGroups($this->category['id']);
        $this->attrs = self::getAttrs($this->category, $this->connect);
        $filters = $this->getHtml();
        echo $filters;
    }

    protected function getHtml() {
        ob_start();
        $filter = self::getFilter();
        if(!empty($filter)) {
            $filter = explode(',', $filter); 
        }
        require $this->view;
        return ob_get_clean();
    }

    public static function getFilter() {
        $filter = null;
        if(!empty($_GET['filter'])) {
            $filter = preg_replace("#[^\d,]+#", '', $_GET['filter']);
            $filter = rtrim($filter, ',');
        }
        return $filter;
    }

    public static function getCountGroups($filter, $category, $connect) {
        $filters = explode(',', $filter);
        $attrs = self::getAttrs($category, $connect);
        $data = [];
        foreach($attrs as $key => $item) {
            foreach($item as $k => $v) {
                if(in_array($k, $filters)) {
                    $data[] = $key; 
                    break;
                }
            }
        }
        return count($filters);
    }

    public static function getAttrs($category, $connect) {
        $data = $connect->getAttrs($category['id']);
        $attrs = [];
        foreach($data as $k => $v) {
            $attrs[$v['attr_group_id']][$v['attribute_value_id']] = $v['value'];
        }
        return $attrs;
    }
}