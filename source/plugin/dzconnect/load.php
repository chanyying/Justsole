<?php
define('DZC_VERSION', '1.0.6'); // �汾
define('DZC_PLUGDIR', dirname(__FILE__));
define('DZC_ROOT', DZC_PLUGDIR . '/../../../');

if (!defined('IN_DISCUZ')) {
	require_once DZC_ROOT . 'source/class/class_core.php';
	$discuz = &discuz_core :: instance();
	$discuz -> init(); 
	// } else {
	// $discuz = &discuz_core :: instance();
} 

global $_G, $_DZC_LANG, $_DZC_TIPS, $_DZC_SHARE_TITLE;

@include DZC_PLUGDIR . '/set.data.php';

define("BJTIMESTAMP", ($_DZC_SET['minutes'] && $_DZC_SET['char']) ? time() + ($_DZC_SET['char'] * $_DZC_SET['minutes'] * 60) : time()); //������ʱ��У��
define('OS_DZ_VERSION', substr($_G['setting']['version'], 1)); // �汾
define('OS_DZ_CHARSET', str_replace("-", "", strtoupper($_G['charset']))); // ����
define('OS_DZ_NAMR', $_G['setting']['bbname']);
define('OS_DZ_URL', rtrim(str_replace('source/plugin/dzconnect', '', $_G['siteurl']), '/'));
define('DZC_PLUGURL', OS_DZ_URL . '/source/plugin/dzconnect');
define('DZC_SSO', OS_DZ_URL . '/forum.php?sso=');
define('DZC_LOGIN', DZC_PLUGURL . '/login.php');
// �ж�����
function _dzc_lang() {
	$charset = strtolower(OS_DZ_CHARSET);
	if ($charset == 'utf8') {
		global $_G;
		if ($_G['config']['output']['language'] == 'zh_tw') { // ����
			return $charset . '_TC';
		} 
	} 
	return $charset;
} 

require DZC_PLUGDIR . '/lang/' . _dzc_lang() . '.php';

include DZC_PLUGDIR . '/functions.php';
include DZC_PLUGDIR . '/discuz.func.php';

?>