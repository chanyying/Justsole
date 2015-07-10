<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['adminid']=='1') {
	exit('undefined_action');
	
}

if(!$_G['gp_submit']) {
	showtableheader(lang('plugin/fx_checkin', 'data1'));
	showformheader("plugins&operation=config&identifier=fx_checkin&pmod=data&submit=1", "");
	include template('fx_checkin:data');				
	echo '<input type="hidden" name="formhash" value="'.FORMHASH.'">';
	showsubmit('submit', lang('plugin/fx_checkin', 'data2'));
	showformfooter();
	showtablefooter();
}elseif ($_G['adminid']=='1' && $_G['gp_formhash']==FORMHASH){
	$timeoffset = getglobal('setting/timeoffset');
	$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
	$YDTIME = $TDTIME - 86400;

	$query = DB::query("SHOW TABLES LIKE '".DB::table($_G[gp_f_data])."'");
	if(DB::num_rows($query) <= 0)cpmsg(lang('plugin/fx_checkin', 'data3'), '');
	DB::query("TRUNCATE TABLE ".DB::table('fx_checkin')."");
	DB::query("TRUNCATE TABLE ".DB::table('fx_checkin_rates')."");
	for($i = 1; $i <= 2000; $i++) {
		DB::query("INSERT INTO ".DB::table('fx_checkin_rates')." (days,nsum) VALUES ('$i','0')");
	}

	$query = DB::query("SELECT * FROM ".DB::table($_G[gp_f_data]));
	$count  = 0;
	while($item = DB::fetch($query)) {
		$c = $_G[gp_f_dayc] ? $item[$_G[gp_f_dayc]] : $item[$_G[gp_f_time]] > $TDTIME ? 1 : 0 ;
		DB::query("INSERT INTO ".DB::table('fx_checkin')." (uid,days,time,constant,up,level) VALUES ('".$item[$_G[gp_f_uid]]."','".$item[$_G[gp_f_days]]."','".$item[$_G[gp_f_time]]."','$c','0','0')");
		DB::query("UPDATE ".DB::table('fx_checkin_rates')." SET nsum = nsum + 1 WHERE days = ".$item[$_G[gp_f_days]], 'UNBUFFERED');
		$count = $count + 1;
	}

	$query = DB::query("SELECT * FROM ".DB::table('fx_checkin')." where constant > 0  ORDER BY  `pre_fx_checkin`.`time` ASC " );
	$rank  = 0;
	while($item = DB::fetch($query)) {
		$rank = $rank + 1;
		DB::query("UPDATE ".DB::table('fx_checkin')." SET todayrank = '$rank' WHERE uid = ".$item['uid'], 'UNBUFFERED');
	}
	DB::query("UPDATE ".DB::table('fx_checkin_con')." SET lasttime = '$_G[timestamp]',rank=$rank WHERE id = 1");
	
	C::t('#fx_checkin#rates_plugin')->checkin_level(false);
	
	cpmsg(lang('plugin/fx_checkin', 'data4',array($count)), '', 'succeed');
}else{
	cpmsg(lang('plugin/fx_checkin', 'data5'), '');
}


?>