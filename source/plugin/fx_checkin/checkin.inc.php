<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['uid']) {
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}
if($_G['gp_formhash'] != FORMHASH) {
	showmessage('undefined_action');
}

$opengroup = unserialize($_G['cache']['plugin']['fx_checkin']['con_groups']);
if ($opengroup[0] && !in_array($_G['groupid'], $opengroup)){
	showmessage(lang('plugin/fx_checkin', 'nogroup'), '', array(), array('showdialog' => true,'alert'=>'right', 'closetime' => false));
}

$timeoffset = getglobal('setting/timeoffset');
$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
$YDTIME = $TDTIME - 86400;

$check = C::t('#fx_checkin#rates_plugin')->checkin($_G['uid']);
if ($check[0] <= 0){
	$msg = lang('plugin/fx_checkin', 'error',array($check[0]));
}else{
	C::t('#fx_checkin#rates_plugin')->checkin_success($_G['uid'],$check[0],$check[1],$check[2]);
	
	
	$msg = lang('plugin/fx_checkin', 'checkin_success1',array($check[0],$check[2]));
	$script = '<script type="text/javascript">';
	$script .= 'fx_chk_menu=true;';
	if ($_G['cache']['plugin']['fx_checkin']['style_topshow']){
		$script .= '$(\'fx_checkin_topb\').innerHTML="<a href=\"plugin.php?id=fx_checkin:list\" onmouseover=\"fx_checkin_menu(\'fx_checkin_topb\');\"><img id=\"fx_checkin_b\" src=\"source/plugin/fx_checkin/images/mini2.gif\"  style=\"position:relative;top:5px;height:18px;\"></a>";';
	}
	$script .= '$(\'fx_checkin_menut\').innerHTML="'.lang('plugin/fx_checkin', 'checkin_success5',array($check[0])).'";';
	$script .= '$(\'fx_checkin_menub\').innerHTML="'.lang('plugin/fx_checkin', 'checkin_success6',array($check[1],$check[2])).'";';
	if ($_G['cache']['plugin']['fx_checkin']['style_rightshow']){
		$script .= '$(\'fx_checkin_signb\').innerHTML="<p class=\"ed\"><i class=\"icon_moods_a\"></i></p><p class=\"days\">'.lang('plugin/fx_checkin', 'checkin_success7',array($check[1])).'</p>";'; 
		if ($check[3] == 0){$check[3] = '-';}
		$script .= '$(\'fx_checkin_level\').innerHTML="<span class=\"tit\">'.lang('plugin/fx_checkin', 'self_level').'</span><span class=\"num\" node-type=\"num\">'.$check[3].'</span>";'; 
		if ($_G['cache']['plugin']['fx_checkin']['fun_colorname']>0){
			$script .= ($check[1] >= $_G['cache']['plugin']['fx_checkin']['fun_colorname']) ? '$(\'fx_checkin_icon_or\').className="icon_or";' : '';
		}
		if ($_G['cache']['plugin']['fx_checkin']['fun_double']>0){
			$script .= ($check[1] >= $_G['cache']['plugin']['fx_checkin']['fun_double']) ? '$(\'fx_checkin_icon_dou\').className="icon_dou";': '';
		}
	}
	$script .= '</script>';
	
}

if ($_G['gp_mobile']=='yes'){
	if ($check[0] <= 0){
		showmessage(lang('plugin/fx_checkin', 'error',array($check[0])));
	}else{
		showmessage(lang('plugin/fx_checkin', 'checkin_success5',array($check[0])));
	}
}else{
	showmessage($msg, '', array(), array('showdialog' => true,'alert'=>'right', 'closetime' => false,'extrajs'=>$script));
}


?>