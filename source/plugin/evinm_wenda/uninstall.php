<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
ploadmodel('install');
$install = new pluginInstall;
$install->uninstall();
$finish = true;
?>
