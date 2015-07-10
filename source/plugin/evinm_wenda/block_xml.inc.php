<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$clientid = intval($_G['gp_clientid']);
$sign = daddslashes(trim($_G['gp_sign']));
$clientcharset = strtolower(trim($_G['gp_charset']));
$clientcharset = str_replace('-', '', $clientcharset);
$servercharset = CHARSET;
$clientcharset = in_array($clientcharset, array('gbk', 'utf8')) ? $clientcharset : $servercharset;
$auc = $wdlists = array();

if(empty($clientid) || empty($sign)) {
	exit('CLIENT_SIGN_ERROR');
}

$client_check = 0;
$client_check = DB::result_first("SELECT COUNT(*) FROM ".DB::table('evinm_wenda_xml')." WHERE clientid='$clientid' AND sign='$sign'");
$servercharset = CHARSET;


if($client_check) {
	if($_G['gp_op'] == 'getconfig') {
		$xml = file_get_contents(DISCUZ_ROOT.'./source/plugin/evinm_wenda/xml/block_xml.setting.'.$clientcharset.'.xml');
	} elseif($_G['gp_op'] == 'getdata') {
//	charset	=>gbk
//	clientid	=>1
//	items	=>10  		条数
//	op	=>getdata  	
//	order	=>1 		顺序 1=>发布时间倒叙 0=>回答数倒叙 2=>赏金倒叙
//	stat	=>0,1,	当前状态 0=>已解决 1=>未解决 2=>高悬赏
//	start	=>2 		limit里的start
//	qids	=>12,123  	qid 问题id
//	version	=>X2
//	sign	=>123
		$sqladd 	= array();
		$stat	 	= get_int_from_string($_G['gp_stat'], array(0, 1, 2));
		$qids 		= get_int_from_string($_G['gp_qids']);
		$start 		= max(0, intval($_G['gp_start']));
		$order 		= intval($_G['gp_order']);
		$num 		= max(1, intval($_G['gp_items']));
		//$num 		= $num > 10 ? 10 : $num;
		$width 		= intval($_G['gp_width']);
		$height 	= intval($_G['gp_height']);
		$typeid 	= get_int_from_string($_G['gp_type'], array(1, 2, 3));


		if(!empty($qids)) {
			$sqladd[] = 'id IN ('.dimplode($qids).')';
		}

		if(count($stat) < 3) {
			$sql_tmp = '';
			foreach($stat as $status) {
				if($status == 0) {
					$sql_tmp[] = "over>=0";
				}
				if($status == 1) {
					$sql_tmp[] = "over=1";
				}
				if($status == 2) {
					$sql_tmp[] = "over=0";
				}
			}
			$sql_tmp = implode(' OR ', $sql_tmp);
			$sqladd[] = '('.$sql_tmp.')';
		}

		if($order == 0) {
			$orderby = "nums_a DESC";
		}
		if($order == 1) {
			$orderby = "posttime DESC";
		}
		if($order == 2) {
			$orderby = "coin DESC";
		}
		
		$query = DB::query("SELECT * FROM ".DB::table('evinm_wenda_ask')." ".($sqladd ? 'WHERE ' : '').implode(' AND ', $sqladd).' and `shenhe` = 0 ORDER BY '.$orderby." LIMIT $start,$num");
		//$query = DB::query("SELECT * FROM ".DB::table('evinm_wenda_ask')." LIMIT $start,$num");
		
		while($rows = DB::fetch($query)) {
		
			$wenda['id'] = $rows['id'];
			$wenda['pic'] = $rows['pic'];
			$wenda['fields']['coin'] = $rows['coin'];
			$wenda['title'] = $rows['subject'];
			$wenda['summary'] = $rows['subject'];
			$wenda['url'] = $_G['siteurl']."plugin.php?id=evinm_wenda:list_article&qid=".$rows['id'];
			$wenda['fields']['author'] = uid2name($rows['uid']);
			$wenda['fields']['authorid'] = $rows['uid'];
			if($rows['over'] == '1') {
				$wenda['fields']['stat'] == '已解决';
			}
			if($rows['over'] == '0') {
				$wenda['fields']['stat'] == '未解决';
			}			
			$wenda['fields']['hot'] = $wenda['nums_a'];
			
			$wdlists[] = $wenda;
		}

		require_once libfile('class/xml');
		$xmlarray = array('html' => '', 'data' => $wdlists);
		$xml = array2xml($xmlarray);

	} else {
		exit('OPERATION_ERROR');
	}
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");
	header("Content-type: text/xml;charset=".$clientcharset.';');
	echo $xml;
	exit();
} else {
	exit('CLIENT_SIGN_ERROR');
}


function get_int_from_string($str, $array = null) {
	$str = trim($str);
	$ids_tmp = explode(',', $str);
	$ids = array();
	foreach($ids_tmp as $key => $id) {
		$id = intval($id);
		if($array) {
			in_array($id, $array) && $ids[] = $id;
		} elseif(!empty($id)){
			$ids[] = $id;
		}
	}
	return $ids;
}
function uid2name($uid){ 
	if(!$uid){ 
	}else{ 
		$username = DB::result_first("select username from ".DB::table('common_member')." where `uid` = ".intval($uid)); 
		$username = $username ?$username : ''; 
	} 
	return $username; 
} 

?>
