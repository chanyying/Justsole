<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('APP_KEY',$_G['cache']['plugin']['liyou_weibo']['app_key']);
define('APP_SECRET',$_G['cache']['plugin']['liyou_weibo']['app_secret']);
define('LY_NOTICE',$_G['cache']['plugin']['liyou_weibo']['ly_notice']);
define('LY_UID',$_G['cache']['plugin']['liyou_weibo']['ly_weibo_uid']);
define('LY_POSITION',$_G['cache']['plugin']['liyou_weibo']['ly_btn_position']);
define('APP_CALLBACK',$_G['siteurl'].'plugin.php?id=liyou_weibo:callback');

?>