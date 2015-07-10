<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<div class="dzactivity cl">

<div id="pt" class="bm cl">
    <div class="z">
        <a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><em>&raquo;</em><a href="forum.php"<?php if($_G['setting']['forumjump']) { ?> id="fjump" onmouseover="delayShow(this, 'showForummenu(<?php echo $_G['fid'];?>)');" class="showmenu" <?php } ?>><?php echo $_G['setting']['navs']['2']['navname'];?></a><em>&raquo;</em><a href="plugin.php?id=dz55625_activity:huodong">活动</a><em>&raquo;</em>活动信息
    </div>
</div>
    
<div class="view_top"><?php if(is_array($mythreads)) foreach($mythreads as $mythread) { ?><div id="viewTleft">
    	<div id="viewls">
        	<h2>已报名 <?php echo $mythread['nember'];?> 人</h2>
            <h3><img src="<?php echo $mythread['img'];?>"></h3>
            <dl>
                <dt><?php echo $mythread['title'];?></dt>
                <dd>
                    <p><strong>活动类型：</strong><?php echo $listclass[$mythread['did']];?></p>
                    <p><strong>活动地点：</strong><?php echo $mythread['address'];?></p>
                    <p><strong>活动热线：</strong><?php echo $mythread['tel'];?></p>
                    <p><strong>发起会员：</strong><?php echo $mythread['author'];?></p>
                    <p><strong>活动时间：</strong><?php echo date('Y-m-d H:i',$mythread['ktime']); ?> - <?php echo date('Y-m-d H:i',$mythread['jtime']); ?></p>
                    <p><strong>剩余时间：</strong><span class="endtime" value="<?php echo $mythread['jtime'];?>"></span></p>
                    
                </dd>
            </dl>
        </div>
        
        <div id="viewlx">
        <ul>
        <DIV class=bshare-custom><A class=bshare-qzone href="javascript:void(0);"></A><A class=bshare-sinaminiblog href="javascript:void(0);"></A><A class=bshare-renren href="javascript:void(0);"></A><A class=bshare-qqmb href="javascript:void(0);"></A><A class=bshare-douban href="javascript:void(0);"></A><A class=bshare-qqxiaoyou href="javascript:void(0);"></A><A class=bshare-qqshuqian href="javascript:void(0);"></A><A class=bshare-itieba href="javascript:void(0);"></A><A class=bshare-51 href="javascript:void(0);"></A><A class=bshare-tianya href="javascript:void(0);"></A><A class=bshare-sohuminiblog href="javascript:void(0);"></A><A class=bshare-neteasemb href="javascript:void(0);"></A><A class=bshare-kaixin001 href="javascript:void(0);"></A><A class="bshare-more bshare-more-icon more-style-sharethis" buttonIndex="0"></A><SPAN class="BSHARE_COUNT bshare-share-count">0</SPAN></DIV>
<script src="http://static.bshare.cn/b/buttonLite.js#style=-1&uuid=fba4e86d-5fec-4493-b554-d7b3b4736eb4&pophcol=2&lang=zh" type="text/javascript"></script>
<script src="http://static.bshare.cn/b/bshareC0.js" type="text/javascript"></script>
        </ul>
        <dl><a onclick="showDialog('为此活动送上鲜花<br />此操作会消耗您 <?php echo $set['credit'];?> <?php echo $person['extcredits'][$set['extcredit']]['title'];?>', 'confirm', '确认操作', function () { window.location.href='plugin.php?id=dz55625_activity:huodong&mod=view&option=xianhua&vid=<?php echo $mythread['id'];?>'; return false; })" id="xianhua">鲜花(<?php echo $mythread['xianhua'];?>)</a>&nbsp;<a onclick="showDialog('对此活动不满意,希望下次继续努力<br />此操作会消耗您 <?php echo $set['credit'];?> <?php echo $person['extcredits'][$set['extcredit']]['title'];?>', 'confirm', '确认操作', function () { window.location.href='plugin.php?id=dz55625_activity:huodong&mod=view&option=jidan&vid=<?php echo $mythread['id'];?>'; return false; })" id="jidan">鸡蛋(<?php echo $mythread['jidan'];?>)</a></dl>
        </div>
    </div>
    
     <div id="mingdan">
     <table width="100%">
     <tr class="headers">
       <td>会员名称</td><td>联系电话</td><td>联系QQ</td><td>报名时间</td><td>查看</td>
     </tr>
     <?php if(is_array($baomings)) foreach($baomings as $baoming) { ?>      <tr class="hover">
        <td><?php echo $baoming['author'];?></td>
        <?php if($mythread['author'] != $_G['username']) { ?>
        	<td><?php echo $baoming['tels'];?></td>
            <td><?php echo $baoming['qicq'];?></td>
        <?php } else { ?>
        	<td><?php echo $baoming['telx'];?></td>
            <td><?php echo $baoming['qicx'];?></td>
        <?php } ?>
       
        <td><?php echo $baoming['dateline'];?></td>
        <td><?php if($mythread['uid'] == $_G['uid']) { ?>
        	<a href="javascript:;" onclick="showWindow('rchakan', 'plugin.php?id=dz55625_activity:huodong_bm&option=rchakan&sid=<?php echo $baoming['id'];?>', 'get', 0)" class="xi3" style="color:#06F">+详情+</a>
        <?php } else { ?>
        	<a onclick="showDialog('抱歉!只有活动的发布者才可以查看详细信息！', 'alert', '提示信息'); return false;" href="javascript:;" style="color:#06F">+详情+</a>
        <?php } ?></td>
      </tr>
      <?php } ?>
</table>
    </div>
    
    
<div id="viewTright">
    	<?php echo $mythread['summary'];?>
    </div>
   
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
var str = myD+"天"+myH+"小时"+myM+"分"+myS+"."+myMS+"秒";
        }else{
var str = "此活动已结束！";	
}
obj.html(str);
      });
    }, 100);

});
</script>


    

 <?php } ?> 
 

      
</div>

<div class="view_bot"><?php if(is_array($mythreads)) foreach($mythreads as $mythread) { ?>    <div id="viewBleft">
         <h3><em><?php if($mythread['cost']=='0') { ?>免费<?php } else { ?>��<?php echo $mythread['cost'];?><?php } ?></em><span><a href="javascript:;" onclick="showWindow('baoming', 'plugin.php?id=dz55625_activity:huodong_bm&option=baoming&vid=<?php echo $mythread['id'];?>', 'get', 0)" class="xi3">报名</a></span></h3>
         
         
         <h2></h2>
    <ul>
    <?php if($mythread['nember']!='0') { ?>
   		 <?php $i = 0?>        <?php if(is_array($baomings)) foreach($baomings as $baoming) { ?>         		<?php if($i >= 4) { ?> 
                <?php break;?>                <?php } ?>
            <li class="cl">
            	<p class="userico"><img src="<?php echo $uc;?>/avatar.php?uid=<?php echo $baoming['uid'];?>&size=small" /></p>
            	<p class="username">
                	<strong><?php echo $baoming['author'];?></strong>
            		<span><?php echo $baoming['dateline'];?></span>
                </p>
            </li>
             <?php $i++;?>        <?php } ?>
       

       <?php } else { ?> 
       		<li>还没有人报名喔~</li>
       <?php } ?>
    </ul>
    </div>
    <div id="viewBright">
        <ul>
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" type="text/javascript"></script>
       	<div id="mapCanvas">地图正在加载中...</div>
        </ul>
    </div>
    
   
        <script type="text/javascript"> 
var geocoder = new google.maps.Geocoder();
function initialize() {
  var mapxy = '<?php echo $mythread['mapx'];?>';
xyarr=mapxy.split(",");
  var latLng = new google.maps.LatLng(xyarr[0], xyarr[1]);
  var map = new google.maps.Map($('mapCanvas'), {
    zoom: <?php echo $mythread['mapy'];?>,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: '',
    map: map,
    draggable: false
  });
   google.maps.event.addListener(map, 'zoom_changed', function() {
    zoomLevel = map.getZoom();
    map.setCenter(latLng);
    //infowindow.setContent("Zoom: " + zoomLevel);
    if (zoomLevel == 0) {
      map.setZoom(<?php echo $mythread['mapy'];?>);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php } ?>   
</div>

</div>

