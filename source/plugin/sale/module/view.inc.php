<?php
/**
 *      ��Ȩ����: �ó���Ϊ [DiscuzCMS!] ������������, ����ӵ�иò�Ʒ֪ʶ��Ȩ,���д����Ȩ��[DiscuzCMS!]����, �����ھ�Ϊ��ҵ����, ��Ϊ�������ṩʹ����Ȩ.
 *		��������: δ���ٷ���Ȩʹ���޸Ļ��ߴ�������������Ȩ��Υ����Ϊ, ������׷��һ����ط�������.
 *		�ٷ���վ: http://www.DiscuzCMS.com 
**/

if(!defined('IN_DISCUZ')) {exit('Access Denied');}

$is_sale_admin = is_sale_admin();
$goods_id = daddslashes($_GET['goods_id']);
$goods = fetch_all('sale_goods'," WHERE goods_id='{$goods_id}'");
$goods = $goods[0];
$goods['goods_text'] = stripslashes($goods['goods_text']);

if(empty($goods['goods_status']) ){
	if( $goods['member_uid'] !=$_G['uid'] && $is_sale_admin ){
		showmessage($_lang['no_quanxian']);
	}
}

$op =addslashes($_GET['op']);
if($op=='del'){
	if($goods['member_uid']==$_G['uid'] || $is_sale_admin){
		DB::delete('sale_goods'," goods_id='{$goods_id}'  ");
		showmessage($_lang['delete_ok'],$sale_config['root']);
	}else{
		showmessage($_lang['no_quanxian']);
	}
}

$member = fetch_all('sale_member'," WHERE member_uid='{$goods['member_uid']}'");
$member = $member[0];

DB::query("UPDATE ".DB::table('sale_goods')." SET goods_view = `goods_view`+1 WHERE goods_id='{$goods_id}'");

$maybelike = fetch_all('sale_goods'," LIMIT 10 ");
$maybelike_cat = fetch_all('sale_cat'," LIMIT 10");

$navtitle = $goods['goods_title']." - ".$sale_config['name'];
include template("sale:{$style}/view");
?>