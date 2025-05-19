-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 12:15 PM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `id`) VALUES
('admin@info.com', 'admin@login', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(6, 'dhanalaxmi', 'dhana@gmail.com', 'how can i apply for internships', '2025-03-05 14:28:50'),
(7, 'lalitha sheti', 'lalitha@gmail.com', 'IS there any internship for more than 6 months', '2025-03-09 17:05:42'),
(8, 'jonny', 'jonny@gmail.com', 'I am going to college so what about the timing', '2025-03-17 20:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `internshipDescription` text DEFAULT NULL,
  `stipend` varchar(255) DEFAULT NULL,
  `applyBy` date DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `perks` varchar(255) DEFAULT NULL,
  `internshipduration` varchar(50) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `companyDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `name`, `company`, `location`, `duration`, `internshipDescription`, `stipend`, `applyBy`, `skills`, `perks`, `internshipduration`, `companyName`, `companyDescription`) VALUES
(22, 'data entry', 'Hopdays', 'Remote', '3 months', 'Generate Content using AI. \nInput and update product information on WordPress.\nEnsure data accuracy and consistency. \nConduct research to support.', '3333', '2025-06-27', 'WordPress, English Proficiency(spoken, written)', 'Ceritficate, Flexible working hours, Job offer', '3 months', 'Hopdays', 'Hopdays is a new-age travel info media platform. We use the power of AI to help customers plan the best possible vacation.'),
(23, 'Web Development', 'Cloud Quest', 'work from home', '3 months', 'Enhance and customize the website. \nAdd new features as per requirements.\nResearch and suggest system improvements.\nWork with team to develop solution', 'Rs.5000- Rs.7000', '2025-07-16', 'html, css, javascrript, SEO', 'Certification upon successful completion. Internship duration of 3 months, Hands on experience in real world projects. \r\nOutstanding interns may receive gift vouchers.', '3 months', 'Cloud Quest', 'Cloud Quest specializes in innovative cloud solutions. We help businesses grow with seamless integration and advanced technologies.'),
(24, 'Software Developer', 'Cloud Quest', 'Work From Home', '2 months', 'Transform your passion for coding into real-world solutions. \nWork on cutting-edge projects.\nGain hands on experience in software Developer\nWork with the team to develop solution.', 'not disclosed', '2025-05-30', 'python, Data Structure, AWS, DevOps', 'Duration of 2 months, Unpaid internship, Upon successful completion certificates are provided., Exceptional performance may be offered job position.', '2 months', 'Cloud Quest', 'Specializes in innovative cloud solutions. We help business grow with seamless integration and advanced technologies. \nOur internship program offer hands-on experience in various fields. We aim to foster talent and support growth.'),
(25, 'Sales And Marketing', 'Cloud Quest', 'Work From Home', '6 months', 'Learn the art of driving growth and engaging customers.\nDevelope strategies and measure results.\nCollobrate to generate leads, nurture potential customers.', 'not disclosed', '2025-06-05', 'SEO, CRM, Data analysis', 'Certificates upon successful completion, Hands on expeerience in real world projects, Outstanding interns may recieve gift vouchers.', '6 months', 'Cloud Quest', 'Specializes in innovative cloud solutions. We help business grow with seamless integration and advanced technologies. \nour internship program offers hands on experience in various fields. We aim to foster talent and support career growth.'),
(26, 'Artificial Intelligence', 'Qurtle Innovations', 'Work From Home', '2 months', 'Working on cutting-edge projects. Develope machine learning models. Work Closely with our AI research and development team.', '4000-6000', '2025-05-30', 'AI, Problem Solving, Python', 'Certificates upon successful completion, Hands on experience working on impactful AI projects, Mentorship from industry experts in AI', '2 months', 'Qurtle Innovation', 'We stay ahead of these trends to empower our clients with the knowledge and tools to thrive. AI will move deeper into business process, automating complex tasks, optimizing operation, and enhancing decision making with data-driven insights.'),
(27, 'Web Development', 'Acmegrade', 'Work From Home', '3 months', 'Create visually appealing websites. \nManage access points for users. \nWork with backend developers to ensure user interface are in sync with API.', '50000-7000', '2025-05-15', 'node.js, mongodb, Cloud Computing', 'Certification upon successful completion , Mentorship from industrial experts in web development, Hands-on experience, Job offer for the Excellent performer', '3 months', 'Acmegrade', 'We offer training and education to students in India and abroad.\n Our mission is to help young people learn, upskill and enter the workforce with the skills they need to be successful.\nWe have a global presence, impacting lives in over 15 countries. We have turned over a half a lakh learners into professionals.\n Our headquaters are located at Hustlehub techpark, Bengaluru North, Karnataka, IN.'),
(28, 'Artificial Intelligence', 'Qurtle Innovations', 'Work From Home', '6 months', 'Assist in developing and fine-tuning generative AI models.\nIntegration and deployment of AI models on cloud servers.\nTest and validate the efficiency of different models and tools.', '20000-24000', '2025-05-31', 'Python, AWS, FastAPI, Docker', 'Certificate, Letter of recommendation, Job offer', '6 months', 'Qurtle Innovations', 'We stay ahead of these trends to empower our clients with the knowledge and tools to thrive. AI will move deeper into business processes, automating complex tasks, optimizing operations, and enhancing decision making with data-driven insights. We understand that achieving this level of growth requires insights, strategic planning, and an adaptable roadmap.'),
(29, 'Software Developer', 'CYPWNG', 'Work From Home', '6 months', 'Experience in java by writing, testing and debugging code using spring boot.\nIdentify and resolve issues in the code and ensure optimal performance.  Collaborate with senior developers, document technical processes.\nWork on frontend-and backend development', '20000-23000', '2025-05-16', 'java, mongodb, spring boot', 'Certification upon successful completion. ,  Hands-on experience working in java. , Mentorship from industry experts', '6 months', 'CYPWNG', 'Software Technologies </strong> a product-based company, specializes in AI-based. software solutions, including web design, cloud service, and transformative training programs. Explore our service, discover growth opportunities, and let\'s build a smarter future together.'),
(30, 'Digital Marketing', 'Cloud Quest', 'Work From Home', '3 months', 'Manage Social Media Marketing. Conduct cold calling and send emails. Maintain database and Learn SEO,SEM, Email Marketing to drive brand awareness.', '5000', '2025-05-12', 'Email Marketing, English Proficiency (Spoken and Written), Creative Writing , Facebook Marketing', 'Certificates upon successful completion, Hands on expeerience in real world projects, Outstanding interns may recieve gift vouchers.', '3 months', 'Cloud Quest', 'The mission is to be a one stop source for all content management services which have strong consumer impact and high creative value. The suit of service includes voiceovers, dubbing, radio-content, script/content generation in all languages.'),
(31, 'data entry', 'CYPWNG', 'Work From Home', '2 months', 'Perform accurate data entry tasks using MS-excel.\nOrganize and maintain databases.\nConduct research and gather information. \nCommunicate effectively through written.', '2000-3000', '2025-05-23', 'MS-Excel, English Proficiency (Spoken)', 'Certificate, Letter of recommendation', '2 months', 'CYPWNG', 'Software Technologies a product-based company, specializes in AI-based. software solutions, including web design, cloud service, and transformative training programs. Explore our service, discover growth opportunities, and let\'s build a smarter future together.'),
(32, 'Business Development', 'Cloud Quest', 'Work From Home', '6 months', 'Maintain accurate records of leads and conversions. \nConnect with potential clients via emails, calls, and whatsapps. Present out products and services to client needs', 'not disclosed', '2025-04-30', 'MS-Excel, English Proficiency, Email Marketing, Negotiation', 'Certificate, Letter of recommendation, Flexible work hours', '6 months', 'Cloud Quest', 'Specializes in innovative cloud solutions. We help business grow with seamless integration and advanced technologies. our internship program offers hands on experience in various fields. We aim to foster talent and support career growth.'),
(33, 'Data Science', 'Medius Technologies', 'Work From Home', '6 months', 'Manage and optimize day-to-day business functions, ensuring seamless execution through data-backend decision-making. \nCollaborate with executive teams to align operational prioritites with organizational goals', 'Rs. 10000 monthly', '2025-04-30', 'Advanced Excel, Negogation, Problem solving, Communication', 'Certificate , letter of recommendation, job offer', '6 months', 'Medius Technologies', 'We are an IT company based in Mumbai. We are a debt management and collection platform for banks and NBFCs');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `image` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `contact` int(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `linkedIn` varchar(20) NOT NULL,
  `objective` varchar(50) NOT NULL,
  `tskills` varchar(50) NOT NULL,
  `sskills` varchar(50) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `education` varchar(50) NOT NULL,
  `projects` varchar(50) NOT NULL,
  `certificate` varchar(50) NOT NULL,
  `hobbies` varchar(50) NOT NULL,
  `languages` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`image`, `fullname`, `contact`, `email`, `linkedIn`, `objective`, `tskills`, `sskills`, `experience`, `education`, `projects`, `certificate`, `hobbies`, `languages`) VALUES
('uploads/67db02120889b5.63341655.png', '', 0, '', '', '', '', '', '', '', '', '', '', ''),
('', 'Arpita Morya ', 2147483647, 'arpita@gmail.com', 'https://arpita@gmail', '  ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '),
('uploads/67c8621c191790.51816791.png', 'harikrishnan', 1236547892, 'hari@gmail.com', '', '  ', '', '', '', '', '', '', '', ''),
('', 'lalitha sheti', 2147483647, 'lalitha@gmail.com', 'https://lalitha', ' ', 'html, css, MS Excel, MS word', 'Quick Learner, Communication', 'Fresher', 'SIES college\r\nstudying 12th\r\n88%', '', '', 'Playing tennis', ''),
('', 'mahika ', 0, 'mahika@gmail.com', '', ' ', '', '', '', '', '', '', '', ''),
('', 'mukkta Avinash Hingane', 1365478566, 'mukkta@gmail.com', '', ' Skilled in Web development. Currently pursuing my', 'html,css', 'Quick learner', 'Fresher', 'D.G.ruparel college\r\n9.6 cgpa', 'Tykwondo academy', 'In Web development', 'playing carrom, sports', 'marathi, english'),
('', 'Muthumari Nadar', 2147483647, 'Muthu17@gmail.com', 'https://muthumari', '  I am pursuing my third year in BSC IT degree and', ' html,css, java', 'communication, Quick Learner', ' Fresher', ' D.g ruparel college\r\nBSC IT\r\n9.6 cgpa', 'Internship management website', 'Web development Certificate. Guided by sandip gavi', 'Listining music, Drawing', 'hindi, marathi, tamil, english'),
('', 'riddesh ', 123654785, 'riddesh@gmail.com', '', ' ', '', '', '', '', '', '', '', ''),
('', 'riya narad', 1587456, 'riya@gmail.com', '', ' ', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_scores`
--

INSERT INTO `quiz_scores` (`id`, `email`, `test_name`, `score`, `total_questions`, `created_at`, `data_type`) VALUES
(30, 'arpita@gmail.com', 'Aptitude', 3, 5, '2025-03-10 19:42:32', 'Data Structure'),
(44, 'hari@gmail.com', 'Aptitude', 3, 5, '2025-03-11 02:45:22', 'Data Structure'),
(45, 'hari@gmail.com', 'Aptitude', 2, 5, '2025-03-11 02:45:44', 'Logical Reasoning'),
(46, 'hari@gmail.com', 'Verbal', 3, 5, '2025-03-11 03:39:12', 'Antonyms'),
(47, 'hari@gmail.com', 'Verbal', 1, 5, '2025-03-11 03:39:36', 'Selecting Words'),
(48, 'hari@gmail.com', 'Verbal Reasoning', 1, 5, '2025-03-11 03:40:01', 'Series Completion'),
(49, 'hari@gmail.com', 'Verbal Reasoning', 3, 5, '2025-03-11 03:41:12', 'Analogy'),
(50, 'hari@gmail.com', 'Verbal Reasoning', 2, 5, '2025-03-11 03:41:34', 'Verification of Truth'),
(51, 'hari@gmail.com', 'Verbal', 1, 5, '2025-03-11 03:43:31', 'Synonyms'),
(52, 'riddesh@gmail.com', 'Aptitude', 4, 5, '2025-03-11 07:21:01', 'Logical Reasoning'),
(53, 'riddesh@gmail.com', 'Verbal', 1, 5, '2025-03-11 07:24:48', 'Synonyms'),
(54, 'riddesh@gmail.com', 'Verbal', 1, 5, '2025-03-11 07:29:33', 'Synonyms'),
(55, 'riya@gmail.com', 'Aptitude', 1, 5, '2025-03-11 12:17:40', 'Logical Reasoning'),
(56, 'riya@gmail.com', 'Aptitude', 1, 5, '2025-03-13 02:20:13', 'Time Distance'),
(57, 'riya@gmail.com', 'General Knowledge', 2, 5, '2025-03-13 02:23:15', 'Basic GK'),
(58, 'riya@gmail.com', 'Verbal Reasoning', 1, 5, '2025-03-13 02:23:53', 'Series Completion'),
(59, 'riya@gmail.com', 'Verbal Reasoning', 1, 5, '2025-03-13 02:26:11', 'Verification of Truth'),
(60, 'riya@gmail.com', 'Aptitude', 3, 5, '2025-03-13 02:26:33', 'Data Structure'),
(61, 'riya@gmail.com', 'Verbal', 1, 5, '2025-03-13 02:26:49', 'Synonyms'),
(62, 'riya@gmail.com', 'Verbal', 3, 5, '2025-03-13 02:27:10', 'Antonyms'),
(63, 'riya@gmail.com', 'Verbal', 2, 5, '2025-03-13 02:27:30', 'Selecting Words'),
(64, 'riya@gmail.com', 'Aptitude', 2, 5, '2025-03-13 02:44:12', 'Simple Interest'),
(65, 'riya@gmail.com', 'Verbal Reasoning', 2, 5, '2025-03-17 20:11:47', 'Analogy'),
(66, 'mukkta@gmail.com', 'Verbal', 1, 5, '2025-03-19 17:45:06', 'Synonyms');

-- --------------------------------------------------------

--
-- Table structure for table `resubmit`
--

CREATE TABLE `resubmit` (
  `company` varchar(20) NOT NULL,
  `internship` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resubmit`
--

INSERT INTO `resubmit` (`company`, `internship`, `fullname`, `email`, `file`, `id`) VALUES
('Cloud Quest', 'Web Development', 'muthumari', 'mu@gmail.com', 'resume (40) (1).pdf', 7),
('Cloud Quest', 'Business Development', 'lalitha sheti', 'lalitha@gmail.com', 'lalitha.pdf', 8),
('Cloud Quest', 'Business Development', 'harikrishnan', 'hari@gmail.com', 'resume (45).pdf', 10),
('Medius Technologies', 'Data Science', 'lalitha sheti', 'lalitha@gmail.com', 'lalitha.pdf', 26),
('Medius Technologies', 'Data Science', 'harikrishnan', 'hari@gmail.com', 'resume (45).pdf', 28),
('Cloud Quest', 'Business Development', 'lalitha sheti', 'lalitha@gmail.com', 'lalitha.pdf', 30),
('Qurtle Innovation', 'Artificial Intellige', 'harikrishnan', 'hari@gmail.com', 'resume (45).pdf', 37),
('Medius Technologies', 'Data Science', 'mukkta Avinash', 'mukkta@gmail.com', 'resume (48).pdf', 38);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `email`, `password`, `firstName`) VALUES
(4, 'arpita@gmail.com', 'arpita', 'arpita'),
(9, 'hari@gmail.com', 'hari', 'hari'),
(27, 'saravana@gmail.com', 'saravana@40', 'saravana'),
(28, 'neelaay@gmail.com', 'neelaay@40', 'neelaay'),
(29, 'mahika@gmail.com', 'mahika@40', 'mahika'),
(30, 'muthu17@gmail.com', 'muthu@40', 'Muthumari'),
(31, 'John22@gmail.com', 'john12345', 'John Joseph'),
(32, 'lalitha@gmail.com', 'lalitha123', 'lalitha sheti'),
(33, 'riddesh@gmail.com', 'riddesh123', 'riddesh'),
(34, 'riya@gmail.com', 'riyanarad', 'riya'),
(35, 'mukkta@gmail.com', 'mukkta123', 'mukkta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resubmit`
--
ALTER TABLE `resubmit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fullname` (`fullname`,`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `resubmit`
--
ALTER TABLE `resubmit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
