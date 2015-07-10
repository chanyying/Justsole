<?php
/**
 *	[µÇÂ½ÌáĞÑ(yeei_login.{modulename})] (C)2013-2099 Powered by Yeei!Design.
 *	Version: 1.3
 *	Date: 2013-5-17 10:13
 *	By: www.yeei.cn
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_yeei_login {
    function plugin_yeei_login(){
	    global $_G;
		$this->yeei = $_G['cache']['plugin']['yeei_login'];
		$this->switchs = $this->yeei['switchs'];
		$this->location = $this->yeei['location'];
        $this->ftheight = $this->yeei['ftheight'];
		$this->explan = $this->yeei['explan'];
		$this->qqurl = $this->yeei['qqurl'];
		$this->sinaurl = $this->yeei['sinaurl'];
		$this->baiduurl = $this->yeei['baiduurl'];
		$this->taobaourl = $this->yeei['taobaourl'];
		$this->sllurl = $this->yeei['sllurl'];
        $this->bgcolor = $this->yeei['bgcolor'];
		$this->color = $this->yeei['color'];
		$this->acolor = $this->yeei['acolor'];
		
		$this->adswi = $this->yeei['adswi'];
		$this->adcode = $this->yeei['adcode'];
		
		$this->closeyeei = $this->yeei['closeyeei'];
	}
	function global_header(){
	    if($this->switchs && !$_G['uid'] ){
	         return '<div id="yeei_logon_head"></div>';
		}
	}
	function global_footer(){
	    global $_G;
		if($this->switchs && !$_G['uid']){
		     if($_G['setting']['makehtml']['flag'] && $_G['basescript'] === 'portal'){
			     return;
			 }else{
			     include template('yeei_login:top');
	             return $top;
			 }
		}

	}

}

?>