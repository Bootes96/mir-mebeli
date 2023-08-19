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
                                <div class="price d-flex flex-row align-items-center"><span class="act-price" id="act-price" data-price="<?= $product['price']; ?>">Цена: <?= $product['price']; ?></span>
                                    <div class="ml-2"> <small class="dis-price"></small><span>40% OFF</span> </div>
                                </div>
                            </div>
                            <div class="product-feature">
                                <span>Цвет: </span>
                                <?php $getColor = !empty($_GET['color']) ? $_GET['color'] : ''; ?>
                                <?php if (count($product['color']) > 1) : ?>
                                <select class="form-select" aria-label="Default select example" id="product-select" onchange="setSearchParams(this)">
                                        <?php foreach (array_keys($product['color']) as $color) : ?>
                                            <option class="price-option" id="product-option" <?php echo $getColor == $color ? 'selected' : ''; ?> value="color" data-price="<?= $product['color'][$color] ?>"><?= $color; ?></option>
                                        <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                                <p><?= key($product['color']); ?></p>
                            <?php endif; ?>
                            </div>
                            <div class="product-feature">
                                <span>Размер спального места: </span>
                                <?php $getSize = !empty($_GET['size']) ? $_GET['size'] : ''; ?>
                                <?php if (count($product['sleeping_place_size']) > 1) : ?>
                                    <select class="form-select" aria-label="Default select example" id="product-select" onchange="setSearchParams(this)">
                                        <?php foreach (array_keys($product['sleeping_place_size']) as $size) : ?>
                                            <option class="price-option" id="product-option" <?php echo $getSize == $size ? 'selected' : 'size'; ?> value="size" data-price="<?= $product['sleeping_place_size'][$size] ?>"><?= $size; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else : ?>
                                    <p><?= key($product['sleeping_place_size']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="product-feature">
                                <span>Высота кровати: </span>
                                <?php $getHeight = !empty($_GET['height']) ? $_GET['height'] : ''; ?>
                                <?php if (count($product['sleeping_place_height']) > 1) : ?>
                                    <select class="form-select" aria-label="Default select example" id="product-select" onchange="setSearchParams(this)">
                                        <?php foreach (array_keys($product['sleeping_place_height']) as $height) : ?>
                                            <option class="price-option" id="product-option" <?php echo $getHeight == $height ? 'selected' : ''; ?> value="height" data-price="<?= $product['sleeping_place_height'][$height] ?>"><?= $height; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else : ?>
                                    <p><?= key($product['sleeping_place_height']); ?></p>
                                <?php endif; ?>
                            </div>
                            <p class="about">Описание: <?= $product['description']; ?></p>
                            <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Добавить в корзину</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>