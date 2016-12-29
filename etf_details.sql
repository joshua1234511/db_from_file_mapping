-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2016 at 06:42 AM
-- Server version: 5.5.51
-- PHP Version: 5.5.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `owlshares_etf`
--

--
-- Dumping data for table `etf_details`
--

INSERT INTO `etf_details` (`id`, `name`, `cusip`, `inception_date`, `fiscal_year_end`, `exchange`, `asset_class`, `index_recon_freq`, `underlying_index`, `dividend_distributions`, `capital_gains_distributions`) VALUES
(1, 'OWLshares ETF', '35473P207', '2016-12-27', '2016-03-31', 'Strategic Beta', 'Equity', 'Semiannually', 'LibertyQ Emerging Markets Index', 'Semiannually', 'December');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
