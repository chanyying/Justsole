<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_15');
block_get('1580');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <?php echo $topic['title'];?>
</div>
</div>
<link id="style_css" rel="stylesheet" type="text/css" href="static/topic/t1/style.css">
<style id="diy_style" type="text/css">#frameAggZqb {  border:#FFFFFF !important;}</style>
<style>
.wp{ width:100%; height:100%;}



</style>
<div id="widgets">
</div>
<div class="wp">
<!--[diy=diypage]--><div id="diypage" class="area"><div id="frameAggZqb" class=" frame move-span frame-1 cl"><div id="frameAggZqb_left" class="column frame-1-c"><div id="frameAggZqb_left_temp" class="move-span temp"></div><?php block_display('1580');?></div></div></div><!--[/diy]-->
<?php if($topic['allowcomment']==1) { $data = &$topic;
$common_url = "portal.php?mod=comment&amp;id=$topicid&amp;idtype=topicid";
$form_url = "portal.php?mod=portalcp&amp;ac=comment";
$commentlist = portaltopicgetcomment($topicid);?><?php include template('portal/portal_comment'); } ?>
</div><?php include template('common/footer'); ?>