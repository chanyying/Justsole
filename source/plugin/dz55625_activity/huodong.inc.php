<?php
/*
	[55625.COM!] (C)2001-2012 55625.COM Inc.
	BY QQ:114512039  Lovenr
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/discuzcode');
include_once 'source/plugin/dz55625_activity/function.php';

global $_G;
if(!isset($_G['cache']['plugin'])){ loadcache('plugin'); }
@extract($_G['cache']['plugin']['dz55625_activity']);
$listclass = parconfig($listclass);
$uc = $_G['setting'][ucenterurl] ;
$montharray=array();
$lastmonthnum=10;
$thismonthktime=strtotime(date('Y-m-01',$_G['timestamp']));
$montharray[0]=$thismonthktime;
for($i=1;$i<$lastmonthnum;$i++){
	$montharray[$i]=strtotime("-$i month",$thismonthktime);
}
$lastmonthago=end($montharray);

if(!$_G['gp_mod']){
	
	$curl = 'plugin.php?id=dz55625_activity:huodong&mod=view&vid=';
	//----------------------------------------------------
	$sarr = array();
	$where=$pageadd='';
	$did=intval($_G['gp_c']);
	if($did){
		$where="did='$did' AND";
		$pageadd="&c=$did";
	}
	if(isset($_G['gp_s'])){
		$where=monthwhere($_G['gp_s']);
		$pageadd="&s={$_G['gp_s']}";
	}
	
	$px='DESC';
	if($_G['gp_px']){ $px="ASC"; $pageadd="&px=d"; }
	
	if ($did){ $av_ds[$did] = ' class="haodians_hover"'; $sarr[] = "did='$did'";
	}else{$av_ds[0] = ' class="haodians_hover"';}
	
	$types = trim($_G['gp_types']);	
	if ($types){
		if ($types==1){
			$sa[] = "cost = '0' AND";
		}elseif($types==2){
			$sa[] = "cost > '0' AND";
		} elseif($types==3) {
			$sa[] = "nember > '0' AND";
		}
	}
	if ($sa){ $where = "" . implode(" AND ", $sa) . ""; }
	
	//----------------------------------------------------
	$counts = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_activity_ar')." WHERE $where display!='0'");
	$pages = intval($_GET['page']);
	$pages = max($pages, 1);
	$starts = ($pages - 1) * $eacha;
	
	//活动展示
	if($counts) {
		$sql = "SELECT * FROM ".DB::table('forum_activity_ar')." WHERE $where display!='0' ORDER BY dateline $px LIMIT $starts,$eacha";
		$query = DB::query($sql);
		$mythread = $mythreads = array();
		while($mythread = DB::fetch($query)){
			$mythread['dateline'] = gmdate('m-d', $mythread['dateline'] + $_G['setting']['timeoffset'] * 3600);
			$mythread['title'] = cutstr($mythread['title'], 30, '.');
			$mythreads[] = $mythread;
		}
	}
	$appurl=$_G['siteurl']."plugin.php?id=dz55625_activity:huodong";
	$multis = "<div class='pages cl'>".multi($counts, $eacha, $pages, $appurl.$pageadd)."</div>";
	
}elseif($_G['gp_mod']=='add'){

	$groups = unserialize($groups);
	$admins = explode(",", $groupso);
	if(!in_array($_G['groupid'], $groups)){
					showmessage(lang('plugin/dz55625_activity', 'dangqianuser'), '', array(), array('login' => true));
	}else{
		if(submitcheck('applysubmits')){
			if(empty($_G['gp_title'])){
				showmessage(lang('plugin/dz55625_activity', 'titleno'), dreferer());
			}else{
			$did = intval($_G['gp_acid']);
			$uid = intval($_G['uid']);
			$author = addslashes($_G['username']);
			$title=addslashes($_G['gp_title']);
			$summary=addslashes($_G['gp_summary']);
			$address=addslashes($_G['gp_address']);
			$tel = addslashes($_G['gp_tel']);
			$dateline = $_G['timestamp'];
			$ktime = $_G['timestamp'];
			$jtime = strtotime($_G['gp_jtime']);
			$mapx = addslashes($_G['gp_mapx']);
			$mapy = addslashes($_G['gp_mapy']); 
			$display = intval($displays) == 1 ? 1 : 0; 
			$cost = addslashes($_G['gp_cost']) =='' ? 0 : addslashes($_G['gp_cost']); 
			
			if($_FILES['file']['error']==0){
				$rand=date("YmdHis").random(3, $numeric =1);
				$filesize = $_FILES['file']['size'] <= $picdx ;   // 封面图片大小
				$filetype = array("jpg", "jpeg", "gif", "png");
				$arr=explode(".", $_FILES["file"]["name"]);
				$hz=$arr[count($arr)-1];
				if(!in_array($hz, $filetype)){
					showmessage(lang('plugin/dz55625_activity', 'zhiyunxu'));	
				}
				$filepath = "source/plugin/dz55625_activity/upimg/".date("Ymd")."/";
				$randname = date("Y").date("m").date("d").date("H").date("i").date("s").rand(100, 999).".".$hz;
				if(!file_exists($filepath)){ mkdir($filepath); }
				if($filesize){ 
					if(@copy($_FILES['file']['tmp_name'], $filepath.$randname) || (function_exists('move_uploaded_file') && @move_uploaded_file($_FILES['file']['tmp_name'], $filepath.$randname))) {
						 @unlink($_FILES['file']['tmp_name']);
					}
				}else{
					showmessage(lang('plugin/dz55625_activity', 'chaoguodax'));	
				}
				$pic = "source/plugin/dz55625_activity/upimg/".date("Ymd")."/".$randname."";
			}
			
			//-----------------------------------------------------
			DB::query("INSERT INTO ".DB::table('forum_activity_ar')." ( `id` , `did`, `uid`, `author` , `img` ,`title` ,`summary`, `address` , `tel`, `ktime`, `jtime`, `mapx`, `mapy`, `display` , `cost` , `dateline` ) VALUES (NULL , '$did', '$uid', '$author', '$pic','$title','$summary', '$address', '$tel', '$ktime', '$jtime', '$mapx', '$mapy', '$display', '$cost', '$dateline');");
			
			}
			
			if($displays == 0){
				for($i=0;$i<count($admins);$i++){
					notification_add($admins[$i], 'system',lang('plugin/dz55625_activity', 'xinxitxing'),  $notevars = array(), $system = 0);
				}
				showmessage(lang('plugin/dz55625_activity', 'lshenhe'), 'plugin.php?id=dz55625_activity:huodong', array(), array('alert' => right));
				
				}else{
				showmessage(lang('plugin/dz55625_activity', 'huodongokf'), 'plugin.php?id=dz55625_activity:huodong', array(), array('alert' => right));
			}
			
		}
	}

}elseif($_G['gp_mod']=='view'){
	
	
	$vid = intval($_G['gp_vid']);
	$countbm = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_activity_ur')." WHERE tid='$vid'");
	$sql = "SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id='$vid'";
	$query = DB::query($sql);
	$mythread = $mythreads = array();
	while($mythread = DB::fetch($query)){
		$mythread['summary'] = discuzcode($mythread['summary'], 1, 0, 0, 0, 1, 1, 0, 0, 1);
		$mythread['title'] = cutstr($mythread['title'], 35, '.');
		$mythreads[] = $mythread;
	}
	//-------------------------------------------
	$sql = "SELECT * FROM ".DB::table('forum_activity_ur')." WHERE tid='$vid' ORDER BY dateline DESC";
	$query = DB::query($sql);
	$baoming = $baomings = array();
	while($baoming = DB::fetch($query)){
		$baoming['dateline'] = gmdate('Y-m-d H:i:s', $baoming['dateline'] + $_G['setting']['timeoffset'] * 3600);
		$baoming['telx'] = $baoming['tels'];
		$baoming['qicx'] = $baoming['qicq'];
		$baoming['qicq'] = preg_replace('/(^.*)\d{3}(\d{3})$/','\\1****\\2',$baoming['qicq']);
		$baoming['tels'] = preg_replace('/(^.*)\d{4}(\d{4})$/','\\1****\\2',$baoming['tels']);
		$baomings[] = $baoming;
	}

	//-------------------------------------------
	$set = $_G['cache']['plugin']['dz55625_activity'];
	foreach($_G['setting']['extcredits'] as $key => $value){
		$ext = 'extcredits'.$key;
		getuserprofile($ext);
		$person['extcredits'][$key]['title'] = $value['title'];
		$person['extcredits'][$key]['value'] = $_G['member'][$ext];
	}

	if($_GET['option'] == 'xianhua'){
		if($_G['groupid']==7){
			showmessage(lang('plugin/dz55625_activity', 'loginno'), '', array(), array('login' => true));	
		}
		if($person['extcredits'][$set[extcredit]]['value']<$set[credit]){
			$mess=lang('plugin/dz55625_activity', 'ninde').$person['extcredits'][$set[extcredit]]['title'].lang('plugin/dz55625_activity', 'buzu').$set[credit]."";
			showmessage(lang('plugin/dz55625_activity', $mess), "plugin.php?id=dz55625_activity:huodong&mod=view&vid=$vid", array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
		}
		updatemembercount($_G['uid'], array($set[extcredit] => -$set[credit]));
		$digginfo = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id='$vid'");
		$xianhua=$digginfo[xianhua]+1;
		DB::query("UPDATE ".DB::table('forum_activity_ar')." SET xianhua='$xianhua' WHERE id='$vid'");
		showmessage(lang('plugin/dz55625_activity', 'ganxiezhichi'), "plugin.php?id=dz55625_activity:huodong&mod=view&vid=$vid", array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
	}elseif($_GET['option'] == 'jidan'){
		if($_G['groupid']==7){
			showmessage(lang('plugin/dz55625_activity', 'loginno'), '', array(), array('login' => true));	
		}
		if($person['extcredits'][$set[extcredit]]['value']<$set[credit]){
			$mess=lang('plugin/dz55625_activity', 'ninde').$person['extcredits'][$set[extcredit]]['title'].lang('plugin/dz55625_activity', 'buzu').$set[credit]."";
			showmessage(lang('plugin/dz55625_activity', $mess), "plugin.php?id=dz55625_activity:huodong&mod=view&vid=$vid", array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
		}
		updatemembercount($_G['uid'], array($set[extcredit] => -$set[credit]));
		$digginfo = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_ar')." WHERE id='$vid'");
		$jidan=$digginfo[jidan]+1;
		DB::query("UPDATE ".DB::table('forum_activity_ar')." SET jidan='$jidan' WHERE id='$vid'");
		showmessage(lang('plugin/dz55625_activity', 'xiacijixunl'), "plugin.php?id=dz55625_activity:huodong&mod=view&vid=$vid", array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
	}
	//-------------------------------------------
	
	
		
}
include template($identifier.':huodong_index');

?>
