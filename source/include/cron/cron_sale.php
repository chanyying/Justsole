<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$goods_up = array();
$query = DB::query('SELECT * FROM '.DB::table('sale_up'));
while($tem = DB::fetch($query)){
	$goods_up[] = $tem;
}

if(!empty($goods_up)){
	$time = time();
	foreach($goods_up as $up){
		if($time > $up['up_endtime']){
			DB::delete('sale_up',array('goods_id'=>$up['goods_id']));
			DB::update('sale_goods',array('goods_up'=>0)," goods_id='{$up['goods_id']}'");
		}
	}
}
?>