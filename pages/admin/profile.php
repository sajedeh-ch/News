<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db.php';

// بررسی لاگین بودن کاربر
if (!isset($_SESSION['user_id'])) {
    header('Location: ../sign-in.php'); // برگشت به sign-in.php در پوشه بالا
    exit;
}

// دریافت اطلاعات کاربر از دیتابیس
$user = db_query_single("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']]);

// بررسی ارسال فرم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // دریافت اطلاعات ارسال شده
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // اعتبارسنجی اطلاعات
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // در صورتی که خطا نباشد، اطلاعات کاربر را در دیتابیس بروزرسانی می‌کنیم
    if (empty($errors)) {
        $update_query = "UPDATE users SET username = ?, email = ?";

        // اگر کاربر رمز عبور جدید وارد کرده باشد، باید آن را ذخیره کنیم
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $update_query .= ", password = ?";
            $params = [$username, $email, $passwordHash];
        } else {
            $params = [$username, $email];
        }

        $update_query .= " WHERE id = ?";
        $params[] = $_SESSION['user_id']; // اضافه کردن id کاربر به پارامترها

        db_query($update_query, $params);

        // بعد از بروزرسانی اطلاعات، صفحه به‌روزرسانی می‌شود
        header("Location: profile.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حساب کاربری</title>
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

<body class="g-sidenav-show" style="background-color: #22272b;">

    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">


                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">مدیریت حساب</h6>
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
                            <h6>ویراش مشخصات</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form method="POST">
                                <!-- نمایش خطاهای احتمالی -->
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <p><?= htmlspecialchars($error) ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="username" class="form-label">نام کاربری</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= isset($user['username']) ? htmlspecialchars($user['username']) : '' ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">ایمیل</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">رمز عبور(جدید)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
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
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>