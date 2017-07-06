-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2017 at 07:34 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carib`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Agriculture', 'agriculture', 0, 1, '2017-06-29 06:06:22', '2017-06-29 06:06:22'),
(7, 'Agriculture Product Stocks Products', 'agriculture-product-stocks-products', 5, 0, '2017-06-29 06:07:45', '2017-07-05 08:18:53'),
(8, 'Agrochemicals & Pesticides Products', 'agrochemicals-pesticides-products', 5, 1, '2017-06-29 06:08:32', '2017-07-03 00:14:28'),
(9, 'Animal Extract Products', 'animal-extract-products', 5, 1, '2017-06-29 06:08:46', '2017-07-03 00:14:30'),
(10, 'Animal Casings Products', 'animal-casings-products', 5, 1, '2017-06-29 06:09:06', '2017-06-29 06:09:06'),
(11, 'Animal Husbandry Products', 'animal-husbandry-products', 5, 1, '2017-06-29 06:09:29', '2017-06-29 06:09:29'),
(12, 'Apparel & Fashion Products', 'apparel-fashion-products', 0, 1, '2017-06-29 06:09:47', '2017-06-29 06:09:47'),
(13, 'Apparel & Fashion Agents Products', 'apparel-fashion-agents-products', 12, 1, '2017-06-29 06:14:05', '2017-06-29 06:14:05'),
(14, 'Athletic Wear Products', 'athletic-wear-products', 12, 1, '2017-06-29 06:14:23', '2017-06-29 06:14:23'),
(15, 'Bridal Wear Products', 'bridal-wear-products', 12, 1, '2017-06-29 06:14:44', '2017-06-29 06:14:44'),
(16, 'Dummies & Mannequins Products', 'dummies-mannequins-products', 12, 1, '2017-06-29 06:14:59', '2017-06-29 06:14:59'),
(17, 'Down Garment Products', 'down-garment-products', 12, 1, '2017-06-29 06:15:14', '2017-06-29 06:15:14'),
(18, 'Home Supplies Products', 'home-supplies-products', 0, 1, '2017-06-29 06:15:50', '2017-06-29 06:15:50'),
(19, 'Aquarium Supplies Products', 'aquarium-supplies-products', 18, 1, '2017-06-29 06:16:29', '2017-06-29 06:16:29'),
(20, 'Aluminium Utensils Products', 'aluminium-utensils-products', 18, 1, '2017-06-29 06:16:46', '2017-06-29 06:16:46'),
(21, 'Bags & Cases Products', 'bags-cases-products', 18, 1, '2017-06-29 06:16:58', '2017-06-29 06:16:58'),
(22, 'Bags & Luggage - Cotton/Canvas/Synthetic Products', 'bags-luggage-cotton-canvas-synthetic-products', 18, 1, '2017-06-29 06:17:16', '2017-06-29 06:17:16'),
(23, 'Furniture Products', 'furniture-products', 0, 1, '2017-06-29 06:18:00', '2017-06-29 06:18:00'),
(24, 'Antique Furniture Products', 'antique-furniture-products', 23, 1, '2017-06-29 06:19:01', '2017-07-03 23:34:43'),
(25, 'Bamboo Furniture Products', 'bamboo-furniture-products', 23, 1, '2017-06-29 06:19:19', '2017-07-03 07:56:25'),
(26, 'Furniture Fittings & Fixtures Products', 'furniture-fittings-fixtures-products', 23, 1, '2017-06-29 06:19:32', '2017-07-03 07:56:27'),
(27, 'Granite Table Products', 'granite-table-products', 23, 1, '2017-06-29 06:19:44', '2017-07-03 07:56:28'),
(28, 'Hospital Furniture Products', 'hospital-furniture-products', 23, 1, '2017-06-29 06:20:08', '2017-07-05 06:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2017_03_19_000000_create_password_resets_table', 1),
(3, '2017_03_19_100000_create_users_table', 1),
(6, '2017_03_24_093331_create_categories_table', 2),
(11, '2017_03_31_104149_create_products_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`, `updated_at`) VALUES
('dewanshu.chapter247@gmail.com', '9C3oA5SFUWcCtNzXHhIZ3N0UB3iihDuesYJdHVEp8B7zVPnKX4ip8JpWsmsY4wBctBaCGBDta8SHqAM0raDPot65T0FCY1HuHst5tyWPMHtocwqfN7gh9sry', '2017-07-04 03:26:49', '2017-07-05 04:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `thumb_image` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `price` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `name`, `slug`, `description`, `image`, `thumb_image`, `category_id`, `user`, `qty`, `price`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(10, 0, 'Soya meal', 'soya-meal', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '["uploads\\/products\\/d54a8054a_1499171959.jpg","uploads\\/products\\/1794d87be_1499171959.jpg","uploads\\/products\\/4d36984c0_1499171959.jpg"]', '["uploads\\/products\\/thumb\\/d54a8054a_1499171959.jpg","uploads\\/products\\/thumb\\/1794d87be_1499171959.jpg","uploads\\/products\\/thumb\\/4d36984c0_1499171959.jpg"]', 7, 2, 0, '10', 1, 0, '2017-06-30 07:11:41', '2017-07-05 06:09:52'),
(11, 0, 'Seed Coating Polymer', 'seed-coating-polymer', 'Leveraging upon our immense market experience, we are engrossed in offering an optimum quality Seed Coating Polymer. The offered polymer is mainly used in several agricultural and diary applications to improve plant-ability and better seed performance. This polymer is formulated by utilizing optimum grade chemical compounds by our skilled professionals at our premises. Further, we are providing this Seed Coating Polymer in numerous packaging options at reasonable prices.', '["uploads\\/products\\/e2f09fea2_1499086593.jpg"]', '["uploads\\/products\\/thumb\\/e2f09fea2_1499086593.jpg"]', 8, 2, 0, '100', 1, 0, '2017-07-03 01:09:38', '2017-07-03 07:26:33'),
(12, 0, 'Wheat Flour', 'wheat-flour', 'Supported by a team of experienced professionals, we are able to offer high quality Wheat Flour. With the aid of sophisticated techniques, the offered flour is processed using fresh grains by our adept professionals at our hygienic processing unit. For preparation of chappati, traditional pizza, pasta and many other dishes, this flour is widely used at homes and restaurants. Moreover, we offer this Enriched Wheat Flour in air tight packaging options at nominal prices.', '["uploads\\/products\\/1d11d3b8b_1499086610.jpg"]', '["uploads\\/products\\/thumb\\/1d11d3b8b_1499086610.jpg"]', 8, 2, 0, '45', 1, 1, '2017-07-03 01:10:11', '2017-07-03 08:57:45'),
(13, 0, 'Dried Calamansi', 'dried-calamansi', 'We are known as well known company for Making and Supplying of Dried Calamansi from Ho Chi Minh City, Thanh Pho Ho Chi Minh, Vietnam. Our offered Dried Calamansi is widely demanded by our customers which are located all round the world. 1.THE PROCESSING OF DRIED CALAMANSI Specifications: Style: Dried Type: Other Taste: Sour Shape: Sliced Drying Process: Other Preservation Process: Other Cultivation Type: Other Packaging: as customer require Max. Moisture (%): 10% Certification: ISO Weight (kg): 10 Shelf Life: 2 Years Place of Origin: Vietnam + Origin: Viet Nam (goods standard export) 2.THE PROCESSING OF DRIED CALAMANSI SLICES Specification : Dried Calamansi Slices From Viet Nam (Products export standard) - Type: Calamansi - Style: Dried - Certification: PHYTO, C/O - Packing dried calamansi slices : in 1KG-2KG-10KG/BAG per a carton or as requirement of buyer - Quantity capacity : large quantity - Origin : Vietnam (Goods export standards) - Calamansi are cleaned. - Choosing fresh fruits no chlorosis - Standard humidity 10-12% - Use a round slice with size: 2mm x 2.5mm (0.8 * 0.8), 2mm x 4mm (0.8 * 1.6) or 4mm x 6mm (1.6 * 2.4) + No SO2 + No CO2 + Shelf-life: 6 month from production date + Samples: Sample are free, freight are chargeable. + Delivery time: 01 to 02 weeks after your confirmation of order and deposit or L/C confirmed by our bank. (In case of we prepare', '["uploads\\/products\\/07e4f44f9_1499086621.jpg"]', '["uploads\\/products\\/thumb\\/07e4f44f9_1499086621.jpg"]', 8, 2, 0, '50', 1, 1, '2017-07-03 01:11:18', '2017-07-03 08:57:45'),
(14, 0, 'Send Inquiry Emu Farming', 'send-inquiry-emu-farming', 'We are Prompt Service Provider of EMU farming. As EMU farming produces EMU Birds and EMU Eggs. We always ready to serve all interested People by our best Services. EMU Farming is available at reasonable prices at us', '["uploads\\/products\\/1512d9e80_1499086631.jpg"]', '["uploads\\/products\\/thumb\\/1512d9e80_1499086631.jpg"]', 11, 2, 0, '1200', 1, 1, '2017-07-03 01:11:51', '2017-07-03 08:57:44'),
(15, 0, 'Western Dress', 'western-dress', 'We are offering western dress for our client. One piece dress with excellent dress material\r\nlook like beautiful. It''s very comfortable to wear and attractive colors and design.', '["uploads\\/products\\/7ceb82d08_1499086641.jpg"]', '["uploads\\/products\\/thumb\\/7ceb82d08_1499086641.jpg"]', 13, 2, 0, '200', 1, 0, '2017-07-03 01:13:05', '2017-07-03 07:27:21'),
(16, 0, 'Ladies Shorts', 'ladies-shorts', 'We are an eminent Manufacturer, Wholesaler, Distributor and Supplier of extensively appreciated and demanded Ladies Shorts. These are made keeping in mind the comfort and standards of the arena using tested skin friendly materials. Hence, these are hugely applauded among the users.\r\nBuy and beat the heat with our offered Shorts.\r\nThese wick away moisture and boost your comfort.\r\nNote: These are provided with a lined gusset add extra support, while contrast mesh panels enhance ventilation in key areas.', '[]', '[]', 17, 2, 0, '50', 1, 1, '2017-07-03 01:14:07', '2017-07-05 08:27:35'),
(17, 0, 'Send Inquiry Track Suit', 'send-inquiry-track-suit', 'Since years in this domain, we are engaged in designing and offering a wide collection of Track Suit. Our offered track suit is designed by using soft fabric that is procured from trusted vendors. It is widely used while jogging and exercise and provides comfort to the wearer. In compliance to meet clients'' diverse needs, this track suit is available in different designs, sizes and colors. Our Track Suit is checked on various quality parameters to ensure its tear resistance nature.', '["uploads\\/products\\/d751e36ee_1499086667.jpg"]', '["uploads\\/products\\/thumb\\/d751e36ee_1499086667.jpg"]', 17, 2, 0, '200', 1, 0, '2017-07-03 01:14:52', '2017-07-03 07:27:47'),
(18, 0, 'Aluminum Bronze C95400', 'aluminum-bronze-c95400', '% WEIGHT	CU COPPER	FE IRON	NI NICKEL	MN	FE IRON	MIN-MAX	83.0 MIN	10-11.5	1.5 MAX	0.5 MAX	3.5-5.0	NOMINAL	83.2	10.8	3.5/4.0	TYPICAL APPLICATIONS:- Automotive: Weld Guns Fasteners: Nuts, Large Hold Down Screws Industrial: Pickling Hooks, Bearings, Pawl, Worm Gears, Machine Parts, Spur Gears, Heavily Loaded Worm Gears, Pump Parts, Landing Gear Parts, Valve Bodies, Valve Guides, Valve Seats, Bearing Segments for the Steel Industry, Pressure Blocks for the Steel Industry, High Strength Clamps, Bushings, Valves, Gears Marine: Ship Building, Covers for Marine Hardware Ordnance: Government Fittings', '["uploads\\/products\\/7eb45dd12_1499086685.jpg"]', '["uploads\\/products\\/thumb\\/7eb45dd12_1499086685.jpg"]', 20, 2, 0, '200', 1, 0, '2017-07-03 01:15:57', '2017-07-03 07:28:05'),
(19, 0, 'Aluminium Milk Cans With Lockable Lid', 'aluminium-milk-cans-with-lockable-lid', '"BIMAL" offers Lockable Milk Cans that prvents the theft of milk during transportation. Salient features of our Milk Can * ''Bimal'' Milk can is the only Milkcan in the country which is made on: (i) Automated Imported "German Machine" (ii) With stainless Steel Dies. * The inside wall smoothness is at par with excellence in comparison to other Branded Milkcan available in the country. * Strong (solid) neck bedding adds to its wear resistance at mouth. * Shrink fit bottom bend with extra smooth mig welding all round. * Smoothly brazed handles. * Spot welded lids at 5 point makes the life of lid exactly as that of Milk cans. * More than 85 BHN hardness ensures high ductility and wear resistance to both abrasion and mechanical deformation. * Longer operational durability due to high tensile strength, high yield point, relatively high hardness and high ductility. * Easy running and cleaning at conveyor. * Manufactured from raw material brought from Hindalco Industries Ltd. (as ISO-9001 company) * ISI mark * Sturdy anodized to withstand scratches.', '["uploads\\/products\\/f64abfd74_1499086694.jpg"]', '["uploads\\/products\\/thumb\\/f64abfd74_1499086694.jpg"]', 20, 2, 0, '50', 1, 1, '2017-07-03 01:16:25', '2017-07-03 08:57:43'),
(20, 0, 'Aluminium Handi', 'aluminium-handi', '<p>We are the most outstanding Exporter, Manufacturer and Supplier of an extensive range of Aluminum Handi at inexpensive costs. The provided handi''s are accessible in numerous size and shape as per client requirements. These handi are manufactured by using basic grade raw material like aluminum with the aid of modern techniques which is utilized by our sophisticated team of employes. To ensure the quality of these Aluminum Handi, are tested and verified on various quality parameters to meet clients end. Moreover, these handi are displaced by us on time for hassle free delivery.</p>', '["uploads\\/products\\/1e5028b2c_1499086338.jpg"]', '["uploads\\/products\\/thumb\\/1e5028b2c_1499086338.jpg"]', 20, 2, 0, '1.90', 1, 1, '2017-07-03 01:16:55', '2017-07-05 07:12:52'),
(21, 0, 'Moving Head Flight Case', 'moving-head-flight-case', 'Banking upon our market understanding and well known team of experts, we have ranked ourselves as a trusted Supplier, Manufacturer and Exporter of Moving Head Flight Case. In order to suit the various parameters of the arena, we manufacture this in multiple sizes and shapes at comprehensive prices. It is made under the supervision of experienced and well known team of experts using ultra modern technology. Hence, our Moving Head Flight Case is extensively in demand.', '["uploads\\/products\\/09ec24121_1499086706.jpg"]', '["uploads\\/products\\/thumb\\/09ec24121_1499086706.jpg"]', 21, 2, 0, '50', 1, 0, '2017-07-03 01:18:00', '2017-07-03 07:28:26'),
(22, 0, 'Embroidered Purse', 'embroidered-purse', 'Our clients can avail from us superior quality Embroidered Purse. These Embroidered Purse are appreciated by large number of clients due to high quality and durability. These products are available in market at most economical rates.', '["uploads\\/products\\/6fbe17580_1499086721.jpg"]', '["uploads\\/products\\/thumb\\/6fbe17580_1499086721.jpg"]', 21, 2, 0, '60', 1, 0, '2017-07-03 01:18:24', '2017-07-03 07:28:41'),
(23, 0, 'Payal Covers', 'payal-covers', 'Payal Covers Our valued customers can purchase a wide range of high quality Payal Covers which are fabricated from optimum quality raw materials as per the contemporary designs and styles. The covers are used for packaging of Jewellery items like Payals, Bracelets and various gift items for wedding, birthday party etc.', '["uploads\\/products\\/82759e2bd_1499086729.jpg"]', '["uploads\\/products\\/thumb\\/82759e2bd_1499086729.jpg"]', 21, 2, 0, '90', 1, 1, '2017-07-03 01:18:49', '2017-07-03 08:57:42'),
(24, 0, 'Antique Solid Wood Door', 'antique-solid-wood-door', 'At this company, we are putting forward the most premium range of Antique Solid Wood Doors to our esteemed clients. The offered doors are made entirely with the use of selected anti termite & borer special type of wood. These are enormously appreciated and sought-after amongst clients for their elegant looks, sturdy construction, seamless finish and climate resistance. Owing to aforementioned attributes of the doors have attained us a reputed position in the market as a manufacturer and supplier of Antique Solid Wood Doors.\r\n\r\nFeatures of Antique Solid Wood Door:\r\nStronger and Thicker for better looks\r\nBroad frame for high impact absorption\r\nShower safe, slam proof and climate stable.\r\n"Asian Plywood Industries" offers beautiful Doors handcrafts made with solid wood and utilized for interior and exterior doors in complete designs displayed below. We offer customizable designs in complete range, which can be ordered as interior doors pre-hung on an indoor jamb or as outdoor doors pre-hung on an exterior doorpost with adaptable sill, seals, and entry door hardware. Interior doors for paint sort applications should be demanded in poplar or as a somewhat higher end option wood. Our comely interior door woods aren''t limited to red oak, mahogany, cherry and quarter sawn white wood. With our range of interior and exterior door designs you are going to have a collection of contemporary and traditional artifacts. Talk with our designer specialists and they will proffer you everything you are interested in.\r\nSquare Corner Joints and Hinges in the finishing of your choice Brass, Satin, ORB, Nickel or Black are all enclosed with without additional cost.\r\nExterior Pre-Hung Door Units that include an adjustable and versatile Mahogany Threshold.\r\nWe serve all Door Sizes, Door Swings and Jamb Width. \r\nEntry Doors\r\nIntroductory impressions are as crucial as of the first flush of morning. That’s why an antique or old-fashioned entry door offered by us make so much cognizance. A beautiful and winsome exterior door will be the very first thing your guests or customers see and comprehend, so preferring doors, which stand out and make an effect is advantageous. With us, you are going to boast and enjoy striking entry doors, as well as double doors, which come with transoms, leaded, stained and/or edged glass, doors with carved, single arched doors, antique wood doors made from walnut, pine, cedar, oak and other valuable antique woods. Besides these there are many entry doors available so please see our site''s section to pick the option that is entirely fit for you.', '["uploads\\/products\\/a0aa4419f_1499086739.jpg"]', '["uploads\\/products\\/thumb\\/a0aa4419f_1499086739.jpg"]', 24, 2, 0, '1000', 1, 0, '2017-07-03 01:22:32', '2017-07-03 07:28:59'),
(25, 0, 'Fine Antique Reproduction Furniture', 'fine-antique-reproduction-furniture', 'From our wide variety of wooden and antique furniture, we offer optimum quality Fine Antique Reproduction Furniture. This furniture is highly demanded in offices and houses for various purposes. The offered furniture is designed by our dexterous professionals by utilizing optimum quality wood and other raw materials with the help of latest technology. Clients can purchase this Fine Antique Reproduction Furniture from us in different sizes, patterns and designs as per their specific requirements.', '["uploads\\/products\\/a20477eba_1499086800.jpg"]', '["uploads\\/products\\/thumb\\/a20477eba_1499086800.jpg"]', 24, 2, 0, '80', 1, 1, '2017-07-03 01:23:07', '2017-07-03 08:57:41'),
(26, 0, 'Rectangle Coffee Table', 'rectangle-coffee-table', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '[]', '[]', 26, 2, 0, '80', 1, 0, '2017-07-03 01:24:19', '2017-07-05 23:55:53'),
(28, 0, 'test', 'test', 'testing', '["uploads\\/products\\/ab76ffdc1_1499252173.jpg"]', '["uploads\\/products\\/thumb\\/ab76ffdc1_1499252173.jpg"]', 9, 8, 0, '20', 1, 0, '2017-07-05 05:26:13', '2017-07-05 05:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(10) UNSIGNED NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `mobile`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'superadmin@carib.com', '9876543210', '$2y$10$5ItzDE6LA95OJLPDUYWxX.kXD39KxF8sw91UrVqD96MtfRmseAa0a', 0, 1, 'zbKfoiELKJqP8I8Hoen4mplZTDbRDcgRFGQIrMAHBPuZDSOLBmnaFsmZabum', '2017-06-26 07:16:22', '2017-07-05 10:48:22'),
(2, 'Dewanshu', 'Sharma', 'dewanshu.chapter247@gmail.com', NULL, '$2y$10$KyaoAkqNgFJhELvFfdqpt.Sat.HZXpuSZLySamkVCrLlvdzqqM0EG', 1, 1, 'WI2f6LrDPqroDT4GQE0fcEOtSBWUTaReFwysU2pTVfoWB4pi6YuANaMPGuy7', '2017-07-03 05:54:02', '2017-07-05 23:52:40'),
(7, 'test', 'test', 'test.chapter247@gmail.com', NULL, '$2y$10$4Cv6XB8/ZAclyML9HTXx4ex/w0ftDzopFAdEUynAeqkqyra1fbYva', 2, 1, NULL, '2017-07-03 05:54:59', '2017-07-03 05:54:59'),
(8, 'kuldeep', 'test', 'kuldeep.chapter247@gmail.com', NULL, '$2y$10$QfeleY7llcvHkpyNq.STiuVmkZKBu4qD535arfd8e1956y69J7KOm', 2, 1, '3VYdN5zv4HyMs9cvGAuary0JK6XYvIf00bmUW07JUApkYCasaeKhUgSeesfW', '2017-07-05 04:27:00', '2017-07-05 11:10:15'),
(9, 'kuldeep', 'test', 'kuldeep.chapter@gmail.com', NULL, '$2y$10$2xQ3DOvGuGh7.4ywI/jnROOmKU8WvLiLVtF9o4SNj9I/ikjo2IUx6', 1, 1, 'foF66oLCxMbLyRVxPDe0c0mKpBJ6DVVsVqdgrCmQfWfqriUkMXO1a2ADPK0J', '2017-07-05 04:53:23', '2017-07-05 07:48:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
