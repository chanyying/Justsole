<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('huodong_index');?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="source/plugin/dz55625_activity/images/body.css" />
<?php if(!$_G['gp_mod']) { ?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<div class="dzactivity cl">

    <div id="pt" class="bm cl" style="width:960px; float:left;">
        <div class="z">
            <a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><em>&raquo;</em><a href="forum.php"<?php if($_G['setting']['forumjump']) { ?> id="fjump" onmouseover="delayShow(this, 'showForummenu(<?php echo $_G['fid'];?>)');" class="showmenu" <?php } ?>><?php echo $_G['setting']['navs']['2']['navname'];?></a><em>&raquo;</em>活动
        </div>
    </div>
    
    <div class="wp cl">
        <div class="dzclass z">
            <ul class="cl">
                <li><strong><a href="<?php echo $appurl;?>">类型</a></strong></li>
                <?php if(is_array($listclass)) foreach($listclass as $k => $v) { ?>                <li><a href="<?php echo $appurl;?>&c=<?php echo $k;?>"<?php echo $av_ds[$k];?>><?php echo $v;?><em>(<?php echo classnum($k); ?>)</em></a></li>
                <?php } ?> 
            </ul>
            <ul class="cl">
           	  	<li><strong><a href="<?php echo $appurl;?>">时间</a></strong></li>
                <?php if(is_array($montharray)) foreach($montharray as $i => $d) { ?>                <li><a href="<?php echo $appurl;?>&s=<?php echo $i;?>"><?php echo date('m月',$d); ?><em>(<?php echo monthnum($i); ?>)</em></a></li>
                <?php } ?>
            </ul> 
            
            <ul class="cl">
           	  	<li><strong><a href="<?php echo $appurl;?>">全部</a></strong></li>
                <li><a href="<?php echo $appurl;?>&types=1">免费活动</a></li>
                <li><a href="<?php echo $appurl;?>&types=2">收费活动</a></li>
<li><a href="<?php echo $appurl;?>&px=d">时间倒序</a></li>
                <li><a href="<?php echo $appurl;?>&types=3">参与人数</a></li>
            </ul>                
        </div>
        <div class="dzadd y">
            <ul>
                <li><a href="plugin.php?id=dz55625_activity:huodong&amp;mod=add" id="addhd">发布活动</a></li>
                <li><a href="plugin.php?id=dz55625_activity:huodong_user" id="adminhd">活动管理</a></li>		
            </ul>
        </div>
    </div>
    
    <div class="dzlists cl">
       <ul>
       <?php if($mythreads) { ?>           
    	  <?php if(is_array($mythreads)) foreach($mythreads as $key => $mythread) { ?>          	<dl>
            	<dt><a href="<?php echo $curl;?><?php echo $mythread['id'];?>"><img src="<?php echo $mythread['img'];?>" width="290" height="180" /><p class="endtime showtime" value="<?php echo $mythread['jtime'];?>"></p></a></dt>
                <dd>
                    <p class="H_title"><a href="<?php echo $curl;?><?php echo $mythread['id'];?>"><?php echo $mythread['title'];?></a></p>
                    <p class="H_sumber">
                    	<strong>活动类型：<?php echo $listclass[$mythread['did']];?></strong>
                    	<span><a><?php echo $mythread['nember'];?></a> 人报名</span>
                        <?php if(($mythread['jtime']-time())>=0) { ?><img src="source/plugin/dz55625_activity/images/jxIco.png" /><?php } else { ?><img src="source/plugin/dz55625_activity/images/jsIco.png" /><?php } ?>
                    </p>
                </dd>
            </dl>
          <?php } ?> 
          <?php } else { ?>
          	<ol>暂无发布任何活动!</ol> 
          <?php } ?> 
       </ul>
    </div>
    <?php echo $multis;?>
<script type="text/javascript">
var jq = jQuery.noConflict(); 
var serverTime = <?php echo time();?> * 1000;
jq(function(){
    var dateTime = new Date();
    var difference = dateTime.getTime() - serverTime;

    setInterval(function(){
      jq(".endtime").each(function(){
        var obj = jq(this);
        var endTime = new Date(parseInt(obj.attr('value')) * 1000);
        var nowTime = new Date();
        var nMS=endTime.getTime() - nowTime.getTime() + difference;
        var myD=Math.floor(nMS/(1000 * 60 * 60 * 24));
        var myH=Math.floor(nMS/(1000*60*60)) % 24;
        var myM=Math.floor(nMS/(1000*60)) % 60;
        var myS=Math.floor(nMS/1000) % 60;
        var myMS=Math.floor(nMS/100) % 10;
        if(myD>= 0){
var str = "剩余时间："+myD+"天"+myH+"小时"+myM+"分"+myS+"."+myMS+"秒";
        }else{
var str = "此活动已结束！";	
}
obj.html(str);
      });
    }, 100);

jq(".dzlists dt a img").each(function(){
var img = jq(this);
img.hover(function(){
img.next().show();
},function(){
img.next().hide();
});
});
});
</script>

</div>


<?php } elseif($_G['gp_mod'] == 'add') { include template('dz55625_activity:huodong_add'); } elseif($_G['gp_mod'] == 'view') { include template('dz55625_activity:huodong_view'); } include template('common/footer'); ?>