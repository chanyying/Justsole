<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

define('PLUGIN_ID', 'evinm_wenda'); //定义插件id
global $_G;
function ploadmodel($model) {
    $filename = DISCUZ_ROOT . './source/plugin/' . PLUGIN_ID . '/model/' . $model .
        '.class.php';
    if (file_exists($filename)) {
        include $filename;
    } else {
        dexit('Cannot find model named ' . $model);
    }
}

//删除提问
function deletewenti($qid){
	$qid = intval($qid);
	if($qid) {
		DB::delete('evinm_wenda_ask',"`id` = $qid");
		DB::delete('evinm_wenda_answer',"`qid` = $qid");
	}
}

function qid2uid($qid){
	$qid = intval($qid);
	if($qid) {
		$uid = DB::result_first("select uid from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($qid)); 
	}	
	return $uid; 
}

$ac = addslashes($_GET['ac']);
$as = addslashes($_GET['as']);
$mod = addslashes($_GET['mod']);

function uid2name($uid){ 
	if(!$uid){ 
	}else{ 
		$username = DB::result_first("select username from ".DB::table('common_member')." where `uid` = ".intval($uid)); 
		$username = $username ?$username : ''; 
	} 
	return $username; 
} 

function fid2fname($fid){ 
	if(!$fid){ 
	}else{ 
		$fname = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($fid)); 
		$fname = $fname ?$fname : ''; 
	} 
	return $fname; 
}

// 判断状态
function is_login(){
    global $_G;    
    if(empty($_G[uid])) {
        showmessage('需要登录', '', array(), array('login' => true));
    } 
}

// 判断开启
function is_open(){
    global $_G;
    if (!isset($_G['cache']['plugin'])) {
        loadcache('plugin');
    }
    $isopen = $_G['cache']['plugin']['evinm_wenda']['isopen'];
    $closemsg = $_G['cache']['plugin']['evinm_wenda']['closemsg'];
    if ($isopen == 1) {
        $config = $_G['cache']['plugin']['evinm_wenda'];
    } else if($isopen == 0) {
        showmessage('{_G/cache/plugin/evinm_wenda/closemsg}', 'index.php', array(), array('showdialog' => true, 'locationtime' => true));
        dexit();
    }    
}

// 计算剩下时间
function _lasttime($id) {			
	global $_G;

	$long = $_G['cache']['plugin']['evinm_wenda']['xdays']*24*60*60; //设定的悬赏有效期 转换为秒
	$rows = DB::fetch(DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '.$id));
	$starttime = $rows['posttime'];
	$lasttime = intval(($long-($_G['timestamp']-$starttime))/60/60); //剩余时间，转换为小时
	
	if($lasttime <= 0){
		DB::update('evinm_wenda_ask',array('close'=>'1'),"`id` = ".$id);
	}
	
	return $lasttime;	
}

//去重
function assoc_unique($arr, $key){
	$tmp_arr = array();
	foreach($arr as $k => $v){
		if(in_array($v[$key], $tmp_arr)){//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
			unset($arr[$k]);
		}
		else {
			$tmp_arr[] = $v[$key];
		}
	}
	sort($arr); //sort函数对数组进行排序
	return $arr;
}


// 配置
function _config() {
	global $_G;
    if (!isset($_G['cache']['plugin'])) {
        loadcache('plugin');
    }
    $config = $_G['cache']['plugin']['evinm_wenda'];
	
    $config['point'] = "extcredits".$config['points'];
    $config['points_name'] = $_G['setting']['extcredits'][$config['points']]['title']; //积分名称
    $config['points_unit'] = $_G['setting']['extcredits'][$config['points']]['uint']; //积分单位
    $config['points_user'] = getuserprofile($config['point']); //取得现有积分-最佳答案
	
	$config['rule_jifen'] = explode('|',$config['rule_jifen']);
    $config['czjl_jifen'] = "extcredits".$config['czjl']; //操作奖励积分
    $config['czjl_name'] = $_G['setting']['extcredits'][$config['czjl']]['title']; //操作奖励积分名称
	
	$config['rule'] = explode('|',$config['rule']);
	$config['lvls'] = explode('|',$config['lvls']);
	$config['npgroups'] = unserialize($config['npgroups']);
	
	if(in_array($_G['uid'],$config['npgroups'])) {
		$config['n_group'] = 1;
	}
	
	
	$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
	$exp = $exp ?$exp : '0'; 
	$config['exp'] = $exp;

	$myask_all_sql = DB::query('select * from '.DB::table('evinm_wenda_ask').' where `uid` = '. intval($_G['uid']));
	$config['ask_num'] = DB::num_rows($myask_all_sql);	
	
	$a_all_sql = DB::query('select * from '.DB::table('evinm_wenda_answer').' where `uid` = '. intval($_G['uid']));
	$config['a_num'] = DB::num_rows($a_all_sql);
	
	for($i=0;$i<count($config['lvls']);$i++) {
		if($i==0 && $exp < $config['lvls'][$i]) {
			$config['lvl'] = $i;
		}else{
			if($exp > $config['lvls'][$i-1] && $exp < $config['lvls'][$i]) {
				$config['lvl'] = $i;
			}
		}
	}
	
	$a_s =  DB::query('select COUNT(id) from '.DB::table('evinm_wenda_ask'));
	$config['ask_nums'] = mysql_result($a_s, 0);

	$a_s_d =  DB::query('select COUNT(id) from '.DB::table('evinm_wenda_ask').' where `over` =0 ');
	$config['ask_nums_d'] = mysql_result($a_s_d, 0);

	//$a_s_o =  DB::query('select COUNT(id) from '.DB::table('evinm_wenda_ask').' where `over` =1 ');
	//$config['ask_nums_o'] = mysql_result($a_s_o, 0);
	
	$a_s_o = DB::query('select SUM(coin) from '.DB::table('evinm_wenda_ask'));
	$config['ask_nums_o'] = mysql_result($a_s_o, 0);	
	
	return $config;		
}

function _lvl($uid){
	global $_G;
    if (!isset($_G['cache']['plugin'])) {
        loadcache('plugin');
    }
    $config = $_G['cache']['plugin']['evinm_wenda'];
	$config['lvls'] = explode('|',$config['lvls']);
	
	$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($uid)); 
	$exp = $exp ?$exp : '0'; 
		
	for($i=0;$i<count($config['lvls']);$i++) {
		if($i==0 && $exp < $config['lvls'][$i]) {
			$lvl = $i;
		}else{
			if($exp > $config['lvls'][$i-1] && $exp < $config['lvls'][$i]) {
				$lvl = $i;
			}
		}
	}
	return  $lvl;
}

function _user($uid){
	global $_G;	
	$info = DB::result_first("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($uid)); 	
	$info[cnl] = round(($info['num_best'] / $info['num_a'])*100,6);
	return  $info;
}

function hideString($str = 'hello', $to = '……', $start = 1, $end = 0) { 
	$lenth = strlen($str) - $start - $end; 
	if($lenth < 1) {
		return $str; 
	}else{
		$lenth = ($lenth < 0) ? 0 : $lenth; 
		$to = str_repeat($to, 1); 
		$str = substr_replace($str, $to, $start, $lenth); 
		return $str; 
	}
} 


//导航+分类
if($_GET[id] == 'evinm_wenda:index' || $_GET[id] == 'evinm_wenda:my' || $_GET[id] == 'evinm_wenda:ask' || $_GET[id] == 'evinm_wenda:list_article') {
$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = 0 ORDER BY  `paixu` ASC ');
$list = array();
while($f_rows = DB::fetch($f_class_sql)) {
	$mood['type'] = $f_rows['type'];
	$mood['id'] = $f_rows['id'];
	$mood['fid'] = $f_rows['fid'];
	$mood['name'] = $f_rows['name'];
	$list[] = $mood;
	
	//左侧导航
	//1级
	$t_class_1 = "\"".$mood['name']."|".$mood['id']."\"";
	$t_class_2_0 = "";
	$t_class_2_3 = "";
	$config = $_G['cache']['plugin']['evinm_wenda'];
	if($config['openall'] == 1) {
		//2级
		$lfet_class_f_s0 = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = '.$mood['id'].' ORDER BY  `paixu` ASC  LIMIT 0 , 100');
		while($left_rows_c_0 = DB::fetch($lfet_class_f_s0)) {
			$t_class_2_0 .= "\"".$left_rows_c_0['name']."|".$left_rows_c_0['id']."\"".",";
		}
		$left_class .= "[".$t_class_1.",[".$t_class_2_0."]]," ;
		
	}else{
		//2级前3
		$lfet_class_f_s0 = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = '.$mood['id'].' ORDER BY  `paixu` ASC  LIMIT 0 , 3');
		while($left_rows_c_0 = DB::fetch($lfet_class_f_s0)) {
			$t_class_2_0 .= "\"".$left_rows_c_0['name']."|".$left_rows_c_0['id']."\"".",";
		}

		//2级3开始
		$lfet_class_f_s3 = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' where `fid` = '.$mood['id'].' ORDER BY  `paixu` ASC  LIMIT 3 , 50');
		
		while($left_rows_c_3 = DB::fetch($lfet_class_f_s3)) {
			$t_class_2_3 .= "\"".$left_rows_c_3['name']."|".$left_rows_c_3['id']."\"".",";
		}
		
		$left_class .= "[".$t_class_1.",[".$t_class_2_0."],[".$t_class_2_3."]]," ;
	}
}
	$left_class = "[".$left_class."]";

}
?>
