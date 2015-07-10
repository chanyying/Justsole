<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['uid'])
{
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}

$discuzUserInfo=C::t('#liyou_weibo#ly_weibo_bind')->fetch_by_discuz_uid($_G['uid']);
?>