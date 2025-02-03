<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// بررسی ورود کاربر
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $news = db_query_single("SELECT * FROM posts WHERE id = ?", [$post_id]);
} else {
    header("Location: news_management.php");
    exit;
}

// بروزرسانی خبر
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);
    $category_id = $_POST["category"];
    $image = $_FILES["image"];

    // اگر تصویر جدید آپلود شد
    if ($image["size"] > 0) {
        // نام تصویر جدید و مسیر آن
        $image_path = "" . basename($image["name"]);

        // انتقال فایل از مسیر موقت به مقصد
        move_uploaded_file($image["tmp_name"], $image_path);
    } else {
        // اگر کاربر تصویر جدیدی انتخاب نکرده باشد، تصویر قبلی حفظ می‌شود
        $image_path = $news["image"];
    }

    // آپدیت کردن خبر در دیتابیس
    $update_query = "UPDATE posts SET title = ?, content = ?, image = ?, category_id = ?, user_id = ?, updated_at = NOW() WHERE id = ?";
    $params = [$title, $content, $image_path, $category_id, $user_id, $post_id];

    // اجرای پرس و جو بدون چک کردن موفقیت
    db_query($update_query, $params);

    // هدایت به صفحه news_management.php پس از موفقیت
    header("Location: news_managment.php?success=updated");
    exit;
}

// دریافت لیست دسته‌بندی‌ها
$categories = db_query("SELECT * FROM categories");

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
<style>
        .container-fluid {
            max-width: 1000px;
            margin: 0 auto;
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .card-body {
            padding: 20px;
        }

        form .form-label {
            font-weight: bold;
        }

        form .form-control {
            margin-bottom: 15px;
        }

        button.btn-primary {
            background-color: #4caf50;
            border-color: #4caf50;
        }
    </style>
    <meta charset="UTF-8">
    <title>ویرایش خبر</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show" style="background-color:#22272b">
    <?php include 'sidebar.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">


                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">ویرایش خبر</h6>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav  justify-content-end">


                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 p-3">
                        <div class="card-header pb-0">
                            <h6>جزئیات</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form method="POST" enctype="multipart/form-data">
                                <!-- نمایش خطاهای احتمالی -->
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <p><?= htmlspecialchars($error) ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="title" class="form-label">عنوان</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="<?= htmlspecialchars($news['title']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">محتوای خبر</label>
                                    <textarea class="form-control" id="content" name="content" required><?= htmlspecialchars($news['content']) ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">دسته بندی</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $news['category_id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($cat['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">عکس فعلی</label>
                                    <div>
                                        <img src="<?php echo SITE_URL; ?>pages/uploads/<?= htmlspecialchars($news['image']) ?>" class="img-fluid rounded" style="max-width: 200px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">تغییر عکس</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <button type="submit" class="btn btn-primary">ویرایش خبر</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

</body>

</html>