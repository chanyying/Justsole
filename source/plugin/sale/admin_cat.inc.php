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

$mod = "admin_cat";
$form_url = 'plugins&operation=config&identifier=sale&pmod='.$mod."&do=".$do;
$cp_url ='action='.$form_url;
$now_url = ADMINSCRIPT."?".$cp_url;

$cat_pid =!empty($_GET['cat_pid']) ? intval($_GET['cat_pid']) : 0;

if(isset($_GET['submit'])){
	$post = array();
	$post = gpc('cat_');
	DB::insert('sale_cat',$post);
}

if(isset($_GET['del'])){
	$del['cat_id'] = intval($_GET['del']);
	DB::delete('sale_cat',$del);
}

if(isset($_GET['edit'])){
	$edit =  intval($_GET['edit']);
	$edit_array= array();
	$query =DB::query('SELECT * FROM '.DB::table('sale_cat').' WHERE cat_id='.$edit.' ORDER BY cat_pid DESC,cat_sort ASC');
	while($tem = DB::fetch($query)){
		$edit_array[] = $tem;
	}
	$edit_array = $edit_array[0];
}

if(isset($_GET['edit_submit'])){
	$edit_array = array();
	$edit_array = gpc('cat_');
	DB::update('sale_cat',$edit_array,array('cat_id'=>$edit_array['cat_id']));
}

$cat_array =array();
$sql = 'SELECT * FROM '.DB::table('sale_cat');
$sql .= ' ORDER BY cat_pid ASC,cat_sort ASC';

$query =DB::query($sql);
while($tem = DB::fetch($query)){
	$cat_array[] = $tem;
}

$pid_cat_array = array();
$pid_cat_array = fetch_all("sale_cat"," WHERE cat_id='{$cat_pid}' ","*",0);

$style ='default';
include template("sale:admin/admin_cat");
?>
