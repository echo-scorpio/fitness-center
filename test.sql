-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019-08-30 03:37:42
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- 存储过程
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateTimes` ()  BEGIN  
    update t_card set validTimes=validTimes-1 where cardID in (select vipCardId from t_member) and validTimes>0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `t_card`
--

CREATE TABLE `t_card` (
  `cardID` int(100) NOT NULL,
  `cardName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `validTimes` int(100) NOT NULL,
  `cardPrice` double NOT NULL,
  `cardDiscount` double NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_card`
--

INSERT INTO `t_card` (`cardID`, `cardName`, `validTimes`, `cardPrice`, `cardDiscount`, `startTime`, `endTime`) VALUES
(400001, '高级会员卡', 30, 1000, 0.99, '08:00:00', '22:00:00'),
(400002, '普通会员卡', 751, 1000, 0.99, '08:00:00', '22:00:00'),
(400003, '普通会员卡', 365, 1000, 0.99, '08:00:00', '22:00:00'),
(400004, '中级会员卡', 365, 1500, 0.85, '08:00:00', '22:00:00'),
(400005, '普通会员卡', 366, 1000, 0.99, '08:00:00', '20:00:00'),
(400006, '金卡', 366, 1000, 0.8, '08:00:00', '20:00:00');

--
-- 触发器 `t_card`
--
DELIMITER $$
CREATE TRIGGER `upMemberTimes` AFTER UPDATE ON `t_card` FOR EACH ROW IF EXISTS (SELECT  cardID FROM t_card where validTimes=0) then 
    update t_member set memRemarks='已到期' where vipCardId in(SELECT  cardID FROM t_card where validTimes=0) and memRemarks!='已转卡';
	end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `t_coach`
--

CREATE TABLE `t_coach` (
  `coaID` int(100) NOT NULL,
  `coaName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaSex` char(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaIdCardNo` bigint(100) NOT NULL,
  `coaNation` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaPolitic` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaEducation` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaTel` bigint(100) NOT NULL,
  `coaPosition` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaSchool` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `coaRemarks` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_coach`
--

INSERT INTO `t_coach` (`coaID`, `coaName`, `coaSex`, `coaIdCardNo`, `coaNation`, `coaPolitic`, `coaEducation`, `coaTel`, `coaPosition`, `coaSchool`, `coaRemarks`) VALUES
(2000001, '马东', '女', 110268199511452653, '满族', '党员', '大学     ', 13064852356, '教练助理', '北京体育大学     ', '已禁用'),
(2000002, '王青', '男', 156243563256354, '满族', '团员', '大学    ', 13121883254, '副教练', '北方工业大学   ', '    '),
(2000006, '王强', '男', 130684199542635462, '汉族', '党员', '大学', 13128459623, '教练', '北京体育大学', ''),
(2000007, '张亮', '男', 156842689563254, '满族', '团员', '大学', 165986426354, '教练', '北京体育大学', NULL),
(2000009, '林立', '男', 1130684156986532461, '汉族', '党员', '大学', 13516487561, '教练', '北方工业大学', NULL),
(2000010, '李湘', '女', 135642894653216423, '汉族', '党员', '大专', 13564287962, '教练', '北京体育大学', NULL);

--
-- 触发器 `t_coach`
--
DELIMITER $$
CREATE TRIGGER `del_coach` AFTER DELETE ON `t_coach` FOR EACH ROW DELETE  FROM t_user WHERE t_user.userId=OLD.coaID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `t_consume`
--

CREATE TABLE `t_consume` (
  `id` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `courseID` int(100) NOT NULL,
  `price` double(20,2) NOT NULL,
  `consumeTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_consume`
--

INSERT INTO `t_consume` (`id`, `userID`, `courseID`, `price`, `consumeTime`) VALUES
(5, 100001, 300001, 792.00, '2019-07-06 09:51:59'),
(6, 100001, 300003, 99.00, '2019-06-06 09:52:08'),
(7, 100001, 300004, 99.00, '2019-08-06 09:52:17'),
(8, 100002, 300001, 792.00, '2019-08-06 09:52:35'),
(9, 100002, 300003, 99.00, '2019-08-06 09:52:43'),
(10, 100027, 300001, 792.00, '2019-06-06 09:53:07'),
(11, 100027, 300004, 99.00, '2019-06-07 09:53:15'),
(12, 100027, 300005, 495.00, '2019-07-06 09:53:23'),
(13, 100001, 300005, 495.00, '2019-08-11 16:09:50'),
(14, 100001, 300006, 148.50, '2019-08-11 16:11:57'),
(15, 100001, 300007, 148.50, '2019-08-12 16:37:41'),
(16, 100001, 300008, 99.00, '2019-08-12 16:39:54'),
(17, 100002, 300013, 148.50, '2019-08-15 21:02:52'),
(18, 100002, 300004, 99.00, '2019-08-16 12:37:08'),
(19, 100035, 300003, 148.50, '2019-08-16 19:03:43'),
(20, 100040, 300003, 148.50, '2019-08-22 09:16:20'),
(21, 100040, 300004, 99.00, '2019-08-22 09:16:51'),
(22, 100040, 300008, 99.00, '2019-08-22 09:17:33'),
(23, 100040, 300013, 643.50, '2019-08-22 09:29:45'),
(24, 100039, 300003, 120.00, '2019-08-22 09:45:46');

-- --------------------------------------------------------

--
-- 表的结构 `t_course`
--

CREATE TABLE `t_course` (
  `courseID` int(100) NOT NULL,
  `courseName` varchar(100) COLLATE utf8_bin NOT NULL,
  `courseContent` varchar(150) COLLATE utf8_bin NOT NULL,
  `courseTime` varchar(100) COLLATE utf8_bin NOT NULL,
  `courseArea` varchar(100) COLLATE utf8_bin NOT NULL,
  `courseTeacher` varchar(100) COLLATE utf8_bin NOT NULL,
  `coursePrice` double(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `t_course`
--

INSERT INTO `t_course` (`courseID`, `courseName`, `courseContent`, `courseTime`, `courseArea`, `courseTeacher`, `coursePrice`) VALUES
(300003, '普拉提基础', '普拉提首先是一种运动。它主要是锻炼人体深层的小肌肉群，维持和改善外观正常活动姿势、达到身体平衡、创展躯干和肢体的活动范围和活动能力、强调对核心肌群的控制、加强人脑对肢体及骨骼肌肉组织的神经感应及支配，再配合正确的呼吸方法所进行的一项全身协调运动。', '周二上午第一节  ', '1004', '王强', 150.00),
(300004, '瑜伽', '瑜伽能加速新陈代谢，去除体内废物，形体修复、调理养颜从内及外；瑜伽能带给你优雅气质、轻盈体态，提高人的内外在的气质；瑜伽能增强身体力量和肌体弹性，身体四肢均衡发展，使你变得越来越开朗、活力、身心愉悦；瑜伽能预防和治疗各种身心相关的疾病，背痛、肩痛、颈痛、头痛、关节痛、失眠、消化系统紊乱、痛经、脱发等', '周一第一节', '105', '王青', 100.00),
(300008, '跑步', '教大家正确的跑步姿势', '周一第四节', '105', '张亮', 100.00),
(300013, '游泳', '教大家游泳的姿势', '周一第三节', '1001', '马东', 650.00);

-- --------------------------------------------------------

--
-- 表的结构 `t_leave`
--

CREATE TABLE `t_leave` (
  `id` int(100) NOT NULL,
  `memId` int(100) NOT NULL,
  `leaveTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_leave`
--

INSERT INTO `t_leave` (`id`, `memId`, `leaveTime`) VALUES
(3, 100001, '2019-07-29 10:14:45'),
(4, 100001, '2019-07-29 10:26:47'),
(5, 100001, '2019-07-29 10:27:53'),
(6, 100001, '2019-07-29 10:41:16'),
(7, 100001, '2019-07-29 10:43:02'),
(8, 100001, '2019-07-29 10:50:32'),
(9, 100002, '2019-07-29 10:51:13'),
(10, 100001, '2019-07-29 10:57:40'),
(11, 100002, '2019-07-29 10:59:44'),
(12, 100001, '2019-07-29 11:13:11'),
(13, 100002, '2019-08-01 09:28:53'),
(14, 100002, '2019-08-01 10:12:13'),
(15, 100001, '2019-08-02 09:33:28'),
(16, 100001, '2019-08-02 09:36:56'),
(17, 100001, '2019-08-11 12:59:12'),
(18, 100002, '2019-08-11 13:01:12'),
(19, 100001, '2019-08-12 17:08:44'),
(20, 100001, '2019-08-12 17:13:04'),
(21, 100001, '2019-08-12 17:14:53'),
(22, 100001, '2019-08-12 17:16:22'),
(23, 100001, '2019-08-12 17:17:23'),
(24, 100001, '2019-08-12 17:24:28'),
(25, 100002, '2019-08-16 13:02:24'),
(26, 100040, '0000-00-00 00:00:00'),
(27, 100039, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `t_member`
--

CREATE TABLE `t_member` (
  `memId` int(100) NOT NULL,
  `vipCardId` int(100) NOT NULL,
  `memName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `memSex` char(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `memAddr` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `memHealth` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `memIdCard` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `memTel` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `memRegisteDate` date NOT NULL,
  `memRemarks` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_member`
--

INSERT INTO `t_member` (`memId`, `vipCardId`, `memName`, `memSex`, `memAddr`, `memHealth`, `memIdCard`, `memTel`, `memRegisteDate`, `memRemarks`) VALUES
(100002, 400002, '王冰冰', '男', '石景山区石门路368号', '健康', '110368412655421458', '13524879652', '2019-07-01', '已请假'),
(100032, 400004, '王珂', '男', '北京市 ', '健康', '5687946823164856', '15624389653 ', '2019-08-11', '已转卡'),
(100039, 400006, '柯南', '男', '北京市', '健康', '168459169856456423', '13526489653', '2019-08-16', '已请假'),
(100040, 400005, '郑歌', '女', '北京市', '健康', '130684199652346289', '13521759864', '2019-08-16', '已请假');

--
-- 触发器 `t_member`
--
DELIMITER $$
CREATE TRIGGER `del_member` AFTER DELETE ON `t_member` FOR EACH ROW DELETE  FROM t_user WHERE t_user.userId=OLD.memId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `t_right`
--

CREATE TABLE `t_right` (
  `id` int(11) NOT NULL,
  `userRole` int(11) NOT NULL,
  `userRight` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `t_right`
--

INSERT INTO `t_right` (`id`, `userRole`, `userRight`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `t_rightrules`
--

CREATE TABLE `t_rightrules` (
  `id` int(100) NOT NULL,
  `userRight` int(100) NOT NULL,
  `rules` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `t_rightrules`
--

INSERT INTO `t_rightrules` (`id`, `userRight`, `rules`) VALUES
(1, 1, '会员管理'),
(2, 2, '会员卡管理'),
(3, 3, '教练管理'),
(4, 4, '课程管理'),
(5, 5, '会员业务管理');

-- --------------------------------------------------------

--
-- 表的结构 `t_role`
--

CREATE TABLE `t_role` (
  `id` int(100) NOT NULL,
  `userId` varchar(100) COLLATE utf8_bin NOT NULL,
  `userName` varchar(100) COLLATE utf8_bin NOT NULL,
  `userRole` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `t_role`
--

INSERT INTO `t_role` (`id`, `userId`, `userName`, `userRole`) VALUES
(1, '888', '张三', 1);

-- --------------------------------------------------------

--
-- 表的结构 `t_transfer`
--

CREATE TABLE `t_transfer` (
  `id` int(100) NOT NULL,
  `memID` int(100) NOT NULL,
  `toMemTel` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cardID` int(100) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_transfer`
--

INSERT INTO `t_transfer` (`id`, `memID`, `toMemTel`, `cardID`, `time`) VALUES
(2, 100001, '13124587964', 400001, '2019-08-01 10:05:56'),
(3, 100001, '12564875462', 400001, '2019-08-01 10:54:16'),
(4, 100001, '13254687562', 400001, '2019-08-02 09:39:21'),
(5, 100002, '', 400002, '2019-08-02 09:49:58'),
(6, 100002, '13254685432', 400002, '2019-08-02 10:02:47'),
(7, 100001, '13546986532', 400001, '2019-08-02 10:18:20'),
(8, 100001, '13546287965', 400001, '2019-08-02 10:21:35'),
(9, 100001, '136478965342', 400001, '2019-08-02 10:24:38'),
(10, 100002, '????&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13521720895', 400002, '2019-08-03 11:33:02'),
(11, 100027, '????       13524879652', 400001, '2019-08-03 11:42:30'),
(12, 100002, '????       13521720895', 400001, '2019-08-03 11:49:10'),
(13, 100001, '????       13524879652', 400001, '2019-08-03 11:52:46'),
(14, 100002, '????       13521720895', 400001, '2019-08-03 11:54:28'),
(15, 100001, '????       13524879652', 400001, '2019-08-03 11:57:50'),
(16, 100002, '????       13521720895', 400001, '2019-08-03 11:59:19'),
(17, 100001, '????       13524879652', 400001, '2019-08-03 12:00:37'),
(18, 100002, '联系方式       13521720895', 400001, '2019-08-03 12:02:45'),
(19, 100027, '56438265431', 400003, '2019-08-16 13:15:02'),
(20, 100032, '426531896523', 400004, '2019-08-16 13:24:58'),
(21, 100033, '13521759864', 400005, '2019-08-16 18:13:59');

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE `t_user` (
  `userId` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userPassword` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userRole` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`userId`, `userPassword`, `userRole`) VALUES
('100002', '123', '0'),
('100032', '100032', '0'),
('100039', '100039', '0'),
('100040', '100040', '0'),
('2000001', '123', '1'),
('2000002', '2000002', '1'),
('2000006', '2000006', '1'),
('2000007', '2000007', '1'),
('2000009', '2000009', '1'),
('2000010', '2000010', '1'),
('777', '777', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_card`
--
ALTER TABLE `t_card`
  ADD PRIMARY KEY (`cardID`);

--
-- Indexes for table `t_coach`
--
ALTER TABLE `t_coach`
  ADD PRIMARY KEY (`coaID`);

--
-- Indexes for table `t_consume`
--
ALTER TABLE `t_consume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_course`
--
ALTER TABLE `t_course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `t_leave`
--
ALTER TABLE `t_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_member`
--
ALTER TABLE `t_member`
  ADD PRIMARY KEY (`memId`),
  ADD UNIQUE KEY `memIdCard` (`memIdCard`),
  ADD UNIQUE KEY `memTel` (`memTel`);

--
-- Indexes for table `t_right`
--
ALTER TABLE `t_right`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_rightrules`
--
ALTER TABLE `t_rightrules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_transfer`
--
ALTER TABLE `t_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`userId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_card`
--
ALTER TABLE `t_card`
  MODIFY `cardID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400007;
--
-- 使用表AUTO_INCREMENT `t_coach`
--
ALTER TABLE `t_coach`
  MODIFY `coaID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000011;
--
-- 使用表AUTO_INCREMENT `t_consume`
--
ALTER TABLE `t_consume`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `t_course`
--
ALTER TABLE `t_course`
  MODIFY `courseID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300014;
--
-- 使用表AUTO_INCREMENT `t_leave`
--
ALTER TABLE `t_leave`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- 使用表AUTO_INCREMENT `t_member`
--
ALTER TABLE `t_member`
  MODIFY `memId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100042;
--
-- 使用表AUTO_INCREMENT `t_right`
--
ALTER TABLE `t_right`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `t_rightrules`
--
ALTER TABLE `t_rightrules`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `t_transfer`
--
ALTER TABLE `t_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`root`@`localhost` EVENT `e_times` ON SCHEDULE EVERY 60 SECOND STARTS '2019-07-07 15:01:58' ON COMPLETION PRESERVE ENABLE DO call updateTimes()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
