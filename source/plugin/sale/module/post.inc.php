<?php
/**
 *      ��Ȩ����: �ó���Ϊ [DiscuzCMS!] ������������, ����ӵ�иò�Ʒ֪ʶ��Ȩ,���д����Ȩ��[DiscuzCMS!]����, �����ھ�Ϊ��ҵ����, ��Ϊ�������ṩʹ����Ȩ.
 *		��������: δ���ٷ���Ȩʹ���޸Ļ��ߴ�������������Ȩ��Υ����Ϊ, ������׷��һ����ط�������.
 *		�ٷ���վ: http://www.DiscuzCMS.com 
**/

if(!defined('IN_DISCUZ')) {exit('Access Denied');}

if(empty($_G['uid']) ) {	showmessage($_lang['login'],'',array(),array('login' => true));}

$goods_id = intval($_GET['goods_id']);
$op = !empty($_GET['op']) ? addslashes($_GET['op']) : 'post';
$uid = $_G['uid'];

$goods = fetch_all('sale_goods'," WHERE goods_id='{$goods_id}'");
$goods = $goods[0];

$cat = fetch_all("sale_cat"," WHERE cat_status='1' ORDER BY cat_sort DESC ");

if($op =='edit'){
	if($goods['member_uid'] !=$_G['uid'] && !is_sale_admin()){
		showmessage($_lang['no_quanxian']);
	}else{
		$uid = $goods['member_uid'];
	}
}

$member = fetch_all('sale_member'," WHERE member_uid='{$uid}'");
$member = $member[0];

$my_credit = fetch_all("common_member_count"," WHERE uid='{$uid}'"," extcredits{$sale_config['extcredits']} ","0");
$my_credit = $my_credit["extcredits{$sale_config['extcredits']}"];

if(submitcheck('post_submit') || submitcheck('edit_submit')){
	
	if(empty($_GET['province']) && $op=='post'){
		showmessage($_lang['must_province']);
	}
	if(empty($_GET['goods_text'])){
		showmessage($_lang['must_goods_text']);
	}
	if(empty($_GET['goods_price'])){
		showmessage($_lang['must_goods_price']);
	}
	if(empty($_GET['member_username'])){
		showmessage($_lang['must_member_username']);
	}
	if(empty($_GET['member_phone'])){
		showmessage($_lang['must_member_phone']);
	}
	if(!isset($_GET['goods_selltype_sell']) && !isset($_GET['goods_selltype_swap']) && !isset($_GET['goods_selltype_give']) ){
		showmessage($_lang['must_goods_selltype']);
	}
	
	/* begin:������������	*/
	if($op=='post'){
		$new_credit = $my_credit - $sale_config['postcredit'];
		if($new_credit <0){
			showmessage($_lang['post'].$sale_config['credit_unit'].$_lang['not_credit']);
		}else{
			DB::query("UPDATE ".DB::table('common_member_count')." SET extcredits{$sale_config['extcredits']}='{$new_credit}' WHERE uid='{$_G['uid']}'");
		}
	}
	/* end:������������	*/
	
	$goods = gpc('goods_');
	$_member = gpc('member_');
	if($op=='post'){
		$_member['member_uid'] = $_G['uid'];
	}
	
	if($goods['goods_settime'] != 0){
		if($goods['goods_settime'] == 7){
			$goods['goods_settime'] = strtotime("+7 days");
		}elseif($goods['goods_settime'] == 30){
			$goods['goods_settime'] = strtotime("+30 days");
		}elseif($goods['goods_settime'] == 90){
			$goods['goods_settime'] = strtotime("+90 days");
		}elseif($goods['goods_settime'] == 180){
			$goods['goods_settime'] = strtotime("+180 days");
		}
	}else{
		$goods['goods_settime'] = 0;
	}

	if($op=='post'){
		$goods['goods_ip'] = $_SERVER["REMOTE_ADDR"];
		$ip_xml = file_get_contents("http://www.youdao.com/smartresult-xml/search.s?type=ip&q={$goods['goods_ip']}");
		preg_match_all("/<location>(.*?)<\/location>/i",$ip_xml,$m);
		$goods['goods_ip_adr'] = $m[1][0];
	}

	$goods_array = $goods;
	/* begin:cat+subcat */
	if( !empty($_GET['cat'])){
		list($goods_array['cat_id'],$goods_array['cat_title']) = explode('-', addslashes($_GET['cat']));
	}
	
	if( !empty($_GET['subcat'])){
		list($goods_array['subcat_id'],$goods_array['subcat_title']) = explode('-',addslashes($_GET['subcat']));       
	}
	/* end:cat+subcat */
	
	if(!empty($_GET['province'])){
		$goods_array['province'] = daddslashes($_GET['province']) ; 
		$goods_array['city'] = daddslashes($_GET['city']) ; 
		$goods_array['dist'] = daddslashes($_GET['dist']) ; 
		$goods_array['community'] = daddslashes($_GET['community']) ; 
	}
	
	if($op =='post'){
		$goods_array['member_uid'] = $_member['member_uid'];
		$goods_array['member_username'] = $_member['member_username'];
	}
	
	if($op =='post'){
		if($member['member_uid']){
			DB::update('sale_member',$_member,"member_uid='{$_member['member_uid']}'");
		}else{
			DB::insert('sale_member',$_member);
		}
	}
	
	require_once DISCUZ_ROOT.'./source/plugin/sale/include/update_class.func.php';
	$goods_upload_file_array = array('goods_upload_file_1','goods_upload_file_2','goods_upload_file_3','goods_upload_file_4');
	foreach($goods_upload_file_array as $file_name){
		if($_FILES[$file_name]['size']){
			@$goods_array[$file_name] = upload_file($file_name,'sale');
		}
	}
	$goods_array['goods_time'] = time();
	
	if($sale_config['auto_pass']){
		$goods_array['goods_status']='1';
	}

	if($op =='post'){
		$goods_id = DB::insert('sale_goods',$goods_array,$goods_id = true);
		showmessage($_lang['post_ok'],$sale_config['root']."?mod=view&goods_id={$goods_id}");
	}elseif($op =='edit'){
		DB::update('sale_goods',$goods_array,"goods_id='{$goods_id}'");
		showmessage($_lang['edit_ok'],$sale_config['root']."?mod=view&goods_id={$goods_id}");
	}
}

$navtitle = $_lang['post'].' - '.$sale_config['name'];
include template("sale:{$style}/post");
?>