<?php 

namespace app\controllers;

use app\database\ProductDataGateway;

class SearchController extends BaseController {
    public function queryAction() {
        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $search = mb_eregi_replace("[^a-zа-яё0-9 ]", '', $search);
            $search = trim($search);
            $connect = new ProductDataGateway($this->connection);
            $result = $connect->searchProduct($search);
            if ($result) {
                ?>
                <div class="search_result">
                    <ul class="list-group">
                        <?php foreach ($result as $product): ?>
                        <li class="list-group-item">
                            <div class="search_result-name">
                                <a class="link-primary" href="<?=PATH;?>/product/<?= $product['alias']; ?>"><?= $product['title']; ?></a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php
            }
        }
        die;
    }

    public function indexAction () {
        if (!empty($_GET['query'])) {
            $search = $_GET['query'];
            $search = mb_eregi_replace("[^a-zа-яё0-9 ]", '', $search);
            $search = trim($search);
            $connect = new ProductDataGateway($this->connection);
            $products = $connect->searchProduct($search);
            $this->set(compact('products'));
        }
    }
}