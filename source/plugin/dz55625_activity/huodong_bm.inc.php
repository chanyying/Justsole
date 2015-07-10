<?php
/*
	[55625.COM!] (C)2001-2012 55625.COM Inc.
	BY QQ:114512039  Lovenr
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

global $_G;
if(!isset($_G['cache']['plugin'])){ loadcache('plugin'); }
@extract($_G['cache']['plugin']['dz55625_activity']);


if($_G['groupid']==7){
	showmessage(lang('plugin/dz55625_activity', 'loginno'), '', array(), array('login' => true));	
}

if($_GET['option'] == 'baoming'){
		//-------------------------------------------
		$uid = intval($_G['uid']);
		$tid = intval($_GET['newid']);
		$countbm = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_activity_ur')." WHERE tid='$tid'");
		$sql = "SELECT * FROM ".DB::table('forum_activity_ur')." WHERE tid='$tid' AND uid='$uid'";
		$ps = DB::fetch(DB::query($sql));
		if(submitcheck('applysubdz')){
			if(empty($_G['gp_tels'])){
				showmessage(lang('plugin/dz55625_activity', 'lianxitels'), dreferer());
			}else{
				if(empty($ps['uid'])){
					$tels=addslashes($_G['gp_tels']);
					$qicq=addslashes($_G['gp_qicq']);
					$author = addslashes($_G['username']);
					$xingm = addslashes($_G['gp_xingm']);
					$renumber = addslashes($_G['gp_renumber']);
					$subject = addslashes($_G['gp_subject']);
					$dateline = $_G['timestamp'];
					DB::insert('forum_activity_ur',array('id' => '','tid' => $tid, 'uid' => $uid, 'author' => $author, 'tels' => $tels, 'qicq' => $qicq , 'xingm' => $xingm , 'subject' => $subject , 'renumber' => $renumber ,'dateline' => $dateline));
					DB::update('forum_activity_ar', array('nember' => $countbm+1), "id='$tid'");
					showmessage(lang('plugin/dz55625_activity', 'chenggcanj'), dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
				}else{
					showmessage(lang('plugin/dz55625_activity', 'chongfubm'), dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
				}
			}

		}
		include template('dz55625_activity:huodong_bm');
}

if($_GET['option'] == 'rchakan'){
	
	$id = intval($_G['gp_sid']);
	$sql = "SELECT * FROM ".DB::table('forum_activity_ur')." WHERE id='$id' ORDER BY dateline DESC";
	$query = DB::query($sql);
	$baoming = $baomings = array();
	while($baoming = DB::fetch($query)){
		$baomings[] = $baoming;
	}
	include template('dz55625_activity:huodong_rchakan');	
}

?>