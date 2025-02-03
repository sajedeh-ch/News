<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db.php';

// بررسی نقش کاربر (فقط مدیران می‌توانند کاربران را حذف کنند و نقش تغییر دهند)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  die("Access Denied");
}

// دریافت لیست کاربران از دیتابیس
$users = db_query("SELECT id, username, email, is_online, role FROM users");

// حذف کاربر در صورت ارسال درخواست حذف و بررسی دسترسی مدیر
if (isset($_POST['delete_user'])) {
  $user_id = intval($_POST['user_id']);
  db_query("DELETE FROM users WHERE id = ?", [$user_id]);
  header("Location: users.php");
  exit;
}

// تغییر نقش کاربر
if (isset($_POST['change_role'])) {
  $user_id = intval($_POST['user_id']);
  $new_role = $_POST['role'];
  db_query("UPDATE users SET role = ? WHERE id = ?", [$new_role, $user_id]);
  header("Location: users.php");
  exit;
}

// تغییر نقش کاربر (فقط برای ادمین‌ها)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_role'])) {
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied");
  }

  $user_id = intval($_POST['user_id']);
  $new_role = $_POST['role'];

  // اطمینان از اینکه مقدار `role` فقط `admin` یا `user` است
  if (!in_array($new_role, ['user', 'admin'])) {
    die("Invalid Role");
  }

  db_query("UPDATE users SET role = ? WHERE id = ?", [$new_role, $user_id]);

  // هدایت مجدد برای نمایش تغییرات
  header("Location: users.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
    مدیریت کاربران
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

<body class="g-sidenav-show " style="background-color: #22272b;">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">


        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder text-white mb-0">مدیریت کاربران</h6>
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
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>جدول کاربران</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام کاربری</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نقش</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مدیریت</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($users): ?>
                      <?php foreach ($users as $user): ?>
                        <tr>

                          <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?= htmlspecialchars($user['username']) ?></h6>
                                <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($user['email']) ?></p>
                              </div>
                            </div>
                          </td>



                          <td class="align-middle text-center">
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                              <form method="POST" action="users.php">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <select name="role" class="form-select text-xs font-weight-bold" style="direction: ltr;" onchange="this.form.submit()">
                                  <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                  <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                  <option value="author" <?= $user['role'] == 'author' ? 'selected' : '' ?>>Author</option>
                                </select>
                                <input type="hidden" name="change_role" value="1">
                              </form>
                            <?php else: ?>
                              <span class="text-secondary text-xs font-weight-bold"><?= htmlspecialchars($user['role']) ?></span>
                            <?php endif; ?>
                          </td>
                          

                          
                          <td class="align-middle text-center">
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                              <form method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <button type="submit" name="delete_user" class="text-secondary font-weight-bold text-xs bg-transparent border-0 text-danger">
                                  حذف
                                </button>
                              </form>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" class="text-center">No users found.</td>
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