<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

loadcache('fx_checkin_auto');
$autolist = $_G['cache']['fx_checkin_auto'];

if ($_G['gp_updatetime']){
	$timeoffset = getglobal('setting/timeoffset');
	$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
	$YDTIME = $TDTIME - 86400;
	
	$autolist[$_G['gp_updatetime']][1] = C::t('#fx_checkin#rates_plugin')->_randtime($autolist[$_G['gp_updatetime']][0],$TDTIME);
	savecache('fx_checkin_auto', $autolist);
}
if ($_G['gp_submit']){
	$timeoffset = getglobal('setting/timeoffset');
	$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
	$YDTIME = $TDTIME - 86400;
	$TODTIME = $TDTIME + 86400;

	foreach($_G['gp_delete'] as $id => $value) {
		unset($autolist[$id]);
	}
	foreach($_G['gp_newuser'] as $id => $value) {
		$uid = C::t('common_member')->fetch_uid_by_username($value);
		if ($uid){
			$timestr = $_G['gp_newhourb'][$id].':'.$_G['gp_newminb'][$id].':00-'.$_G['gp_newhoure'][$id].':'.$_G['gp_newmine'][$id].':00';
			if (preg_match("/^\d{2}:\d{2}:\d{2}-\d{2}:\d{2}:\d{2}$/",$timestr)){
				$autolist[$uid][0] = $timestr;
				$autolist[$uid][1] = C::t('#fx_checkin#rates_plugin')->_randtime($timestr,$TODTIME);
			}
		}
	}
	savecache('fx_checkin_auto', $autolist);
	cpmsg('setting_update_succeed', dreferer(), 'success');
}else{

	$outstr = '';
	$userids = array();
	foreach($autolist as $id => $value) {
		$outstr .= $id.','.$value[0]."\r\n";
		$userids[] = $id;
	}
	showtips(lang('plugin/fx_checkin','auto_tips'));

	showformheader('plugins&operation=config&identifier=fx_checkin&pmod=auto');
		showtableheader('list');
		showsubtitle(array('del', 'username', lang('plugin/fx_checkin', 'auto_time'), lang('plugin/fx_checkin', 'auto_nexttime'),'groups_type_operation'));

		$users = C::t('common_member')->fetch_all($userids);
		foreach($autolist as $id => $value) {
			echo '<tr class="hover">';
			echo '<td class="td25"><input class="checkbox" type="checkbox" name="delete['.$id.']" value="1"></td>';
			echo '<td>'.$users[$id]['username'].'</td>';
			echo '<td>'.$value[0].'</td>';
			echo '<td>'.date('Y-m-d H:i:s',$value[1]).'</td>';
			echo '<td><a href="admin.php?action=plugins&operation=config&identifier=fx_checkin&pmod=auto&updatetime='.$id.'">'.cplang('members_stat_updatetime').'</a></td>';
			echo '</tr>';
		}
		echo '<tr><td colspan="3"><div><a href="###" onclick="addrow(this, 0)" class="addtr">'.cplang('add').'</a></div></td></tr>';
		showsubmit('submit');
		showtablefooter();
		showformfooter();
}

?>
<script type="text/JavaScript">
var rowtypedata = [
	[
		[1,'&nbsp;', 'td25'], 
		[3, '<input name="newuser[]" value="<?php echo $lang[username];?>" size="20" type="text" class="txt" /> <? echo lang('plugin/fx_checkin','auto_randtime');?> <input type="text" name="newhourb[]" value="00" class="txt" style="width: 20px;" /><? echo cplang('misc_cron_hour');?><input type="text" name="newminb[]" value="00" class="txt" style="width: 20px;" /><? echo cplang('misc_cron_minute');?> --- <input type="text" name="newhoure[]" value="00" class="txt" style="width: 20px;" /><? echo cplang('misc_cron_hour');?><input type="text" name="newmine[]" value="00" class="txt" style="width: 20px;" /><? echo cplang('misc_cron_minute');?>  <font color=red><? echo lang('plugin/fx_checkin','auto_randtime2');?></font>']
	],
];
</script>