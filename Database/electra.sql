
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--
-- Database: `electra`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `unitstoamount` (IN `units` INT(14), OUT `result` INT(14))  BEGIN
   
    DECLARE a INT(14) DEFAULT 0;
    DECLARE b INT(14) DEFAULT 0;
    DECLARE c INT(14) DEFAULT 0;

    SELECT twohundred FROM unitsRate INTO a ;
    SELECT fivehundred FROM unitsRate INTO b ;
    SELECT thousand FROM unitsRate INTO c  ;

    IF units<200
    then
        SELECT a*units INTO result;
    
    ELSEIF units<500
    then
        SELECT (a*200)+(b*(units-200)) INTO result;
    ELSEIF units > 500
    then
        SELECT (a*200)+(b*(300))+(c*(units-500)) INTO result;
    END IF;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `curdate1` () RETURNS INT(11) BEGIN
    DECLARE x INT;
    SET x = DAYOFMONTH(CURDATE());
    IF (x=1)
    THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `pass`) VALUES
(1, 'admin1', 'admin1@ashesi.com', 'admin'),
(2, 'admin2', 'admin2@ashesi.com', 'admin'),
(3,'admin3','admin3@ashesi.com','admin');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `aid` int(14) NOT NULL,
  `uid` int(14) NOT NULL,
  `units` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `bdate` date NOT NULL,
  `ddate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `aid`, `uid`, `units`, `amount`, `status`, `bdate`, `ddate`) VALUES
(1, 1, 2, 12, '24.00', 'PROCESSED', '2020-12-01', '2020-12-31'),
(2, 1, 1, 100, '40.00', 'PROCESSED', '2012-08-01', '2012-10-01'),
(3, 1, 2, 106, '200.00', 'PROCESSED', '2018-09-01', '2018-10-01'),
(4, 1, 3, 450, '165.00', 'PROCESSED', '2015-09-01', '2015-10-01'),
(5, 1, 4, 684, '3540.00', 'PROCESSED', '2016-09-01', '2016-10-01'),
(6, 1, 5, 509, '4990.00', 'PROCESSED', '2017-09-01', '2017-10-01'),
(7, 1, 1, 485, '1987.00', 'PROCESSED', '2013-10-01', '2013-10-31'),
(8, 1, 3, 980, '9875.00', 'PROCESSED', '2014-10-01', '2014-10-31'),
(9, 1, 4, 643, '9234.00', 'PROCESSED', '2010-10-01', '2010-10-31'),
(10, 1, 2, 879, '1234.00', 'PROCESSED', '2011-10-01', '2011-10-31'),
(11, 1, 5, 123, '3890.00', 'PROCESSED', '2012-10-01', '2012-10-31'),
(12, 1, 1, 756, '3338.00', 'PROCESSED', '2013-11-01', '2013-12-01'),
(13, 1, 2, 789, '8765.00', 'PROCESSED', '2015-11-01', '2015-12-01'),
(14, 1, 3, 876, '9876.00', 'PROCESSED', '2016-11-01', '2016-12-01'),
(15, 1, 5, 278, '9876.00', 'PROCESSED', '2016-11-01', '2016-12-01'),
(16, 1, 4, 490, '12356.00', 'PROCESSED', '2011-11-01', '2011-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `uid` int(14) NOT NULL,
  `aid` int(14) NOT NULL,
  `complaint` varchar(140) NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `uid`, `aid`, `complaint`, `status`) VALUES
(1, 1, 1, 'Transaction was not Processed', 'PROCESSED'),
(2, 1, 1, 'Transaction was not Processed', 'PROCESSED'),
(3, 2, 1, 'No feedback on Previous Complaint', 'PROCESSED'),
(4, 2, 1, 'Transaction was not Processed', 'PROCESSED'),
(5, 2, 2, 'Transaction was not Processed', 'PROCESSED'),
(6, 1, 1, 'Bill was not accurate', 'PROCESSED'),
(7, 3, 1, 'Bill was not accurate', 'PROCESSED'),
(8, 3, 2, 'Transaction was not Processed', 'PROCESSED'),
(9, 4, 2, 'Transaction was not Processed', 'PROCESSED'),
(10, 4, 1, 'Bill was not accurate', 'PROCESSED'),
(11, 5, 2, 'Bill delayed', 'PROCESSED');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `bid` int(14) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `pdate` date DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bid` (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `bid`, `payable`, `pdate`, `status`) VALUES
(1, 1, '1020.00', '2017-01-06', 'PROCESSED'),
(2, 2, '1200.00', '2016-10-10', 'PROCESSED'),
(3, 3, '1106.00', '2014-11-10', 'PROCESSED'),
(4, 4, '2865.00', '2015-10-10', 'PROCESSED'),
(5, 5, '4640.00', '2020-10-10', 'PROCESSED'),
(6, 6, '3980.00', '2015-10-10', 'PROCESSED'),
(7, 7, '1589.00', '2016-09-26', 'PROCESSED'),
(8, 8, '6567.00', '2017-10-10', 'PROCESSED'),
(9, 9, '4000.00', '2019-10-10', 'PROCESSED'),
(10, 10, '2456.00', '2016-10-10', 'PROCESSED'),
(11, 11, '3810.00', '2014-11-10', 'PROCESSED'),
(12, 12, '3500.00', '2013-09-18', 'PROCESSED'),
(13, 13, '5610.00', '2011-09-18', 'PROCESSED'),
(14, 14, '5170.00', '2012-09-26', 'PROCESSED'),
(15, 15, '765.00', '2013-09-18', 'PROCESSED'),
(16, 16, '6175.00', '2016-09-26', 'PROCESSED');

-- --------------------------------------------------------

--
-- Table structure for table `unitsrate`
--

DROP TABLE IF EXISTS `unitsrate`;
CREATE TABLE IF NOT EXISTS `unitsrate` (
  `sno` int(1) DEFAULT NULL,
  `twohundred` int(14) NOT NULL,
  `fivehundred` int(14) NOT NULL,
  `thousand` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unitsrate`
--

INSERT INTO `unitsrate` (`sno`, `twohundred`, `fivehundred`, `thousand`) VALUES
(1, 2, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(14) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `pass`, `address`) VALUES
(1, 'Hidaya Seidu', 'hidayaseidu07@gmail.com', 2147483647, 'qwerty', 'kumasi'),
(2, 'Salia Mumin', 'saliamumin@gmail.com', 999999999, 'qwerty', 'Bolgatanga'),
(3, 'Mansura', 'mansura@gmail.com', 2147483647, 'qwerty', 'Sadler house'),
(4, 'Ayisha', 'ayisha@gmail.com', 2147483647, 'qwerty', 'Tema'),
(5, 'Awak Mohammed', 'awal@gmail.com', 2147483647, 'qwerty', 'Techiman'),
(6, 'Farida', 'farida@gmail.com', 2147483647, 'qwerty', 'Kumasi'),
(7, 'Jibrl', 'jibril@gmail.com', 123456789, 'qwerty', 'Accra');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
