<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db.php';

$errors = [];

// بررسی ارسال فرم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // بررسی اینکه آیا فیلدهای فرم ارسال شده‌اند
  $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
  $password = isset($_POST["password"]) ? $_POST["password"] : '';

  // اعتبارسنجی ایمیل و رمز عبور
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }
  if (empty($password)) {
    $errors[] = "Password is required.";
  }

  // اگر خطایی نبود، ورود کاربر را بررسی کنیم
  if (empty($errors)) {
    try {
      // جستجوی کاربر در دیتابیس
      $user = db_query_single("SELECT * FROM users WHERE email = ?", [$email]);

      if ($user && password_verify($password, $user["password"])) {
        // ثبت اطلاعات در سشن
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];  // اضافه کردن نقش کاربر به سشن

        // ثبت وضعیت آنلاین در دیتابیس
        db_query("UPDATE users SET is_online = 1 WHERE id = ?", [$user["id"]]);

        // ذخیره یا به‌روزرسانی زمان آخرین ورود در جدول `sessions`
        db_query(
          "INSERT INTO sessions (user_id, last_activity) VALUES (?, NOW()) 
                  ON DUPLICATE KEY UPDATE last_activity = NOW()",
          [$user["id"]]
        );

        // هدایت به داشبورد یا صفحه‌ای که قرار است نمایش داده شود
        header("Location: admin/dashboard.php");
        exit;
      } else {
        $errors[] = "Invalid email or password.";
      }
    } catch (Exception $e) {
      // در صورت بروز خطا در دیتابیس
      $errors[] = "An error occurred while processing your request. Please try again later.";
    }
  }
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
    Soft UI Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />

  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">


  <main class="main-content mt-0" style="background-color: #22272b;">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-center bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">خوش آمدید</h3>
                </div>
                <div class="card-body">

                  <!-- نمایش پیام‌های خطا -->
                  <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                      <?php foreach ($errors as $error) {
                        echo "<p>$error</p>";
                      } ?>
                    </div>
                  <?php endif; ?>

                  <form method="POST" action="">
                    <label>ایمیل</label>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="ایمیل" required>
                    </div>
                    <label>رمز عبور</label>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="رمز عبور" required>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">ورود</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    آیا حساب کاربری ندارید؟
                    <a href="sign-up.php" class="text-info text-gradient font-weight-bold">ثبت نام</a>
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>