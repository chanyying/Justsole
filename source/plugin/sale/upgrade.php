<?php
/**
此破解程序由星期六源码【xlqzm.com】提供，更多商业源码请登录星期六源码官网
官方网站:xlqzm.com
更多商业插件：http://xqlzm.com/forum-113-1.html
更多商业模板：http://xqlzm.com/forum-112-1.html
更多商业源码：http://xqlzm.com/forum-141-1.html
**/
 
if(!defined('IN_DISCUZ')) { exit('Access Denied');}

$_lang = lang('plugin/sale');

if ($_GET['fromversion'] < 2.5) {
$sql = <<<EOF
ALTER TABLE `pre_sale_goods` ADD `goods_status`  tinyint(2) default NULL;
EOF;
runquery($sql);
}

if ($_GET['fromversion'] < 3.0) {
$sql=<<<EOF
DROP TABLE IF EXISTS `pre_sale_area`;
CREATE TABLE `pre_sale_area` (
`id` mediumint(8) unsigned NOT NULL auto_increment,
`name` varchar(255) NOT NULL default '',
`level` tinyint(4) unsigned NOT NULL default '0',
`usetype` tinyint(1) unsigned NOT NULL default '0',
`upid` mediumint(8) unsigned NOT NULL default '0',
`displayorder` smallint(6) NOT NULL default '0',
PRIMARY KEY  (`id`),
KEY `upid` (`upid`,`displayorder`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `pre_sale_cat`;
CREATE TABLE `pre_sale_cat` (
  `cat_id` int(10) unsigned NOT NULL auto_increment,
  `cat_title` varchar(100) default NULL,
  `cat_pid` mediumint(10) default '0',
  `cat_remarks` varchar(400) default NULL,
  `cat_status` tinyint(2) unsigned default NULL,
  `cat_sort` tinyint(2) unsigned default NULL,
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM;

ALTER TABLE `pre_sale_goods` CHANGE `resideprovince`  `province` varchar(20) default NULL;
ALTER TABLE `pre_sale_goods` CHANGE `residecity`  `city` varchar(20) default NULL;
ALTER TABLE `pre_sale_goods` CHANGE `residedist`  `dist` varchar(20) default NULL;
ALTER TABLE `pre_sale_goods` CHANGE `residecommunity`  `community` varchar(20) default NULL;

ALTER TABLE `pre_sale_goods` CHANGE `category_id`  `cat_id` tinyint(2) default NULL;
ALTER TABLE `pre_sale_goods` CHANGE `category_title`  `cat_title` varchar(20) default NULL;

ALTER TABLE `pre_sale_goods` ADD  `subcat_id` mediumint(8) default NULL;
ALTER TABLE `pre_sale_goods` ADD  `subcat_title` varchar(30) default NULL;

EOF;
runquery($sql);
runquery($_lang['sql_area']);
}

$finish = TRUE;
