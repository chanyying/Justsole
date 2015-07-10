<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$createTableSql=<<<EOF
drop table if exists `pre_ly_weibo_bind`;
create table `pre_ly_weibo_bind`
(
	`uid` mediumint(8) unsigned not null,
	`username` char(15) not null default '',
	`weibo_uid` bigint(20) unsigned not null,
	`access_token` char(32) not null,
	`expires_in` int(10) unsigned not null,
	`remind_in` int(10) unsigned not null,
	`profile` text,
	 primary key (`uid`)

)engine=MyISAM default charset=utf8;
EOF;

runquery($createTableSql);

$finish = TRUE;
?>