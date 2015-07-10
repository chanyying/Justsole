<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_14');
block_get('1597,1534,1530,1532');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <?php echo $topic['title'];?>
</div>
</div>
<link id="style_css" rel="stylesheet" type="text/css" href="static/topic/t1/style.css">
<style id="diy_style" type="text/css">body {  background-attachment:scroll !important;background-image:url('http://www.justsole.cn/data/attachment/portal/201306/20/132104np3e9qjye54pq9qp.jpg') !important;background-repeat:repeat !important;}#framebb0OMq {  border:#ffffff !important;margin-top:-30px !important;}#portal_block_1532 .dxb_bc {  color:#000000 !important;}#portal_block_1532 .dxb_bc a {  color:#3399cc !important;}#frameEK7eZ4 {  border:#ffffff !important;}#portal_block_1530 {  background-color:#f1f1f1 !important;background-image:none !important;}</style>
<style>
.wp{ width:100%; height:100%;}



</style>
<div id="widgets">
</div>
<div class="wp">
<!--[diy=diypage]--><div id="diypage" class="area"><div id="framebb0OMq" class=" frame move-span cl frame-1"><div id="framebb0OMq_left" class="column frame-1-c"><div id="framebb0OMq_left_temp" class="move-span temp"></div><div id="framefi2Kv8" class="frame move-span cl frame-1-3"><div id="framefi2Kv8_left" class="column frame-1-3-l"><div id="framefi2Kv8_left_temp" class="move-span temp"></div><?php block_display('1597');?></div><div id="framefi2Kv8_center" class="column frame-1-3-r"><div id="framefi2Kv8_center_temp" class="move-span temp"></div><?php block_display('1534');?><?php block_display('1530');?><?php block_display('1532');?><div id="frameEK7eZ4" class=" frame move-span cl frame-1-1"><div id="frameEK7eZ4_left" class="column frame-1-1-l"><div id="frameEK7eZ4_left_temp" class="move-span temp"></div></div><div id="frameEK7eZ4_center" class="column frame-1-1-r"><div id="frameEK7eZ4_center_temp" class="move-span temp"></div></div></div></div></div></div></div></div><!--[/diy]-->
<?php if($topic['allowcomment']==1) { $data = &$topic;
$common_url = "portal.php?mod=comment&amp;id=$topicid&amp;idtype=topicid";
$form_url = "portal.php?mod=portalcp&amp;ac=comment";
$commentlist = portaltopicgetcomment($topicid);?><?php include template('portal/portal_comment'); } ?>
</div><?php include template('common/footer'); ?>