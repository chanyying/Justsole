<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); include template('common/header_ajax'); if($_GET['action'] == 'getpostfeed') { if(!empty($_GET['type'])) { ?>
<?php echo $post['message'];?>
<?php } else { ?>
<div class="z flw_avt">
<a href="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>" class="z" c="1"><?php echo avatar($feed[uid],'small');?></a>
<span class="cnr"></span>
</div>
<div class="flw_article">
<div class="flw_author pbm">
<a href="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>" c="1"><?php echo $feed['username'];?></a>
<span class="xg1">&nbsp;<?php echo dgmdate($feed['dateline'], 'u');?></span>
</div>
<?php if($feed['note']) { ?>
<div class="flw_quotenote xs2 pbw">
<?php echo $feed['note'];?>
</div>
<div class="flw_quote">
<?php } if($thread['fid'] != $_G['setting']['followforumid']) { ?>
<h2 class="wx pbm">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=page%3D1"><?php echo $thread['subject'];?></a>
</h2>
<?php } ?>

<div class="pbm c cl" id="original_content_<?php echo $feed['feedid'];?>"><?php echo $feed['content'];?></div>
<div class="xg1 cl">
<span class="y">
<?php if($feed['uid'] == $_G['uid'] || $_G['adminid'] == 1) { ?>
&nbsp; <a href="home.php?mod=spacecp&amp;ac=follow&amp;feedid=<?php echo $feed['feedid'];?>&amp;op=delete" id="c_delete_<?php echo $feed['feedid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="flw_delete">删除</a>
<?php } ?>
<a href="javascript:;" id="relay_<?php echo $feed['feedid'];?>" onclick="quickrelay(<?php echo $feed['feedid'];?>, <?php echo $thread['tid'];?>);">转播(<?php echo $feed['relay'];?>)</a>&nbsp; 
<a href="javascript:;" onclick="quickreply(<?php echo $thread['fid'];?>, <?php echo $thread['tid'];?>, <?php echo $feed['feedid'];?>)">回复(<?php echo $thread['replies'];?>)</a>
</span>
<?php if($feed['note']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>"><?php echo $thread['author'];?></a> 发表于 <?php echo dgmdate($thread['dateline']);?>&nbsp;<?php } if($thread['fid'] != $_G['setting']['followforumid'] && $_G['cache']['forums'][$thread['fid']]['name']) { ?>#<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>"><?php echo $_G['cache']['forums'][$thread['fid']]['name'];?></a><?php } ?>
</div>
<?php if($feed['note']) { ?></div><?php } ?>
</div>
<div id="replybox_<?php echo $feed['feedid'];?>" class="flw_replybox cl" style="display: none;"></div>
<div id="relaybox_<?php echo $feed['feedid'];?>" class="flw_replybox cl" style="display: none;"></div>

<?php } } else { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" class="d xg1"><?php echo $post['author'];?>:</a><?php echo $post['message'];?>
<?php } include template('common/footer_ajax'); ?>