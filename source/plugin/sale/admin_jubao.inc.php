<?php
/**
���ƽ������������Դ�롾xlqzm.com���ṩ��������ҵԴ�����¼������Դ�����
�ٷ���վ:xlqzm.com
������ҵ�����http://xqlzm.com/forum-113-1.html
������ҵģ�壺http://xqlzm.com/forum-112-1.html
������ҵԴ�룺http://xqlzm.com/forum-141-1.html
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