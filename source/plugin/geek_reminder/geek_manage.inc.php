<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
@include DISCUZ_ROOT. 'source/plugin/geek_reminder/common/function.inc.php';
$do = ($_GET['do']) ? $_GET['do'] : '';
$act = ($_GET['act']) ? $_GET['act'] : '';
$id = $_GET['id'];
$geek = new Geek_Reminder();
$param = $geek->param;
$action = $geek->action;
$lang = $geek->l;
$cache = $geek->c;

switch($act)
{
	case 'save':
		$action = 'action='. $action .'geek_list';
		$data = array();
		foreach( $geek->param_key as $v )
		{
			$data[$v] = $_POST[$v];
		}
		$cache[$data['tid']] = $data;
		save_syscache('geek_reminder', $cache);
		cpmsg('msg_save_scc', $action, 'succeed');
		break;

	case 'del':
		$action = 'action='. $action .'geek_list';
		if($id || $id == 0)
		{
			unset($cache[$id]);
			save_syscache('geek_reminder', $cache);
		}
		cpmsg('msg_del_scc', $action, 'succeed');
		break;

	default:
		$action .= 'geek_manage&act=save';
		$data = $geek->c[$id];

		showformheader($action);
		showtableheader();
		showsetting('set_isopen', 'isopen', $data['isopen'], 'radio', '', 0, '', '', '', true);
		showsetting('set_tid', 'tid', $data['tid'], 'text', '', 0, '', '', '', true);
		showsetting('set_point', array('point', $param['point']), $data['point'], 'select', '', 0, '', '', '', true);
		showtitle('set_prep');
		showsetting('set_content', 'content', $data['content'], 'textarea', '', 0, '', '', '', true);
		showsetting('set_time', 'time', $data['time'], 'calendar', '', 0, '', '', '', true);
		showsetting('set_advance', array( 'advance', $param['advance']), $data['advance'], 'select', '', 0, '', '', '', true);
		showsetting('set_url', 'url', $data['url'], 'text', '', 0, '', '', '', true);
		showsetting('set_icon', array( 'icon', $param['icon']), $data['icon'], 'select', '', 0, '', '', '', true);
		showsubmit('submit','submit_tips');
		showtablefooter();
		showformfooter();
		echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
}