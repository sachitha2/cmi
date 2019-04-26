-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2019 at 06:07 AM
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
(2, 'Galgamuwa');

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

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost`, `purpose`, `date`, `id`, `costTypeId`) VALUES
(1000, 'cha', '2019-04-20', 1, 1),
(200, 'cha', '2019-03-20', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `costtype`
--

CREATE TABLE `costtype` (
  `id` int(11) NOT NULL,
  `costtype` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` bigint(15) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fdate` date NOT NULL,
  `ftime` time NOT NULL,
  `tprice` int(100) NOT NULL,
  `rprice` int(100) NOT NULL,
  `status` int(1) NOT NULL,
  `ni` int(11) NOT NULL COMMENT 'number of installment',
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `date`, `time`, `fdate`, `ftime`, `tprice`, `rprice`, `status`, `ni`, `cid`) VALUES
(1, '2019-04-10', '39:00:00', '2019-04-05', '37:00:00', 2500, 350, 0, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `histry`
--

CREATE TABLE `histry` (
  `id` int(15) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `task` text NOT NULL,
  `userId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `id` int(11) NOT NULL,
  `dealid` bigint(15) NOT NULL,
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
(21, 32, 'A', '2019-04-24', 1),
(22, 32, 'B', '2019-04-24', 1),
(25, 32, 'C', '2019-04-24', 1);

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
(32, 'TYPE', '2019-04-24', 1);

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
(48, 'Gold', '2019-04-24'),
(49, 'Silver', '2019-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `packitems`
--

CREATE TABLE `packitems` (
  `id` int(11) NOT NULL,
  `pid` bigint(15) NOT NULL,
  `itemid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packitems`
--

INSERT INTO `packitems` (`id`, `pid`, `itemid`, `amount`, `status`) VALUES
(2, 40, 21, 1000, 1),
(4, 10, 10, 10, 1),
(14, 49, 25, 250, 1),
(16, 49, 22, 258, 1),
(17, 49, 21, 258, 1);

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

--
-- Dumping data for table `purchaseditems`
--

INSERT INTO `purchaseditems` (`id`, `dealid`, `itemid`, `amount`, `uprice`, `stockid`, `type`) VALUES
(15, 10, 20, 20, 50, 10, 1),
(37, 10, 21, 200, 50, 10, 1),
(38, 10, 21, 100, 50, 10, 1),
(39, 10, 21, 2, 50, 10, 1),
(40, 0, 0, 0, 50, 10, 1);

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
  `ramount` int(11) NOT NULL,
  `adate` date NOT NULL,
  `mfd` date NOT NULL,
  `exdate` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=active,0=not active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `itemid`, `bprice`, `sprice`, `amount`, `ramount`, `adate`, `mfd`, `exdate`, `status`) VALUES
(20, 22, 200, 300, 250, 250, '2019-04-24', '2019-01-01', '2021-05-29', 1),
(21, 22, 450, 480, 200, 200, '2019-04-24', '2019-01-01', '2019-01-01', 1),
(22, 21, 100, 100, 250, 250, '2019-04-25', '2019-01-02', '2019-01-01', 0),
(23, 22, 158, 1587, 258, 258, '2019-05-02', '2019-01-01', '2019-01-01', 1),
(24, 25, 500, 4580, 580, 580, '2018-04-25', '2019-01-01', '2019-01-01', 1),
(25, 21, 1000, 1500, 250, 250, '2019-04-25', '2019-01-01', '2019-07-25', 1),
(26, 25, 500, 4580, 580, 580, '2019-03-31', '2019-01-01', '2019-01-01', 1),
(27, 25, 500, 4580, 580, 580, '2019-01-25', '2019-01-01', '2019-01-01', 1),
(28, 25, 500, 4580, 580, 580, '2018-12-25', '2019-01-01', '2019-01-01', 1);

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
(3, 'sam', 'c4ca4238a0b923820dcc509a6f75849b', 2),
(4, 'queen', '7694f4a66316e53c8cdd9d9954bd611d', 2);

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
(3, 'Sachitha', '0715591137', '2098-11-09', '2019-04-25', 0, '983142044v'),
(4, 'Sandali', '0779274111', '1998-08-19', '2019-04-25', 1, '983142044v');

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
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histry`
--
ALTER TABLE `histry`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `costtype`
--
ALTER TABLE `costtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `histry`
--
ALTER TABLE `histry`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pack`
--
ALTER TABLE `pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `packitems`
--
ALTER TABLE `packitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchaseditems`
--
ALTER TABLE `purchaseditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
