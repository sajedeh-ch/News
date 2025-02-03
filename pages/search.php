<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/config.php';

$q = $_GET['q'] ?? '';

if (strlen($q) < 2) {
    exit;
}

// جستجو در عنوان و محتوای اخبار
$results = db_query(
    "SELECT id, title FROM posts WHERE title LIKE ? OR content LIKE ? LIMIT 5",
    ["%$q%", "%$q%"]
);

if (!$results) {
    echo "<div class='search-item'>No results found</div>";
} else {
    foreach ($results as $post) {
        echo "<a href='" . SITE_URL . "/pages/news_detail.php?id=" . $post['id'] . "' class='search-item'>" . htmlspecialchars($post['title']) . "</a>";
    }
}
?>
