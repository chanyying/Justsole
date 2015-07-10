<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$installsql = <<<SQL
CREATE TABLE pre_evinm_wenda_answer (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '回T答id',
  `qid` int(8) NOT NULL COMMENT '问题id',
  `uid` int(5) NOT NULL,
  `message` text NOT NULL,
  `posttime` varchar(50) NOT NULL,
  `best` int(2) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `iszw` int(11) NOT NULL COMMENT '1鏄拷闂?2杩介棶鍥炵瓟',
  `zw_id` int(11) NOT NULL COMMENT '杩介棶鐨刬d',
  `zw_aid` int(11) NOT NULL COMMENT '琚拷闂殑鍥炵瓟id',
  `zw_uid` int(11) NOT NULL COMMENT '琚拷闂殑鍥炵瓟浼氬憳id',
  `zw_ddhd` int(11) NOT NULL COMMENT '鏄惁绛夊緟鍥炵瓟',
  `shenhe` int(4) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE pre_evinm_wenda_ask (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `fenlei` int(5) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `pic` varchar(200) NOT NULL,
  `coin` int(5) NOT NULL,
  `over` int(11) NOT NULL,
  `posttime` varchar(50) NOT NULL,
  `nums_a` varchar(8) NOT NULL DEFAULT '0',
  `fenlei_sup` int(5) NOT NULL COMMENT '上级分类',
  `close` int(11) NOT NULL DEFAULT '0',
  `sale` int(2) NOT NULL DEFAULT '0',
  `shenhe` int(4) NOT NULL DEFAULT '0',
  `tid` int(11) NOT NULL,
  `ishidden` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE pre_evinm_wenda_ask_add (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `qid` int(5) NOT NULL,
  `message` text NOT NULL,
  `pic` varchar(100) NOT NULL,
  `posttime` varchar(20) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE pre_evinm_wenda_fenlei (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL,
  `paixu` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `vipuid` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE pre_evinm_wenda_user (
  `uid` int(8) NOT NULL,
  `num_ask` int(8) NOT NULL,
  `num_a` int(8) NOT NULL,
  `num_best` int(8) NOT NULL,
  `exp` int(8) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM;

CREATE TABLE pre_evinm_wenda_buy (
  `bid` int(2) NOT NULL AUTO_INCREMENT,
  `qid` int(8) NOT NULL,
  `buyerid` int(8) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM;

CREATE TABLE pre_evinm_wenda_xml (
  `clientid` int(8) NOT NULL AUTO_INCREMENT,
  `sign` varchar(32) NOT NULL,
  PRIMARY KEY (`clientid`)
) ENGINE=MyISAM;

SQL;

?>
