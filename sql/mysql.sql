
CREATE TABLE `0_street_article` (
  `sn` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `focus` tinyint(2) unsigned NOT NULL COMMENT '精選',
  `topic_sn` tinyint(2) unsigned NOT NULL COMMENT '類別編號',
  `sort` tinyint(5) unsigned NOT NULL COMMENT '排序',
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `username` varchar(65) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `0_street_topic` (
  `topic_sn` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '類別編號',
  `topic_title` varchar(255) NOT NULL COMMENT '類別或主題名稱',
  `topic_type` varchar(10) NOT NULL COMMENT '種類',
  `topic_description` text NOT NULL COMMENT '說明',
  `topic_status` enum('0','1','2','3') NOT NULL COMMENT '主題狀態',
  `username` varchar(65) NOT NULL COMMENT '建立者',
  PRIMARY KEY (`topic_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `0_street_phone` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '建檔序號',
  `comp_id` char(20) NOT NULL COMMENT '公司別',
  `fact_id` char(20) NOT NULL COMMENT '廠別',
  `big_serial` varchar(255) DEFAULT NULL COMMENT '手機序號',
  `big_enable` enum('0','1') DEFAULT '0' COMMENT '手機啟用',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;