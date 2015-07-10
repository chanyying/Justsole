<?php 
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$url = 'http://wuzhuo.net/plugindev/index.php?charset='.CHARSET.'&identifier='.$plugin['identifier'];
$cont =  dfsockopen($url);
header("content-Type: text/html; charset=".CHARSET); 
echo iconv ("GBK",CHARSET,$cont); 


?>