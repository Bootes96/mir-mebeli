<!DOCTYPE html>
<html>

<head>
  <base href="/">
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>
    Мир мебели
  </title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- smartmenus -->
  <link href='css/sm-core-css.css' rel='stylesheet' type='text/css' />

  <!-- font-awesome -->
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container" id="dropdown-menu">
        <a class="navbar-brand" href="<?= PATH; ?>">
          <span>
            Мир мебели
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item active sm sm-blue">
              <a href="" class="nav-link" data-toggle="dropdown">Каталог</a>
              <ul class="dropdown-menu" id="main-menu">
                <?php $categories = (new \app\widgets\Menu())->getCategories() ?>
                <?php if ($categories) : ?>
                  <?php foreach ($categories as $category) : ?>
                    <li class="has-submenu higlighted"><a class="nav-link" href="category/<?= $category['alias']; ?>"><?= $category['title']; ?></a>
                      <ul class="submenu">
                        <?php if (isset($category['childs'])) : ?>
                          <?php foreach ($category['childs'] as $child) : ?>
                            <li><a class="nav-link sublink" href="category/<?=$child['parent_alias']?>/<?= $child['alias']; ?>"><?= $child['title']; ?></a></li>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </ul>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">
                Адреса магазинов
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="why.html">
                Доставка и оплата
              </a>
            </li>
          </ul>
          <div class="user_option">
            <a href="">
              <i class="fa fa-user" aria-hidden="true"></i>
              <div class="btn-group">
                <a class="dropdown-toggle" data-toggle="dropdown">
                  Аккаунт <span class="caret"></span>
                </a>
                <ul class="dropdown-menu user-dropdown">
                  <?php if(!empty($_SESSION['user'])): ?>
                    <li><a href="#">Добро пожаловать, <?php htmlspecialchars($_SESSION['user']['name']);?></a></li>
                    <li><a href="user/logout">Выход</a></li>
                  <?php else: ?>
                    <li><a href="user/login">Вход</a></li>
                    <li><a href="user/signup">Регистрация</a></li>
                  <?php endif;?>
                </ul>
              </div>
            </a>
            <a class="main-cart" href="cart/show" onclick="getCart(); return false;">
              <i class="cart fa fa-cart-arrow-down" aria-hidden="true"></i>
              <div class="total">
                <?php if(!empty($_SESSION['cart'])): ?>
                  <span class="cart-total"><?= $_SESSION['cart.sum'] ;?> Рублей</span>
                <?php else: ?>
                  <span>Корзина пуста</span>
                <?php endif;?>
              </div>
            </a>
            <div class="search_box">
              <form action="search" method="get" autocomplete="off" id="search_form">
                <input type="text" name="query" id="search" placeholder="Название товара">
                <input type="submit" value="Поиск">
              </form>
              <div id="search_box-result"></div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php if(isset($_SESSION['error'])): ?>
              <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']);?>
              </div>
            <?php endif;?>
            <?php if(isset($_SESSION['success'])): ?>
              <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']);?>
              </div>
            <?php endif;?>
          </div>
        </div>
      </div>
      <?php
      // session_destroy();
      // printR($_SESSION); ?>
      <?= $content; ?>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->
    <!-- Modal -->
    <div class="modal fade" id="cart" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Корзина</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
            <a href="cart/view" type="button" class="btn btn-primary">Оформить заказ</a>
            <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </section>

    <!-- end info section -->

    <div class="preloader">
      <img src="images/ring.svg" alt="">
    </div>

    <script>
      const path = '<?= PATH; ?>';
    </script>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/validator.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="js/jquery.smartmenus.js"></script>
    <script src="js/main.js"></script>

</body>

</html>