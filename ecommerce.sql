-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 02:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `customerName` varchar(120) NOT NULL,
  `addressDetails` varchar(500) NOT NULL,
  `city` varchar(60) NOT NULL,
  `postCode` int(10) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `title`, `customerName`, `addressDetails`, `city`, `postCode`, `phoneNumber`, `email`, `customerId`) VALUES
(1, 'Ev Adresim', 'Sezgin Kipel', 'Yeni Batı Mh. Mülk Cd. Golde Luxe 1 E/11', 'Ankara', 6370, '05458972114', '1444sezgin@gmail.com', 1),
(3, 'İş Adresi', 'Ahmet Mehmet', 'Bir yerler', 'İstanbul', 34000, '5458789878', 'abc@mail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`id`, `cartId`, `productId`, `quantity`) VALUES
(1, 1, 5, 3),
(2, 1, 1, 2),
(3, 1, 3, 1),
(4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `slug` varchar(12000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `slug`) VALUES
(1, 'Bilgisayar', 'Bu kategoride harika bilgisayarlar var.', 'bilgisayar'),
(2, 'Televizyon', '8K ultra hd süper televizyonlar bu kategori altında!', 'televizyon'),
(3, 'Aynasız Kompakt SLR Makineleri', 'Aynasız Kompakt SLR Makineler bu kategori altında!', 'aynasiz-kompakt-slr-makineleri'),
(4, 'DSLR Fotoğraf Makineleri', 'En kaliteli DSLR Fotoğraf Makineleri burada en uygun fiyatlarla!', 'dslr-fotograf-makineleri');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDetails` varchar(300) NOT NULL,
  `orderDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerID`, `orderDetails`, `orderDate`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget nisl eu nunc mattis mattis ut et libero. Fusce semper maximus molestie. Fusce in lectus arcu. Pellentesque dictum accumsan tristique. Aliquam porttitor elementum nibh, vel pellentesque justo cursus at. Suspendisse vehicula ex sit a', '2024-01-22'),
(2, 1, ' ex sed orci viverra tempus. Aenean fringilla nibh quis dolor facilisis, nec pharetra arcu fermentum. Etiam ornare, velit id bibendum volutpat, massa magna elementum velit, non eleifend lectus eros at dui. Vivamus lacus nibh, aliquam tempus mi id, volutpat condimentum odio. Etiam m', '2024-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `imgURL` varchar(5000) NOT NULL,
  `slug` varchar(2000) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categoryID`, `title`, `description`, `imgURL`, `slug`, `price`) VALUES
(1, 3, 'Sony Zv-1f Vlog Kamerası + Sony Gp-Vpt2 Bt Çekim Kolu', '\r\n20,1 MP 1\" Exmor RS BSI CMOS Sensör\r\n\r\nBIONZ X Görüntü İşlemcisi\r\n\r\nZEISS 20 mm\'ye Eşdeğer f/2-f/8 Lens\r\n\r\nUHD 4K30p Video Kaydı\r\n\r\n3.0\" Yandan Açılır Dokunmatik LCD\r\n\r\nArka Plan Odaklanma ve Yüz Önceliği AE\r\n\r\n5x Ağır Çekim ve 60x Hyperlapse Modları\r\n\r\nYönlü 3 Kapsüllü Mikrofon ve Mikrofon Jakı\r\n\r\nYüksek Kaliteli Canlı Yayın\r\n\r\nKolay Akıllı Telefon Bağlantısı\r\n\r\n', 'https://productimages.hepsiburada.net/s/331/550/110000336254866.jpg', 'sony-zv-1f-vlog-kamerasi--sony-gp-vpt2-bt-ekim-kolu', 24999.00),
(2, 3, 'Canon EOS M50 + EF-M 15-45mm f/3.5-6.3 IS STM Vlogger Kit (Canon Eurasia Garantili)', '\nKullanışlı, kompakt ve bağlantı özellikli bu çok yönlü aynasız fotoğraf makinesi; muhteşem renk ve detaylara sahip unutulmaz anılar yaratmak için 4K video, değişken açılı dokunmatik ekran, 24,1 megapiksel CMOS sensör ve DIGIC 8 özelliklerine sahiptir. - 24,1 MP APS-C CMOS Sensör - Wi-Fi & NFC Bağlantı - 4K Video Çekimi - Saniyede 10 Kare Çekim Hızı - 143 adet Otomatik Netleme Noktası\n', 'https://productimages.hepsiburada.net/s/90/550/110000033268591.jpg', 'canon-eos-m50--ef-m-15-45mm-f35-63-is-stm-vlogger-kit-canon-eurasia-garantili', 21600.99),
(3, 1, 'HP Victus Gaming Laptop 15-fb0015nt AMD Ryzen 5 5600H 16 GB 512GB', '<table>\n<tbody>\n<tr>\n<td class=\"no-border\">\n<div id=\"productDescriptionContent\">\n<p>HP Victus Gaming Laptop 15-fb0015nt AMD Ryzen 5 5600H 16 GB 512GB SSD&nbsp;RX6500M FreeDos 15.6\" FHD 144 Hz Taşınabilir Bilgisayar 7J3T4EA</p>\n</div>\n</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p><img class=\"flix-img-responsive\" src=\"https://media.flixcar.com/modular/static/inpage/9/images/loading.gif\" srcset=\"//media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg\" alt=\"&Uuml;st&uuml;n işlem bileşenleri\" data-flixsrcset=\"//media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 200w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 400w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 600w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 800w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 1000w\" data-sizes=\"auto\"><img src=\"https://media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg\"></p>\n<p>&nbsp;</p>\n<p><img src=\"https://media.flixcar.com/webp/synd-asset/hp-114116201-c08290654.jpg\"></p>\n<p><img class=\"flix-img-responsive\" src=\"https://media.flixcar.com/modular/static/inpage/9/images/loading.gif\" srcset=\"//media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg\" alt=\"&Uuml;st&uuml;n işlem bileşenleri\" data-flixsrcset=\"//media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 200w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 400w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 600w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 800w, //media.flixcar.com/webp/synd-asset/hp-114116189-c08290649.jpg 1000w\" data-sizes=\"auto\"></p>', 'https://cdn.akakce.com/z/hp/hp-victus-15-fb0015nt-7j3t4ea-ryzen-5-5600h-16-gb-512-gb-ssd-rx6500m-15-6-full-hd-notebook.jpg', 'hp-victus-gaming-laptop-15-fb0015nt-amd-ryzen-5-5600h-16-gb-512gb', 32999.99),
(4, 2, 'Samsung 65S90C 65&quot; 163 Ekran Uydu Alıcılı 4K Ultra HD Smart OLED TV', '&lt;p&gt;&lt;img src=&quot;https://images.hepsiburada.net/assets/EE/ProductDesc/Samsung-Kurulum.png&quot;&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;ldquo;Muhtemelen şu anda bu fiyata alabileceğiniz en iyi cihaz. TechRadar Choice Awards 2023&amp;rsquo;te Yılın TV&amp;rsquo;si olarak se&amp;ccedil;memizde de bunun b&amp;uuml;y&amp;uuml;k etkisi var.&amp;rdquo;&lt;br&gt;&amp;ldquo;Samsung S90C g&amp;ouml;r&amp;uuml;nt&amp;uuml; kalitesi ve performansın m&amp;uuml;kemmel bir birleşimini sunuyor.&amp;rdquo;&lt;strong&gt;&amp;nbsp;(TechRadar Choice Awards 2023)&lt;/strong&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&amp;ldquo;Son d&amp;ouml;nemde Samsung S90C OLED TV&amp;rsquo;nin eklenmesiyle birlikte en iyi 4K TV&amp;rsquo;ler listemizin &amp;uuml;st sıraları yerinden oynadı.&amp;rdquo;&lt;br&gt;&amp;ldquo;Hakkında &amp;ccedil;ok sayıda olumlu yorum yapılan bu model, OLED&amp;rsquo;in muhteşem koyu tonlarını QLED teknolojisinin sunduğu olağan&amp;uuml;st&amp;uuml; parlaklık ve renk zenginliği ile birleştiriyor.&amp;rdquo;&lt;strong&gt;&amp;nbsp;(TechRadar, 10/2023)&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;img src=&quot;https://media.flixcar.com/webp/synd-asset/Samsung-119241295-tr-feature-experience-the-difference-of-samsung-oled-535728092--ORIGIN_IMG-.jpg&quot;&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;div class=&quot;flix-std-row&quot;&gt;\n&lt;div class=&quot;flix-std-clmn-lg-12&quot;&gt;\n&lt;div class=&quot;flix-std-content&quot;&gt;\n&lt;div class=&quot;flix-p3-subtitle flix-d-h5&quot; role=&quot;heading&quot; aria-level=&quot;5&quot;&gt;S&amp;Uuml;PER ULTRA GENIŞ OYUN G&amp;Ouml;R&amp;Uuml;NT&amp;Uuml;S&amp;Uuml; VE GAME BAR&lt;/div&gt;\n&lt;div class=&quot;flix-p3-desc flix-d-p&quot;&gt;21:9 ve 32:9 ekran oranları, oyun deneyimini maksimum seviyeye &amp;ccedil;ıkarmak i&amp;ccedil;in size daha fazla g&amp;ouml;r&amp;uuml;nt&amp;uuml; alanı sunarken Game Bar, kazanmak i&a', 'https://productimages.hepsiburada.net/s/384/550/110000402744968.jpg/format:webp', 'samsung-65s90c-65quot-163-ekran-uydu-alicili-4k-ultra-hd-smart-oled-tv', 73000.00),
(5, 4, 'Canon Eos 250D 18-55MM Is Stm Kit', '&lt;div class=&quot;inpage_selector_info ffp_specification_intro &quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-xs-12&quot;&gt;\n&lt;div class=&quot;newcanon-product&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-8 flix-grd-lg-offset-2 flix-grd-xs-10 flix-grd-xs-offset-1&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;Boyutu k&amp;uuml;&amp;ccedil;&amp;uuml;k, performansı b&amp;uuml;y&amp;uuml;k&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;EOS 250D&#039;nin taşınabilir g&amp;ouml;vdesinin i&amp;ccedil;inde bulunan 24,1 megapiksel sens&amp;ouml;r ve DIGIC 8 g&amp;ouml;r&amp;uuml;nt&amp;uuml; işlemcisi, hareket halinde m&amp;uuml;kemmel sonu&amp;ccedil;lar sağlar. Optik viz&amp;ouml;r, net ve ger&amp;ccedil;ek zamanlı bir g&amp;ouml;r&amp;uuml;n&amp;uuml;m sunar.&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-content-line padding-top-bot&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-8 flix-grd-lg-offset-2 flix-grd-xs-12 flix-grd-xs-offset-0&quot;&gt;\n&lt;div class=&quot;newcanon-product-image&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281534-0001_464045771594157_set_1.png&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281534-0001_464045771594157_set_1.png 200w, //media.flixcar.com/webp/synd-asset/Canon-46281534-0001_464045771594157_set_1.png 400w, //media.flixcar.com/webp/synd-asset/Canon-46281534-0001_464045771594157_set_1.png 600w, //media.flixcar.com/webp/synd-asset/Canon-46281534-0001_464045771594157_set_1.png 800w, //media.flixcar.com/webp/synd-asset/Canon-46281534-0001_464045771594157_set_1.png 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;img src=&quot;https://media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-8 flix-grd-lg-offset-2 flix-grd-xs-12 flix-grd-xs-offset-0&quot;&gt;\n&lt;div class=&quot;newcanon-product-gal&quot; data-rockcarousel=&quot;true&quot; data-rockcarouselswipe=&quot;true&quot;&gt;\n&lt;ul&gt;\n&lt;li&gt;\n&lt;div class=&quot;newcanon-product-ft&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;24,1 MP&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;&amp;Ccedil;&amp;Ouml;Z&amp;Uuml;N&amp;Uuml;RL&amp;Uuml;K&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;div class=&quot;newcanon-product-ft&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;DIGIC 8&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;İŞLEMCI&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;div class=&quot;newcanon-product-ft&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;4K&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;FILMLER&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;div class=&quot;newcanon-product-ft&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;3,0 IN&amp;Ccedil;&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;DOKUNMATIK EKRAN&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;div class=&quot;newcanon-product-ft&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;OPTIK&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;VIZ&amp;Ouml;R&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;div class=&quot;newcanon-product-ft&quot;&gt;\n&lt;div class=&quot;newcanon-product-title flix-d-h3&quot;&gt;KABLOSUZ&lt;/div&gt;\n&lt;div class=&quot;newcanon-product-desc flix-d-p&quot;&gt;BLUETOOTH VE WI-FI&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;/ul&gt;\n&lt;div class=&quot;rockcarousel-pagination&quot; data-rockcarouselpagination=&quot;true&quot;&gt;&lt;span class=&quot;active&quot; data-flix-media=&quot;pagination1&quot;&gt;1&lt;/span&gt;&lt;span data-flix-media=&quot;pagination2&quot;&gt;2&lt;/span&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_feature ffp_blocks_full bg-white&quot;&gt;\n&lt;div class=&quot;newcanon-feature&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-xs-12 newcanon-feature-text&quot;&gt;\n&lt;div class=&quot;newcanon-feature-title flix-d-h3&quot;&gt;Kompakt DSLR&lt;/div&gt;\n&lt;div class=&quot;newcanon-feature-desc flix-d-p&quot;&gt;D&amp;uuml;nyanın hareket edebilen ekrana sahip* en hafif DSLR fotoğraf makinesi olan EOS 250D&#039;yi, yanınızda daha sık taşıyıp daha &amp;ccedil;ok yere g&amp;ouml;t&amp;uuml;rerek yaratıcılığınızın harekete ge&amp;ccedil;tiği anlarda m&amp;uuml;kemmel sonu&amp;ccedil;lar alırsınız.&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-lg-push-6 flix-grd-xs-12 flix-grd-xs-push-0&quot;&gt;\n&lt;div class=&quot;newcanon-feature-image&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281541-eos-lifestyle-beach-script1-willhartley-3111.-V4_960x960_909781694382087.jpg.jpg&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281541-eos-lifestyle-beach-script1-willhartley-3111.-V4_960x960_909781694382087.jpg.jpg 200w, //media.flixcar.com/webp/synd-asset/Canon-46281541-eos-lifestyle-beach-script1-willhartley-3111.-V4_960x960_909781694382087.jpg.jpg 400w, //media.flixcar.com/webp/synd-asset/Canon-46281541-eos-lifestyle-beach-script1-willhartley-3111.-V4_960x960_909781694382087.jpg.jpg 600w, //media.flixcar.com/webp/synd-asset/Canon-46281541-eos-lifestyle-beach-script1-willhartley-3111.-V4_960x960_909781694382087.jpg.jpg 800w, //media.flixcar.com/webp/synd-asset/Canon-46281541-eos-lifestyle-beach-script1-willhartley-3111.-V4_960x960_909781694382087.jpg.jpg 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_feature ffp_blocks_full bg-white&quot;&gt;\n&lt;div class=&quot;newcanon-feature&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-lg-push-6 flix-grd-xs-12 flix-grd-xs-push-0 newcanon-feature-text&quot;&gt;\n&lt;div class=&quot;newcanon-feature-title flix-d-h3&quot;&gt;Y&amp;uuml;ksek &amp;ccedil;&amp;ouml;z&amp;uuml;n&amp;uuml;rl&amp;uuml;kl&amp;uuml; &amp;ccedil;arpıcı g&amp;ouml;r&amp;uuml;nt&amp;uuml;ler ve 4K filmler&lt;/div&gt;\n&lt;div class=&quot;newcanon-feature-desc flix-d-p&quot;&gt;Zengin renklerle dolu ve son derece net 24,1 megapiksel fotoğraflar ve 4K filmler &amp;ccedil;ekin. APS-C boyutlu sens&amp;ouml;r ve DIGIC 8 işlemci, d&amp;uuml;ş&amp;uuml;k ışıkta bile m&amp;uuml;kemmel sonu&amp;ccedil;lar sağlar.&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-xs-12 flix-grd-xs-pull-0&quot;&gt;\n&lt;div class=&quot;newcanon-feature-image&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281548-eos-sample-recce-day1-willhartley-51_960x960_247497259886810.jpgfmtjpgfmt.jpg&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281548-eos-sample-recce-day1-willhartley-51_960x960_247497259886810.jpgfmtjpgfmt.jpg 200w, //media.flixcar.com/webp/synd-asset/Canon-46281548-eos-sample-recce-day1-willhartley-51_960x960_247497259886810.jpgfmtjpgfmt.jpg 400w, //media.flixcar.com/webp/synd-asset/Canon-46281548-eos-sample-recce-day1-willhartley-51_960x960_247497259886810.jpgfmtjpgfmt.jpg 600w, //media.flixcar.com/webp/synd-asset/Canon-46281548-eos-sample-recce-day1-willhartley-51_960x960_247497259886810.jpgfmtjpgfmt.jpg 800w, //media.flixcar.com/webp/synd-asset/Canon-46281548-eos-sample-recce-day1-willhartley-51_960x960_247497259886810.jpgfmtjpgfmt.jpg 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_feature ffp_blocks_full bg-white&quot;&gt;\n&lt;div class=&quot;newcanon-feature&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-xs-12 newcanon-feature-text&quot;&gt;\n&lt;div class=&quot;newcanon-feature-title flix-d-h3&quot;&gt;Hayatınızla bağlantılı&lt;/div&gt;\n&lt;div class=&quot;newcanon-feature-desc flix-d-p&quot;&gt;G&amp;ouml;r&amp;uuml;nt&amp;uuml;leri aileniz ve arkadaşlarınızla paylaşmak &amp;ccedil;ok kolaydır. Bunun i&amp;ccedil;in EOS 250D&#039;yi Bluetooth** kullanarak akıllı telefonunuza veya tablet bilgisayarınıza* bağlamanız yeterli. Gerisini fotoğraf makinesinin dahili Wi-Fi bağlantısı halleder.&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-lg-push-6 flix-grd-xs-12 flix-grd-xs-push-0&quot;&gt;\n&lt;div class=&quot;newcanon-feature-image&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281555-eos-lifestyle-botanic-script2-will-hartley-1103-V1_960x960_149681630163280.j.jpg&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281555-eos-lifestyle-botanic-script2-will-hartley-1103-V1_960x960_149681630163280.j.jpg 200w, //media.flixcar.com/webp/synd-asset/Canon-46281555-eos-lifestyle-botanic-script2-will-hartley-1103-V1_960x960_149681630163280.j.jpg 400w, //media.flixcar.com/webp/synd-asset/Canon-46281555-eos-lifestyle-botanic-script2-will-hartley-1103-V1_960x960_149681630163280.j.jpg 600w, //media.flixcar.com/webp/synd-asset/Canon-46281555-eos-lifestyle-botanic-script2-will-hartley-1103-V1_960x960_149681630163280.j.jpg 800w, //media.flixcar.com/webp/synd-asset/Canon-46281555-eos-lifestyle-botanic-script2-will-hartley-1103-V1_960x960_149681630163280.j.jpg 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_feature ffp_blocks_full bg-white&quot;&gt;\n&lt;div class=&quot;newcanon-feature&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-lg-push-6 flix-grd-xs-12 flix-grd-xs-push-0 newcanon-feature-text&quot;&gt;\n&lt;div class=&quot;newcanon-feature-title flix-d-h3&quot;&gt;Odağınızı koruyun, net g&amp;ouml;r&amp;uuml;nt&amp;uuml;ler edinin&lt;/div&gt;\n&lt;div class=&quot;newcanon-feature-desc flix-d-p&quot;&gt;İster o anı optik viz&amp;ouml;r ile 5 fps&#039;de yakalayın ister Otomatik G&amp;ouml;z Odaklaması &amp;ouml;zellikli Dual Pixel CMOS AF Canlı Kontrol kullanın; daima son derece net sonu&amp;ccedil;lar elde edersiniz.&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-xs-12 flix-grd-xs-pull-0&quot;&gt;\n&lt;div class=&quot;newcanon-feature-image&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg 200w, //media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg 400w, //media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg 600w, //media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg 800w, //media.flixcar.com/webp/synd-asset/Canon-46281561-eos-lifestyle-beach-script1-willhartley-3658-V2_960x960_111212027058582.jpg.jpg 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_feature ffp_blocks_full bg-white&quot;&gt;\n&lt;div class=&quot;newcanon-feature&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-xs-12 newcanon-feature-text&quot;&gt;\n&lt;div class=&quot;newcanon-feature-title flix-d-h3&quot;&gt;Sade mi gelişmiş mi?&lt;/div&gt;\n&lt;div class=&quot;newcanon-feature-desc flix-d-p&quot;&gt;Bas-&amp;ccedil;ek sadeliğinin keyfini &amp;ccedil;ıkarın ve Rehberli Kullanıcı Arabirimi ve Yaratıcı Asistan modu ile yaratıcılığınızı konuşturun.Hareket edebilen dokunmatik ekran, alışılmadık a&amp;ccedil;ıları ve selfie&#039;leri kolay hale getirir.&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;flix-grd-lg-6 flix-grd-lg-push-6 flix-grd-xs-12 flix-grd-xs-push-0&quot;&gt;\n&lt;div class=&quot;newcanon-feature-image&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281567-eos-lifestyle-botanic-script2-will-hartley-818-V1_960x960_279960759639131.jpg.jpg&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281567-eos-lifestyle-botanic-script2-will-hartley-818-V1_960x960_279960759639131.jpg.jpg 200w, //media.flixcar.com/webp/synd-asset/Canon-46281567-eos-lifestyle-botanic-script2-will-hartley-818-V1_960x960_279960759639131.jpg.jpg 400w, //media.flixcar.com/webp/synd-asset/Canon-46281567-eos-lifestyle-botanic-script2-will-hartley-818-V1_960x960_279960759639131.jpg.jpg 600w, //media.flixcar.com/webp/synd-asset/Canon-46281567-eos-lifestyle-botanic-script2-will-hartley-818-V1_960x960_279960759639131.jpg.jpg 800w, //media.flixcar.com/webp/synd-asset/Canon-46281567-eos-lifestyle-botanic-script2-will-hartley-818-V1_960x960_279960759639131.jpg.jpg 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_info ffp_hero video-bc-6022478399001 ffp_hero_with_text&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-xs-12&quot;&gt;\n&lt;div class=&quot;newcanon-info&quot;&gt;\n&lt;div class=&quot;newcanon-infoPromo&quot;&gt;\n&lt;div class=&quot;newcanon-infoText&quot;&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-xs-10 flix-grd-sm-6 flix-grd-md-5 flix-grd-lg-5&quot;&gt;\n&lt;div class=&quot;newcanon-title flix-d-h3&quot;&gt;EOS 250D sizin i&amp;ccedil;in en uygun fotoğraf makinesi mi?&lt;/div&gt;\n&lt;div class=&quot;newcanon-subtitle flix-d-p&quot;&gt;Satın alma se&amp;ccedil;eneklerini hemen keşfedin&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;newcanon-info-bgimage&quot;&gt;&lt;img class=&quot;newcanon-image&quot; src=&quot;https://media.flixcar.com/modular/static/inpage/9/images/loading.gif&quot; srcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281573-Video-Placeholder-image_227741433582849.jpgw1280smaspectaspect43qlt.jpg&quot; alt=&quot;&quot; data-flixsrcset=&quot;//media.flixcar.com/webp/synd-asset/Canon-46281573-Video-Placeholder-image_227741433582849.jpgw1280smaspectaspect43qlt.jpg 200w, //media.flixcar.com/webp/synd-asset/Canon-46281573-Video-Placeholder-image_227741433582849.jpgw1280smaspectaspect43qlt.jpg 400w, //media.flixcar.com/webp/synd-asset/Canon-46281573-Video-Placeholder-image_227741433582849.jpgw1280smaspectaspect43qlt.jpg 600w, //media.flixcar.com/webp/synd-asset/Canon-46281573-Video-Placeholder-image_227741433582849.jpgw1280smaspectaspect43qlt.jpg 800w, //media.flixcar.com/webp/synd-asset/Canon-46281573-Video-Placeholder-image_227741433582849.jpgw1280smaspectaspect43qlt.jpg 1000w&quot; data-sizes=&quot;auto&quot;&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;div class=&quot;inpage_selector_specification ffp_specification_icons&quot;&gt;\n&lt;div class=&quot;newcanon-specs&quot;&gt;\n&lt;div class=&quot;flix-content&quot;&gt;\n&lt;div class=&quot;newcanon-title flix-d-h3&quot;&gt;Teknik &amp;Ouml;zellikler&lt;/div&gt;\n&lt;div class=&quot;flix-content-line&quot;&gt;\n&lt;div class=&quot;flix-grd-lg-12 flix-grd-md-12 flix-grd-sm-12 flix-grd-xs-12&quot;&gt;\n&lt;ul class=&quot;specs-container-lists&quot;&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;24,1 megapiksel&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Y&amp;uuml;ksek &amp;ccedil;&amp;ouml;z&amp;uuml;n&amp;uuml;rl&amp;uuml;kl&amp;uuml; fotoğraflar&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;Optik viz&amp;ouml;r&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Her şeyi olduğu gibi g&amp;ouml;r&amp;uuml;n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;4K filmler&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;&amp;Uuml;st&amp;uuml;n netlik i&amp;ccedil;in&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;Dual Pixel CMOS AF&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Canlı Kontrol kullanırken m&amp;uuml;kemmel AF&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;Hareket edebilen ekran&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Selfie&#039;ler &amp;ccedil;ekin ve farklı a&amp;ccedil;ılarla yaratıcılığınızı konuşturun&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;Rehberli Kullanıcı Arabirimi&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Fotoğraf makinenizi &amp;ccedil;ekim yaptık&amp;ccedil;a tanıyın&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;Wi-Fi ve Bluetooth&amp;reg;**&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Akıllı cihazlara kablosuz bağlantı&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;li class=&quot;specs-list-item&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-image&quot;&gt;&amp;nbsp;&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-text&quot;&gt;\n&lt;div class=&quot;newcanon-specs-box-title flix-d-h6 &quot;&gt;Yaratıcı Asistan&lt;/div&gt;\n&lt;div class=&quot;newcanon-specs-box-desc flix-d-p&quot;&gt;Yeni g&amp;ouml;r&amp;uuml;n&amp;uuml;mler deneyin ve fotoğraflarınızı geliştirin&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;\n&lt;/div&gt;', 'https://productimages.hepsiburada.net/s/219/550/110000198757254.jpg/format:webp', 'canon-eos-250d-18-55mm-is-stm-kit', 23699.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `passwordHash` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `passwordHash`) VALUES
(1, 'SZGN', '1444sezgin@gmail.com', '$2y$10$ID9QPKIcFVbNMsedoNk75uSWN3v95vH2tI0wqaLgwbuwTnU0sn2lK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
