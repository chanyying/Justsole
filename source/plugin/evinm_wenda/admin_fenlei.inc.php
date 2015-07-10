<?php 
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


//查询分类
$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' ORDER BY  `paixu` ASC');
$list = array();
while($f_rows = DB::fetch($f_class_sql)) {
	$mood['type'] = $f_rows['type'];
	$mood['id'] = $f_rows['id'];
	$mood['fid'] = $f_rows['fid'];
	$mood['name'] = $f_rows['name'];
	$mood['paixu'] = $f_rows['paixu'];
	$mood['vipuid'] = $f_rows['vipuid'];
	$list[] = $mood;
}



//添加分类
if ($_GET['class_submit']) {
	$fname = explode("|",addslashes($_GET['fname']));
	if(is_array($fname)) {
		$i = 0;
		if($_GET['fid'] == '0') {
			for($i;$i<count($fname);$i++) {
				DB::insert('evinm_wenda_fenlei',array('fid'=>'0','name'=>$fname[$i],'type'=>'group'));				
			}
			echo ' <script type="text/javascript"> windowl.location.href=window.location.href; </script> ';
			cpmsg('操作成功！');
		}else{
			for($i;$i<count($fname);$i++) {
				DB::insert('evinm_wenda_fenlei',array('fid'=>addslashes($_GET['fid']),'name'=>$fname[$i],'type'=>'sup'));				
			}
			echo ' <script type="text/javascript"> windowl.location.href=window.location.href; </script> ';
			cpmsg('操作成功！');
		}
	}
}

// 删除分类
if($_GET['editsubmit']) {
	foreach ($_GET['delete'] as $id) { 
		DB::delete('evinm_wenda_fenlei',"fid = $id");
		DB::delete('evinm_wenda_fenlei',"id = $id");		
	}  
	
	foreach($_GET['id'] as $key=>$value){
		DB::update('evinm_wenda_fenlei',array(
		'name'=>addslashes($_GET['name'][$key]),
		'paixu'=>addslashes($_GET['paixu'][$key]),
		'vipuid'=>addslashes($_GET['vipuid'][$key])),"`id` = $value");		
	}
	echo ' <script type="text/javascript"> windowl.location.href=window.location.href; </script> ';
	cpmsg('操作成功！');
}




include template('evinm_wenda:admincp_fenlei');

?>