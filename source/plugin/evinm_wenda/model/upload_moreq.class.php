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
		'posttime'=>$filetime,
	);		

}else{
	
	require_once libfile('function/discuzcode');
	
	$ask_data = array(
		'qid'=>addslashes($_GET['qid']),		
		'message'=>addslashes(discuzcode($_GET['message'])),		
		'uid'=>$_G['uid'],
		'posttime'=>$filetime,
	);				
}
	
	$addid = DB::result_first("select id from ".DB::table('evinm_wenda_ask_add')." where `qid` = ".intval($_GET['qid'])); 
	
	if(!empty($addid)){
		DB::update('evinm_wenda_ask_add',$ask_data,"`qid` = ".intval($_GET['qid']));
	}else{
		DB::insert('evinm_wenda_ask_add',$ask_data);
	}

	
	//updatemembercount(intval($_G['uid']),array('extcredits'.$config['czjl'] => '+'.$config['rule_jifen'][1]));
	/* 更新积分 */
	showmessage('操作成功！', 'plugin.php?id=evinm_wenda:list_article&qid='.$_GET['qid'], array(), array('showdialog' => true, 'locationtime' => true));
?>