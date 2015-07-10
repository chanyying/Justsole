<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid'])
{
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}

$discuzUserInfo=C::t('#liyou_weibo#ly_weibo_bind')->fetch_by_discuz_uid($_G['uid']);
if(!empty($discuzUserInfo))
{
	C::t('#liyou_weibo#ly_weibo_bind')->delete($_G['uid']);
	showmessage('liyou_weibo:unbind_success', dreferer());
}else
{
	showmessage('liyou_weibo:unbind_fail', dreferer());
}
?>