<?php
// تنظیمات اتصال به پایگاه داده
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'news_db';

// URL اصلی سایت (تغییر دهید به URL سایت خود)
define('SITE_URL', 'http://localhost/Newz/');

// ایجاد اتصال به پایگاه داده
$conn = new mysqli($host, $username, $password, $dbname);

// بررسی وضعیت اتصال
if ($conn->connect_error) {
    die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
}

// تنظیم مجموعه کاراکتر به UTF-8 برای پشتیبانی از زبان فارسی
if (!$conn->set_charset("utf8")) {
    die("خطا در تنظیم مجموعه کاراکتر: " . $conn->error);
}
?>
