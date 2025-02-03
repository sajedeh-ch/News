<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db.php';

// دریافت تعداد اخبار در هر دسته‌بندی
$categories_count = db_query("SELECT categories.id, categories.name, COUNT(posts.id) AS total FROM categories 
                              LEFT JOIN posts ON categories.id = posts.category_id 
                              GROUP BY categories.id");

// دریافت لیست اخبار با نام دسته‌بندی و نویسنده
$news = db_query("SELECT posts.id, posts.title, posts.created_at, users.username, categories.name AS category_name
                  FROM posts
                  LEFT JOIN users ON posts.author_id = users.id
                  LEFT JOIN categories ON posts.category_id = categories.id
                  ORDER BY posts.created_at DESC");

if (!isset($_SESSION["user_id"])) {
  // اگر وارد نشده، هدایت به صفحه ورود
  header("Location: ../sign-in.php");
  exit;
}

// دسترسی به اطلاعات کاربر
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
    داشبورد
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
</head>

<body class="g-sidenav-show " style="background-color:#22272b;">

  <?php include 'sidebar.php'; ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">



    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">


        <nav aria-label="breadcrumb">
          
          <h6 class="font-weight-bolder text-white mb-0">داشبورد</h6>
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


      <div class="row my-4">
        <div class="col-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>همه اخبار</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عنوان</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نویسنده</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دسته بندی</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاریخ ایجاد</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($news): ?>
                      <?php foreach ($news as $post): ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?= htmlspecialchars($post['title']) ?></h6>
                              </div>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?= htmlspecialchars($post['username']) ?></h6>
                              </div>
                            </div>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"><?= htmlspecialchars($post['category_name']) ?></span>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"><?= date("M d, Y", strtotime($post['created_at'])) ?></span>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4" class="text-center">خبری یافت نشد</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>