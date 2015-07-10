<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$createTableSql=<<<EOF
drop table if exists `pre_ly_weibo_bind`;
EOF;

runquery($createTableSql);

$finish = TRUE;

?>