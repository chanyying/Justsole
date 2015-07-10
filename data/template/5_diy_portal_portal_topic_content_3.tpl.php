<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_3');
block_get('558');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <?php echo $topic['title'];?>
</div>
</div>
<link id="style_css" rel="stylesheet" type="text/css" href="static/topic/t1/style.css">
<style id="diy_style" type="text/css">#framexxI3uV {  border:#ffffff 0px !important;}</style>
<style>
.wp{ width:100%; height:100%;}



</style>
<div id="widgets">
</div>
<div class="wp">
<!--[diy=diypage]--><div id="diypage" class="area"><div id="framegtXMPi" class="frame move-span cl frame-3-1"><div class="title frame-title" style='background-repeat:repeat;'><span class="titletext" style="font-size:12px;color:rgb(51, 51, 51);">欢迎进入代码实验室</span></div><div id="framegtXMPi_left" class="column frame-3-1-l"><div id="framegtXMPi_left_temp" class="move-span temp"></div><?php block_display('558');?></div><div id="framegtXMPi_center" class="column frame-3-1-r"><div id="framegtXMPi_center_temp" class="move-span temp"></div><div id="framexxI3uV" class=" frame move-span cl frame-1"><div id="framexxI3uV_left" class="column frame-1-c"><div id="framexxI3uV_left_temp" class="move-span temp"></div></div></div></div></div></div><!--[/diy]-->
<?php if($topic['allowcomment']==1) { $data = &$topic;
$common_url = "portal.php?mod=comment&amp;id=$topicid&amp;idtype=topicid";
$form_url = "portal.php?mod=portalcp&amp;ac=comment";
$commentlist = portaltopicgetcomment($topicid);?><?php include template('portal/portal_comment'); } ?>
</div><?php include template('common/footer'); ?>