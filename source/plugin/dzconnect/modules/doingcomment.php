<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
} 
// var_dump($GLOBALS); die();
global $_G;
$op = isset($_G['gp_op']) ? (string)$_G['gp_op'] : '';
// dz��spacecp_comment.php�����ܴ���©��������$_POST
$doid = isset($_G['gp_doid']) ? (int)$_G['gp_doid'] : 0;
// ���۵���һid
$up_id = isset($_G['gp_id']) ? (int)$_G['gp_id'] : 0;
$message = !empty($GLOBALS['message']) ? (string)$GLOBALS['message'] : '';
if ($doid > 0 && $up_id == 0 && $op == 'comment') {
	include_once DZC_PLUGDIR . '/load.php';
	dzc_doingcomment_sync($doid, $message);
} 
