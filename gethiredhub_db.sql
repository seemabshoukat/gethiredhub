-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 10:57 AM
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
-- Database: `gethiredhub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `district_id`, `city_name`) VALUES
(1, 1, 'Mirpur Azad Kashmir'),
(2, 1, 'Bhimber'),
(3, 1, 'Kotli'),
(4, 1, 'Chakswari');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `office_contact` varchar(255) NOT NULL,
  `owner_contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `web_address` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `username`, `password`, `company_name`, `owner_name`, `office_contact`, `owner_contact`, `email`, `web_address`, `address`, `logo`, `status`, `created`) VALUES
(1, 'umernaseer', '123', 'Code Creatives', 'Umer Rajput', '03415304550', '03415304550', 'umernaseer10@gmail.com', 'https://www.codecreatives.net/', 'House 18 Street 12 Sector B4', 'meat-products-flat-linear-long-shadow-icon-grocery-store-bbq-items-chicken-leg-beef-steak-and-sausage-line-symbol-vector.jpg', 'active', '2023-06-21 07:21:09'),
(3, 'afortech', '123', 'AFORTECH', 'Ali Ahmed', '03415304551', '03415304551', 'info@a4tech.com', 'https://www.a4tech.com/', 'House 12 Street 11 Sector B3', 'abstract-geometric-logo-or-infinity-line-logo-for-your-company-free-vector.jpg', 'active', '2023-06-22 06:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Umer Rajput', 'umer@mailinator.com', '03415304550', 'This is a dummy text message', '2023-06-22 09:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(1, 'Pakistan'),
(2, 'India'),
(3, 'United Kingdom'),
(4, 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `country_id`, `district_name`) VALUES
(1, 1, 'Azad Jammu and Kashmir'),
(2, 1, 'Balochistan'),
(3, 1, 'Gilgit-Baltistan'),
(4, 1, 'Islamabad Capital Territory'),
(5, 1, 'Khyber Pakhtunkhwa'),
(6, 1, 'Punjab'),
(7, 1, 'Sindh');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `edu_id` int(11) NOT NULL,
  `education_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`edu_id`, `education_title`) VALUES
(1, 'Software Engineer'),
(2, 'Mechanical Engineer'),
(3, 'Computer System Engineer'),
(4, 'Electrical Engineer'),
(5, 'Masters in Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `education_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `end_date` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `company_id`, `city_id`, `education_id`, `job_title`, `description`, `type`, `end_date`, `created_at`) VALUES
(1, 1, 1, 1, 'Senior PHP Developer', 'Candidate must have hands on practice in PHP.', 'Full Time', '2023-06-30', '2023-06-21'),
(3, 3, 2, 2, 'Senior PHP Developer', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'Part Time', '2023-06-29', '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

CREATE TABLE `jobseekers` (
  `js_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`js_id`, `username`, `password`, `email`, `first_name`, `last_name`, `contact`, `picture`, `address`, `status`, `created`) VALUES
(1, 'umer', '123', 'umer@mailinator.com', 'Umer', 'Rajput', '03415304550', 'istockphoto-1357287362-612x612 (2).jpg', 'House 18 Street 12 Sector B4', 'active', '2023-06-21 07:22:45'),
(4, 'ali', '123', 'ali@mailinator.com', 'Ali', 'Khan', '03415304550', 'abstract-geometric-logo-or-infinity-line-logo-for-your-company-free-vector.jpg', 'House 12 Street 11 Sector B3', 'active', '2023-06-22 06:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_applied`
--

CREATE TABLE `jobs_applied` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `applied_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs_applied`
--

INSERT INTO `jobs_applied` (`id`, `job_id`, `seeker_id`, `applied_at`) VALUES
(1, 1, 1, '2023-06-21'),
(2, 1, 1, '2023-06-21'),
(5, 3, 1, '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `job_skills`
--

CREATE TABLE `job_skills` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_skills`
--

INSERT INTO `job_skills` (`id`, `job_id`, `skill_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3),
(7, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `js_id` int(255) NOT NULL,
  `transmitter` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `company_id`, `js_id`, `transmitter`, `message`, `status`, `created_at`) VALUES
(1, 3, 1, 'Seeker', 'Hi', 'Delivered', '2023-08-19 10:02:22'),
(2, 3, 1, 'Company', 'Yes', 'Delivered', '2023-08-19 10:07:36'),
(7, 3, 1, 'Seeker', 'asdf', 'Delivered', '2023-08-21 12:15:52'),
(8, 3, 1, 'Seeker', 'aaaa', 'Delivered', '2023-08-21 12:17:15'),
(9, 3, 1, 'Seeker', 'i have some questions', 'Delivered', '2023-08-21 12:26:25'),
(10, 3, 1, 'Company', 'yes please ask', 'Delivered', '2023-08-22 08:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_education`
--

CREATE TABLE `seeker_education` (
  `id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `education` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seeker_education`
--

INSERT INTO `seeker_education` (`id`, `seeker_id`, `education`) VALUES
(1, 1, 'Software Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_experiences`
--

CREATE TABLE `seeker_experiences` (
  `id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `dfrom` varchar(255) NOT NULL,
  `dto` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seeker_experiences`
--

INSERT INTO `seeker_experiences` (`id`, `seeker_id`, `city_id`, `job_title`, `company_name`, `dfrom`, `dto`, `description`) VALUES
(1, 1, 1, 'Senior PHP Developer', 'Digital Bytes', 'January 2019', 'February 2019', 'lorem ipsum dolar'),
(2, 1, 3, 'Senior Laravel Developer', 'IR Solutions', 'March 2021', 'July 2023', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_skills`
--

CREATE TABLE `seeker_skills` (
  `ss_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seeker_skills`
--

INSERT INTO `seeker_skills` (`ss_id`, `seeker_id`, `skill_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(7, 1, 7),
(8, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_name`) VALUES
(1, 'PHP'),
(2, 'HTML'),
(3, 'CSS'),
(4, 'jQuery'),
(5, 'JAVASCRIPT'),
(6, 'Bootstrap'),
(7, 'Laravel'),
(8, 'Codeigniter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`edu_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `education_id` (`education_id`);

--
-- Indexes for table `jobseekers`
--
ALTER TABLE `jobseekers`
  ADD PRIMARY KEY (`js_id`);

--
-- Indexes for table `jobs_applied`
--
ALTER TABLE `jobs_applied`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `seeker_id` (`seeker_id`);

--
-- Indexes for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobid` (`job_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `seeker_id` (`js_id`);

--
-- Indexes for table `seeker_education`
--
ALTER TABLE `seeker_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seeker_id` (`seeker_id`);

--
-- Indexes for table `seeker_experiences`
--
ALTER TABLE `seeker_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seeker_id` (`seeker_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `seeker_skills`
--
ALTER TABLE `seeker_skills`
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `seeker_id` (`seeker_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `js_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs_applied`
--
ALTER TABLE `jobs_applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_skills`
--
ALTER TABLE `job_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seeker_education`
--
ALTER TABLE `seeker_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seeker_experiences`
--
ALTER TABLE `seeker_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seeker_skills`
--
ALTER TABLE `seeker_skills`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
