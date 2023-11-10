-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 12:33 PM
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
-- Database: `paws_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `paws_admin`
--

CREATE TABLE `paws_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paws_admin`
--

INSERT INTO `paws_admin` (`admin_id`, `admin_name`, `admin_pass`, `pet_id`, `d_id`, `a_id`) VALUES
(1, 'admin', '1234', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladopter`
--

CREATE TABLE `tbladopter` (
  `a_id` int(11) NOT NULL,
  `a_fname` varchar(255) NOT NULL,
  `a_lname` varchar(255) NOT NULL,
  `a_email` varchar(255) NOT NULL,
  `a_address` varchar(255) NOT NULL,
  `a_number` int(8) NOT NULL,
  `a_username` varchar(255) NOT NULL,
  `a_pass` varchar(255) NOT NULL,
  `a_profile` varchar(300) DEFAULT NULL,
  `a_status` tinyint(1) NOT NULL DEFAULT 1,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladopter`
--

INSERT INTO `tbladopter` (`a_id`, `a_fname`, `a_lname`, `a_email`, `a_address`, `a_number`, `a_username`, `a_pass`, `a_profile`, `a_status`, `location_id`) VALUES
(5, 'anais', 'barbe', 'anais@gamil.com', '432 wonderland', 57435790, 'anais', '81dc9bdb52d04dc20036dbd8313ed055', 'w3.jpg', 0, 7),
(6, 'lewis', 'friedman', 'lewis@gmail.com', '20 Bourbon Street, Port Louis', 59633221, 'lewis', '81dc9bdb52d04dc20036dbd8313ed055', 'm4.jpg', 0, 1),
(7, 'natasha', 'santana', 'natasha@gmail.com', 'Circonstance, Saint Pierre', 54331740, 'natasha', '81dc9bdb52d04dc20036dbd8313ed055', 'w4.jpg', 1, 5),
(8, 'isra', 'simpson', 'isra@gmail.com', '7 Stevenson Bain Des Dames', 59089668, 'isra', '81dc9bdb52d04dc20036dbd8313ed055', 'w1.jpg', 1, 7),
(9, 'betsy', 'Willis', 'betsy@gmail.com', 'Hitchcore Avenue ', 59067988, 'betsy', '81dc9bdb52d04dc20036dbd8313ed055', 'w7.jpg', 1, 3),
(10, 'Ivan', 'Adam', 'ivan@gmail.com', '286 Stevenson Avenue', 54679839, 'Ivan', '81dc9bdb52d04dc20036dbd8313ed055', 'm1.jpg', 1, 4),
(11, 'Jack ', 'Sparrow', 'jack@gmail.com', 'carraibe', 54786547, 'sparrow', '81dc9bdb52d04dc20036dbd8313ed055', 'm3.jpg', 1, 1),
(12, 'Joanne', 'Reny', 'joanne@gmail.com', '12 vandermesh', 58754329, 'joanne', '81dc9bdb52d04dc20036dbd8313ed055', 'w4.jpg', 1, 3),
(14, 'test', 'test', 'testing@gmail.com', '7 Stevenson Bain Des Dames', 57435790, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'cattreat.jpg', 1, 1),
(16, 'Michael ', 'Ling', 'halan22066@sportrid.com', 'Circonstance, Saint Pierre', 59067998, 'michael', '81dc9bdb52d04dc20036dbd8313ed055', 'm2.jpg', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbladoption`
--

CREATE TABLE `tbladoption` (
  `adopt_id` int(11) NOT NULL,
  `adopt_date` date NOT NULL,
  `adopt_status` tinyint(4) NOT NULL,
  `a_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladoption`
--

INSERT INTO `tbladoption` (`adopt_id`, `adopt_date`, `adopt_status`, `a_id`, `pet_id`) VALUES
(4, '2023-07-19', 2, 9, 9),
(5, '2023-07-23', 2, 9, 11),
(6, '2023-07-23', 2, 9, 10),
(10, '2023-07-23', 2, 9, 14),
(17, '2023-07-27', 2, 11, 14),
(18, '2023-07-27', 2, 9, 16),
(22, '2023-07-31', 1, 11, 9),
(23, '2023-08-01', 1, 11, 15),
(26, '2023-08-01', 2, 16, 22),
(27, '2023-08-01', 2, 16, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbladvert`
--

CREATE TABLE `tbladvert` (
  `ad_id` int(11) NOT NULL,
  `ad_image` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `websiteurl` varchar(255) NOT NULL,
  `ad_desc` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `org_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladvert`
--

INSERT INTO `tbladvert` (`ad_id`, `ad_image`, `company_name`, `websiteurl`, `ad_desc`, `status`, `org_id`) VALUES
(1, 'ipgone14.jpg', 'APEX Company', 'https://www.apple.com/', 'Advertising our brand New Iphone 14 ', 1, 2),
(2, 'iphoneXs.jpg', 'APEX Company', 'https://www.apple.com/', 'Advertising our brand New IphoneXs', 1, 2),
(3, 'campaign-Samsung-Galaxy-S22-Ultra-Z-Flip4-1.png', 'Samsung Mauritius', 'https://www.samsung.com/us/', 'Advertising our brand New Samsung S22 Ultra Z Flip4', 1, 3),
(4, 'coca.jpg', 'Coca Cola', 'https://www.coca-colacompany.com/', 'Advertising our new coca cola ', 1, 4),
(5, 'macdo1.png', 'McDonald\'s Mauritus', 'https://www.mcdonalds.com/us/en-us.html', 'Advertising our new McBurger Bundles for you!', 1, 1),
(7, 'courts.jpg', 'Courts', 'https://www.courts.com/', 'advertising our company. Do visits us', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbldonator`
--

CREATE TABLE `tbldonator` (
  `d_id` int(11) NOT NULL,
  `d_fname` varchar(255) NOT NULL,
  `d_lname` varchar(255) NOT NULL,
  `d_email` varchar(255) NOT NULL,
  `d_address` varchar(255) NOT NULL,
  `d_number` int(8) NOT NULL,
  `d_username` varchar(255) NOT NULL,
  `d_pass` varchar(255) NOT NULL,
  `d_profile` varchar(300) DEFAULT NULL,
  `d_status` tinyint(1) NOT NULL DEFAULT 1,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldonator`
--

INSERT INTO `tbldonator` (`d_id`, `d_fname`, `d_lname`, `d_email`, `d_address`, `d_number`, `d_username`, `d_pass`, `d_profile`, `d_status`, `location_id`) VALUES
(12, 'Diana', 'wane', 'diana@gmail.com', 'La Louise, Quatre Bornes', 57486949, 'diana', '81dc9bdb52d04dc20036dbd8313ed055', 'w6.jpg', 1, 2),
(13, 'james', 'harriston', 'james@gmail.com', ' 7F, Immeuble des Mascareignes Avenue Surcouf', 57566849, 'james', '81dc9bdb52d04dc20036dbd8313ed055', 'm2.jpg', 1, 4),
(14, 'kishan', 'ruttun', 'kishan@gmail.com', '19,Jules Koening Street', 57436049, 'kishan', '81dc9bdb52d04dc20036dbd8313ed055', 'm1.jpg', 1, 5),
(15, 'melissa', 'wayne', 'melissa@gmail.com', 'Boundary, rose hill', 57451729, 'melissa', '81dc9bdb52d04dc20036dbd8313ed055', 'w4.jpg', 1, 3),
(16, 'cedric', 'meriza', 'cedric@gmail.com', '127 Frederic Avenue', 58261523, 'cedric', '81dc9bdb52d04dc20036dbd8313ed055', 'm1.jpg', 1, 1),
(18, 'sameer', 'Terell', 'sameer@gmail.com', 'China Town 123', 57478949, 'sameer', '81dc9bdb52d04dc20036dbd8313ed055', 'm1.jpg', 1, 1),
(21, 'Brendon', 'hayes', 'brendon@gmail.com', ' 9F,  Avenue Surcouf', 58235423, 'hayes', '1234', 'm4.jpg', 1, 4),
(22, 'Raquel', 'Armada', 'armada@gmail.com', '666 avenue prison', 66666666, 'armada', '12345', 'm1.jpg', 1, 5),
(23, 'Shane', 'Becker', 'shane@gmail.com', '28 Route Hugnin, Rose Hill', 57342874, 'shane', '1234', 'm2.jpg', 1, 3),
(24, 'kjshcfkjf', 'hfujfilkmf', 'zanmarie@gmail.com', '126 Frederic Avenue', 57476465, 'zanlik', '1234', 'g2.jpg', 1, 5),
(26, 'Jenna', 'Ortis', 'jenna@gmail.com', '12 royal road ', 56784359, 'jenna', '12345', 'w2.jpg', 1, 4),
(31, 'danny', 'warris', 'vajedi8573@inkiny.com', '123 royal road ', 57645678, 'danny', '1234', 'm2.jpg', 1, 5),
(32, 'Asa', 'Winter', 'sisayo7610@wiemei.com', 'La Louise, Quatre Bornes', 57645678, 'Winter', '12345', 'w5.jpg', 1, 5),
(33, 'Azra', 'Winchester', 'sibodo9800@wiemei.com', '19,Jules Koening Street', 57436089, 'azra', '12345', 'w4.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblequipments`
--

CREATE TABLE `tblequipments` (
  `equip_id` int(11) NOT NULL,
  `equip_name` varchar(255) NOT NULL,
  `equip_desc` varchar(255) NOT NULL,
  `equip_date` date NOT NULL,
  `equip_img` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `d_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblequipments`
--

INSERT INTO `tblequipments` (`equip_id`, `equip_name`, `equip_desc`, `equip_date`, `equip_img`, `status`, `d_id`) VALUES
(1, 'Full set Accessories For Puppies.', 'The set have only been used for 1 month. Unfortunately my puppy died recently and i wanted to donate those set to whoever needs a carry bag, eating bowl, and more. You will see in the above image am posting. ', '2023-07-24', 'donate2.jpg', 1, 22),
(2, 'Cat Treats', 'Treats for only adult cats. 8packs of delectable with tuna. They will love it  ', '0000-00-00', 'cattreat.jpg', 1, 21),
(3, 'Dog Shampoo', 'Effectively good for all type of dog.', '2023-08-01', 'dogshampoo.jpg', 1, 32),
(4, 'Dog Bowls', 'Bowls for dog to have a great appetite', '2023-08-01', 'dogbowl.jpg', 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE `tbllocation` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`location_id`, `location_name`) VALUES
(1, 'Port Louis'),
(2, 'Quatre Bornes'),
(3, 'Rose Hill'),
(4, 'Curepipe'),
(5, 'Saint Pierre'),
(6, 'Phoenix'),
(7, 'Triolet');

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `notice_id` int(11) NOT NULL,
  `notice_name` varchar(255) NOT NULL,
  `notice_desc` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `notice_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `d_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`notice_id`, `notice_name`, `notice_desc`, `picture`, `notice_date`, `status`, `d_id`) VALUES
(7, 'Lost My pet', 'He is a golden retriever, Namely Chuck. I lost my lovely pet on june30th and I wanted to share this with people so I can find him ASAP.', 'dog.jpg', '2023-07-24', 1, 22),
(8, 'Searching For cat ', 'If you some one find my cat, please contact me. Thank you.!', 'cat2.jpg', '2023-07-31', 1, 21),
(9, 'Need to find this type of tortoise', 'If anyone knows, do contact me please ', 't2.jpg', '2023-08-01', 1, 32),
(10, 'Lost My pet Queeny', 'If you find her do contact me please', 'griffon.jpg', '2023-08-01', 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `tblorganisation`
--

CREATE TABLE `tblorganisation` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `org_email` varchar(255) NOT NULL,
  `org_number` int(8) NOT NULL,
  `org_username` varchar(255) NOT NULL,
  `org_pass` varchar(255) NOT NULL,
  `org_profile` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorganisation`
--

INSERT INTO `tblorganisation` (`org_id`, `org_name`, `org_email`, `org_number`, `org_username`, `org_pass`, `org_profile`, `status`) VALUES
(1, 'McDonald\'s Mauritius', 'macdo@gmail.com', 58432679, 'macdo', '827ccb0eea8a706c4c34a16891f84e7b', 'visual-karsa-y8fS7CSN-Vw-unsplash.jpg', 1),
(2, 'APEX Company', 'apex@gmail.com', 54565860, 'APEX', '81dc9bdb52d04dc20036dbd8313ed055', 'nastuh-abootalebi-eHD8Y1Znfpk-unsplash.jpg', 1),
(3, 'Samsung Mauritius', 'samsung@gmail.com', 57634568, 'samsung', '81dc9bdb52d04dc20036dbd8313ed055', 'babak-habibi-34uOaL1He4w-unsplash.jpg', 1),
(4, 'Coca Cola ', 'coca@gmail.com', 56787650, 'Coca Cola', '81dc9bdb52d04dc20036dbd8313ed055', 'coca company.jpg', 1),
(8, 'Court Mammouth', 'cetike3353@quipas.com', 57687678, 'Courts', '81dc9bdb52d04dc20036dbd8313ed055', 'babak-habibi-34uOaL1He4w-unsplash.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpet`
--

CREATE TABLE `tblpet` (
  `pet_id` int(11) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_age` int(2) DEFAULT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_desc` varchar(255) DEFAULT NULL,
  `arrival_date` date NOT NULL,
  `pet_image` varchar(255) DEFAULT NULL,
  `pet_status` tinyint(1) NOT NULL DEFAULT 1,
  `species_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpet`
--

INSERT INTO `tblpet` (`pet_id`, `pet_name`, `pet_age`, `pet_gender`, `pet_desc`, `arrival_date`, `pet_image`, `pet_status`, `species_id`, `d_id`) VALUES
(9, 'Charlie', 6, 'male', 'Charlie is a Scottish breed of retriever. He is very gentle and affectionate.', '2023-07-19', 'golden retriever.jpg', 1, 2, 21),
(10, 'Penny', 7, 'female', 'Penny is the best tortoise pet you can have. She is only 7 Years old and can live long, require minimal care and have a personality of their own. ', '2023-07-19', 't1.jpg', 1, 12, 23),
(11, 'Luna', 18, 'female', 'ndjjdj', '2023-07-22', 'cat2.jpg', 1, 1, 22),
(14, 'Choupi', 12, 'male', 'Choupi is very furry and have strong, large hind legs.  He always wants to learn new things. He needs a specific diet and an appropriate housing for good health', '2023-07-23', 'r2.jpg', 1, 5, 22),
(15, 'alfred', 6, 'female', 'Penny is the best tortoise pet you can have. She is only 7 Years old and can live long, require minimal care and have a personality of their own. ', '2023-07-25', 't2.jpg', 0, 12, 24),
(16, 'rex', 8, 'male', 'test', '2023-07-25', 'g2.jpg', 1, 4, 24),
(17, 'lili', 7, 'female', 'test', '2023-07-25', 'dog.jpg', 1, 2, 24),
(22, 'kelly', 1, 'female', 'kylie is a very passionate and healthy fish', '2023-08-01', 'f5.jpg', 1, 20, 33);

-- --------------------------------------------------------

--
-- Table structure for table `tblpet_type`
--

CREATE TABLE `tblpet_type` (
  `species_id` int(11) NOT NULL,
  `species_name` varchar(255) NOT NULL,
  `species_pic` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpet_type`
--

INSERT INTO `tblpet_type` (`species_id`, `species_name`, `species_pic`) VALUES
(1, 'Cats', 0x6361742e6a7067),
(2, 'Dogs', 0x707570706965732e6a7067),
(3, 'Rabbits', 0x72322e6a7067),
(4, 'Guinea Pigs', 0x67312e6a7067),
(5, 'Hamsters', 0x68616d73746572312e6a7067),
(12, 'Tortoise', 0x74312e6a7067),
(20, 'Fishes', 0x6b6f692e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonials`
--

CREATE TABLE `tbltestimonials` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `testify` varchar(255) NOT NULL,
  `ratings` varchar(255) DEFAULT NULL,
  `testified_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `a_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltestimonials`
--

INSERT INTO `tbltestimonials` (`t_id`, `t_name`, `testify`, `ratings`, `testified_date`, `status`, `a_id`) VALUES
(2, 'Adoption Process', 'I appreciate the work that PAWS is doing for those wonderful animals that need a home. I recommend PAWS to everyone that is searching for a pet.', 'High Appreciation', '2023-07-24', 1, 11),
(3, 'PAWS services', 'I really appreciate the work that PAWS is doing and all the services that he provided ', 'High Appreciation', '2023-07-31', 0, 9),
(5, 'PAWS services', 'Great service thank you for helping pets', 'High Appreciation', '2023-08-01', 1, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paws_admin`
--
ALTER TABLE `paws_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_pet_id` (`pet_id`),
  ADD KEY `fk_d_id` (`d_id`),
  ADD KEY `fk_a_id` (`a_id`);

--
-- Indexes for table `tbladopter`
--
ALTER TABLE `tbladopter`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `fk_location_id` (`location_id`);

--
-- Indexes for table `tbladoption`
--
ALTER TABLE `tbladoption`
  ADD PRIMARY KEY (`adopt_id`),
  ADD KEY `fk_adopter_a_id` (`a_id`),
  ADD KEY `fk_p_id` (`pet_id`);

--
-- Indexes for table `tbladvert`
--
ALTER TABLE `tbladvert`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `fk_org_id` (`org_id`);

--
-- Indexes for table `tbldonator`
--
ALTER TABLE `tbldonator`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `fk_loc_id` (`location_id`);

--
-- Indexes for table `tblequipments`
--
ALTER TABLE `tblequipments`
  ADD PRIMARY KEY (`equip_id`),
  ADD KEY `fk_donator_id` (`d_id`);

--
-- Indexes for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `fk_donate_id` (`d_id`);

--
-- Indexes for table `tblorganisation`
--
ALTER TABLE `tblorganisation`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `tblpet`
--
ALTER TABLE `tblpet`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `fk_species_id` (`species_id`),
  ADD KEY `fk_donator_d_id` (`d_id`);

--
-- Indexes for table `tblpet_type`
--
ALTER TABLE `tblpet_type`
  ADD PRIMARY KEY (`species_id`);

--
-- Indexes for table `tbltestimonials`
--
ALTER TABLE `tbltestimonials`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `fk_a_a_id` (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paws_admin`
--
ALTER TABLE `paws_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbladopter`
--
ALTER TABLE `tbladopter`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbladoption`
--
ALTER TABLE `tbladoption`
  MODIFY `adopt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbladvert`
--
ALTER TABLE `tbladvert`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbldonator`
--
ALTER TABLE `tbldonator`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tblequipments`
--
ALTER TABLE `tblequipments`
  MODIFY `equip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbllocation`
--
ALTER TABLE `tbllocation`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblorganisation`
--
ALTER TABLE `tblorganisation`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblpet`
--
ALTER TABLE `tblpet`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblpet_type`
--
ALTER TABLE `tblpet_type`
  MODIFY `species_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbltestimonials`
--
ALTER TABLE `tbltestimonials`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paws_admin`
--
ALTER TABLE `paws_admin`
  ADD CONSTRAINT `fk_a_id` FOREIGN KEY (`a_id`) REFERENCES `tbladopter` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_d_id` FOREIGN KEY (`d_id`) REFERENCES `tbldonator` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pet_id` FOREIGN KEY (`pet_id`) REFERENCES `tblpet` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbladopter`
--
ALTER TABLE `tbladopter`
  ADD CONSTRAINT `fk_location_id` FOREIGN KEY (`location_id`) REFERENCES `tbllocation` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbladoption`
--
ALTER TABLE `tbladoption`
  ADD CONSTRAINT `fk_adopter_a_id` FOREIGN KEY (`a_id`) REFERENCES `tbladopter` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`pet_id`) REFERENCES `tblpet` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbladvert`
--
ALTER TABLE `tbladvert`
  ADD CONSTRAINT `fk_org_id` FOREIGN KEY (`org_id`) REFERENCES `tblorganisation` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldonator`
--
ALTER TABLE `tbldonator`
  ADD CONSTRAINT `fk_loc_id` FOREIGN KEY (`location_id`) REFERENCES `tbllocation` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblequipments`
--
ALTER TABLE `tblequipments`
  ADD CONSTRAINT `fk_donator_id` FOREIGN KEY (`d_id`) REFERENCES `tbldonator` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD CONSTRAINT `fk_donate_id` FOREIGN KEY (`d_id`) REFERENCES `tbldonator` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblpet`
--
ALTER TABLE `tblpet`
  ADD CONSTRAINT `fk_donator_d_id` FOREIGN KEY (`d_id`) REFERENCES `tbldonator` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_species_id` FOREIGN KEY (`species_id`) REFERENCES `tblpet_type` (`species_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltestimonials`
--
ALTER TABLE `tbltestimonials`
  ADD CONSTRAINT `fk_a_a_id` FOREIGN KEY (`a_id`) REFERENCES `tbladopter` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
