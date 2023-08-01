<?php if (!empty($lastViewedProducts)) : ?>
    <div class="row d-flex">
        <div class="col-md-10">
            <div class="related-product">
                <h4>Просмотренные товары</h4>
                <div class="row">
                    <?php foreach ($lastViewedProducts as $product) : ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="box">
                                <a href="product/<?= $product['alias']; ?>">
                                    <div class="product-img-box">
                                        <img src="images/<?= $product['img']; ?>" alt="" />
                                    </div>
                                    <div class="detail-box">
                                        <h6>
                                            <?= $product['title']; ?>
                                        </h6>
                                        <h6>
                                            Цена: <?= $product['price']; ?>
                                            <span>
                                                рублей
                                            </span>
                                        </h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>