<div id="container">
<div class="row category">
    <?php if(!empty($products)):?>
        <?php foreach($products as $product) : ?>
        <div class="col-sm-4 col-md-4 col-lg-3">
          <div class="box">
            <a href="product/<?=$product['alias'];?>">
              <div class="product-img-box">
                <img src="images/<?=$product['img'];?>" alt=""/>
              </div>
              <div class="detail-box">
                <h6>
                  <?= $product['title'];?>
                </h6>
                <h6>
                  Цена:
                  <span>
                  <?= $product['price'];?>
                  рублей
                  </span>
                </h6>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach;?>
        <?php else: ?>
            <h3>Такой товар не найден</h3>
        <?php endif;?>
      </div>
</div>