<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['uid']) {
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}
$timeoffset = getglobal('setting/timeoffset');
$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
$YDTIME = $TDTIME - 86400;

$type = $_G['gp_type'] ? $_G['gp_type'] : 0;
if ($type == 1){
	$ORDER ='c.constant desc';
	$WHERE = " and c.time > $YDTIME";
	$WHEREC = " where `time` > $YDTIME";
}elseif ($type == 2){
	$ORDER ='c.todayrank ';
	$WHERE = ' and c.todayrank > 0 ';
	$WHEREC = ' where todayrank > 0 ';
}else{
	$ORDER ='c.level';
	$WHERE = '';
	$WHEREC = 'where level > 0';
}
$COUNT = DB::result_first("SELECT count(*)  FROM %t $WHEREC", array('fx_checkin'));
$SYSCON= DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_con')." WHERE id=1");
$SYSCONY= DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_con')." WHERE id=2");
$SELF =  DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin')." WHERE uid='$_G[uid]'");


$page = max(1, intval($_G['gp_page']));
$start_limit = ($page - 1) * 10;
$multipage = multi($COUNT, 10, $page, "plugin.php?id=fx_checkin:list&type=$type");
$timeoffset = getglobal('setting/timeoffset');
$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;

$LIST = array();
foreach(DB::fetch_all("SELECT c.*,m.username FROM ".DB::table('fx_checkin') ." c, ".DB::table('common_member')." m where c.uid=m.uid and c.level > 0 $WHERE ORDER BY $ORDER  LIMIT $start_limit, 10") as $id => $user) {
	$user['up2'] = abs($user['up']);
	$user['today'] = ($user['time'] >$TDTIME) ? $user['todayrank'] : 0 ;
	if ($type){
		$user['nlevel']= $id + 1 + ($page-1) * 10;
		$user['time2']= dgmdate($user['time'],'H:i:s');
	}else{
		$user['nlevel']= $user['level'];
	}
	$LIST[$id] = $user;
}

$fx_checkin = $_G['cache']['plugin']['fx_checkin'];

include template('fx_checkin:list');


?>