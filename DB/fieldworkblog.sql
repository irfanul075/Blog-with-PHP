-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 10:07 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fieldworkblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`) VALUES
(3, 'Web Developement', 'web-developement', '2018-10-20 17:17:34'),
(4, 'HTML', 'html', '2018-10-20 17:20:47'),
(5, 'CSS', 'css', '2018-10-20 17:35:12'),
(6, 'PHP', 'php', '2018-10-20 17:35:20'),
(7, 'Javascript', 'javascript', '2018-10-20 17:35:32'),
(8, 'Framework', 'framework', '2018-10-20 17:35:45'),
(9, 'Web Design', 'web-design', '2018-10-20 17:35:56'),
(10, 'Database', 'database', '2018-10-20 17:37:13'),
(11, 'SQL', 'sql', '2018-10-20 17:37:22'),
(12, 'UX', 'ux', '2018-10-20 17:37:41'),
(13, 'UI', 'ui', '2018-10-20 17:37:46'),
(14, 'React Js', 'react-js', '2018-10-20 17:38:36'),
(15, 'Angular', 'angular', '2018-10-20 17:38:42'),
(16, 'Wordpress', 'wordpress', '2018-10-20 17:38:49'),
(17, 'IOT', 'iot', '2018-10-20 17:39:05'),
(18, 'Java', 'java', '2018-11-06 15:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `user_id`, `post_id`, `created_at`) VALUES
(1, 'Test Comment', 1, 8, '2018-10-22 08:36:47'),
(2, 'aaaaa', 1, 8, '2018-10-22 09:04:00'),
(4, 'Test comment for this post\r\n\r\n', 3, 14, '2018-10-22 09:30:29'),
(7, 'asas', 2, 8, '2018-10-22 09:47:15'),
(8, 'sssss', 3, 7, '2018-10-22 10:37:01'),
(10, 'ffff', 3, 4, '2018-10-28 13:40:22'),
(11, 'test comment', 3, 17, '2018-11-06 15:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) DEFAULT NULL,
  `reset_token` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` mediumtext NOT NULL,
  `categories` varchar(50) DEFAULT NULL,
  `feature_image` varchar(50) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `categories`, `feature_image`, `status`, `created_at`, `user_id`) VALUES
(4, 'This is test title 1', '<p>Proin rhoncus volutpat mauris, at posuere dolor suscipit vel. Quisque sollicitudin massa purus, vitae maximus massa vestibulum non. Nullam ultrices varius lacus vitae dictum. Vestibulum blandit tincidunt tellus, et dictum nisl sagittis nec. Maecenas nec ornare turpis. Curabitur sit amet tortor vel orci ultrices sodales. Praesent malesuada congue convallis. Cras egestas porta sem, id ullamcorper quam volutpat ut. Aenean quam nisl, mattis at dignissim</p>\r\n<table style=\"border-collapse: collapse; width: 11.0874%; height: 36px;\" border=\"1\">\r\n<tbody>\r\n<tr style=\"height: 18px;\">\r\n<td style=\"width: 33.3333%; height: 18px;\">dfdfdf</td>\r\n</tr>\r\n<tr style=\"height: 18px;\">\r\n<td style=\"width: 33.3333%; height: 18px;\">eefefdfdf</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Web Developement', '5bca02caabea7.jpg', 0, '2018-10-20 19:06:24', 2),
(5, 'This is test title 2', '<p>Proin rhoncus volutpat mauris, at posuere dolor suscipit vel. Quisque sollicitudin massa purus, vitae maximus massa vestibulum non. Nullam ultrices varius lacus vitae dictum. Vestibulum blandit tincidunt tellus, et dictum nisl sagittis nec. Maecenas nec ornare turpis. Curabitur sit amet tortor vel orci ultrices sodales. Praesent malesuada congue convallis. Cras egestas porta sem, id ullamcorper quam volutpat ut. Aenean quam nisl, mattis at dignissim</p>\r\n<p>&nbsp;lectus. Sed massa ligula, cursus<span style=\"background-color: #ffcc00;\"> non ultrices a, elementum vitae felis. Ut ligula purus, faucibus et sapien id, posuere tristique turpis. Morbi sed tincidunt tellus. Proin tincidunt sodales urna, quis scelerisque ipsum sodales rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tincidunt, ipsum vitae laoreet cong sdsds</span></p>', 'React Js', '5bc9fa47b68e4.jpg', 0, '2018-11-28 08:01:45', 2),
(7, 'This is test title 14', '<h1>Lorem Ipsum</h1>\r\n<h4>\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"</h4>\r\n<h5>\"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"</h5>\r\n<hr />\r\n<div id=\"Content\">\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet tincidunt eros. Curabitur semper nunc at neque pharetra, vulputate posuere lectus fringilla. Quisque nec ipsum gravida, finibus leo sit amet, volutpat purus. Proin vitae velit a leo faucibus tincidunt a id sapien. Pellentesque nulla libero, porta nec felis id, facilisis luctus sapien. Nulla tristique tempor pretium. Fusce et lacus vitae nibh condimentum consequat quis eu lectus. Pellentesque ante erat, bibendum vel erat quis, tincidunt tempus orci. Duis vel diam ex. Cras malesuada sed sem eget sodales. Aliquam condimentum dignissim ipsum id lobortis. Integer vestibulum vel tortor non porta. Fusce ultricies finibus nisl, in convallis risus vulputate ut. Etiam volutpat felis lacus, id semper leo aliquet eget. Mauris non tortor tempus, consectetur dui at, ullamcorper sapien.</p>\r\n<p>Nulla nec tempus arcu. Aenean quis sagittis tortor. Aliquam congue lacus nec libero aliquam pretium. Donec et consectetur quam. Maecenas imperdiet ligula et purus auctor tempus. Pellentesque ut hendrerit libero. Proin semper ex a augue facilisis, consectetur laoreet lectus lobortis. Aenean vitae risus vel neque tempus suscipit. Donec tristique molestie tincidunt. Vivamus cursus, libero pharetra laoreet tristique, nibh lectus tincidunt est, ut feugiat risus mauris at nibh. Sed vulputate tincidunt lorem eu auctor. Cras at elit elementum est facilisis posuere eu ac urna. Aliquam at massa vitae lectus semper vehicula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>\r\n<p>Vivamus volutpat luctus pulvinar. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque venenatis mattis lacus, vel luctus metus hendrerit sit amet. Praesent non ex turpis. Praesent imperdiet purus ac nisi sollicitudin, ac vestibulum mi fermentum. Nulla vitae nisi ut dui efficitur mollis a vitae risus. Proin eu leo et justo facilisis dignissim. Mauris gravida sem nec velit sollicitudin efficitur.</p>\r\n<p>Proin finibus metus sem, ut consequat sapien consequat ac. Donec ac ligula vitae sapien tincidunt sollicitudin ut id mi. In hac habitasse platea dictumst. Mauris sed tempor urna. Vestibulum tristique nibh mauris, vehicula luctus mi egestas nec. Nulla maximus pulvinar nunc ac lobortis. Vestibulum lobortis porttitor tellus, a auctor nulla semper non. Etiam eu velit in ipsum dictum tincidunt bibendum eu tortor. Sed sem enim, pellentesque ullamcorper cursus a, rutrum non velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>\r\n<p>Aliquam urna magna, finibus eget elit sit amet, convallis placerat leo. Maecenas lacinia lacus eget euismod porttitor. Quisque a tellus tincidunt, dignissim felis nec, pharetra lectus. Donec sodales tempor porta. Aliquam pellentesque sem sed mauris interdum aliquet nec id risus. Donec a fringilla nisi, eu lobortis ligula. Praesent sit amet eros feugiat, hendrerit neque nec, tempus risus. Aenean tempus rutrum purus. Etiam nec pretium diam. Ut orci lectus, dignissim non arcu quis, volutpat faucibus nibh. Nunc velit nibh, dictum et semper et, porttitor eget leo. Maecenas quis fringilla tortor. Phasellus sodales eleifend semper. Vivamus eget est eget est accumsan porttitor eu et urna. Vivamus mollis a dui ut maximus. Sed eget eros elit.</p>\r\n</div>\r\n</div>\r\n</div>', 'Web Developement', '5bcac5b1aa989.jpg', 0, '2018-10-20 20:02:30', 1),
(8, 'This is test title 7', '<p style=\"text-align: center;\">orem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet tincidunt eros. Curabitur semper nunc at neque pharetra, vulputate posuere lectus fringilla. Quisque nec ipsum gravida, finibus leo sit amet, volutpat purus. Proin vitae velit a leo faucibus tincidunt a id sapien. Pellentesque nulla libero, porta nec felis id, facilisis luctus sapien. Nulla tristique tempor pretium. Fusce et lacus vitae nibh condimentum consequat quis eu lectus. Pellentesque ante erat, bibendum vel erat quis, tincidunt tempus orci. Duis vel diam ex. Cras malesuada sed sem eget sodales. Aliquam condimentum dignissim ipsum id lobortis. Integer vestibulum vel tortor non porta. Fusce ultricies finibus nisl, in convallis risus vulputate ut. Etiam volutpat felis lacus, id semper leo aliquet eget. Mauris non tortor tempus, consectetur dui at, ullamcorper sapien.</p>', 'HTML', '5bcac9194537c.jpg', 0, '2018-10-20 10:41:44', 1),
(12, 'This is test title 12 update Again', '<p>mperdiet <span style=\"background-color: #ff00ff;\">ligula et purus auctor temp</span>us. Pellentesque ut hendrerit libero. Proin semper ex a augue facilisis, consectetur laoreet lectus lobortis. Aenean vitae risus vel neque tempus suscipit. Donec tristique molestie ti<strong>ncidunt. Vivamus cursus, libero pharetra laoreet tristique, nibh lectus ti</strong>ncidunt est, ut feugiat risus mauris at nibh. Sed vulputate tincidunt</p>', 'CSS', '5bcaf489940e4.jpg', 1, '2018-10-20 09:25:29', 1),
(14, 'Admin test post 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra dolor in risus fringilla faucibus. Maecenas efficitur mattis augue at efficitur. Nulla vestibulum augue id odio tempus porta. Etiam pulvinar sapien aliquet imperdiet dapibus. Cras ut lacus bibendum leo vestibulum egestas. In tristique fringilla ornare. Quisque pellentesque ante aliquam, ornare libero a, auctor risus. Fusce vel tortor eu ligula consectetur porttitor vel ac ipsum.</p>\r\n<p>Etiam tellus ipsum, condimentum sed accumsan ac, viverra nec turpis. Ut ultricies pharetra dui, in hendrerit purus ultricies quis. Nulla ornare mollis felis rutrum tincidunt. Curabitur semper odio et ex tempor, non facilisis elit ornare. Sed non felis non ex mattis egestas. Fusce quis nibh lacinia, euismod elit a, blandit turpis. In finibus, ligula a dignissim varius, metus felis ultrices ipsum, sed tempor neque nisi eu felis. Pellentesque vel mauris leo. Morbi elementum erat at massa gravida dapibus.</p>', 'Web Design', '5bcb28fbd4021.jpg', 0, '2018-10-20 19:07:48', 3),
(15, 'This is test title 20', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra dolor in risus fringilla faucibus. Maecenas efficitur mattis augue at efficitur. Nulla vestibulum augue id odio tempus porta. Etiam pulvinar sapien aliquet imperdiet dapibus. Cras ut lacus bibendum leo vestibulum egestas. In tristique fringilla ornare. Quisque pellentesque ante aliquam, ornare libero a, auctor risus. Fusce vel tortor eu ligula consectetur porttitor vel ac ipsum.</p>\r\n<p>Etiam tellus ipsum, condimentum sed accumsan ac, viverra nec turpis. Ut ultricies pharetra dui, in hendrerit purus ultricies quis. Nulla ornare mollis felis rutrum tincidunt. Curabitur semper odio et ex tempor, non facilisis elit ornare. Sed non felis non ex mattis egestas. Fusce quis nibh lacinia, euismod elit a, blandit turpis. In finibus, ligula a dignissim varius, metus felis ultrices ipsum, sed tempor neque nisi eu felis. Pellentesque vel mauris leo. Morbi elementum erat at massa gravida dapibus.</p>', 'SQL', '5bcb6ab17a966.jpg', 0, '2018-10-20 19:06:48', 2),
(16, 'This is test title 40', '<p>s porttitor risus, eleifend sagittis ex nisi eu sapien. Sed nibh magna, gravida vel blandit ut, bibendum id elit. Sed sit amet venenatis risus, id porta lacus. Cras accumsan bibendum libero. Curabitur auctor nisi a diam viverra, sed accumsan nunc tincidunt. Pellentesque tempus, orci non rutrum egestas, nunc urna mollis metus, a hendrerit lectus nisl venenatis sapien. Phasellus rutrum, erat eget interdum tristique, turpis eros efficitur tellus, non fermentum urna orci at massa.</p>\r\n<p>In non eros et felis pellentesque consequat venenatis sagittis massa. Don</p>', 'UX', '5bcb7185689b6.jpg', 0, '2018-10-20 19:07:01', 2),
(17, 'This is test title 24', '&lt;p&gt;s porttitor risus, eleifend sagittis ex nisi eu sapien. Sed nibh magna, gravida vel blandit ut, bibendum id elit. Sed sit amet venenatis risus, id porta lacus. Cras accumsan bibendum libero. Curabitur auctor nisi a diam viverra, sed accumsan nunc tincidunt. Pellentesque tempus, orci non rutrum egestas, nunc urna mollis metus, a hendrerit lectus nisl venenatis sapien. Phasellus rutrum, erat eget interdum tristique, turpis eros efficitur tellus, non fermentum urna orci at massa.&lt;/p&gt;\r\n&lt;p&gt;In non eros et felis pellentesque consequat venenatis sagittis massa. Don&lt;/p&gt;', 'Javascript', '5bcb78d0225d7.jpg', 0, '2018-10-20 18:49:52', 2),
(19, 'This is test title 33', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tortor lacus, sollicitudin et mauris nec, lacinia fringilla justo. Vivamus pretium mauris id auctor ultrices. Vestibulum vestibulum, nisl at efficitur semper, metus leo euismod nisl, a facilisis mauris mi ac enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec venenatis feugiat rhoncus. Praesent mollis, arcu eleifend egestas luctus, eros dolor scelerisque est, vitae tristique metus purus quis nisi. Mauris lacinia et nibh quis volutpat.&lt;/p&gt;\r\n&lt;p&gt;Quisque a luctus quam. Proin aliquet ut orci vel molestie. Nulla luctus, tellus et auctor volutpat, nulla odio malesuada risus, sit amet venenatis risus sem in tellus. Sed nulla orci, condimentum non semper sit amet, gravida id risus. Aliquam ornare magna purus, egestas vehicula odio interdum id. In consequat lacus ligula, suscipit malesuada arcu vestibulum vehicula. Suspendisse consequat risus et nulla placerat laoreet quis vel justo. Suspendisse vel nisi at nibh consequat egestas eu eleifend risus. Sed eleifend congue nisi nec sollicitudin.&lt;/p&gt;\r\n&lt;p&gt;Fusce tincidunt et velit nec auctor. Praesent vitae enim id ex pharetra tempor. Nulla ultrices elementum eleifend. Duis ultrices rutrum tellus quis pellentesque. Nullam lacinia sem sit amet lectus aliquet, ut dictum risus tristique. Curabitur venenatis vel sem at sollicitudin. Duis accumsan orci eros, vel condimentum ex tempus et. Donec condimentum nulla quam, quis congue sem congue vel. Pellentesque mattis diam vel tellus venenatis iaculis sed in dolor. Aliquam interdum molestie est in mattis. In nunc odio, pellentesque ullamcorper arcu nec, facilisis tincidunt neque. Nunc mi nulla, rutrum at purus vel, suscipit ultricies metus.&lt;/p&gt;', 'Framework', '5bfe4c0bbdef3.jpg', 0, '2018-11-28 08:04:56', 2),
(20, 'This is test title 22', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tortor lacus, sollicitudin et mauris nec, lacinia fringilla justo. Vivamus pretium mauris id auctor ultrices. Vestibulum vestibulum, nisl at efficitur semper, metus leo euismod nisl, a facilisis mauris mi ac enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec venenatis feugiat rhoncus. Praesent mollis, arcu eleifend egestas luctus, eros dolor scelerisque est, vitae tristique metus purus quis nisi. Mauris lacinia et nibh quis volutpat.&lt;/p&gt;\r\n&lt;p&gt;Quisque a luctus quam. Proin aliquet ut orci vel molestie. Nulla luctus, tellus et auctor volutpat, nulla odio malesuada risus, sit amet venenatis risus sem in tellus. Sed nulla orci, condimentum non semper sit amet, gravida id risus. Aliquam ornare magna purus, egestas vehicula odio interdum id. In consequat lacus ligula, suscipit malesuada arcu vestibulum vehicula. Suspendisse consequat risus et nulla placerat laoreet quis vel justo. Suspendisse vel nisi at nibh consequat egestas eu eleifend risus. Sed eleifend congue nisi nec sollicitudin.&lt;/p&gt;\r\n&lt;p&gt;Fusce tincidunt et velit nec auctor. Praesent vitae enim id ex pharetra tempor. Nulla ultrices elementum eleifend. Duis ultrices rutrum tellus quis pellentesque. Nullam lacinia sem sit amet lectus aliquet, ut dictum risus tristique. Curabitur venenatis vel sem at sollicitudin. Duis accumsan orci eros, vel condimentum ex tempus et. Donec condimentum nulla quam, quis congue sem congue vel. Pellentesque mattis diam vel tellus venenatis iaculis sed in dolor. Aliquam interdum molestie est in mattis. In nunc odio, pellentesque ullamcorper arcu nec, facilisis tincidunt neque. Nunc mi nulla, rutrum at purus vel, suscipit ultricies metus.&lt;/p&gt;', 'Angular', '5bfe4c45ade46.jpg', 1, '2018-11-28 08:05:25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `activation_code` varchar(100) DEFAULT NULL,
  `active` tinyint(3) DEFAULT '0',
  `user_type` tinyint(3) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `activation_code`, `active`, `user_type`, `created_at`) VALUES
(1, 'Irfanul Karim', 'irfanul075@gmail.com', '5bcac55974072.png', '$2y$10$Kt2jCva5EirqpM0J/MhC4ezyCq9LiLvG4/Rj/ejgTI6lyAnm/NZYy', 'c0c7c76d30bd3dcaefc96f40275bdc0a', 1, 0, '2018-10-20 06:04:38'),
(2, 'Shahriar Rifat', '2ltp420@gmail.com', '5bca438aab202.png', '$2y$10$vNwxoriwZxlcK3wGDNPHuOs6tRMFqZsgWlqHo6tj135T0RwGFpfda', 'f033ab37c30201f73f142449d037028d', 1, 0, '2018-11-28 08:01:02'),
(3, 'Admin', 'admin@app.com', '5bcb1f97b8445.png', '$2y$10$p3tL/JpPkCONNdBzsLlZs.ZH8vKmUCy5kIs0zOagLIJTI4hVcUNGC', 'csc7c76d30bd3dcaefc96f40275bdc0a', 1, 1, '2018-10-20 12:29:11'),
(4, 'Shahriar', 'testuser1@gmail.com', '5bca438aab202.png', '$2y$10$dy96Ob9Nv0bkZlDG2ONrVu/Ls8e4QnWccg2oHRtmSA4Z9dUBE9/Ay', 'fss3ab37c30201f73f142449d037028d', 0, 0, '2018-10-19 21:15:19'),
(5, 'Nahid', 'irfanulprs@gmail.com', NULL, '$2y$10$MK8X1IP.YEvHYShhMvKUwupDin4U6QAHj.lPiqSpjzs3UfDgo4yb2', '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 0, 0, '2018-11-06 15:32:10'),
(6, 'Raihan', 'irfanulbsn@gmail.com', NULL, '$2y$10$bASgBnMUPz5O9RlQyeuKs.hx5/JswhT4kWVBIXiH99u8MWayyOM7m', '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 1, 0, '2018-11-28 08:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
