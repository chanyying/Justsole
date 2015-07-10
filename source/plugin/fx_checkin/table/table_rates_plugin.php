<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_forum_forum_plugin.php 29366 2012-04-09 03:00:26Z zhouxiaobo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_rates_plugin extends discuz_table {

	public function __construct() {

		$this->_table = 'fx_checkin';
		$this->_pk    = 'uid';
		parent::__construct();
	}

	public function insert_for_plugin($days,$nsum=0) {
		DB::insert('fx_checkin_rates', array('days' => $days,'nsum'=>$nsum), false,false,false);
	}
	public function check_rates(){
		global $_G;
		$this->checkin_main();
		if ($_G['uid']){
			$info =  DB::fetch_first("SELECT uid,time,days,level,constant,todayrank FROM ".DB::table('fx_checkin')." WHERE uid='$_G[uid]'");
			if ($info){
				$timeoffset = getglobal('setting/timeoffset');
				$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
				if ($info['time'] >$TDTIME){
					$_G['cache']['plugin']['fx_checkin']['self'] = array('todayrank'=>$info['todayrank'],'constant'=>$info['constant'],'days'=>$info['days'],'level'=>$info['level']);
					return true;
				}
			}
		}
		return false;
	}
	public function checkin($uid,$timestamp){
		global $_G;	
		$timestamp = $timestamp ? $timestamp : $_G['timestamp'];
		if ($uid){
			$info =  DB::fetch_first("SELECT uid,time,days,constant,level FROM ".DB::table('fx_checkin')." WHERE uid='$uid'");
			if ($info){
				$timeoffset = getglobal('setting/timeoffset');
				$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
				$YDTIME = $TDTIME - 86400; 
				if ($info['time'] < $TDTIME){
					if ($info['time'] >= $YDTIME){
						$constant = $info['constant'] + 1;
					}else{
						$constant = 1;
					}
					$days = $info['days'] + 1;
					if (!discuz_process::islocked('fx_checkin')){
						$config =  DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_con')." WHERE id=1");
						$config['rank'] = $config['rank'] + 1;
						DB::query("UPDATE ".DB::table('fx_checkin_rates')." SET nsum = nsum-1 WHERE days = '$info[days]'");
						DB::query("UPDATE ".DB::table('fx_checkin_rates')." SET nsum = nsum+1 WHERE days = '$days'");
						
						DB::query("UPDATE ".DB::table('fx_checkin')." SET time = '$timestamp',days='$days',constant='$constant',todayrank='$config[rank]' WHERE uid = '$uid'");
						DB::query("UPDATE ".DB::table('fx_checkin_con')." SET lasttime = '$timestamp',rank=rank+1 WHERE id = 1");
						
						discuz_process::unlock('fx_checkin');
						return array($config[rank],$constant,$days,$info['level']);
					}else{
						return array(-1,0); 
					}
				}else{
					return array(-2,0);
				}
			}else{
				if (!discuz_process::islocked('fx_checkin')){
					$config =  DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_con')." WHERE id=1");
					$config['rank'] = $config['rank'] + 1;
					$level = $this->get_level_plugin(1);
					DB::query("INSERT INTO ".DB::table('fx_checkin')." (uid,days,time,constant,up,level,todayrank) VALUES ('$uid','1','$timestamp','1','0','$level','$config[rank]')");
					DB::query("UPDATE ".DB::table('fx_checkin_rates')." SET nsum = nsum+1 WHERE days = '1'");
					DB::query("UPDATE ".DB::table('fx_checkin_con')." SET lasttime = '$timestamp',rank=rank+1 WHERE id = 1");
					discuz_process::unlock('fx_checkin');
					return array($config[rank],1,1,0);
				}else{
					return array(-1,0);
				}
			}
		}
		return array(0,0);
	}
	public function checkin_success($uid,$rank,$constant,$days,$timestamp){
		global $_G;
		$timestamp = $timestamp ? $timestamp : $_G['timestamp'];

		$timeoffset = getglobal('setting/timeoffset');
		$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
		$YDTIME = $TDTIME - 86400;
		if ($_G['cache']['plugin']['fx_checkin']['con_point']){
			$numb  = $_G['cache']['plugin']['fx_checkin']['con_numb'];
			$numbs = str_replace(array("\r\n", "\r"), '\n', $_G['cache']['plugin']['fx_checkin']['con_numbs']);
			$numbs = explode('\n',$numbs);
			if ($rank <=count($numbs)){ 
				$numb = $numb + $numbs[$rank-1];
			}
			if ($numb > 0){
				if (($_G['cache']['plugin']['fx_checkin']['fun_double'] > 0) && ($constant >= $_G['cache']['plugin']['fx_checkin']['fun_double'])){
					$numb = $numb * 2;
				}
				$numb_log = $numb;
				updatemembercount($uid, array($_G['cache']['plugin']['fx_checkin']['con_point'] => $numb));
			}
		}
		//syn
		if ($_G['cache']['plugin']['fx_checkin']['con_dayssyn']){ 
			$var = $_G['cache']['plugin']['fx_checkin']['con_dayssyn'];
			DB::query("UPDATE ".DB::table('common_member_count')." SET extcredits$var = $days WHERE uid = '$uid'");
		}
		if ($_G['cache']['plugin']['fx_checkin']['con_conssyn']){
			$var = $_G['cache']['plugin']['fx_checkin']['con_conssyn'];
			DB::query("UPDATE ".DB::table('common_member_count')." SET extcredits$var = $constant WHERE uid = '$uid'");
		}
		//log
		$mon = date("Ym",$TDTIME);
		$day = date("d",$TDTIME);
		$loginfo =  DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_log')." WHERE uid='$uid' and mon ='$mon' ");
		$log = dunserialize($loginfo['perm']);
		$log[$day] = array('l'=>$rank,'m'=>$numb_log,'t'=>$timestamp-$TDTIME);
		$log = serialize($log);
		if ($loginfo){
			DB::query("UPDATE ".DB::table('fx_checkin_log')." SET perm = '$log' WHERE uid='$uid' and mon ='$mon' ");
		}else{
			DB::query("INSERT INTO ".DB::table('fx_checkin_log')." (uid,mon,perm) VALUES ('$uid','$mon','$log')");
		}

	}
	public function get_level_plugin($days){
		return DB::result_first('SELECT SUM(nsum)  FROM %t WHERE days>%d', array('fx_checkin_rates', $days)) + 1;
	}
	public function recong(){
		DB::query("UPDATE ".DB::table('fx_checkin_rates')." SET nsum = 0", 'UNBUFFERED');
		foreach(DB::fetch_all("SELECT uid,days FROM ".DB::table('fx_checkin')) as $user) {
			DB::query("UPDATE ".DB::table('fx_checkin_rates')." SET nsum = nsum + 1 WHERE days = $user[days]", 'UNBUFFERED');
		}
		$this->checkin_level(false);
	}
	public function checkin_level($up=true){
		if (discuz_process::islocked('fx_checkin_up')){
			return false;
		}
		$level = 1;
		if ($up){ 
			DB::query("UPDATE ".DB::table('fx_checkin')." SET todayrank = 0");
			foreach(DB::fetch_all("SELECT * FROM ".DB::table('fx_checkin_rates')." WHERE nsum <>0  ORDER BY days DESC ") as $item) {
				DB::query("UPDATE ".DB::table('fx_checkin')." SET up=level-$level, level = $level WHERE days = $item[days]", 'UNBUFFERED');
				$level = $level + $item['nsum'];
			}
		}else{
			foreach(DB::fetch_all("SELECT * FROM ".DB::table('fx_checkin_rates')." WHERE nsum <>0  ORDER BY days DESC ") as $item) {
				DB::query("UPDATE ".DB::table('fx_checkin')." SET level = $level WHERE days = $item[days]", 'UNBUFFERED');
				$level = $level + $item['nsum'];
			}
		}
		discuz_process::unlock('fx_checkin_up');
		return true;
	}
	
	public function checkin_main(){
		global $_G;	
		$timeoffset = getglobal('setting/timeoffset');
		$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
		$config =  DB::fetch_first("SELECT * FROM ".DB::table('fx_checkin_con')." WHERE id=1");
		if ($config['lasttime']<$TDTIME){
			DB::query("UPDATE ".DB::table('fx_checkin_con')." SET lasttime = '$TDTIME',rank=0 WHERE id = 1");
			DB::query("REPLACE INTO ".DB::table('fx_checkin_con')." SET id = 2, lasttime = '0', rank=$config[rank]");

			$this->checkin_level(true);
		}
		$_G['cache']['plugin']['fx_checkin']['config']['rank'] = $config['rank'];
		$this->checkin_auto();
	}
	public function checkin_auto(){
		global $_G;
		$timeoffset = getglobal('setting/timeoffset');
		$TDTIME = gmmktime(0,0,0,dgmdate($_G['timestamp'], 'n',$timeoffset),dgmdate($_G['timestamp'], 'j',$timeoffset),dgmdate($_G['timestamp'], 'Y',$timeoffset)) - $timeoffset*3600;
		$YDTIME = $TDTIME - 86400;
		$TODTIME = $TDTIME + 86400;
		loadcache('fx_checkin_auto');
		$autolist = $_G['cache']['fx_checkin_auto'];
		$ifsave = false;
		$autolist_ = array();
		foreach($autolist as $id => $value) {
			if ($value[1]){
				if (($value[1] < $TODTIME) && ($value[1]<=$_G[timestamp])){
					$autolist_[$id] = $value[1];
					$autolist[$id][1] = $this->_randtime($value[0],$TODTIME);
					$ifsave = true;
				}
			}else{
				$autolist[$id][1] = $this->_randtime($value[0],$TODTIME);
				$ifsave = true;
			}
		}
		if ($autolist_){
			asort($autolist_);
			foreach($autolist_ as $id => $value) {
				$check = C::t('#fx_checkin#rates_plugin')->checkin($id,$value);
				if ($check[0] > 0){
					C::t('#fx_checkin#rates_plugin')->checkin_success($id,$check[0],$check[1],$check[2],$value);
				}
			}
		}

		if ($ifsave){
			savecache('fx_checkin_auto', $autolist);
		}
	}
	public function _randtime($timestr,$DAY){
		global $_G;
		$timearray = explode('-',$timestr);
		if (count($timearray) == 2){
			$t1     = strtotime(date('Y-m-d',$DAY).' '.$timearray[0]);//begin
			$t2     = strtotime(date('Y-m-d',$DAY).' '.$timearray[1]);//end
			return  mt_rand($t1,$t2);
		}else{
			return 0;
		}
	}
}