<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('collection_followers');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="forum.php?mod=collection">淘帖</a> <em>&rsaquo;</em>
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $ctid;?>"><?php echo $_G['collection']['name'];?></a> <em>&rsaquo;</em>
订阅用户列表
</div>
</div>
<script src="<?php echo $_G['setting']['jspath'];?>home_friendselector.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var fs;
var clearlist = 0;
</script>

<div id="ct" class="wp cl">
<div class="bm bml pbn">
<div class="bm_h cl">
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $_G['collection']['ctid'];?>" class="y pn"><span class="xi2">&laquo; 返回专辑</span></a>
<h1 class="xs2">
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $_G['collection']['ctid'];?>"><?php echo $_G['collection']['name'];?></a>
</h1>
</div>
<div class="bm_c">
<div title="<?php echo $avgrate;?>" class="pbn xg1 cl">
<?php if($_G['collection']['ratenum'] > 0) { ?>
<span class="clct_ratestar"><span class="star star<?php echo $star;?>">&nbsp;</span></span>
 &nbsp;(共 <?php echo $_G['collection']['ratenum'];?> 次打分)
<?php } else { ?>
暂时还没有人评分
<?php } ?>
</div>
<div><?php echo $_G['collection']['desc'];?></div>
</div>
</div>

<div class="bm">
<div class="tb tb_h cl">
<ul>
<li><a href="forum.php?mod=collection&amp;action=view&amp;op=comment&amp;ctid=<?php echo $_G['collection']['ctid'];?>">评论列表</a></li>
<li class="a"><a href="forum.php?mod=collection&amp;action=view&amp;op=followers&amp;ctid=<?php echo $_G['collection']['ctid'];?>">订阅用户列表</a></li>
</ul>
</div>
<?php if($followers) { ?>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($followers)) foreach($followers as $follower) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $follower['uid'];?>" class="avt"><?php echo avatar($follower[uid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $follower['uid'];?>"><?php echo $follower['username'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
<?php } else { ?>
<p class="emp">暂时没有内容</p>
<?php } if($multipage) { ?><div class="bm_c cl"><?php echo $multipage;?></div><?php } ?>
</div>
</div><?php include template('common/footer'); ?>