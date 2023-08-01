<?php if (!empty($product)) : ?>
    <div class="row d-flex single-product">
        <div class="col-md-10">
            <div class="product-card">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <img class="image-thumbnail" src="images/<?= $product['img']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"><?= $product['brand_title']; ?></span>
                                <h3 class="text-uppercase"><?= $product['title']; ?></h3>
                                <div class="price d-flex flex-row align-items-center"><span class="act-price">Цена: <?= $product['price']; ?></span>
                                    <div class="ml-2"> <small class="dis-price"></small><span>40% OFF</span> </div>
                                </div>
                            </div>
                            <p class="product-attribute">Цвет: <?= $product['color']; ?></p>
                            <p class="product-attribute">Размер спального места: <?= $product['sleeping_place_size']; ?></p>
                            <p class="product-attribute">Высота спального места: <?= $product['sleeping_place_height']; ?></p>
                            <p class="about"><?= $product['description']; ?></p>
                            <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Добавить в корзину</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>