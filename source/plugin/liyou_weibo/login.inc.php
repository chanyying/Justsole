<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/liyou_weibo/config/config.php';
require_once DISCUZ_ROOT.'./source/plugin/liyou_weibo/sina_api/saetv2.ex.class.php';
	
$oOAuth=new SaeTOAuthV2(APP_KEY,APP_SECRET);
$url=$oOAuth->getAuthorizeURL(APP_CALLBACK);

header("Location: $url");

?>