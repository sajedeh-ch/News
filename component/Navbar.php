<?php
// وارد کردن تنظیمات و توابع دیتابیس
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

// دریافت دسته‌بندی‌ها از پایگاه داده
$categories = db_query("SELECT id, name FROM categories ORDER BY name ASC");
?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>pages/uploads/icons/favicon.png" />

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/vendor/bootstrap/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">

    <!-- Material Design Icons -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/fonts/iconic/css/material-design-iconic-font.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/vendor/animate/animate.css">

    <!-- Hamburgers -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/vendor/css-hamburgers/hamburgers.min.css">

    <!-- Animsition -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/vendor/animsition/css/animsition.min.css">

    <!-- Util & Main Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/util.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/main.css?v=1.0">

<header>
    <div class="container-menu-desktop">
        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo mobile -->
            <div class="logo-mobile">
                <a href="<?php echo SITE_URL; ?>/index.php">
                    <img src="<?php echo SITE_URL; ?>pages/uploads/icons/logo-01.png" alt="LOGO">
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li><a href="<?php echo SITE_URL; ?>index.php">خانه</a></li>
                <li>
                    <a href="#">دسته بندی</a>
                    <ul class="sub-menu-m">
                        <li><a href="<?php echo SITE_URL; ?>pages/category.php">All</a></li>
                        <?php
                        if ($categories) {
                            foreach ($categories as $category) {
                                echo '<li><a href="' . SITE_URL . 'pages/category.php?id=' . $category['id'] . '">' .
                                    htmlspecialchars($category['name']) . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found</a></li>';
                        }
                        ?>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
                <li><a href="<?php echo SITE_URL; ?>/pages/login.php">ورود / ثبت نام</a></li>
            </ul>
        </div>

        <!-- Logo desktop -->
        <div class="wrap-logo container">
            <div class="logo">
                <div>
                    <h1>بیرجند<mark>نیوز</mark></h1>
                </div>
                <a href="<?php echo SITE_URL; ?>/index.php">
                    <img src="<?php echo SITE_URL; ?>pages/uploads/logo3.png" alt="LOGO">
                </a>
            </div>
        </div>

        <!-- Navigation -->
        <div class="wrap-main-nav">
            <div class="main-nav">
                <nav class="menu-desktop">
                    <a class="logo-stick" href="<?php echo SITE_URL; ?>index.php">
                        <img src="<?php echo SITE_URL; ?>pages/uploads/logo3.png" alt="LOGO">
                    </a>
                    <?php
                    // گرفتن نام صفحه فعلی
                    $current_page = basename($_SERVER['PHP_SELF']);
                    ?>

                    <ul class="main-menu">
                        <li class="<?= ($current_page == 'index.php') ? 'main-menu-active' : '' ?>">
                            <a href="<?php echo SITE_URL; ?>index.php">خانه</a>
                        </li>

                        <li class="mega-menu-item category-btn <?= ($current_page == 'category.php') ? 'main-menu-active' : '' ?>">
                            <a href="#">دسته بندی</a>
                            <div class="sub-mega-menu">
                                <div class="nav flex-column nav-pills" role="tablist">
                                    <a class="nav-link <?= ($current_page == 'category.php' && !isset($_GET['id'])) ? 'active' : '' ?>"
                                        href="<?php echo SITE_URL; ?>pages/category.php">همه</a>

                                    <?php
                                    if ($categories) {
                                        foreach ($categories as $category) {
                                            $isActive = (isset($_GET['id']) && $_GET['id'] == $category['id']) ? 'active' : '';
                                            echo '<a class="nav-link ' . $isActive . '" href="' . SITE_URL . 'pages/category.php?id=' . $category['id'] . '">'
                                                . htmlspecialchars($category['name']) . '</a>';
                                        }
                                    } else {
                                        echo '<p>No categories found.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>

                        <li class="login-btn <?= ($current_page == 'login.php') ? 'main-menu-active' : '' ?>">
                            <a href="<?php echo SITE_URL; ?>pages/sign-in.php">ورود / ثبت نام</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </div>
    </div>
</header>




<!--===============================================================================================-->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/bootstrap/js/popper.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../js/main.js"></script>