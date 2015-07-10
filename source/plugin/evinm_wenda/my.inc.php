<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
is_login();
$config = _config();
$rewrite = $config['rewrite'];
global $_G;
$myavatar = avatar($_G[uid], small);

//我的首页 公共查询
//用户信息
$user_info_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
$user_info = DB::fetch($user_info_sql);
$user_info[cnl] = round(($user_info['num_best'] / $user_info['num_a'])*100,2);


switch ($ac){
case mypage:  //我的首页

  //提问展示
  if($user_info[num_ask] > 0) {
	  $myask_all_sql_mypage_ask = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `uid` = '. intval($_G['uid']).' AND `shenhe` = 0 ORDER BY  posttime DESC limit 10');
	  $list_mypage_ask = array();
	  while($row_ask = DB::fetch($myask_all_sql_mypage_ask)) {
		$mypage_ask['id'] = $row_ask['id'];
		$mypage_ask['uid'] = $row_ask['uid'];
		$mypage_ask['fenlei'] = $row_ask['fenlei'];
		$mypage_ask['fname'] = fid2fname($row_ask['fenlei']);
		$mypage_ask['subject'] = $row_ask['subject'];
		$mypage_ask['message'] = $row_ask['message'];
		$mypage_ask['nums_a'] = $row_ask['nums_a'];
		$mypage_ask['coin'] = $row_ask['coin'];
		$mypage_ask['posttime'] = date("Y-m-d H:i:s",$row_ask['posttime']);
		$list_mypage_ask[] = $mypage_ask;
	  }
  }
  
  //回答展示
  if($user_info[num_a] > 0) {
	$answer_sql = DB::query('select * from '.DB::table('evinm_wenda_answer').' where `uid` = '.intval($_G['uid']).' AND `shenhe` = 0 ORDER BY  posttime DESC limit 10');
	  $list_mypage_answer = array();
	  while($row_answer = DB::fetch($answer_sql)) {
		$mypage_answer['qid'] = $row_answer['qid'];
		
		$myask_ask_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '. intval($mypage_answer['qid']).' AND `shenhe` = 0');
		$myask_ask = DB::fetch($myask_ask_sql);
		
		$mypage_answer['id'] = $myask_ask['uid'];
		$mypage_answer['uid'] = $myask_ask['uid'];
		$mypage_answer['fenlei'] = $myask_ask['fenlei'];
		$mypage_answer['fname'] = fid2fname($myask_ask['fenlei']);
		$mypage_answer['subject'] = $myask_ask['subject'];
		$mypage_answer['message'] = $myask_ask['message'];
		$mypage_answer['nums_a'] = $myask_ask['nums_a'];
		$mypage_answer['coin'] = $myask_ask['coin'];
		$mypage_answer['posttime'] = date("Y-m-d H:i:s",$myask_ask['posttime']);
		$list_mypage_answer[] = $mypage_answer;
	  }
	  $list_mypage_answer = assoc_unique($list_mypage_answer,'qid');
  }
  
  break;  


case myq: //我的提问
	
	//初始化当前页码
	$page = empty($_GET['page'])?1:addslashes($_GET['page']);
	if($page<1) $page=1;

	//分页
	$perpage = 10;
	$start = ($page-1)*$perpage;
	$mpurl = "plugin.php?id=evinm_wenda:my&ac=myq&as=".$as;  //分页地址
	
	if(empty($as) || $as == 'unresolved'){
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 and `uid` = ".addslashes($_G['uid'])." AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0 and `uid` = ".addslashes($_G['uid'])));
	}else if($as == 'resolved') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 and `uid` = ".addslashes($_G['uid'])." AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 AND `shenhe` = 0 and `uid` = ".addslashes($_G['uid'])));
	}
	
	$ask_list = array();
	while($row = DB::fetch($q_sql)) {
		$ask['id'] = $row['id'];
		$ask['uid'] = $row['uid'];
		$ask['fenlei'] = $row['fenlei'];
		$ask['fname'] = fid2fname($row['fenlei']);
		$ask['subject'] = $row['subject'];
		$ask['message'] = $row['message'];
		$ask['nums_a'] = $row['nums_a'];
		$ask['coin'] = $row['coin'];
		$ask['posttime'] = date("Y-m-d H:i:s",$row['posttime']);

		$ask_list[] = $ask;
	}
	
	//获得一个分页
	$multi = multi($q_nums, $perpage, $page, $mpurl,0, 20,FALSE,FALSE);
  
  break;


case mya: //我的回答
  
	//初始化当前页码
	$page = empty($_GET['page'])?1:addslashes($_GET['page']);
	if($page<1) $page=1;

	//分页
	$perpage = 10;
	$start = ($page-1)*$perpage;
	$mpurl = "plugin.php?id=evinm_wenda:my&ac=mya&as=".$as;  //分页地址

	
	if(empty($as) || $as == 'all'){
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_answer')." where  `uid` = ".addslashes($_G['uid'])." AND `shenhe` = 0 limit ".$start.",".$perpage);
		$q_nums_rows  = DB::fetch(DB::query("select * from ".DB::table('evinm_wenda_answer')." where `uid` = ".addslashes($_G['uid'])." AND `shenhe` = 0"));
		$q_nums_rows = assoc_unique($q_nums_rows,'qid');
		$q_nums = count($q_nums_rows);
	}else if($as == 'best') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_answer')." where `best` = 1 and `uid` = ".addslashes($_G['uid'])." AND `shenhe` = 0 limit ".$start.",".$perpage);
		$q_nums_rows = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_answer')." where `best` = 1  and `uid` = ".addslashes($_G['uid'])));
		$q_nums_rows = assoc_unique($q_nums_rows,'qid');
		$q_nums = count($q_nums_rows);
	}
	
	$answer_list = array();
	while($row = DB::fetch($q_sql)) {
		$answer['qid'] = $row['qid'];
		$answer['aid'] = $row['id'];
		$answer['best'] = $row['best'];
		
		$myask_ask_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '. intval($answer['qid']).' AND `shenhe` = 0');
		$myask_ask = DB::fetch($myask_ask_sql);
		
		$answer['id'] = $myask_ask['id'];
		$answer['uid'] = $myask_ask['uid'];
		$answer['fenlei'] = $myask_ask['fenlei'];
		$answer['fname'] = fid2fname($myask_ask['fenlei']);
		$answer['subject'] = $myask_ask['subject'];
		$answer['message'] = $myask_ask['message'];
		$answer['nums_a'] = $myask_ask['nums_a'];
		$answer['coin'] = $myask_ask['coin'];
		$answer['posttime'] = date("Y-m-d H:i:s",$myask_ask['posttime']);

		$answer_list[] = $answer;
	}
	$answer_list = assoc_unique($answer_list,'qid');
	
	//获得一个分页
	$multi = multi($q_nums, $perpage, $page, $mpurl,0, 20,FALSE,FALSE);
  
  break; 
  
case myrank: //我的等级

	for($i=0;$i<count($config['lvls']);$i++) {		
		$lvl_a['lvl'] = $i+1;
		$lvl_a['exp'] = $config['lvls'][$i];
		
		$lvl_info[] = $lvl_a;
	}
	$next_exp = $lvl_info[$config[lvl]][exp] - $config['exp'];
  break;
}


if($config['isplsc'] == 1) {
	if($_GET['del_button_as']) {
		foreach ($_GET['delete'] as $id) { 
			DB::delete('evinm_wenda_answer',"`id` = ".addslashes($id));
		}
		if($rewrite == 1) {
			showmessage('操作成功！', 'wenda/home_mya.html', array(), array('showdialog' => true, 'locationtime' => true));
		}else{
			showmessage('操作成功！', 'plugin.php?id=evinm_wenda:my&ac=mya', array(), array('showdialog' => true, 'locationtime' => true));
		}
	}

	if($_GET['del_button_wt']) {
		foreach ($_GET['delete'] as $id) { 
			deletewenti($id);
		}
		if($rewrite == 1) {
			showmessage('操作成功！', 'wenda/home_myq.html', array(), array('showdialog' => true, 'locationtime' => true));
		}else{
			showmessage('操作成功！', 'plugin.php?id=evinm_wenda:my&ac=myq', array(), array('showdialog' => true, 'locationtime' => true));
		}
	}
}

include template('evinm_wenda:my');
?>