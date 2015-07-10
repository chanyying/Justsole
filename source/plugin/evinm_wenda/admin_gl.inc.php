<?php 
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
//include_once DISCUZ_ROOT.'./source/plugin/evinm_wenda/model/index.inc.php';
//删除提问
function deletewenti($qid){
	$qid = intval($qid);
	if($qid) {
		DB::delete('evinm_wenda_ask',"`id` = $qid");
		DB::delete('evinm_wenda_answer',"`qid` = $qid");
	}
}

function qid2uid($qid){
	$qid = intval($qid);
	if($qid) {
		$uid = DB::result_first("select uid from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($qid)); 
	}	
	return $uid; 
}

cpheader();
$acurl="admin.php?action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl";

$sevendays = $_G['timestamp'] - 60*60*24*7;

//初始化当前页码
$page = empty($_GET['page'])?1:addslashes($_GET['page']);
if($page<1) $page=1;
//分页
$perpage = 20;
if($_GET['ec'] == 'search') {
	$perpage = addslashes($_GET['perpage']);
}
$start = ($page-1)*$perpage;
$mpurl = $acurl.addslashes($_GET['ec']); 

//----------------------------------------------------------------------------------------

//问题
if($_GET['ec'] == 'wenti' || empty($_GET['ec']) || $_GET['ec'] == 'shenhe_wt')  {
	if($_GET['ec'] == 'wenti' || empty($_GET['ec'])) {
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where (`posttime` > ".$sevendays." ) ORDER BY `posttime` DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where (`posttime` > ".$sevendays." ) ORDER BY `posttime` DESC "));
	}else{
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask')." where (`shenhe` = 1 ) ORDER BY `posttime` DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask')." where (`shenhe` = 1) ORDER BY `posttime` DESC "));
	}
	
	
	if($_GET['sumbit_wenti']) {
		if(!empty($_GET['fenlei'])) {
			$fenlei_sup = DB::result_first("select fid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($_GET['fenlei']));
		}
		
		foreach ($_GET['wid'] as $id) { 
			if($_GET['delete'] == "delete") {				
				//DB::delete('evinm_wenda_ask',"id =".intval($id));
				deletewenti($id);
			}
			if($_GET['movefl'] == "movefl" && !empty($_GET['fenlei'])) {			
				DB::update('evinm_wenda_ask',array('fenlei'=>intval($_GET['fenlei']),'fenlei_sup'=>$fenlei_sup),"id =".intval($id));
			}		
		}
		cpmsg('操作成功！',"action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl&ec=".$_GET['ec'], 'succeed');
	}
	
	if($_GET['sumbit_shenhe_wt']) {
		if(!empty($_GET['fenlei'])) {
			$fenlei_sup = DB::result_first("select fid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($_GET['fenlei']));
		}
		
		foreach ($_GET['wid'] as $id) { 
			if($_GET['delete'] == "delete") {
				DB::delete('evinm_wenda_ask',"id =".intval($id));
			}
			if($_GET['movefl'] == "movefl" && !empty($_GET['fenlei'])) {			
				DB::update('evinm_wenda_ask',array('fenlei'=>intval($_GET['fenlei']),'fenlei_sup'=>$fenlei_sup),"id =".intval($id));
			}
			if($_GET['shenhe'] == "shenhe" && $_GET['shtg'] == 1) {
				DB::update('evinm_wenda_ask',array('shenhe'=>'0'),"id =".intval($id));
				
				//相管操作
				$wuid = DB::result_first("select uid from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($id)); 
				$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($wuid)); 
				$config = $_G['cache']['plugin']['evinm_wenda'];
				$config['rule'] = explode('|',$config['rule']);
				$config['rule_jifen'] = explode('|',$config['rule_jifen']);
				
				if(!empty($exp)){
					$exp = $exp + $config['rule']['0'];
					DB::update('evinm_wenda_user',array('exp'=>$exp));
				}else{
					DB::insert('evinm_wenda_user',array('uid'=>intval($wuid),'exp'=>$config['rule']['0']));
				}
				
				$num_ask_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($wuid)); 	
				$num_ask = DB::fetch($num_ask_sql);
				$num_ask = $num_ask[num_ask];
				
				if(DB::num_rows($num_ask_sql) != 0){	
					$num_ask = $num_ask + 1;
					DB::update('evinm_wenda_user',array('num_ask'=>$num_ask),"`uid` = ".intval($wuid));
				}else{
					DB::insert('evinm_wenda_user',array('uid'=>intval($wuid),'num_ask'=>1));
				}
				updatemembercount(intval($wuid),array('extcredits'.$config['points'] => '-'.$ask_data['coin']));		
				updatemembercount(intval($wuid),array('extcredits'.$config['czjl'] => '+'.$config['rule_jifen'][0]));
				
			}
			

		}
		cpmsg('操作成功！',"action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl&ec=".$_GET['ec'], 'succeed');
	}

	//问题数组化
	$list_wenti = array();
	while($wt_rows = DB::fetch($q_sql)) {
		$wenti['id'] = $wt_rows['id'];
		$wenti['uid'] = $wt_rows['uid'];
		$wenti['username'] = uid2name($wt_rows['uid']);
		$wenti['fenlei'] = $wt_rows['fenlei'];
		$wenti['fenlei_name'] = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($wt_rows['fenlei']));
		$wenti['subject'] = $wt_rows['subject'];
		$wenti['message'] = $wt_rows['message'];
		$wenti['pic'] = $wt_rows['pic'];
		$wenti['coin'] = $wt_rows['coin'];
		$wenti['over'] = $wt_rows['over'];
		$wenti['posttime'] = date("Y-m-d H:i:s",$wt_rows['posttime']);
		$wenti['nums_a'] = $wt_rows['nums_a'];

		$list_wenti[] = $wenti;
	}
	
}

//----------------------------------------------------------------------------------------

//回答
if($_GET['ec'] == 'huida' || $_GET['ec'] == 'shenhe_hd') {
	if($_GET['ec'] == 'huida') {	
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_answer')." where (`iszw` = 0 and `posttime` > ".$sevendays." ) ORDER BY `posttime` DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_answer')." where (`iszw` = 0 and `posttime` > ".$sevendays." ) ORDER BY `posttime` DESC "));
	}else{
		$q_sql = DB::query("select * from ".DB::table('evinm_wenda_answer')." where (`shenhe` = 1 ) ORDER BY `posttime` DESC limit ".$start.",".$perpage);
		$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_answer')." where (`shenhe` = 1 ) ORDER BY `posttime` DESC "));
	}

	//回答数组化
	$list_huida = array();
	while($hd_rows = DB::fetch($q_sql)) {
		$huida['id'] = $hd_rows['id'];
		$huida['qid'] = $hd_rows['qid'];
		$huida['wtsubject'] = DB::result_first("select subject from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($hd_rows['qid']));
		$huida['uid'] = $hd_rows['uid'];
		$huida['username'] = uid2name($hd_rows['uid']);
		$huida['message'] = $hd_rows['message'];
		$huida['best'] = $hd_rows['best'];
		$huida['posttime'] = date("Y-m-d H:i:s",$hd_rows['posttime']);
		$list_huida[] = $huida;
	}
	
	if($_GET['sumbit_huida']) {
		
		foreach ($_GET['hdid'] as $id) { 
			if($_GET['delete'] == "delete") {
				DB::delete('evinm_wenda_answer',"id =".intval($id));
			}	
		}
		cpmsg('操作成功！',"action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl&ec=".$_GET['ec'], 'succeed');
	}

	if($_GET['sumbit_shenhe_hd']) {
		
		foreach ($_GET['hdid'] as $id) { 
			if($_GET['delete'] == "delete") {
				DB::delete('evinm_wenda_answer',"id =".intval($id));
			}	
			if($_GET['shenhe'] == "shenhe" && $_GET['shtg'] == 1) {
				DB::update('evinm_wenda_answer',array('shenhe'=>'0'),"id =".intval($id));
				
				$huid = DB::result_first("select uid from ".DB::table('evinm_wenda_answer')." where `id` = ".intval($id)); 
				$exp = DB::result_first("select exp from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($huid)); 
				$config = $_G['cache']['plugin']['evinm_wenda'];
				$config['rule'] = explode('|',$config['rule']);	
				$config['rule_jifen'] = explode('|',$config['rule_jifen']);
				
				if(!empty($exp)){
					$exp = $exp + $config['rule']['1'];
					DB::update('evinm_wenda_user',array('exp'=>$exp),"`uid` = ".intval($huid));
				}else{
					DB::insert('evinm_wenda_user',array('uid'=>intval($huid),'exp'=>$config['rule']['1']));
				}
				
				$num_a_sql = DB::query("select * from ".DB::table('evinm_wenda_user')." where `uid` = ".intval($huid)); 	
				$num_a = DB::fetch($num_a_sql);
				$num_a = $num_a[num_a];
				
				if(DB::num_rows($num_a_sql) != 0){	
					$num_a = $num_a + 1;
					DB::update('evinm_wenda_user',array('num_a'=>$num_a),"`uid` = ".intval($huid));
				}else{
					DB::insert('evinm_wenda_user',array('uid'=>intval($huid),'num_a'=>1));
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
					$quid = DB::result_first("select uid from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($huid));
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
			}

		}
		cpmsg('操作成功！',"action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl&ec=".$_GET['ec'], 'succeed');
	}
	
}

//----------------------------------------------------------------------------------------

//搜索

if($_GET['ec'] == 'search') {
	echo <<<EOT
	<script src="static/js/calendar.js"></script>
	<script type="text/JavaScript">
		function page(number) {
			$('threadforum').page.value=number;
			$('threadforum').searchsubmit.click();
		}
	</script>
EOT;
	

	if($_GET['submit_searchsubmit']) {

		
		 //`posttime` > ".intval(strtotime($_GET['starttime']))." and `posttime` < ".intval(strtotime($_GET['endtime']))." and 
		if($_GET['detail'] == '1') {
			$searcht = 1;
			if(addslashes($_GET['fenlei']) == "all") {
				
			}else{		
				$fenlei = " `fenlei` = ".addslashes($_GET['fenlei']);
				$and = " and ";
			}
			
			if(!empty($_GET['users'])) {			
				$suid = $and." `uid` = ".addslashes($_GET['users']);
				$and = " and ";
			}
			
			if(!empty($_GET['repliesmore'])) {
				$nums_a = $and." `nums_a` > ".intval($_GET['repliesmore']);
			}else if(!empty($_GET['repliesless']) && !empty($_GET['repliesmore'])){
				$nums_a = $and." `nums_a` > ".intval($_GET['repliesmore'])." and `nums_a` < " .intval($_GET['repliesless']);
			}
			
			if(empty($fenlei) && empty($suid) && empty($nums_a)) {			
			}else{
				$where = " where (".$fenlei.$suid.$nums_a.")";
			}
					
			$q_sql = DB::query("select * from ".DB::table('evinm_wenda_ask').$where." ORDER BY `posttime` DESC limit ".$start.",".$perpage);
			
			$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_ask').$where." ORDER BY `posttime` DESC limit ".$start.",".$perpage));
		
		}else{
			if(!empty($_GET['users'])) {			
				$suid = " `uid` = ".addslashes($_GET['users']);
				$and = " and ";
			}
			
			if(!empty($_GET['repliesmore'])) {
				$nums_a = $and." `nums_a` > ".intval($_GET['repliesmore']);
			}else if(!empty($_GET['repliesless']) && !empty($_GET['repliesmore'])){
				$nums_a = $and." `nums_a` > ".intval($_GET['repliesmore'])." and `nums_a` < " .intval($_GET['repliesless']);
			}
			
			if(empty($suid) && empty($nums_a)) {			
			}else{
				$where = " where (".$suid.$nums_a.")";
			}
			
			$q_sql = DB::query("select * from ".DB::table('evinm_wenda_answer').$where." ORDER BY `posttime` DESC limit ".$start.",".$perpage);
			
			$q_nums = DB::num_rows(DB::query("select * from ".DB::table('evinm_wenda_answer').$where." ORDER BY `posttime` DESC limit ".$start.",".$perpage));
		}
		
	}
	
	if($_GET['sumbit_wenti']) {
		$searcht = "1";
		if(!empty($_GET['fenlei'])) {
			$fenlei_sup = DB::result_first("select fid from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($_GET['fenlei']));
		}
		
		foreach ($_GET['wid'] as $id) { 
			if($_GET['delete'] == "delete") {
				DB::delete('evinm_wenda_ask',"id =".intval($id));
			}
			if($_GET['movefl'] == "movefl" && !empty($_GET['fenlei'])) {			
				DB::update('evinm_wenda_ask',array('fenlei'=>intval($_GET['fenlei']),'fenlei_sup'=>$fenlei_sup),"id =".intval($id));
			}		
		}
		cpmsg('操作成功！',"action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl&ec=".$_GET['ec'], 'succeed');
	}
	
	if($_GET['sumbit_huida']) {
		
		foreach ($_GET['wid'] as $id) { 
			if($_GET['delete'] == "delete") {
				DB::delete('evinm_wenda_answer',"id =".intval($id));
			}	
		}
		cpmsg('操作成功！',"action=plugins&operation=config&do=$_GET[do]&identifier=$_GET[identifier]&pmod=admin_gl&ec=".$_GET['ec'], 'succeed');
	}
	
	//搜索结果数组化
	$list_wenti = array();
	while($wt_rows = DB::fetch($q_sql)) {
		if($searcht == 1) {
			$wenti['id'] = $wt_rows['id'];
			$wenti['uid'] = $wt_rows['uid'];
			$wenti['username'] = uid2name($wt_rows['uid']);
			$wenti['fenlei'] = $wt_rows['fenlei'];
			$wenti['fenlei_name'] = DB::result_first("select name from ".DB::table('evinm_wenda_fenlei')." where `id` = ".intval($wt_rows['fenlei']));
			$wenti['subject'] = $wt_rows['subject'];
			$wenti['message'] = $wt_rows['message'];
			$wenti['pic'] = $wt_rows['pic'];
			$wenti['coin'] = $wt_rows['coin'];
			$wenti['over'] = $wt_rows['over'];
			$wenti['posttime'] = date("Y-m-d H:i:s",$wt_rows['posttime']);
			$wenti['nums_a'] = $wt_rows['nums_a'];
		}else{
			$wenti['hdid'] = $wt_rows['id'];
			$wenti['id'] = $wt_rows['qid'];
			$wenti['subject'] = DB::result_first("select subject from ".DB::table('evinm_wenda_ask')." where `id` = ".intval($wt_rows['qid']));
			$wenti['uid'] = $wt_rows['uid'];
			$wenti['username'] = uid2name($wt_rows['uid']);
			$wenti['message'] = $wt_rows['message'];
			$wenti['best'] = $wt_rows['best'];
			$wenti['posttime'] = date("Y-m-d H:i:s",$wt_rows['posttime']);
		}
		
		$list_wenti[] = $wenti;
	}
}

//----------------------------------------------------------------------------------------

//查询分类
$f_class_sql = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' ORDER BY  `paixu` ASC');
$list = array();
while($f_rows = DB::fetch($f_class_sql)) {
	$mood['type'] = $f_rows['type'];
	$mood['id'] = $f_rows['id'];
	$mood['fid'] = $f_rows['fid'];
	$mood['name'] = $f_rows['name'];
	$mood['paixu'] = $f_rows['paixu'];
	$mood['vipuid'] = $f_rows['vipuid'];
	$list[] = $mood;
}

$f_class_sql2 = DB::query('select * from '.DB::table('evinm_wenda_fenlei').' ORDER BY  `paixu` ASC');
$list2 = array();
while($f_rows2 = DB::fetch($f_class_sql2)) {
	$mood2['type'] = $f_rows2['type'];
	$mood2['id'] = $f_rows2['id'];
	$mood2['fid'] = $f_rows2['fid'];
	$mood2['name'] = $f_rows2['name'];
	$mood2['paixu'] = $f_rows2['paixu'];
	$mood2['vipuid'] = $f_rows2['vipuid'];
	$list2[] = $mood2;
}


//添加分类
if ($_GET['class_submit']) {
	$fname = explode("|",addslashes($_GET['fname']));
	if(is_array($fname)) {
		$i = 0;
		if($_GET['fid'] == '0') {
			for($i;$i<count($fname);$i++) {
				DB::insert('evinm_wenda_fenlei',array('fid'=>'0','name'=>$fname[$i],'type'=>'group'));				
			}
			echo ' <script type="text/javascript"> windowl.location.href=window.location.href; </script> ';
			cpmsg('操作成功！');
		}else{
			for($i;$i<count($fname);$i++) {
				DB::insert('evinm_wenda_fenlei',array('fid'=>addslashes($_GET['fid']),'name'=>$fname[$i],'type'=>'sup'));				
			}
			echo ' <script type="text/javascript"> windowl.location.href=window.location.href; </script> ';
			cpmsg('操作成功！');
		}
	}
}

// 删除分类
if($_GET['editsubmit']) {
	foreach ($_GET['delete'] as $id) { 
		DB::delete('evinm_wenda_fenlei',"fid = $id");
		DB::delete('evinm_wenda_fenlei',"id = $id");		
	}  
	
	foreach($_GET['id'] as $key=>$value){
		DB::update('evinm_wenda_fenlei',array(
		'name'=>addslashes($_GET['name'][$key]),
		'paixu'=>addslashes($_GET['paixu'][$key]),
		'vipuid'=>addslashes($_GET['vipuid'][$key])),"`id` = $value");		
	}
	echo ' <script type="text/javascript"> windowl.location.href=window.location.href; </script> ';
	cpmsg('操作成功！');
}


//获得一个分页
$multi = multi($q_nums, $perpage, $page, $mpurl,0, 20,FALSE,FALSE);


function uid2name($uid){ 
	if(!$uid){ 
	}else{ 
		$username = DB::result_first("select username from ".DB::table('common_member')." where `uid` = ".intval($uid)); 
		$username = $username ?$username : ''; 
	} 
	return $username; 
}

include template('evinm_wenda:admincp_gl');

?>