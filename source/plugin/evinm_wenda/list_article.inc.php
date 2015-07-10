<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
$config = _config();
$rewrite = $config['rewrite'];
global $_G;

//如果开启了仅特定用户组可见答案功能
if($config['isopentdgroup'] == '1'){
	$tdgroups = unserialize($config['tdgroups']);
	if(in_array($_G[groupid],$tdgroups)) {
		$istdyhz = "1";
	}else{
		$istdyhz = "2";
	}
}

if($_GET['deletewt'] == 'yes' && !empty($_GET['qid'])) {
	$deluid = qid2uid($_GET['qid']);
	if($deluid == $_G['uid']) {
		deletewenti($_GET['qid']);
		showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list', array(), array('showdialog' => true, 'locationtime' => true));
	}
	
}

//用户信息
$user_info_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
$user_info = DB::fetch($user_info_sql);
$user_info[cnl] = round(($user_info['num_best'] / $user_info['num_a'])*100,2);
$user_info['avatar'] = avatar($_G['uid'], small);

//$_G[setting][seokeywords];
//print_r($_G[setting]);
$qid = addslashes($_GET[qid]);
if(empty($qid)) {
	showmessage('参数错误');
	dexit();
}


//判断是否专家分类
$fenlei = DB::result_first("select fenlei from ".DB::table('evinm_wenda_ask')." where `id` = ".$qid); 
$isvip = DB::result_first("select vipuid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($fenlei));


if($isvip != "0") {
	$vip[uid] = $isvip;
	$info = _user($vip[uid]);
	$vip[name] = uid2name($vip[uid]);
	$vip[lvl] = _lvl($vip[uid]);
	$vip['avatar'] = avatar($vip['uid'], small);	
}


if($qid){
	//问题
	$ask_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '.$qid);
	$ask = DB::fetch($ask_sql);	
	$_G[setting][bbname] = $ask['subject'];
	$ask['username'] = uid2name($ask['uid']);
	$ask['posttime'] = date("Y-m-d H:i:s",$ask['posttime']);
	$ask['lvl'] = _lvl($ask['uid']);
	$ask['avatar'] = avatar($ask[uid], small);
	$ask['lasttime'] = _lasttime($qid);
	$ask['message'] = stripslashes($ask['message']);

	$answered = DB::num_rows(DB::query('select * from '.DB::table('evinm_wenda_answer').' where qid = '.$ask['id'].' and `iszw` = 0 and uid = '.$_G[uid]));
	if($answered != 0 ) {
		$ask['is_anserd'] = 1;
	}else{
		$ask['is_anserd'] = 0;
	}
	
	
	$ask_num = DB::num_rows( DB::query('select * from '.DB::table('evinm_wenda_answer').' where `best` = 0 and `qid` = '.$qid));
	
	if($ask['over'] == '1') {
		$answer_best_sql = DB::query("select * from ".DB::table('evinm_wenda_answer')." where `best` = 1 and  `qid` = ".$qid); 
		$answer_best = DB::fetch($answer_best_sql);
		$answer_best['message'] = stripslashes($answer_best['message']);
		$answer_best['posttime'] = date("Y-m-d H:i:s",$answer_best['posttime']);	
		$answer_best[username] = uid2name($answer_best['uid']);	
		$answer_best['avatar'] = avatar($answer_best[uid], small);
		$answer_best[lvl] = _user($answer_best['uid']);	
		$best_user_info = _user($answer_best['uid']);	
		
	}
	
	
	if($ask['sale'] == 1) {
		$isabuy = DB::result_first("select bid from ".DB::table('evinm_wenda_buy')." where (`qid` = ".$qid." and `buyerid` = ".$_G[uid].")"); 
		$sale = ceil($config['sbilv'] * $ask['coin'] / 100);
		
		
		if($_GET['buy'] == 1) {
			if($isabuy > 0) {			
			}else{
				DB::insert('evinm_wenda_buy',array('qid'=>$qid,'buyerid'=>$_G[uid]));
				updatemembercount($_G['uid'],array('extcredits'.$config['points'] => '-'.$sale));
				showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list_article&qid='.$qid, array(), array('showdialog' => true, 'locationtime' => true));
			}
		}
	}
	
	//补充内容
	$askadd_sql = DB::query('select * from '.DB::table('evinm_wenda_ask_add').' where `qid` = '.$qid);	
	$askadd_num = DB::num_rows($askadd_sql);
	if($askadd_num != 0) {
		$askadd = DB::fetch($askadd_sql);
		$askadd['message'] = stripslashes($askadd['message']);
	}
	
	//列表回答
	if($ask['nums_a'] !=0) {
		$answer_sql = DB::query('select * from '.DB::table(evinm_wenda_answer).' where best = 0 and qid = '.$qid.' ORDER BY  posttime ASC ');
		$list_answers = array();
		while($ans_row = DB::fetch($answer_sql)) {
			$list_answer['id'] = $ans_row['id'];
			$list_answer['uid'] = $ans_row['uid'];
			$list_answer['iszw'] = $ans_row['iszw'];
			$list_answer['zw_id'] = $ans_row['zw_id'];
			$list_answer['zw_aid'] = $ans_row['zw_aid'];
			$list_answer['zw_uid'] = $ans_row['zw_uid'];
			$list_answer['zw_ddhd'] = $ans_row['zw_ddhd'];
			$list_answer['lvl'] = _lvl($ans_row['uid']);
			$list_answer['username'] = uid2name($ans_row['uid']);
			$list_answer['message'] = stripslashes($ans_row['message']);
			$list_answer['posttime'] = date("Y-m-d H:i:s",$ans_row['posttime']);
			$list_answer['best'] = $ans_row['best'];
			$list_answer['pic'] = $ans_row['pic'];
			$list_answer['yzw'] = DB::result_first("select id from ".DB::table('evinm_wenda_answer')." where (`qid` = ".$qid." and `zw_aid` = ".$ans_row['id'].")"); 
			$list_answers[] = $list_answer;
			
		}
		$answer_sql_zw = DB::query('select * from '.DB::table(evinm_wenda_answer).' where best = 0 and qid = '.$qid.' ORDER BY  posttime ASC ');
		$list_answers_zw = array();
		while($ans_row_zw = DB::fetch($answer_sql_zw)) {
			$list_answer_zw['id'] = $ans_row_zw['id'];
			$list_answer_zw['uid'] = $ans_row_zw['uid'];
			$list_answer_zw['iszw'] = $ans_row_zw['iszw'];
			$list_answer_zw['zw_id'] = $ans_row_zw['zw_id'];
			$list_answer_zw['zw_aid'] = $ans_row_zw['zw_aid'];
			$list_answer_zw['zw_uid'] = $ans_row_zw['zw_uid'];
			$list_answer_zw['zw_ddhd'] = $ans_row_zw['zw_ddhd'];
			$list_answer_zw['lvl'] = _lvl($ans_row_zw['uid']);
			$list_answer_zw['username'] = uid2name($ans_row_zw['uid']);
			$list_answer_zw['message'] = stripslashes($ans_row_zw['message']);
			$list_answer_zw['posttime'] = date("Y-m-d H:i:s",$ans_row_zw['posttime']);
			$list_answer_zw['best'] = $ans_row_zw['best'];
			$list_answer_zw['pic'] = $ans_row_zw['pic'];
			$list_answers_zw[] = $list_answer_zw;			
		}
		
	}
	
	if($_GET[model] == 'sb') {
		$bestuid = intval($_GET[bestuid]);
		$bestid = addslashes($_GET[bestid]);
		$coin = addslashes($_GET[coin]);
		
		
		$num_best = DB::result_first("select num_best from ".DB::table('evinm_wenda_user')." where `uid` = ".$bestuid); 
		$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".$bestuid); 
		$num_best = $num_best + 1;
		$exp = $exp + $config[rule][2];
		
		if($_GET[sale] == 1) {
			DB::update('evinm_wenda_ask',array('sale'=>'1'),"`id` = ".$qid);
		}
		
		DB::update('evinm_wenda_ask',array('over'=>'1'),"`id` = ".$qid);
		DB::update('evinm_wenda_answer',array('best'=>'1'),"`id` = ".$bestid);
		DB::update('evinm_wenda_user',array('num_best'=>$num_best,'exp'=>$exp),"`uid` = ".$bestuid);
		updatemembercount($bestuid,array('extcredits'.$config['points'] => '+'.$coin));
		updatemembercount($bestuid,array('extcredits'.$config['czjl'] => '+'.$config['rule_jifen'][2]));
		updatemembercount(intval($_G['uid']),array('extcredits'.$config['czjl'] => '+'.$config['rule_jifen'][3]));
		
		//通知
		if($config[isopen_notic] == 1) {			
			$not_cont = "恭喜！您的回答被提问者采纳为满意答案！<a href=\"".$server."plugin.php?id=evinm_wenda:list_article&qid=".$qid."\">点击查看问题</a>";
			notification_add($bestuid, 'post', $not_cont, $notevars = array(), $system = 0); //通知
		}
		showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list_article&qid='.$qid, array(), array('showdialog' => true, 'locationtime' => true));
	}
	
	//相关问题
	$like_sql = DB::query('select * from '.DB::table('evinm_wenda_ask'). ' where fenlei = '.addslashes($ask['fenlei']).' AND `shenhe` = 0 and `id` != '.$qid.' limit 5');
	$list_like = array();
	while($like_row = DB::fetch($like_sql)) {
		$like['id'] = $like_row['id'];
		$like['uid'] = $like_row['uid'];
		$like['subject'] = $like_row['subject'];
		$like['lvl'] = _lvl($like_row['uid']);
		$like['username'] = uid2name($like_row['uid']);
		$like['message'] = stripslashes($like_row['message']);
		$like['posttime'] = date("Y-m-d H:i:s",$like_row['posttime']);
		$like['best'] = $like_row['best'];
		$like['coin'] = $like_row['coin'];
		$like['pic'] = $like_row['pic'];
		$list_like[] = $like;
		
	}
	
	//del答案
	if($_GET['action'] == 'delhf' && !empty($_GET['ansid'])) {
		DB::delete('evinm_wenda_answer',"`id` = ".intval($_GET['ansid']));
		$num_ans = DB::result_first("select nums_a from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($_GET[qid])); 
		$new_ans = $num_ans - 1;
		DB::update('evinm_wenda_ask',array('nums_a'=>$new_ans),"`id` = ".intval($_GET[qid]));
		$num_ans_u = DB::result_first("select num_a from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_GET[ansuid])); 
		$new_ans_u = $num_ans_u - 1;
		DB::update('evinm_wenda_user',array('num_a'=>$new_ans_u),"`uid` = ".intval($_GET[ansuid]));
		
		showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list_article&qid='.$_GET[qid], array(), array('showdialog' => true, 'locationtime' => true));
	}
}

//回答
if($_GET['btn_answer']) {
	ploadmodel('UploadFile');
	ploadmodel('upload_answer');
}

//补充问题
if($_GET['btn_moreq']) {
	ploadmodel('UploadFile');
	ploadmodel('upload_moreq');
}

//追问
if($_GET['btn_zhuiwen']) {
	ploadmodel('UploadFile');
	ploadmodel('upload_zhuiwen');
}

//增加悬赏积分
if($_GET['btn_zjxs']) {

	$score_z = intval($_GET['enhance']);
	if($score > $config['point']) {
		showmessage('操作失败！您的积分不足！');
		dexit();
	}

	$score_n = DB::result_first("select coin from ".DB::table('evinm_wenda_ask')." where `id` = ".$qid); 
	$score = $score_z + $score_n;
	DB::update('evinm_wenda_ask',array('coin'=>$score),"`id` = ".$qid);
	updatemembercount(intval($_G['uid']),array('extcredits'.$config['points'] => '-'.$score_z));
	showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list_article&qid='.$qid, array(), array('showdialog' => true, 'locationtime' => true));
	showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list_article&qid='.$qid, array(), array('showdialog' => true, 'locationtime' => true));
}


//列表回答

include template('evinm_wenda:list_article');
?>