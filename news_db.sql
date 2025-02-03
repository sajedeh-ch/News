-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 02:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'استانی', '2025-01-28 07:40:17'),
(2, 'سیاسی', '2025-01-28 07:40:17'),
(3, 'فرهنگی', '2025-01-28 07:40:17'),
(4, 'اقتصادی', '2025-01-28 07:40:17'),
(5, 'ورزشی', '2025-01-28 07:40:17'),
(6, 'اجتماعی', '2025-01-28 07:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image`, `category_id`, `author_id`, `created_at`, `updated_at`) VALUES
(6, 8, 'دستگاه‌های اجرایی از ظرفیت نخبگان خراسان جنوبی استفاده کنند', 'رئیس بنیاد نخبگان خراسان جنوبی گفت: دستگاه‌های اجرایی برای جذب نیرو از ظرفیت نخبگان استان استفاده کنند تا بتوانیم در توسعه استان قدم‌های مؤثری برداریم.\r\nبه گزارش خبرگزاری تسنیم از بیرجند، محمدمهدی ایزدخواه در نشست خبری با بیان اینکه بنیاد ملی نخبگان به عنوان یک نهاد فرادستگاهی در سال 1383 بر اساس بیانات مقام معظم رهبری تأسیس شد اظهارداشت: هدف این بنیاد، تنظیم‌گری و تسهیل امور نخبگان در کشور است.', '13.jpg', 3, 8, '2025-01-28 09:03:25', '2025-02-03 12:57:17'),
(7, 8, 'افتتاح و آغاز عملیات اجرایی بیش از ۲۰ پروژه گازرسانی در طبس', 'همزمان با سومین روز از دهه مبارک فجر، ۲۰ پروژه گازرسانی در شهرستان طبس افتتاح شد.\r\nبه گزارش خبرنگار تسنیم از طبس، همزمان با سومین روز از دهه مبارک فجر و با حضور استاندار خراسان جنوبی،  فرماندار ویژه شهرستان طبس، امام جمعه شهرستان طبس ، مدیرعامل شرکت گاز استان و جمعی از مسئولان استانی و شهرستانی، 20 پروژه گازرسانی در شهرستان طبس افتتاح شد.', '2.jpg', 1, 8, '2025-01-28 08:59:00', '2025-02-03 12:57:20'),
(8, 8, 'معاینه فنی ۲۷۸۳۸ دستگاه ناوگان سنگین حمل و نقل خراسان جنوبی', 'معاون حمل و نقل اداره کل راهداری و حمل و نقل جاده‌ای خراسان جنوبی از انجام معاینه فنی ۲۷ هزار و ۸۳۸ دستگاه ناوگان سنگین از ابتدای سال جاری خبر داد.\r\nبه گزارش خبرگزاری تسنیم از بیرجند، علی اکبر مزیدی در گفتگو با خبرنگاران اظهار کرد: با توجه به فعالیت 4 مرکز معاینه فنی خودروهای سنگین در استان 27 هزار و 838 دستگاه ماشین آلات سنگین از ابتدای سال جاری به این مراکز مراجعه کرده‌اند.', '3.jpg', 1, 8, '2025-01-28 09:03:25', '2025-02-03 12:57:23'),
(9, 8, 'تشرف ۳۰۰ دانش‌آموز نیازمند بیرجندی به زیارت امام حسین(ع)', 'به گزارش خبرگزاری تسنیم از بیرجند، محمد عرب در جمع خبرنگاران با اشاره به فعالیت‌های اردویی و زیارتی این نهاد در راستای خدمات فرهنگی و معنوی به مددجویان اظهار کرد: در سفر رئیس کمیته‌ امداد امام خمینی(ره) بازدیدی از کانون شهید آوینی و فعالیت‌های این کانون و خوابگاه شبانه‌روزی مجتمع فرهنگی و تربیتی امامت بیرجند انجام شد که در این بازدید قول اعزام 300 نفر از دانش‌آموزان کانون و خوابگاه به کربلای معلی داده شد.', '4.jpg', 1, 8, '2025-01-28 09:03:25', '2025-02-03 12:57:27'),
(10, 8, 'وحدت عامل خنثی‌سازی توطئه دشمن و امیدآفرینی است', 'فرمانده سپاه انصارالرضا(ع) خراسان جنوبی گفت: امروز دشمن به دنبال ترویج ناامیدی در بین مردم ایران اسلامی است بنابراین باید با وحدت، توطئه‌های دشمنان را خنثی و امیدآفرینی را برای مردم به ارمغان بیاوریم.\r\nبه گزارش خبرگزاری تسنیم از بیرجند، سردار حسن شجاعی‌نسب فرمانده انتظامی خراسان جنوبی امروز در سالروز ولادت امام حسین(علیه‌السلام) و روز پاسدار با فرمانده سپاه انصارالرضا(علیه‌السلام) دیدار کرد.', '10.jpg', 3, 8, '2025-01-28 09:03:25', '2025-02-03 12:57:29'),
(11, 8, 'بهره برداری از باند دوم محور بیرجند-قاین تا خرداد ۱۴۰۴', 'به گزارش خبرگزاری صدا و سیمای خراسان جنوبی، مدیر کل راه و شهرسازی خراسان جنوبی در گفتگو با خبرنگار صدا و سیما گفت: از ۱۰۰ کیلومتر محور بیرجند-قاین ۱۲ کیلومتر باقیمانده بود که از ابتدای سال ۴ کیلومتر آن به بهره‌برداری رسیده است.\r\n مودی افزود: از ۸ کیلومتر باقیمانده نیز ۴ کیلومتر در مراحل روسازی است که با توجه به شرایط آب و هوایی و قطعی برق آسفالت آن در این ماه آغاز شده است.\r\nوی گفت: پیش بینی می‌شود دوبانده سازی محور بیرجند-قاین تا خرداد سال آینده به پایان برسد.', '5.jpg', 1, 8, '2025-01-28 09:03:25', '2025-02-03 12:57:36'),
(12, 8, 'تولید حدود ۱۸ میلیون مترمربع کاشی و سرامیک در خراسان جنوبی', 'به گزارش خبرگزاری صدا و سیمای خراسان جنوبی، مدیر کل صنعت معدن و تجارت استان در گفت‌و‌گو با خبرنگار صدا و سیما گفت: این مقدار کاشی و سرامیک در ۳ واحد تولید کاشی و سرامیک استان تولید شده است. ۳ واحد کاشی و سرامیک با ظرفیت سالانه ۲۶ میلیون متر مربع در استان فعالیت دارند.\r\n\r\nآریا فر افزود: این رقم در کل سال ۱۴۰۲ به مقدار ۲۰ میلیون مترمربع بوده است.', '6.jpg', 1, 8, '2023-02-16 20:30:00', '2025-02-03 12:57:33'),
(13, 8, 'تخصیص ۳۰۰ میلیارد تومان اعتبار برای طرح راه آهن زاهدان - بیرجند', 'به گزارش خبرگزاری صدا و سیمای خراسان جنوبی، هاشمی گفت: با پیگیری های استاندار خراسان جنوبی، مجمع نمایندگان استان و مدیر کل راه و شهرسازی استان ۳۰۰ میلیارد تومان اعتبار برای پروژه راه آهن زاهدان- یونسی تخصیص و ابلاغ آن صادر شد.\r\n\r\nوی ابراز امیدواری کرد: با پیگیری‌ های همه جانبه، طرح راه آهن استان در مورد موعد مقرر به پایان برسد.', '1.jpg', 1, 8, '2023-02-15 20:30:00', '2025-02-03 12:57:39'),
(14, 8, 'ثبت ۱۱ اختراع در دانشگاه بیرجند', 'به گزارش خبرگزاری صدا و سیمای خراسان جنوبی، کارشناس ارتباط با جامعه و صنعت دانشگاه بیرجند در گفت‌و‌گو با خبرنگار صدا و سیما گفت: از این اختراعات یک مورد تجاری‌سازی شده است.\r\nشیرازی افزود: همچنین در این مدت ۲۱ اکتشاف در این دانشگاه ثبت شده است.\r\nوی همچنین به انعقاد ۹۲ طرح پژوهشی بین دانشگاه و سازمان‌های صنعتی در س سال اخیر اشاره کرد و گفت: همچنین ۴۴ طرح پژوهشی تقاضا محور در دانشگاه انجام شده است.', '7.jpg', 1, 8, '2023-02-11 20:30:00', '2025-02-03 12:57:41'),
(15, 8, 'مرمت ۵۰ بنای تاریخی در خراسان جنوبی', 'به گزارش خبرگزاری صدا و سیمای خراسان جنوبی، مدیرکل میراث فرهنگی، گردشگری و صنایع دستی خراسان جنوبی گفت: این بنا‌ها شامل خانه‌های تاریخی و بافت تاریخی در تمامی شهرستان‌ها است.\r\n\r\nشاهوردی اعتبار هزینه شده برای مرمت این بنا‌ها را ۲۷ میلیارد تومان اعلام کرد و افزود: از این رقم ۲۳ میلیارد تومان اعتبار ملی و ۴ میلیارد تومان اعتبار استانی بوده است.', '8.jpg', 3, 8, '2023-02-15 20:30:00', '2025-02-03 12:57:44'),
(16, 8, 'مهار حریق انبار کفش در شهر بیرجند', 'به گزارش خبرگزاری صدا و سیمای خراسان جنوبی، رئیس سازمان آتش نشانی شهرداری بیرجند گفت: انبار کفش در طبقه فوقانی کفش فروشی حد فاصل معلم ۲۱ و ۲۳ بیرجند امروز ساعت ۱۰:۳۲ دچار حریق شد.\r\nعنایتی افزود: از ۳ ایستگاه آتش نشانی به محل حادثه اعزام شدند و حریق مهار شده است. \r\nوی گفت: علت حادثه در دست بررسی است.', '9.jpg', 1, 8, '2023-02-16 20:30:00', '2025-02-03 12:57:47'),
(17, 8, 'گام اول موفقیت، بالابردن تحمل و شنیدن سخن مخالف است', 'رئیس جمهور با بیان اینکه نگاه ما به مردم نباید اینگونه باشد که آنها را دیگران ببینیم و خودمان را خودی گفت: قرآن به ما می‌آموزد که خداوند پاداش هر کار خیر را ۱۰ برابر می‌دهد، اما برای کار بد به اندازه همان کار بد مجازات در نظر می‌گیرد.', '10.jpg', 6, 8, '2023-02-17 20:30:00', '2025-02-03 12:57:50'),
(21, 8, 'سپاه، بزودی ناو چند منظوره‌ای را رونمایی می‌کند', 'دریادار تنگسیری، فرمانده نیروی دریایی سپاه در حاشیه چهاردهمین جشنواره مالک اشتر و در گفت‌و‌گو با خبرنگار خبرگزاری صداوسیما، گفت: ۳ فروند شناور از نیروی دریایی سپاه و یک فروند شناور نیروی دریایی ارتش، نخستین بار به امارات رفتند.\r\n\r\nسردار تنگسیری افزود: ناو‌های پهپادبر و چند منظوره‌ای داریم که بالگرد، پهپاد و هم شناور می‌برد و این در دنیا بی سابقه است و در آینده به تجهیزات نیروی دریایی می‌پیوندد.', '11.jpg', 2, 8, '2025-01-28 14:19:58', '2025-02-03 12:58:00'),
(22, 8, 'توانمندی‌ دفاعی، دشمن را از طمع به خاک ایران پشیمان می‌کند', '«امروز از نمایشگاه دستاورد‌های فضایی و دفاعی کشور بازدید کردم. توانمندی‌های کشور به سطحی رسیده که دشمنان را از طمع به خاک ایران پشیمان کند. این توانمندی‌ها به اعتبار جوانان خلاق و دانشمندمان به دست آمده است و برای ارتقای توان دفاعی کشور است و نه تهاجم.', '12.jpg', 2, 8, '2025-01-28 14:19:58', '2025-02-03 12:58:04'),
(23, 8, 'ظرفیت تولید برق کشور از مرز ۱۰۰ هزار مگاوات عبور می‌کند', 'در ادامه این سفر عباس علی ابادی وزیر نیرو، با اشاره به وضعیت منابع آبی کشور، چاره اصلی حل مشکل آب در کشور را مدیریت مصرف عنوان کرد و گفت: میزان آورد آب سالانه کشور که پیش‌تر ۴۰۰ میلیارد مترمکعب بود، اکنون به کمتر از ۳۷۰ میلیارد مترمکعب کاهش یافته است. بنابراین، باید به سمت توسعه صنایع و کشاورزی کم‌آب‌بر حرکت کنیم و از روش‌هایی مانند بازچرخانی آب و استفاده از آب‌های نامتعارف برای حل مشکل بهره ببریم.', '23.jpg', 4, 8, '2025-01-28 14:19:58', '2025-02-03 12:58:06'),
(24, 8, 'زمینه قانونی جهش تجارت گوهرسنگ‌ها فراهم شد', 'به گزارش خبرگزاری صدا و سیما از ایمیدرو، خروج از گروه کالایی ۴ قانون مقررات صادرات و واردات کالا که به کالا‌های لوکس شهرت دارند، در راستای پیشبرد اهداف سند ملی توسعه صنعت گوهرسنگ کشور صورت گرفت طوری که این کالا‌ها اکنون به گروه ۲۵ یا همان گروه کالا‌های واسطه‌ای الحاق شدند.', '14.jpg', 4, 6, '2025-01-28 14:22:38', '2025-02-03 12:58:36'),
(25, 8, 'چهار طرح مدیریت آب‌های سطحی در پایتخت افتتاح شد', 'به گزارش خبرنگار خبرگزاری صدا و سیما، عباس شعبانی روز دوشنبه در حاشیه برگزاری مراسم افتتاح ۴ طرح مدیریت آب‌های سطحی پایتخت در قالب ۱۶۳ پویش امید و افتخار، اظهار کرد: این طرح‌ها که شامل بازسازی کانال قلقلی، احداث سازه مستهلک کننده انرژی رودخانه کن و جمع‌آوری آب‌های سطحی در بزرگراه‌های شهید لشگری و حاج احمد متوسلیان است، نقش حیاتی در افزایش ایمنی شهر در برابر بارندگی‌ها دارند.', '15.jpg', 4, 6, '2025-01-28 14:22:38', '2025-02-03 12:58:38'),
(26, 8, 'تغییر مسیر موقت در خط یک اتوبوس‌های تندرو', 'به گزارش خبرگزاری صدا و سیما، روابط عمومی شرکت واحد اتوبوسرانی تهران اعلام کرد: به دلیل اجرای عملیات عمرانی آسفالت‌ریزی در خط یک تندرو، امروز (دوشنبه ۱۵ بهمن ۱۴۰۳) تا ساعت ۱۷، مسیرهای شرق به غرب و غرب به شرق در محدوده تقاطع میرفخرایی (بعد از آیت) تا ایستگاه سبلان در هر دو جهت مسدود خواهد بود. در این بازه زمانی، اتوبوس‌های خط یک تندرو از مسیر کندرو عبور خواهند کرد.', '16.jpg', 6, 6, '2025-01-28 14:22:38', '2025-02-03 12:58:40'),
(27, 8, 'تصادف مرگبار در اتوبان غدیر؛ ۸ نفر جان باختند', 'به گزارش خبرگزاری صدا و سیما،  سرهنگ بهروز خانپور، رئیس عملیات ویژه پلیس راه راهور فراجا، اظهار داشت: ساعت ۱۹:۵۰ امشب، یک دستگاه خودروی سواری پژو ۴۰۵ که به‌عنوان خودروی شوتی شناخته می‌شود، در حال حرکت از عوارضی قطعه ۳ به سمت اتوبان خلیج فارس بود که به‌طور ناگهانی اقدام به دور زدن خلاف جهت کرد. این اقدام خطرناک منجر به برخورد مستقیم این خودرو با یک دستگاه سواری ساینا شد.', '17.jpg', 6, 6, '2025-01-28 14:24:40', '2025-02-03 12:58:42'),
(28, 8, 'سنگ آهن قهرمان هفته هفتم والیبال لیگ برتر ساحلی', 'به گزارش گروه ورزشی خبرگزاری صدا و سیما، چهارمین دوره مسابقات والیبال ساحلی قهرمانی باشگاه‌های برتر کشور از ۲۵ مهرماه با حضور ۹ تیم استارت خورد و هفته هفتم این رقابت‌ها از روز جمعه ۱۲ بهمن در بندرعباس به میزبانی باشگاه فولاد هرمزگان آغاز شد.\r\n\r\nدیدار رده‌بندی و فینال این هفته مسابقات امروز (دوشنبه ۱۵ بهمن) با دو دیدار پیگیری شد و تیم سنگ آهن بافق به مقام قهرمانی دست یافت.', '18.png', 5, 6, '2025-01-28 14:24:40', '2025-02-03 12:58:45'),
(29, 8, 'معرفی داوران هفته چهاردهم لیگ برتر فوتبال بانوان', 'به گزارش گروه ورزشی خبرگزاری صدا و سیما، اسامی داوران این رقابت‌ها به شرح زیر است:\r\n \r\nجمعه ۱۹ بهمن\r\nپالایش گاز ایلام – آوا تهران\r\nغزاله عاطفی – فاطمه صالح آبادی – نازنین قربان پور – هیرو درخشان راد', '19.jpg', 5, 6, '2025-01-28 14:24:40', '2025-02-03 12:58:47'),
(67, 8, 'اعلام فهرست ۳۶ نفره تیم فوتبال نوجوانان ایران', 'به گزارش گروه ورزشی خبرگزاری صدا و سیما، مرحله جدید اردوی تیم فوتبال نوجوانان ایران از ۱۸ تا ۲۵ بهمن در مرکز ملی فوتبال برگزار می‌شود.\r\n\r\nبرهمین اساس با نظر کادرفنی نفرات زیر به این اردو دعوت شدند:\r\n\r\nآرین کلاشی (آذربایجان شرقی)\r\n\r\nایلیا هیجانی، ابوالفضل خلیلیان و عرفان یوسف زاده (اصفهان)\r\n\r\nمحمد علی مشابه (بوشهر)', '20.jpg', 5, 6, '2025-01-28 14:48:38', '2025-02-03 12:58:49'),
(68, 8, 'نواخته شدن «زنگ انقلاب» در مدارس کشور', 'به گزارش خبرگزاری صدا و سیما؛ حجت‌الاسلام محمدحسین پورثانی، معاون پرورشی و فرهنگی وزارت آموزش و پرورش گفت: در این برنامه یک محتوایی با محوریت شناخت انقلاب اسلامی، معلمان برای دانش‌آموزان بازگو کردند.\r\nبه گفته پور ثانی، ۴۶ هزار محفل انس با قرآن نیز در دهه مبارک فجر در ۴۶ هزار مدرسه برگزار می‌شود.', '21.jpg', 3, 6, '2025-01-28 14:48:38', '2025-02-03 12:58:51'),
(69, 8, 'گشایش ۶ طرح گردشگری و صنایع‌دستی شهرستان طبس', 'به گزارش خبرگزاری صدا و سیما، محمد عرب بیان کرد: افتتاح اقامتگاه بوم‌گردی خانه پدری در روستای هدف گردشگری از میغان با حجم سرمایه‌گذاری ۲۰ میلیارد ریالی، بهره‌برداری از دو کارگاه خراطی سنتی، یک کارگاه سفال و سرامیک و یک کارگاه قلم‌زنی از جمله مهم‌ترین پروژه‌های دهه فجر است.', '22.jpg', 4, 6, '2025-01-28 14:48:38', '2025-02-03 12:58:54'),
(72, 8, 'برنامه‌ریزی برای برگزاری برنامه‌های افطار تا سحر در بناها و موزه‌ها', 'به گزارش خبرگزاری صدا و سیما، علی دارابی در نشست خبری گفت: در دهه فجر ۵۵ طرح در ۱۵ استان در حوزه مرمت بنای تاریخی با اعتباری بیش از ۲۰۰ میلیارد تومان به بهره‌برداری می‌رسد.\r\n\r\nوی ادامه داد: به‌مناسبت دهه فجر برنامه‌هایی همچون برپایی ۶۹ نمایشگاه، افتتاح و بازگشایی موزه، ۲۸ همایش تخصصی، ۱۵ کارگاه آموزشی و ۱۷ رونمایی خواهیم داشت.', '23.jpg', 6, 6, '2025-01-29 21:49:25', '2025-02-03 12:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `last_activity`) VALUES
(11, 6, '2025-01-29 18:49:10'),
(26, 6, '2025-01-30 13:02:23'),
(28, 6, '2025-01-30 13:21:43'),
(29, 6, '2025-01-30 13:22:38'),
(31, 6, '2025-01-30 13:23:46'),
(33, 6, '2025-01-30 13:25:49'),
(38, 6, '2025-01-30 16:19:01'),
(40, 6, '2025-01-30 16:36:39'),
(44, 8, '2025-01-30 17:36:56'),
(46, 6, '2025-01-30 18:00:19'),
(47, 8, '2025-01-30 18:00:44'),
(50, 6, '2025-01-30 19:11:17'),
(51, 8, '2025-01-30 19:11:35'),
(54, 8, '2025-02-03 12:46:19'),
(55, 6, '2025-02-03 12:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_online` tinyint(1) DEFAULT 0,
  `role` enum('admin','author','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_online`, `role`) VALUES
(6, 'zahra', '$2y$10$VyQ7VgmrL6IgWpTiER50VOUzjFJD0v/ICKpGhmnL0Hi2UTrcQBzwi', 'zahra@gmail.com', 0, 'admin'),
(8, 'sajedeh', '$2y$10$jpK5rxkvnZU/gef2ufxu8OqQpYdONuYrdTtyz140COjPi.GtxxyOq', 'sajedeh@gmail.com', 0, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `fk_posts_users` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=878;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
