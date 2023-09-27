<?php 

namespace app\models;

class Cart extends BaseModel {

    public function addToCart($product, $qty = 1, $mods = null) {
        if($mods) {
            //ID дополнительных характеристик
            $modIds = [];
            //Title характеристик: название цвета, размеры и тд
            $modsTitle = [];
            //Цена характеристик
            $modsPrice = 0;
            foreach($mods as $mod) {
                $modIds[] = $mod['id']; 
                $modsTitle[] = $mod['attribute_value']; 
                $modsPrice += $mod['price'];
            }
            //сортируем ID, чтобы не сохранять один и тот же товар в сессии два раза  
            sort($modIds);
            $modsId = implode('-', $modIds);
            $modsTitle = implode('-', $modsTitle);
            $ID =  "{$product['id']}-{$modsId}";
            $title = "{$product['title']} ({$modsTitle})"; 
            $price = $product['price'] + $modsPrice;       
        } else {
            $ID =  "{$product['id']}";
            $title = "{$product['title']}"; 
            $price = $product['price'];  
        }
        if(isset($_SESSION['cart'][$ID])) {
            $_SESSION['cart'][$ID]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$ID] = [
                'qty' => $qty,
                'title' => $title,
                'alias' => $product['alias'],
                'price' => $price,
                'img' => $product['img'],
            ];
        }
        //Общая сумма и количество товаров
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $price : $qty * $price;
    }

    //удаляем товар по одному
    public function deleteItem($id) {
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -=  $qtyMinus;
        $_SESSION['cart.sum'] -=  $sumMinus;
        unset($_SESSION['cart'][$id]);
    }

    //Пересчитываем корзину при изменение количества товаров
    public function recalc($id, $qty) {
        if(isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
        $products = [];
        foreach($_SESSION['cart'] as $product) {
            $products[] = $product;
        }
        $_SESSION['cart.qty'] = array_sum(array_column($products, 'qty'));

        $sum = 0;

        foreach($_SESSION['cart'] as $product) {
            $sum += $product['qty'] * $product['price'];
        }
        
        $_SESSION['cart.sum'] = $sum;
    }
}