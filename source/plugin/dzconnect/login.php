<?php
include_once dirname(__FILE__) . '/load.php';
session_start();
$bind = isset($_GET['go']) ? strtolower($_GET['go']) : '';
$action = isset($_GET['sso']) ? $_GET['sso'] : '';
if ($bind) {
	del_c_session('tabs');
	set_c_session('referer', $_SERVER['HTTP_REFERER']);
	if (is_user_logged_in()) {
		if ($_GET['act'] == 'delete') {
			if ($action == "bind") { // 绑定
				$get_account = dzc_get_account();
				if (isset($get_account[$bind])) unset($get_account[$bind]);
				dzc_updateUser('bind', '', $get_account);
			} elseif ($action == "login") { // 登录
				dzc_delUser($bind);
			} 
			header('Location:' . get_c_session('referer'));
			die();
		} elseif ($action == "bind") {
			set_c_session('tabs', $action);
		} 
	} else {
		dsetcookie('last_login_media', $bind, 2592000);
	} 
	$backurl = DZC_LOGIN;
} 

if (isset($_GET['go'])) {
	if ($bind == 'sina') {
		$_SESSION['oauth_state'] = uniqid(rand(), true);
		$aurl = "http://smyxapp.sinaapp.com/oauth.php?client_id=351762339&redirect_uri=" . urlencode($backurl) . "&response_type=code&state=sina" . md5($_SESSION['oauth_state']);
		header('Location:' . $aurl);
		die();
	} elseif ($bind == 'qq') {
		require_once dirname(__FILE__) . '/class/oauth2.php';
		$a = new qqOAuthV1('d05d3c9c3d3748b09f231ef6d991d3ac', 'e049e5a4c656a76206e55c91b96805e8');
		$keys = $a->get_RequestToken($backurl);
		$aurl = $a->get_AuthorizeURL($keys['oauth_token'], false, $backurl);
		set_c_session('tmp_keys', $keys);
		header('Location:' . $aurl);
		die();
	} 
} elseif (isset($_GET['oauth_token'])) { // OAuth 1.0
	$media = 'qq';
	$apikey = array('d05d3c9c3d3748b09f231ef6d991d3ac', 'e049e5a4c656a76206e55c91b96805e8');
	require_once dirname(__FILE__) . '/class/oauth2.php';
	$keys = get_c_session('tmp_keys');
	if (!$keys['oauth_token']) {
		return array('error' => '返回失败，session已过期！', 'media' => $media, 'other' => $_SESSION);
	}
	$o = new qqOAuthV1($apikey[0], $apikey[1], $keys['oauth_token'], $keys['oauth_token_secret']);
	$token = $o->get_AccessToken($_REQUEST['oauth_verifier']);
	if (!$token['oauth_token']) {
		if (is_array($token)) {
			return var_dump($token);
		} else {
			return array('error' => '获取token时失败！', 'media' => $media, 'other' => $token);
		} 
	} 
	$oauth_token = array('oauth_token' => $token['oauth_token'], 'oauth_token_secret' => $token['oauth_token_secret'], 'media' => $media);
	del_c_session('tmp_keys');
	$o = new qqOAuthV1($apikey[0], $apikey[1], $token['oauth_token'], $token['oauth_token_secret']);
	$token = $o->verify_credentials();
	$token = $token['data'];
	$openid = $token['name']; 
	// return var_dump($token);
	if ($openid) {
		$oauth_token['uid'] = $openid;
		$oauth_token['name'] = $token['nick'];
		$oauth_token['avatar'] = $token['head'] . '/100';
		$oauth_token['url'] = 'http://t.qq.com/' . $openid;
	} 
} elseif (isset($_GET['code'])) { // OAuth 2.0
	$media = 'sina';
	parse_str($_SERVER['QUERY_STRING']);
	if (substr($state, -32) != md5($_SESSION['oauth_state'])) {
		return array('error' => '返回失败，session已过期！', 'media' => $media, 'other' => $_SESSION);
	}
	$apikey = array('351762339', 'dac1c15f89eaad49f5d96fc09ddb672f');
	require_once dirname(__FILE__) . '/class/oauth2.php';
	$o = new classOAuthV2($apikey[0], $apikey[1]);
	$keys['code'] = $_GET['code'];
	$keys['access_token_url'] = 'https://api.weibo.com/oauth2/access_token';
	$keys['redirect_uri'] = "http://smyxapp.sinaapp.com/authorize.php";
	$token = $o->getAccessToken($keys);
	if (!$token['access_token']) {
		if (is_array($token)) {
			return var_dump($token);
		} else {
			return array('error' => '获取token时失败！', 'media' => $media, 'other' => $token);
		} 
	} 
	$o = new sinaweiboAPP($apikey[0], $apikey[1], $token['access_token']);
	$show_user = $o->show_user($token['uid']);
	$user = array('uid' => $show_user['idstr'], 'username' => $show_user['domain'], 'name' => $show_user['screen_name'], 'avatar' => $show_user['avatar_large'], 'url' => 'http://weibo.com/' . $show_user['idstr']);
	if ($user['uid']) {
		$oauth_token = array('access_token' => $token['access_token'], 'expires_in' => time() + $token['expires_in'], 'media' => $media);
		$oauth_token = array_merge($user, $oauth_token);
	} else {
		$token = $show_user;
	} 
} elseif (!is_user_logged_in() && $action == 'register' && ($user = get_c_session('user'))) { // 注册
	$cw_username = !empty($_POST['cw_username']) ? addslashes(trim($_POST['cw_username'])) : $user['name'];
	$cw_email = !empty($_POST['cw_email']) ? addslashes(trim($_POST['cw_email'])) : $user['email'];
	$uid = 0;
	$media = $user['media'];
	// $weibo_name = weibo_name($user['media']);
	$weibo_name = $_DZC_LANG[$media];
	$login_url = DZC_SSO . 'login&go='. $media;
	if (isset($_POST['regsubmit'])) {
		$cw_password = addslashes(trim($_POST['cw_password']));
		if (empty($cw_email)) {$uid = -101;}
		if (empty($cw_password)) {$uid = -103;}
		if (empty($cw_username)) {$uid = -102;}
		if (empty($uid)) {
			$uid = dzc_user_login($user, $cw_username, $cw_password, $cw_email);
		} 
		if ($uid <= 0) {
			$error_tip = _dzc_tips($uid);
		} 
	} elseif (isset($_POST['loginsubmit'])) {
		$loginfield = !empty($_POST['loginfield']) ? trim($_POST['loginfield']) : '';
		$username = !empty($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
		$password = !empty($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
		$questionid = !empty($_POST['questionid']) ? trim($_POST['questionid']) : '';
		$answer = !empty($_POST['answer']) ? trim($_POST['answer']) : '';
		if (empty($password)) {$uid = -103;}
		if (empty($username)) {$uid = -102;}
		if (empty($uid)) {
			$uid = dzc_user_bind($user, $username, $password, $questionid, $answer, $loginfield);
			//return var_dump($uid);
		} 
		if ($uid <= 0) {
			$error_tip = _dzc_tips($uid, 1);
		} 
	} 
	if (!$uid || $error_tip) {
		include template('dzconnect:register');
		die();
	} else {
		$referer = get_c_session('referer');
		if (!$referer) $referer = OS_DZ_URL;
		header('Location:' . $referer);
		die();
	}
} else {
	header('Location:' . OS_DZ_URL);
	die();
} 

if (!$oauth_token['uid']) {
	return var_dump(utf82iconv($token));
} else {
	$oauth_token = utf82iconv($oauth_token); // 编码转换
	if (is_user_logged_in() && get_c_session('tabs') == 'bind') {
		if (isset($oauth_token['media'])) unset($oauth_token['media']);
		if (isset($oauth_token['avatar'])) unset($oauth_token['avatar']);
		// if (isset($oauth_token['url'])) unset($oauth_token['url']);
		$get_account = dzc_get_account();
		$get_account[$media] = $oauth_token;
		dzc_updateUser('bind', '', $get_account);
		del_c_session('tabs');
	} else {
		dzc_user_login($oauth_token);
	} 
	del_c_session('media');
	$referer = get_c_session('referer');
	if (!$referer) $referer = OS_DZ_URL;
	// header('Location:' . $referer);
}

?>
<script type="text/javascript" reload="1">window.location.href ='<?php echo $referer;?>';</script>