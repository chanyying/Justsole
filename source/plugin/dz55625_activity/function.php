<?php
/*
	[55625.COM!] (C)2001-2012 55625.COM Inc.
	BY QQ:114512039  Lovenr
*/

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
function classnum($did){
	return DB::result_first("SELECT count(*) FROM ".DB::table('forum_activity_ar')." WHERE `did` ='$did'");
}

function parconfig($str){
	$return = array();
	$array = explode("\n",str_replace("\r","",$str));
	foreach ($array as $v){
	   $t = explode("=",$v);
	   $t[0] = trim($t[0]);
	   $return[$t[0]] = $t[1];
	}
	return $return;
}
function monthnum($m){
	global $montharray,$lastmonthago;
	$ktime=$montharray[$m-1];
	$jtime=$montharray[$m];
	if($m<0){
		echo $where;
		$where="`ktime`<$lastmonthago AND";
	}elseif($m==0){
		$where="`ktime`>=$jtime AND";
	}else{
		$where="`ktime`>=$jtime AND `ktime`<$ktime AND";
	}
	return DB::result_first("SELECT count(*) FROM ".DB::table('forum_activity_ar')." WHERE $where display!='0'");
}
function monthwhere($m){
	global $montharray,$lastmonthago;
	$ktime=$montharray[$m-1];
	$jtime=$montharray[$m];
	if($m<0){
		echo $where;
		$where="`ktime`<$lastmonthago AND";
	}elseif($m==0){
		$where="`ktime`>=$jtime AND";
	}else{
		$where="`ktime`>=$jtime AND `ktime`<$ktime AND";
	}
	return $where;
}
 ?>