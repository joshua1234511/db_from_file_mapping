-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2017 at 06:37 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `etf_countries`
--

CREATE TABLE IF NOT EXISTS `etf_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etf_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `etf_details`
--

CREATE TABLE IF NOT EXISTS `etf_details` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cusip` varchar(32) NOT NULL,
  `inception_date` date NOT NULL,
  `fiscal_year_end` date NOT NULL,
  `exchange` varchar(32) NOT NULL,
  `asset_class` varchar(32) NOT NULL,
  `index_recon_freq` varchar(32) NOT NULL,
  `underlying_index` varchar(128) NOT NULL,
  `dividend_distributions` varchar(32) NOT NULL,
  `capital_gains_distributions` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `etf_performance`
--

CREATE TABLE IF NOT EXISTS `etf_performance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etf_id` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `ytd_returns` float(6,2) NOT NULL,
  `nav_change_percent` float(6,2) NOT NULL,
  `nav_change` float(6,2) NOT NULL,
  `nav` decimal(6,2) NOT NULL,
  `market_price_change_percent` float(6,2) NOT NULL,
  `market_price_change` float(6,2) NOT NULL,
  `market_price` float(6,2) NOT NULL,
  `nav_returns_1yr` float(6,2) NOT NULL,
  `market_returns_1yr` float(6,2) NOT NULL,
  `nav_returns_3yr` float(6,2) NOT NULL,
  `market_returns_3yr` float(6,2) NOT NULL,
  `nav_returns_5yr` float(6,2) NOT NULL,
  `market_returns_5yr` float(6,2) NOT NULL,
  `nav_returns_10yr` float(6,2) NOT NULL,
  `market_returns_10yr` float(6,2) NOT NULL,
  `nav_change_since_inception` float(6,2) NOT NULL,
  `market_price_change_since_inception` float(6,2) NOT NULL,
  `total_net_assets` decimal(10,0) NOT NULL,
  `dist_rate_at_nav` float(16,7) NOT NULL,
  `standard_yield_30d` float(6,2) NOT NULL,
  `gross_expense_ratio` decimal(4,2) NOT NULL,
  `net_expense_ration` decimal(4,2) NOT NULL,
  `shares_outstanding` int(11) NOT NULL,
  `tickers` varchar(256) NOT NULL,
  `no_of_holdings` int(5) NOT NULL,
  `ltcg_amount` float(14,7) NOT NULL,
  `ltcg_record_date` date NOT NULL,
  `ltcg_ex_date` date NOT NULL,
  `ltcg_reinvestment_date` date NOT NULL,
  `ltcg_payable_date` date NOT NULL,
  `ltcg_reinvestment_price` decimal(6,2) NOT NULL,
  `stcg_amount` float(14,7) NOT NULL,
  `stcg_record_date` date NOT NULL,
  `stcg_ex_date` date NOT NULL,
  `stcg_reinvestment_date` date NOT NULL,
  `stcg_payable_date` date NOT NULL,
  `stcg_reinvestment_price` decimal(6,2) NOT NULL,
  `income_amount` float(14,7) NOT NULL,
  `income_record_date` date NOT NULL,
  `income_ex_date` varchar(256) NOT NULL,
  `income_reinvestment_date` date NOT NULL,
  `income_payable_date` date NOT NULL,
  `income_reinvestment_price` decimal(6,2) NOT NULL,
  `tdps_amount` float(14,7) NOT NULL COMMENT 'Total Distribution per Share',
  `tdps_record_date` date NOT NULL COMMENT 'Total Distribution per Share',
  `tdps_ex_date` date NOT NULL COMMENT 'Total Distribution per Share',
  `tdps_reinvestment_date` date NOT NULL COMMENT 'Total Distribution per Share',
  `tdps_payable_date` date NOT NULL COMMENT 'Total Distribution per Share',
  `tdps_reinvestment_price` decimal(6,2) NOT NULL COMMENT 'Total Distribution per Share',
  `bid_ask_spread` float(6,2) NOT NULL,
  `avg_mp_nav_inception` float(6,2) NOT NULL COMMENT 'Avg of Markt Price vs NAV since Inception',
  `avg_mp_nav_close` float(6,2) NOT NULL COMMENT 'Avg of Market Price vs NAV at close',
  `nav_high` decimal(6,2) NOT NULL COMMENT '52-week Range',
  `nav_low` decimal(6,2) NOT NULL COMMENT '52-week Range',
  `mp_high` decimal(6,2) NOT NULL COMMENT '52-week Range',
  `mp_low` decimal(6,2) NOT NULL COMMENT '52-week Range',
  `total_period_days` int(11) NOT NULL COMMENT 'Premium Discont Analysis by Quarter (select a quarter)',
  `nav_days` int(11) NOT NULL COMMENT 'Premium Discont Analysis by Quarter (select a quarter)',
  `premium_days` int(11) NOT NULL COMMENT 'Premium Discont Analysis by Quarter (select a quarter)',
  `discount_days` int(11) NOT NULL COMMENT 'Premium Discont Analysis by Quarter (select a quarter)',
  `greatest_premium` decimal(6,2) NOT NULL COMMENT 'Premium Discont Analysis by Quarter (select a quarter)',
  `greatest_discount` float(6,2) NOT NULL COMMENT 'Premium Discont Analysis by Quarter (select a quarter)',
  `sp_benchmark_return_1yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `owl500_index_return_1yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `sp_benchmark_return_3yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `owl500_index_return_3yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `sp_benchmark_return_5yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `owl500_index_return_5yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `sp_benchmark_return_10yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `owl500_index_return_10yr` float(7,2) NOT NULL COMMENT 'Quarter End & Month End Versions',
  `sp500_each_yr` float(7,2) NOT NULL COMMENT 'Calendar Year Returns',
  `owl500_index_each_yr` float(7,2) NOT NULL COMMENT 'Calendar Year Returns',
  `cytd_nav` float(12,6) NOT NULL COMMENT 'NAV % for each year',
  `cytd_mp` float(12,6) NOT NULL COMMENT 'Market Price % for each year',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `etf_portfolio`
--

CREATE TABLE IF NOT EXISTS `etf_portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `security_id` int(11) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `shares` int(11) NOT NULL,
  `market_value_base` decimal(11,2) NOT NULL,
  `market_value_local` decimal(11,2) NOT NULL,
  `etf_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `etf_sectors`
--

CREATE TABLE IF NOT EXISTS `etf_sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etf_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `securities`
--

CREATE TABLE IF NOT EXISTS `securities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticker` varchar(32) NOT NULL,
  `name` varchar(256) NOT NULL,
  `asset_class` varchar(32) NOT NULL,
  `currency` varchar(8) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
