<?php
/**
此破解程序由星期六源码【xlqzm.com】提供，更多商业源码请登录星期六源码官网
官方网站:xlqzm.com
更多商业插件：http://xqlzm.com/forum-113-1.html
更多商业模板：http://xqlzm.com/forum-112-1.html
更多商业源码：http://xqlzm.com/forum-141-1.html
**/

if(!defined('IN_ADMINCP')){	exit('Admin Login');}
if(!defined('IN_DISCUZ')) {	exit('Access Denied');}
global $sale_config,$_lang;
include ("include/config.class.php");
include ("include/function.class.php");

$mod = "admin_goods";
$self_url = 'plugins&operation=config&identifier=sale&pmod='.$mod."&do=".$do;
$cp_url ='action='.$self_url;
$_lang = lang('plugin/sale');

if(isset($_GET['goods_status'])){
	$goods_status = intval($_GET['goods_status']);
	if($_GET['goods_id'] =='all'){
		DB::update('sale_goods',array('goods_status'=>$goods_status));
	}else{
		DB::update('sale_goods',array('goods_status'=>$goods_status)," goods_id='".intval($_GET['goods_id'])."'");
	}
}

$page = !empty($_GET['page'])? intval($_GET['page']):1;
$perpage = $sale_config['perpage'];

$where = ' WHERE 1=1 ';
$order .=' ORDER BY goods_time DESC ';

$pagenum = fetch_all('sale_goods',$where.$order,'count(goods_id) as count');
$pagenum = $pagenum[0]['count'];
$urlnow = 'admin.php?'.$cp_url;
$multipage = multi($pagenum, $perpage, $page, $urlnow , 0, 10);

$goods_array = array();
if($pagenum > $perpage){
	$stat_limit = ($page -1) * $perpage;
	$_start_goods_time = fetch_all('sale_goods'," ORDER BY goods_time DESC LIMIT $stat_limit,1",' goods_time ');
	$_start_goods_time = $_start_goods_time[0]['goods_time'];
	$start_goods_time =" AND goods_time <='{$_start_goods_time}' ";
	$limit = " LIMIT {$perpage}";
}
$goods_array =fetch_all('sale_goods',$where.$start_goods_time.$order.$limit);

$style ='default';
include template("sale:admin/admin_goods");
?>