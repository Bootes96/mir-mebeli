<div class="container mt-5 mb-5">
<div id="container">
  <div class="category row">
    <div class="filter-sidebar col-sm-4 col-md-4 col-lg-3">
      <?php new \app\widgets\filter\Filter($category); ?>
    </div>
    <div class="col-sm-8 col-md-6 col-lg-9">
        <?php if (!empty($products)) : ?>
          <div class="product-one row">
            <?php foreach ($products as $product) : ?>
              <div class="col-sm-4 col-md-4 col-lg-3">
                <div class="box">
                  <a href="product/<?= $product['alias']; ?>">
                    <div class="product-img-box">
                      <img src="images/<?= $product['img']; ?>" alt="" />
                    </div>
                    <div class="detail-box">
                      <h5>
                        <?= $product['title']; ?>
                      </h5>
                  </a>
                  <h6>
                    Цена:
                    <span>
                      <?= $product['price']; ?>
                      рублей
                    </span>
                  </h6>
                </div>
              </div>
          </div>
        <?php endforeach; ?>
    <?php else : ?>
      <h3>В этой категории товаров пока нет</h3>
    <?php endif; ?>
    </div>
  </div>
</div>
</div>
</div>