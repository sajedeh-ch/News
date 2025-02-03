<?php
require_once 'config/db.php'; // فراخوانی فایل اتصال به پایگاه داده
$query = "SELECT posts.*, categories.name AS category_name
          FROM posts
          JOIN categories ON posts.category_id = categories.id
          ORDER BY posts.created_at DESC LIMIT 4";

if ($query) {
    $latestPosts = db_query($query);
} else {
    echo "Query is empty!";
}


?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
	<title>Home 01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>pages/uploads/logo.svg" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="<?= SITE_URL; ?>css/main.css?v=1.0">
	<!--===============================================================================================-->
</head>

<body class="animsition">

	<?php include 'component/Navbar.php'; ?>


	<!-- Feature post -->
	<section class="feature-post pt-3">
		<div class="container">
			<div class="row m-rl--1">
				<?php if (!empty($latestPosts)): ?>
					<!-- پست اول (ویژه) -->
					<div class="col-md-6 p-rl-1 p-b-2">
						<div class="bg-img1 size-a-3 how1 pos-relative"
							style="background-image: url('pages/uploads/<?php echo htmlspecialchars($latestPosts[0]['image']); ?>');"
							onclick="location.href='pages/news_detail.php?id=<?php echo htmlspecialchars($latestPosts[0]['id']); ?>';">
							<a href="#" class="dis-block how1-child1 trans-03"></a>
							<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
								<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
									<?php echo htmlspecialchars($latestPosts[0]['category_name']); ?>
								</a>
								<h3 class="how1-child2 m-t-14 m-b-10">
									<a href="pages/news_detail.php?id=<?php echo htmlspecialchars($latestPosts[0]['id']); ?>" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
										<?php echo htmlspecialchars($latestPosts[0]['title']); ?>
									</a>
								</h3>
								<span class="how1-child2">
									<span class="f1-s-4 cl11"><?php echo htmlspecialchars($latestPosts[0]['author_id']); ?></span>
									<span class="f1-s-3 cl11 m-rl-3">-</span>
									<span class="f1-s-3 cl11"><?php echo date('M d', strtotime($latestPosts[0]['created_at'])); ?></span>
								</span>
							</div>
						</div>
					</div>

					<div class="col-md-6 p-rl-1">
						<div class="row m-rl--1">
							<!-- پست دوم -->
							<div class="col-12 p-rl-1 p-b-2">
								<div class="bg-img1 size-a-4 how1 pos-relative"
									style="background-image: url('pages/uploads/<?php echo htmlspecialchars($latestPosts[1]['image']); ?>');"
									onclick="location.href='pages/news_detail.php?id=<?php echo htmlspecialchars($latestPosts[1]['id']); ?>';">
									<a href="#" class="dis-block how1-child1 trans-03"></a>
									<div class="flex-col-e-s s-full p-rl-25 p-tb-24">
										<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
											<?php echo htmlspecialchars($latestPosts[1]['category_name']); ?>
										</a>
										<h3 class="how1-child2 m-t-14">
											<a href="pages/news_detail.php?id=<?php echo htmlspecialchars($latestPosts[1]['id']); ?>" class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
												<?php echo htmlspecialchars($latestPosts[1]['title']); ?>
											</a>
										</h3>
									</div>
								</div>
							</div>

							<!-- پست‌های بعدی -->
							<div class="col-12 p-rl-1">
								<div class="row m-rl--1">
									<?php foreach (array_slice($latestPosts, 2) as $post): ?>
										<div class="col-sm-6 p-rl-1 p-b-2">
											<div class="bg-img1 size-a-5 how1 pos-relative"
												style="background-image: url('pages/uploads/<?php echo htmlspecialchars($post['image']); ?>');"
												onclick="location.href='pages/news_detail.php?id=<?php echo htmlspecialchars($post['id']); ?>';">
												<a href="#" class="dis-block how1-child1 trans-03"></a>
												<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
													<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
														<?php echo htmlspecialchars($post['category_name']); ?>
													</a>
													<h3 class="how1-child2 m-t-14">
														<a href="pages/news_detail.php?id=<?php echo htmlspecialchars($post['id']); ?>" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
															<?php echo htmlspecialchars($post['title']); ?>
														</a>
													</h3>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>

				<?php else: ?>
					<p>هیچ پستی برای نمایش وجود ندارد.</p>
				<?php endif; ?>
			</div>
		</div>
	</section>





	<!-- Post -->
	<section class="post-section p-t-70">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="p-b-20">
						


						<!-- Other -->

						<?php
						require_once 'config/db.php'; // اتصال به پایگاه داده

						// دریافت لیست دسته‌بندی‌ها
						$queryCategories = "SELECT id, name FROM categories";
						$categories = db_query($queryCategories);
						?>

						<div class="row">
							<?php if (!empty($categories)) : ?>
								<?php foreach ($categories as $category) : ?>
									<?php
									// دریافت پست‌های مرتبط با دسته‌بندی
									$queryPosts = "SELECT 
                    									p.id, 
                    									p.title, 
                    									p.image, 
                    									p.created_at, 
                    									c.name AS category_name
                									FROM 
                    									posts p
                									JOIN 
                    									categories c ON p.category_id = c.id
                									WHERE 
                    									c.id = ?
                									ORDER BY 
                    									p.created_at DESC
                									LIMIT 3
            									";

									// اجرای کوئری با مقدار دسته‌بندی
									$posts = db_query($queryPosts, [$category['id']]);

									if (!$posts) {
										$posts = [];
									}
									?>

									<div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
									<div class="how2 how2-cl<?= htmlspecialchars($category['id']); ?> flex-sb-c m-b-35">

											<h3 class="f1-m-2 text-white tab01-title">
												<?= htmlspecialchars($category['name']); ?>
											</h3>
											<a href="pages/category.php?id=<?= htmlspecialchars($category['id']); ?>" class="tab01-link f1-s-1 cl0 hov-cl10 trans-03">
												<i class="fs-12 m-l-5 fa fa-caret-right"></i>
												مشاهده همه
											</a>
										</div>

										<?php if (!empty($posts)) : ?>
											<?php foreach ($posts as $index => $post) : ?>
												<?php if ($index === 0) : ?>
													<!-- پست اصلی -->
													<div class="m-b-30" onclick="window.location.href='pages/news_detail.php?id=<?= htmlspecialchars($post['id']); ?>'" style="cursor: pointer;">
														<div class="wrap-pic-w hov1 trans-03">
															<img src="pages/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>">
														</div>
														<div class="p-t-20">
															<h5 class="p-b-5">
																<a class="f1-m-3 text-white hov-cl10 trans-03">
																	<?= htmlspecialchars($post['title']); ?>
																</a>
															</h5>
															<span class="cl11">
																<span class="f1-s-4 cl11 hov-cl10 trans-03">
																	<?= htmlspecialchars($post['category_name']); ?>
																</span>
																<span class="f1-s-3 m-rl-3">-</span>
																<span class="f1-s-3">
																	<?= htmlspecialchars(date("M d", strtotime($post['created_at']))); ?>
																</span>
															</span>
														</div>
													</div>
												<?php else : ?>
													<!-- پست‌های دیگر -->
													<div class="flex-wr-sb-s m-b-30" onclick="window.location.href='pages/news_detail.php?id=<?= htmlspecialchars($post['id']); ?>'" style="cursor: pointer;">
														<div class="size-w-1 wrap-pic-w hov1 trans-03">
															<img src="pages/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>">
														</div>
														<div class="size-w-2">
															<h5 class="p-b-5">
																<a class="f1-s-5 text-white hov-cl10 trans-03">
																	<?= htmlspecialchars($post['title']); ?>
																</a>
															</h5>
															<span class="cl11">
																<span class="f1-s-6 cl11 hov-cl10 trans-03">
																	<?= htmlspecialchars($post['category_name']); ?>
																</span>
																<span class="f1-s-3 m-rl-3">-</span>
																<span class="f1-s-3">
																	<?= htmlspecialchars(date("M d", strtotime($post['created_at']))); ?>
																</span>
															</span>
														</div>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php else : ?>
											<p>No posts found for <?= htmlspecialchars($category['name']); ?> category.</p>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<p>No categories found.</p>
							<?php endif; ?>
						</div>



					</div>
				</div>
			</div>
		</div>
	</section>






	<?php include 'component/Footer.php'; ?>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>



	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>