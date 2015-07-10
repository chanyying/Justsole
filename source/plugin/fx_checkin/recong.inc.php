<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['adminid']=='1') {
	exit('undefined_action');
	
}

if(!$_G['gp_submit']) {
	echo '<table class="tb tb2 " id="content" summary="content">';
	echo '<tr><th  class="partition">'.lang('plugin/fx_checkin', 'recong1').'</th></tr>';
	echo '<tr><td class="tipsblock">';
	echo '<ul id="tipslis">';
	echo '<li>1.<a href="admin.php?action=plugins&operation=config&identifier=fx_checkin&pmod=recong&submit=1">'.lang('plugin/fx_checkin', 'recong2').'</a></li>';
	echo '<li>2.<a href="admin.php?action=plugins&operation=config&identifier=fx_checkin&pmod=recong&submit=2">'.lang('plugin/fx_checkin', 'recong3').'</a>(<font color=red>'.lang('plugin/fx_checkin', 'recong4').'</font>)</li>'; 
	echo "</ul>";
	echo "</td></tr></table>";
}elseif ($_G['adminid']=='1'){
	if ($_G['gp_submit'] == 1){
		C::t('#fx_checkin#rates_plugin')->checkin_level(false);
	}elseif ($_G['gp_submit'] == 2){
		C::t('#fx_checkin#rates_plugin')->recong();
	}
	cpmsg(lang('plugin/fx_checkin', 'recong5'), dreferer(), 'succeed');
}else{
	cpmsg(lang('plugin/fx_checkin', 'recong6'), '');
}


?>