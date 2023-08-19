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
                                <div class="price d-flex flex-row align-items-center"><span class="act-price" data-price="<?= $product['price']; ?>">Цена: <?= $product['price']; ?> рублей</span>
                                    <div class="ml-2"> <small class="dis-price"></small><span>40% OFF</span> </div>
                                </div>
                            </div>
                            <div class="product-feature">
                                    <span>Жесткость: </span>
                                    <?php $getStiffness = !empty($_GET['stiffness']) ? $_GET['stiffness'] : ''; ?>
                                    <?php if(count($product['stiffness']) > 1) : ?>
                                    <select class="form-select" aria-label="Default select example" id="product-select" onchange="setSearchParams(this)">
                                            <?php foreach (array_keys($product['stiffness']) as $stiffness) : ?>
                                                <option class="price-option" id="product-option" <?php echo $getStiffness == $stiffness ? 'selected' : ''; ?> value="stiffness" data-price="<?= $product['stiffness'][$stiffness] ?>"><?= $stiffness; ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                <?php else : ?>
                                    <p><?= key($product['stiffness']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="product-feature">
                                <span>Материалы наполнителя: </span>
                                <?php $getFiller = !empty($_GET['filler']) ? $_GET['filler'] : ''; ?>
                                <?php if (count($product['filler_materials']) > 1) : ?>
                                <select class="form-select" aria-label="Default select example" id="product-select" onchange="setSearchParams(this)">
                                        <?php foreach (array_keys($product['filler_materials']) as $filler) : ?>
                                            <option class="price-option" id="product-option" <?php echo $getFiller == $filler ? 'selected' : ''; ?> value="filler" data-price="<?= $product['filler'][$filler] ?>"><?= $filler; ?></option>
                                        <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                                <p><?= key($product['filler_materials']); ?></p>
                            <?php endif; ?>
                            </div>
                            <div class="product-feature">
                                <span>Высота матраса: </span>
                                <?php $getHeight = !empty($_GET['height']) ? $_GET['height'] : ''; ?>
                                <?php if (count($product['height']) > 1) : ?>
                                    <select class="form-select" aria-label="Default select example" id="product-select" onchange="setSearchParams(this)">
                                        <?php foreach (array_keys($product['height']) as $height) : ?>
                                            <option class="price-option" id="product-option" <?php echo $getHeight == $height ? 'selected' : ''; ?> value="height" data-price="<?= $product['sleeping_place_height'][$height] ?>"><?= $height; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else : ?>
                                    <p><?= key($product['height']); ?></p>
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