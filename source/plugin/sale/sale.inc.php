<?php
/**
���ƽ������������Դ�롾xlqzm.com���ṩ��������ҵԴ�����¼������Դ�����
�ٷ���վ:xlqzm.com
������ҵ�����http://xqlzm.com/forum-113-1.html
������ҵģ�壺http://xqlzm.com/forum-112-1.html
������ҵԴ�룺http://xqlzm.com/forum-141-1.html
**/

if(!defined('IN_DISCUZ')) {exit('Access Denied');}

/*
ini_set("display_errors","on");
set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
*/

global $sale_config,$_lang;
include ("include/config.class.php");
include ("include/function.class.php");

$mod_array = array('post','edit','member','setpostup','jubao','memberinfo','kefu','index','view','admin','orderdetail','search','ajax');
$mod = in_array($_GET['mod'],$mod_array) ? addslashes($_GET['mod']) : 'index';
if(isset($_GET['sale_id']) && !isset($_GET['mod'])){
	$mod ='view';
}elseif(!isset($_GET['mod'])){
	$mod = 'index';
}
$now = $mod;

$_lang = lang('plugin/sale');

$style = $sale_config['style'];
require DISCUZ_ROOT.'./source/plugin/sale/module/'.$mod.'.inc.php';
?>