<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// بررسی نقش کاربر (فقط admin و author مجاز به حذف هستند)


// حذف خبر
if (isset($_GET['delete'])) {
  $post_id = intval($_GET['delete']); // جلوگیری از تزریق SQL

  // بررسی وجود پست قبل از حذف
  $post = db_query("SELECT id FROM posts WHERE id = ?", [$post_id]);
  if (!$post) {
    die("Error: Post not found.");
  }

  // اجرای حذف
  db_query("DELETE FROM posts WHERE id = ?", [$post_id]);
  header("Location: news_managment.php?success=deleted");
  exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    مدیریت اخبار
  </title>
  <!--     Fonts and icons     -->
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
  <script>
    function confirmDelete(id) {
      if (confirm("Are you sure you want to delete this news?")) {
        window.location.href = "news_managment.php?delete=" + id;
      }
    }
  </script>
</head>

<body class="g-sidenav-show" style="background-color: #22272b;">

  <?php include 'sidebar.php'; ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">


        <nav aria-label="breadcrumb">
          
          <h6 class="font-weight-bolder text-white mb-0">مدیریت اخبار</h6>
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


    <?php
    require_once '../../config/db.php'; // فرض می‌کنیم که db.php درست تنظیم شده است

    // بازیابی اخبار از دیتابیس
    $news = db_query("SELECT p.id, p.title, p.content, p.image, c.name as category, u.username as author, p.created_at FROM posts p
                  JOIN categories c ON p.category_id = c.id
                  JOIN users u ON p.user_id = u.id");

    ?>

    <div class="container-fluid py-4">
      <?php if (isset($_GET['success']) && $_GET['success'] == 'updated'): ?>
        <div id="successMessage" class="alert alert-success">
          خبر با موفقیت ویرایش شد
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['success']) && $_GET['success'] == 'deleted'): ?>
        <div id="successMessage" class="alert alert-success">
          خبر با موفقیت حذف شد
        </div>
      <?php endif; ?>

      <script>
        // پیدا کردن پیام موفقیت و مخفی کردن آن بعد از 3 ثانیه
        setTimeout(function() {
          var message = document.getElementById("successMessage");
          if (message) {
            message.style.transition = "opacity 0.5s ease"; // اضافه کردن افکت محو شدن
            message.style.opacity = "0"; // تغییر شفافیت به 0

            setTimeout(function() {
              message.style.display = "none"; // مخفی کردن کامل
            }, 500); // زمان تکمیل افکت محو شدن
          }
        }, 3000); // 3 ثانیه تاخیر قبل از مخفی شدن
      </script>



      <div class="row">
        <div class="col-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">لیست اخبار</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <?php foreach ($news as $item): ?>
                  <li class="list-group-item border-0 d-flex justify-content-between align-items-center p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column  " style="width: 40%">
                      <h6 class="mb-3 text-sm"><?= htmlspecialchars($item['title']) ?></h6>
                      <span class="mb-2 text-xs">دسته بندی: <span class="text-dark font-weight-bold ms-sm-2"><?= htmlspecialchars($item['category']) ?></span></span>
                      <span class="mb-2 text-xs">نویسنده: <span class="text-dark font-weight-bold ms-sm-2"><?= htmlspecialchars($item['author']) ?></span></span>
                      <span class="text-xs">تاریخ ایجاد: <span class="text-dark font-weight-bold ms-sm-2"><?= $item['created_at'] ?></span></span>
                    </div>

                    <div class="ml-3 " style="width: 35%; height: 100px;">
                      <img src="<?php echo SITE_URL; ?>pages/uploads/<?= htmlspecialchars($item['image']) ?>" alt="News Image" class="news-image border-radius-lg " style="object-fit:contain; width: 100%; height:100%;">
                    </div>

                    <div class="text-end" style="width: 20%">
                      <!-- دکمه حذف -->
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0 <?= ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'author') ? 'disabled-link' : '' ?>"
                        href="<?= ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'author') ? 'javascript:void(0);' : '#' ?>"
                        <?= ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'author') ? 'style="pointer-events: auto; color: #6c757d;"' : 'onclick="confirmDelete(' . $item['id'] . ')"' ?>>
                        <i class="far fa-trash-alt me-2"></i>حذف
                      </a>

                      <!-- دکمه ویرایش -->
                      <a class="btn btn-link text-dark px-3 mb-0 <?= ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'author') ? 'disabled-link' : '' ?>"
                        href="<?= ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'author') ? 'edit_news.php?id=' . $item['id'] : '#' ?>"
                        <?= ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'author') ? 'style="pointer-events: auto; color: #6c757d;"' : '' ?>>
                        <i class="fas fa-pencil-alt text-dark me-2"></i>ویرایش
                      </a>
                    </div>


                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>



  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>