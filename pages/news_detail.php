<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

// گرفتن شناسه پست از URL
$postId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// گرفتن اطلاعات پست از جدول posts بر اساس شناسه
$post = db_query_single(
    "SELECT posts.*, categories.name AS category_name 
     FROM posts 
     LEFT JOIN categories ON posts.category_id = categories.id
     WHERE posts.id = ?",
    [$postId]
);

// بررسی اگر پست یافت نشد
if (!$post) {
    die("پست مورد نظر یافت نشد.");
}
?>



<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>pages/uploads/logo.svg" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="../css/main.css?v=1.0">
</head>
<body>

<?php include '../component/Navbar.php'; ?>

    

<section class="feature-post p-b-140 p-t-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 p-b-30">
                <div class="p-r-10 p-r-0-sr991">
                    <!-- Blog Detail -->
                    <div class="p-b-70">
                        <!-- نمایش نام دسته‌بندی -->
                        <a href="#" class="f1-s-10 cl0 hov-cl10 trans-03 text-uppercase">
                            <?php echo htmlspecialchars($post['category_name']); ?>
                        </a>

                        <!-- عنوان پست -->
                        <h3 class="f1-l-3 cl0 p-b-16 p-t-33 respon2">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h3>
                        
                        <!-- اطلاعات پست -->
                        <div class="flex-wr-s-s p-b-40">
                            <span class="f1-s-3 cl8 m-r-15">
                                <span class="m-rl-3">-</span>
                                <span>
                                    <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                                </span>
                            </span>
                        </div>

                        <!-- تصویر پست -->
                        <?php if (!empty($post['image'])): ?>
                            <div class="wrap-pic-max-w p-b-30">
                                <img src="<?= SITE_URL; ?>pages/uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="IMG">
                            </div>
                        <?php endif; ?>

                        <!-- محتوای پست -->
                        <p class="f1-s-11 cl0 p-b-25">
                            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-lg-4 p-b-30">
    <div class="p-l-10 p-rl-0-sr991 p-t-70">                        
        <!-- Category -->
        <div class="p-b-60">
            <div class="how2 how2-cl4 flex-s-c">
                <h3 class="f1-m-2 cl0 tab01-title">
                    دسته بندی ها
                </h3>
            </div>

            <ul class="p-t-35">
                <?php
                // دریافت لیست همه دسته‌بندی‌ها
                $categories = db_query("SELECT id, name FROM categories");

                foreach ($categories as $category) :
                ?>
                    <li class="how-bor3 p-rl-4">
                        <a href="category.php?id=<?= $category['id'] ?>" class="dis-block f1-s-10 text-uppercase cl0 hov-cl10 trans-03 p-tb-13">
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Latest Posts -->
        <div class="p-b-30">
            <div class="how2 how2-cl4 flex-s-c">
                <h3 class="f1-m-2 cl0 tab01-title">
                    آخرین پست ها
                </h3>
            </div>

            <ul class="p-t-35">
                <?php
                // دریافت آخرین پست‌های مربوط به دسته‌بندی همین خبر
                $latestPosts = db_query(
                    "SELECT id, title, image, created_at 
                    FROM posts 
                    WHERE category_id = ? 
                    ORDER BY created_at DESC 
                    LIMIT 5",
                    [$post['category_id']]
                );

                foreach ($latestPosts as $latest) :
                ?>
                    <li class="flex-wr-sb-s p-b-30">
                        <a href="news_detail.php?id=<?= $latest['id'] ?>" class="size-w-10 wrap-pic-w hov1 trans-03">
                            <img src="<?= SITE_URL; ?>pages/uploads/<?= htmlspecialchars($latest['image']) ?>" alt="IMG">
                        </a>

                        <div class="size-w-11">
                            <h6 class="p-b-4">
                                <a href="news_detail.php?id=<?= $latest['id'] ?>" class="f1-s-4 cl0 hov-cl10 trans-03">
                                    <?= htmlspecialchars($latest['title']) ?>
                                </a>
                            </h6>

                            <span class="cl8 txt-center p-b-24">
                                <span class="f1-s-3">
                                    <?= date("M d", strtotime($latest['created_at'])) ?>
                                </span>
                            </span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

        </div>
    </div>
</section>

<?php include '../component/Footer.php'; ?>
</body>
</html>
