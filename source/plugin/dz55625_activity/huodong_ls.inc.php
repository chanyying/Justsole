<?php
/*
	[55625.COM!] (C)2001-2012 55625.COM Inc.
	BY QQ:114512039  Lovenr
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

loadcache('plugin');
$adminpagenum = 15;
@extract($_G['cache']['plugin']['dz55625_activity']);
include_once 'source/plugin/dz55625_activity/function.php';

$listclass = parconfig($listclass);
$p = addslashes($_G['gp_p']);
$p = $p?$p:'index';
$appurl=$_G['siteurl']."admin.php?action=plugins&operation=config&do=$pluginid&identifier=dz55625_activity&pmod=huodong_ls";

if($p=='index'){

	$where=$pageadd='';
	$did = intval($_G['gp_c']);
	if($did){
		$where="WHERE did='$did'";
		$pageadd="&c=$did";
	}
	if($_G['gp_title']){
		$title=addslashes($_G['gp_title']);
		$where="WHERE title like '%$title%'";
		$titleenc=urlencode($title);
		$pageadd="&title=$titleenc";
	}
	$page = $_G['page'];
	$begin = ($page-1)*$adminpagenum;
	$manylist = array();
	
	$rs=DB::query("SELECT * FROM ".DB::table('forum_activity_ar')." $where ORDER BY dateline DESC LIMIT $begin,$adminpagenum");
	
	while ($rw=DB::fetch($rs)){
		$manylist[]=$rw;
	}

	$allnum=DB::result_first("SELECT count(*) FROM ".DB::table('forum_activity_ar')." $where");
	$pagenav=multi($allnum,$adminpagenum,$page,$appurl."&p=$p".$pageadd);
	
	include(template("dz55625_activity:admin_list"));


}elseif ($p=='edit'){
	
	$id = intval($_G['gp_id']);
	$active=DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id ='{$id}' LIMIT 0 , 1");
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
				cpmsg(lang('plugin/dz55625_activity', 'zhiyunxu'),$appurl);
			}
			$filepath = "source/plugin/dz55625_activity/upimg/".date("Ymd")."/";
			$randname = date("Y").date("m").date("d").date("H").date("i").date("s").rand(100, 999).".".$hz;
			if(!file_exists($filepath)){ mkdir($filepath); }
			if($filesize){ 
				if(@copy($_FILES['file']['tmp_name'], $filepath.$randname) || (function_exists('move_uploaded_file') && @move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$randname))) {
					 @unlink($_FILES['file']['tmp_name']);
				}
			}else{
				cpmsg(lang('plugin/dz55625_activity', 'chaoguodax'),$appurl);
			}
			$pic = "source/plugin/dz55625_activity/upimg/".date("Ymd")."/".$randname."";
		}
		
		//-----------------------------------------------------

		DB::update('forum_activity_ar', array('did' => $did, 'img' => $pic, 'title' => $title, 'summary' => $summary, 'address' => $address, 'tel' => $tel, 'jtime' => $jtime, 'mapx' => $mapx, 'mapy' => $mapy, 'cost' => $cost), "id='$id'");
		
		cpmsg(lang('plugin/dz55625_activity', 'xinxibianjok'),$appurl);
	}
	
	include(template("dz55625_activity:admin_edit"));	
}elseif($p=='check'){
	
	if($_GET['operation'] == 'yes'){
		$id = intval($_GET['id']);
		DB::query("UPDATE ".DB::table('forum_activity_ar')." SET display='1' WHERE id='$id'");
		cpmsg(lang('plugin/dz55625_activity', 'lshengheok'),$appurl);
	}elseif($_GET['operation'] == 'no'){
		$id = intval($_GET['id']);
		DB::query("UPDATE ".DB::table('forum_activity_ar')." SET display='0' WHERE id='$id'");
		cpmsg(lang('plugin/dz55625_activity', 'lpingbiok'),$appurl);
	}
		
}elseif ($p=='del'){
	$id=intval($_G['gp_id']);
	$active=DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id ='{$id}' LIMIT 0 , 1");
	DB::query("DELETE a,b FROM ".DB::table('forum_activity_ar')." AS a LEFT JOIN ".DB::table('forum_activity_ur')." AS b ON a.id = b.tid WHERE a.id = '$id' ");
	if ($active["img"]!=false){
		unlink($active["img"].$filetype);
	}
	cpmsg(lang('plugin/dz55625_activity', 'shanchuok'),$appurl);
}

?>