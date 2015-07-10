<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_12');
block_get('1511,1592,1510,1509,1512');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <?php echo $topic['title'];?>
</div>
</div>
<link id="style_css" rel="stylesheet" type="text/css" href="static/topic/t1/style.css">
<style id="diy_style" type="text/css">#frame1 {  border:#FFFFFF !important;margin-top:0px !important;}#frameVsYm9s {  border:#ffffff !important;}#portal_block_1509 {  border-left-color:#ffffff !important;}#portal_block_1510 .dxb_bc a {  color:#3399cc !important;}#portal_block_1592 {  border:#999999 !important;}</style>
<style>
.wp{ width:100%; height:100%;}



</style>
<div id="widgets">
</div>
<div class="wp">
<!--[diy=diypage]--><div id="diypage" class="area"><div id="frame1" class=" frame move-span frame-1 cl"><div id="frame1_left" class="column frame-1-c"><div id="frame1_left_temp" class="move-span temp"></div><?php block_display('1511');?><?php block_display('1592');?></div></div><div id="frameVsYm9s" class=" frame move-span cl frame-2-1"><div id="frameVsYm9s_left" class="column frame-2-1-l"><div id="frameVsYm9s_left_temp" class="move-span temp"></div><?php block_display('1510');?></div><div id="frameVsYm9s_center" class="column frame-2-1-r"><div id="frameVsYm9s_center_temp" class="move-span temp"></div><?php block_display('1509');?><?php block_display('1512');?></div></div></div><!--[/diy]-->
<?php if($topic['allowcomment']==1) { $data = &$topic;
$common_url = "portal.php?mod=comment&amp;id=$topicid&amp;idtype=topicid";
$form_url = "portal.php?mod=portalcp&amp;ac=comment";
$commentlist = portaltopicgetcomment($topicid);?><?php include template('portal/portal_comment'); } ?>
</div><?php include template('common/footer'); ?>