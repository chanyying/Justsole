<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(submitcheck('addsubmit')) {
	$sign = daddslashes(trim($_G['gp_signnew']));
	if(!empty($sign)) {
		DB::query("INSERT INTO ".DB::table('evinm_wenda_xml')." (clientid,sign) VALUES (null,'{$sign}')");
		cpmsg('数据调用添加成功', 'action=plugins&operation=evinm_wenda&identifier=evinm_wenda&pmod=xml', 'succeed');
	} else {
		cpmsg('验证密钥不能为空', '', 'error');
	}
} elseif(submitcheck('delsubmit')) {
	$delclientid = $_G['gp_delclientid'];
	foreach($delclientid as $key => $clientid) {
		$clientid = intval($clientid);
		if($clientid) {
			$delclientid[$key] = $clientid;
		} else {
			unset($delclientid[$key]);
		}
	}
	if($delclientid) {
		DB::query("DELETE FROM ".DB::table('evinm_wenda_xml')." WHERE clientid IN(".dimplode($delclientid).")");
	}
	cpmsg('数据调用删除成功', 'action=plugins&operation=evinm_wenda&identifier=evinm_wenda&pmod=xml', 'succeed');
} else {
	showtips(str_replace(array('{adminscript}', '{url}'), array(ADMINSCRIPT, $_G['siteurl'].'plugin.php?id=evinm_wenda:block_xml'), '<li>添加数据调用的时候会自动分配客户端ID</li><li>添加后，到门户中添加第三方模块后即可使用DIY调用 <a href="{adminscript}?action=blockxml&operation=add" target="_blank">点此前往</a></li><li>第三方地址为: {url}</li><li>客户端ID和通信密钥分别为下面填写的内容</li>'));
	showtableheader('数据调用');
	showformheader('plugins&operation=evinm_wenda&identifier=evinm_wenda&pmod=xml');
	showtablerow('', array('width="5%"', 'width="10%"', 'width="85%"'), array(
		'&nbsp;',
		'客户端ID',
		'通信密钥',
	));
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('evinm_wenda_xml'));
	if($count) {
		$page = intval($_G['gp_page']);
		$page = max(1, $page);
		$each = 15;
		$start = ($page - 1) * $each;
	
		$xml_query = DB::query("SELECT * FROM ".DB::table('evinm_wenda_xml')." LIMIT $start,$each");
		while($xml = DB::fetch($xml_query)) {
			showtablerow('', array('width="5%"', 'width="10%"', 'width="85%"'), array(
				'<input type="checkbox" name="delclientid[]" value="'.$xml['clientid'].'" />',
				$xml['clientid'],
				$xml['sign']
				));
		}
		$multi = multi($count, $each, $page, ADMINSCRIPT.'?action=plugins&operation=evinm_wenda&identifier=evinm_wenda&pmod=xml');
		showsubmit('delsubmit', 'delete', '', '', $multi);
	} else {
		showtablerow('', array('width="5%"', 'colspan="2"'), array('&nbsp;', '没有数据调用'));
	}

	showformfooter();
	showtablefooter();

	showtableheader('添加数据调用');
	showformheader('plugins&operation=evinm_wenda&identifier=evinm_wenda&pmod=xml');
	showtablerow('', array('width="10%"', 'width="85%"'), array(
		'通信密钥',
		'<input type="text" class="txt" name="signnew" style="width:200px;"/>',
	));
	showsubmit('addsubmit', 'add');
	showformfooter();
	showtablefooter();
}
?>
