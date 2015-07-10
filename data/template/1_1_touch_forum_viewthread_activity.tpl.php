<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="mbn">
<?php if($activity['thumb']) { ?><img src="<?php echo $activity['thumb'];?>" width="<?php if($activity['width'] > 230) { ?>230<?php } else { ?><?php echo $activity['width'];?><?php } ?>" /><?php } else { ?><img src="<?php echo IMGDIR;?>/nophoto.gif" width="230" height="230" /><?php } ?>
<dl>
<dt>活动类型: <strong><?php echo $activity['class'];?></strong></dt>
<dt>开始时间:
<?php if($activity['starttimeto']) { ?>
<?php echo $activity['starttimefrom'];?> 至 <?php echo $activity['starttimeto'];?> 商定
<?php } else { ?>
<?php echo $activity['starttimefrom'];?>
<?php } ?>
</dt>
<dt>活动地点: <?php echo $activity['place'];?></dt>
<dt>性别:
<?php if($activity['gender'] == 1) { ?>
男
<?php } elseif($activity['gender'] == 2) { ?>
女
<?php } else { ?>
 不限
<?php } ?>
</dt>
<?php if($activity['cost']) { ?>
<dt>每人花销: <?php echo $activity['cost'];?> 元</dt>
<?php } ?>
</dl>
<?php if(!$_G['forum_thread']['is_archived']) { ?>
<dl class="mtn">
<dt>已报名人数:
<em><?php echo $allapplynum;?></em> 人
<?php if($post['invisible'] == 0 && ($_G['forum_thread']['authorid'] == $_G['uid'] || (in_array($_G['group']['radminid'], array(1, 2)) && $_G['group']['alloweditactivity']) || ( $_G['group']['radminid'] == 3 && $_G['forum']['ismoderator'] && $_G['group']['alloweditactivity']))) { ?>
<span class="xi1">请您使用非手机版管理活动</span>
<?php } ?>
</dt>
</dl>
<dl>
<?php if($activity['number']) { ?>
<dt>剩余名额:
<?php echo $aboutmembers;?> 人
</dt>
<?php } if($activity['expiration']) { ?>
<dt>报名截止: <?php echo $activity['expiration'];?></dt>
<?php } ?>
<dt>
<?php if($post['invisible'] == 0) { if($applied && $isverified < 2) { ?>
<p class="xg1 xs1"><?php if(!$isverified) { ?>您的加入申请已发出，请等待发起者审批<?php } else { ?>您已经参加了此活动<?php } ?></p>
<?php if(!$activityclose) { ?>
                        <?php } } elseif(!$activityclose) { ?>
                        <?php if($isverified != 2) { ?>
                        <?php } else { ?>
                        <p class="pns mtn">
                            <input value="完善资料" name="ijoin" id="ijoin" />
                        </p>
                        <?php } } } ?>
</dt>
</dl>
<?php } ?>
</div>

<div id="postmessage_<?php echo $post['pid'];?>" class="postmessage"><?php echo $post['message'];?></div>


<?php if($_G['uid'] && !$activityclose && (!$applied || $isverified == 2)) { ?>
<div id="activityjoin" class="bm mtn">
    	<div class="bm_c pd5">
        <div class="xw1">我要参加</div>
<?php if($_G['forum']['status'] == 3 && helper_access::check_module('group') && $isgroupuser != 'isgroupuser') { ?>
        <p>您还不是本 <?php echo $_G['setting']['navs']['3']['navname'];?> 的成员不能参与此活动</p>
        <p><a href="forum.php?mod=group&amp;action=join&amp;fid=<?php echo $_G['fid'];?>" class="xi2">点此处马上加入 <?php echo $_G['setting']['navs']['3']['navname'];?></a></p>
<?php } else { ?>
<form name="activity" id="activity" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=activityapplies&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_GET['from']) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>&amp;mobile=2" >
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />

<?php if($_G['setting']['activitycredit'] && $activity['credit'] && !$applied) { ?><p class="xi1">注意：参加此活动将扣除您 <?php echo $activity['credit'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['activitycredit']]['title'];?></p><?php } ?>
                <?php if($activity['cost']) { ?>
                   <p>支付方式 <label><input class="pr" type="radio" value="0" name="payment" id="payment_0" checked="checked" />承担自己应付的花销</label> <label><input class="pr" type="radio" value="1" name="payment" id="payment_1" />支付 </label> <input name="payvalue" size="3" class="txt_s" /> 元</p>
                <?php } ?>
                <?php if(!empty($activity['ufield']['userfield'])) { ?>
                    <?php if(is_array($activity['ufield']['userfield'])) foreach($activity['ufield']['userfield'] as $fieldid) { ?>                    <?php if($settings[$fieldid]['available']) { ?>
                        <strong><?php echo $settings[$fieldid]['title'];?><span class="xi1">*</span></strong>
                        <?php echo $htmls[$fieldid];?>
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php if(!empty($activity['ufield']['extfield'])) { ?>
                    <?php if(is_array($activity['ufield']['extfield'])) foreach($activity['ufield']['extfield'] as $extname) { ?>                        <?php echo $extname;?><input type="text" name="<?php echo $extname;?>" maxlength="200" class="txt" value="<?php if(!empty($ufielddata)) { ?><?php echo $ufielddata['extfield'][$extname];?><?php } ?>" />
                    <?php } ?>
                <?php } ?>
            留言<textarea name="message" maxlength="200" cols="28" rows="1" class="txt"><?php echo $applyinfo['message'];?></textarea>
<div class="o pns">
<?php if($_G['setting']['activitycredit'] && $activity['credit'] && checklowerlimit(array('extcredits'.$_G['setting']['activitycredit'] => '-'.$activity['credit']), $_G['uid'], 1, 0, 1) !== true) { ?>
<p class="xi1"><?php echo $_G['setting']['extcredits'][$_G['setting']['activitycredit']]['title'];?> 不足<?php echo $activity['credit'];?></p>
<?php } else { ?>
<input type="hidden" name="activitysubmit" value="true">
<em class="xi1" id="return_activityapplies"></em>
<button type="submit" ><span>提交</span></button>
<?php } ?>
</div>
</form>

<script type="text/javascript">
function succeedhandle_activityapplies(locationhref, message) {
showDialog(message, 'notice', '', 'location.href="' + locationhref + '"');
}
</script>
<?php } ?>
    	</div>
</div>
<?php } elseif($_G['uid'] && !$activityclose && $applied) { ?>
<div id="activityjoincancel" class="bm mtn">
<div class="bm_c pd5">
        <div class="xw1">取消报名</div>
        <form name="activity" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=activityapplies&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_GET['from']) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>">
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <p>
            留言<input type="text" name="message" maxlength="200" class="px" value="" />
        </p>
        <p class="mtn">
        <button type="submit" name="activitycancel"  value="true"><span>提交</span></button>
        </p>
        </form>
    </div>
</div>
<?php } if($applylist) { ?>
<div class="bm ptn pbn xs1">
<div class="bm_c">
    <p class="pd5">已通过 (<?php echo $applynumbers;?> 人)</p>
    <table class="dt" cellpadding="5" cellspacing="5">
        <tr>
            <th >&nbsp;</th>
            <?php if($activity['cost']) { ?>
            <th >每人花销</th>
            <?php } ?>
            <th>申请时间</th>
        </tr>
        <?php if(is_array($applylist)) foreach($applylist as $apply) { ?>            <tr>
                <td>
                    <a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $apply['uid'];?>"><?php echo $apply['username'];?></a>
                </td>
                <?php if($activity['cost']) { ?>
                <td><?php if($apply['payment'] >= 0) { ?><?php echo $apply['payment'];?> 元<?php } else { ?>自付<?php } ?></td>
                <?php } ?>
                <td><?php echo $apply['dateline'];?></td>
            </tr>
        <?php } ?>
    </table>
    </div>
</div>
<?php } ?>
