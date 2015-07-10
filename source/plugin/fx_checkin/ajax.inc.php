<?php
if(!defined('IN_DISCUZ') || !$_G['uid']) {
	exit('Access Denied');
}


include template('common/header');

$mon = $_G['gp_date'];
$loginfo =  DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_log')." WHERE uid='$_G[uid]' and mon ='$mon' ");
if ($loginfo){
	$log = dunserialize($loginfo['perm']);
	foreach($log as $day => $item) {
		$item['t'] = iconv("GB2312","UTF-8//IGNORE",date(lang('plugin/fx_checkin', 'date1'),$item['t'] + strtotime($mon.$day)));
		$out[$day+0] = $item; 
	}
	$out['d'] = $mon;
	echo json_encode($out);
}
include template('common/footer');

?>