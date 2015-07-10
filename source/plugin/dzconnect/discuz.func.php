<?php
/**
 * �ڲ�����
 */
// �ж��Ƿ��Ѿ���¼
function is_user_logged_in() {
	global $_G;
	if ($_G['uid']) {
		return true;
	} 
	return false;
} 
// ��������
function cw_updateSetData($k = '', $v = false) {
	$setDataFile = DZC_PLUGDIR . '/set.data.php';
	$oldDataExist = 0;
	if (file_exists($setDataFile)) {
		include $setDataFile;
		if (is_array($_DZC_SET)) {
			if (version_compare($_DZC_SET['version'], DZC_VERSION, '<')) {
				$oldDataExist = 1;
			} 
		} 
	} 

	$setData = cw_getDefaultSetData();
	if (1 == $oldDataExist) {
		$setData = array_merge($setData, (array)$_DZC_SET);
	} elseif ($_DZC_SET) {
		$setData = $_DZC_SET;
	} 

	if ($k) {
		$set = $k;
		if (!is_array($k)) {
			$set = array('' . $k => $v);
		} 
		foreach ($set as $kk => $vv) {
			$setData[$kk] = $vv;
		} 
	} 
	return cw_writeToFile($setDataFile, $setData, '$_DZC_SET');
} 

// ��ȡĬ�ϵĲ������
function cw_getDefaultSetData() {
	include DZC_PLUGDIR . '/set.data.default.php';
	return (array)$_DZC_SET;
} 
// ����΢����openid/uid��ȡUID
function dzc_getUid($name, $mid = '', $uid = '') {
	global $_G;
	if ($mid) {
		$uid = $mid;
		$openid = 'openid';
	} else {
		if (!$uid) $uid = $_G['uid'];
		if ($uid > 0) {
			$openid = 'uid';
		} else {
			return;
		} 
	}
	$query = DB::fetch_first("SELECT uid FROM " . DB::table('dzc_user_bind') . " WHERE name = '$name' AND $openid = '$uid'");
	return $query['uid'];
} 
// ����΢����UID/openid����û���Ϣ
function dzc_getUser($name, $mid = '', $uid = '') {
	global $_G;
	if ($mid) {
		$uid = $mid;
		$openid = 'openid';
	} else {
		if (!$uid) $uid = $_G['uid'];
		if ($uid > 0) {
			$openid = 'uid';
		} else {
			return;
		} 
	}
	return DB::fetch_first("SELECT * FROM " . DB::table('dzc_user_bind') . " WHERE name = '$name' AND $openid = '$uid'");
} 
// �����û�UID��ȡ�󶨵�΢����Ϣ
function dzc_getUserAll($uid = '') {
	global $_G;
	if (!$uid) $uid = $_G['uid'];
	if ($uid > 0) {
		$query = DB::query("SELECT name,openid,userdata FROM " . DB::table("dzc_user_bind") . " WHERE uid='$uid'");
		$apis = array();
		while ($arr = DB::fetch($query)) {
			$apis[$arr['name']] = $arr;
		} 
		return $apis;
	} 
} 
// ��Ӱ�
function dzc_addUser($name, $openid, $userdata, $uid = '') {
	global $_G;
	if (!$uid) $uid = $_G['uid'];
	if ($uid > 0) {
		if (is_array($userdata)) {
			$userdata = serialize($userdata);
		} 
		$data = array('uid' => $uid,
			'name' => $name,
			'openid' => $openid,
			'userdata' => $userdata
			);
		return DB::insert('dzc_user_bind', $data);
	} 
} 
// ������
function dzc_updateUser($name, $openid, $userdata) {
	$uid = dzc_getUid($name, $openid);
	if ($uid) {
		if (is_array($userdata)) {
			$userdata = serialize($userdata);
		} 
		return DB::query("UPDATE " . DB::table('dzc_user_bind') . " SET userdata='$userdata' WHERE uid='$uid' AND name='$name'");
	} else {
		dzc_addUser($name, $openid, $userdata);
	} 
} 
// ɾ����
function dzc_delUser($name = '', $uid = '') {
	global $_G;
	if (!$uid) $uid = $_G['uid'];
	if ($uid > 0) {
		$sql = "DELETE FROM " . DB::table('dzc_user_bind') . " WHERE uid = '$uid'";
		if ($name) {
			$sql .= " AND name = '$name'";
		} 
		return DB::query($sql);
	} 
} 
// ����΢����Ϣ
function dzc_updateWeixin($uid, $userdata) {
	global $_G;
	return DB::query("UPDATE " . DB::table('dzc_user_bind') . " SET userdata='$userdata' WHERE uid='$uid' AND name='weixin'");
} 
// ���ͬ����΢��ID
function dzc_addMid($tid, $tweets, $log, $type) {
	global $_G;
	$data = array('tid' => $tid,
		'tweets' => serialize($tweets),
		'log' => serialize($log),
		'type' => $type
		);
	return DB::insert('dzc_tweets', $data);
} 
// ��ȡͬ����΢��ID
function dzc_getMid($tid, $type) {
	$sql = DB::fetch_first("SELECT tweets,log FROM " . DB::table('dzc_tweets') . " WHERE tid='$tid' AND type='$type'");
	return $sql ? array('tweets' => unserialize($sql['tweets']), 'log' => unserialize($sql['log'])) : array();
} 
// ��΢��
function dzc_weixin_bind($weixin, $username, $password, $questionid, $answer, $loginfield = 'username') {
	if ($loginfield == 'uid') {
		$isuid = 1;
	} elseif ($loginfield == 'email') {
		$isuid = 2;
	} else {
		$isuid = 0;
	} 
	$verifyresult = dzc_userlogin_verify($username, $password, $questionid, $answer, $isuid);
	$uid = $verifyresult[0];
	if ($uid > 0) {
		$media = 'weixin';
		if (!dzc_getUid($media, '', $uid)) {
			$get_uid = dzc_getUid($media, $weixin);
			if ($get_uid) {
				return -201; // �ѱ���
			} 
			dzc_addUser($media, $weixin, '', $uid);
		} else {
			$uid = -202; // �Ѿ�����
		}
	} 
	return $uid;
} 
// ��¼/ע��
function dzc_user_login($token, $username = '', $password = '', $email = '') {
	global $_G;
	$media = $token['media'];
	$openid = $token['uid'];
	if ($media && $openid) {
		$uid = dzc_getUid($media, $openid);
		if ($_G['uid']) { // �ѵ�¼�İ�
			if (!$uid) {
				dzc_addUser($media, $openid, $token);
			} else {
				exit(_dzc_tips('-201', 1)); // ΢���ѱ���
			} 
		} else {
			if (!$uid) { // ���û�
				$new = 1;
				if (empty($password)) {
					set_c_session('user', $token);
					header('Location:' . DZC_SSO . 'register');
					die();
				} else {
					$uid = dzc_register_user($username, $password, $email);
					if ($uid > 0) {
						dzc_addUser($media, $openid, $token);
					} else {
						return $uid;
					} 
				}
			} else { // �����ʺ�
				if (is_array($token)) {
					$token = serialize($token);
				} 
				DB::query("UPDATE " . DB::table('dzc_user_bind') . " SET openid='$openid',userdata='$token' WHERE uid='$uid' AND name='$media'");
				// V1.2.3
				$member_uid = DB::result_first("SELECT uid FROM " . DB::table('common_member_profile') . " WHERE uid = $uid"); 
				if (!$member_uid) {
					$field = array('common_member_profile', 'common_member_field_forum', 'common_member_field_home');
					foreach($field as $value) {
						$muid = DB::result_first("SELECT uid FROM " . DB::table($value) . " WHERE uid = $uid");
						if (!$muid) {
							DB::insert($value, array('uid' => $uid));
						} 
					} 
				} 
			} 
			dzc_login_user($uid);
			del_c_session('user');
			// ���UCenterͬ��JS
			global $_G;
			if ($_G['setting']['allowsynlogin']) {
				loaducenter();
				$ucsynlogin = uc_user_synlogin($_G['uid']);
			} 
			if ($new) {
				$referer = get_c_session('referer');
				$param = array('username' => $_G['member']['username'], 'usergroup' => $_G['group']['grouptitle']);
				showmessage('login_succeed', $referer, $param, array('extrajs' => $ucsynlogin));
			} else {
				echo $ucsynlogin;
			} 
		} 
		return $uid;
	} 
} 
// δ��¼ʱ��(�����ʺ�)
function dzc_user_bind($token, $username, $password, $questionid, $answer, $loginfield = 'username') {
	if ($loginfield == 'uid') {
		$isuid = 1;
	} elseif($loginfield == 'email') {
		$isuid = 2;
	} else {
		$isuid = 0;
	}
	$verifyresult = dzc_userlogin_verify($username, $password, $questionid, $answer, $isuid);
	$uid = $verifyresult[0];
	if ($uid > 0) {
		$media = $token['media'];
		$openid = $token['uid'];
		$get_uid = dzc_getUid($media, $openid);
		if ($get_uid) {
			return -201; // ΢���ѱ���
		} 
		dzc_addUser($media, $openid, $token, $uid);
		dzc_login_user($uid);
		del_c_session('user');
		// ���UCenterͬ��JS
		global $_G;
		if ($_G['setting']['allowsynlogin']) {
			loaducenter();
			echo uc_user_synlogin($_G['uid']);
		}
	} 
	return $uid;
} 
// δ��¼ʱ��֤�û���Ϣ
/**
 * ���������֤
 * �뱣֤���������ַ�������̳�ַ���һ�£�������������ת���ٴ���
 * @param string $username
 * @param string $password
 * @param int $questionid
 * @param string $answer
 * @param boolen $isuid ʹ��UID��֤ô��
 * @return array
 *    ��һ�������±꣨$return[0]��������0�����ʾ��֤�ɹ��ĵ�¼uid������Ϊ������Ϣ��
 *   	 -1:UC�û������ڣ����߱�ɾ��
 *    	 -2:�����
 *   	 -3:��ȫ���ʴ�
 *   	 -4:�û�û����dzע��
 *    �ڶ��������±꣨$return[1]�������ڵ���0�����ʾ��֤�ɹ���adminid��
 *   	 ����Ϊ-1����ʾ��֤ʧ��
 */
function dzc_userlogin_verify($username, $password, $questionid = '', $answer = '', $isuid = 0) {
	$return = array(0 => -1, 1 => -1);
	loaducenter();
	$ucresult = uc_user_login($username, $password, $isuid, 1, $questionid, $answer);
	if ($ucresult[0] < 1) {
		$return[0] = $ucresult[0];
	} else {
		$uid = (int)$ucresult[0];
		$member = DB::fetch_first("SELECT uid, username, adminid FROM " . DB::table('common_member') . " WHERE uid='{$uid}'");
		if (!$member) {
			$return[0] = -4;
		} else {
			$return[0] = (int)$member['uid'];
			$return[1] = (int)$member['adminid'];
		} 
	} 
	return $return;
} 
// ��¼
function dzc_login_user($uid) {
	global $_G;
	if (empty($uid)) return false;
	include_once DISCUZ_ROOT . '/source/function/function_member.php';
	$member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid = $uid");
	if (is_array($member) && $member['username']) {
		setloginstatus($member, time() + 60 * 60 * 24 ? 2592000 : 0);
		DB::query("UPDATE " . DB::table('common_member_status') . " SET lastip='" . $_G['clientip'] . "', lastvisit='" . time() . "' WHERE uid='$uid'");

		include_once libfile('function/stat');
		updatestat('login');
		updatecreditbyaction('daylogin', $uid);
		checkusergroup($uid);
		return true;
	} 
	return false;
} 
// ע��
function dzc_register_user($username, $password, $email) {
	global $_G;
	if (!$password) $password = rand(100000,999999);
	loaducenter();
	require_once libfile('function/misc');
	require_once libfile('function/member'); 
	$groupinfo = array();
	if ($_G['setting']['regverify']) {
		$groupinfo['groupid'] = 8;
	} else {
		$groupinfo = DB::fetch_first("SELECT groupid FROM " . DB::table('common_usergroup') . " WHERE creditshigher<=" . intval($_G['setting']['initcredits']) . " AND " . intval($_G['setting']['initcredits']) . "<creditslower LIMIT 1");
	} 
	// ע�ᵽUCenter
	$uid = uc_user_register($username, $password, $email, '', '', $_G['clientip']);

	if ($uid <= 0) {
		return $uid;
	} 
	// ���uid�ظ�
	if (DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE uid='$uid'")) {
		return false;
	} 
	// �������ݱ�
	$dzpassword = md5(random(10));
	$init_arr = explode(',', $_G['setting']['initcredits']);
	$userdata = array('uid' => $uid,
		'username' => $username,
		'password' => $dzpassword,
		'email' => $email,
		'adminid' => 0,
		'groupid' => $groupinfo['groupid'],
		'regdate' => TIMESTAMP,
		'credits' => $init_arr[0],
		'timeoffset' => 9999
		);
	DB::insert('common_member', $userdata);
	$status_data = array('uid' => $uid,
		'regip' => $_G['clientip'],
		'lastip' => $_G['clientip'],
		'lastvisit' => TIMESTAMP,
		'lastactivity' => TIMESTAMP,
		'lastpost' => 0,
		'lastsendmail' => 0,
		);
	DB::insert('common_member_status', $status_data); 
	DB::insert('common_member_profile', array('uid' => $uid));
	DB::insert('common_member_field_forum', array('uid' => $uid));
	DB::insert('common_member_field_home', array('uid' => $uid));
	// ��ʼ������
	$count_data = array('uid' => $uid,
		'extcredits1' => $init_arr[1],
		'extcredits2' => $init_arr[2],
		'extcredits3' => $init_arr[3],
		'extcredits4' => $init_arr[4],
		'extcredits5' => $init_arr[5],
		'extcredits6' => $init_arr[6],
		'extcredits7' => $init_arr[7],
		'extcredits8' => $init_arr[8]
		);
	DB::insert('common_member_count', $count_data);
	manyoulog('user', $uid, 'add'); 
	// ��������ע��
	require_once libfile('cache/userstats', 'function');
	build_cache_userstats();
	// ��������ע�ᣨ�û�����
	loadcache('setting', true);
	$_G['setting']['lastmember'] = $username;
	save_syscache('setting', $_G['setting']); 
	// ����session
	$_G['uid'] = $uid;
	$_G['username'] = $username;
	$_G['member']['username'] = dstripslashes($_G['username']);
	$_G['member']['password'] = $dzpassword;
	$_G['groupid'] = $groupinfo['groupid'];
	include_once libfile('function/stat');
	updatestat('register');

	$_CORE = &discuz_core::instance();
	$_CORE -> session -> set('uid', $uid);
	$_CORE -> session -> set('username', $username); 
	// ����cookie
	dsetcookie('auth', authcode("{$_G['member']['password']}\t$_G[uid]", 'ENCODE'), 2592000, 1, true);
/*
	$pm_subject = replacesitevar($lang['auto_register_pm_subject']);
	$pm_message = replacesitevar($lang['auto_register_pm_message']);
	$pm_message = str_replace(array('{password}'), array($password), $pm_message);

	$pm_subject = addslashes($pm_subject);
	$pm_message = addslashes($pm_message);

	sendpm($uid, $pm_subject, $pm_message, 0);
*/
	return $uid;
} 

function _dzc_tips($code, $bind = '') {
	global $_DZC_TIPS;
	$tips = $bind ? $_DZC_TIPS['bind'] : $_DZC_TIPS['reg'];
	$code = (string)$code;
	return isset($tips[$code]) ? $tips[$code] : 'Unknown error';
}
// ���˷�������
function dzc_filter($content) {
	global $_G; 
	// �������ص�����
	$content = preg_replace("/\[hide\s*(.*?)\s*\[\/hide\]/is", '', $content);
	// ��[attachimg]��[attach]��UBB��ǩ��ͬ���ݸ�ȫ��ɾ��
	$content = preg_replace('!\[(attachimg|attach)\]([^\[]+)\[/(attachimg|attach)\]!', '', $content);

	/**
	 * ����[img]��ǩ�����������ӿո񣬷�ֹճ�� 2010-10-12
	 */
	$content = preg_replace('|\[img(?:=[^\]]*)?\](.*?)\[/img\]|', '\\1 ', $content); 
	// ����UBB
	$re = "#\[([a-z]+)(?:=[^\]]*)?\](.*?)\[/\\1\]#sim";
	while (preg_match($re, $content)) {
		$content = preg_replace($re, '\2', $content);
	} 
	// ���˱���
	$re = isset($_G['cache']['smileycodes']) ? (array)$_G['cache']['smileycodes'] : array();
	$smiles_searcharray = isset($_G['cache']['smilies']['searcharray']) ? (array)$_G['cache']['smilies']['searcharray'] : array();
	$content = str_replace($re, '', $content);
	$content = preg_replace($smiles_searcharray, '', $content); 
	// ����ո��Ϊһ���ո�ǰ��ո�ȥ��
	$content = preg_replace("#\s+#", ' ', $content);
	$content = wp_replace($content);
	return $content;
} 

/**
 * ������
 */
// ��������ID����������
function dzc_get_post_by_tid($tid, $filter = 1) {
	$post = DB::fetch_first("SELECT pid, tid, subject, message FROM " . DB::table('forum_post') . " WHERE tid = '$tid' AND first=1");
	if ($post && $filter) {
		$post['url'] = dzc_get_url($post);
		$post['pic'] = dzc_get_post_image($post['pid'], $post['message']);
		if ($post['pic']) {
			$post['message'] = str_replace($post['pic'], '', strip_tags(dzc_filter(iconv2utf8($post['message']))));
		} 
	} 
	return $post;
} 
// ��ȡ���ӵ�ַ
function dzc_get_url($list, $type = 'forum_viewthread', $rewrite = 1) {
	global $_G;
	$siteUrl = $_G['siteurl'];
	if ($rewrite && $_G['setting']['rewritestatus'] && in_array($type, $_G['setting']['rewritestatus'])) {
		switch ($type) {
			case "forum_viewthread":
				$threadURL = rewriteoutput($type, 1, $siteUrl, $list['tid']);
				break;
			case "home_blog":
				$threadURL = rewriteoutput($type, 1, $siteUrl, $list['uid'], $list['tid']);
				break;
			default:
		} 
	} else {
		switch ($type) {
			case "forum_viewthread":
				$threadURL = $siteUrl . 'forum.php?mod=viewthread&tid=' . $list['tid'];
				break;
			case "home_blog":
				$threadURL = $siteUrl . 'home.php?mod=space&uid=' . $list['uid'] . '&do=blog&id=' . $list['tid'];
				break;
			default:
		} 
	} 
	return $threadURL;
} 

/**
 * ȡ��ָ������ͼƬ������
 * 
 * @param  $pid int ��̳posts id
 * @param  $msg string ��������
 * @return array 
 */
function dzc_get_post_image($pid, $msg, $first = '0') {
	global $_G;
	if (version_compare(OS_DZ_VERSION, '2', '>=')) {
		$tableid = DB::result_first("SELECT tableid FROM " . DB::table('forum_attachment') . " WHERE pid='{$pid}' LIMIT 1");
		$attachmentTableName = 'forum_attachment_' . ($tableid >= 0 && $tableid < 10 ? intval($tableid) : 'unused');
	} else {
		$attachmentTableName = 'forum_attachment';
	} 
	$query = DB::query("SELECT * FROM " . DB::table($attachmentTableName) . " WHERE pid='$pid'");
	while ($attach = DB::fetch($query)) {
		// ֻʹ�ø���ΪͼƬ��û���Ķ�Ȩ�޺ͽ�ǮȨ�ޡ����Ҵ�СС��1�͵ķ��͵�΢��
		if ($attach['isimage'] && $attach['price'] == 0 && $attach['readperm'] == 0 && $attach['filesize'] <= 1024 * 1024) {
			$attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl']) . 'forum';
			$attach['url'] = trim($attach['url'], '/');
			$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
			if (strpos($attach['url'], "://") != false) {
				$attachreplace[] = '[attachimg]' . $attach['url'] . '/' . $attach['attachment'] . '[/attachimg]';
			} else {
				$attachreplace[] = '[attachimg]' . OS_DZ_URL . '/' . $attach['url'] . '/' . $attach['attachment'] . '[/attachimg]';
			} 
			$attachments[] = $attach;
		} 
	} 
	if ($attachfind) {
		$msg = preg_replace($attachfind, $attachreplace, $msg);
	} 
	// ����
	$msg = preg_replace('|\[img=\d+,\d+](.*?)\[/img\]|', '[img]\\1[/img]', $msg); 
	// ��ԭ<img>Ϊ[img]
	$msg = preg_replace('/<img[^>]+src="([^\'"]+)"[^>]+>/', "[img]\\1[/img]", $msg);
	$image_list = array();
	if (preg_match_all('!\[(attachimg|img)\]([^\[]+)\[/(attachimg|img)\]!', $msg, $match, PREG_PATTERN_ORDER)) {
		$image_list = $match[2];
	} 
	if ($image_list) {
		if ($first) $image_list = $image_list[0];
	} else {
		$image_list = '';
	}
	return $image_list;
} 
// ��ȡ�󶨵�ͬ���ʺ�
function dzc_get_account() {
	$sync_binded = dzc_getUser('bind');
	return $sync_binded['userdata'] ? unserialize($sync_binded['userdata']) : array();
} 
// ͬ�����ӵ�΢��
function dzc_newthread_sync($tid, $pid, $title, $content) {
	global $_G; 
	$account = dzc_get_account();
	if ($account && !empty($_POST['syncList'])) {
		$account = array_intersect_key($account, array_flip(explode(',', $_POST['syncList'])));
	} 
	if (!$account) return;
	$url = dzc_get_url(array('tid' => $tid), 'forum_viewthread');
	// ȡ����һ��ͼƬ
	$image_list = dzc_get_post_image($pid, $content);
	$title = iconv2utf8($title);
	$content = iconv2utf8($content); 
	// ����UBB�����
	$title = dzc_filter($title);
	$content = dzc_filter($content);
	if (isset($image_list[0])) {
		$value[0] = $image_list[0];
		$content = str_replace($image_list, '', $content); // ��������ͼƬ
	} 
	// ����󸽴���url��ɾ����
	// $content = preg_replace("|\s*http://[a-z0-9-\.\?\=&_@/%#]*\$|sim", "", $content);
	$mids = batch_post_weibo($account, $content, $value, $url, $title);
	if ($mids) {
		dzc_addMid($tid, $mids, array('time' => time()), 'thread');
	} 
} 
// ͬ�����ӻظ���΢��
function dzc_reply_sync($tid, $pid, $content) {
	global $_G; 
	$mid = dzc_getMid($tid, 'thread');
	$mid = $mid['tweets'];
	if ($mid) {
		$account = dzc_get_account();
		if (!$account) return;
		$account = array_intersect_key($account, $mid);
		if ($account) {
			// $url = dzc_get_post_url($tid);
			$content = iconv2utf8($content); 
			// ������������
			$content = trim(preg_replace("|\[quote\].*?\[/quote\]|s", '', $content)); 
			// ���˻ظ���ʾ
			$content = trim(preg_replace("|\[b\]�ظ� \[url=.*? ������\[/url\]\[/b\]|s", '', $content)); 
			// ����󸽴���url��ɾ����
			$content = preg_replace("|\s*http://[a-z0-9-\.\?\=&_@/%#]*\$|sim", "", $content);
			return batch_comment_weibo($account, $mid, $content, $url);
		} 
	} 
} 
// ͬ����԰-��־��΢��
function dzc_blog_sync($tid, $title, $content) {
	global $_G;
	$account = dzc_get_account();
	if ($account && !empty($_POST['syncList'])) {
		$account = array_intersect_key($account, array_flip(explode(',', $_POST['syncList'])));
	} 
	if (!$account) return;
	$title = iconv2utf8($title);
	$content = wp_replace(iconv2utf8($content));
	$url = dzc_get_url(array('uid' => $_G['uid'], 'tid' => $tid), 'home_blog');
	$mids = batch_post_weibo($account, $content, $value, $url, $title);
	if ($mids) {
		dzc_addMid($tid, $mids, array('time' => time()), 'blog');
	} 
} 

// ͬ����԰-��¼��΢��
function dzc_doing_sync($tid, $content) {
	global $_G;
	$account = dzc_get_account();
	if ($account && !empty($_POST['syncList'])) {
		$account = array_intersect_key($account, array_flip(explode(',', $_POST['syncList'])));
	} 
	if (!$account) return;
	$content = iconv2utf8($content);
	$content = preg_replace('|<img src=\\\\"static/image/smiley/.*?>|', '', $content); //����UBB�뼰����
	$mids = batch_post_weibo($account, $content, $value, $url, $title);
	if ($mids) {
		dzc_addMid($tid, $mids, array('time' => time()), 'doing');
	} 
} 
// ͬ����԰-�ظ���¼��΢��
function dzc_doingcomment_sync($tid, $content) {
	global $_G; 
	$mid = dzc_getMid($tid, 'doing');
	$mid = $mid['tweets'];
	if ($mid) {
		$account = dzc_get_account();
		if (!$account) return;
		$account = array_intersect_key($account, $mid);
		if ($account) {
			$content = iconv2utf8($content);
			$content = preg_replace('|<img src=\\\\"static/image/smiley/.*?>|', '', $content); //����UBB�뼰����
			return batch_comment_weibo($account, $mid, $content, $url);
		} 
	} 
} 
// ͬ����԰-����΢��
function dzc_share_sync($tid, $content) {
	global $_G;
	$account = dzc_get_account();
	if ($account && !empty($_POST['syncList'])) {
		$account = array_intersect_key($account, array_flip(explode(',', $_POST['syncList'])));
	} 
	if (!$account) return;
	$content = iconv2utf8($content);
	$content = preg_replace('|<img src=\\\\"static/image/smiley/.*?>|', '', $content); //����UBB�뼰����
	$mids = batch_post_weibo($account, $content, $value, $url, $title);
	if ($mids) {
		dzc_addMid($tid, $mids, array('time' => time()), 'share');
	} 
} 