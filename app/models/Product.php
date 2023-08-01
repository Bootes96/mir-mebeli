<?php

namespace app\models;

class Product extends BaseModel
{
    //записываем товар
    public function setViewed($id)
    {
        $viewedProducts = isset($_COOKIE['viewed']) ? $_COOKIE['viewed'] : false;
        if(!$viewedProducts) {
            setcookie('viewed', $id, time() + 3600*24, '/');
        } else {
            $viewedProducts = explode('.', $viewedProducts);
            if(!in_array($id, $viewedProducts)) {
                $viewedProducts[] = $id; 
                $viewedProducts = implode('.', $viewedProducts);
                setcookie('viewed', $viewedProducts, time() + 60 * 60 * 24 * 30, '/');
            }
        }
    }

    public function getLastViewedIds() {
        if(isset($_COOKIE['viewed'])) {
            $lastViewed = explode('.', $_COOKIE['viewed']);
            $ids = array_slice($lastViewed, -5);
            return $ids;
        }
    }

}
