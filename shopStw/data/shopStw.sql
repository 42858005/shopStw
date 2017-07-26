CREATE DATABASE IF NOT EXISTS `shopStw`;
USE `shopStw`;
--����Ա��
DROP TABLE IF EXISTS `Stw_admin`;
CREATE TABLE `Stw_admin`(
`id` tinyint unsigned auto_increment key,
`username` varchar(20) not null unique,
`password` char(32) not null,
`email` varchar(50) not null
);

--�����
DROP TABLE IF EXISTS `Stw_cate`;
CREATE TABLE `Stw_cate`(
`id` smallint unsigned auto_increment key,
`cName` varchar(50) unique
);

--��Ʒ��
DROP TABLE IF EXISTS `Stw_pro`;
CREATE TABLE `Stw_pro`(
`id` int unsigned auto_increment key,
`pName` varchar(50) not null unique,
`pSn` varchar(50) not null,
`pNum` int unsigned default 1,
`mPrice` decimal(10,2) not null,
`iPrice` decimal(10,2) not null,
`pDesc` text,
`pImg` varchar(50) not null,
`pubTime` int unsigned not null,
`isShow` tinyint(1) default 1,
`isHot` tinyint(1) default 0,
`cId` smallint unsigned not null
);

--�û���
DROP TABLE IF EXISTS `Stw_user`;
CREATE TABLE `Stw_user`(
`id` int unsigned auto_increment key,
`username` varchar(20) not null unique,
`password` char(32) not null,
`sex` enum("��","Ů","����") not null default "����",
`face` varchar(50) not null,
`regTime` int unsigned not null
);

--����
DROP TABLE IF EXISTS `Stw_album`;
CREATE TABLE `Stw_album`(
`id` int unsigned auto_increment key,
`pId` int unsigned not null,
`albumPath` varchar(50) not null
);
