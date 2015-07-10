<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_follow');
0
|| checktplrefresh('./template/default/home/spacecp_follow.htm', './template/default/common/seccheck.htm', 1409123853, '5', './data/template/5_5_home_spacecp_follow.tpl.php', './template/mobanbus_boohee', 'home/spacecp_follow')
|| checktplrefresh('./template/default/home/spacecp_follow.htm', './template/default/common/seccheck.htm', 1409123853, '5', './data/template/5_5_home_spacecp_follow.tpl.php', './template/mobanbus_boohee', 'home/spacecp_follow')
|| checktplrefresh('./template/default/home/spacecp_follow.htm', './template/default/home/follow_feed_li.htm', 1409123853, '5', './data/template/5_5_home_spacecp_follow.tpl.php', './template/mobanbus_boohee', 'home/spacecp_follow')
;?><?php include template('common/header'); if($op == 'bkname') { ?>
<h3 class="flb">
<em id="return_<?php echo $_GET['handlekey'];?>">为<?php echo $followuser['fusername'];?>添加备注</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<?php if(!submitcheck('editbkname')) { ?>
<form method="post" autocomplete="off" id="bknameform_<?php echo $_GET['handlekey'];?>" name="bknameform_<?php echo $_GET['handlekey'];?>" action="home.php?mod=spacecp&amp;ac=follow&amp;op=bkname&amp;fuid=<?php echo $followuser['followuid'];?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
<input type="hidden" name="editbkname" value="true" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table>
<tr>
<th valign="top" width="60" class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $followuser['followuid'];?>"><?php echo avatar($followuser['followuid'],small);?></th>
<td valign="top">备注: <input type="text" name="bkname" value="<?php echo $followuser['bkname'];?>" size="35" class="px"  onkeydown="ctrlEnter(event, 'editsubmit_btn');" />
</td>
</tr>
</table>
</div>
<p class="o pns">
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="pn pnc"><strong>保存</strong></button>
</p>
</form>
<?php } ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, msg, values) {
$('<?php echo $_GET['handlekey'];?>').innerHTML = values['bkname'];
$('fbkname_<?php echo $followuser['followuid'];?>').innerHTML = values['btnstr'];
}
</script>
<?php } elseif($op == 'relay') { if($_GET['from'] == 'forum') { ?>

<h3 class="flb">
<em id="return_<?php echo $_GET['handlekey'];?>">转播</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" id="relayform_<?php echo $tid;?>" name="relayform_<?php echo $tid;?>" action="home.php?mod=spacecp&amp;ac=follow&amp;op=relay&amp;tid=<?php echo $tid;?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>');"<?php } ?>>
<input type="hidden" name="relaysubmit" value="true">
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="tid" value="<?php echo $tid;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>
<div class="c">
<p>顺便说两句:</p>
<textarea id="note_<?php echo $tid;?>" name="note" cols="50" rows="5" class="pt mtn" style="width: 425px;" onkeydown="ctrlEnter(event, 'relaysubmit_btn')" onkeyup="strLenCalc(this, 'checklen<?php echo $tid;?>', 140);"></textarea>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu({'ctrlid':this.id,'win':'{$_GET['handlekey']}'})"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><?php $_G['sechashi'] = !empty($_G['cookie']['sechashi']) ? $_G['sechash'] + 1 : 0;
$sechash = 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'].$_G['sechashi'];
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex;?><?php
$__STATICURL = STATICURL;$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

{$sectplqaa['0']}验证问答{$sectplqaa['1']}<input name="secanswer" id="secqaaverify_{$sechash}" type="text" autocomplete="off" style="width:100px" class="txt px vm" onblur="checksec('qaa', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updatesecqaa('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checksecqaaverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplqaa['2']}<span id="secqaa_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updatesecqaa('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplqaa['3']}

EOF;
 } if($seccodecheck) { 
$seccheckhtml .= <<<EOF

{$sectplcode['0']}验证码{$sectplcode['1']}<input name="seccodeverify" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="
EOF;
 if($_G['setting']['seccodedata']['type'] != 1) { 
$seccheckhtml .= <<<EOF
ime-mode:disabled;
EOF;
 } 
$seccheckhtml .= <<<EOF
width:100px" class="txt px vm" onblur="checksec('code', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checkseccodeverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplcode['2']}<span id="seccode_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}

EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow);?><?php if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?></div>
<?php } ?>
<br/>还能输入<span id="checklen<?php echo $tid;?>" class="xg1">140</span>字
</div>
<p class="o pns">
<label class="lb"><input type="checkbox" name="addnewreply" checked="checked" class="pc" value="1" />同时回复</label>
<button type="submit" name="relaysubmit_btn" id="relaysubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
$('note_<?php echo $tid;?>').focus();
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, param) {
<?php if($fastpost) { ?>
succeedhandle_fastpost(url, message, param);
<?php } ?>
hideWindow('<?php echo $_GET['handlekey'];?>');
showCreditPrompt();
}
</script>
<?php } else { ?>
<span class="cnr" style="margin: -22px 66px 0 0;"></span>
<form method="post" autocomplete="off" id="postform_<?php echo $tid;?>" action="home.php?mod=spacecp&amp;ac=follow&amp;op=relay&amp;tid=<?php echo $tid;?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>');"<?php } ?>>
<input type="hidden" name="relaysubmit" value="true">
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="tid" value="<?php echo $tid;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>

<table cellspacing="0" cellpadding="0">
<tr>
<td class="flw_autopt">
<textarea id="note_<?php echo $tid;?>" name="note" class="pts" cols="80" rows="4" onkeyup="resizeTx(this);strLenCalc(this, 'checklen<?php echo $tid;?>', 140);" onkeydown="resizeTx(this);" onpropertychange="resizeTx(this);" oninput="resizeTx(this);" style="height:54px">


</textarea>
</td>
<td style="vertical-align:top;">
<table cellspacing="0" cellpadding="0" style="margin-left: 5px;">
<tr>
<td style="vertical-align:top;"><button type="submit" name="relaysubmit_btn" id="relaysubmit_btn" class="pn pnc" value="true" name="<?php if($_GET['action'] == 'newthread') { ?>topicsubmit<?php } elseif($_GET['action'] == 'reply') { ?>replysubmit<?php } ?>" tabindex="23"><span>转播</span></button></td>
<td width="100" class="ptn" style="vertical-align:top;"><label><input type="checkbox" name="addnewreply" class="pc" value="1" checked="checked" />同时回复</label></td>
</tr>
<tr>
<td colspan="2" class="ptm">还能输入<span id="checklen<?php echo $tid;?>" class="xg1">140</span>字</td>
</tr>
</table>
</td>
</tr>
</table>

<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu({'ctrlid':this.id,'win':'{$_GET['handlekey']}'})"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><?php $_G['sechashi'] = !empty($_G['cookie']['sechashi']) ? $_G['sechash'] + 1 : 0;
$sechash = 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'].$_G['sechashi'];
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex;?><?php
$__STATICURL = STATICURL;$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

{$sectplqaa['0']}验证问答{$sectplqaa['1']}<input name="secanswer" id="secqaaverify_{$sechash}" type="text" autocomplete="off" style="width:100px" class="txt px vm" onblur="checksec('qaa', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updatesecqaa('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checksecqaaverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplqaa['2']}<span id="secqaa_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updatesecqaa('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplqaa['3']}

EOF;
 } if($seccodecheck) { 
$seccheckhtml .= <<<EOF

{$sectplcode['0']}验证码{$sectplcode['1']}<input name="seccodeverify" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="
EOF;
 if($_G['setting']['seccodedata']['type'] != 1) { 
$seccheckhtml .= <<<EOF
ime-mode:disabled;
EOF;
 } 
$seccheckhtml .= <<<EOF
width:100px" class="txt px vm" onblur="checksec('code', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checkseccodeverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplcode['2']}<span id="seccode_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}

EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow);?><?php if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?></div>
<?php } ?>
<div id="return_<?php echo $_GET['handlekey'];?>"></div>
</form>

<div class="cl">
<a href="javascript:;" onclick="display('relaybox_<?php echo $_GET['feedid'];?>')" class="y xg1">&uarr; 关闭</a>
</div>

<script type="text/javascript">
$('note_<?php echo $tid;?>').focus();
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, message, values) {
$('relaybox_<?php echo $_GET['feedid'];?>').style.display = 'none';
showCreditPrompt();
}
</script>
<?php } } elseif($op == 'getfeed') { if(!empty($list)) { $carray = array();?><?php $beforeuser = 0;?><?php $hiddennum = 0;?><?php if(is_array($list['feed'])) foreach($list['feed'] as $feed) { $content = $list['content'][$feed['tid']];?><?php $thread = $list['threads'][$content['tid']];?><?php if(!empty($thread) && $thread['displayorder'] >= 0 || !empty($feed['note'])) { ?>
<li class="cl<?php if($lastviewtime && $feed['dateline'] > $lastviewtime) { ?> unread<?php } ?>" id="feed_li_<?php echo $feed['feedid'];?>" onmouseover="this.className='flw_feed_hover cl'" onmouseout="this.className='cl'">
<?php if($_GET['do'] != 'view' && !isset($_GET['banavatar'])) { ?>
<div class="z flw_avt">
<?php if($beforeuser != $feed['uid']) { $beforeuser = $feed['uid'];?><a href="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>" class="z" c="1" shref="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>"><?php echo avatar($feed[uid],'small');?></a>
<span class="cnr"></span>
<?php } ?>
</div>
<?php } ?>
<div class="flw_article" <?php if($_GET['do'] == 'view' || $_GET['banavatar']) { ?>style="margin-left:0"<?php } ?>>
<?php if($feed['uid'] == $_G['uid'] || $_G['adminid'] == 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=follow&amp;feedid=<?php echo $feed['feedid'];?>&amp;op=delete" id="c_delete_<?php echo $feed['feedid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="flw_delete">删除</a>
<?php } ?>
<div class="flw_author">
<a href="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>" c="1" shref="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>"><?php echo $feed['username'];?></a>
<span class="xg1">&nbsp;<?php echo dgmdate($feed['dateline'], 'u');?></span>
</div>
<?php if($feed['note']) { ?>
<div class="flw_quotenote xs2 pbw">
<?php echo $feed['note'];?>
</div>
<div class="flw_quote">
<?php } if(!empty($thread) && $thread['displayorder'] >= 0) { ?>
<h2 class="wx pbn">
<?php if(isset($carray[$feed['cid']])) { ?>
<a href="javascript:;" onclick="vieworiginal(this, 'original_content_<?php echo $feed['feedid'];?>');return false;" class="flw_readfull y xw0 xs1 xi2">+ 展开全文</a>
<?php } if($thread['fid'] != $_G['setting']['followforumid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $content['tid'];?>&amp;extra=page%3D1" target="_blank"><?php echo $thread['subject'];?></a>
<?php } ?>
</h2>

<div class="pbm c cl" id="original_content_<?php echo $feed['feedid'];?>" <?php if(isset($carray[$feed['cid']])) { ?> style="display: none"<?php } ?>>
<?php echo $content['content'];?>
<?php if($thread['special'] && $thread['fid'] != $_G['setting']['followforumid']) { ?>
<br/>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $content['tid'];?>&amp;extra=page%3D1" target="_blank">这是一个特殊主题，点这里可以回原帖查看详细内容</a>
<?php } ?>
</div>
<div class="xg1 cl">
<span class="y">
<?php if(helper_access::check_module('follow')) { ?>
<a href="javascript:;" id="relay_<?php echo $feed['feedid'];?>" onclick="quickrelay(<?php echo $feed['feedid'];?>, <?php echo $thread['tid'];?>);">转播(<?php echo $content['relay'];?>)</a>&nbsp;
<?php } ?> 
<a href="javascript:;" onclick="quickreply(<?php echo $thread['fid'];?>, <?php echo $thread['tid'];?>, <?php echo $feed['feedid'];?>)">回复(<?php echo $thread['replies'];?>)</a>
</span>
<?php if($feed['note']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $feed['uid'];?>"><?php echo $thread['author'];?></a> 发表于 <?php echo dgmdate($thread['dateline']);?>&nbsp;<?php } if($thread['fid'] != $_G['setting']['followforumid'] && $_G['cache']['forums'][$thread['fid']]['name']) { ?>#<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>"><?php echo $_G['cache']['forums'][$thread['fid']]['name'];?></a><?php } ?>
</div>
<?php } else { ?>
<div class="pbm c cl" id="original_content_<?php echo $feed['feedid'];?>" <?php if(isset($carray[$feed['cid']])) { ?> style="display: none"<?php } ?>>
该主题已被删除
</div>
<?php } if($feed['note']) { ?></div><?php } ?>
</div>
<div id="replybox_<?php echo $feed['feedid'];?>" class="flw_replybox cl" style="display: none;"></div>
<div id="relaybox_<?php echo $feed['feedid'];?>" class="flw_replybox cl" style="display: none;"></div>
</li>
<?php } else { $hiddennum++;?><?php } if(!isset($carray[$feed['cid']])) { $carray[$feed['cid']] = $feed['cid'];?><?php } } } else { ?>
false
<?php } } elseif($op == 'delete') { ?>
<h3 class="flb">
<em id="return_<?php echo $_GET['handlekey'];?>">删除广播</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');return false;" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" id="deletefeed_<?php echo $_GET['feedid'];?>" name="deletefeed_<?php echo $_GET['feedid'];?>" action="home.php?mod=spacecp&amp;ac=follow&amp;op=delete&amp;feedid=<?php echo $_GET['feedid'];?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_GET['handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>
<div class="c altw mtm mbm">确定删除指定的广播吗?</div>
<p class="o pns">
<button type="submit" name="btnsubmit" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_GET['handlekey'];?>(url, msg, values) {
$('feed_li_'+values.feedid).style.display = 'none';
}
</script>
<?php } include template('common/footer'); ?>