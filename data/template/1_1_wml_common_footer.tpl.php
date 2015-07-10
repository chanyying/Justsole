<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
		<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?>
<p>
<?php if(CURMODULE !== 'index') { ?>
<anchor title="confirm"><prev/>返回</anchor> <a href="forum.php">首页</a><br />
<?php } if($_G['uid']) { ?>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><?php echo $_G['username'];?>:退出</a>
<?php } else { ?>
<a href="member.php?mod=logging&amp;action=login">登录</a> <a href="member.php?mod=register">注册</a><br /><br />
<?php } ?>
<br/><br/>
<em>极简版</em>|<a href="forum.php?mobile=1">标准版</a><br/>
<small>Powered by Discuz!</small>
</p>
</card>
</wml><?php updatesession();?><?php output();?>