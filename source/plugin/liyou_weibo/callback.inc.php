<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/liyou_weibo/config/config.php';
require_once DISCUZ_ROOT.'./source/plugin/liyou_weibo/sina_api/saetv2.ex.class.php';
	
$oOAuth=new SaeTOAuthV2(APP_KEY,APP_SECRET);


if($_REQUEST['code'])
{
	$arrKey=array();
	$arrKey['code']=$_REQUEST['code'];
	$arrKey['redirect_uri']=APP_CALLBACK;
	try{
		$token=$oOAuth->getAccessToken('code',$arrKey);
	}catch(OAuthException $e)
	{

	}
}

if($token)
{
	dsetcookie('weibo_token',serialize($token),86400);

	$oClient=new SaeTClientV2(APP_KEY,APP_SECRET,$token['access_token']);
	$weiboUserInfo=$oClient->show_user_by_id($token['uid']);

	$discuzUserInfo='';
	
	$weiboUserInfo['id'] && $discuzUserInfo=C::t('#liyou_weibo#ly_weibo_bind')->fetch_by_weibo_uid($weiboUserInfo['id']);
	//1、没登录，绑定了，则登录并更新
	//2、登录了，没绑定，则绑定
	//3、登录了，绑定了，则更新
	//4、没登陆，没绑定， 则提示用户注册一个用户或绑定一个用户。
	$uid=$discuzUserInfo['uid'];

	if($uid && !$_G['uid'])
	{
		$member=getuserbyuid($uid);
		if(empty($member))
		{
			showmessage('liyou_weibo:user_not_exists');
		}
		require_once libfile('function/member');
		$cookietime = 1296000;
		setloginstatus($member, $cookietime);
		loadcache('usergroups');
		$usergroups = $_G['cache']['usergroups'][$_G['groupid']]['grouptitle'];
		$param = array('username' => $member['username'], 'usergroup' => $_G['cache']['usergroups'][$member['groupid']]['grouptitle']);
		C::t('common_member_status')->update($member['uid'], array('lastip'=>$_G['clientip'], 'lastvisit'=>TIMESTAMP, 'lastactivity' => TIMESTAMP));
		if($_G['setting']['allowsynlogin']) {
			loaducenter();
			$ucsynlogin = uc_user_synlogin($uid);
		}
		$arrUpdate=array(
				'username'=>$member['username'],
				'access_token'=>$token['access_token'],
				'expires_in'=>$token['expires_in'],
				'remind_in'=>$token['remind_in']
				);
		C::t('#liyou_weibo#ly_weibo_bind')->update($uid,$arrUpdate);
		showmessage('liyou_weibo:login_success',$_G['siteurl']);
	}

	if(!$uid && $_G['uid'])
	{
		$member=getuserbyuid($_G['uid']);
		$insertUpdate=array(
				'uid'=>$_G['uid'],
				'weibo_uid'=>$token['uid'],
				'username'=>$member['username'],
				'access_token'=>$token['access_token'],
				'expires_in'=>$token['expires_in'],
				'remind_in'=>$token['remind_in']
		);
		C::t('#liyou_weibo#ly_weibo_bind')->insert($insertUpdate);
		showmessage('liyou_weibo:bind_success',dreferer());
	}
	
	if($uid && $_G['uid'])
	{
		$member=getuserbyuid($_G['uid']);
		$arrUpdate=array(
				'username'=>$member['username'],
				'access_token'=>$token['access_token'],
				'expires_in'=>$token['expires_in'],
				'remind_in'=>$token['remind_in']
		);
		C::t('#liyou_weibo#ly_weibo_bind')->update($uid,$arrUpdate);		
		showmessage('liyou_weibo:bind_success',dreferer());
	}

	if(!$uid && !$_G['uid'])
	{
		$dreferer = rawurlencode(dreferer());
		showmessage('liyou_weibo:register_or_bind','member.php?mod='.$_G['setting']['regname'].'&referer='.$dreferer);
	}
}else
{
	showmessage('liyou_weibo:auth_fail');
}

?>