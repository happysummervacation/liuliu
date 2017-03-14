-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: liuliu
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `liuliu`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `liuliu` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `liuliu`;

--
-- Temporary table structure for view `tp_admin`
--

DROP TABLE IF EXISTS `tp_admin`;
/*!50001 DROP VIEW IF EXISTS `tp_admin`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tp_admin` (
  `ID` tinyint NOT NULL,
  `account` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `country` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `chinesename` tinyint NOT NULL,
  `englishname` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `phone` tinyint NOT NULL,
  `QQ` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `sex` tinyint NOT NULL,
  `weixin` tinyint NOT NULL,
  `identity` tinyint NOT NULL,
  `create_time` tinyint NOT NULL,
  `last_modify` tinyint NOT NULL,
  `image_path` tinyint NOT NULL,
  `openID` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tp_book`
--

DROP TABLE IF EXISTS `tp_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_book` (
  `bookid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '教材id',
  `book_type` int(10) unsigned DEFAULT NULL COMMENT '这里的值跟tp_packageconfig中的值是相同的',
  `bookname` varchar(128) DEFAULT NULL COMMENT '教材名',
  `download_link` varchar(512) DEFAULT NULL COMMENT '下载链接',
  `page` int(10) unsigned DEFAULT '0' COMMENT '教材的页码',
  `uploader` int(10) unsigned DEFAULT NULL COMMENT '上传者',
  `candownload` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不能，1能,是否能下载',
  `bookimagelink` varchar(128) DEFAULT NULL COMMENT '教材的封面的存档路径',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0没有，1有',
  PRIMARY KEY (`bookid`),
  KEY `booktype_packageconfig` (`book_type`),
  CONSTRAINT `booktype_packageconfig` FOREIGN KEY (`book_type`) REFERENCES `tp_packageconfig` (`packageconID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_book`
--

LOCK TABLES `tp_book` WRITE;
/*!40000 ALTER TABLE `tp_book` DISABLE KEYS */;
INSERT INTO `tp_book` VALUES (8,5,'少儿','/liuliu/Book/58c785f1e29ee.pdf',111,17,0,'/liuliu/BookImage/58c785f1e3529.jpg',1489470961,0),(9,1,'成人','/liuliu/Book/58c78605ef859.pdf',111,17,0,'/liuliu/BookImage/58c78606029bc.jpg',1489470982,0),(10,2,'雅思','/liuliu/Book/58c786157bde9.pdf',111,17,0,'/liuliu/BookImage/58c786157c960.pdf',1489470997,0);
/*!40000 ALTER TABLE `tp_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_class`
--

DROP TABLE IF EXISTS `tp_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_class` (
  `classID` varchar(40) NOT NULL DEFAULT '' COMMENT '课程ID,使用课程开始时间+教师ID的字符串加密之后的md5数据作为开放时间段的ID，同时删除开放课程时间就是删除数据',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '教师ID',
  `classStartTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程开始时间',
  `classEndTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程结束时间',
  `remark` text NOT NULL COMMENT '教师备注',
  `isSelected` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课程是否被选，0表示没有，表示有',
  `classType` int(10) unsigned DEFAULT '0' COMMENT '0一对一，1小班，2试听课',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `lastModify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0没有，1表示有',
  PRIMARY KEY (`classID`),
  KEY `teacher_register` (`teacherID`),
  CONSTRAINT `teacher_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_class`
--

LOCK TABLES `tp_class` WRITE;
/*!40000 ALTER TABLE `tp_class` DISABLE KEYS */;
INSERT INTO `tp_class` VALUES ('04b88a2bf87cd7602e53b8d3738ff866',19,1489537800,1489539600,'A',1,0,1489474658,1489474658,0),('09ef86673dbeeaf922e8ee1baebe3784',19,1489798800,1489800600,'',0,0,1489476083,1489476083,0),('0b11107f5e40fbeec4566b97fd3b38f1',19,1489887000,1489888800,'',0,0,1489476083,1489476083,0),('0fb86a5e9ee947cf8df78deb52d61fc2',19,1489622400,1489624200,'',1,0,1489474658,1489474658,0),('1770e4d73b3ae57710b08fa3bbe2d5f9',18,1489710600,1489714200,'',0,0,1489474687,1489474687,0),('181aaae17acdc6f5280b488409fa8f1e',19,1489795200,1489797000,'',0,0,1489474658,1489474658,0),('195325ec49077d50b43bb39e80bcbdc5',19,1489626000,1489627800,'',0,0,1489476083,1489476083,0),('32f5ae296114d53610577ca2d5a52fdc',18,1489797000,1489800600,'',0,0,1489474687,1489474687,0),('33c170876d1d674193296b8fc6a28d23',19,1489708800,1489710600,'',1,0,1489474658,1489474658,0),('348809dc06670dd04f19d7a9c4c26aa8',19,1489710600,1489712400,'',1,0,1489474658,1489474658,0),('3c37efed8b9b0f5b7afd80faedf95a43',19,1489800600,1489802400,'',0,0,1489476083,1489476083,0),('421f20c64180aa40e2e7890e1e13c393',19,1489881600,1489883400,'',1,0,1489474658,1489474658,0),('46ef827c423f3d095be96b673988e3f3',18,1489795200,1489798800,'',0,0,1489474687,1489474687,0),('5a8e6459d4285b46730a8b3cb4522dc6',19,1489883400,1489885200,'',1,0,1489474658,1489474658,0),('6ea4b9a64a6ac028a6c7c8315a4bfb2d',19,1489885200,1489887000,'',0,0,1489476083,1489476083,0),('77d250486f11199adcf44bf5d6345221',19,1489712400,1489714200,'',0,0,1489476083,1489476083,0),('7d9d3c2a13c20e8713b42803adeae332',18,1489536000,1489539600,'',0,0,1489474687,1489474687,0),('845306628e12f62a9473f89f484ecb29',18,1489883400,1489887000,'',0,0,1489474687,1489474687,0),('8f883f20d6dd7df4eec6d63935ff8b1c',18,1489622400,1489626000,'',0,0,1489474687,1489474687,0),('9986f475c356b02b1d6ecc0eb85a74a4',19,1489536000,1489537800,'',1,0,1489474658,1489474658,0),('999a156809e05b8d4d4404e91f8bc22a',19,1489624200,1489626000,'',1,0,1489474658,1489474658,0),('9f03b35ec4972dfa5e22194b67b05c0b',19,1489541400,1489543200,'',0,0,1489476083,1489476083,0),('b15f7d6945e6a7d66adf07b8f600c92a',19,1489627800,1489629600,'',0,0,1489476083,1489476083,0),('b40368775a2054b2a9979e63dfb7ab0a',18,1489881600,1489885200,'',0,0,1489474687,1489474687,0),('bfbeae2c2f678a76746a5aec7e2d9005',18,1489708800,1489712400,'',1,0,1489474687,1489474687,0),('d5f8f5ec782a7c1fcd9ceadd0ba24d50',19,1489539600,1489541400,'',1,0,1489476083,1489476083,0),('dd31787a1092a518400da6424f6fe88f',18,1489624200,1489627800,'',0,0,1489474687,1489474687,0),('e0f57f8d2549d36c59c9d434877103fd',19,1489797000,1489798800,'',0,0,1489474658,1489474658,0),('fa497c081ee02ae7148f4093762a87fc',18,1489537800,1489541400,'',0,0,1489474687,1489474687,0),('fe02cf7e6367db079d68a45404230417',19,1489714200,1489716000,'',0,0,1489476083,1489476083,0);
/*!40000 ALTER TABLE `tp_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_group`
--

DROP TABLE IF EXISTS `tp_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_group` (
  `groupID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表示小班的课程主键ID',
  `groupName` varchar(256) NOT NULL DEFAULT '' COMMENT '表示小班的名称',
  `material` varchar(256) NOT NULL DEFAULT '' COMMENT '表示教材，与tp_orderpackage中字段相同，教材ID:教材名称:教材类型',
  `status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '表示小班的有效状态,0表示失效，1表示有效',
  `gcategory` int(10) unsigned DEFAULT NULL COMMENT '表示课程类型，与packageconfig表中的数据一一对应',
  `gclassNumber` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示课程数量，该字段中的数据直接来自套餐中的数据',
  `gstudentNumber` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示小班的人数，来自对应的套餐数据',
  `gteacherType` int(10) unsigned DEFAULT NULL COMMENT '表示教师类别，0表示中教，1表示外教',
  `gteacherLevel` int(10) unsigned DEFAULT NULL COMMENT '表示教师级别，0普通教师，1表示名教',
  `gotherClassNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示额外的课程数量',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示创建时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示数据是否删除，0表示没有，1表示删除',
  PRIMARY KEY (`groupID`),
  KEY `gcategory_packageconfig` (`gcategory`),
  CONSTRAINT `gcategory_packageconfig` FOREIGN KEY (`gcategory`) REFERENCES `tp_packageconfig` (`packageconID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_group`
--

LOCK TABLES `tp_group` WRITE;
/*!40000 ALTER TABLE `tp_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_groupclasssch`
--

DROP TABLE IF EXISTS `tp_groupclasssch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_groupclasssch` (
  `groupClassSchID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '班级课表的ID',
  `groupID` int(10) unsigned DEFAULT NULL COMMENT '班级ID，用来表示该课表是哪个班的',
  `classID` varchar(40) DEFAULT NULL COMMENT '教师时间段的ID   用来表示教师以及教师的空余时间',
  `gclassStatus` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示班级课程的上课状况\r\n\r\n0未上课\r\n1正常上课\r\n2学生退课\r\n3教师早退\r\n4教师迟到\r\n5教师缺课\r\n6教师退课\r\n7意外情况',
  `gteacherComment` int(10) unsigned DEFAULT NULL COMMENT '表示教师对本次小班课程的评论',
  `statusRemark` text NOT NULL COMMENT '表示本次课程状态的说明',
  `note` text NOT NULL COMMENT '小班课的笔记',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示本条数据的创建时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示本条数据是否删除，0没有，1删除',
  PRIMARY KEY (`groupClassSchID`),
  KEY `gclassSch_group` (`groupID`),
  KEY `gclassSch_class` (`classID`),
  KEY `gclassSch_groupteachercom` (`gteacherComment`),
  CONSTRAINT `gclassSch_class` FOREIGN KEY (`classID`) REFERENCES `tp_class` (`classID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `gclassSch_group` FOREIGN KEY (`groupID`) REFERENCES `tp_group` (`groupID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `gclassSch_groupteachercom` FOREIGN KEY (`gteacherComment`) REFERENCES `tp_groupteachercom` (`groupTeacherComID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_groupclasssch`
--

LOCK TABLES `tp_groupclasssch` WRITE;
/*!40000 ALTER TABLE `tp_groupclasssch` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_groupclasssch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_groupstuclasssch`
--

DROP TABLE IF EXISTS `tp_groupstuclasssch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_groupstuclasssch` (
  `groupStuClassSchID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '学生个人小班课表ID',
  `studentID` int(10) unsigned DEFAULT NULL COMMENT '学生的ID',
  `groupClassSchID` int(10) unsigned DEFAULT NULL COMMENT '表示班级课表的ID',
  `orderPackageID` int(10) unsigned DEFAULT NULL COMMENT '学生使用的订购的套餐，表示学生使用哪个套餐订购了该节小班课',
  `stuClassStatus` int(10) unsigned NOT NULL COMMENT '表示学生对于该节课的上课情况\r\n\r\n0未上课\r\n1正常上课\r\n2学生退课',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示创建时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数据是否删除，0没有，1删除',
  PRIMARY KEY (`groupStuClassSchID`),
  KEY `groupStuClassSch_register` (`studentID`),
  KEY `groupClassSchID_groupCLassSch` (`groupClassSchID`),
  KEY `groupOrderPac_OrderPackage` (`orderPackageID`),
  CONSTRAINT `groupClassSchID_groupCLassSch` FOREIGN KEY (`groupClassSchID`) REFERENCES `tp_groupclasssch` (`groupClassSchID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `groupOrderPac_OrderPackage` FOREIGN KEY (`orderPackageID`) REFERENCES `tp_orderpackage` (`orderpackageID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `groupStuClassSch_register` FOREIGN KEY (`studentID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_groupstuclasssch`
--

LOCK TABLES `tp_groupstuclasssch` WRITE;
/*!40000 ALTER TABLE `tp_groupstuclasssch` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_groupstuclasssch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_groupteachercom`
--

DROP TABLE IF EXISTS `tp_groupteachercom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_groupteachercom` (
  `groupTeacherComID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表示教师的小班评论主键ID',
  `groupClassSchID` int(10) unsigned DEFAULT NULL COMMENT '表示受评论的班级的评论班级课表ID',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '表示教师的ID',
  `gCommentLevel` varchar(256) NOT NULL DEFAULT '' COMMENT '表示评论的级别',
  `gCommentContent` text NOT NULL COMMENT '表示评论的内容',
  `gComStartTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示评论开始时间(对于小班的日评来说，开始时间就是小班的结束时间)',
  `gComEndTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示评论结束时间(表示真正的评论时间)',
  `gComDeadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示最后的截止时间',
  `gComStatus` int(10) unsigned DEFAULT NULL COMMENT '评论状态   与一对一的教师评论相同  ****:****:****\r\n第一个表示评论类型\r\n0日评\r\n\r\n第二个表示评论的结果\r\n0教师完成评论\r\n1教师没有完成评论\r\n2自动完成评论\r\n3还没有进行评论\r\n\r\n第三个表示教师是否需要进行评论\r\n0需要\r\n1不需要',
  `gCurProcess` varchar(256) NOT NULL DEFAULT '' COMMENT '表示当前的进度',
  `gFuProcess` varchar(256) NOT NULL DEFAULT '' COMMENT '表示未来的进度',
  `gCreateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示数据创建时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示数据是否删除  0没有，1删除',
  PRIMARY KEY (`groupTeacherComID`),
  KEY `groupTeacherCom_groupClassSch` (`groupClassSchID`),
  KEY `groupTeacherCom_register` (`teacherID`),
  CONSTRAINT `groupTeacherCom_groupClassSch` FOREIGN KEY (`groupClassSchID`) REFERENCES `tp_groupclasssch` (`groupClassSchID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `groupTeacherCom_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_groupteachercom`
--

LOCK TABLES `tp_groupteachercom` WRITE;
/*!40000 ALTER TABLE `tp_groupteachercom` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_groupteachercom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_oneorderclass`
--

DROP TABLE IF EXISTS `tp_oneorderclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_oneorderclass` (
  `oneorderclassID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '一对一课程的主键ID',
  `studentID` int(10) unsigned DEFAULT NULL COMMENT '学生的ID',
  `classID` varchar(40) DEFAULT NULL COMMENT '课程的ID，用来表示课程的上课时间以及教师',
  `orderpackageID` int(10) unsigned DEFAULT NULL COMMENT '表示学生订购的套餐的ID,用来表示是哪个订购的套餐订购的课程',
  `bookID` int(10) unsigned DEFAULT NULL COMMENT '表示教材的ID，用来指定是哪本教材(该字段可能是不需要的，订购套餐表中有指定)',
  `classStatus` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示学生的订购的课程的课程结果\r\n0未上课\r\n1正常上课\r\n2学生退课\r\n3教师早退\r\n4教师迟到\r\n5教师缺课\r\n6教师退课\r\n7意外情况',
  `statusRemark` varchar(256) NOT NULL DEFAULT '' COMMENT '教师的课程状态的说明',
  `isdelete` int(10) unsigned DEFAULT '0' COMMENT '0没有，1删除',
  `studentComment` int(10) unsigned DEFAULT NULL COMMENT '表示学生对教师评论的ID，',
  `teacherComment` int(10) unsigned DEFAULT NULL COMMENT '表示的是教师对学生评价ID',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `note` text NOT NULL COMMENT '课程笔记',
  `toProgress` text NOT NULL COMMENT '总进度',
  `curProgress` text NOT NULL COMMENT '当前的进度',
  PRIMARY KEY (`oneorderclassID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_oneorderclass`
--

LOCK TABLES `tp_oneorderclass` WRITE;
/*!40000 ALTER TABLE `tp_oneorderclass` DISABLE KEYS */;
INSERT INTO `tp_oneorderclass` VALUES (32,20,'9986f475c356b02b1d6ecc0eb85a74a4',43,NULL,0,'',0,NULL,NULL,1489474721,'','',''),(33,21,'04b88a2bf87cd7602e53b8d3738ff866',40,NULL,1,'',0,1,1,1489474806,'规划局规划局规划局','',''),(34,20,'0fb86a5e9ee947cf8df78deb52d61fc2',43,NULL,2,'',0,NULL,NULL,1489474835,'','',''),(35,20,'999a156809e05b8d4d4404e91f8bc22a',43,NULL,2,'',0,NULL,NULL,1489474835,'','',''),(36,21,'0fb86a5e9ee947cf8df78deb52d61fc2',40,NULL,0,'',0,NULL,NULL,1489537872,'','',''),(37,21,'195325ec49077d50b43bb39e80bcbdc5',42,NULL,2,'',0,2,NULL,1489537913,'','',''),(38,21,'999a156809e05b8d4d4404e91f8bc22a',42,NULL,5,'',0,3,NULL,1489538248,'','',''),(39,21,'348809dc06670dd04f19d7a9c4c26aa8',42,NULL,2,'',0,NULL,NULL,1489538310,'','',''),(40,21,'33c170876d1d674193296b8fc6a28d23',42,NULL,2,'',0,NULL,NULL,1489538310,'','',''),(41,21,'33c170876d1d674193296b8fc6a28d23',42,NULL,2,'',0,NULL,NULL,1489366244,'','',''),(42,21,'181aaae17acdc6f5280b488409fa8f1e',42,NULL,2,'',0,NULL,NULL,1489366254,'','',''),(43,21,'181aaae17acdc6f5280b488409fa8f1e',40,NULL,2,'',0,NULL,NULL,1489366912,'','',''),(44,21,'421f20c64180aa40e2e7890e1e13c393',42,NULL,2,'',0,NULL,NULL,1489367605,'','',''),(45,21,'5a8e6459d4285b46730a8b3cb4522dc6',42,NULL,0,'',0,NULL,NULL,1489367669,'','',''),(46,21,'181aaae17acdc6f5280b488409fa8f1e',42,NULL,2,'',0,NULL,NULL,1489367736,'','',''),(47,21,'d5f8f5ec782a7c1fcd9ceadd0ba24d50',40,NULL,2,'',0,NULL,NULL,1489367736,'','',''),(48,21,'d5f8f5ec782a7c1fcd9ceadd0ba24d50',40,NULL,2,'',0,NULL,NULL,1489367925,'','',''),(49,21,'181aaae17acdc6f5280b488409fa8f1e',42,NULL,2,'',0,NULL,NULL,1489367925,'','',''),(50,21,'d5f8f5ec782a7c1fcd9ceadd0ba24d50',40,NULL,2,'',0,NULL,NULL,1489368016,'','',''),(51,21,'e0f57f8d2549d36c59c9d434877103fd',42,NULL,2,'',0,NULL,NULL,1489368016,'','',''),(52,21,'d5f8f5ec782a7c1fcd9ceadd0ba24d50',40,NULL,2,'',0,NULL,NULL,1489368120,'','',''),(53,21,'d5f8f5ec782a7c1fcd9ceadd0ba24d50',42,NULL,2,'',0,NULL,NULL,1489368573,'','',''),(54,21,'d5f8f5ec782a7c1fcd9ceadd0ba24d50',40,NULL,0,'',0,NULL,NULL,1489368617,'','',''),(55,21,'33c170876d1d674193296b8fc6a28d23',42,NULL,0,'',0,NULL,NULL,1489624085,'','',''),(56,21,'bfbeae2c2f678a76746a5aec7e2d9005',42,NULL,0,'',0,NULL,NULL,1489624085,'','',''),(57,21,'348809dc06670dd04f19d7a9c4c26aa8',40,NULL,2,'',0,NULL,NULL,1489190983,'','',''),(58,21,'77d250486f11199adcf44bf5d6345221',42,NULL,2,'',0,NULL,NULL,1489191004,'','',''),(59,21,'fe02cf7e6367db079d68a45404230417',42,NULL,6,'',0,NULL,NULL,1489191004,'','',''),(60,21,'348809dc06670dd04f19d7a9c4c26aa8',40,NULL,0,'',0,NULL,NULL,1489191139,'','',''),(61,21,'421f20c64180aa40e2e7890e1e13c393',42,NULL,0,'',0,NULL,NULL,1489191146,'','','');
/*!40000 ALTER TABLE `tp_oneorderclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_onestudentcom`
--

DROP TABLE IF EXISTS `tp_onestudentcom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_onestudentcom` (
  `onestudentcommentID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '一对一课程学生对教师的评价',
  `studentID` int(10) unsigned DEFAULT NULL COMMENT '表示是哪个学生评论的',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '表示的是评价的教师的ID',
  `commentlevel` varchar(32) NOT NULL DEFAULT '' COMMENT '评价的等级',
  `commentcontent` text NOT NULL COMMENT '评级的内容',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0没有，1删除',
  PRIMARY KEY (`onestudentcommentID`),
  KEY `oneorderclasstea_register` (`teacherID`),
  KEY `onestudentcom_register` (`studentID`),
  CONSTRAINT `oneorderclasstea_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `onestudentcom_register` FOREIGN KEY (`studentID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_onestudentcom`
--

LOCK TABLES `tp_onestudentcom` WRITE;
/*!40000 ALTER TABLE `tp_onestudentcom` DISABLE KEYS */;
INSERT INTO `tp_onestudentcom` VALUES (1,21,19,'A(老师非常棒 excellent)','',1489625791,0),(2,21,19,'C(老师还行 qualified)','',1489625796,0),(3,21,19,'E(非常不满意 terrible)','',1489625800,0);
/*!40000 ALTER TABLE `tp_onestudentcom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_oneteachercom`
--

DROP TABLE IF EXISTS `tp_oneteachercom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_oneteachercom` (
  `oneteachercomID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '一对一课程中，老师对学生的评价主键ID',
  `studentID` int(10) unsigned DEFAULT NULL COMMENT '表示要被评论的',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '表示是哪个教师评论的',
  `commentlevel` varchar(256) NOT NULL DEFAULT '' COMMENT '表示评论的等级',
  `commentcontent` text NOT NULL COMMENT '表示评论的内容',
  `comStartTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示评论的开始时间\r\n对于日评：该时间为课程结束时间\r\n对于周评，月评：该时间为评论生成时间',
  `comEndTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示评论的时间点',
  `comDeadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示评论的截止时间\r\n日评为：课程结束时间+规定时间段\r\n周评，月评为：创建时间+规定时间段\r\n',
  `comStatus` varchar(255) NOT NULL DEFAULT '' COMMENT '表示该条评论的状态，记录的形式是\r\n*****:*****:*****\r\n最前面的表示：评论的类型：\r\n0日评，1周评，2月评，3试听课评论\r\n\r\n中间的表示：评论的最终状态\r\n0教师完成评论，\r\n1教师没有完成评论，\r\n2自动完成评论\r\n3教师还没有进行课程贫评价\r\n\r\n最后的表示：教师是否需要进行评论\r\n0需要，1不需要',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `curProgress` varchar(256) NOT NULL DEFAULT '' COMMENT '当前进度',
  `furProgress` varchar(256) NOT NULL DEFAULT '' COMMENT '未来的进度',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除,0没有，1删除',
  PRIMARY KEY (`oneteachercomID`),
  KEY `onetecom_register` (`teacherID`),
  KEY `onestucom_register` (`studentID`),
  CONSTRAINT `onestucom_register` FOREIGN KEY (`studentID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `onetecom_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_oneteachercom`
--

LOCK TABLES `tp_oneteachercom` WRITE;
/*!40000 ALTER TABLE `tp_oneteachercom` DISABLE KEYS */;
INSERT INTO `tp_oneteachercom` VALUES (1,21,19,'A(excellent)','规范化的结果回复结果回复',1489539600,1489622563,1489626000,'0:0:0',1489622563,'100','200',0);
/*!40000 ALTER TABLE `tp_oneteachercom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_orderpackage`
--

DROP TABLE IF EXISTS `tp_orderpackage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_orderpackage` (
  `orderpackageID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订购套餐的编号',
  `studentID` int(10) unsigned DEFAULT NULL COMMENT '学生ID，用来表示是哪个学生购买了该套餐',
  `category` int(10) unsigned DEFAULT NULL COMMENT '课程类型，与packageconfig表中的字段是有对应的',
  `classType` int(10) unsigned DEFAULT NULL COMMENT '课程类别，0一对一，1小班课',
  `packageType` int(10) unsigned DEFAULT NULL COMMENT '套餐类别，0课时类套餐，1卡类套餐',
  `studentNumber` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生人数',
  `classNumber` int(10) unsigned DEFAULT '0' COMMENT '课时数量',
  `teacherNation` int(10) unsigned DEFAULT NULL COMMENT '教师的类型，0,中教，1外教',
  `teacherType` int(10) unsigned DEFAULT NULL COMMENT '0普通，1名师',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效期，按天算',
  `packageName` varchar(256) NOT NULL DEFAULT '' COMMENT '套餐名',
  `packageContent` text NOT NULL COMMENT '套餐说明',
  `packageMoney` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐价格',
  `haveClass` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已经上过的课时数量   针对课时类套餐是有用的（该字段不再进行使用）\r\n使用统计学生正常上课的课程数量来进行代替',
  `otherClass` int(10) NOT NULL DEFAULT '0' COMMENT '另外赠送的课时数量',
  `status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '0失效，1有效',
  `startTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐的有效的开始时间',
  `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐有效的结束时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0没有，1删除',
  `packageCreateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐创建时间',
  `packageLastModify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐最后的修改时间',
  `material` varchar(256) NOT NULL DEFAULT '' COMMENT '每个订购套餐对应的教材的信息，如果是一对一的课程就在这里设置教材信息，教材ID;教材名称;教材类型',
  `delayTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '该套餐已经延期的天数，单位是天',
  PRIMARY KEY (`orderpackageID`),
  KEY `orderpackage_register` (`studentID`),
  CONSTRAINT `orderpackage_register` FOREIGN KEY (`studentID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_orderpackage`
--

LOCK TABLES `tp_orderpackage` WRITE;
/*!40000 ALTER TABLE `tp_orderpackage` DISABLE KEYS */;
INSERT INTO `tp_orderpackage` VALUES (40,21,2,0,1,1,0,1,0,30,'雅思普通外教卡类','雅思普通外教卡类',10,0,0,1,1489537682,1492129682,0,1489471276,1489471276,'10:雅思:2',0),(42,21,1,0,0,1,8,1,1,30,'成人名师外教课时','成人名师外教课时',10,0,0,1,1489624518,1492216518,0,1489471519,1489471519,'9:成人:1',0),(43,20,2,0,1,1,0,1,0,30,'雅思普通外教卡类','雅思普通外教卡类',10,0,0,1,2145888000,2145888000,0,1489471556,1489471556,'10:雅思:2',0),(44,20,5,0,0,1,8,0,0,30,'少儿普通中教课时','少儿普通中教课时\r\n',10,0,0,1,2145888000,2145888000,0,1489471563,1489471563,'8:少儿:5',0),(45,21,5,0,0,1,8,0,0,30,'少儿普通中教课时','少儿普通中教课时\r\n',10,0,0,1,2145888000,2145888000,0,1489367548,1489367548,'8:少儿:5',0);
/*!40000 ALTER TABLE `tp_orderpackage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_package`
--

DROP TABLE IF EXISTS `tp_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_package` (
  `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐id',
  `category` int(10) unsigned DEFAULT NULL COMMENT '0少儿，1成人，2雅思   以后还有各种新的数据\r\n数据直接来自套餐配置表\r\n主要的套餐类型影响字段,',
  `class_type` int(10) unsigned DEFAULT NULL COMMENT '0一对一，1小班',
  `package_type` tinyint(1) unsigned DEFAULT NULL COMMENT '0.课时类套餐,1.卡类套餐',
  `student_number` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '套餐的人数，小班课程可以改数量，一对一限定是1人',
  `class_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '课时数,一对一的课程分为课时类和卡类，小班课只能是小班课',
  `teacher_nation` int(10) unsigned DEFAULT NULL COMMENT '0中教，1外教',
  `teacher_type` tinyint(1) unsigned DEFAULT NULL COMMENT '0普通，1名师。这个是和上面的category字段一起用的，例如普通少儿类，普通成人类，普通月卡类，名师月卡类',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐的有效期，卡类，课时类通用',
  `package_name` varchar(256) NOT NULL DEFAULT '' COMMENT '套餐名',
  `package_content` text COMMENT '套餐内容.存放的是开这个套餐时的内容说明',
  `package_money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐价格',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `last_modify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `isdelete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0表示没有，1表示是。用于标记该条数据是否存在',
  PRIMARY KEY (`package_id`),
  KEY `packagecategory_config` (`category`),
  CONSTRAINT `packagecategory_config` FOREIGN KEY (`category`) REFERENCES `tp_packageconfig` (`packageconID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_package`
--

LOCK TABLES `tp_package` WRITE;
/*!40000 ALTER TABLE `tp_package` DISABLE KEYS */;
INSERT INTO `tp_package` VALUES (12,5,0,0,1,8,0,0,30,'少儿普通中教课时','少儿普通中教课时\r\n',10,1489470689,1489470689,0),(13,1,0,0,1,8,1,1,30,'成人名师外教课时','成人名师外教课时',10,1489470034,1489470034,0),(14,1,0,0,1,0,0,0,0,'','',0,1489470296,1489470296,1),(15,1,0,0,1,0,0,0,0,'','',0,1489470126,1489470126,1),(16,1,0,0,1,0,0,0,0,'','',0,1489470203,1489470203,1),(17,1,0,0,1,0,0,0,0,'','',0,1489470697,1489470697,1),(18,2,0,1,1,0,1,0,30,'雅思普通外教卡类','雅思普通外教卡类',10,1489470936,1489470936,0);
/*!40000 ALTER TABLE `tp_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_packageconfig`
--

DROP TABLE IF EXISTS `tp_packageconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_packageconfig` (
  `packageconID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `packageName` varchar(256) NOT NULL DEFAULT '' COMMENT '套餐的名称',
  PRIMARY KEY (`packageconID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_packageconfig`
--

LOCK TABLES `tp_packageconfig` WRITE;
/*!40000 ALTER TABLE `tp_packageconfig` DISABLE KEYS */;
INSERT INTO `tp_packageconfig` VALUES (1,'成人'),(2,'雅思'),(5,'少儿');
/*!40000 ALTER TABLE `tp_packageconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_register`
--

DROP TABLE IF EXISTS `tp_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_register` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '注册号',
  `account` varchar(64) NOT NULL COMMENT '用户账号名',
  `password` varchar(256) NOT NULL,
  `country` varchar(64) NOT NULL COMMENT '国家,对课程顾问，root，学生来讲是地址信息，对教师来讲是国籍',
  `status` tinyint(1) unsigned NOT NULL COMMENT '0表示禁用，1表示正常',
  `chinesename` varchar(128) NOT NULL,
  `englishname` varchar(128) NOT NULL COMMENT '英文账号',
  `email` varchar(128) NOT NULL COMMENT '邮箱',
  `phone` varchar(128) NOT NULL COMMENT '联系方式',
  `skype` varchar(128) NOT NULL,
  `QQ` varchar(64) NOT NULL COMMENT 'QQ',
  `age` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '年龄',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0女，1男',
  `weixin` varchar(64) NOT NULL COMMENT '微信',
  `openID` varchar(64) NOT NULL COMMENT '给微信使用',
  `image_path` varchar(256) NOT NULL COMMENT '头像路径',
  `accept_time` int(10) unsigned NOT NULL COMMENT '学生被接受的时间',
  `student_cancel_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生可以取消的课程数',
  `student_sum_money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生账户余额',
  `student_manage_id` int(10) unsigned DEFAULT NULL COMMENT '学生的课程顾问',
  `introduction` text COMMENT '教师文字简介',
  `video_path` varchar(256) NOT NULL COMMENT '自我介绍视频路径',
  `zoom` varchar(128) DEFAULT NULL COMMENT 'zoom号，给教师使用',
  `identity` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '身份表示，0学生，1教师，2课程顾问，3中级，4高级',
  `teacher_type` tinyint(1) unsigned NOT NULL COMMENT '0中教，1外教',
  `level` varchar(10000) DEFAULT '' COMMENT '表示教师对应的各种课程的程度，如：少儿是名师还是普通',
  `paypal` varchar(256) NOT NULL COMMENT 'paypal,付款方式的一种',
  `bankcard` varchar(256) NOT NULL COMMENT '银行卡',
  `teachercertification` varchar(256) DEFAULT NULL COMMENT '教师资格证',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '信息创建时间',
  `last_modify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `simplevideo` varchar(256) NOT NULL DEFAULT '' COMMENT '教师的案例视频',
  `teachercomment` text NOT NULL COMMENT '公司对老师的评价',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `register_email` (`email`) USING BTREE,
  UNIQUE KEY `register_phone` (`phone`) USING BTREE,
  UNIQUE KEY `register_account` (`account`) USING BTREE,
  KEY `student_manager` (`student_manage_id`),
  CONSTRAINT `student_manager` FOREIGN KEY (`student_manage_id`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_register`
--

LOCK TABLES `tp_register` WRITE;
/*!40000 ALTER TABLE `tp_register` DISABLE KEYS */;
INSERT INTO `tp_register` VALUES (17,'root','e10adc3949ba59abbe56e057f20f883e','',1,'','','','','','',0,0,'','','',0,0,0,NULL,NULL,'',NULL,4,0,'','','',NULL,0,0,'',''),(18,'c_teacher1','e10adc3949ba59abbe56e057f20f883e','中国',1,'中教普通','zj_pt','15321351@qq.com','1231516315','','',0,0,'','','',0,0,0,NULL,NULL,'','https://www.baidu.com/',1,0,'','','',NULL,0,0,'','111111111'),(19,'e_teacher1','e10adc3949ba59abbe56e057f20f883e','英国',1,'外教名师','wj_ms','132135315@qq.com','12354132132','','',0,0,'','','',0,0,0,NULL,NULL,'','https://www.baidu.com/',1,1,'','','',NULL,0,0,'','萨顶顶撒多撒多'),(20,'俞鹏泽','e10adc3949ba59abbe56e057f20f883e','中国杭州',1,'俞鹏泽','yupengze','1436372607@qq.com','17855833070','yuskype','1436372607',23,1,'weixin','','',0,0,80,22,NULL,'',NULL,0,0,'','','',NULL,0,0,'',''),(21,'蒋周杰','e10adc3949ba59abbe56e057f20f883e','中国',1,'蒋周杰','jiangzhoujie','565596662@qq.com','15757469199','','sadasdsad',22,1,'weixin','','/liuliu/UserImage/58c9d7e8ae9a0.jpg',0,5,80,22,NULL,'',NULL,0,0,'','','',NULL,0,0,'',''),(22,'admin','e10adc3949ba59abbe56e057f20f883e','',1,'课程顾问','','12318515@qq.com','14562587455','','135413515',0,1,'','','',0,0,0,NULL,NULL,'',NULL,2,0,'','','',NULL,0,0,'','');
/*!40000 ALTER TABLE `tp_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tp_root`
--

DROP TABLE IF EXISTS `tp_root`;
/*!50001 DROP VIEW IF EXISTS `tp_root`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tp_root` (
  `ID` tinyint NOT NULL,
  `account` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `chinesename` tinyint NOT NULL,
  `englishname` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `phone` tinyint NOT NULL,
  `skype` tinyint NOT NULL,
  `QQ` tinyint NOT NULL,
  `weixin` tinyint NOT NULL,
  `openID` tinyint NOT NULL,
  `identity` tinyint NOT NULL,
  `create_time` tinyint NOT NULL,
  `last_modify` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tp_sendclassnum`
--

DROP TABLE IF EXISTS `tp_sendclassnum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_sendclassnum` (
  `sendclassID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sendParty` int(10) unsigned DEFAULT NULL COMMENT '赠送课程的人',
  `sendedParty` int(10) unsigned DEFAULT NULL COMMENT '呗赠送课时的人',
  `sendNum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赠送数量，当赠送课时给一对一套餐时，表示赠送其课时数，如果赠送的是卡类套餐，则是赠送时间',
  `sendTime` int(10) unsigned NOT NULL COMMENT '赠送的时间,赠送时间',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `remark` text NOT NULL COMMENT '赠送说明',
  PRIMARY KEY (`sendclassID`),
  KEY `send_register` (`sendParty`),
  KEY `sened_register` (`sendedParty`),
  CONSTRAINT `send_register` FOREIGN KEY (`sendParty`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `sened_register` FOREIGN KEY (`sendedParty`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_sendclassnum`
--

LOCK TABLES `tp_sendclassnum` WRITE;
/*!40000 ALTER TABLE `tp_sendclassnum` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_sendclassnum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_stopclass`
--

DROP TABLE IF EXISTS `tp_stopclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_stopclass` (
  `stopclassID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表示停课数据表的主键',
  `studentID` int(10) unsigned DEFAULT NULL COMMENT '用来表示是那个学生要求停课',
  `operaterID` int(10) unsigned DEFAULT NULL COMMENT '用来表示谁操作该条数据使之能有效使用',
  `stopStartTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示停课的开始时间',
  `stopEndTime` int(10) unsigned NOT NULL COMMENT '表示停课的结束时间',
  `failureTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示该条数据的真正失效时间，在取消停课时或者超过预订的停课时间时进行设置，当该值进行设置时，一般status值也要进行设置',
  `reason` text NOT NULL COMMENT '表示停课理由',
  `status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '表示该条数据是否具有使用权限，如果是失效状态，就只能进行删除，0表示失效，1表示有效',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示该条数据的生成时间',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示该条数据的存在性，逻辑上的存在，0表示没有删除，1表示删除了',
  PRIMARY KEY (`stopclassID`),
  KEY `stopstu_register` (`studentID`),
  KEY `stoptea_register` (`operaterID`),
  CONSTRAINT `stopstu_register` FOREIGN KEY (`studentID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `stoptea_register` FOREIGN KEY (`operaterID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_stopclass`
--

LOCK TABLES `tp_stopclass` WRITE;
/*!40000 ALTER TABLE `tp_stopclass` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_stopclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tp_student`
--

DROP TABLE IF EXISTS `tp_student`;
/*!50001 DROP VIEW IF EXISTS `tp_student`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tp_student` (
  `ID` tinyint NOT NULL,
  `account` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `country` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `chinesename` tinyint NOT NULL,
  `englishname` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `phone` tinyint NOT NULL,
  `skype` tinyint NOT NULL,
  `QQ` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `sex` tinyint NOT NULL,
  `weixin` tinyint NOT NULL,
  `image_path` tinyint NOT NULL,
  `accept_time` tinyint NOT NULL,
  `student_cancel_number` tinyint NOT NULL,
  `student_sum_money` tinyint NOT NULL,
  `student_manage_id` tinyint NOT NULL,
  `identity` tinyint NOT NULL,
  `create_time` tinyint NOT NULL,
  `last_modify` tinyint NOT NULL,
  `openID` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tp_studentcontract`
--

DROP TABLE IF EXISTS `tp_studentcontract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_studentcontract` (
  `ordercontractID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订购的合同id号',
  `orderpackageID` int(10) unsigned DEFAULT NULL COMMENT '订购的合同的ID编号',
  `order_party` int(10) unsigned DEFAULT NULL COMMENT '订购方的ID，一般是指学生的ID号',
  `isSign` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0没有，1签署',
  `signTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签署时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `last_modify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  PRIMARY KEY (`ordercontractID`),
  KEY `orderpackage_studentcontract` (`orderpackageID`),
  KEY `student_studentcontract` (`order_party`),
  CONSTRAINT `orderpackage_studentcontract` FOREIGN KEY (`orderpackageID`) REFERENCES `tp_orderpackage` (`orderpackageID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `student_studentcontract` FOREIGN KEY (`order_party`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_studentcontract`
--

LOCK TABLES `tp_studentcontract` WRITE;
/*!40000 ALTER TABLE `tp_studentcontract` DISABLE KEYS */;
INSERT INTO `tp_studentcontract` VALUES (21,40,21,1,1489537682,1489471276,1489471276),(22,42,21,1,1489624518,1489471519,1489471519),(23,43,20,0,0,1489471556,1489471556),(24,44,20,0,0,1489471563,1489471563),(25,45,21,0,0,1489367548,1489367548);
/*!40000 ALTER TABLE `tp_studentcontract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_studentopaccount`
--

DROP TABLE IF EXISTS `tp_studentopaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_studentopaccount` (
  `ope_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '学生账号id',
  `student_id` int(10) unsigned DEFAULT NULL COMMENT '学生id',
  `remark` text NOT NULL COMMENT '备注',
  `ope_time` int(10) unsigned DEFAULT NULL COMMENT '操作时间',
  `ope_money` int(10) NOT NULL DEFAULT '0' COMMENT '操作的金额',
  `ope_type` tinyint(1) DEFAULT NULL COMMENT '操作类型，0余额，1支付宝，2银行卡,如果数据是null表示没有是支出',
  PRIMARY KEY (`ope_id`),
  KEY `studentaccount_register` (`student_id`),
  CONSTRAINT `studentaccount_register` FOREIGN KEY (`student_id`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_studentopaccount`
--

LOCK TABLES `tp_studentopaccount` WRITE;
/*!40000 ALTER TABLE `tp_studentopaccount` DISABLE KEYS */;
INSERT INTO `tp_studentopaccount` VALUES (17,21,'你购买雅思套餐花了10元',1489471276,-10,0),(18,20,'你购买雅思套餐花了10元',1489471556,-10,0),(19,20,'你购买少儿套餐花了10元',1489471563,-10,0),(20,21,'你购买少儿套餐花了10元',1489367548,-10,0);
/*!40000 ALTER TABLE `tp_studentopaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_systemset`
--

DROP TABLE IF EXISTS `tp_systemset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_systemset` (
  `systemID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统设置主键',
  `appointCourseDeadline` int(10) unsigned NOT NULL DEFAULT '7200' COMMENT '学生在该课程开始之前多少时间可以订课，默认是2小时',
  `classRemindTime` int(10) unsigned NOT NULL DEFAULT '14400' COMMENT '学生上课前多少时间内选课要发送邮件提醒老师，默认是4小时',
  `cancelCourseDeadline` int(10) unsigned NOT NULL DEFAULT '43200' COMMENT '学生在订课之后，在上课前多少时间不能退课（仅仅对学生自己退课操作有效），默认12小时',
  `remindStartTime` int(10) unsigned NOT NULL DEFAULT '43200' COMMENT '课程取消前多少时间要发邮件提醒教师，这是开始时间，默认12小时',
  `remindEndTime` int(10) unsigned NOT NULL DEFAULT '86400' COMMENT '课程取消前多少时间要发邮件提醒教师，这是结尾时间，默认24小时',
  `buttonEffectTime` int(10) unsigned NOT NULL DEFAULT '300' COMMENT '开课前多少时间，按钮生效时间，默认5分钟',
  `buttonLostTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上课之后多少时间失效，默认0分钟',
  `monthDeadline` int(10) unsigned NOT NULL DEFAULT '172800' COMMENT '月评截止时间，默认48小时',
  `weekDeadline` int(10) unsigned NOT NULL DEFAULT '86400' COMMENT '周评截止时间，默认是24小时',
  `dayDeadline` int(10) unsigned NOT NULL DEFAULT '86400' COMMENT '一对一课程评价截止时间，默认24小时',
  `groupDeadline` int(10) unsigned NOT NULL DEFAULT '86400' COMMENT '小班课评价截止时间，默认24小时',
  `cancelClassRate` int(10) unsigned NOT NULL DEFAULT '4' COMMENT '学生购买套餐时可以取消的课程次数比率，默认是4',
  PRIMARY KEY (`systemID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_systemset`
--

LOCK TABLES `tp_systemset` WRITE;
/*!40000 ALTER TABLE `tp_systemset` DISABLE KEYS */;
INSERT INTO `tp_systemset` VALUES (1,7200,14400,43200,43200,86400,300,0,172800,86400,86400,86400,4);
/*!40000 ALTER TABLE `tp_systemset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `tp_teacher`
--

DROP TABLE IF EXISTS `tp_teacher`;
/*!50001 DROP VIEW IF EXISTS `tp_teacher`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `tp_teacher` (
  `ID` tinyint NOT NULL,
  `account` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `country` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `chinesename` tinyint NOT NULL,
  `englishname` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `phone` tinyint NOT NULL,
  `skype` tinyint NOT NULL,
  `QQ` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `sex` tinyint NOT NULL,
  `weixin` tinyint NOT NULL,
  `openID` tinyint NOT NULL,
  `image_path` tinyint NOT NULL,
  `accept_time` tinyint NOT NULL,
  `introduction` tinyint NOT NULL,
  `video_path` tinyint NOT NULL,
  `zoom` tinyint NOT NULL,
  `identity` tinyint NOT NULL,
  `teacher_type` tinyint NOT NULL,
  `level` tinyint NOT NULL,
  `paypal` tinyint NOT NULL,
  `bankcard` tinyint NOT NULL,
  `teachercertification` tinyint NOT NULL,
  `create_time` tinyint NOT NULL,
  `last_modify` tinyint NOT NULL,
  `simplevideo` tinyint NOT NULL,
  `teachercomment` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tp_teachercontract`
--

DROP TABLE IF EXISTS `tp_teachercontract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_teachercontract` (
  `teachercontractID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '教师的合同ID',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '教师ID',
  `contractPath` varchar(512) NOT NULL DEFAULT '' COMMENT '合同存放位置',
  `uploadeTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0表示没有，1表示是。是否删除',
  PRIMARY KEY (`teachercontractID`),
  KEY `teacherID_register` (`teacherID`),
  CONSTRAINT `teacherID_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_teachercontract`
--

LOCK TABLES `tp_teachercontract` WRITE;
/*!40000 ALTER TABLE `tp_teachercontract` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_teachercontract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_teacommentrateset`
--

DROP TABLE IF EXISTS `tp_teacommentrateset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_teacommentrateset` (
  `teacommentratesetID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表示教师的评论的主键ID',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '表示教师的ID，表示该条评论设置的数据是谁的',
  `cstarttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '该条数据的有效开始时间',
  `cendtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示该条数据的结束时间，当它',
  `commenttype` varchar(256) NOT NULL DEFAULT '' COMMENT '表示评论的类型说明\r\n使用***:***的形式来进行表示\r\n第一个表示是什么课程类型的评论，0表示一对一课程，1表示小班的课程\r\n第二个表示是什么类型的评论，0表示日评，1表示周评，2表示月评，3表示试听课的评论',
  `rate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示该种类型的评论的所占百分比',
  `islastest` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '表示是否是最新的数据，0表示不是，1表示是',
  PRIMARY KEY (`teacommentratesetID`),
  KEY `teacommentrateset_register` (`teacherID`),
  CONSTRAINT `teacommentrateset_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_teacommentrateset`
--

LOCK TABLES `tp_teacommentrateset` WRITE;
/*!40000 ALTER TABLE `tp_teacommentrateset` DISABLE KEYS */;
INSERT INTO `tp_teacommentrateset` VALUES (5,18,1488384000,1489453430,'0:0',50,0),(6,18,1488384000,2145888000,'0:1',40,1),(7,18,1488384000,2145888000,'0:2',10,1),(8,18,1488384000,2145888000,'1:0',100,1),(10,18,1489453430,1489454728,'0:0',80,0),(11,18,1489454728,2145888000,'0:0',80,1),(12,19,1488384000,2145888000,'0:0',50,1),(13,19,1488384000,2145888000,'0:1',40,1),(14,19,1488384000,2145888000,'0:2',10,1),(15,19,1488384000,2145888000,'1:0',100,1);
/*!40000 ALTER TABLE `tp_teacommentrateset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_tegroupclasssalary`
--

DROP TABLE IF EXISTS `tp_tegroupclasssalary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_tegroupclasssalary` (
  `teGroupClassSalaryID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表示教师的小班课价格ID',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '教师的ID，表示该条数据是哪个教师的',
  `groupID` int(10) unsigned DEFAULT NULL COMMENT '表示班级ID',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上小班课的价格',
  `gStartTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效的开始时间',
  `gEndTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效的结束时间',
  `gIsLastest` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '表示是否是最新的数据   0不是，1是',
  `isdelete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表示是否删除数据  0没有，1删除',
  PRIMARY KEY (`teGroupClassSalaryID`),
  KEY `teGroupCLassSalaryID_group` (`groupID`),
  KEY `teGroupCLassSalaryID-teacherID_tp_teacher` (`teacherID`),
  CONSTRAINT `teGroupCLassSalaryID-teacherID_tp_teacher` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `teGroupCLassSalaryID_group` FOREIGN KEY (`groupID`) REFERENCES `tp_group` (`groupID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_tegroupclasssalary`
--

LOCK TABLES `tp_tegroupclasssalary` WRITE;
/*!40000 ALTER TABLE `tp_tegroupclasssalary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_tegroupclasssalary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_teoneclasssalary`
--

DROP TABLE IF EXISTS `tp_teoneclasssalary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_teoneclasssalary` (
  `teOneClassSalaryID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '教师所教课程类别，',
  `teacherID` int(10) unsigned DEFAULT NULL COMMENT '教师的ID',
  `teacherType` int(10) unsigned DEFAULT NULL COMMENT '0普通，1名师',
  `scategory` int(10) unsigned DEFAULT NULL COMMENT '课程类型，其中的数据与packageconfig相同',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '教师工资',
  `vStartTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生效的开始时间',
  `vEndTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生效结束时间',
  `isLastest` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '0表示不是，1表示是',
  PRIMARY KEY (`teOneClassSalaryID`),
  KEY `onesalaryte_register` (`teacherID`),
  CONSTRAINT `onesalaryte_register` FOREIGN KEY (`teacherID`) REFERENCES `tp_register` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_teoneclasssalary`
--

LOCK TABLES `tp_teoneclasssalary` WRITE;
/*!40000 ALTER TABLE `tp_teoneclasssalary` DISABLE KEYS */;
INSERT INTO `tp_teoneclasssalary` VALUES (25,19,1,1,1,1489471621,2145888000,1),(26,19,0,2,1,1489471621,2145888000,1),(27,19,1,5,1,1489471621,1489347650,0),(102,18,1,1,1,1489474409,2145888000,1),(103,18,1,2,1,1489474409,2145888000,1),(104,18,0,5,1,1489474409,2145888000,1),(105,19,1,5,2,1489347650,2145888000,1);
/*!40000 ALTER TABLE `tp_teoneclasssalary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_video`
--

DROP TABLE IF EXISTS `tp_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_video` (
  `video_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '视频表id',
  `video_name` varchar(128) NOT NULL COMMENT '视频名字',
  `download_link` varchar(512) NOT NULL COMMENT '视频链接',
  `uploader` int(10) unsigned DEFAULT NULL COMMENT '上传者',
  `video_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0表示教学视频,2表示试听课视频',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '视频记录的创建时间\r\n该字段用来在统计教师指定时间段内统计视频数用的',
  `isdelete` tinyint(1) unsigned NOT NULL COMMENT '是否删除，0没有，1表示是',
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_video`
--

LOCK TABLES `tp_video` WRITE;
/*!40000 ALTER TABLE `tp_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `liuliu`
--

USE `liuliu`;

--
-- Final view structure for view `tp_admin`
--

/*!50001 DROP TABLE IF EXISTS `tp_admin`*/;
/*!50001 DROP VIEW IF EXISTS `tp_admin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tp_admin` AS select `tp_register`.`ID` AS `ID`,`tp_register`.`account` AS `account`,`tp_register`.`password` AS `password`,`tp_register`.`country` AS `country`,`tp_register`.`status` AS `status`,`tp_register`.`chinesename` AS `chinesename`,`tp_register`.`englishname` AS `englishname`,`tp_register`.`email` AS `email`,`tp_register`.`phone` AS `phone`,`tp_register`.`QQ` AS `QQ`,`tp_register`.`age` AS `age`,`tp_register`.`sex` AS `sex`,`tp_register`.`weixin` AS `weixin`,`tp_register`.`identity` AS `identity`,`tp_register`.`create_time` AS `create_time`,`tp_register`.`last_modify` AS `last_modify`,`tp_register`.`image_path` AS `image_path`,`tp_register`.`openID` AS `openID` from `tp_register` where (`tp_register`.`identity` = 2) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tp_root`
--

/*!50001 DROP TABLE IF EXISTS `tp_root`*/;
/*!50001 DROP VIEW IF EXISTS `tp_root`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tp_root` AS select `tp_register`.`ID` AS `ID`,`tp_register`.`account` AS `account`,`tp_register`.`password` AS `password`,`tp_register`.`status` AS `status`,`tp_register`.`chinesename` AS `chinesename`,`tp_register`.`englishname` AS `englishname`,`tp_register`.`email` AS `email`,`tp_register`.`phone` AS `phone`,`tp_register`.`skype` AS `skype`,`tp_register`.`QQ` AS `QQ`,`tp_register`.`weixin` AS `weixin`,`tp_register`.`openID` AS `openID`,`tp_register`.`identity` AS `identity`,`tp_register`.`create_time` AS `create_time`,`tp_register`.`last_modify` AS `last_modify` from `tp_register` where (`tp_register`.`identity` = 4) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tp_student`
--

/*!50001 DROP TABLE IF EXISTS `tp_student`*/;
/*!50001 DROP VIEW IF EXISTS `tp_student`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tp_student` AS select `tp_register`.`ID` AS `ID`,`tp_register`.`account` AS `account`,`tp_register`.`password` AS `password`,`tp_register`.`country` AS `country`,`tp_register`.`status` AS `status`,`tp_register`.`chinesename` AS `chinesename`,`tp_register`.`englishname` AS `englishname`,`tp_register`.`email` AS `email`,`tp_register`.`phone` AS `phone`,`tp_register`.`skype` AS `skype`,`tp_register`.`QQ` AS `QQ`,`tp_register`.`age` AS `age`,`tp_register`.`sex` AS `sex`,`tp_register`.`weixin` AS `weixin`,`tp_register`.`image_path` AS `image_path`,`tp_register`.`accept_time` AS `accept_time`,`tp_register`.`student_cancel_number` AS `student_cancel_number`,`tp_register`.`student_sum_money` AS `student_sum_money`,`tp_register`.`student_manage_id` AS `student_manage_id`,`tp_register`.`identity` AS `identity`,`tp_register`.`create_time` AS `create_time`,`tp_register`.`last_modify` AS `last_modify`,`tp_register`.`openID` AS `openID` from `tp_register` where (`tp_register`.`identity` = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tp_teacher`
--

/*!50001 DROP TABLE IF EXISTS `tp_teacher`*/;
/*!50001 DROP VIEW IF EXISTS `tp_teacher`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `tp_teacher` AS select `tp_register`.`ID` AS `ID`,`tp_register`.`account` AS `account`,`tp_register`.`password` AS `password`,`tp_register`.`country` AS `country`,`tp_register`.`status` AS `status`,`tp_register`.`chinesename` AS `chinesename`,`tp_register`.`englishname` AS `englishname`,`tp_register`.`email` AS `email`,`tp_register`.`phone` AS `phone`,`tp_register`.`skype` AS `skype`,`tp_register`.`QQ` AS `QQ`,`tp_register`.`age` AS `age`,`tp_register`.`sex` AS `sex`,`tp_register`.`weixin` AS `weixin`,`tp_register`.`openID` AS `openID`,`tp_register`.`image_path` AS `image_path`,`tp_register`.`accept_time` AS `accept_time`,`tp_register`.`introduction` AS `introduction`,`tp_register`.`video_path` AS `video_path`,`tp_register`.`zoom` AS `zoom`,`tp_register`.`identity` AS `identity`,`tp_register`.`teacher_type` AS `teacher_type`,`tp_register`.`level` AS `level`,`tp_register`.`paypal` AS `paypal`,`tp_register`.`bankcard` AS `bankcard`,`tp_register`.`teachercertification` AS `teachercertification`,`tp_register`.`create_time` AS `create_time`,`tp_register`.`last_modify` AS `last_modify`,`tp_register`.`simplevideo` AS `simplevideo`,`tp_register`.`teachercomment` AS `teachercomment` from `tp_register` where (`tp_register`.`identity` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-15  7:17:46
