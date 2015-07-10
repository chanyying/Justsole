<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('showmessage');?><?php include template('common/header'); ?><p><?php echo str_replace('&amp;amp;', '&amp;', str_replace('&', '&amp;', $show_message));; ?></p>
        <?php if($_G['forcemobilemessage']) { ?>
        	<p >
                <prev>返回上一页</prev>
            </p>
        <?php } if($url_forward) { ?>
<p><a href="<?php echo $url_forward;?>">点击此链接进行跳转</a></p>
<?php } elseif($allowreturn) { ?>
<p><prev>[ 点击这里返回上一页 ]</prev></p>
<?php } include template('common/footer'); ?>