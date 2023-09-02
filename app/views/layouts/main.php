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
                            <li><a class="nav-link sublink" href="category/<?= $child['alias']; ?>"><?= $child['title']; ?></a></li>
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
              <span>
                Войти
              </span>
            </a>
            <a href="">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
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

    </section>

    <!-- end info section -->

    <script>
      const path = '<?= PATH; ?>';
    </script>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="js/jquery.smartmenus.js"></script>
    <script src="js/main.js"></script>

</body>

</html>