<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
$config = _config();
$rewrite = $config['rewrite'];
global $_G;
/* echo $_G['disabledwidthauto'];
echo $_G['setting']['switchwidthauto']; */
$_G[setting][bbname] = $config[seo_index_t];

$user_info_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
$user_info = DB::fetch($user_info_sql);
$user_info[cnl] = round(($user_info['num_best'] / $user_info['num_a'])*100,2);
$user_info['avatar'] = avatar($_G['uid'], small);

//提问展示
$myask_ask = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `over` = 0 AND `shenhe` = 0 ORDER BY  `posttime` DESC  limit 15');
$list_mypage_ask = array();
while($row_ask = DB::fetch($myask_ask)) {
	$mypage_ask['id'] = $row_ask['id'];
	$lasttime = _lasttime($row_ask['id']);
			
	if($lasttime >0) {
		$mypage_ask['uid'] = $row_ask['uid'];
		$mypage_ask['fenlei'] = $row_ask['fenlei'];
		$mypage_ask['fname'] = fid2fname($row_ask['fenlei']);
		$mypage_ask['subject'] = hideString($row_ask['subject'],'……',$config['slenth']);		
		$mypage_ask['message'] = $row_ask['message'];
		$mypage_ask['coin'] = $row_ask['coin'];
		$mypage_ask['nums_a'] = $row_ask['nums_a'];
		$mypage_ask['posttime'] = date("Y-m-d H:i:s",$row_ask['posttime']);	
		$list_mypage_ask[] = $mypage_ask;
	}
}


//高分
$myask_all_sql_mypage_ask2 = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `over` = 0 AND `shenhe` = 0 ORDER BY  coin DESC limit 15');
$list_mypage_ask2 = array();
while($row_ask2 = DB::fetch($myask_all_sql_mypage_ask2)) {

	$mypage_ask2['id'] = $row_ask2['id'];
	
	$lasttime = _lasttime($row_ask2['id']);			
	if($lasttime >0) {
		$mypage_ask2['uid'] = $row_ask2['uid'];
		$mypage_ask2['fenlei'] = $row_ask2['fenlei'];
		$mypage_ask2['fname'] = fid2fname($row_ask2['fenlei']);
		$mypage_ask2['subject'] = hideString($row_ask2['subject'],'……',$config['slenth']);		
		$mypage_ask2['message'] = $row_ask2['message'];
		$mypage_ask2['coin'] = $row_ask2['coin'];
		$mypage_ask2['posttime'] = date("Y-m-d H:i:s",$row_ask2['posttime']);
		$mypage_ask2['a_num'] = DB::num_rows(DB::query('select * from '.DB::table('evinm_wenda_answer'). ' where `qid` = '. $row_ask2['id']));
		$list_mypage_ask2[] = $mypage_ask2;
	}
}

//推荐幻灯
//标签1
$tab1_ids = explode('|',$config['tab_one']);
if(is_array($tab1_ids)){
	$list_tab1 = array();

	for ($i_tab1=0; $i_tab1 < count($tab1_ids); $i_tab1++) {
		$tab1_ask_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '.$tab1_ids[$i_tab1]);
		if($i_tab1 == 0) {
		
		}		
		$tab1_ask = DB::fetch($tab1_ask_sql);
		$tab1_ask[aaid] = $i_tab1;
		$list_tab1[$i_tab1] = $tab1_ask;
		
	}	
	if(!empty($list_tab1[0][id])){
		$an_sql = DB::query('select * from '.DB::table('evinm_wenda_answer').' where (`best` = 1 and `qid` = '.$list_tab1[0][id].')');
		$an_row_1 = DB::fetch($an_sql);
		$an_row_1['message'] = hideString($an_row_1['message'],'……',100);
		$an_row_1['username'] = uid2name($an_row_1['uid']);
	}
}


//标签2
$tab2_ids = explode('|',$config['tab_two']);
if(is_array($tab2_ids)){
	$list_tab2 = array();

	for ($i_tab2=0; $i_tab2 < count($tab2_ids); $i_tab2++) {
		$tab2_ask_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '.$tab2_ids[$i_tab2]);

		$tab2_ask = DB::fetch($tab2_ask_sql);
		$tab2_ask[aaid] = $i_tab2;
		$list_tab2[$i_tab2] = $tab2_ask;
		
	}
	if(!empty($list_tab2[0][id])){
		$an_sql_2 = DB::query('select * from '.DB::table('evinm_wenda_answer').' where (`best` = 1 and `qid` = '.$list_tab2[0][id].')');
		$an_row_2 = DB::fetch($an_sql_2);
		$an_row_2['message'] = hideString($an_row_2['message'],'……',100);
		$an_row_2['username'] = uid2name($an_row_2['uid']);
	}
}

//标签3
$tab3_ids = explode('|',$config['tab_three']);
if(is_array($tab3_ids)){
	$list_tab3 = array();

	for ($i_tab3=0; $i_tab3 < count($tab3_ids); $i_tab3++) {
		$tab3_ask_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '.$tab3_ids[$i_tab3]);

		$tab3_ask = DB::fetch($tab3_ask_sql);
		$tab3_ask[aaid] = $i_tab3;
		$list_tab3[$i_tab3] = $tab3_ask;
		
	}
	if(!empty($list_tab3[0][id])){
		$an_sql_3 = DB::query('select * from '.DB::table('evinm_wenda_answer').' where (`best` = 1 and `qid` = '.$list_tab3[0][id].')');
		$an_row_3 = DB::fetch($an_sql_3);
		$an_row_3['message'] = hideString($an_row_3['message'],'……',100);
		$an_row_3['username'] = uid2name($an_row_3['uid']);
	}
}

//首页之星
$best = DB::fetch(DB::query("select * from ".DB::table('evinm_wenda_user')." ORDER BY  `num_best` DESC LIMIT 1 "));
$best['username'] = uid2name($best[uid]);
$best['cnl'] = round(($best['num_best'] / $best['num_a'])*100,2);
$best['lvl'] = _lvl($best[uid]);
$best['avatar'] = avatar($best['uid'], small);

//回答
$best_sql = DB::query('select * from '.DB::table('evinm_wenda_answer').'  where `best` = 1 and `uid` = '. intval($best[uid]).' limit 3');
$list_best = array();
while($row_best = DB::fetch($best_sql)) {
	$bestl[qid] = $row_best[qid];
	$bestl = DB::fetch(DB::query('select * from '.DB::table('evinm_wenda_ask').'  where `id` = '. intval($bestl[qid])));

	$list_best[] = $bestl;
}


$tab_images = explode('|',$config['tab_img']);

include template('evinm_wenda:index');
?>