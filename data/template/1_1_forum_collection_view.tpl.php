<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('collection_view');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="forum.php?mod=collection<?php if($fromop) { ?>&amp;op=<?php echo $fromop;?><?php } if($fromtid) { ?>&amp;tid=<?php echo $fromtid;?><?php } ?>">淘帖</a> <em>&rsaquo;</em>
<?php if(!$op) { ?>
<?php echo $_G['collection']['name'];?>
<?php } elseif($op == 'related') { ?>
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $ctid;?>&amp;fromop=<?php echo $fromop;?>&amp;fromtid=<?php echo $fromtid;?>"><?php echo $_G['collection']['name'];?></a> <em>&rsaquo;</em>
搜索相关主题
<?php } ?>
</div>
</div>
<script src="<?php echo $_G['setting']['jspath'];?>home_friendselector.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var fs;
var clearlist = 0;
var followstatus = <?php if($collectionfollowdata['ctid']) { ?>1<?php } else { ?>0<?php } ?>;

function succeedhandle_addComment(url, msg, commentdata) {
$("btnCommentSubmit").disabled='';
showDialog(msg, 'right', '', 'location.href="' + url + '"', null, null, null, null, null, null, 3);
}
function errorhandle_addComment(msg, commentdata) {
$("btnCommentSubmit").disabled='';
showError(msg);
}
function succeedhandle_followcollection(url, msg, collectiondata) {
if(collectiondata['status'] == 1) { //关注成功
followstatus = 1;
$("followlink").innerHTML = '<i class="u">取消订阅</i>';
$("followlink").href = followcollectionurl();
$("rightcolfollownum").innerHTML = $("follownum_display").innerHTML = parseInt($("follownum_display").innerHTML) + 1;
} else if(collectiondata['status'] == 2) { //取消关注成功
followstatus = 0;
$("followlink").innerHTML = '<i>订阅</i>';
$("followlink").href = followcollectionurl();
$("rightcolfollownum").innerHTML = $("follownum_display").innerHTML = parseInt($("follownum_display").innerHTML) - 1;
}
}
function errorhandle_followcollection(msg, collectiondata) {
showError(msg);
}
function followcollectionurl() {
return 'forum.php?mod=collection&action=follow&op='+(followstatus ? 'unfo': 'follow')+'&ctid=<?php echo $_G['collection']['ctid'];?>&formhash=<?php echo FORMHASH;?>';
}
</script>
<div id="username_menu" style="display: none;">
<ul id="friends" class="pmfrndl"></ul>
</div>
<div class="p_pof" id="showSelectBox_menu" unselectable="on" style="display:none;">
<div class="pbm">
<select class="ps" onchange="clearlist=1;getUser(1, this.value)">
<option value="-1">邀请所有好友</option><?php if(is_array($friendgrouplist)) foreach($friendgrouplist as $groupid => $group) { ?><option value="<?php echo $groupid;?>"><?php echo $group;?></option>
<?php } ?>
</select>
</div>
<div id="selBox" class="ptn pbn">
<ul id="selectorBox" class="xl xl2 cl"></ul>
</div>
<div class="cl">
<button type="button" class="y pn" onclick="fs.showPMFriend('showSelectBox_menu','selectorBox', $('showSelectBox'));doane(event)"><span>关闭</span></button>
</div>
</div>
<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm bml pbn">
<div class="bm_h cl">
<h1 class="xs2 z">
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $_G['collection']['ctid'];?>"><?php echo $_G['collection']['name'];?></a>
</h1>
<div class="clct_flw">
<strong class="xi1" id="follownum_display"><?php echo $_G['collection']['follownum'];?></strong>
<?php if($_G['group']['allowfollowcollection'] && $_G['collection']['uid'] != $_G['uid']) { if(!$collectionfollowdata['ctid']) { ?>
<a href="javascript;" id="followlink" onclick="ajaxget(followcollectionurl());doane(event);"><i>订阅</i></a>
<?php } else { ?>
<a href="javascript;" id="followlink" onclick="ajaxget(followcollectionurl());doane(event);"><i class="u">取消订阅</i></a>
<?php } } else { ?>
<i>订阅</i>
<?php } ?>
</div>
</div>
<div class="bm_c">
<div class="cl">
<div class="ptn y">
<?php if(!empty($_G['setting']['pluginhooks']['collection_viewoptions'])) echo $_G['setting']['pluginhooks']['collection_viewoptions'];?>
<?php if($permission) { ?>
<a href="forum.php?mod=collection&amp;action=edit&amp;op=invite&amp;ctid=<?php echo $ctid;?>" id="k_invite" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2">邀请维护</a>
<span class="pipe">|</span>
<a href="forum.php?mod=collection&amp;action=edit&amp;op=edit&amp;ctid=<?php echo $_G['collection']['ctid'];?>&amp;formhash=<?php echo FORMHASH;?>" class="xi2">编辑</a>
<span class="pipe">|</span>
<a href="forum.php?mod=collection&amp;action=edit&amp;op=remove&amp;ctid=<?php echo $_G['collection']['ctid'];?>&amp;formhash=<?php echo FORMHASH;?>" onclick="showDialog('确定要 <strong>删除这个淘专辑</strong> 吗?','confirm','','window.location=\''+this.href+'\';');return false;" class="xi2">删除</a>
<?php } if($_G['uid']!=$_G['collection']['uid']) { if($permission) { ?>
<span class="pipe">|</span>
<?php } ?>
<a href="forum.php?mod=collection&amp;action=comment&amp;op=recommend&amp;ctid=<?php echo $ctid;?>" id="k_recommened" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2">向作者推荐主题</a>
<?php } if($isteamworkers) { ?>
<span id="exitpipe" class="pipe">|</span>
<span><a href="forum.php?mod=collection&amp;action=edit&amp;op=removeworker&amp;ctid=<?php echo $_G['collection']['ctid'];?>&amp;uid=<?php echo $_G['uid'];?>&amp;formhash=<?php echo FORMHASH;?>"  onclick="showDialog('真的要退出维护淘专辑?','confirm','','window.location=\''+this.href+'\';');return false;" class="xi2">退出维护</a></span>
<?php } ?>
</div>
<div title="<?php echo $avgrate;?>" class="ptn pbn xg1 cl">
<?php if($_G['collection']['ratenum'] > 0) { ?>
<span class="clct_ratestar"><span class="star star<?php echo $star;?>">&nbsp;</span></span>
 &nbsp;(共 <?php echo $_G['collection']['ratenum'];?> 次打分)
<?php } else { ?>
暂时还没有人评分
<?php } ?>
</div>
</div>
<div class="mbn cl">
<?php if($_G['collection']['arraykeyword']) { ?>
<p class="mbn">
淘帖标签：<?php if(is_array($_G['collection']['arraykeyword'])) foreach($_G['collection']['arraykeyword'] as $unique_keyword) { ?><a href="search.php?mod=<?php if($_G['setting']['search']['collection']['status']) { ?>collection<?php } else { ?>forum<?php } ?>&amp;srchtxt=<?php echo rawurlencode($unique_keyword); ?>&amp;formhash=<?php echo FORMHASH;?>&amp;searchsubmit=true&amp;source=collectionsearch" target="_blank" class="xi2"><?php echo $unique_keyword;?></a>&nbsp;
<?php } ?>
</p>
<?php } ?>
<p>
专辑创建人：<a href="home.php?mod=space&amp;uid=<?php echo $_G['collection']['uid'];?>" class="xi2" c="1"><?php echo $_G['collection']['username'];?></a>
<?php if($collectionteamworker) { ?>
<span class="pipe">|</span>
共同维护人：<?php if(is_array($collectionteamworker)) foreach($collectionteamworker as $collectionworker) { ?><span id="k_worker_uid_<?php echo $collectionworker['uid'];?>">
<a href="home.php?mod=space&amp;uid=<?php echo $collectionworker['uid'];?>" c="1" class="xi2"><?php echo $collectionworker['username'];?></a>&nbsp;
<?php if($permission) { ?>
<a href="forum.php?mod=collection&amp;action=edit&amp;op=removeworker&amp;ctid=<?php echo $_G['collection']['ctid'];?>&amp;uid=<?php echo $collectionworker['uid'];?>&amp;formhash=<?php echo FORMHASH;?>"  onclick="showDialog('确定要 <strong>删除这个淘专辑</strong> 吗?','confirm','','ajaxget(\''+this.href+'\',\'k_worker_uid_<?php echo $collectionworker['uid'];?>\')');return false;" class="xi2">[删除]</a>&nbsp;
<?php } ?>
</span>
<?php } } ?>
</p>
</div>
<div><?php echo $_G['collection']['desc'];?></div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['collection_view_top'])) echo $_G['setting']['pluginhooks']['collection_view_top'];?>
<?php if(!$op) { ?>
<div class="tl bm">
<?php if($threadlist) { if($permission) { ?>
<form action="forum.php?mod=collection&amp;action=edit&amp;op=delthread" method="POST">
<?php } ?>
<div class="th">
<table cellspacing="0" cellpadding="0">
<tr>
<td class="icn">&nbsp;</td>
<?php if($permission) { ?><td class="o"><label class="z" onclick="checkall(this.form, 'delthread')"><input class="pc" type="checkbox" name="chkall" title="全选" /></label></td><?php } ?>
<td class="common">淘帖主题</td>
<td class="by">作者</td>
<td class="num">回复/查看</td>
<td class="by">最后发表</td>
</tr>
</table>
</div>

<div class="bm_c">
<table cellspacing="0" cellpadding="0"><?php if(is_array($collectiontids)) foreach($collectiontids as $thread) { ?><tr>
<td class="icn">
<?php if($thread['folder'] == 'lock') { ?>
<img src="<?php echo IMGDIR;?>/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="<?php echo IMGDIR;?>/pollsmall.gif" alt="投票" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="<?php echo IMGDIR;?>/tradesmall.gif" alt="商品" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="<?php echo IMGDIR;?>/rewardsmall.gif" alt="悬赏" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="<?php echo IMGDIR;?>/activitysmall.gif" alt="活动" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="<?php echo IMGDIR;?>/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="<?php echo IMGDIR;?>/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { ?>
<img src="<?php echo IMGDIR;?>/folder_common.gif" />
<?php } ?>
</td>
<?php if($permission) { ?>
<td class="o"><input type="checkbox" value="<?php echo $thread['tid'];?>" name="delthread[]" /></td>
<?php } ?>
<th<?php if($thread['reason']) { ?> title="推荐理由: <?php echo $thread['reason'];?>"<?php } ?>>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?><?php if(!$memberrate AND $_G['uid']) { ?>&amp;ctid=<?php echo $ctid;?><?php } ?>" target="_blank" class="xst <?php if($thread['updatedthread']) { ?>xw1 xi2<?php } ?>" title="<?php echo $thread['htmlsubject'];?>"><?php echo $thread['cutsubject'];?></a>
<?php if($thread['readperm']) { ?> - [阅读权限 <span class="xw1"><?php echo $thread['readperm'];?></span>]<?php } if($thread['price'] > 0) { if($thread['special'] == '3') { ?>
- <span style="color: #C60">[悬赏 <span class="xw1"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>]</span>
<?php } else { ?>
- [售价 <span class="xw1"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>]
<?php } } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
- [已解决]
<?php } if($thread['attachment'] == 2) { ?>
<img src="<?php echo STATICURL;?>image/filetype/image_s.gif" alt="attach_img" title="图片附件" align="absmiddle" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="<?php echo STATICURL;?>image/filetype/common.gif" alt="attachment" title="附件" align="absmiddle" />
<?php } if($thread['digest'] > 0 && $filter != 'digest') { ?>
<img src="<?php echo IMGDIR;?>/digest_<?php echo $thread['digest'];?>.gif" align="absmiddle" alt="digest" title="精 <?php echo $thread['digest'];?>" />
<?php } ?>
</th>
<td class="by">
<cite>
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" c="1"><?php echo $thread['author'];?></a>
<?php } else { ?>
匿名
<?php } ?>
</cite>
<em class="xi1"><?php echo $thread['dateline'];?></em>
</td>
<td class="num">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" class="xi2"><?php echo $thread['replies'];?></a>
<em><?php echo $thread['views'];?></em>
</td>
<td class="by">
<cite><?php if($thread['lastposter']) { ?><a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" c="1"><?php echo $thread['lastposter'];?></a><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<em><a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $thread['tid'];?>&goto=lastpost<?php echo $highlight;?>#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>"><?php echo $thread['lastpost'];?></a></em>
</td>
</tr>
<?php } ?>
</table>
</div>

<?php if($permission) { ?>
<div class="bm_c cl">
<input type="hidden" value="<?php echo $ctid;?>" name="ctid" />
    <input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />

<button type="submit" class="pn pnc"><span>删除</span></button>
</div>
</form>
<?php } } else { ?>
<div class="emp hm">
<?php if($search_status && $isteamworkers && $permission) { ?>
淘专辑还没有内容，您可以点击 <a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $ctid;?>&amp;op=related" class="xi2">搜索相关主题</a> 找到相关内容。
<?php } else { ?>
暂时没有内容
<?php } ?>
</div>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['collection_threadlistbottom'])) echo $_G['setting']['pluginhooks']['collection_threadlistbottom'];?>
</div>
<?php if($multipage) { ?><div class="pgs mtm cl"><?php echo $multipage;?></div><br /><?php } } elseif($op == 'related') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['collection_relatedop'])) echo $_G['setting']['pluginhooks']['collection_relatedop'];?>
<?php } if($_G['collection']['commentnum'] > 0) { ?>
<div class="bm">
<div class="bm_h">
<span class="y"><a href="forum.php?mod=collection&amp;action=view&amp;op=comment&amp;ctid=<?php echo $ctid;?>" class="xi2">所有评论</a></span>
<h2>最新评论</h2>
</div>
<div class="bm_c"><?php if(is_array($commentlist)) foreach($commentlist as $comment) { ?><div class="pbn">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>" class="xi2 xw1" c="1"><?php echo $comment['username'];?></a>
<span class="xg1"><?php echo $comment['dateline'];?>:</span>
</div>
<div class="pbm">
<?php echo $comment['message'];?>
<?php if($comment['rateimg']) { if(trim($comment['message'])) { ?><br /><?php } ?>
<span class="clct_ratestar"><span class="star star<?php echo $comment['rateimg'];?>"></span></span><br />
<?php } ?>
</div>
<?php } ?>
</div>
</div>
<?php } if($_G['group']['allowcommentcollection']) { ?>
<div class="bm">
<form action="forum.php?mod=collection&amp;action=comment&amp;ctid=<?php echo $_G['collection']['ctid'];?>" method="POST" onsubmit="$('btnCommentSubmit').disabled=true;ajaxpost(this.id, 'ajaxreturn');" id="form_addComment" name="form_addComment">
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
<div><button type="submit" class="pn pnc" id="btnCommentSubmit"><span>发表评论</span></button></div>
</div>
<?php if($memberrate) { ?>
<div class="bm_c ptn pbn cl">
<span class="z">您已评分:&nbsp;</span>
<span class="clct_ratestar"><span class="star star<?php echo $memberrate;?>"></span></span>
</div>
<?php } ?>
<input type="hidden" name="inajax" value="1">
<input type="hidden" name="handlekey" value="k_addComment">
</form>
</div>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['collection_view_bottom'])) echo $_G['setting']['pluginhooks']['collection_view_bottom'];?>
</div>
<div class="sd">
<div class="bm bml tns">
<table cellspacing="0" cellpadding="4">
<tr>
<th>
<p><?php echo $_G['collection']['threadnum'];?></p>主题
</th>
<th>
<p><?php echo $_G['collection']['commentnum'];?></p>评论
</th>
<td>
<p><span id="rightcolfollownum"><?php echo $_G['collection']['follownum'];?></span></p>订阅
</td>
</tr>
</table>
</div>

<?php if($followers) { ?>
<div class="bm">
<div class="bm_h">
<span class="y"><a href="forum.php?mod=collection&amp;action=view&amp;op=followers&amp;ctid=<?php echo $ctid;?>" class="xi2">所有订阅者</a></span>
<h2>最新订阅</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($followers)) foreach($followers as $follower) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $follower['uid'];?>" class="avt"><?php echo avatar($follower[uid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $follower['uid'];?>" c="1"><?php echo $follower['username'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($userCollections) { ?>
<div class="bm">
<div class="bm_h">
<h2>他还有这些淘帖</h2>
</div>
<div class="bm_c"><?php if(is_array($userCollections)) foreach($userCollections as $ucollection) { ?><div class="pbn">
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $ucollection['ctid'];?>" class="xi2 xw1"><?php echo $ucollection['name'];?></a>
</div>
<div class="pbm">
主题 <?php echo $ucollection['threadnum'];?>, 订阅 <?php echo $ucollection['follownum'];?>, 评论 <?php echo $ucollection['commentnum'];?>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['collection_side_bottom'])) echo $_G['setting']['pluginhooks']['collection_side_bottom'];?>
</div>
</div>
<span id='ajaxreturn' style='display:none;'></span><?php include template('common/footer'); ?>