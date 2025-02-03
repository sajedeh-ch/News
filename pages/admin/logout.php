<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// اگر کاربر لاگین کرده بود، وضعیت را به آفلاین تغییر دهید
if (isset($_SESSION["user_id"])) {
    db_query("UPDATE users SET is_online = 0 WHERE id = ?", [$_SESSION["user_id"]]);
}

// حذف سشن و خروج از سیستم
session_unset();
session_destroy();

// هدایت به صفحه ورود
header("Location: ../../index.php");
exit;
?>
