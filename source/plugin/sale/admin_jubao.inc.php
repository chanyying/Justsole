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

$mod = "admin_jubao";
$self_url = 'plugins&operation=config&identifier=sale&pmod='.$mod."&do=".$do;
$cp_url ='action='.$self_url;

if(isset($_GET['del'])){
	$jubao_id = intval($_GET['del']);
	DB::delete('sale_jubao',array('jubao_id'=>$jubao_id));
}

$jubao_array = fetch_all('sale_jubao'," ORDER BY jubao_time DESC");

$style ='default';
include template("sale:admin/admin_jubao");
?>