<?php
require_once 'config.php';

/**
 * اجرای یک کوئری SELECT و بازگرداندن نتایج
 *
 * @param string $query کوئری SQL برای SELECT
 * @param array $params آرایه‌ای از مقادیر برای جایگذاری در کوئری
 * @return array|null نتایج به صورت آرایه‌ای از مقادیر انجمنی یا null اگر داده‌ای یافت نشد
 */
function db_query($query, $params = []) {
    global $conn;
    
    // بررسی اتصال به دیتابیس
    if (!$conn) {
        error_log("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
        return null;
    }

    $stmt = $conn->prepare($query); // آماده‌سازی کوئری

    if (!$stmt) {
        error_log("خطا در آماده‌سازی کوئری: " . $conn->error);
        return null;
    }

    if ($params) {
        $types = str_repeat('s', count($params)); // فرض بر اینکه تمام مقادیر رشته هستند
        $stmt->bind_param($types, ...$params); // متصل کردن پارامترها
    }

    if (!$stmt->execute()) {
        // ثبت خطا در صورت وجود مشکل
        error_log("خطا در اجرای کوئری: " . $stmt->error);
        return null;
    }

    $result = $stmt->get_result(); // دریافت نتیجه
    $stmt->close(); // بستن statement
    return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : null; // بازگرداندن داده‌ها یا null
}

/**
 * اجرای یک کوئری INSERT، UPDATE یا DELETE
 *
 * @param string $query کوئری SQL
 * @param array $params آرایه‌ای از مقادیر برای جایگذاری در کوئری
 * @return bool صحیح در صورت موفقیت، غلط در صورت شکست
 */
function db_execute($query, $params = []) {
    global $conn;

    // بررسی اتصال به دیتابیس
    if (!$conn) {
        error_log("خطا در اتصال به دیتابیس: " . mysqli_connect_error());
        return false;
    }

    $stmt = $conn->prepare($query); // آماده‌سازی کوئری

    if (!$stmt) {
        error_log("خطا در آماده‌سازی کوئری: " . $conn->error);
        return false;
    }

    if ($params) {
        $types = str_repeat('s', count($params)); // فرض بر اینکه تمام مقادیر رشته هستند
        $stmt->bind_param($types, ...$params); // متصل کردن پارامترها
    }

    if (!$stmt->execute()) {
        // ثبت خطا در صورت وجود مشکل
        error_log("خطا در اجرای عملیات: " . $stmt->error);
        return false;
    }

    $stmt->close(); // بستن statement
    return true; // موفقیت‌آمیز بودن عملیات
}

/**
 * دریافت یک سطر از نتایج پایگاه داده
 *
 * @param string $query کوئری SELECT با مقادیر جایگزین
 * @param array $params آرایه‌ای از مقادیر برای جایگذاری در کوئری
 * @return array|null یک سطر به صورت آرایه انجمنی یا null اگر داده‌ای یافت نشد
 */
function db_query_single($query, $params = []) {
    $result = db_query($query, $params); // اجرای کوئری
    return $result ? $result[0] : null; // بازگرداندن اولین سطر
}
?>
