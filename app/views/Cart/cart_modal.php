<?php if (!empty($_SESSION['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <td>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
                <div class="loader-container">
                    <div class="loader" id="loader"></div>
                </div>
                <?php foreach ($_SESSION['cart'] as $id => $item) : ?>
                    <tr>
                        <td><a href="product/<?= $item['alias']; ?>"><img src="images/<?= $item['img']; ?>" alt=""></a></td>
                        <td><a href="product/<?= $item['alias']; ?>"><?= $item['title']; ?></a></td>
                        <td>
                            <form id='counter' data-id="<?= $id; ?>">
                                <input type='button' value='-' class='qtyminus' field='quantity' />
                                <input type='text' name='quantity' value="<?= $item['qty']; ?>" class='qty' />
                                <input type='button' value='+' class='qtyplus' field='quantity' />
                            </form>
                        </td>
                        <td><?= $item['price']; ?></td>
                        <td><span data-id="<?= $id; ?>" aria-hidden="true" class="del-item"><i class="fa fa-remove"></i></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Итого</td>
                    <td colspan="4" class="text-right cart-qty"><?= $_SESSION['cart.qty']; ?></td>
                </tr>
                <tr>
                    <td>На сумму</td>
                    <td colspan="4" class="text-right cart-sum"><?= $_SESSION['cart.sum']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>