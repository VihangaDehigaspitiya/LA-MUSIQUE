-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 23, 2019 at 03:04 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `music_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `id` varchar(255) NOT NULL,
  `followingUserId` varchar(255) NOT NULL,
  `followedUserId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`id`, `followingUserId`, `followedUserId`) VALUES
('479C3500-F9C2-477C-9CDB-8DC66CD279AE', 'fc7d99a4-116a-48d4-97a5-26fad7b02a42', '72708BF0-5AE3-45D8-800E-01290E8255DC'),
('781db1d3-de2b-4a56-9d7e-dc7d1fd59292', '72708BF0-5AE3-45D8-800E-01290E8255DC', 'fc7d99a4-116a-48d4-97a5-26fad7b02a42');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `imageUrl` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `imageUrl`) VALUES
('103b05d7-2280-4c3a-aaaf-5af34563d754', 'R&B', 'r&b'),
('1d0cc46f-942e-4c94-842c-bd382677ec36', 'Opera', 'opera'),
('32885096-f5db-42c9-abb1-3f5d4dcebb57', 'Hip-Hop', 'hip-hop'),
('332a705d-8505-4823-9178-85f2f5f2f9b7', 'Reggae', 'reggae.jpg'),
('602672ad-dcd2-47c6-8cee-58e04d7472eb', 'Indie', 'indie'),
('7f59d6c5-f191-4aa3-9605-c1c2d42539dd', 'Electronic', 'electro.jpg'),
('903e2e52-e55e-4a79-8ce5-77269bb182da', 'Classical', 'classical'),
('98ac1293-1dab-4764-bb5a-faf2b4a0f7f6', 'Folk', 'folk'),
('b3fa0dc3-f1c5-42d0-9877-d63c4d1a00d2', 'Pop', 'pop.jpg'),
('b6e49b0a-66ed-4849-94c0-7ed14d018983', 'Jazz', 'jazz.jpg'),
('df8dea10-ba58-4762-bd16-1089a4d0ecf2', 'Metal', 'metal.jpg'),
('eaded62e-1004-4d09-9fef-7ed380650c85', 'Blues', 'blues.jpg'),
('f6327c26-e489-48a5-8e76-4e3ad9e82749', 'Soul', 'soul'),
('f7205af3-244a-44a3-83b0-26ba1128a5bd', 'Rock', 'rock.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `userId` varchar(255) NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `description`, `userId`, `updatedAt`) VALUES
('45D1BC3A-6A53-4CEB-8BCD-ADC608A4A606', 'fwfwef  https://images.unsplash.com/photo-1499084732479-de2c02d45fcc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80 https://www.decathlon.com/collections/power-walking Ataya https://stackoverflow.com/questions/50895806/bootstrap-4-multiselect-dropdown\r\nbiuy https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg https://www.belightsoft.com/products/imagetricks/img/intro-video-poster@2x.jpg https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg https://cdn.pixabay.com/photo/2018/01/14/23/12/nature-3082832_960_720.jpg', '72708BF0-5AE3-45D8-800E-01290E8255DC', '2019-11-18 22:43:32'),
('5CB34D19-6738-429E-9118-5F46728399AA', '34r34r34r3434r34rferferferfefrfer\r\nfc7d99a4-116a-48d4-97a5-26fad7b02a42', 'fc7d99a4-116a-48d4-97a5-26fad7b02a42', '2019-11-20 08:32:00'),
('ABDDEDEE-DECF-4C1F-993D-17035D994B9C', 'kjbjkfbsdfs https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg', '443646A9-D1A3-4064-9751-1DA24FC2BE2D', '2019-11-22 16:18:32'),
('CA848D02-168F-466C-84BF-428AB67CA209', 'fdsfsdfsdfsdf', '443646A9-D1A3-4064-9751-1DA24FC2BE2D', '2019-11-22 16:01:09'),
('F8D96B79-EA10-4E6A-96B4-F6A1F629DA55', 'https://images.pexels.com/photos/326055/pexels-photo-326055.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500 https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500 https://image.shutterstock.com/image-photo/colorful-flower-on-dark-tropical-260nw-721703848.jpg https://www.w3schools.com/w3css/img_lights.jpg', '443646A9-D1A3-4064-9751-1DA24FC2BE2D', '2019-11-22 16:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` varchar(255) NOT NULL,
  `token` varchar(300) NOT NULL,
  `createdAt` datetime NOT NULL,
  `expiredAt` datetime NOT NULL,
  `userId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `createdAt`, `expiredAt`, `userId`) VALUES
('215FCC80-FCD0-46F7-B8A0-F3C88FF4B6D8', '16194d056dd3312980d63d059aea72', '2019-11-17 22:09:37', '2019-11-17 22:39:37', '72708BF0-5AE3-45D8-800E-01290E8255DC'),
('491320D8-275A-408C-BFD7-2F7092CA6E93', '3435221c37e5a01cd30715e9b2a87c', '2019-11-17 22:03:44', '2019-11-17 22:33:44', '72708BF0-5AE3-45D8-800E-01290E8255DC'),
('492C118E-DBF7-44AE-A987-EB4B220BF1B2', '823b4fd1eacbd404afa473ec7ccdd4', '2019-11-18 22:47:07', '2019-11-18 23:17:07', '72708BF0-5AE3-45D8-800E-01290E8255DC'),
('6B4FC9C1-A3AE-462A-A32A-ECF8A3628209', '1c048791e8cb3c71782be8fd0c88f1', '2019-11-22 13:39:38', '2019-11-22 14:09:38', '443646A9-D1A3-4064-9751-1DA24FC2BE2D'),
('AB73FC29-2E83-4BB9-88C2-32104E39BEB5', '9dac7adda7e2f58c2a6e0496b17b34', '2019-11-20 03:18:45', '2019-11-20 03:48:45', '72708BF0-5AE3-45D8-800E-01290E8255DC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `timestamp` datetime NOT NULL,
  `imageUrl` varchar(200) NOT NULL,
  `emailConfirmed` tinyint(1) NOT NULL,
  `password` varchar(300) NOT NULL,
  `confirmationCode` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `timestamp`, `imageUrl`, `emailConfirmed`, `password`, `confirmationCode`) VALUES
('443646A9-D1A3-4064-9751-1DA24FC2BE2D', 'Kusal', 'Kahaduwa', 'kusal.2015292@iit.ac.lk', '2019-11-22 13:37:03', 'e3d74e93ed494af5400d70032733017e.png', 1, '$2y$10$1xZPW0peqzrckJIydQ.qd.7cqqX0NJWS2OMcxo/D4cb86JvUgQMfy', 'w2qdxaUkQDZY'),
('72708BF0-5AE3-45D8-800E-01290E8255DC', 'Vihanga', 'Dehigaspitiya', 'vihanga.2016417@iit.ac.lk', '2019-11-15 23:56:38', '36983635863d1d70f22b15dc6eebb5f4.JPG', 1, '$2y$10$NnJ9cq41zonJxrSTNCHMcejvwfP9bGQNfYkFNsWJbIJtomQHCto2q', 'lIvSt5WCJaLs'),
('e48e2f85-c443-493d-b9d4-2eee73e1fccc', 'Sajiya', 'Premadasa', 'sajiya@email.com', '2019-11-26 00:00:00', 'pop.jpg', 1, '123', '123'),
('fc7d99a4-116a-48d4-97a5-26fad7b02a42', 'Gota', 'Rajapaksha', 'gota@email.com', '2019-11-20 00:00:00', 'blues.jpg', 1, '123', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `users_genres`
--

CREATE TABLE `users_genres` (
  `id` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `genreId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_genres`
--

INSERT INTO `users_genres` (`id`, `userId`, `genreId`) VALUES
('28B71FBA-B9DE-4C93-A39E-2558F12006A4', '72708BF0-5AE3-45D8-800E-01290E8255DC', '602672ad-dcd2-47c6-8cee-58e04d7472eb'),
('5FA823D4-29FD-45A1-BB0D-AA185800B385', '72708BF0-5AE3-45D8-800E-01290E8255DC', '7f59d6c5-f191-4aa3-9605-c1c2d42539dd'),
('6312A159-2D09-4D92-9399-5AC3D51353B0', '443646A9-D1A3-4064-9751-1DA24FC2BE2D', '103b05d7-2280-4c3a-aaaf-5af34563d754'),
('71E1CDB1-F152-48B8-9D7E-0B2685DA88CD', '72708BF0-5AE3-45D8-800E-01290E8255DC', '903e2e52-e55e-4a79-8ce5-77269bb182da'),
('83a04ee5-18ce-42a0-a526-ffe4fe4f5695', 'e48e2f85-c443-493d-b9d4-2eee73e1fccc', '1d0cc46f-942e-4c94-842c-bd382677ec36'),
('9047FA84-435D-4D19-BABC-CE380E391B93', '72708BF0-5AE3-45D8-800E-01290E8255DC', '98ac1293-1dab-4764-bb5a-faf2b4a0f7f6'),
('a19b090b-9abd-40ca-a3c3-236e31c81d07', 'fc7d99a4-116a-48d4-97a5-26fad7b02a42', '1d0cc46f-942e-4c94-842c-bd382677ec36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followingId` (`followingUserId`),
  ADD KEY `followedId` (`followedUserId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token_relationship` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_genres`
--
ALTER TABLE `users_genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userIdRelationship` (`userId`),
  ADD KEY `genreId` (`genreId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `followedId` FOREIGN KEY (`followedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `followingId` FOREIGN KEY (`followingUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `token_relationship` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_genres`
--
ALTER TABLE `users_genres`
  ADD CONSTRAINT `genreId` FOREIGN KEY (`genreId`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `userIdRelationship` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
