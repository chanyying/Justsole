<?php
/**
 *      版权声明: 该程序为 [DiscuzCMS!] 独立自主开发, 依法拥有该产品知识产权,所有代码版权归[DiscuzCMS!]所有, 程序内均为商业代码, 仅为购买者提供使用授权.
 *		法律声明: 未经官方授权使用修改或者传播都是属于侵权和违法行为, 依法将追究一切相关法律责任.
 *		官方网站: http://www.DiscuzCMS.com 
**/

if(!defined('IN_DISCUZ')) {exit('Access Denied');}

if(empty($_G['uid']) ) {	showmessage($_lang['login'],'',array(),array('login' => true));}

$op =!empty( $_GET['op']) ? addslashes($_GET['op']) : 'mypost';

if($op =='mypost' || $op=='mypostup'){
	$where = " WHERE member_uid='{$_G['uid']}'";
	if($op=='mypostup'){
		$where .=" AND goods_up='1' ";
	}
	$where .=" ORDER BY goods_up DESC,goods_time DESC ";
	$pagenum = DB::result_first("SELECT count('goods_id') FROM ".DB::table('sale_goods').$where);
	$page = $_GET['page'] ? intval($_GET['page']):1;
	$perpage = $sale_config['perpage'];
	$urlnow = $sale_config['root']."?mod={$mod}&op={$op}";
	$multipage = multi($pagenum, $perpage, $page, $urlnow , 0, 10);
	$stat_limit = ($page -1) * $perpage;
	$where .= " LIMIT {$stat_limit},{$perpage}";
	
	$goods_list = fetch_all('sale_goods',$where);
}elseif($op =='memberinfo'){
	$uid = $_G['uid'];
	$member = fetch_all('sale_member'," WHERE member_uid='{$uid}'");
	$member = $member[0];
	if(submitcheck('submit_member')){
		if(!empty($member['member_uid'])){
			DB::update('sale_member',gpc('member_')," member_uid='{$member['member_uid']}'");
			showmessage($_lang['edit_ok']);
		}else{
			DB::insert('sale_member',gpc('member_'));
			showmessage($_lang['edit_ok']);
		}
	}
}elseif($op =='mycredit'){
	if(empty($sale_config['extcredits'])){
		showmessage($_lang['no_extcredits']);
	}else{
		$credit = DB::result_first("SELECT extcredits{$sale_config['extcredits']} FROM ".DB::table('common_member_count')." WHERE uid='{$_G['uid']}'");
		$credit_log =fetch_all('sale_up'," as su LEFT JOIN ".DB::table('sale_goods')." as sg ON su.goods_id = sg.goods_id WHERE sg.member_uid='{$_G['uid']}'");
	}
}elseif($op=='quiteup'){
	$goods_id = intval($_GET['goods_id']);
	DB::update('sale_goods',array('goods_up'=>'')," goods_id='{$goods_id}'");
	showmessage($_lang['edit_ok'],$sale_config['root']."?mod=member&op=mypost");
}elseif($op=='setpostup'){
	$goods_id = intval($_GET['goods_id']);
	$goods = fetch_all('sale_goods'," WHERE goods_id='{$goods_id}'"," goods_title,goods_id,member_uid ");
	$goods = $goods[0];
	include template("sale:{$style}/setpostup");
	exit;
}elseif($op=='jubao'){
	$goods_id = intval($_GET['goods_id']);
	$goods = fetch_all('sale_goods'," WHERE goods_id='{$goods_id}'"," goods_title,goods_id,member_uid ");
	$goods = $goods[0];
	include template("sale:{$style}/jubao");
	exit;
}

$navtitle = $_lang['member']." - ".$sale_config['name'];
include template("sale:{$style}/member");
?>