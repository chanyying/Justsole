<?php
/*
	[55625.COM!] (C)2001-2012 55625.COM Inc.
	BY QQ:114512039  Lovenr
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

loadcache('plugin');
@extract($_G['cache']['plugin']['dz55625_activity']);
$listclass=parconfig($listclass);
$p = $_G['gp_p'];
$p = $p?$p:'index';
$appurls=$_G['siteurl']."plugin.php?id=dz55625_activity:huodong_user";

if($p=='index'){
	
	if($_G['groupid']==7){
		showmessage(lang('plugin/dz55625_activity', 'loginno'), '', array(), array('login' => true));
	}
	$uid = intval($_G['uid']);
	$countr = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_activity_ar')." WHERE uid='$uid'");
	$pager = intval($_GET['page']);
	$pager = max($pager, 1);
	$starts = ($pager - 1) * 8;
	
	if($countr) {
		$rs=DB::query("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE uid='$uid' ORDER BY dateline DESC LIMIT $starts,8");
		while ($rw=DB::fetch($rs)){
			$manylist[]=$rw;
		}
	}
	
	$appurl=$_G['siteurl']."plugin.php?id=dz55625_activity:huodong_user&p=index";
	$multir = "<div class='pages cl' style='margin-top:10px;'>".multi($countr, 8, $pager, $appurl.$pageadd)."</div>";

}elseif($p=='edit'){
	
		$uid = intval($_G['uid']);
		$id = intval($_G['gp_vid']);
		$active = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id ='{$id}' AND uid='$uid' LIMIT 0 , 1");
		if($active['uid']!=$uid){
			showmessage(lang('plugin/dz55625_activity', 'loginno'), '', array(), array('login' => true));	
		}

		if($_POST){
			$did = intval($_G['gp_acid']);
			$uid = intval($_G['uid']);
			$author = addslashes($_G['username']);
			$pic = addslashes($_G['gp_pic']);
			$title=addslashes($_G['gp_title']);
			$summary=addslashes($_G['gp_summary']);
			$address=addslashes($_G['gp_address']);
			$tel = addslashes($_G['gp_tel']);
			$dateline = $_G['timestamp'];
			$jtime = strtotime($_G['gp_jtime']);
			$mapx = addslashes($_G['gp_mapx']);
			$mapy = addslashes($_G['gp_mapy']); 
			$display = intval($displays) == 1 ? 1 : 0; 
			$cost = addslashes($_G['gp_cost']) =='' ? 0 : addslashes($_G['gp_cost']); 
			
			if($_FILES['file']['error']==0){
				$rand=date("YmdHis").random(3, $numeric =1);
				$filesize = $_FILES['file']['size'] <= $picdx ;   // ·âÃæÍ¼Æ¬´óÐ¡
				$filetype = array("jpg", "jpeg", "gif", "png");
				$arr=explode(".", $_FILES["file"]["name"]);
				$hz=$arr[count($arr)-1];
				if(!in_array($hz, $filetype)){
					showmessage(lang('plugin/dz55625_activity', 'zhiyunxu'));	
				}
				$filepath = "source/plugin/dz55625_activity/upimg/";
				$randname = date("Y").date("m").date("d").date("H").date("i").date("s").rand(100, 999).".".$hz;
			
				if($filesize){ 
					if(@copy($_FILES['file']['tmp_name'], $filepath.$randname) || (function_exists('move_uploaded_file') && @move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$randname))) {
						 @unlink($_FILES['file']['tmp_name']);
					}
				}else{
					showmessage(lang('plugin/dz55625_activity', 'chaoguodax'));	
				}
				$pic = "source/plugin/dz55625_activity/upimg/".$randname."";
			}
							
			DB::update('forum_activity_ar', array('did' => $did, 'img' => $pic, 'title' => $title, 'summary' => $summary, 'address' => $address, 'tel' => $tel, 'jtime' => $jtime, 'mapx' => $mapx, 'mapy' => $mapy, 'cost' => $cost), "id='$id'");
			
			
			showmessage(lang('plugin/dz55625_activity', 'xinxibianjok'), $appurls, array(), array('alert' => right));
		}

}elseif($p=='del'){
	$id=intval($_G['gp_vid']);
	$active=DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id ='{$id}' AND uid='$uid' LIMIT 0 , 1");
	if($active['uid']!=$uid){
		showmessage(lang('plugin/dz55625_activity', 'loginno'), '', array(), array('login' => true));	
	}
	DB::query("DELETE a,b FROM ".DB::table('forum_activity_ar')." AS a LEFT JOIN ".DB::table('forum_activity_ur')." AS b ON a.id = b.tid WHERE a.id = '$id' ");
	if ($active["img"]!=false){
		unlink($active["img"].$filetype);
	}
	showmessage(lang('plugin/dz55625_activity', 'shanchuok'), $appurls, array(), array('alert' => right));		
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

include template($identifier.':huodong_user');

?>
