-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 04:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `durga`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(7, 'Pallavi', 'pallavi@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `sdrn_no` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `book_type` enum('authored','edited') NOT NULL,
  `indexing` enum('scopus','sci') NOT NULL,
  `issn_no` varchar(20) DEFAULT NULL,
  `pub_date` date NOT NULL,
  `weblink` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `sdrn_no`, `topic`, `author`, `publisher`, `book_type`, `indexing`, `issn_no`, `pub_date`, `weblink`, `department`, `file`) VALUES
(40, 1, 'Deep jyoti', 'Rohit mishra', 'Revenant', 'edited', 'sci', '112233', '2023-10-01', 'https://www.youtube.com/', 'Electronics & Telecommunication Engineering', '1_Deep jyoti_Book_10_2023.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `book_chapters`
--

CREATE TABLE `book_chapters` (
  `id` int(11) NOT NULL,
  `sdrn_no` varchar(50) DEFAULT NULL,
  `chapter_name` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `book` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `doi` varchar(255) NOT NULL,
  `pub_date` varchar(255) NOT NULL,
  `Indexing` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_chapters`
--

INSERT INTO `book_chapters` (`id`, `sdrn_no`, `chapter_name`, `author`, `book`, `publisher`, `isbn`, `doi`, `pub_date`, `Indexing`, `department`, `file`) VALUES
(30, '1', 'Security Aspects in Cloud Computing', 'Tabassum M', 'Advancing Cloud Database Systems and Capacity Planning With Dynamic Applications', 'IGI Global Publication', '334-889', '10.4018/978-1- 5225-2013- 9.ch013', '2017-01-21', 'Scopus', 'Computer Engineering', '1_Security Aspects in Cloud Computing_BookChapter_01_2017.pdf'),
(31, '2', 'GPU Computing of special mathematical functions used in fractional calculus', 'Mr. Chaitanya Jage', 'GPU Computing of special mathematical functions used in fractional calculus', 'Bentham Science Publishers', '978-1- 68108-600-2', '264334.8999', '2016-10-22', 'Scopus', 'Electronics Engineering', '2_GPU Computing of special mathematical functions used in fractional calculus_BookChapter_10_2016.pdf'),
(32, '4', 'Applied Mathematics-I', 'Vijay Patil', 'Applied Mathematics-I', 'Tech-Max Publication', '978-93-5224- 282-5', '232.42.42.42', '2016-07-22', 'Scopus', 'Electronics Engineering', '4_Applied Mathematics-I_BookChapter_07_2016.pdf'),
(33, '5', 'Applied Mathematics-2', ' Dr. Narendrakumar Dasre ', 'Applied Mathematics-2', 'Tech-Max Publication', '978-93-5224- 446-1', '264334.8999', '2017-07-22', 'Scopus', 'Artificial Intelligence & Data Science', '5_Applied Mathematics-2_BookChapter_07_2017.'),
(34, '6', 'Applied PhysicsI (R-2016)', 'Swati Bawra', 'Applied PhysicsI (R-2016)', 'P.Jamnadas LLP', '978-81-940267- 2-3', '442.2424.1.41', '2017-08-22', 'Scopus', 'Electrical & Instrumentation Engineering', '6_Applied PhysicsI (R-2016)_BookChapter_08_2017.pdf'),
(35, '7', 'Applied Chemistry-I', 'Mr. S. M. Patil', 'Applied Chemistry-I', 'Synergy Knowledgeware', '978-93- 833-5244-9', '990.887.889', '2016-08-22', 'Scopus', 'Artificial Intelligence & Data Science', '7_Applied Chemistry-I_BookChapter_08_2016.pdf'),
(36, '8', 'Engineering Mechanics', 'Mr. Sanjay Talokar', 'Engineering Mechanics', 'Tech-Max Publication', '334-889', '778.998.009', '2017-08-22', 'Scopus', 'Instrumentation Engineering', '8_Engineering Mechanics_BookChapter_08_2017.pdf'),
(37, '9', 'Engineering Mechanics', 'Mr. Ravindra C Gode', 'Engineering Mechanics', 'Tech-Max Publication', '334-889', '990.887.889', '2017-08-22', 'Scopus', 'Computer Engineering', '9_Engineering Mechanics_BookChapter_08_2017.pdf'),
(38, '10', 'Communication Skills Sem II', 'Dr. Arpita Palchoudhury', 'Communication Skills Sem II', 'Tech-Max Publication', '978-93- 5224-282-5', '123.323.44.2', '2016-10-22', 'Scopus', 'Electronics Engineering', '10_Communication Skills Sem II_BookChapter_10_2016.pdf'),
(40, '11', 'Multilayer Visual Cryptography with Soft Computing Approach for Authentication, in Information and Communication Technology for Competitive Strategies', 'Pallavi Chavan', 'Multilayer Visual Cryptography with Soft Computing Approach for Authentication, in Information and Communication Technology for Competitive Strategies', 'Springer', '978-981- 13-0586-3', '', '2019-06-09', 'scopus', 'Information Technology', '11_Multilayer Visual Cryptography with Soft Computing Approach for Authentication, in Information and Communication Technology for Competitive Strategies_BookChapter_06_2019.'),
(41, '13', 'Public Auditing for Shared Data in Cloud Storage with an Effective User Dismissal, Computing, Communication and Signal Processing', 'Nilima Dongre', 'Public Auditing for Shared Data in Cloud Storage with an Effective User Dismissal, Computing, Communication and Signal Processing', 'Springer', '978-981- 13-1512-1', '', '2018-07-09', 'scopus', 'Information Technology', '13_Public Auditing for Shared Data in Cloud Storage with an Effective User Dismissal, Computing, Communication and Signal Processing_BookChapter_07_2018.'),
(42, '14', 'Fuzzy with Neuro-Fuzzy Approach to self tune database system', 'Kriti Karanam', 'Fuzzy with Neuro-Fuzzy Approach to self tune database system', 'LAP LAMBERT Academic Publishing', '6202028947', '', '2017-07-09', 'scopus', 'Computer Engineering', '14_Fuzzy with Neuro-Fuzzy Approach to self tune database system_BookChapter_07_2017.'),
(43, '323', 'Data Summarization using modified fuzzy clustering algorithm,Semantic feature and Data Compression ', 'Shilpa Kolte', 'Applied Machine Learning for Smart Data Analysis', 'CRC press', '9780429440953', '', '2019-05-09', 'scopus', 'Computer Engineering', '323_Data Summarization using modified fuzzy clustering algorithm,Semantic feature and Data Compression _BookChapter_05_2019.'),
(44, '15', 'TCSC control by intelligent control methods', 'Dr. Sheila Mahapatra', 'TCSC control by intelligent control methods', 'Lambart Academic publishing , UK', '', '', '2018-05-16', 'scopus', 'Electronics Engineering', '15_TCSC control by intelligent control methods_BookChapter_05_2018.'),
(45, '16', 'Spectral Phase  Encoding System for Fiber Optic CDMA networks', 'Dr. Savita Bhosale', 'Spectral Phase Encoding System for Fiber Optic CDMA networks', 'Lambart Academic publishing , UK', '', '', '2018-05-15', 'scopus', 'Electronics Engineering', '16_Spectral Phase  Encoding System for Fiber Optic CDMA networks_BookChapter_05_2018.'),
(46, '17', 'Design and Comparison of Electromagneticall y coupled patch antenna array at 30 GHz ', 'Ms. Sujata Mengudale', 'Design and Comparison of Electromagneticall y coupled patch antenna array at 30 GHz ', 'Springer', '', '', '2017-12-09', 'scopus', 'Electronics Engineering', '17_Design and Comparison of Electromagneticall y coupled patch antenna array at 30 GHz _BookChapter_12_2017.'),
(47, '504', 'GPU computing of fractional- order derivative integral and differential equations.', 'Dr.Mukesh D. Patil', 'GPU computing of fractional- order derivative integral and differential equations.', 'Lambart Academic publishing , UK', '978-620-2- 01954-5', '', '2017-07-09', 'scopus', 'Electronics Engineering', '504_GPU computing of fractional- order derivative integral and differential equations._BookChapter_07_2017.'),
(48, '502', 'GPU Computing of Special Mathematical Functions used in Fractional Calculus', 'Vishwesh A. Vyawahare', 'GPU Computing of Special Mathematical Functions used in Fractional Calculus', 'Frontiers in Fractional Calculus, Pages 199-232, Volume-I, Springer', '2589-2711', '', '2018-03-19', 'scopus', 'Electronics & Telecommunication Engineering', '502_GPU Computing of Special Mathematical Functions used in Fractional Calculus_BookChapter_03_2018.'),
(49, '18', 'Modelling for Spectral Domain Optical Coherence Tomography (SDOCT) System', 'Choudhari S', 'Modelling for Spectral Domain Optical Coherence Tomography (SDOCT) System', 'Advances in Optical Science and Engineering. Springer Proceedings in Physics, vol 194. Springer, Singapore.', '978-981- 10-3907-2', '', '2017-09-23', 'scopus', 'Electronics & Telecommunication Engineering', '18_Modelling for Spectral Domain Optical Coherence Tomography (SDOCT) System_BookChapter_09_2017.'),
(50, '19', 'High Power Microwave Devices: Modeling and Simulation', 'Ayush Saxena', 'High Power Microwave Devices: Modeling and Simulation', 'Lambart Academic publishing , UK', '978- 3- 659- 85388-3', '', '2017-08-09', 'scopus', 'Electronics & Telecommunication Engineering', '19_High Power Microwave Devices: Modeling and Simulation_BookChapter_08_2017.'),
(51, '20', 'Implementation of Fractionalorder Derivatives, Integrals and ODE using GPU Computing', 'Pooja S. Patil', 'Implementation of Fractionalorder Derivatives, Integrals and ODE using GPU Computing', 'Lambert Academic Publishing, European Union', '978- 620201954 5', '', '2018-01-09', 'scopus', '', '20_Implementation of Fractionalorder Derivatives, Integrals and ODE using GPU Computing_BookChapter_01_2018.'),
(52, '21', 'Environmental Studies', 'Tushar Bhangale', 'Environmental Studies', 'P. Jamnadas LLP.', '97881934573 13', '', '2017-02-09', 'scopus', 'Electrical & Instrumentation Engineering', '21_Environmental Studies_BookChapter_02_2017.'),
(53, '512', 'Introduction to Multistage Document Clustering:Rough Set Approach', 'Dr.Gautam Borkar', 'Introduction to Multistage Document Clustering:Rough Set Approach', 'Lambart Academic publishing ', '978-3- 659- 78039-4 ', '', '2019-06-09', 'scopus', 'Information Technology', '512_Introduction to Multistage Document Clustering:Rough Set Approach_BookChapter_06_2019.'),
(54, '23', 'An Overview of Methodologies and Challenges in Sentiment Analysis on Social Networks, Handbook on Big Data Clustering and Machine Learning', 'Aditya Salunke', 'An Overview of Methodologies and Challenges in Sentiment Analysis on Social Networks, Handbook on Big Data Clustering and Machine Learning', 'IGI Global', '9781799801061 ', '', '2019-01-09', 'scopus', 'Information Technology', '23_An Overview of Methodologies and Challenges in Sentiment Analysis on Social Networks, Handbook on Big Data Clustering and Machine Learning_BookChapter_01_2019.'),
(55, '22', 'Optical Flow based Video Summarization, Series ', 'Dipti Jadhav', 'Optical Flow based Video Summarization, Series ', 'Springer', '', '', '2018-06-09', 'scopus', 'Information Technology', '22_Optical Flow based Video Summarization, Series _BookChapter_06_2018.'),
(56, '24', 'A survey of various cryptographic techniques:From Traditional cryptography to Fully Homomorphic Encryption', 'Rashmi Dhumal', 'Innovations in Computer Science and Engineering', 'Springer', '978-981- 13-7082-3', '', '2019-06-09', 'scopus', 'Computer Engineering', '24_A survey of various cryptographic techniques:From Traditional cryptography to Fully Homomorphic Encryption_BookChapter_06_2019.'),
(57, '25', 'FPGA implementation of Special Functions used in Fractional Calculus', 'Mr.Sangeeth Sadanand,', 'FPGA implementation of Special Functions used in Fractional Calculus', 'Lambart Academic publishing, UK ', '978-620-2-07387-5 ', '', '2019-01-09', 'scopus', 'Electronics Engineering', '25_FPGA implementation of Special Functions used in Fractional Calculus_BookChapter_01_2019.'),
(58, '500', 'Cryptographic and Information Security Approaches for Images and Videos', 'Dr. Gajanan Birajdar', 'Cryptographic and Information Security Approaches for Images and Videos', 'CRC Press, Taylor and Francis Group', '978- 1138563841', '', '2018-12-09', 'scopus', 'Electrical & Instrumentation Engineering', '500_Cryptographic and Information Security Approaches for Images and Videos_BookChapter_12_2018.'),
(59, '26', 'Current Trends in Fractional Calculus and Fractional Differential Equations', 'Mr.Pratik Kadam', 'Current Trends in Fractional Calculus and Fractional Differential Equations', 'Springer Nature Singapore', '978-981-13-9226-9', '', '2018-09-09', 'scopus', 'Electronics Engineering', '26_Current Trends in Fractional Calculus and Fractional Differential Equations_BookChapter_09_2018.'),
(60, '27', 'Fractional Order Systems: Optimization, Control, Circuit Realizations and Applications ', 'Utkal Mehta', 'Fractional Order Systems: Optimization, Control, Circuit Realizations and Applications ', 'Elsevier', '978- 0128161524', '', '2018-08-09', 'scopus', 'Electronics Engineering', '27_Fractional Order Systems: Optimization, Control, Circuit Realizations and Applications _BookChapter_08_2018.'),
(61, '500', 'Secure and Robust ECG Steganography using Fractional Fourier Transform', 'Gajanan K. Birajdar ', 'Secure and Robust ECG Steganography using Fractional Fourier Transform', 'Cryptographic and Information Security Approaches for Images and Videos”, CRC Press, Taylor and Francis Group ', '9780429435461', '', '2018-12-09', 'scopus', 'Electronics & Telecommunication Engineering', '500_Secure and Robust ECG Steganography using Fractional Fourier Transform_BookChapter_12_2018.'),
(62, '5', 'F.Y. B.A. / B.Sc. Calculus-I', 'Dr. Narendrakumar Dasre', 'F.Y. B.A. / B.Sc. Calculus-I', 'Tech-Max publication', '97893507703 13', '', '2017-07-09', 'scopus', 'Information Technology', '5_F.Y. B.A. / B.Sc. Calculus-I_BookChapter_07_2017.'),
(63, '5', 'F.Y. B.A. / B.Sc. Calculus-II', 'Dr. Narendrakumar Dasre', 'F.Y. B.A. / B.Sc. Calculus-II', 'Tech-Max Publication', '97893875237 22', '', '2017-07-09', 'scopus', 'Information Technology', '5_F.Y. B.A. / B.Sc. Calculus-II_BookChapter_07_2017.'),
(64, '6', 'Applied Physics-I (R-2016)', 'Dr.Swati Bawra', 'Applied Physics-I (R-2016)', 'P.Jamnadas LLP', '978-81- 940267-2-3', '', '2017-11-09', 'scopus', 'Information Technology', '6_Applied Physics-I (R-2016)_BookChapter_11_2017.'),
(65, '6', 'Applied Physics-II (R-2016)', 'Dr.Swati Bawra', 'Applied Physics-II (R-2016)', 'P.Jamnadas LLP', '978-81- 936539-1-5', '', '2017-10-09', 'scopus', 'Information Technology', '6_Applied Physics-II (R-2016)_BookChapter_10_2017.'),
(66, '28', 'An Archimedean Spiral shaped Frequency Selective Defected Structure for Narrowband High Q Applications', 'Santanu Das', 'An Archimedean Spiral shaped Frequency Selective Defected Structure for Narrowband High Q Applications', 'Advanced Computing and Communication Technologies, Springer Link', '978-981- 13-0679-2', '', '2018-07-09', 'scopus', 'Electronics & Telecommunication Engineering', '28_An Archimedean Spiral shaped Frequency Selective Defected Structure for Narrowband High Q Applications_BookChapter_07_2018.'),
(67, '29', 'Obstacle detection & location using acoustic technology in time domain', 'Ashwini Naik', 'Obstacle detection & location using acoustic technology in time domain', 'Lambart Academic publishing ', '978- 613-9- 45697-0', '', '2019-03-09', 'scopus', 'Electronics & Telecommunication Engineering', '29_Obstacle detection & location using acoustic technology in time domain_BookChapter_03_2019.'),
(68, '30', 'External Sensing in Cooperative Cognitive Radio', 'Hemlata Patil', 'External Sensing in Cooperative Cognitive Radio', 'Lambert Academic Publishing, Germany', '978-6200228550', '', '2019-06-09', 'scopus', 'Electronics & Telecommunication Engineering', '30_External Sensing in Cooperative Cognitive Radio_BookChapter_06_2019.'),
(69, '31', 'Automated Heart Rate Measurement Using Wavelet Analysis of Face Video Sequences, Lecture Notes in Networks and Systems', 'Jayanand Gawande', 'Automated Heart Rate Measurement Using Wavelet Analysis of Face Video Sequences, Lecture Notes in Networks and Systems', 'Springer', '978-981-10-8204-7 ', '', '2019-11-09', 'scopus', 'Instrumentation Engineering', '31_Automated Heart Rate Measurement Using Wavelet Analysis of Face Video Sequences, Lecture Notes in Networks and Systems_BookChapter_11_2019.'),
(70, '31', 'Heart Sound Signal Analysis and Its Implementation VHDL,Lecture Notes in Networks and Systems', 'Jayanand Gawande', 'Heart Sound Signal Analysis and Its Implementation VHDL,Lecture Notes in Networks and Systems', 'Springer ', '978-981-10-8204-7', '', '2019-12-13', 'scopus', 'Instrumentation Engineering', '31_Heart Sound Signal Analysis and Its Implementation VHDL,Lecture Notes in Networks and Systems_BookChapter_12_2019.'),
(71, '5', 'Applied Mathematics-1', 'Dr. Narendrakumar Dasre', 'Applied Mathematics-1', 'Tech-Max Publication', '9789352242825', '', '2018-07-09', 'scopus', 'Information Technology', '5_Applied Mathematics-1_BookChapter_07_2018.'),
(72, '5', 'Numerical Solution of System of Stratified Boussinesq Equationa', 'Dr. Narendrakumar Dasre', 'Numerical Solution of System of Stratified Boussinesq Equationa', 'Lambert Academic Publication, Germany', '9783659976001', '', '2018-06-09', 'scopus', 'Information Technology', '5_Numerical Solution of System of Stratified Boussinesq Equationa_BookChapter_06_2018.'),
(73, '6', 'Applied Physics 2016)', 'Dr.Swati Bawra', 'Applied Physics 2016)', 'P.Jamnadas LLP', '978-81- 936539-8-2', '', '2019-01-09', 'scopus', 'Information Technology', '6_Applied Physics 2016)_BookChapter_01_2019.'),
(74, '6', 'Applied Physics 2016)', 'Dr.Swati Bawra', 'Applied Physics 2016)', 'P.Jamnadas LLP', '978-81- 936539-0-6', '', '2019-02-09', 'scopus', 'Information Technology', '6_Applied Physics 2016)_BookChapter_02_2019.'),
(75, '32', 'Recent Advances in the Antioxidant Therapies for Alzheimer’s Disease: Emphasis on Natural Antioxidants in Pathology Prevention and Therapeutics of Neurodegenera tive Disease', 'Dr. Namrata Singh ', 'Recent Advances in the Antioxidant Therapies for Alzheimer’s Disease: Emphasis on Natural Antioxidants in Pathology Prevention and Therapeutics of Neurodegenera tive Disease', 'Springer Nature Publications', '', '', '2019-06-09', 'scopus', 'Information Technology', '32_Recent Advances in the Antioxidant Therapies for Alzheimer’s Disease: Emphasis on Natural Antioxidants in Pathology Prevention and Therapeutics of Neurodegenera tive Disease_BookChapter_06_2019.'),
(76, '33', 'Applied Chemistry - I', 'Rupali Agme', 'Applied Chemistry - I', 'Oxford University Press', '0-19-949556-4', '', '2018-07-09', 'scopus', 'Information Technology', '33_Applied Chemistry - I_BookChapter_07_2018.'),
(77, '33', 'Applied Chemistry-2', 'Rupali Agme', 'Applied Chemistry-2', 'Oxford University Press', '0-19-949556-4 ', '', '2019-02-09', 'scopus', 'Information Technology', '33_Applied Chemistry-2_BookChapter_02_2019.'),
(78, '21', 'Environmental Studies', 'Tushar Bhangale', 'Environmental Studies', 'P.Jamnadas LLP', '9788193822401', '', '2019-05-09', 'scopus', 'Information Technology', '21_Environmental Studies_BookChapter_05_2019.'),
(79, '34', 'Applied Chemistry - I', 'Dr.S. D. Shete', 'Applied Chemistry - I', 'Oxford University Press', '0-19-949060-0 ', '', '2019-01-09', 'scopus', 'Information Technology', '34_Applied Chemistry - I_BookChapter_01_2019.'),
(80, '34', 'Applied Chemistry - 2', 'Dr.S. D. Shete', 'Applied Chemistry - 2', 'Oxford University Press', '0-19-949556-4', '', '2018-12-09', 'scopus', 'Information Technology', '34_Applied Chemistry - 2_BookChapter_12_2018.'),
(81, '35', 'Engineering Chemistry-II', 'Mr. S. M. Pati', 'Engineering Chemistry-II', 'Synergy Knowledgeware', '978-93-833-5244-9', '', '2018-11-09', 'scopus', 'Information Technology', '35_Engineering Chemistry-II_BookChapter_11_2018.');

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE `conference` (
  `id` int(11) NOT NULL,
  `sdrn` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `issn` varchar(255) NOT NULL,
  `pub_date` date NOT NULL,
  `doi` varchar(255) NOT NULL,
  `indexing` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `file` blob DEFAULT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`id`, `sdrn`, `topic`, `issn`, `pub_date`, `doi`, `indexing`, `url`, `file`, `department`) VALUES
(26, '5', 'Micromanaging', '33464334333', '2023-05-05', '123.323.44.2', 'sci', 'https://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&arnumber=9672674', 0x355f4d6963726f6d616e6167696e675f436f6e666572656e636550617065725f30355f323032332e706466, 'Instrumentation Engineering'),
(40, '513', 'Rule Based system for enterprise Resource Planning decision', '.', '2022-07-29', '.', 'scopus', 'https://www.google.co.in/', 0x3531335f52756c652042617365642073797374656d20666f7220656e7465727072697365205265736f7572636520506c616e6e696e67206465636973696f6e5f436f6e666572656e636550617065725f30375f323032322e706466, ''),
(41, '513', '(2,2) Visual Cryptography Based Biometric Authentication Mechanism for Online Elections', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3531335f28322c32292056697375616c2043727970746f6772617068792042617365642042696f6d65747269632041757468656e7469636174696f6e204d656368616e69736d20666f72204f6e6c696e6520456c656374696f6e735f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(42, '513', 'Hybrid Ensemble Machine Learning Approach for URL Phishing Detection', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3531335f48796272696420456e73656d626c65204d616368696e65204c6561726e696e6720417070726f61636820666f722055524c205068697368696e6720446574656374696f6e5f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(43, '513', 'Sensitivity Support in Data Privacy Algorithms', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3531335f53656e736974697669747920537570706f727420696e2044617461205072697661637920416c676f726974686d735f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(44, '901', 'Student mentoring management application for Engineering institutes', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3930315f53747564656e74206d656e746f72696e67206d616e6167656d656e74206170706c69636174696f6e20666f7220456e67696e656572696e6720696e73746974757465735f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(45, '514', 'Video Conferencing with Sign Language Detection', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3531345f566964656f20436f6e666572656e63696e672077697468205369676e204c616e677561676520446574656374696f6e5f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(48, '912', 'Weed Plant Detection from Agricultural Field Images using YOLOv3 Algorithm', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3931325f5765656420506c616e7420446574656374696f6e2066726f6d204167726963756c747572616c204669656c6420496d61676573207573696e6720594f4c4f763320416c676f726974686d5f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(49, '903', 'Cost Effective Design of Poratable Glucometer Kit', '.', '2022-07-08', '.', 'scopus', 'https://www.google.co.in/', 0x3930335f436f7374204566666563746976652044657369676e206f6620506f72617461626c6520476c75636f6d65746572204b69745f436f6e666572656e636550617065725f30375f323032322e706466, ''),
(50, '905', 'Analysis of Employee Surveillance System using Deep Learning Models', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f416e616c79736973206f6620456d706c6f796565205375727665696c6c616e63652053797374656d207573696e672044656570204c6561726e696e67204d6f64656c735f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(51, '905', 'An Intelligent Machine-Learning Approach For Monitoring Remote Employees', '.', '2022-04-28', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f416e20496e74656c6c6967656e74204d616368696e652d4c6561726e696e6720417070726f61636820466f72204d6f6e69746f72696e672052656d6f746520456d706c6f796565735f436f6e666572656e636550617065725f30345f323032322e706466, ''),
(52, '905', 'Investigation of switching gate pulse of buck converter using fractional order PID control', '.', '2023-10-09', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f496e7665737469676174696f6e206f6620737769746368696e6720676174652070756c7365206f66206275636b20636f6e766572746572207573696e67206672616374696f6e616c206f726465722050494420636f6e74726f6c5f436f6e666572656e636550617065725f31305f323032332e706466, ''),
(53, '905', 'Computer Control using Vision-Based Hand Motion Recognition System', '.', '2022-04-07', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f436f6d707574657220436f6e74726f6c207573696e6720566973696f6e2d42617365642048616e64204d6f74696f6e205265636f676e6974696f6e2053797374656d5f436f6e666572656e636550617065725f30345f323032322e706466, ''),
(54, '905', 'Performance of fault classification on Photovoltaic modules using Thermographic', '.', '2022-04-07', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f506572666f726d616e6365206f66206661756c7420636c617373696669636174696f6e206f6e2050686f746f766f6c74616963206d6f64756c6573207573696e6720546865726d6f677261706869635f436f6e666572656e636550617065725f30345f323032322e706466, ''),
(55, '905', 'Investigation of Thermographic Images of Photovoltaic Modules using Deep Learning Models', '.', '2023-10-09', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f496e7665737469676174696f6e206f6620546865726d6f6772617068696320496d61676573206f662050686f746f766f6c74616963204d6f64756c6573207573696e672044656570204c6561726e696e67204d6f64656c735f436f6e666572656e636550617065725f31305f323032332e706466, ''),
(56, '905', 'nvestigating the role of Machine Learning Techniques in Performance Prediction of High Power Microwave Devices', '.', '2022-09-16', '.', 'scopus', 'https://www.google.co.in/', 0x3930355f6e7665737469676174696e672074686520726f6c65206f66204d616368696e65204c6561726e696e6720546563686e697175657320696e20506572666f726d616e63652050726564696374696f6e206f66204869676820506f776572204d6963726f7761766520446576696365735f436f6e666572656e636550617065725f30395f323032322e706466, ''),
(57, '904', 'Design and Implementation of Surplus Food Distribution System', '.', '2022-06-17', '..', 'scopus', 'https://www.google.co.in/', 0x3930345f44657369676e20616e6420496d706c656d656e746174696f6e206f6620537572706c757320466f6f6420446973747269627574696f6e2053797374656d5f436f6e666572656e636550617065725f30365f323032322e706466, ''),
(58, '906', '“Smart Medical Health Card for Hospital Management”', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3930365fe2809c536d617274204d65646963616c204865616c7468204361726420666f7220486f73706974616c204d616e6167656d656e74e2809d5f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(59, '907', 'Security enhancement in IOT with an application of water monitoring', '.', '2022-08-25', '.', 'scopus', 'https://www.google.co.in/', 0x3930375f536563757269747920656e68616e63656d656e7420696e20494f54207769746820616e206170706c69636174696f6e206f66207761746572206d6f6e69746f72696e675f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(60, '908', 'Classification of Diabetes using Machine Learning', '.', '2022-11-25', '.', 'scopus', 'https://www.google.co.in/', 0x3930385f436c617373696669636174696f6e206f66204469616265746573207573696e67204d616368696e65204c6561726e696e675f436f6e666572656e636550617065725f31315f323032322e706466, ''),
(61, '909', 'ESTIMATION OF SEASONAL VARIATION IN MODULE TEMPERATURE MODEL COEFFICIENT FOR', '.', '2022-07-20', '.', 'scopus', 'https://www.google.co.in/', 0x3930395f455354494d4154494f4e204f4620534541534f4e414c20564152494154494f4e20494e204d4f44554c452054454d5045524154555245204d4f44454c20434f454646494349454e5420464f525f436f6e666572656e636550617065725f30375f323032322e706466, ''),
(62, '909', 'Analysis of seasonal variation in Module Temperature Model Coefficient for Amorphous Photovoltaic Technology Module', '.', '2022-09-16', '.', 'scopus', 'https://www.google.co.in/', 0x3930395f416e616c79736973206f6620736561736f6e616c20766172696174696f6e20696e204d6f64756c652054656d7065726174757265204d6f64656c20436f656666696369656e7420666f7220416d6f7270686f75732050686f746f766f6c7461696320546563686e6f6c6f6779204d6f64756c655f436f6e666572656e636550617065725f30395f323032322e706466, ''),
(63, '911', 'Correlation between Image and Text from Unstructured Data Using Deep Learning', '.', '2022-08-26', '.', 'scopus', 'https://www.google.co.in/', 0x3931315f436f7272656c6174696f6e206265747765656e20496d61676520616e6420546578742066726f6d20556e737472756374757265642044617461205573696e672044656570204c6561726e696e675f436f6e666572656e636550617065725f30385f323032322e706466, ''),
(64, '910', 'Investigating the role of Machine Learning Techniques in Performance Prediction of High Power Microwave Devices', '.', '2022-09-26', '.', 'scopus', 'https://www.google.co.in/', 0x3931305f496e7665737469676174696e672074686520726f6c65206f66204d616368696e65204c6561726e696e6720546563686e697175657320696e20506572666f726d616e63652050726564696374696f6e206f66204869676820506f776572204d6963726f7761766520446576696365735f436f6e666572656e636550617065725f30395f323032322e706466, '');

-- --------------------------------------------------------

--
-- Table structure for table `copyright`
--

CREATE TABLE `copyright` (
  `id` int(11) NOT NULL,
  `sdrn_no` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `contributors` varchar(255) DEFAULT NULL,
  `pub_date` date NOT NULL,
  `copyright_material` varchar(255) NOT NULL,
  `copyright_certificate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copyright`
--

INSERT INTO `copyright` (`id`, `sdrn_no`, `department`, `title`, `contributors`, `pub_date`, `copyright_material`, `copyright_certificate`) VALUES
(12, 211064, 'Computer Sciences & Business Systems', 'Tree Vibes', NULL, '2023-10-03', '211064_Tree Vibes_CopyrightMaterial_10_2023.pdf', '211064_Tree Vibes_CopyrightCertificate_10_2023.pdf'),
(13, 500, 'Electronics Engineering', 'A multidimensional transform approach for underwater image denoising', NULL, '2019-04-30', '500_A multidimensional transform approach for underwater image denoising_CopyrightMaterial_04_2019.pdf', '500_A multidimensional transform approach for underwater image denoising_CopyrightCertificate_04_2019.pdf'),
(14, 501, 'Electronics Engineering', 'A method for implementation of Struve function, Mellin-Ross function, Weber function, and Robotnovs function in fractional calculus on parallel computing platform', NULL, '2018-10-09', '501_A method for implementation of Struve function, Mellin-Ross function, Weber function, and Robotnovs function in fractional calculus on parallel computing platform_CopyrightMaterial_10_2018.pdf', '501_A method for implementation of Struve function, Mellin-Ross function, Weber function, and Robotnovs function in fractional calculus on parallel computing platform_CopyrightCertificate_10_2018.pdf'),
(15, 502, 'Electronics Engineering', 'An improved approach for astronomical image enhancement using fractional-order differential mask', NULL, '2018-09-14', '502_An improved approach for astronomical image enhancement using fractional-order differential mask_CopyrightMaterial_09_2018.pdf', '502_An improved approach for astronomical image enhancement using fractional-order differential mask_CopyrightCertificate_09_2018.pdf'),
(16, 504, 'Electrical & Instrumentation Engineering', 'A novel approach for road surveillance using fractional fourier transform based mfcc features under noisy environment ', NULL, '2018-04-17', '504_A novel approach for road surveillance using fractional fourier transform based mfcc features under noisy environment _CopyrightMaterial_04_2018.pdf', '504_A novel approach for road surveillance using fractional fourier transform based mfcc features under noisy environment _CopyrightCertificate_04_2018.pdf'),
(17, 505, 'Computer Engineering', 'A Novel Approach for Detecting Copy-Move Forgery in Digital Images ', NULL, '2020-02-29', '505_A Novel Approach for Detecting Copy-Move Forgery in Digital Images _CopyrightMaterial_02_2020.pdf', '505_A Novel Approach for Detecting Copy-Move Forgery in Digital Images _CopyrightCertificate_02_2020.pdf'),
(18, 511, 'Electronics Engineering', 'Enhnced brain tumor detection using fractional wavelet transform and artificial neural network classifier ', NULL, '2019-11-08', '511_Enhnced brain tumor detection using fractional wavelet transform and artificial neural network classifier _CopyrightMaterial_11_2019.pdf', '511_Enhnced brain tumor detection using fractional wavelet transform and artificial neural network classifier _CopyrightCertificate_11_2019.pdf'),
(19, 512, 'Information Technology', 'Crime Registration and Automated Predication of Crime Hotspot ', NULL, '2021-06-24', '512_Crime Registration and Automated Predication of Crime Hotspot _CopyrightMaterial_06_2021.pdf', '512_Crime Registration and Automated Predication of Crime Hotspot _CopyrightCertificate_06_2021.pdf'),
(20, 513, 'Information Technology', 'An Intelligent Rule based System for Diagnosis of Heart Diseases ', NULL, '2021-04-08', '513_An Intelligent Rule based System for Diagnosis of Heart Diseases _CopyrightMaterial_04_2021.pdf', '513_An Intelligent Rule based System for Diagnosis of Heart Diseases _CopyrightCertificate_04_2021.pdf'),
(21, 515, 'Information Technology', 'An Expert System for COVID-19 Diagnosis using SWI-PROLOG ', NULL, '2021-02-24', '515_An Expert System for COVID-19 Diagnosis using SWI-PROLOG _CopyrightMaterial_02_2021.pdf', '515_An Expert System for COVID-19 Diagnosis using SWI-PROLOG _CopyrightCertificate_02_2021.pdf'),
(22, 516, 'Information Technology', 'Secure and hidden Communication through 8 bit storage covert channel model using TCP Sequence Number', NULL, '2021-01-20', '516_Secure and hidden Communication through 8 bit storage covert channel model using TCP Sequence Number_CopyrightMaterial_01_2021.pdf', '516_Secure and hidden Communication through 8 bit storage covert channel model using TCP Sequence Number_CopyrightCertificate_01_2021.pdf'),
(23, 506, 'Electrical & Instrumentation Engineering', 'A method to compute meansquared error for images using UrdhrvaTiryaghbyam Vedic sutra ', NULL, '2019-11-14', '506_A method to compute meansquared error for images using UrdhrvaTiryaghbyam Vedic sutra _CopyrightMaterial_11_2019.pdf', '506_A method to compute meansquared error for images using UrdhrvaTiryaghbyam Vedic sutra _CopyrightCertificate_11_2019.pdf'),
(24, 517, 'Information Technology', 'Modern Visual Cryptography Expnasionless Shares with Layered Approach ', NULL, '2020-01-12', '517_Modern Visual Cryptography Expnasionless Shares with Layered Approach _CopyrightMaterial_01_2020.pdf', '517_Modern Visual Cryptography Expnasionless Shares with Layered Approach _CopyrightCertificate_01_2020.pdf'),
(25, 518, 'Computer Engineering', 'transcript System ', NULL, '2021-03-24', '518_transcript System _CopyrightMaterial_03_2021.pdf', '518_transcript System _CopyrightCertificate_03_2021.pdf'),
(26, 519, 'Computer Engineering', 'Preemptive Diagnosis and Stage Identifier of Chronic Kidney Disease', NULL, '2021-02-02', '519_Preemptive Diagnosis and Stage Identifier of Chronic Kidney Disease_CopyrightMaterial_02_2021.pdf', '519_Preemptive Diagnosis and Stage Identifier of Chronic Kidney Disease_CopyrightCertificate_02_2021.pdf'),
(27, 520, 'Computer Engineering', 'Novel Approach for Assuring Quality in Outcome Based Education (OBE) System', NULL, '2021-03-15', '520_Novel Approach for Assuring Quality in Outcome Based Education (OBE) System_CopyrightMaterial_03_2021.pdf', '520_Novel Approach for Assuring Quality in Outcome Based Education (OBE) System_CopyrightCertificate_03_2021.pdf'),
(28, 521, 'Computer Engineering', 'Secure and Hidden Communication through 8-bit storage covert channel model using TCP sequence number', NULL, '2021-01-20', '521_Secure and Hidden Communication through 8-bit storage covert channel model using TCP sequence number_CopyrightMaterial_01_2021.pdf', '521_Secure and Hidden Communication through 8-bit storage covert channel model using TCP sequence number_CopyrightCertificate_01_2021.pdf'),
(29, 522, 'Computer Engineering', 'Multilevel Context Based Search in Chat Engines for Hybrid Business Models. ', NULL, '2020-10-20', '522_Multilevel Context Based Search in Chat Engines for Hybrid Business Models. _CopyrightMaterial_10_2020.pdf', '522_Multilevel Context Based Search in Chat Engines for Hybrid Business Models. _CopyrightCertificate_10_2020.pdf'),
(30, 523, 'Electronics Engineering', 'Low-Contrast Underwater Image Enhancement using GrunwaldLetnikov Derivative ', NULL, '2021-04-27', '523_Low-Contrast Underwater Image Enhancement using GrunwaldLetnikov Derivative _CopyrightMaterial_04_2021.pdf', '523_Low-Contrast Underwater Image Enhancement using GrunwaldLetnikov Derivative _CopyrightCertificate_04_2021.pdf'),
(31, 524, 'Electrical & Instrumentation Engineering', 'An Algorithm To Produce Three', NULL, '2021-01-25', '524_An Algorithm To Produce Three_CopyrightMaterial_01_2021.pdf', '524_An Algorithm To Produce Three_CopyrightCertificate_01_2021.pdf'),
(32, 525, 'Electronics Engineering', 'A Novel Algorithm To Predict The Module Temperature Of Hetero-Junction Intrinsic Thin Film (Hit) Photovoltaic Technology Using Artificial Neural Network (ANN)', NULL, '2021-01-06', '525_A Novel Algorithm To Predict The Module Temperature Of Hetero-Junction Intrinsic Thin Film (Hit) Photovoltaic Technology Using Artificial Neural Network (ANN)_CopyrightMaterial_01_2021.pdf', '525_A Novel Algorithm To Predict The Module Temperature Of Hetero-Junction Intrinsic Thin Film (Hit) Photovoltaic Technology Using Artificial Neural Network (ANN)_CopyrightCertificate_01_2021.pdf'),
(33, 526, 'Information Technology', 'TELEGRAM INTEGRATED COVIBOT', NULL, '2022-08-02', '526_TELEGRAM INTEGRATED COVIBOT_CopyrightMaterial_08_2022.pdf', '526_TELEGRAM INTEGRATED COVIBOT_CopyrightCertificate_08_2022.pdf'),
(34, 527, 'Information Technology', 'Telegram Integrated Faq Chat-Bot For Obtaining College Information to Assist in the Process of Admission ', NULL, '2021-08-25', '527_Telegram Integrated Faq Chat-Bot For Obtaining College Information to Assist in the Process of Admission _CopyrightMaterial_08_2021.pdf', '527_Telegram Integrated Faq Chat-Bot For Obtaining College Information to Assist in the Process of Admission _CopyrightCertificate_08_2021.pdf'),
(35, 528, 'Information Technology', 'Decision Making for Enterprise Resource Planning Implementation ', NULL, '2021-07-15', '528_Decision Making for Enterprise Resource Planning Implementation _CopyrightMaterial_07_2021.pdf', '528_Decision Making for Enterprise Resource Planning Implementation _CopyrightCertificate_07_2021.pdf'),
(36, 530, 'Computer Engineering', 'Detecting Stages of Chronic Kidney Disease from USG using SqueezeNet for Indian Population', NULL, '2021-02-28', '530_Detecting Stages of Chronic Kidney Disease from USG using SqueezeNet for Indian Population_CopyrightMaterial_02_2021.pdf', '530_Detecting Stages of Chronic Kidney Disease from USG using SqueezeNet for Indian Population_CopyrightCertificate_02_2021.pdf'),
(37, 531, 'Computer Engineering', 'TRUPPT-Vocal For Local Initiative ', NULL, '2023-11-03', '531_TRUPPT-Vocal For Local Initiative _CopyrightMaterial_11_2023.pdf', '531_TRUPPT-Vocal For Local Initiative _CopyrightCertificate_11_2023.pdf'),
(38, 535, 'Computer Engineering', 'Machine Learning Approach For Anti Malware Solution ', NULL, '2021-09-07', '535_Machine Learning Approach For Anti Malware Solution _CopyrightMaterial_09_2021.pdf', '535_Machine Learning Approach For Anti Malware Solution _CopyrightCertificate_09_2021.pdf'),
(39, 536, 'Computer Engineering', 'OCEAN Traits Extraction From Text, Questionaire And Social Media Profile For Personality Prediction ', NULL, '2021-08-31', '536_OCEAN Traits Extraction From Text, Questionaire And Social Media Profile For Personality Prediction _CopyrightMaterial_08_2021.pdf', '536_OCEAN Traits Extraction From Text, Questionaire And Social Media Profile For Personality Prediction _CopyrightCertificate_08_2021.pdf'),
(40, 537, 'Computer Engineering', 'On Trade Cloud Ecosystem Structure For Shared Learning ', NULL, '2021-08-25', '537_On Trade Cloud Ecosystem Structure For Shared Learning _CopyrightMaterial_08_2021.pdf', '537_On Trade Cloud Ecosystem Structure For Shared Learning _CopyrightCertificate_08_2021.pdf'),
(41, 538, 'Computer Engineering', 'Budget and Expense Management System', NULL, '2021-08-24', '538_Budget and Expense Management System_CopyrightMaterial_08_2021.pdf', '538_Budget and Expense Management System_CopyrightCertificate_08_2021.pdf'),
(42, 539, 'Computer Engineering', 'Reliable Hybrid Relay Node Selection for Faster Dissemination of Emergency Messages in Vehicular Ad-Hoc Network ', NULL, '2021-08-19', '539_Reliable Hybrid Relay Node Selection for Faster Dissemination of Emergency Messages in Vehicular Ad-Hoc Network _CopyrightMaterial_08_2021.pdf', '539_Reliable Hybrid Relay Node Selection for Faster Dissemination of Emergency Messages in Vehicular Ad-Hoc Network _CopyrightCertificate_08_2021.pdf'),
(43, 540, 'Computer Engineering', 'Online Faculty Publication Management System', NULL, '2021-08-18', '540_Online Faculty Publication Management System_CopyrightMaterial_08_2021.pdf', '540_Online Faculty Publication Management System_CopyrightCertificate_08_2021.pdf'),
(44, 541, 'Computer Engineering', 'Mobile Multimedia Cleaner App ', NULL, '2021-08-10', '541_Mobile Multimedia Cleaner App _CopyrightMaterial_08_2021.pdf', '541_Mobile Multimedia Cleaner App _CopyrightCertificate_08_2021.pdf'),
(45, 542, 'Computer Engineering', 'Rakshanti the Safety App', NULL, '2021-02-24', '542_Rakshanti the Safety App_CopyrightMaterial_02_2021.pdf', '542_Rakshanti the Safety App_CopyrightCertificate_02_2021.pdf'),
(46, 544, 'Computer Engineering', 'Custom Photo Realistic Face Generation System Using Deep Learning', NULL, '2021-07-28', '544_Custom Photo Realistic Face Generation System Using Deep Learning_CopyrightMaterial_07_2021.pdf', '544_Custom Photo Realistic Face Generation System Using Deep Learning_CopyrightCertificate_07_2021.pdf'),
(47, 546, 'Electronics Engineering', 'Analog Integrated Design of FractionalOrder Integrator and Differentiator ', NULL, '2021-12-20', '546_Analog Integrated Design of FractionalOrder Integrator and Differentiator _CopyrightMaterial_12_2021.pdf', '546_Analog Integrated Design of FractionalOrder Integrator and Differentiator _CopyrightCertificate_12_2021.pdf'),
(48, 547, 'Electronics Engineering', 'A Method For Parallel Computation Of Chebyshev Polynomials, Error Function And Scorer Function', NULL, '2021-09-20', '547_A Method For Parallel Computation Of Chebyshev Polynomials, Error Function And Scorer Function_CopyrightMaterial_09_2021.pdf', '547_A Method For Parallel Computation Of Chebyshev Polynomials, Error Function And Scorer Function_CopyrightCertificate_09_2021.pdf'),
(49, 548, 'Electronics Engineering', 'An Algorithm To Detect Melanoma Skin Cancer Using Deep Learning', NULL, '2021-08-26', '548_An Algorithm To Detect Melanoma Skin Cancer Using Deep Learning_CopyrightMaterial_08_2021.pdf', '548_An Algorithm To Detect Melanoma Skin Cancer Using Deep Learning_CopyrightCertificate_08_2021.pdf'),
(50, 549, 'Electronics Engineering', 'An Algorithm To Generate Brain Computer Interface(Bci)-Based Prompting Feasibility For Disabled Persons ', NULL, '2021-08-26', '549_An Algorithm To Generate Brain Computer Interface(Bci)-Based Prompting Feasibility For Disabled Persons _CopyrightMaterial_08_2021.pdf', '549_An Algorithm To Generate Brain Computer Interface(Bci)-Based Prompting Feasibility For Disabled Persons _CopyrightCertificate_08_2021.pdf'),
(51, 550, 'Electronics & Telecommunication Engineering', 'CLUSTER DIAGONAL 2D MESH TOPOLOGY FOR NETWORK ON CHIP ', NULL, '2021-09-21', '550_CLUSTER DIAGONAL 2D MESH TOPOLOGY FOR NETWORK ON CHIP _CopyrightMaterial_09_2021.pdf', '550_CLUSTER DIAGONAL 2D MESH TOPOLOGY FOR NETWORK ON CHIP _CopyrightCertificate_09_2021.pdf'),
(52, 551, 'Electronics & Telecommunication Engineering', 'NEXT GENERATION QoS aware Mode Switching Process', NULL, '2021-02-11', '551_NEXT GENERATION QoS aware Mode Switching Process_CopyrightMaterial_02_2021.pdf', '551_NEXT GENERATION QoS aware Mode Switching Process_CopyrightCertificate_02_2021.pdf'),
(53, 552, 'Computer Engineering', 'NEXT GENERATION QoS aware Mode Switching Process', NULL, '2022-09-23', '552_NEXT GENERATION QoS aware Mode Switching Process_CopyrightMaterial_09_2022.pdf', '552_NEXT GENERATION QoS aware Mode Switching Process_CopyrightCertificate_09_2022.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `sdrn` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `journal` varchar(255) NOT NULL,
  `pub_date` date NOT NULL,
  `issn` varchar(255) NOT NULL,
  `doi` varchar(255) NOT NULL,
  `impact_factor` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `sdrn`, `title`, `authors`, `department`, `journal`, `pub_date`, `issn`, `doi`, `impact_factor`, `file`) VALUES
(35, 4, 'Overcoming fears', 'Sanket Koli', 'Artificial Intelligence & Data Science', 'Fears', '2023-10-01', '33464334333', '778.998.009', 3, '4_Overcoming fears_Journal_10_2023.pdf'),
(36, 300, 'Security  Implementat ion Using E-LogBook', 'Sujata  Oak', 'Information Technology', 'Internationa l Journal of  Computer  Science and  Information  Technology', '2018-01-02', '0975– 9646', '1234.4567.8901', 2, '300_Security  Implementat ion Using E-LogBook_Journal_01_2018.pdf'),
(37, 301, 'Security  aware Dual  Authenticati on based  Routing  Scheme  using Fuzzy  Logic with  Secure data  disseminatio n for Mobile  Ad-hoc  Networks', 'Gautam M  Borkar', 'Information Technology', 'Journal of  Applied  Security  Research,  Taylor and  Francis  ,Publisher  Routledge', '2018-01-03', '1936- 1610', '1234.4567.8902', 1, '301_Security  aware Dual  Authenticati on based  Routing  Scheme  using Fuzzy  Logic with  Secure data  disseminatio n for Mobile  Ad-hoc  Networks_Journal_01_2018.pdf'),
(38, 302, 'IOT on  Smart waste  management  in Cities', 'Rohan  Kadu', 'Information Technology', 'Internationa l Journal of  Scientific &  Engineering  Research, ', '2018-01-04', '2277- 8616', '1234.4567.8903', 1, '302_IOT on  Smart waste  management  in Cities_Journal_01_2018.pdf'),
(39, 303, 'A Multiple  Feature  Based  Offline  Handwritten  Signature', 'Akriti  Nigam', 'Information Technology', 'Internationa l Journal of  Computer  Application s in  Technology', '2018-01-05', '1741- 5047', '1234.4567.8904', 1, '303_A Multiple  Feature  Based  Offline  Handwritten  Signature_Journal_01_2018.pdf'),
(40, 304, 'A secure and  trust based  on-demand  multipath  routing  scheme for  self-organized  mobile ad-hoc  networks', 'Gautam  Borkar', 'Information Technology', 'Journal of  Wireless  Network,  Springer', '2018-01-06', '1022- 0038', '1234.4567.8905', 3, '304_A secure and  trust based  on-demand  multipath  routing  scheme for  self-organized  mobile ad-hoc  networks_Journal_01_2018.pdf'),
(41, 305, 'Secure E-Pay using  Steganography and  Visual  Cryptography', 'Savita  Swamy', 'Information Technology', 'Internationa l Journal of  Advance  Computatio nal  Engineering  and  Networking  Technology', '2017-01-01', '2320- 2106', '1234.4567.8906', 2, '305_Secure E-Pay using  Steganography and  Visual  Cryptography_Journal_01_2017.pdf'),
(42, 307, 'C E-Learning  System  to Find  Learning  Statistics', 'Harsha  Saxena', 'Computer Engineering', 'International  journal of  engineering and  management  research', '2018-01-08', '0749-6037', '10.31033/ijemr', 1, '307_C E-Learning  System  to Find  Learning  Statistics_Journal_01_2018.pdf'),
(43, 308, 'Crime  Prediction using  Fuzzy C-Means  Algorithm', 'Ekta  Sarda', 'Computer Engineering', 'International  Research  Journal of  Engineering and  Technology', '2018-01-09', '2395-0056 ', '1234.4567.8908', 8, '308_Crime  Prediction using  Fuzzy C-Means  Algorithm_Journal_01_2018.pdf'),
(44, 309, 'Interactive  Physiotherapy', 'Namita  Pulgam', 'Computer Engineering', 'International  Journal of  Advance  Research,  Ideas and  Innovations in  Technology', '2018-01-10', '2452-132X', '1234.4567.8909', 6, '309_Interactive  Physiotherapy_Journal_01_2018.pdf'),
(45, 310, 'Loan  Risk  Prediction for  Bank  Customers using  Data  Mining  techniques', 'Harshada  D', 'Computer Engineering', 'International  Journal of  Computational  Intelligence  Research', '2018-01-11', '0973-1873', '1234.4567.8910', 1, '310_Loan  Risk  Prediction for  Bank  Customers using  Data  Mining  techniques_Journal_01_2018.pdf'),
(46, 311, 'Result  Extraction from  Searchable PDF', 'Manish  Yadav', 'Computer Engineering', 'International  Journal of  Advance  Research,  Ideas and  Innovations in  Technology', '2018-01-12', '2452-132X ', '1234.4567.8911', 6, '311_Result  Extraction from  Searchable PDF_Journal_01_2018.pdf'),
(47, 312, 'Social  Champion  Identification', 'Abhi  Salviya', 'Computer Engineering', 'International  Journal of Advances , research,  ideas and  innovations in  Technology', '2018-01-13', '2452-132X ', '1234.4567.8912', 6, '312_Social  Champion  Identification_Journal_01_2018.pdf'),
(48, 313, 'Stock  Prediction using  ARMA', 'Rahul  Bendale', 'Computer Engineering', 'International  journal of  engineering and  management  research', '2018-01-14', '10.31033/ijemr', '1234.4567.8901', 2, '313_Stock  Prediction using  ARMA_Journal_01_2018.pdf'),
(49, 315, 'Review  on Smart  Healthcar e  Systems  using  Cloud  and Big  Data  Analysis', 'Sahil  Sachadeva', 'Computer Engineering', 'International  Journal of  Advances ,  Research  Ideas and  Innovations in  Technology', '2018-01-15', '2452-132X', '1234.4567.8914', 6, '315_Review  on Smart  Healthcar e  Systems  using  Cloud  and Big  Data  Analysis_Journal_01_2018.pdf'),
(50, 316, 'Review  on Smart  Healthcare  Systems  using  Cloud  and Big  Data  Analysis', 'Ms.  Prachi  Junwale', 'Computer Engineering', 'International  Journal of  Computer  Science  Engineering and  Information  Technology  Research', '2018-01-16', '2231-3117 ', '1234.4567.8916', 0, '316_Review  on Smart  Healthcare  Systems  using  Cloud  and Big  Data  Analysis_Journal_01_2018.pdf'),
(51, 317, 'Compara tive  Analysis  of  Feature  Matching  Algorith ms In  Region  Duplicati on  Detection', 'Nisha  Fule', 'Computer Engineering', 'International  Journal  for  Research  Trends  and  Innovation', '2018-01-17', '2456 - 3315 ', '1234.4567.8916', 5, '317_Compara tive  Analysis  of  Feature  Matching  Algorith ms In  Region  Duplicati on  Detection_Journal_01_2018.pdf'),
(52, 318, 'Performance  improvement of  doped  TFET by  using  plasma  formation concept', 'Deepak  Soni', 'Computer Engineering', 'Superlattices and  Microstructure', '2018-01-18', '0749-6036 ', '1234.4567.8917', 3, '318_Performance  improvement of  doped  TFET by  using  plasma  formation concept_Journal_01_2018.pdf'),
(53, 319, 'NNRA-CAC:  NARX  Neural  Network-based  Rate  Adjustme nt for  Congestion  Avoidance and  Control  in  Wireless  Sensor  Networks', 'Vaibhav  Narawade', 'Computer Engineering', 'New  Review  of  Information  Networking', '2018-01-19', 'https://doi.org/10.1080/136 14576.2017.1368407 ', '1234.4567.8918', 0, '319_NNRA-CAC:  NARX  Neural  Network-based  Rate  Adjustme nt for  Congestion  Avoidance and  Control  in  Wireless  Sensor  Networks_Journal_01_2018.pdf'),
(54, 320, 'Comparative  Analysis  of  Feature  Extraction  Techniques in  Key-point  based  Image  Forgery  Detection', 'Pooja  Patil', 'Computer Engineering', 'Imperial  Journal of  Interdisciplinary  Research', '2017-01-19', '2454-1362', '1234.4567.8919', 2, '320_Comparative  Analysis  of  Feature  Extraction  Techniques in  Key-point  based  Image  Forgery  Detection_Journal_01_2017.pdf'),
(55, 321, 'Gesture  Recognition Based  Video  Game  Controller', 'Pratik  Pagade', 'Computer Engineering', 'International  Research  Journal of  Engineering and  Technology', '2017-01-21', '2395-0056 ', '1234.4567.8920', 8, '321_Gesture  Recognition Based  Video  Game  Controller_Journal_01_2017.pdf'),
(56, 322, 'Topic  Modelling :  Comparative  Study', 'Shraddha  Narhari', 'Computer Engineering', 'International  Journal of  Scientific  Research  and  Development', '2017-01-22', '2321-0613 ', '1234.4567.8921', 4, '322_Topic  Modelling :  Comparative  Study_Journal_01_2017.pdf'),
(57, 323, 'Big Data  Summarization  Using  Novel  Clustering  Algorithm and  Semantic  Feature  Approach', 'Shilpa  Kolte', 'Computer Engineering', 'International  Journal of  Rough  Sets and  Data  Analysis  (IJRSDA)', '2017-01-22', '2334-4598', '1234.4567.8922', 7, '323_Big Data  Summarization  Using  Novel  Clustering  Algorithm and  Semantic  Feature  Approach_Journal_01_2017.pdf'),
(58, 324, 'Intelligent  Complaint  Tracking  and  Allocation System', 'Snehal  Mumbaikar', 'Computer Engineering', 'Intelligent  Complaint  Tracking  and  Allocation System', '2017-01-24', '2321-0613 ', '1234.4567.8923', 4, '324_Intelligent  Complaint  Tracking  and  Allocation System_Journal_01_2017.pdf'),
(59, 325, 'Review  of the  Neural  Network  Based  Congestion  Control  Methods  of  Wireless  Sensor  Network', 'Uttam  D.  Kolekar', 'Computer Engineering', 'Elixir  International  Journal', '2017-01-25', '2229-712X ', '1234.4567.8924', 0, '325_Review  of the  Neural  Network  Based  Congestion  Control  Methods  of  Wireless  Sensor  Network_Journal_01_2017.pdf'),
(60, 326, 'A  Review  On  Different  Image  Splicing  Techniques', 'Manish  Pansare', 'Computer Engineering', 'Internatio nal  Journal of  Innovativ e  Research  in  Computer  and  Communi cation  Engineeri ng', '2017-01-26', '2320-9798', '1234.4567.8925', 7, '326_A  Review  On  Different  Image  Splicing  Techniques_Journal_01_2017.pdf'),
(61, 327, 'Analysis  based  IDS for  Mobile  Adhoc  Network', 'Pravin  Khobragade', 'Computer Engineering', 'International  Journal of  Advanced  Research  in  Computer  Science', '2017-01-27', '0976-5697', '1234.4567.8926', 2, '327_Analysis  based  IDS for  Mobile  Adhoc  Network_Journal_01_2017.pdf'),
(62, 328, 'Automated fire  detection  and  extinguishing bot', 'Nivedita', 'Computer Engineering', 'International  Journal of  Engineering  Science  and  Computing', '2017-01-28', '0749-6038', '1234.4567.8927', 6, '328_Automated fire  detection  and  extinguishing bot_Journal_01_2017.pdf'),
(63, 329, 'Deliberation on  Face  Anti-Spoofing  Techniques', 'Deveshree  R.  More', 'Computer Engineering', 'Internatio nal  Journal of  Innovativ e  Research  in  Computer  and  Communi cation  Engineeri ng', '2017-01-29', '2320-9798', '1234.4567.8928', 7, '329_Deliberation on  Face  Anti-Spoofing  Techniques_Journal_01_2017.pdf'),
(64, 330, 'Detection  of  Spoofed  Face and  Medium  using  Various  Parameters from  Single  Image', 'Mrs.  Vanita  Mane', 'Computer Engineering', 'IAETSD  Journal  for  Advanced  Research  in  Applied  Sciences', '2017-01-30', '2394-8442 ', '1234.4567.8929', 6, '330_Detection  of  Spoofed  Face and  Medium  using  Various  Parameters from  Single  Image_Journal_01_2017.pdf'),
(65, 332, 'Overview on  Minimizing  Distortion in  Image  Steganography', ' Poonam Tetele', 'Computer Engineering', 'International  Journal of  Innovative  Research  in  Computer  and  Communication  Engineering', '2017-02-01', ' 2320-9798 ', '1234.4567.8931', 7, '332_Overview on  Minimizing  Distortion in  Image  Steganography_Journal_02_2017.pdf'),
(66, 333, 'Security  for  Biometric  Samples  using  Nelder-Mead', 'Mrs. Vanita  Mane', 'Computer Engineering', 'IAETSD  Journal  for  Advanced  Research  in  Applied  Sciences', '2017-02-02', '2394-8442 ', '1234.4567.8932', 6, '333_Security  for  Biometric  Samples  using  Nelder-Mead_Journal_02_2017.pdf'),
(67, 334, 'Sentiment  Analysis  of Movie  Reviews', 'Vimla Jethani', 'Computer Engineering', 'International  Journal of  Advanced  Research  in  Computer  Science', '2017-02-03', '0976-5697', '1234.4567.8933', 2, '334_Sentiment  Analysis  of Movie  Reviews_Journal_02_2017.pdf'),
(68, 335, 'Estimation of  operating  condition  frequency  distribution  and power  prediction by  extending  application of  IEC 61853-1  standard for  different  technology  photovoltaic  modules', 'D Magare', 'Electronics Engineering', 'Journal of  Renewable  and  Sustainable  Energy', '2018-06-01', '1941-7012', '1234.4567.8934', 0, '335_Estimation of  operating  condition  frequency  distribution  and power  prediction by  extending  application of  IEC 61853-1  standard for  different  technology  photovoltaic  modules_Journal_06_2018.pdf'),
(69, 336, 'Design of  novel optimal  complex-order  controllers for  systems with  fractional-order  dynamics', 'Arti V Tare', 'Electrical & Instrumentation Engineering', 'Internation al Journal  of  Dynamics  and Control', '2018-06-02', '2195-2698', '1234.4567.8935', 0, '336_Design of  novel optimal  complex-order  controllers for  systems with  fractional-order  dynamics_Journal_06_2018.pdf'),
(70, 337, 'Implementation of virtual  instrument for  performance  monitoring of  solar panel  using NI-myrio 1900', 'Manoj S.  Gofane', 'Electronics Engineering', 'International Journal  of  Computer  Engineering and  Applications', '2018-05-01', '2321-3469', '1234.4567.8936', 0, '337_Implementation of virtual  instrument for  performance  monitoring of  solar panel  using NI-myrio 1900_Journal_05_2018.pdf'),
(71, 338, 'Artificial  neural network  approximation s of linear  fractional  neutron  models', 'Gaurav   Datkhile', 'Electrical & Instrumentation Engineering', 'Annals of  Nuclear  Energy', '2018-03-01', '0306-4549', '1234.4567.8938', 0, '338_Artificial  neural network  approximation s of linear  fractional  neutron  models_Journal_03_2018.pdf'),
(72, 339, 'Artificial  neural network  approximation s of linear  fractional  neutron  models', 'Vishwesh A Vyawahare', 'Electrical & Instrumentation Engineering', 'Annals of  Nuclear  Energy', '2023-03-18', '0306-4549', '1234.4567.8938', 0, '339_Artificial  neural network  approximation s of linear  fractional  neutron  models_Journal_03_2023.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` int(11) NOT NULL,
  `sdrn` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `abstract` text NOT NULL,
  `area` varchar(50) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `file` varchar(100) NOT NULL,
  `pub_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `sdrn`, `title`, `author`, `email`, `phone`, `abstract`, `area`, `department`, `file`, `pub_date`) VALUES
(55, '1', 'Stress', 'Sanket', 'qq@gmail.com', '998877665544', 'ffpfmefpomfpo', 'Artificial Intelligence', 'Instrumentation Engineering', '1_Stress_Researchpaper_09_2023.pdf', '2023-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `patents`
--

CREATE TABLE `patents` (
  `id` int(11) NOT NULL,
  `sdrn` int(11) NOT NULL,
  `patent_title` varchar(255) NOT NULL,
  `inventors` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `app_no` int(11) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `filing_date` date NOT NULL,
  `pub_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `file` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patents`
--

INSERT INTO `patents` (`id`, `sdrn`, `patent_title`, `inventors`, `assignee`, `app_no`, `department`, `filing_date`, `pub_date`, `status`, `file`) VALUES
(44, 2, 'Stress optimization', 'Rohit Yadav', 'Overseas', 2147483647, 'Instrumentation Engineering', '2023-08-02', '2023-10-01', 'Published', 0x325f537472657373206f7074696d697a6174696f6e5f506174656e745f31305f323032332e706466);

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(4, 'sanketkoli19@gmail.com', 'ae0b0fee1379fb84', 'a29f480ed8b74eb8379870be86a3e27b2bad3e502296dd0d67969b5142c86eb5', '1697221046'),
(27, 'pallavi@gmail.com', 'a6f3113c219c8e22', '748570307a773c2c11ed9da7e19853cb0b308a9346e853a430c4f4fe73ec6363', '1697379204'),
(48, 'deepanshuj288@gmail.com', '34f7de23f1fa2896', '3baaade57aa0ea5c8175bfecf9c1dc2fc2b220a66e5a941a84bf9c442b378304', '1697807366'),
(52, 'kolisanket19@gmail.com', '14c28b994b6a38cb', '485759202c3bb14cf6c5e098828512e1734f23056af0fd7abd3e9aec823983b2', '1697814379');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `sdrn` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_approval` enum('Pending','Approved','Denied') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `sdrn` varchar(30) NOT NULL,
  `password` longtext NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sdrn`, `password`, `email`, `phone`) VALUES
(27, 'SANKET KOLI', '151001', 'Sanket2019@!', 'kolisanket19@gmail.com', '8390135849'),
(28, 'jatin', '123', '123456', 'pathakjatin0949@gmail.com', '9702441434'),
(29, 'Tabassum M', '1', '123456', 'tab@gmail.com', '123456789'),
(30, 'Chaitanya J', '2', '123456', 'cj@gmail.com', '1234567890'),
(31, 'Vijay P', '4', '123456', 'vp@gmail.com', '98654321'),
(32, 'NRD', '5', '123456', 'nrd@gmail.com', '234567891'),
(33, 'Swati B', '6', '123456', 'sb@gmail.com', '3456789012'),
(34, 'SMP', '7', '123456', 'smp@gmail.com', '1357924680'),
(35, 'Sanjay T', '8', '123456', 'st@gmail.com', '4567890123'),
(36, 'Ravindra G', '9', '123456', 'rg@gmail.com', '5678901234'),
(37, 'Arpita P', '10', '123456', 'ap@gmail.com', '6789012345'),
(38, 'ROHIT YADAV', '211064', '123456', 'rohit@gmail.com', '9987660832'),
(39, 'sai', '12', '123456', 'sai.narwade03@gmail.com', '9930438073'),
(40, 'Gajanan birajdar', '500', '123456', 'gajanan@gmail.com', '9999900000'),
(41, 'Priya Khot', '501', '123456', 'Priya@gmail.com', '9999900001'),
(42, 'Vishwesh Vyawahare ', '502', '123456', 'Vishwesh@gmail.com', '9999900003'),
(43, 'Mukesh D Patil ', '504', '123456', 'mukesh@gmail.com', '9999900004'),
(44, 'Mrs. Vanita mane ', '505', '123456', 'vanita@gmail.com', '9999900005'),
(46, 'Bhakti Kaushal', '511', '123456', 'Bhakti@gmail.com', '9999911111'),
(47, 'Dr. Gautam Borkar', '512', '123456', 'Gautam@gmail.com', '9999911112'),
(48, 'Dr. Pallavi Chavan', '513', '123456', 'pallavi@gmail.com', '9999911113'),
(49, 'Mrs. Jyoti Kundale', '514', '123456', 'jyoti@gmail.com', '9999911114'),
(50, 'Ashutosh Sharma ', '515', '123456', 'Ashutosh@gmail.com', '9999911115'),
(51, 'Dr. Dhananjay Dakhane ', '516', '123456', 'Dhananjay@gmail.com', '9999911116'),
(52, 'Rini Ratnakar ', '506', '123456', 'Rini@gmail.com', '9999900006'),
(53, 'Sujata  Oak', '300', '123456', 'so@gmail.com', '8769374548'),
(54, 'Gautam M  Borkar', '301', '123456', 'gmb@gmail.com', '6127933811'),
(55, 'Rohan  Kadu', '302', '123456', 'rk@gmail.com', '6127909189'),
(56, 'Akriti  Nigam', '303', '123456', 'an@gmail.com', '7319041955'),
(57, 'Gautam  Borkar', '304', '123456', 'gb@gmail.com', '3865252409'),
(58, 'Savita  Swamy', '305', '123456', 'ss@gmail.com', '7409854461'),
(59, 'Shivendra  Yadav', '306', '123456', 'sy@gmail.com', '7979028074'),
(60, 'Harsha  Saxena', '307', '123456', 'hs@gmail.com', '3715688996'),
(61, 'Ekta Sarda', '308', '123456', 'es@gmail.com', '3781683489'),
(62, 'Namita  Pulgam', '309', '123456', 'np@gmail.com', '3865853090'),
(63, 'Harshada  D', '310', '123456', 'hd@gmail.com', '3888918760'),
(64, 'Manish  Yadav', '311', '123456', 'my@gmail.com', '2966531813'),
(65, 'Abhi  Salviya', '312', '123456', 'as@gmail.com', '3888010832'),
(66, 'Rahul  Bendale', '313', '123456', 'rb@gmail.com', '3888491833'),
(67, 'Sahil  Sachadeva', '315', '123456', 'sss@gmail.com', '2326488599'),
(68, 'Ms.  Prachi  Junwale', '316', '123456', 'pj@gmail.com', '3888657556'),
(69, 'Nisha Fule', '317', '123456', 'nf@gmail.com', '3841637162'),
(70, 'Deepak  Soni', '318', '123456', 'ds@gmail.com', '2252557841'),
(71, 'Vaibhav  Narawade', '319', '123456', 'vn@gmail.com', '3865781440'),
(72, 'Pooja  Patil', '320', '123456', 'pp@gmail.com', '3888750054'),
(73, 'Pratik  Pagade', '321', '123456', 'ppa@gmail.com', '3781468297'),
(74, 'Shraddha  Narhari', '322', '123456', 'sn@gmail.com', '3821473414'),
(75, 'Shilpa  Kolte', '323', '123456', 'sk@gmail.com', '3888969631'),
(76, 'Snehal  Mumbaikar', '324', '123456', 'sm@gmail.com', '3329654657'),
(77, 'Uttam  D.  Kolekar', '325', '123456', 'uk@gmail.com', '2323703328'),
(78, 'Manish  Pansare', '326', '123456', 'mp@gmail.com', ' 3888486390'),
(79, 'Pravin  Khobragade', '327', '123456', 'pk@gmail.com', '3846457581'),
(80, 'Nivedita', '328', '123456', 'n@gmail.com', '3865522263'),
(81, 'Deveshree  R.  More', '329', '123456', 'dm@gmail.com', '3865893508'),
(82, 'Mrs.  Vanita  Mane', '330', '123456', 'vm@gmail.com', '2966368015'),
(83, 'Krithika', '331', '123456', 'k@gmail.com', '3888887273'),
(84, 'Poonam  Tetele', '332', '123456', 'pt@gmail.com', '2926474321'),
(85, 'Mrs. Vanita  Mane', '333', '123456', 'mvm@gmail.com', '3891656281'),
(86, 'Vimla  Jethani', '334', '123456', 'vj@gmail.com', '3865654446'),
(87, 'D Magare', '335', '123456', 'dma@gmail.com', '3821661509'),
(88, 'Arti V  Tare', '336', '123456', 'at@gmail.com', '2622265910'),
(89, 'Manoj S. Gofane', '337', '123456', 'mg@gmail.com', '3888025445'),
(90, 'Gaurav   Datkhile', '338', '123456', 'gd@gmail.com', '2284237661'),
(91, 'Vishwesh  A  Vyawahare', '339', '123456', 'vv@gmail.com', '6752022765'),
(92, 'roshni', '900', '123456', 'roshni@gmail.com', '08451966363'),
(93, 'Aniket Shingne', '901', '123456', 'aniket@gmail.com', '0845196098'),
(94, 'Shweta Ashtekar', '902', '123456', 'shweta@gmail.com', '08451966468'),
(95, 'Trupti Agarkar', '903', '123456', 'trupti@gmail.com', '84519123'),
(96, 'Sakshi Somani', '904', '123456', 'sakshi@gmail.com', '08451966492'),
(97, 'Ashwini Chavan', '905', '123456', 'ashwini@gmail.com', '08451966476'),
(98, 'Angha Gharat', '906', '123456', 'angha@gmail.com', '08451960795'),
(99, 'Jiu Berde', '907', '123456', 'jiu@gmail.com', '08451960258'),
(100, 'Nauroz Zaman', '908', '123456', 'nauroz@gmail.com', '08451960129'),
(101, 'Krupali Kanekar', '909', '123456', 'krupali@gmail.com', '08451965972'),
(102, 'Jyoti Vengurlekar', '910', '123456', 'jyoti1@gmail.com', '123456045'),
(103, 'Tushar Ghorpade', '911', '123456', 'tushar@gmail.com', '123459536'),
(104, 'Yukta Dandekar', '912', '123456', 'yukta@gmail.com', '123450126'),
(105, 'Ayush Chamria', '913', '123456', 'ayush@gmail.com', '123458356'),
(106, 'Akshay Charmria', '914', '123456', 'akshay@gmail.com', '123450521'),
(107, 'Prita Patil', '915', '123456', 'prita@gmail.com', '084519664687'),
(108, 'Shubham Gaud', '916', '123456', 'shubham@gmail.com', '08451975903'),
(109, 'Yash Raut', '917', '123456', 'yash@gmail.com', '123450456'),
(110, 'Vikrant Shahane', '918', '123456', 'vikrant@gmail.com', '123454682'),
(111, 'Dr. Mohammad Atique ', '517', '123456', 'mohammad@gmail.com', '9999911120'),
(112, 'Mrs. Smita Bhoir, ', '518', '123456', 'smita@gmail.com', '9999911121'),
(113, 'Prakarsha Dahat ', '519', '123456', 'Prakarsha@gmail.com', '9999911123'),
(114, 'Dr. Nilesh Marathe', '520', '123456', 'Nilesh@gmail.com', '9999911124'),
(115, 'Dhananjay M', '521', '123456', 'Dhan@gmail.com', '9999911125'),
(116, 'Mrs. Sumithra T. V ', '522', '123456', 'Sumithra@gmail.com', '9999911126'),
(117, 'Vikas Mali,', '523', '123456', 'Vikas@gmail.com', '9999911127'),
(118, 'Dr. Yogita Mistry', '524', '123456', 'Yogita@gmail.com', '9999911128'),
(119, 'Dr. Dhiraj Magare', '525', '123456', 'Dhiraj@gmail.com', '9999911129'),
(120, 'Mrs. Sumedha Bhagwat,', '526', '123456', 'Sumedha@gmail.com', '9999911130'),
(121, 'Mr. Swapnil Shinde', '527', '123456', 'Swapnil@gmail.com', '9999911131'),
(122, 'Amol Kalgaonkar', '528', '123456', 'Amol@gmail.com', '9999911132'),
(123, 'Anindita A Khade', '530', '123456', 'Anindita@gmail.com', '9999911133'),
(124, 'Medha Mathur', '531', '123456', 'Medha@gmail.com', '9999911134'),
(125, 'advait joshi', '535', '123456', 'advait@gmail.com', '9999911140'),
(126, 'Smita Bharne', '536', '123456', 'Smita21@gmail.com', '9999911142'),
(127, 'vaibhav narwade', '537', '123456', 'Vaibhav@gmail.com', '9999911143'),
(128, 'Hitesh Jaware', '538', '123456', 'Hitesh@gmail.com', '9999911144'),
(129, 'Puja Padiya', '539', '123456', 'Puja@gmail.com', '9999911145'),
(130, 'Rugveda Shripatrao', '540', '123456', 'Rugveda@gmail.com', '99911146'),
(131, 'Mayuri Kumbhar ', '541', '123456', 'mayuri@gmail.com', '9999911147'),
(132, 'Prasad Shete', '542', '123456', 'prasad@gamil.com', '9999911148'),
(133, ' Himani Deshpande', '543', '123456', 'Himani@gmail.com', '9999911149'),
(134, 'Rajat Kapgate', '544', '123456', 'Rajat@gmail.com', '9999911150'),
(135, 'Siddhi Jagtap', '545', '123456', 'Siddhi@gmail.com', '9999911151'),
(136, 'Sushma Kodagali', '546', '123456', 'Sushma@gmail.com', '9999911152'),
(137, 'Aditya Ambler', '547', '123456', 'Aditya@gmail.com', '9999911153'),
(138, 'Dhiraj Magare', '548', '123456', 'Dhira@gmail.com', '9999911154'),
(139, 'yogita', '549', '123456', 'yogi@gmail.com', '9999911155'),
(140, 'Dr. Prajakta Dere', '550', '123456', 'prajakta@gmail.com', '9999911156'),
(141, 'Pallavi Sapkale ', '551', '123456', 'Pallavisapkale@gmail.com', '9999911157'),
(142, 'dhananjay', '552', '123456', 'dhan1@gmail.com', '9999911158'),
(143, 'Pallavi Chavan ', '11', '123456', 'pc@gmail.com', '+918031210296'),
(144, 'Nilima Dongre', '13', '123456', 'nd@gmail.com', '+913849720642'),
(145, 'Kriti K', '14', '123456', 'kk@gmail.com', '+912626606568'),
(146, 'Sheila Mahapatra', '15', '123456', 'sheilam@gmail.com', '+915168504414'),
(147, 'Savita Bhosale', '16', '123456', 'savitab@gmail.com', '+918866626390'),
(148, 'Sujata Mengudale', '17', '123456', 'sujatam@gmail.com', '+914795010767'),
(149, 'Choudhari S', '18', '123456', 'cs@gmail.com', '+911327091539'),
(150, 'Ayush Saxena', '19', '123456', 'ayushs@gmail.com', '+914955933696'),
(151, 'Pooja Patil', '20', '123456', 'patilp@gmail.com', '+912347708194'),
(152, 'Tushar B', '21', '123456', 'tbhangle@gmail.com', '+916154432996'),
(153, 'Aditya Salunke', '23', '123456', 'salunke@gmail.com', '+917936654096'),
(154, 'Dipti Jadhav', '22', '123456', 'dipti@gmail.com', '+916868268828'),
(155, 'Rashmi D', '24', '123456', 'rad@gmail.com', '+911175922292'),
(156, 'Sangeeth S', '25', '123456', 'sangeeth@gmail.com', '+917442369016'),
(157, 'Pratik Kadam', '26', '123456', 'pkadam@gmail.com', '+912643748118'),
(158, 'Utkal', '27', '123456', 'utkalm@gmail.com', '+914465877878'),
(159, 'Santanu Das', '28', '123456', 'santdas@gmail.com', '+916720932221'),
(160, 'Ashwini Naik', '29', '123456', 'naik@gmail.com', '+918771533970'),
(161, 'Hemlata Patil', '30', '123456', 'hp@gmail.com', '+916274841262'),
(162, 'Jayanand Gawande', '31', '123456', 'jg@gmail.com', '+911524788353'),
(163, 'Namrata Singh', '32', '123456', 'nsingh@gmail.com', '+911317615793'),
(164, 'Rupali Agme', '33', '123456', 'ragme@gmail.com', '+914782786659'),
(165, 'S. D. Shete', '34', '123456', 'sds@gmail.com', '+916863380256'),
(166, 'S.M.Patil', '35', '123456', 'smpatil@gmail.com', '+911323117226'),
(167, 'Deepanshu  K. Jain', '10091', '1234567', 'deepanshuj288@gmail.com', '989898989'),
(168, 'Somil K Jain', '10092', '123456', 'deepanshujain288@gmail.com', '9672928400'),
(169, 'jhd', '8881', '', 'dijanek898@wisnick.com', '23879827871');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_chapters`
--
ALTER TABLE `book_chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copyright`
--
ALTER TABLE `copyright`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patents`
--
ALTER TABLE `patents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `book_chapters`
--
ALTER TABLE `book_chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `conference`
--
ALTER TABLE `conference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `copyright`
--
ALTER TABLE `copyright`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `patents`
--
ALTER TABLE `patents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
