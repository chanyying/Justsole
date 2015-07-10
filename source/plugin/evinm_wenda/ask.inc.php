<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


/*编辑器开始*/
require_once libfile('function/discuzcode');
$editorid = 'e';
$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
$editormode = $_G['setting']['editoroptions']{0};
$allowswitcheditor = $_G['setting']['editoroptions']{1};
$editor = array(
	'editormode' => $editormode,
	'allowswitcheditor' => $allowswitcheditor,
	'allowhtml' => 1,
	'allowhtml' => 1,
	'allowsmilies' => 1,
	'allowbbcode' => 1,
	'allowimgcode' => 1,
	'allowcustombbcode' => 0,
	'allowresize' => 1,
	'textarea' => 'message',
	'simplemode' => !isset($_G['cookie']['editormode_'.$editorid]) ? 1 : $_G['cookie']['editormode_'.$editorid],
);
loadcache('bbcodes_display');
/*编辑器结束*/


include DISCUZ_ROOT . './source/plugin/evinm_wenda/model/index.inc.php';
$config = _config();
global $_G;

if($config['openmdeltw'] == 0) {
	is_login();
}

$ac = addslashes($_GET[ac]);
$qid = addslashes($_GET[qid]);


$mjfgroups = unserialize($config['mjf_group']);
if(in_array($_G[groupid],$mjfgroups)) {
	$mjf = 1;
}

//查询分类
$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' ORDER BY  `paixu` ASC ');
$list_f = array();
while($f_rows = DB::fetch($f_class_sql)) {
	$mood['type'] = $f_rows['type'];
	$mood['id'] = $f_rows['id'];
	$mood['fid'] = $f_rows['fid'];
	$mood['name'] = $f_rows['name'];
	$list_f[] = $mood;
}

$ft_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' ORDER BY  `paixu` ASC ');
$list_f_t = array();
while($f_rowst = DB::fetch($ft_class_sql)) {
	$moodt['type'] = $f_rowst['type'];
	$moodt['id'] = $f_rowst['id'];
	$moodt['fid'] = $f_rowst['fid'];
	$moodt['name'] = $f_rowst['name'];
	$list_f_t[] = $moodt;				
}

//提问
if(empty($ac) && empty($qid)) {
	if(submitcheck('hdsubmit')) {
		ploadmodel('UploadFile');
		ploadmodel('upload');
	}
}else if($ac == 'edit' && !empty($qid)){
	$edit_ask = DB::fetch(DB::query('select * from '.DB::table('evinm_wenda_ask').' where `id` = '.$qid));
	$edit_ask[sup_name] = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($edit_ask[fenlei_sup]));
	$edit_ask[f_name] = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($edit_ask[fenlei]));

	if(submitcheck('hdsubmit')) {
		ploadmodel('UploadFile');
		ploadmodel('upload');
	}
}



include template('evinm_wenda:ask');
?>