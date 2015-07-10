<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');?><?php include template('common/header'); ?><?php echo adshow("text/wp a_t");?><style id="diy_style" type="text/css"></style>
    <style>
.xzss{background-color:#E0E0E0; width:400px; height:30px; border: none; border-bottom:#BBB 2px solid; border-radius:4px;}
.yxss{color:#CACACA; width:130px; height:20px; border: 2px solid  #DDD;}
</style>
    <table width="960px;">
<tr>
   <TD align="left"><font face="微软雅黑" color="#347889" size="+2"><b>学习图谱.小组</b></font></TD>
   <td align="center"><form method="get" action="http://www.justsole.cn/search.php">
        <table><tr><td>
        <input type="hidden" name="mod" value="group" />
         <input type="text" name="srchtxt" id="srchtxt" class="xzss" value="&nbsp;&nbsp;&nbsp;&nbsp;小组、资源、校园、兴趣" style="color:gray;"          onfocus="javascript:if(this.value == '&nbsp;&nbsp;&nbsp;&nbsp;小组、资源、校园、兴趣')          this.value = ''; this.style.color='black';"         onblur="if(this.value == '') {this.value = '&nbsp;&nbsp;&nbsp;&nbsp;小组、资源、校园、兴趣';         this.style.color = 'gray';}">
        </td>
        <td><input type="submit" name="submit" value="Search" style="background-color:#347889;
height:35px; width:60px;
border: 1px solid  #DDD; color:#EEE; cursor:pointer; border-radius:4px;"></td></tr></table>
</form></td>
   <td align="right">
    <a href="forum.php?mod=group&amp;action=create&amp;fupid=<?php echo $fup;?>&amp;groupid=<?php echo $sgid;?>" id="create_group_btn"><div class="pengyoutopan" id="btn">创建小组</div></a>
    <a href="group.php?mod=my"><div class="pengyoutopan" id="btn">我的小组</div></a>
   </td>
</tr>
</table>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div id="ct" class="ct2 wp cl">
<div class="mn">
<!--[diy=diycommendtop]--><div id="diycommendtop" class="area"></div><!--[/diy]-->
<!--[diy=diycategorytop]--><div id="diycategorytop" class="area"></div><!--[/diy]-->
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>

<div class="sd">
<div class="drag">
<!--[diy=diysidetop]--><div id="diysidetop" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_side_top'])) echo $_G['setting']['pluginhooks']['index_side_top'];?>
<?php if(helper_access::check_module('group')) { if(empty($gid) && empty($sgid)) { } else { ?>
<div class="bm bw0">
<div class="bm_c">
<a href="forum.php?mod=group&amp;action=create&amp;fupid=<?php echo $fup;?>&amp;groupid=<?php echo $sgid;?>" id="create_group_btn"><img src="<?php echo IMGDIR;?>/create_group.png" alt="创建<?php echo $_G['setting']['navs']['3']['navname'];?>" /></a>
</div>
</div>
<?php } } ?>
<div class="drag">
<!--[diy=diysidemiddle]--><div id="diysidemiddle" class="area"></div><!--[/diy]-->
</div>
<?php if($topgrouplist) { ?>
<div id="g_top" class="bm" style="margin-top:40px;">
<div class="bm_h cl">
<h2><?php echo $_G['setting']['navs']['3']['navname'];?>积分排行</h2>
</div>
<div class="bm_c">
<ol class="xl"><?php if(is_array($topgrouplist)) foreach($topgrouplist as $fid => $group) { ?><li class="top1"><span class="y xi2 xg1"> <?php echo $group['commoncredits'];?></span><a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" title="<?php echo $group['name'];?>"><?php echo $group['name'];?></a></li>
<?php } ?>
</ol>
</div>
</div>
<?php } ?>
            <div class="bm">
<div class="bm_c" id="xzfl">
                <form method="get" action="http://www.justsole.cn/search.php">
        <table style="margin-right:30px;">
        <tr>
        <td><input type="hidden" name="mod" value="group" />
        <input type="text" name="srchtxt" id="srchtxt" class="yxss" value="小组、资源、校园、兴趣" style="color:gray;"          onfocus="javascript:if(this.value == '小组、资源、校园、兴趣')          this.value = ''; this.style.color='black';"         onblur="if(this.value == '') {this.value = '小组、资源、校园、兴趣';         this.style.color = 'gray';}" /></td>
        <td><input type="submit" name="submit" value="搜索" style="background-color:#5575AA;
height:26px; width:60px;
border: 1px solid  #DDD; color:#EEE; cursor:pointer; border-radius:3px;">
    </td></tr></table>
</form><?php if(is_array($first)) foreach($first as $groupid => $group) { ?><dl >
<dt>
                                &nbsp;<strong ><a href="group.php?gid=<?php echo $groupid;?>"><?php echo $group['name'];?></a></strong><?php if($group['groupnum']) { ?><span class="xg1">(<?php echo $group['groupnum'];?>)</span><?php } ?><br />
                                
<span >
                                    <?php if(is_array($group['secondlist'])) foreach($group['secondlist'] as $fid) { ?>                                    &nbsp;<a href="group.php?sgid=<?php echo $fid;?>"><?php echo $second[$fid]['name'];?></a> 
                                    <?php } ?>
                                    <a href="group.php?gid=<?php echo $groupid;?>">更多</a>
                                    </span>								
</dt>
<dd><?php if(is_array($lastupdategroup[$groupid])) foreach($lastupdategroup[$groupid] as $val) { ?><a href="forum.php?mod=group&amp;fid=<?php echo $val['fid'];?>"><?php echo $val['name'];?></a> &nbsp;&nbsp;
<?php } ?>
</dd>
</dl>
<?php } ?>
</div>
</div>
<div class="drag">
<!--[diy=diysidebottom]--><div id="diysidebottom" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_side_bottom'])) echo $_G['setting']['pluginhooks']['index_side_bottom'];?>
</div>
</div>
<script>
var xztop = jQuery.noConflict();
xztop(function(){
//获取要定位元素距离浏览器顶部的距离
var navH = xztop("#xzfl").offset().top;
//滚动条事件
xztop(window).scroll(function(){
//获取滚动条的滑动距离
var scroH = xztop(this).scrollTop();
//滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
if(scroH>=navH){
xztop("#xzfl").css({"position":"fixed","top":0});
}else if(scroH<navH){
xztop("#xzfl").css({"position":"static"});
}
})
})
</script>
<div class="wp mtn">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
</div><?php include template('common/footer'); ?>