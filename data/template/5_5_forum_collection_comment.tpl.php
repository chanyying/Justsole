<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('collection_comment');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="forum.php?mod=collection">淘帖</a> <em>&rsaquo;</em>
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $ctid;?>"><?php echo $_G['collection']['name'];?></a> <em>&rsaquo;</em>
评论列表
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

<?php if($_G['collection']['commentnum'] > 0) { ?>
<div class="bm">
<?php if($permission) { ?>
<form action="forum.php?mod=collection&amp;action=comment&amp;op=del" method="POST">
<?php } ?>
<div class="tb tb_h cl">
<ul>
<li class="a"><a href="forum.php?mod=collection&amp;action=view&amp;op=comment&amp;ctid=<?php echo $_G['collection']['ctid'];?>">评论列表</a></li>
<li><a href="forum.php?mod=collection&amp;action=view&amp;op=followers&amp;ctid=<?php echo $_G['collection']['ctid'];?>">订阅用户列表</a></li>
<?php if(!empty($_G['setting']['pluginhooks']['collection_nav_extra'])) echo $_G['setting']['pluginhooks']['collection_nav_extra'];?>
</ul>
</div>
<div class="bm_c xld xlda"><?php if(is_array($commentlist)) foreach($commentlist as $comment) { ?><dl class="bbda cl">
<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>"><?php echo avatar($comment['uid'],small);?></a></dd>
<dt>
<?php if($permission) { ?>
<span class="y"><input type="checkbox" value="<?php echo $comment['cid'];?>" name="delcomment[]" /></span>
<?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>" c="1"><?php echo $comment['username'];?></a>
<span class="xg1 xw0"><?php echo $comment['dateline'];?></span>
</dt>
<?php if($comment['rate']) { ?>
<dd class="cl"><span class="clct_ratestar"><span class="star star<?php echo $comment['rateimg'];?>">&nbsp;</span></span></dd>
<?php } ?>
<dd><?php echo $comment['message'];?></dd>
</dl>
<?php } ?>
</div>

<div class="bm_c cl">
<?php if($permission) { ?>
<input type="hidden" value="<?php echo $ctid;?>" name="ctid" />
    <input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><span>删除</span></button>
<?php } if($multipage) { ?><?php echo $multipage;?><?php } ?>
</div>
<?php if($permission) { ?></form><?php } ?>

<div class="pgs mtm cl"></div>
</div>
<?php } if($_G['group']['allowcommentcollection']) { ?>
<div class="bm">
<form action="forum.php?mod=collection&amp;action=comment&amp;ctid=<?php echo $_G['collection']['ctid'];?>" method="POST">
<div class="bm_h">
<h2>评价淘专辑</h2>
</div>
<div class="bm_c <?php if($memberrate) { ?>bbda<?php } ?>">
<?php if(!$memberrate) { ?>
<div class="cl">
<input type="hidden" name="ratescore" id="ratescore" />
<span class="clct_ratestar">
<span class="btn">
<a href="javascript:;" onmouseover="rateStarHover('clct_ratestar_star',1)" onmouseout="rateStarHover('clct_ratestar_star',0)" onclick="rateStarSet('clct_ratestar_star',1,'ratescore')">1</a>
<a href="javascript:;" onmouseover="rateStarHover('clct_ratestar_star',2)" onmouseout="rateStarHover('clct_ratestar_star',0)" onclick="rateStarSet('clct_ratestar_star',2,'ratescore')">2</a>
<a href="javascript:;" onmouseover="rateStarHover('clct_ratestar_star',3)" onmouseout="rateStarHover('clct_ratestar_star',0)" onclick="rateStarSet('clct_ratestar_star',3,'ratescore')">3</a>
<a href="javascript:;" onmouseover="rateStarHover('clct_ratestar_star',4)" onmouseout="rateStarHover('clct_ratestar_star',0)" onclick="rateStarSet('clct_ratestar_star',4,'ratescore')">4</a>
<a href="javascript:;" onmouseover="rateStarHover('clct_ratestar_star',5)" onmouseout="rateStarHover('clct_ratestar_star',0)" onclick="rateStarSet('clct_ratestar_star',5,'ratescore')">5</a>
</span>
<span id="clct_ratestar_star" class="star star<?php echo $memberrate;?>"></span>
</span>
</div>
<?php } ?>
<div class="pbn">
<textarea name="message" rows="4" class="pt" style="width: 94%"></textarea>
</div>
<div><button type="submit" class="pn pnc"><span>发表评论</span></button></div>
</div>
<?php if($memberrate) { ?>
<div class="bm_c ptn pbn cl">
<span class="z">您已评分:&nbsp;</span>
<span class="clct_ratestar"><span class="star star<?php echo $memberrate;?>"></span></span>
</div>
<?php } ?>
</form>
</div>
<?php } ?>


</div>
</div><?php include template('common/footer'); ?>