<?php
/**
 *	[�����ʴ�(tsound_wenda.{modulename})] (C)2013-2099 Powered by .
 *	Version: 1.0
 *	Date: 2013-2-25 21:23
 */

if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}

require_once DISCUZ_ROOT . './source/plugin/tsound_wenda/include/function.inc.php';
$action = $_G ['onez_action'];

$baseurl = 'plugin.php?id=tsound_wenda';
$credit = $tsound_wenda ['credit'];

//grzx start
$grzxmodule1 = 'source/plugin/tsound_wenda/include/include_grzx_module1.inc.php';
if (file_exists ( $grzxmodule1 )) {
	require_once ($grzxmodule1);
}
//grzx end


function getSideData() {
	global $credit, $_G;
	$A = array ();
	$A ['users'] = array ();
	$row = DB::fetch_first ( 'SELECT * FROM ' . DB::table ( 'common_member_count' ) . ' where uid=' . $_G ['uid'] );
	$query = DB::query ( 'SELECT * FROM ' . DB::table ( 'common_member_count' ) . " where extcredits$credit>0 order by extcredits$credit desc limit 10" );
	$i = 0;
	while ( $rs = DB::fetch ( $query ) ) {
		$r = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'common_member' ) . " where uid='$rs[uid]'" );
		$i ++;
		$r ['index'] = $i;
		$r ['credit'] = $rs ['extcredits' . $credit];
		$A ['users'] [] = $r;
	}
	
	return $A;
}
switch ($action) {
	case 'category' :
		$cid = ( int ) $_G ['onez_cid'];
		$type = $_G ['onez_type'];
		$q = $_G ['onez_q'];
		
		$xxx = $cid ? "pcid='$cid'" : "pcid='0'";
		$list1 = $list2 = $list3 = array ();
		$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where $xxx ORDER BY step,cid" );
		while ( $rs = DB::fetch ( $query ) ) {
			$list1 [] = $rs;
		}
		if ($cid) {
			$C = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$cid'" );
			$category = $C ['name'];
			if ($C ['pcid'] == 0) {
				$where = ' &raquo; <a href="' . $baseurl . '&action=category&cid=' . $cid . '">' . $C ['name'] . '</a>';
				$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='$cid' ORDER BY step,cid" );
				while ( $rs = DB::fetch ( $query ) ) {
					$cid .= ',' . $rs ['cid'];
				}
			} else {
				$C = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$C[pcid]'" );
				$where = ' &raquo; <a href="' . $baseurl . '&action=category&cid=' . $C ['cid'] . '">' . $C ['name'] . '</a>';
				$C = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$cid'" );
				$where .= ' &raquo; <span>' . $C ['name'] . '</span>';
			}
		}
		$xxx = '';
		$cid && $xxx .= " and cid in ($cid)";
		list ( $cid ) = explode ( ',', $cid );
		if ($type == 'success') {
			$xxx .= " and aid>0";
			$question1 = ' class="on"';
		} elseif ($type == 'high') {
			$xxx .= " and coin='$tsound_wenda[high]'";
			$question2 = ' class="on"';
		} elseif ($type == 'none') {
			$xxx .= " and answer='0'";
			$question3 = ' class="on"';
		} else {
			$xxx .= " and aid='0'";
			$question0 = ' class="on"';
		}
		$q && $xxx .= " and title like '%$q%'";
		
		//add by genee 20130502 start
		$authmodule = 'source/plugin/tsound_wenda/include/include_authority_module2.inc.php';
		if (file_exists ( $authmodule )) {
			require_once ($authmodule);
		}
		//add by genee 20130502 end
		

		$page = max ( 1, $page );
		$perpage = 20;
		$count = DB::num_rows ( DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_question' ) . " where 1 $isAuth $xxx   " ) );
		$multi = multi ( $count, $perpage, $page, $baseurl . '&action=record&type=' . $type . '&cid=' . $cid . '&q=' . urlencode ( $q ) );
		$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_question' ) . " where 1 $isAuth $xxx order by qid desc limit " . (($page - 1) * $perpage) . ',' . $perpage );
		while ( $rs = DB::fetch ( $query ) ) {
			$r = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$rs[cid]'" );
			$rs ['catname'] = $r ['name'];
			$rs ['time'] = date ( 'm-d H:i', $rs ['time'] );
			$list2 [] = $rs;
		}
		
		//add by genee 20130429 start
		$categorymodule = 'source/plugin/tsound_wenda/include/include_category_module1.inc.php';
		if (file_exists ( $categorymodule )) {
			require_once ($categorymodule);
		}
		//add by genee 20130429 end
		

		include template ( 'tsound_wenda:category' );
		break;
	case 'setbest' :
		$qid = ( int ) $_G ['onez_qid'];
		$Q = DB::fetch_first ( "SELECT q.*,r.file,m.username FROM " . DB::table ( 'tsound_wenda_question' ) . " q left join " . DB::table ( 'tsound_wenda_record' ) . " r on r.rid=q.rid left join " . DB::table ( 'common_member' ) . " m on m.uid=q.uid where q.qid='$qid'" );
		if (! $Q) {
			showmessage ( lang ( 'plugin/tsound_wenda', 'notexists' ) );
		}
		$aid = ( int ) $_G ['onez_aid'];
		$A = DB::fetch_first ( "SELECT a.*,r.file,m.username FROM " . DB::table ( 'tsound_wenda_answer' ) . " a left join " . DB::table ( 'tsound_wenda_record' ) . " r on r.rid=a.rid left join " . DB::table ( 'common_member' ) . " m on m.uid=a.uid where a.aid='$aid'" );
		if (! $A) {
			showmessage ( lang ( 'plugin/tsound_wenda', 'notexists2' ) );
		}
		if ($Q ['uid'] == $_G ['uid'] && ! $Q ['aid'] && $A ['uid'] != $Q ['uid']) {
			updatemembercount ( $A ['uid'], array ($credit => $Q ['coin'] ) );
			DB::update ( 'tsound_wenda_question', array ('aid' => $aid ), "qid='$qid'" );
		} else {
			showmessage ( lang ( 'plugin/tsound_wenda', 'lowgrade' ) );
		}
		showmessage ( lang ( 'plugin/tsound_wenda', 'done_successfully' ), $baseurl . '&action=question&qid=' . $qid );
		break;
	case 'question' :
		
		$qid = ( int ) $_G ['onez_qid'];
		$Q = DB::fetch_first ( "SELECT q.*,r.file,m.username FROM " . DB::table ( 'tsound_wenda_question' ) . " q left join " . DB::table ( 'tsound_wenda_record' ) . " r on r.rid=q.rid left join " . DB::table ( 'common_member' ) . " m on m.uid=q.uid where q.qid='$qid'" );
		if (! $Q) {
			showmessage ( lang ( 'plugin/tsound_wenda', 'notexists' ) );
		}
		
		//add by genee 20130429 start
		$categorymodule = 'source/plugin/tsound_wenda/include/include_category_module1.inc.php';
		if (file_exists ( $categorymodule )) {
			$_G ['onez_cid'] = $Q ['cid'];
			require_once ($categorymodule);
		}
		//add by genee 20130429 end
		

		//add by genee 20130502 start
		$authmodule3 = 'source/plugin/tsound_wenda/include/include_authority_module3.inc.php';
		if (file_exists ( $authmodule3 )) {
			
			require_once ($authmodule3);
		}
		//add by genee 20130502 end
		

		//add by genee 20130429 start
		$readpaymodule1 = 'source/plugin/tsound_wenda/include/include_readpay_module1.inc.php';
		if (file_exists ( $readpaymodule1 )) {
			require_once ($readpaymodule1);
		}
		//add by genee 20130429 end
		

		if ($_POST) {
			if (empty ( $_G ['uid'] )) {
				showmessage ( lang ( 'plugin/tsound_wenda', 'nologin' ), '', array (), array ('login' => true ) );
			}
			if ($_G ['uid'] == $Q ['uid']) {
				//showmessage(lang('plugin/tsound_wenda','selfanswer'));
			}
			$content = $_G ['onez_content'];
			$rid = ( int ) $_G ['onez_rid'];
			$aid = DB::insert ( 'tsound_wenda_answer', array ('uid' => $_G ['uid'], 'time' => TIMESTAMP, 'content' => $content, 'qid' => $qid, 'rid' => $rid, 'cid' => $Q ['cid'] ) );
			DB::query ( "update " . DB::table ( 'tsound_wenda_question' ) . " set answer=answer+1 where qid='$qid'" );
			
			//add by genee 20130429 start
			$tuisongmodule = 'source/plugin/tsound_wenda/include/include_coinforum1.inc.php';
			if (file_exists ( $tuisongmodule )) {
				require_once ($tuisongmodule);
			}
			//add by genee 20130429 end
			

			//add by genee 20130429 start
			$hdmodule = 'source/plugin/tsound_wenda/include/include_gethdcredit.inc.php';
			if (file_exists ( $hdmodule )) {
				require_once ($hdmodule);
			}
			//add by genee 20130429 end
			

			showmessage ( lang ( 'plugin/tsound_wenda', 'success_reply' ), $baseurl . '&action=question&qid=' . $qid );
			exit ();
		}
		if ($Q ['aid']) {
			$A = DB::fetch_first ( "SELECT a.*,r.file,m.username FROM " . DB::table ( 'tsound_wenda_answer' ) . " a left join " . DB::table ( 'tsound_wenda_record' ) . " r on r.rid=a.rid left join " . DB::table ( 'common_member' ) . " m on m.uid=a.uid where a.aid='$Q[aid]'" );
			if ($A) {
				$resloved = ' resloved';
				$A ['file'] && $A ['sound'] = tsound_wenda_player ( $A ['file'] );
				$A ['time'] = date ( 'Y-m-d H:i:s', $A ['time'] );
				$A ['content'] = tsound_wenda_content ( $A, 0 );
				$A ['money'] = $Q ['coin'] > 0 ? '+' . $Q ['coin'] : '';
			}
		}
		
		$sound = $_G ['siteurl'] . '/' . $Q ['file'];
		$time = date ( 'Y-m-d H:i:s', $Q ['time'] );
		$Q ['file'] && $Q ['sound'] = tsound_wenda_player ( $Q ['file'] );
		$Q ['content'] = tsound_wenda_content ( $Q, 1 );
		$cid = $Q ['cid'];
		if ($cid) {
			$C = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$cid'" );
			$category = $C ['name'];
			if ($C ['pcid'] == 0) {
				$where = ' &raquo; <a href="' . $baseurl . '&action=category&cid=' . $cid . '">' . $C ['name'] . '</a>';
				$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='$cid' ORDER BY step,cid" );
				while ( $rs = DB::fetch ( $query ) ) {
					$cid .= ',' . $rs ['cid'];
				}
			} else {
				$C = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$C[pcid]'" );
				$where = ' &raquo; <a href="' . $baseurl . '&action=category&cid=' . $C ['cid'] . '">' . $C ['name'] . '</a>';
				$C = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where cid='$cid'" );
				$where .= ' &raquo; <span>' . $C ['name'] . '</span>';
			}
		}
		
		$answers = array ();
		$query = DB::query ( "SELECT a.*,m.username FROM " . DB::table ( 'tsound_wenda_answer' ) . " a left join " . DB::table ( 'common_member' ) . " m on m.uid=a.uid where a.qid='$qid' order by a.aid desc" );
		$i = 0;
		while ( $rs = DB::fetch ( $query ) ) {
			$i ++;
			$sec = TIMESTAMP - $rs ['time'];
			if ($sec > 86400) {
				$rs ['day'] = intval ( $sec / 86400 ) . lang ( 'plugin/tsound_wenda', 'day_day' );
			} elseif ($sec > 3600) {
				$rs ['day'] = intval ( $sec / 3600 ) . lang ( 'plugin/tsound_wenda', 'day_hour' );
			} elseif ($sec > 60) {
				$rs ['day'] = intval ( $sec / 60 ) . lang ( 'plugin/tsound_wenda', 'day_minute' );
			} else {
				$rs ['day'] = intval ( $sec ) . lang ( 'plugin/tsound_wenda', 'day_second' );
			}
			$rs ['odd'] = $i % 2 == 0 ? 'odd' : '';
			$rs ['time'] = date ( 'm-d H:i', $rs ['time'] );
			$rs ['content'] = tsound_wenda_content ( $rs, 0 );
			$answers [] = $rs;
		}
		$answer_count = count ( $answers );
		$flashvars = "url=" . urlencode ( $_G ['siteurl'] . '/' . $baseurl . '&action=addpic' );
		$flash = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/upload.swf', $flashvars, 77, 20, 'tsound_pic' );
		
		$side = getSideData ();
		include template ( 'tsound_wenda:question' );
		break;
	case 'coinadd' :
		$qid = ( int ) $_G ['onez_qid'];
		$row = DB::fetch_first ( 'SELECT * FROM ' . DB::table ( 'common_member_count' ) . ' where uid=' . $_G ['uid'] );
		$money = $row ['extcredits' . $credit];
		$credit_title = $_G ['setting'] ['extcredits'] [$credit] ['title'];
		$credit_unit = $_G ['setting'] ['extcredits'] [$credit] ['unit'];
		if ($_POST) {
			if (empty ( $_G ['uid'] )) {
				showmessage ( lang ( 'plugin/tsound_wenda', 'nologin' ), '', array (), array ('login' => true ) );
			}
			
			$coin = abs ( ( int ) $_G ['onez_coin'] );
			if ($coin && $money < $coin) {
				showmessage ( lang ( 'plugin/tsound_wenda', 'credit_low' ) );
			}
			DB::query ( "update " . DB::table ( 'tsound_wenda_question' ) . " set coin=coin+$coin where qid='$qid'" );
			updatemembercount ( $_G ['uid'], array ($credit => - $coin ) );
			
			showmessage ( lang ( 'plugin/tsound_wenda', 'success_coinadd' ), $baseurl . '&action=question&qid=' . $qid );
			exit ();
		}
		$ti = lang ( 'plugin/tsound_wenda', 'coinadd' );
		include template ( 'tsound_wenda:coinadd' );
		break;
	//    add by genee start 
	case 'coindelete' :
		$deletemodule = 'source/plugin/tsound_wenda/include/include_coindelete.inc.php';
		if (file_exists ( $deletemodule )) {
			require_once ($deletemodule);
		}
		break;
	//    add by genee end     
	case 'question_other' :
		$qid = ( int ) $_G ['onez_qid'];
		$Q = DB::fetch_first ( "SELECT q.*,r.file,m.username FROM " . DB::table ( 'tsound_wenda_question' ) . " q left join " . DB::table ( 'tsound_wenda_record' ) . " r on r.rid=q.rid left join " . DB::table ( 'common_member' ) . " m on m.uid=q.uid where q.qid='$qid'" );
		if (! $Q) {
			showmessage ( lang ( 'plugin/tsound_wenda', 'notexists' ) );
		}
		if ($_POST) {
			if (empty ( $_G ['uid'] )) {
				showmessage ( lang ( 'plugin/tsound_wenda', 'nologin' ), '', array (), array ('login' => true ) );
			}
			$content = $_G ['onez_content'];
			$rid = ( int ) $_G ['onez_rid'];
			
			DB::update ( 'tsound_wenda_question', array ('content' => tsound_wenda_addcontent ( $Q ['content'], $content, 'b', $_G ['uid'], $rid ) ), "qid='$qid'" );
			
			showmessage ( lang ( 'plugin/tsound_wenda', 'success_b' ), $baseurl . '&action=question&qid=' . $qid );
			exit ();
		}
		$ti = lang ( 'plugin/tsound_wenda', 'other_b' );
		$flashvars = "url=" . urlencode ( $_G ['siteurl'] . '/' . $baseurl . '&action=addpic&method=OnezUploadCall2' );
		$flash = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/upload.swf', $flashvars, 77, 20, 'tsound_pic' );
		include template ( 'tsound_wenda:other' );
		break;
	case 'answer_other' :
		$aid = ( int ) $_G ['onez_aid'];
		$type = $_G ['onez_type'];
		$A = DB::fetch_first ( "SELECT a.*,r.file,m.username FROM " . DB::table ( 'tsound_wenda_answer' ) . " a left join " . DB::table ( 'tsound_wenda_record' ) . " r on r.rid=a.rid left join " . DB::table ( 'common_member' ) . " m on m.uid=a.uid where a.aid='$aid'" );
		if (! $A) {
			showmessage ( lang ( 'plugin/tsound_wenda', 'notexists' ) );
		}
		if ($_POST) {
			if (empty ( $_G ['uid'] )) {
				showmessage ( lang ( 'plugin/tsound_wenda', 'nologin' ), '', array (), array ('login' => true ) );
			}
			$content = $_G ['onez_content'];
			$rid = ( int ) $_G ['onez_rid'];
			
			DB::update ( 'tsound_wenda_answer', array ('content' => tsound_wenda_addcontent ( $A ['content'], $content, $type, $_G ['uid'], $rid ) ), "aid='$aid'" );
			
			showmessage ( lang ( 'plugin/tsound_wenda', 'success_' . $type ), $baseurl . '&action=question&qid=' . $A ['qid'] );
			exit ();
		}
		$ti = lang ( 'plugin/tsound_wenda', 'other_' . $type );
		$flashvars = "url=" . urlencode ( $_G ['siteurl'] . '/' . $baseurl . '&action=addpic&method=OnezUploadCall2' );
		$flash = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/upload.swf', $flashvars, 77, 20, 'tsound_pic' );
		include template ( 'tsound_wenda:other' );
		break;
	case 'insert' :
		$idname = $_G ['onez_idname'];
		! $idname && $idname = 'rid';
		$flash = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/MicRecord.swf', $flashvars, 470, 250, 'tsound_insert' );
		$flash2 = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/player.swf', 'son=*', 100, 40, 'player' );
		$flash2 = var_export ( $flash2, true );
		include template ( 'tsound_wenda:insert' );
		break;
	case 'asklist' :
		$side = getSideData ();
		include template ( 'tsound_wenda:asklist' );
		break;
	case 'upload' :
		set_time_limit ( 0 );
		$url = tsound_wenda_upload ();
		exit ( $url );
		break;
	case 'addpic' :
		set_time_limit ( 0 );
		$url = tsound_wenda_addpic ();
		exit ( $url );
		break;
	
	//grzx
	case 'wdsy' :
		//grzx start
		$grzxmodule2 = 'source/plugin/tsound_wenda/include/include_grzx_module2.inc.php';
		if (file_exists ( $grzxmodule2 )) {
			require_once ($grzxmodule2);
		}
	//grzx end
	

	case 'wdhd' :
		//grzx start
		$grzxmodule3 = 'source/plugin/tsound_wenda/include/include_grzx_module3.inc.php';
		if (file_exists ( $grzxmodule3 )) {
			require_once ($grzxmodule3);
		}
	//grzx end
	

	case 'wdtw' :
		//grzx start
		$grzxmodule4 = 'source/plugin/tsound_wenda/include/include_grzx_module4.inc.php';
		if (file_exists ( $grzxmodule4 )) {
			require_once ($grzxmodule4);
		}
	//grzx end
	
	case 'ask' :
		
		if (empty ( $_G ['uid'] )) {
			showmessage ( lang ( 'plugin/tsound_wenda', 'nologin' ), '', array (), array ('login' => true ) );
		}
		$row = DB::fetch_first ( 'SELECT * FROM ' . DB::table ( 'common_member_count' ) . ' where uid=' . $_G ['uid'] );
		$money = $row ['extcredits' . $credit];
		$credit_title = $_G ['setting'] ['extcredits'] [$credit] ['title'];
		$credit_unit = $_G ['setting'] ['extcredits'] [$credit] ['unit'];
		if ($_POST) {
			$title = $_G ['onez_ask_title'];
			$content = $_G ['onez_content'];
			$rid = ( int ) $_G ['onez_rid'];
			$cid = ( int ) $_G ['onez_cid'];
			$coin = abs ( ( int ) $_G ['onez_coin'] );
			
			if ($coin && $money < $coin) {
				showmessage ( lang ( 'plugin/tsound_wenda', 'credit_low' ) );
			}
			
			//add by genee 20130502 start
			$authmodule = 'source/plugin/tsound_wenda/include/include_authority_module1.inc.php';
			if (file_exists ( $authmodule )) {
				require_once ($authmodule);
			}
			//add by genee 20130502 end
			

			//add by genee 20130502 start
			$readpaymodule = 'source/plugin/tsound_wenda/include/include_readpay_module.inc.php';
			if (file_exists ( $readpaymodule )) {
				require_once ($readpaymodule);
			}
			//add by genee 20130502 end
			

			//			array ('uid' => $_G ['uid'], 
			//			'time' => TIMESTAMP,
			//			 'status' => '0', 
			//			 'title' => $title,
			//			 'content' => $content,
			//			 'rid' => $rid, 
			//			 'cid' => $cid, 
			//			 'coin' => $coin, 
			//			 'iscommand' => 0 )
			

			$dataq ['uid'] = $_G ['uid'];
			$dataq ['time'] = TIMESTAMP;
			$dataq ['status'] = '0';
			$dataq ['title'] = $title;
			$dataq ['content'] = $content;
			$dataq ['rid'] = $rid;
			$dataq ['cid'] = $cid;
			$dataq ['coin'] = $coin;
			$dataq ['iscommand'] = 0;
			
			$qid = DB::insert ( 'tsound_wenda_question', $dataq, 1 );
			updatemembercount ( $_G ['uid'], array ($credit => - $coin ) );
			
			//add by genee 20130429 start
			$tuisongmodule = 'source/plugin/tsound_wenda/include/include_coinforum.inc.php';
			if (file_exists ( $tuisongmodule )) {
				require_once ($tuisongmodule);
			}
			//add by genee 20130429 end
			

			//add by genee 20130429 start
			$twmodule = 'source/plugin/tsound_wenda/include/include_gettwcredit.inc.php';
			if (file_exists ( $twmodule )) {
				require_once ($twmodule);
			}
			//add by genee 20130429 end
			

			showmessage ( lang ( 'plugin/tsound_wenda', 'success_add' ), $baseurl . '&action=question&qid=' . $qid );
		
		}
		
		//add by genee 20130429 start
		$categorymodule = 'source/plugin/tsound_wenda/include/include_category_module2.inc.php';
		if (file_exists ( $categorymodule )) {
			require_once ($categorymodule);
		}
		//add by genee 20130429 end
		

		$categorys = array ();
		$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='0'  ORDER BY step,cid" );
		while ( $rs = DB::fetch ( $query ) ) {
			$cats = array ();
			$query2 = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='$rs[cid]' $groupstr ORDER BY step,cid" );
			while ( $r = DB::fetch ( $query2 ) ) {
				$cats [] = array ($r ['name'], $r ['cid'] );
			}
			$categorys [] = array ($rs ['name'], $rs ['cid'], $cats );
		}
		
		$flash = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/MicRecord.swf', $flashvars, 470, 250, 'tsound_insert' );
		$flash2 = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/player.swf', 'son=*', 100, 40, 'player' );
		$flash2 = var_export ( $flash2, true );
		
		$flashvars = "url=" . urlencode ( $_G ['siteurl'] . '/' . $baseurl . '&action=addpic' );
		$flash3 = tsound_wenda_insertflash ( 'source/plugin/tsound_wenda/template/upload.swf', $flashvars, 77, 20, 'tsound_pic' );
		include template ( 'tsound_wenda:ask' );
		break;
	default :
		$tid = $tsound_wenda ['adtid'];
		if ($tid) {
			$T = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'forum_thread' ) . " where tid='$tid'" );
			if ($T) {
				$pic = './source/plugin/tsound_wenda/template/images/demo.jpg';
				if ($T ['attachment'] > 0) {
					$T2 = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'forum_attachment' ) . " where tid='$T[tid]'" );
					if ($T2) {
						$T3 = DB::fetch_first ( "SELECT * FROM " . DB::table ( 'forum_attachment_' . $T2 ['tableid'] ) . " where tid='$T[tid]' and isimage=1 order by filesize desc" );
						$T3 && $pic = $_G ['setting'] ['attachurl'] . '/forum/' . $T3 ['attachment'];
					}
				}
				$Ad = array ('subject' => $T ['subject'], 'pic' => $pic, 'url' => $_G ['siteurl'] . '/forum.php?mod=viewthread&tid=' . $tid );
			}
		}
		$categorys = array ();
		
		$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='0'  ORDER BY step,cid" );
		while ( $rs = DB::fetch ( $query ) ) {
			$cats = array ();
			
			$query2 = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='$rs[cid]' ORDER BY step,cid limit 3" );
			while ( $r = DB::fetch ( $query2 ) ) {
				$cats [] = array ($r ['name'], $r ['cid'] );
				$catkey [] = $r ['cid'];
			}
			
			$cats1 = array ();
			
			$query3 = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_category' ) . " where pcid='$rs[cid]' and cid not in(" . implode ( ',', array_values ( $catkey ) ) . ") ORDER BY step,cid " );
			while ( $r1 = DB::fetch ( $query3 ) ) {
				$cats1 [] = array ($r1 ['name'], $r1 ['cid'] );
			}
			
			$categorys [] = array ($rs ['name'], $rs ['cid'], $cats, $cats1 );
		}
		
		//add by genee 20130502 start
		$authmodule = 'source/plugin/tsound_wenda/include/include_authority_module2.inc.php';
		if (file_exists ( $authmodule )) {
			require_once ($authmodule);
		}
		//add by genee 20130502 end
		

		$list1 = $list2 = $list3 = array ();
		if ($tsound_wenda ['qids']) {
			$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_question' ) . " where qid in ($tsound_wenda[qids]) $isAuth ORDER BY qid desc limit 5" );
			while ( $rs = DB::fetch ( $query ) ) {
				$list1 [] = $rs;
			}
		}
		$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_question' ) . " where aid=0 $isAuth ORDER BY qid desc limit 15" );
		while ( $rs = DB::fetch ( $query ) ) {
			$list2 [] = $rs;
		}
		$query = DB::query ( "SELECT * FROM " . DB::table ( 'tsound_wenda_question' ) . " where aid=0 $isAuth and coin>=$tsound_wenda[high] ORDER BY qid desc limit 15" );
		while ( $rs = DB::fetch ( $query ) ) {
			$list3 [] = $rs;
		}
		
		$side = getSideData ();
		
		include template ( 'tsound_wenda:index' );
		break;
}
?>