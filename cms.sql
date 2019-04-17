-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 04:41 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(105, 'Rajanganaya'),
(106, 'Hello hello pure'),
(107, 'Maho'),
(109, 'Thambuththegama'),
(110, 'Galgamuwa'),
(111, 'Anuradhapura'),
(112, 'Saliyapura');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `cost` int(10) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL,
  `costTypeId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `costtype`
--

CREATE TABLE `costtype` (
  `id` int(11) NOT NULL,
  `costtype` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costtype`
--

INSERT INTO `costtype` (`id`, `costtype`, `date`) VALUES
(4, 'sds', '2019-03-26'),
(5, 'test', '2019-03-26'),
(18, 'k', '2019-03-28'),
(19, 'k', '2019-03-28'),
(20, 'k', '2019-03-28'),
(21, 't', '2019-03-28'),
(22, 'cost type 1', '2019-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `tp` varchar(10) NOT NULL,
  `regdate` date NOT NULL,
  `areaid` int(3) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `agentid` int(3) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=active,0=not active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `tp`, `regdate`, `areaid`, `nic`, `agentid`, `status`) VALUES
(137, 'sacfv', 'vsd', '0715591137', '2019-03-07', 38, '983142079v', 1, 1),
(138, 'sam hello', '101,Jayalanda,Mahagalkadawala', '0715591138', '2019-03-31', 108, '983152044x', 1, 0),
(139, 'sachitha', 'No 101,Jayalanda,Mahagalkadawala', '0715591137', '2019-04-14', 105, '983142044v', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fdate` date NOT NULL,
  `ftime` int(11) NOT NULL,
  `tprice` int(100) NOT NULL,
  `rprice` int(100) NOT NULL,
  `status` int(1) NOT NULL,
  `ni` int(11) NOT NULL COMMENT 'number of installment',
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `id` int(11) NOT NULL,
  `dealid` int(11) NOT NULL,
  `installmentid` int(11) NOT NULL,
  `payment` int(100) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `rdate` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=ok,0=no',
  `rpayment` int(100) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`id`, `dealid`, `installmentid`, `payment`, `time`, `date`, `rdate`, `status`, `rpayment`, `cid`) VALUES
(1, 1, 1, 2500, '70:39:49', '2019-03-15', '2019-03-15', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(3) NOT NULL,
  `itemTypeId` int(3) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sDate` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `itemTypeId`, `name`, `sDate`, `status`) VALUES
(17, 25, 'Test', '2019-03-28', 1),
(18, 25, 'item2', '2019-04-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(3) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `date`, `status`) VALUES
(25, 'Test', '2019-03-28', 1),
(26, 'A', '2019-04-14', 1),
(27, 'B', '2019-04-14', 1),
(28, 'C', '2019-04-14', 1),
(29, 'D', '2019-04-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pack`
--

CREATE TABLE `pack` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pack`
--

INSERT INTO `pack` (`id`, `name`, `cdate`) VALUES
(45, 'Gold', '2019-04-14'),
(46, 'Silver', '2019-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `packitems`
--

CREATE TABLE `packitems` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packitems`
--

INSERT INTO `packitems` (`id`, `pid`, `itemid`, `amount`) VALUES
(1, 43, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseditems`
--

CREATE TABLE `purchaseditems` (
  `id` int(11) NOT NULL,
  `dealid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL COMMENT 'item id or pack id',
  `amount` int(11) NOT NULL,
  `uprice` int(200) NOT NULL,
  `stockid` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=for from pack,2=for extra'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `bprice` int(100) NOT NULL,
  `sprice` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `adate` date NOT NULL,
  `mfd` date NOT NULL,
  `exdate` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=active,0=not active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `itemid`, `bprice`, `sprice`, `amount`, `adate`, `mfd`, `exdate`, `status`) VALUES
(9, 17, 250, 300, 250, '2019-03-28', '2019-03-29', '2019-03-28', 1),
(10, 17, 150, 250, 250, '2019-04-06', '2019-04-19', '2019-04-25', 1),
(11, 17, 250, 150, 250, '2019-04-13', '2019-01-01', '2019-01-01', 1),
(12, 17, 250, 450, 350, '2019-04-14', '2019-01-01', '2019-01-01', 1),
(13, 18, 350, 400, 250, '2019-04-14', '2019-01-01', '2019-01-01', 1),
(14, 18, 250, 500, 1500, '2019-04-14', '2027-12-31', '2019-12-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=admin,2=agent'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES
(16, 'sam', '0cc175b9c0f1b6a831c399e269772661', 2),
(17, 'chatson', 'c4ca4238a0b923820dcc509a6f75849b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `tp` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `regdate` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=working,0=not working',
  `nic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `tp`, `dob`, `regdate`, `status`, `nic`) VALUES
(16, 'Sachitha hirushan', '0715591137', '2019-01-17', '2019-04-14', 1, '983142044v'),
(17, 'sa', '0715591137', '2007-02-09', '2019-04-14', 1, '983142044v');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costtype`
--
ALTER TABLE `costtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_ibfk_1` (`itemTypeId`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packitems`
--
ALTER TABLE `packitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseditems`
--
ALTER TABLE `purchaseditems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `costtype`
--
ALTER TABLE `costtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pack`
--
ALTER TABLE `pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `packitems`
--
ALTER TABLE `packitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchaseditems`
--
ALTER TABLE `purchaseditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userdata`
--
ALTER TABLE `userdata`
  ADD CONSTRAINT `userdata_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
