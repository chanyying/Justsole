<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
	<div>悬赏<strong> <span class="xi1 xs3"><?php echo $rewardprice;?></span> </strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php if($_G['forum_thread']['price'] > 0) { ?><span class="xi1">未解决</span><?php } elseif($_G['forum_thread']['price'] < 0) { ?><span class="xg1">已解决</span><?php } ?></div>
<div id="postmessage_<?php echo $post['pid'];?>" class="postmessage"><?php echo $post['message'];?></div>


<?php if($post['attachment']) { ?>
<div class="warning">附件: <em><?php if($_G['uid']) { ?>您所在的用户组无法下载或查看附件<?php } else { ?>您需要<a href="member.php?mod=logging&amp;action=login">登录</a>才可以下载或查看附件。没有帐号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" title="注册帐号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
    <?php if($post['imagelist']) { ?>
         <?php echo showattach($post, 1); ?>    <?php } ?>
    <?php if($post['attachlist']) { ?>
         <?php echo showattach($post); ?>    <?php } } $post['attachment'] = $post['imagelist'] = $post['attachlist'] = '';?><?php if($bestpost) { ?>
<div class="rwdbst">
<h3 class="psth">最佳答案</h3>
<div class="pstl">
<div class="psta"><?php echo $bestpost['avatar'];?></div>
<div class="psti">
<p class="xi2"><a href="home.php?mod=space&amp;uid=<?php echo $bestpost['authorid'];?>" class="xw1"><?php echo $bestpost['author'];?></a> <a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $bestpost['tid'];?>&pid=<?php echo $bestpost['pid'];?>')">查看完整内容</a></p>
<div class="mtn"><?php echo $bestpost['message'];?></div>
</div>
</div>
</div>
<?php } ?>