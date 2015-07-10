<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/liyou_weibo/config/config.php';
require_once DISCUZ_ROOT.'./source/plugin/liyou_weibo/sina_api/saetv2.ex.class.php';

class plugin_liyou_weibo {
	public function plugin_liyou_weibo() {

	}

	public function global_login_extra() {
		include template('liyou_weibo:global_login_extra');
		return $return;
	}

	public function global_usernav_extra1() {
		global $_G;
		$discuzUserInfo=C::t('#liyou_weibo#ly_weibo_bind')->fetch_by_discuz_uid($_G['uid']);
		if(empty($discuzUserInfo))
		{
			include template('liyou_weibo:global_usernav_extra1');
			return $return;
		}
	}

	public function global_login_text() {

		$return="<a href=\"plugin.php?id=liyou_weibo:login\" class=\"xi2\"><img src=\"source/plugin/liyou_weibo/image/login_btn.png\" /></a>";
		return $return;
	}

	public function  global_cpnav_extra1() {
		if(LY_NOTICE==1 && LY_UID>0 && LY_POSITION==1)
		{
			$return='<iframe width="121" scrolling="no" height="24" frameborder="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&amp;width=136&amp;height=24&amp;uid='.LY_UID.'&amp;style=2&amp;btn=red&amp;dpc=1" border="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe>';
			return $return;
		}
	}
	public function  index_status_extra() {
		if(LY_NOTICE==1 && LY_UID>0 && LY_POSITION==2)
		{
			$return='<iframe width="121" scrolling="no" height="24" frameborder="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&amp;width=136&amp;height=24&amp;uid='.LY_UID.'&amp;style=2&amp;btn=red&amp;dpc=1" border="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe>';
			return $return;
		}
	}
	public function  global_cpnav_top() {
		if(LY_NOTICE==1 && LY_UID>0 && LY_POSITION==3)
		{
			$return='<iframe width="121" scrolling="no" height="24" frameborder="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&amp;width=136&amp;height=24&amp;uid='.LY_UID.'&amp;style=2&amp;btn=red&amp;dpc=1" border="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe>';
			return $return;
		}
	}
}

class plugin_liyou_weibo_member extends plugin_liyou_weibo {

	 function register_top(){
		global $_G;
		if($_G['cookie']['weibo_token']) {
			$_G['setting']['reglinkname'] = lang('plugin/liyou_weibo', 'complete_profile');
			$referer=rawurlencode($_GET['referer']);
			include template('liyou_weibo:register_top');
			return $return;
		}
	}
	function register_bottom(){
		global $_G;
		if($_G['cookie']['weibo_token']) {
			return $return;
		}
	}
	function logging_top(){
		global $_G;
		if($_G['cookie']['weibo_token']) {
			$referer=rawurlencode($_GET['referer']);
			include template('liyou_weibo:logging_top');
			return $return;
		}
	}

	function register_logging_method() {
		global $_G;
		return '<a href="'.$_G['siteurl'].'plugin.php?id=liyou_weibo:login"><img src="'.$_G['siteurl'].'source/plugin/liyou_weibo/image/login_btn.png" alt="'.lang('plugin/liyou_weibo', 'weibo_login').'" class="vm"></a>';
	}
	
	function logging_method() {
		global $_G;
		return '<a href="'.$_G['siteurl'].'plugin.php?id=liyou_weibo:login"><img src="'.$_G['siteurl'].'source/plugin/liyou_weibo/image/login_btn.png" alt="'.lang('plugin/liyou_weibo', 'weibo_login').'" class="vm"></a>';
	}

	function register_message($param) {
		global $_G;

		if($param['param'][0] == 'register_succeed' && $_G['cookie']['weibo_token']) {
			$token = dunserialize($_G['cookie']['weibo_token']);
			
		$insertUpdate=array(
				'uid'=>$_G['uid'],
				'weibo_uid'=>$token['uid'],
				'username'=>$param['param'][2]['username'],
				'access_token'=>$token['access_token'],
				'expires_in'=>$token['expires_in'],
				'remind_in'=>$token['remind_in']
		);
		C::t('#liyou_weibo#ly_weibo_bind')->insert($insertUpdate);
		}
	}
	function logging_message($param) {
		global $_G;
		if($param['param'][0] == 'location_login_succeed' && $_G['cookie']['weibo_token']) {
			$token = dunserialize($_G['cookie']['weibo_token']);
			
		$insertUpdate=array(
				'uid'=>$_G['uid'],
				'weibo_uid'=>$token['uid'],
				'username'=>$_G['username'],
				'access_token'=>$token['access_token'],
				'expires_in'=>$token['expires_in'],
				'remind_in'=>$token['remind_in'],
		);
		C::t('#liyou_weibo#ly_weibo_bind')->insert($insertUpdate);
		}
	}
}


class plugin_liyou_weibo_forum extends plugin_liyou_weibo {

}
?>