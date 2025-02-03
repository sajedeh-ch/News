<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

// بررسی دریافت آیدی دسته‌بندی
$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// بررسی وجود دسته‌بندی در پایگاه داده و دریافت نام آن
$category = db_query_single("SELECT name FROM categories WHERE id = ?", [$categoryId]);
if (!$category) {
    die("دسته‌بندی یافت نشد.");
}
$categoryName = htmlspecialchars($category['name']); // ذخیره نام دسته برای استفاده در بخش‌های دیگر

// دریافت پست‌های مربوط به دسته‌بندی
$posts = db_query(
    "SELECT id, title, content, image, created_at 
     FROM posts 
     WHERE category_id = ? 
     ORDER BY created_at DESC 
     LIMIT 5",
    [$categoryId]
);
?>


<!DOCTYPE html>
<html lang="fa">

<head>

    <title><?= htmlspecialchars($category['name']); ?> - News</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>pages/uploads/logo.svg" />

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

</head>

<body style="background:#22272b">

    <!-- Header -->
    <?php include '../component/Navbar.php'; ?>


    <!-- Breadcrumb -->
    <div class="container" style="">
        <div class=" flex-wr-sb-c p-rl-20 p-tb-8 rtl">
            <div class="f2-s-1 p-l-30 m-tb-6">
            <span class="breadcrumb-item f1-s-3 cl9">
                    <?php echo $categoryName; ?>
                </span>
                <a href="<?php echo SITE_URL; ?>pages/category.php" class="breadcrumb-item f1-s-3 cl9">
                    دسته بندی
                </a>
                <a href="<?php echo SITE_URL; ?>index.php" class="breadcrumb-item2 f1-s-3 cl9">
                    خانه
                </a>

                

                
            </div>
        </div>
    </div>

    <!-- Page heading -->
    <div class="container p-t-4 p-b-40">
        <h2 class="f1-l-1  cl0">
            <?php echo $categoryName; ?>
        </h2>
    </div>


    <!-- Feature post -->
    <section class="feature-post">
        <div class="container">
            <div class="row m-rl--1">
                <?php if ($posts): ?>
                    <!-- نمایش پست اصلی -->
                    <div class="col-12 p-rl-1 p-b-2">
                        <?php $mainPost = $posts[0]; ?>
                        <div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url('<?= SITE_URL; ?>pages/uploads/<?= htmlspecialchars($mainPost['image']); ?>');">
                            <a href="<?= SITE_URL; ?>pages/news_detail.php?id=<?= $mainPost['id']; ?>" class="dis-block how1-child1 trans-03"></a>
                            <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                <h3 class="how1-child2 m-t-14 m-b-10">
                                    <a href="<?= SITE_URL; ?>pages/news_detail.php?id=<?= $mainPost['id']; ?>" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                        <?= htmlspecialchars($mainPost['title']); ?>
                                    </a>
                                </h3>
                                <span class="how1-child2">
                                    <span class="f1-s-3 cl11">
                                        <?= date('M d, Y', strtotime($mainPost['created_at'])); ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- نمایش سایر پست‌ها -->
                    <?php foreach (array_slice($posts, 1) as $post): ?>
                        <div class="col-sm-6 col-md-3 p-rl-1 p-b-2">
                            <div class="bg-img1 size-a-14 how1 pos-relative" style="background-image: url('<?= SITE_URL; ?>pages/uploads/<?= htmlspecialchars($post['image']); ?>');">
                                <a href="<?= SITE_URL; ?>pages/news_detail.php?id=<?= $post['id']; ?>" class="dis-block how1-child1 trans-03"></a>
                                <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                    <h3 class="how1-child2 m-t-14">
                                        <a href="<?= SITE_URL; ?>pages/news_detail.php?id=<?= $post['id']; ?>" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
                                            <?= htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>هیچ پستی در این دسته‌بندی وجود ندارد.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>


    <!-- Post -->
    <section class="post-section p-t-110 p-b-25">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 p-b-80">
                    <div class="row">
                        <?php if ($posts): ?>
                            <?php foreach ($posts as $post): ?>
                                <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                    <!-- Item -->
                                    <div class="p-b-53">
                                        <a href="<?php echo SITE_URL; ?>pages/news_detail.php?id=<?php echo $post['id']; ?>" class="wrap-pic-w hov1 trans-03">
                                            <img src="<?php echo SITE_URL; ?>/pages/uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                        </a>

                                        <div class="flex-col-s-c p-t-16">
                                            <h5 class="p-b-5 txt-center">
                                                <a href="<?php echo SITE_URL; ?>pages/news_detail.php?id=<?php echo $post['id']; ?>" class="f1-m-3 cl0 hov-cl10 trans-03">
                                                    <?php echo htmlspecialchars($post['title']); ?>
                                                </a>
                                            </h5>

                                            <div class="cl11 txt-center p-b-17">
                                                <a href="#" class="f1-s-4 cl11 hov-cl10 trans-03">
                                                    <?php echo htmlspecialchars($category['name']); ?>
                                                </a>

                                                <span class="f1-s-3 m-rl-3">-</span>

                                                <span class="f1-s-3">
                                                    <?php echo date("M d, Y", strtotime($post['created_at'])); ?>
                                                </span>
                                            </div>

                                            <p class="f1-s-11 cl15 txt-center p-b-16">
                                                <?php echo mb_substr(strip_tags($post['content']), 0, 100) . '...'; ?>
                                            </p>

                                            <a href="<?php echo SITE_URL; ?>pages/news_detail.php?id=<?php echo $post['id']; ?>" class="f1-s-1 cl10 hov-cl10 trans-03">
                                                بیشتر بخوانید
                                                <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="f1-s-3 cl6 txt-center p-b-16">هیچ پستی در این دسته‌بندی یافت نشد.</p>
                        <?php endif; ?>
                    </div>



                </div>


            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php include '../component/Footer.php'; ?>
    
</body>

</html>