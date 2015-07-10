<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

//设置允许用户上传的文件类型。
$type = array('jpg', 'png', 'gif', 'bmp');
//实例化上传类，第一个参数为用户上传的文件组、第二个参数为存储路径、
//第三个参数为文件最大大小。如果不填则默认为2M
//第四个参数为充许用户上传的类型数组。如果不填则默认为 jpg, png, zip, rar

$filetime = time(); //得到时间戳

$filepath = "data/wenda/".date("Ym",$filetime)."/".date("d",$filetime);//相片保存的路径目录
$targetPath = $filepath;
if(!is_dir($targetPath)){
	mkdir("data/wenda/",0777);//如果目录不存在，则创建目录，注意：要有相应的目录权限。
	mkdir("data/wenda/" . date("Ym",$filetime)."/",0777); 
	mkdir("data/wenda/" . date("Ym",$filetime)."/".date("d",$filetime)."/",0777);
	$patch = "data/wenda/" . date("Ym",$filetime)."/".date("d",$filetime)."/";
	$fpindex = @fopen($patch . "index.htm", "w+");
	@fwrite($fpindex, " ");
	fclose($fpindex); //建立空白index.htm文件
}  


$upload = new UploadFile($_FILES['user_upload_file'], $targetPath, 5000000, $type);
//上传用户文件，返回int值，为上传成功的文件个数。
$num = $upload->upload();
global $_G,$pid;
$config = $_G['cache']['plugin']['evinm_wenda'];
$config['point'] = "extcredits".$config['points'];
$config['points_name'] = $_G['setting']['extcredits'][$config['points']]['title']; //积分名称
$config['points_unit'] = $_G['setting']['extcredits'][$config['points']]['uint']; //积分单位
$config['points_user'] = getuserprofile($config['point']); //取得现有积分

if($_GET['amod'] == 'edit') {
}else{
	if(empty($_GET['class'])) {
		showmessage('请选择问题分类！');
	}
}
if(empty($_GET['subject'])) {
	showmessage('请填写问题标题！');
}
if(empty($_GET['message'])) {
	showmessage('请填写问题描述！');
}
if($_GET['coin'] > $config['points_user']) {
	showmessage('您的积分不够，请重新选择！');
}

if($num != 0) {

	// "上传成功<br>";
	$tpl_upload_info=$upload->getSaveInfo();
	//取得文件的有关信息，文件名、类型、大小、路径。用print_r()打印出来。
	//print_r($tpl_upload_info);
	//格式为： Array
	//   (
	//    [0] => Array(
	//        [name] => example.txt
	//        [type] => txt
	//        [size] => 526
	//        [path] => j:/tmp/example-1108898806.txt
	//        )
	//   )

	/*******
	//获得文件保存路径或者其他的信息
	for ($tpl_upload_success_num = 0; $tpl_upload_success_num < $num; $tpl_upload_success_num++) {
	echo($tpl_upload_info[$tpl_upload_success_num]['path']).'<br>';
	$tpl_upload_success_url = "\r\n".'[img]'.$tpl_upload_info[$tpl_upload_success_num]['path'].'[/img]';
	$tpl_upload_success_img .= $tpl_upload_success_url; //获得[img]代码
	}
	//$num."个文件上传成功";
	*/
	require_once libfile('function/discuzcode');
	
	//去掉了编辑功能	
/* 	if($_GET['amod'] == 'edit') {
		$ask_data = array(
			'subject'=>addslashes($_GET['subject']),
			'message'=>addslashes(discuzcode($_GET['message'])),
			'coin'=>addslashes($_GET['coin']),
			'over'=>0,
			'pic'=>$tpl_upload_info[0][path],
		);	
	}else{ */
		$fid = DB::result_first("select fid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".addslashes($_GET['class']));
		$fid = DB::result_first("select id from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($fid)); 
		
		$ask_data = array(
			'fenlei'=>addslashes($_GET['class']),
			'subject'=>addslashes($_GET['subject']),
			'message'=>addslashes(discuzcode($_GET['message'])),
			'pic'=>$tpl_upload_info[0][path],
			'coin'=>addslashes($_GET['coin']),
			'uid'=>$_G['uid'],
			'over'=>0,
			'fenlei_sup'=>addslashes($fid),
			'posttime'=>$filetime,
		);	
/* 	}	 */

}else{
	
	require_once libfile('function/discuzcode');	
//去掉了编辑功能	
/* 	if($_GET['amod'] == 'edit') { 
		$ask_data = array(
			'subject'=>addslashes($_GET['subject']),
			'message'=>addslashes(discuzcode($_GET['message'])),
			'coin'=>addslashes($_GET['coin']),
			'over'=>0,
		);	
	}else{ */
		$fid = DB::result_first("select fid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".addslashes($_GET['class']));
		$fid = DB::result_first("select id from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($fid)); 
		
		$ask_data = array(
			'fenlei'=>addslashes($_GET['class']),
			'subject'=>addslashes($_GET['subject']),
			'message'=>addslashes(discuzcode($_GET['message'])),
			'pic'=>'',
			'coin'=>addslashes($_GET['coin']),
			'uid'=>$_G['uid'],
			'over'=>0,
			'fenlei_sup'=>addslashes($fid),
			'posttime'=>$filetime,
		);	
	/* }	 */
}

//去掉了编辑功能	
/* 	if($_GET['amod'] == 'edit') {
		DB::update('evinm_wenda_ask',$ask_data,"`id` = ".intval($_GET['qid']));
		$o_coin = DB::result_first("select coin from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($_GET['qid'])); 
		$c_coin = $ask_data[coin] - $o_coin;
		if($c_coin > 0) {
			updatemembercount(intval($_G['uid']),array('extcredits'.$config['points'] => '-'.$c_coin));
		}
	}else{ */
		$wtid = DB::insert('evinm_wenda_ask',$ask_data,true);
		
		$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
		$config = $_G['cache']['plugin']['evinm_wenda'];
		$config['rule'] = explode('|',$config['rule']);
		$config['rule_jifen'] = explode('|',$config['rule_jifen']);
		
		if(!empty($exp)){
			$exp = $exp + $config['rule']['0'];
			DB::update('evinm_wenda_user',array('exp'=>$exp));
		}else{
			DB::insert('evinm_wenda_user',array('uid'=>intval($_G['uid']),'exp'=>$config['rule']['0']));
		}
		
		$num_ask_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 	
		$num_ask = DB::fetch($num_ask_sql);
		$num_ask = $num_ask[num_ask];
		
		if(DB::num_rows($num_ask_sql) != 0){	
			$num_ask = $num_ask + 1;
			DB::update('evinm_wenda_user',array('num_ask'=>$num_ask),"`uid` = ".intval($_G['uid']));
		}else{
			DB::insert('evinm_wenda_user',array('uid'=>intval($_G['uid']),'num_ask'=>1));
		}
		updatemembercount(intval($_G['uid']),array('extcredits'.$config['points'] => '-'.$ask_data['coin']));		
		updatemembercount(intval($_G['uid']),array('extcredits'.$config['czjl'] => '+'.$config['rule_jifen'][0]));
		
		//同步贴子
		if($config['wtttz'] && $wtid){
			DB::query("INSERT INTO ".DB::table('forum_thread')." (fid, posttableid, readperm, price, typeid, sortid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, highlight,  isgroup) VALUES ('".intval($config['tbfid'])."', '0', '0', '0', '', '0', '".$_G['username']."', '".$_G['uid']."', '".$ask_data['subject']."', '".$_G[timestamp]."', '".$_G[timestamp]."', '".$_G['username']."', '0', '0', '0', '0', '1', '1','0')");
			$tid = DB::insert_id();
			DB::update('evinm_wenda_ask',array('tid'=>intval($tid)),"`id`=".$wtid);
			
		    require_once libfile('function/forum');
			
/* 			$pid = insertpost(array(
				'fid' => 2,
				'tid' => $tid,
				'first' => 1,
				'author' => $_G['username'],
				'authorid' => $_G['uid'],
				'subject' => $ask_data['subject'],
				'dateline' => $_G['timestamp'],
				'message' => $ask_data['message'],
				'useip' => $_G['clientip'],
				'invisible' => 0,
				'anonymous' => 0,
				'usesig' => 0,
				'htmlon' => 0,
				'bbcodeoff' => 0,
				'smileyoff' => 0,
				'parseurloff' => 0,
				'attachment' => 0,				
				'replycredit' => 0,
				'status' => (defined('IN_MOBILE') ? 8 : 0)
			)); */
			
			$pid = insertpost(array('fid' => intval($config['tbfid']),'tid' => $tid,'first' => '1','author' => $_G['username'],'authorid' => $_G['uid'],'subject' => $ask_data['subject'],'dateline' => $_G['timestamp'],'message' => $ask_data['message'],'useip' => $_G['clientip'],'invisible' => '0','anonymous' => '0','usesig' => '0','htmlon' => '0','bbcodeoff' => '0','smileyoff' => '0','parseurloff' => '0','attachment' => '0',));		

		}
		
	/* } */
	/* 更新积分 */

	showmessage('您的问题已提交成功，很快就会收到解答的哦~', 'plugin.php?id=evinm_wenda:my&ac=myq', array(), array('showdialog' => true, 'locationtime' => true));
?>