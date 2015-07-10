<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
$config = _config();
$rewrite = $config['rewrite'];
global $_G;

//用户信息
$user_info_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
$user_info = DB::fetch($user_info_sql);
$user_info[cnl] = round(($user_info['num_best'] / $user_info['num_a'])*100,2);
$user_info['avatar'] = avatar($_G['uid'], small);

$cid = addslashes($_GET[cid]);
$fcid = addslashes($_GET[fcid]);
$es = addslashes($_GET[es]);
//es 状态  D  Y  G  L

//初始化当前页码
$page = empty($_GET['page'])?1:addslashes($_GET['page']);
if($page<1) $page=1;
//分页
$perpage = 10;
$start = ($page-1)*$perpage;

//quirk-answer
if($_GET[quirk_btn]) {
	if(addslashes($_GET['answer']) == "") {
		showmessage('请填写答案！');
	}
	
	DB::insert('evinm_wenda_answer',array('qid'=>addslashes($_GET['askid']),'uid'=>$_G[uid],'posttime'=>$_G[timestamp],'message'=>addslashes($_GET['answer'])));
	
	$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid']));
	
	if(!empty($exp)){
		$exp = $exp + $config['rule']['1'];
		DB::update('evinm_wenda_user',array('exp'=>$exp),"`uid` = ".intval($_G['uid']));
	}else{
		DB::insert('evinm_wenda_user',array('uid'=>intval($_G['uid']),'exp'=>$config['rule']['1']));
	}
	
	$num_a_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 	
	$num_a = DB::fetch($num_a_sql);
	$num_a = $num_a[num_a];
	
	if(DB::num_rows($num_a_sql) != 0){	
		$num_a = $num_a + 1;
		DB::update('evinm_wenda_user',array('num_a'=>$num_a),"`uid` = ".intval($_G['uid']));
	}else{
		DB::insert('evinm_wenda_user',array('uid'=>intval($_G['uid']),'num_a'=>1));
	}
	
	
	$num_a_ask_sql = DB::query("select nums_a from ".DB::table('evinm_wenda_ask')." where `id` = ".addslashes($_GET['askid'])); 	
	$num_a_ask = DB::fetch($num_a_ask_sql); 
	
	if(DB::num_rows($num_a_ask_sql) != 0){	
		$nums_a = $num_a_ask['nums_a'] + 1;
		DB::update('evinm_wenda_ask',array('nums_a'=>$nums_a),"`id` = ".addslashes($_GET['askid']));
	}else{
		DB::insert('evinm_wenda_ask',array('id'=>intval($_GET['askid']),'nums_a'=>1));
	}
	
	if($config[isopen_notic] == 1) {
		$quid = DB::result_first("select uid from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($_GET['askid']));
		$not_cont = "您的问题有了新的回复！<a href=\"http:".$_G['siteurl']."plugin.php?id=evinm_wenda&#58;list_article&qid=".$_GET['askid']." />点击查看</a>";
		notification_add($quid, 'post', $not_cont, $notevars = array(), $system = 0); //通知
	}
	
	updatemembercount(intval($_G['uid']),array('extcredits'.$config['points'] => '+'.$config['rule_jifen'][3]));
	if($rewrite == 1) {
		if(!empty($_GET['qcid'])) {
			showmessage('非常感谢您为提问者解决问题！', 'wenda/list-c'.$_GET['qcid'].'.html', array(), array('showdialog' => true, 'locationtime' => true));
		}else if(!empty($_GET['qfcid'])) {
			showmessage('非常感谢您为提问者解决问题！', 'wenda/list-f'.$_GET['qfcid'].'.html', array(), array('showdialog' => true, 'locationtime' => true));
		}else{
			showmessage('非常感谢您为提问者解决问题！', 'wenda/list.html', array(), array('showdialog' => true, 'locationtime' => true));
		}
	}else{
		showmessage('非常感谢您为提问者解决问题！', 'plugin.php?id=evinm_wenda:list&cid='.$_GET['qcid'].'&fcid='.$_GET['qfcid'], array(), array('showdialog' => true, 'locationtime' => true));
	}
}


if(!empty($fcid)) {
	$fid_sename = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($fcid));
	$_G[setting][bbname] = "问答中心 - ".$fid_sename;
	
	//分页地址
	$mpurl = "plugin.php?id=evinm_wenda:list&fcid=".$fcid."&es=".$es;    //分页地址

	
	
	
	//开始列表
	if(empty($es) || $es == 'D'){
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 and `fenlei_sup` = ".$fcid." AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0  AND `shenhe` = 0 and `fenlei_sup` = ".$fcid));
	}else if($es == 'Y') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 and `fenlei_sup` = ".$fcid." ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 and `fenlei_sup` = ".$fcid));
	}else if($es == 'G') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 and `fenlei_sup` = ".$fcid." AND `shenhe` = 0 ORDER BY  coin DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0 and `fenlei_sup` = ".$fcid));
	}else if($es == 'L') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `nums_a` = 0  and `fenlei_sup` = ".$fcid." AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `nums_a` = 0 AND `shenhe` = 0 and `fenlei_sup` = ".$fcid));
	}

	//取分类 -----------------------------------
	$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = '.addslashes($fcid));
	$list_list = array();
	while($f_rows = DB::fetch($f_class_sql)) {
		$mood_list['type'] = $f_rows['type'];
		$mood_list['id'] = $f_rows['id'];
		$mood_list['fid'] = $f_rows['fid'];
		$mood_list['name'] = $f_rows['name'];
		$list_list[] = $mood_list;
	}

}elseif(!empty($cid)) {

	//分页地址
	$mpurl = "plugin.php?id=evinm_wenda:list&cid=".$cid."&es=".$es;   //分页地址

	

	//开始列表
	if(empty($es) || $es == 'D'){
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 and `fenlei` = ".$cid." AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0  AND `shenhe` = 0 and `fenlei` = ".$cid));
	}else if($es == 'Y') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 and `fenlei` = ".$cid." ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 and `fenlei` = ".$cid));
	}else if($es == 'G') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 and `fenlei` = ".$cid." AND `shenhe` = 0 ORDER BY  coin DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0 and `fenlei` = ".$cid));
	}else if($es == 'L') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `nums_a` = 0  and `fenlei` = ".$cid." AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `nums_a` = 0 AND `shenhe` = 0 and `fenlei` = ".$cid));
	}
	
	//取分类 -----------------------------------
	$fid = DB::result_first("select fid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($cid));
	$fid_sename = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($cid));
	$_G[setting][bbname] = "问答中心 - ".$fid_sename;
	
	$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = '.addslashes($fid));
	$list_list = array();
	while($f_rows = DB::fetch($f_class_sql)) {
		$mood_list['type'] = $f_rows['type'];
		$mood_list['id'] = $f_rows['id'];
		$mood_list['fid'] = $f_rows['fid'];
		$mood_list['name'] = $f_rows['name'];
		$list_list[] = $mood_list;
	}
}elseif(empty($cid) && empty($fcid)) {	
	//分页地址
	$mpurl = "plugin.php?id=evinm_wenda:list&es=".$es;   //分页地址

	
	
	//开始列表
	if(empty($es) || $es == 'D'){
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0"));
	}else if($es == 'Y') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 1 "));
	}else if($es == 'G') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0 ORDER BY  coin DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `over` = 0 AND `shenhe` = 0"));
	}else if($es == 'L') {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where `nums_a` = 0  AND `shenhe` = 0 ORDER BY  posttime DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where `nums_a` = 0 AND `shenhe` = 0"));
	}
	
	$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = 0');
	$list_list = array();
	while($f_rows = DB::fetch($f_class_sql)) {
		$mood_list['type'] = $f_rows['type'];
		$mood_list['id'] = $f_rows['id'];
		$mood_list['fid'] = $f_rows['fid'];
		$mood_list['name'] = $f_rows['name'];
		$list_list[] = $mood_list;
	}
	$isone = 1;
}


$ask_list = array();
while($row = DB::fetch($q_sql)) {
	$ask['id'] = $row['id'];
	$lasttime = _lasttime($row['id']);
	
	if($es == 'Y') {
			$ask['uid'] = $row['uid'];
			$ask['fenlei'] = $row['fenlei'];
			$ask['fname'] = fid2fname($row['fenlei']);
			$ask['coin'] = $row['coin'];
			$ask['over'] = $row['over'];
			$ask['subject'] = hideString($row['subject'],'……',$config['slenth']);
			$ask['message'] = $row['message'];
			$ask['nums_a'] = $row['nums_a'];
			
			$answered = DB::num_rows(DB::query('select * from '.DB::table('evinm_wenda_answer').' where qid = '.$row['id'].' AND `shenhe` = 0 and uid = '.$_G[uid]));
			if($answered != 0 ) {
				$ask['is_anserd'] = 1;
			}else{
				$ask['is_anserd'] = 0;
			}
				
			$ask['posttime'] = date("Y-m-d H:i:s",$row['posttime']);

			$ask_list[] = $ask;	
	}else{		
		if($lasttime >0) {
			$ask['uid'] = $row['uid'];
			$ask['fenlei'] = $row['fenlei'];
			$ask['fname'] = fid2fname($row['fenlei']);
			$ask['coin'] = $row['coin'];
			$ask['subject'] = $row['subject'];
			$ask['subject'] = hideString($ask['subject'],'……',$config['slenth']);
			$ask['message'] = $row['message'];
			$ask['nums_a'] = $row['nums_a'];
			
			$answered = DB::num_rows(DB::query('select * from '.DB::table('evinm_wenda_answer').' where qid = '.$row['id'].' AND `shenhe` = 0 and uid = '.$_G[uid]));
			if($answered != 0 ) {
				$ask['is_anserd'] = 1;
			}else{
				$ask['is_anserd'] = 0;
			}
				
			$ask['posttime'] = date("Y-m-d H:i:s",$row['posttime']);

			$ask_list[] = $ask;	
		}
	}

}

//获得一个分页
$multi = multi($q_nums, $perpage, $page, $mpurl,0, 20,FALSE,FALSE);


//判断是否专家分类
if($_GET[cid]) {
	$vip[uid] = DB::result_first("select vipuid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($_GET[cid])); 
	$info = _user($vip[uid]);
	$vip[name] = uid2name($vip[uid]);
	$vip[lvl] = _lvl($vip[uid]);
	$vip['avatar'] = avatar($vip['uid'], small);
	
}

//删除
if($_GET[del_button]) {
	foreach ($_GET['delete'] as $id) { 
		deletewenti($id);
	}
	if($rewrite == 1) {
		showmessage('操作成功！', 'wenda/list.html', array(), array('showdialog' => true, 'locationtime' => true));
	}else{
		showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list', array(), array('showdialog' => true, 'locationtime' => true));
	}
	
}

include template('evinm_wenda:list');
?>