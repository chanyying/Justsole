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

//判断审核 
$xshugps = unserialize($config['xshup']);
if(($config['openmdeltw'] == 1 && empty($_G['uid'])) || in_array($_G['groupid'],$xshugps)) {
	$nsh = 1;
}else{
	$nsh = 0;
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

	$ask_data = array(
		'qid'=>addslashes($_GET['qid']),		
		'message'=>addslashes(discuzcode($_GET['message'])),
		'pic'=>$tpl_upload_info[0][path],
		'uid'=>$_G['uid'],
		'shenhe'=>$nsh,
		'posttime'=>$filetime,
	);		

}else{
	
	require_once libfile('function/discuzcode');
	
	$ask_data = array(
		'qid'=>addslashes($_GET['qid']),		
		'message'=>addslashes(discuzcode($_GET['message'])),		
		'uid'=>$_G['uid'],
		'shenhe'=>$nsh,
		'posttime'=>$filetime,
	);				
}


	$hdid = DB::insert('evinm_wenda_answer',$ask_data,true);
	$hdid = DB::insert_id();
	$tid = DB::result_first("select tid from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($_GET['qid']));
	if($tid && $_G['uid'] && $hdid && $config['wtttz'] ==1){	
		
		require_once libfile('function/forum');			
		$pid = insertpost(array('fid' => intval($config['tbfid']),'tid' => $tid,'first' => '0','author' => $_G['username'],'authorid' => $_G['uid'],'subject' => $ask_data['subject'],'dateline' => $_G['timestamp'],'message' => $ask_data['message'],'useip' => $_G['clientip'],'invisible' => '0','anonymous' => '0','usesig' => '0','htmlon' => '1','bbcodeoff' => '0','smileyoff' => '0','parseurloff' => '0','attachment' => '0',));
		DB::update('evinm_wenda_answer',array('pid'=>intval($pid)),"`id`=".$hdid);

	}
	
	if($_G['uid']) {
		$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 
		
		$config['rule'] = explode('|',$config['rule']);	
		$config['rule_jifen'] = explode('|',$config['rule_jifen']);
		
		if(!empty($exp)){
			$exp = $exp + $config['rule']['1'];
			DB::update('evinm_wenda_user',array('exp'=>$exp),"`uid` = ".intval($_G['uid']));
		}else{
			DB::insert('evinm_wenda_user',array('uid'=>intval($_G['uid']),'exp'=>$config['rule']['1']));
		}
		
		$num_a_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($_G['uid'])); 	
		$num_a = DB::fetch($num_a_sql);
		$num_a = $num_a[num_a];
		
		if(DB::num_rows($num_a_sql) != 0){	
			$num_a = $num_a + 1;
			DB::update('evinm_wenda_user',array('num_a'=>$num_a),"`uid` = ".intval($_G['uid']));
		}else{
			DB::insert('evinm_wenda_user',array('uid'=>intval($_G['uid']),'num_a'=>1));
		}
		
		
		$num_a_ask_sql = DB::query("select nums_a from ".DB::table('evinm_wenda_ask')." where `id` = ".addslashes($_GET['qid'])); 	
		$num_a_ask = DB::fetch($num_a_ask_sql); 
		
		if(DB::num_rows($num_a_ask_sql) != 0){	
			$nums_a = $num_a_ask['nums_a'] + 1;
			DB::update('evinm_wenda_ask',array('nums_a'=>$nums_a),"`id` = ".addslashes($_GET['qid']));
		}else{
			DB::insert('evinm_wenda_ask',array('id'=>intval($_GET['qid']),'nums_a'=>1));
		}	
		
		//通知
		if($config[isopen_notic] == 1) {
			if ($rewrite == '1'){
				$not_cont = '您的问题有了新的回复！<a href="'.$server.'wenda/'.$_GET['qid'].'">点击查看</a>';
				notification_add($quid, 'post', $not_cont, $notevars = array(), $system = 0); 
			}else{
				$not_cont = '您的问题有了新的回复！<a href="'.$server.'plugin.php?id=evinm_wenda&#58;list_article&qid='.$_GET['qid'].'">点击查看</a>';
				notification_add($quid, 'post', $not_cont, $notevars = array(), $system = 0); 
			}
		}
		
		//第一次回答加分
		$yans = DB::result_first("select id from ".DB::table('evinm_wenda_answer')." where `uid` = ".intval($_G['uid'])." and `qid` = ".intval($_GET['qid']));
		if($yans){		
		}else{
			updatemembercount(intval($_G['uid']),array('extcredits'.$config['czjl'] => '+'.$config['rule_jifen'][1]));
		}
		
		if ($rewrite == '1'){
			showmessage('您的回答提交成功！非常感谢您为提问者解决问题！', 'wenda/'.$_GET['qid'], array(), array('showdialog' => true, 'locationtime' => true));
		}else{
			showmessage('您的回答提交成功！非常感谢您为提问者解决问题！', 'plugin.php?id=evinm_wenda:list_article&qid='.$_GET['qid'], array(), array('showdialog' => true, 'locationtime' => true));
		}
	}
	//同步贴子
	if($config['wtttz'] && $hdid && $_G['uid']){

	}
?>