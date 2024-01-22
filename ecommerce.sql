-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 03:15 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `product`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `imgURL` varchar(5000) NOT NULL,
  `slug` varchar(2000) NOT NULL,
  `price` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `products` (`id`, `categoryID`, `title`, `description`, `imgURL`, `slug`, `price`) VALUES
(1, 3, 'Sony Zv-1f Vlog Kamerası + Sony Gp-Vpt2 Bt Çekim Kolu', '\r\n20,1 MP 1\" Exmor RS BSI CMOS Sensör\r\n\r\nBIONZ X Görüntü İşlemcisi\r\n\r\nZEISS 20 mm\'ye Eşdeğer f/2-f/8 Lens\r\n\r\nUHD 4K30p Video Kaydı\r\n\r\n3.0\" Yandan Açılır Dokunmatik LCD\r\n\r\nArka Plan Odaklanma ve Yüz Önceliği AE\r\n\r\n5x Ağır Çekim ve 60x Hyperlapse Modları\r\n\r\nYönlü 3 Kapsüllü Mikrofon ve Mikrofon Jakı\r\n\r\nYüksek Kaliteli Canlı Yayın\r\n\r\nKolay Akıllı Telefon Bağlantısı\r\n\r\n', 'https://productimages.hepsiburada.net/s/331/550/110000336254866.jpg', 'sony-zv-1f-vlog-kamerasi--sony-gp-vpt2-bt-ekim-kolu', 26.999),
(2, 3, 'Canon EOS M50 + EF-M 15-45mm f/3.5-6.3 IS STM Vlogger Kit (Canon Eurasia Garantili)', '\nKullanışlı, kompakt ve bağlantı özellikli bu çok yönlü aynasız fotoğraf makinesi; muhteşem renk ve detaylara sahip unutulmaz anılar yaratmak için 4K video, değişken açılı dokunmatik ekran, 24,1 megapiksel CMOS sensör ve DIGIC 8 özelliklerine sahiptir. - 24,1 MP APS-C CMOS Sensör - Wi-Fi & NFC Bağlantı - 4K Video Çekimi - Saniyede 10 Kare Çekim Hızı - 143 adet Otomatik Netleme Noktası\n', 'https://productimages.hepsiburada.net/s/90/550/110000033268591.jpg', 'canon-eos-m50--ef-m-15-45mm-f35-63-is-stm-vlogger-kit-canon-eurasia-garantili', 99.990);

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
(1, 'sezgin', '1444sezgin@gmail.com', '$2y$10$ID9QPKIcFVbNMsedoNk75uSWN3v95vH2tI0wqaLgwbuwTnU0sn2lK');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `product`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
