<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
} 

include_once dirname(__FILE__) . '/load.php';
// д����ʼ����
$setData = array('version' => DZC_VERSION);
cw_updateSetData($setData);

?>