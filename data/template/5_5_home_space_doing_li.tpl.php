<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($list) { ?>
<ul><?php if(is_array($list)) foreach($list as $value) { if($value['uid']) { ?>
<li class="ptn pbn<?php echo $value['class'];?>" style="<?php echo $value['style'];?>">
    <table>
    <tr>
    <td><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>">
        <img src="uc_server/avatar.php?uid=<?php echo $value['uid'];?>&amp;size=small" style="width:31px; height:31px; border-radius:2px;"/></a><!--头像-->
        </td><td><table><tr><td>
        <a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo $value['username'];?></a>: <?php echo $value['message'];?> <!--内容--><?php if($_G['uid'] && helper_access::check_module('doing')) { ?>
<a href="javascript:;" onclick="docomment_form(<?php echo $value['doid'];?>, <?php echo $value['id'];?>, '<?php echo $_GET['key'];?>');">回复</a>
<?php } if($value['uid']==$_G['uid'] || $dv['uid']==$_G['uid'] || checkperm('managedoing')) { ?>
 <a href="home.php?mod=spacecp&amp;ac=doing&amp;op=delete&amp;doid=<?php echo $value['doid'];?>&amp;id=<?php echo $value['id'];?>&amp;handlekey=doinghk_<?php echo $value['doid'];?>_<?php echo $value['id'];?>" id="<?php echo $_GET['key'];?>_doing_delete_<?php echo $value['doid'];?>_<?php echo $value['id'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<?php } ?><!--删除  回复--></td></tr>
        <tr><td>
        <span class="xg1">(<?php echo dgmdate($value['dateline'], 'n-j H:i');?>)</span><!--时间--></td>
        </tr>
        </table>
        </td></tr>
        </table>

       

<div id="<?php echo $_GET['key'];?>_form_<?php echo $value['doid'];?>_<?php echo $value['id'];?>"></div>
</li>
<?php } } ?>
</ul>
<?php } ?>
<div class="tri"></div>