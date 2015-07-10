<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
$config = _config();
$rewrite = $config['rewrite'];
global $_G;

$sk = addslashes($_GET[s]);
if(!empty($sk)) {

//初始化当前页码
$page = empty($_GET['page'])?1:addslashes($_GET['page']);
if($page<1) $page=1;
//分页
$perpage = 10;
$start = ($page-1)*$perpage;
if($rewrite == 1) {
	$mpurl = "wenda/search.html";  //分页地址
}else{
	$mpurl = "plugin.php?id=evinm_wenda:search";      //分页地址
}


$q_nums = DB::num_rows(DB::query("SELECT *  FROM ".DB::table('evinm_wenda_ask')." WHERE (CONVERT(`subject` USING utf8) LIKE '%".$sk."%' OR CONVERT(`message` USING utf8) LIKE '%".$sk."%')"));
$s_sql = DB::query("SELECT *  FROM ".DB::table('evinm_wenda_ask')." WHERE (CONVERT(`subject` USING utf8) LIKE '%".$sk."%' OR CONVERT(`message` USING utf8) LIKE '%".$sk."%' AND `shenhe` = '0') limit ".$start.",".$perpage);

$ask_list = array();
while($row = DB::fetch($s_sql)) {
	$ask['id'] = $row['id'];
	$ask['uid'] = $row['uid'];
	$ask['fenlei'] = $row['fenlei'];
	$ask['fenlei_sup'] = $row['fenlei_sup'];
	$ask['fname'] = fid2fname($row['fenlei']);
	$ask['fname_sup'] = fid2fname($row['fenlei_sup']);
	$ask['coin'] = $row['coin'];
	$ask['subject'] = $row['subject'];
	$ask['message'] = hideString(stripslashes($row['message']),'……','150');
	$ask['nums_a'] = $row['nums_a'];
	$ask['posttime'] = date("Y-m-d H:i:s",$row['posttime']);

	$ask_list[] = $ask;
}

//获得一个分页
$multi = multi($q_nums, $perpage, $page, $mpurl,0, 20,FALSE,FALSE);
include template('evinm_wenda:search');
}else{
include template('evinm_wenda:search_so');
}


?>