<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_9');
block_get('1391,1087,1513,1481,1482,1491,1486,1489,1488,1487,1515,1484,1490,1396,1393,1468,1538');?><?php include template('common/header'); ?><link id="style_css" rel="stylesheet" type="text/css" href="static/topic/t1/style.css">
<style id="diy_style" type="text/css">body {  background-attachment:scroll !important;background-repeat:no-repeat !important;}#frameDZ5KUv {  margin-top:10px !important;border:#ffffff !important;}#ct .move-span .blocktitle {  background-position:center center !important;background-color:#cccccc !important;background-repeat:repeat-x !important;}#ct {  background-attachment:fixed !important;background-color:#339966 !important;background-position:center center !important;}#portal_block_1391 {  border-top:#ffffff !important;border-right:#cc9933 2px dotted !important;border-bottom:#ffffff !important;border-left:#ffffff !important;}#portal_block_1393 {  border-right-width:2px !important;border-right-color:#669933 !important;border-right-style:dotted !important;border-left-color:#ffffff !important;}#portal_block_1396 {  border-right-width:2px !important;border-right-color:#cc00ff !important;border-right-style:dotted !important;}#frameq3153J {  border-top:#ffffff !important;border-right:#ffffff !important;border-bottom:#ffffff dashed !important;border-left:#ffffff !important;}#frameq3153J .dxb_bc {  font-size:14px !important;}#frame6N1Jp8 {  border:#ffffff !important;}#portal_block_1087 {  margin-right:-5px !important;}#frameIHWNbq {  border:#ffffff !important;}#frame3d92up {  border-top:#ffffff !important;border-right:#ffffff !important;border-bottom:#ffffff !important;border-left:#660033 2px dotted !important;}#frameGwDb1z {  border:#ffffff !important;}#frame3Gcv11 {  border-top:#ffffff !important;border-right:#ffffff !important;border-bottom:#ffffff !important;border-left:#999999 2px dotted !important;}#portal_block_1487 {  margin-top:-10px !important;}#portal_block_1490 {  border-left-color:#ffffff !important;}#portal_block_1491 .dxb_bc {  font-size:14px !important;}#portal_block_1482 .dxb_bc {  font-size:14px !important;}#portal_block_1538 .dxb_bc a {  color:#666666 !important;}#portal_block_1538 .dxb_bc {  color:#666666 !important;}</style>
<style>
.wp{ width:90%;margin-right:auto;margin-left:auto;}
.topu{ width:100%;margin-bottom:15px;text-align:center;margin-right:auto;margin-left:auto;}
.topu td{ margin-left:5%;}
.dengl{width:90%;}
.sc{ text-align:right; margin-top:3px; margin-bottom:20px;width:100%;}
.sydh{ width:auto;}
.sydh ul a{display:inline; text-decoration:none;}
.sydh ul li{display:inline; float:left; margin-right:5px;}
.dh1{ margin-left:20px;}
</style>
<div class="wp">
<div class="sc">
 <p>
           <a onclick="SetHome(window.location)" href="javascript:void(0)">设为首页</a>
           <span class="pipe">|</span> <a onclick="AddFavorite(window.location,document.title)" href="javascript:void(0)">加入收藏</a>
           <span class="pipe">|</span><a href="home.php">动态发现</a>
   <span class="pipe">|</span><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a>
<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus">
<a id="loginstatusid" href="member.php?mod=switchstatus" title="切换在线状态" onclick="ajaxget(this.href, 'loginstatus');return false;" class="xi2"></a>
</span>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
<span class="pipe">|</span><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra4'])) echo $_G['setting']['pluginhooks']['global_usernav_extra4'];?><a href="home.php?mod=spacecp">设置</a>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>消息</a>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?> onmouseover="showMenu({'ctrlid':'myprompt'});">提醒<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?></a><span id="myprompt_check"></span>
<?php if(empty($_G['cookie']['ignore_notice']) && ($_G['member']['newpm'] || $_G['member']['newprompt_num']['follower'] || $_G['member']['newprompt_num']['follow'] || $_G['member']['newprompt'])) { ?><script language="javascript">delayShow($('myprompt'), function() {showMenu({'ctrlid':'myprompt','duration':3})});</script><?php } if($_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?><span class="pipe">|</span><a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new">进行中的任务</a><?php } if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
<span class="pipe">|</span><a href="portal.php?mod=portalcp"><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
<span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']) { ?>
<span class="pipe">|</span><a href="admin.php?frames=yes&amp;action=cloud&amp;operation=applist" target="_blank">云平台</a>
<?php } if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
<span class="pipe">|</span><a href="admin.php" target="_blank">管理中心</a>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra3'])) echo $_G['setting']['pluginhooks']['global_usernav_extra3'];?>
<a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1" id="extcreditmenu"<?php if(!$_G['setting']['bbclosed']) { ?> onmouseover="delayShow(this, showCreditmenu);" class="showmenu"<?php } ?>>积分: <?php echo $_G['member']['credits'];?></a>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=usergroup" id="g_upmine" class="showmenu" onmouseover="delayShow(this, showUpgradeinfo)">用户组: <?php echo $_G['group']['grouptitle'];?></a>
</p>
            </div>
<table class="topu">
<tr>
<td align="left"><img src="<?php echo IMGDIR;?>/indexlogo.png" /></td>
<td align="center"><form method="get" action="http://www.justsole.cn/search.php">
        <table>
        <tr>
        <td><input type="hidden" name="mod" value="forum" />
        <input type="text" name="srchtxt" id="srchtxt" value="" style=" background-color:#FFF; width:300px; height:26px; border: 1px solid  #888; " /></td>
        <td><input type="submit" name="submit" value="搜索" style="background-color:#25B4F0;
height:32px; width:80px;
border: 1px solid  #DDD; color:#EEE; cursor:pointer; border-radius:3px;">
    </td></tr></table>
</form></td></tr></table>
<div class="dengl"><?php include template('common/header_userstatus'); ?></div>
<!--[diy=diypage]--><div id="diypage" class="area"><div id="frame6N1Jp8" class=" frame move-span cl frame-1"><div id="frame6N1Jp8_left" class="column frame-1-c"><div id="frame6N1Jp8_left_temp" class="move-span temp"></div><?php block_display('1391');?></div></div><div id="frameDZ5KUv" class=" frame move-span cl frame-1-3"><div id="frameDZ5KUv_left" class="column frame-1-3-l"><div id="frameDZ5KUv_left_temp" class="move-span temp"></div><?php block_display('1087');?></div><div id="frameDZ5KUv_center" class="column frame-1-3-r"><div id="frameDZ5KUv_center_temp" class="move-span temp"></div><?php block_display('1513');?><div id="frameq3153J" class=" frame move-span cl frame-2-1"><div id="frameq3153J_left" class="column frame-2-1-l"><div id="frameq3153J_left_temp" class="move-span temp"></div><div id="frameIHWNbq" class=" frame move-span cl frame-1-1"><div id="frameIHWNbq_left" class="column frame-1-1-l"><div id="frameIHWNbq_left_temp" class="move-span temp"></div><?php block_display('1481');?></div><div id="frameIHWNbq_center" class="column frame-1-1-r"><div id="frameIHWNbq_center_temp" class="move-span temp"></div><?php block_display('1482');?></div></div></div><div id="frameq3153J_center" class="column frame-2-1-r"><div id="frameq3153J_center_temp" class="move-span temp"></div><?php block_display('1491');?></div></div><div id="frame3d92up" class=" frame move-span cl frame-2-1"><div id="frame3d92up_left" class="column frame-2-1-l"><div id="frame3d92up_left_temp" class="move-span temp"></div><div id="frameGwDb1z" class=" frame move-span cl frame-1-1-1"><div id="frameGwDb1z_left" class="column frame-1-1-1-l"><div id="frameGwDb1z_left_temp" class="move-span temp"></div><?php block_display('1486');?></div><div id="frameGwDb1z_center" class="column frame-1-1-1-c"><div id="frameGwDb1z_center_temp" class="move-span temp"></div><?php block_display('1489');?></div><div id="frameGwDb1z_right" class="column frame-1-1-1-r"><div id="frameGwDb1z_right_temp" class="move-span temp"></div><?php block_display('1488');?></div></div></div><div id="frame3d92up_center" class="column frame-2-1-r"><div id="frame3d92up_center_temp" class="move-span temp"></div><?php block_display('1487');?></div></div><?php block_display('1515');?><?php block_display('1484');?><div id="frame3Gcv11" class=" frame move-span cl frame-3-1"><div id="frame3Gcv11_left" class="column frame-3-1-l"><div id="frame3Gcv11_left_temp" class="move-span temp"></div><?php block_display('1490');?></div><div id="frame3Gcv11_center" class="column frame-3-1-r"><div id="frame3Gcv11_center_temp" class="move-span temp"></div><?php block_display('1396');?><?php block_display('1393');?><?php block_display('1468');?><?php block_display('1538');?></div></div></div></div></div><!--[/diy]-->
<?php if($topic['allowcomment']==1) { $data = &$topic;
$common_url = "portal.php?mod=comment&amp;id=$topicid&amp;idtype=topicid";
$form_url = "portal.php?mod=portalcp&amp;ac=comment";
$commentlist = portaltopicgetcomment($topicid);?><?php include template('portal/portal_comment'); } ?>
</div>

 <script type="text/javascript" language="javascript">
 
    //加入收藏
 
        function AddFavorite(sURL, sTitle) {
 
            sURL = encodeURI(sURL); 
        try{   
 
            window.external.addFavorite(sURL, sTitle);   
 
        }catch(e) {   
 
            try{   
 
                window.sidebar.addPanel(sTitle, sURL, "");   
 
            }catch (e) {   
 
                alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
 
            }   
 
        }
 
    }
 
    //设为首页
 
    function SetHome(url){
 
        if (document.all) {
 
            document.body.style.behavior='url(#default#homepage)';
 
               document.body.setHomePage(url);
 
        }else{
 
            alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
 
        }
 
    }
 
</script><?php include template('common/footer'); ?>