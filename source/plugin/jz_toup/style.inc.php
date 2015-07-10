<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
	$echo.='<style type="text/css">
	.demo li {display:inline-block;margin:25px;}
	#toup{background:url(source/plugin/jz_toup/img/tm.png) 20px no-repeat #000;height:64px;width:64px;display:block;opacity:0.6;filter:alpha(opacity=60);}#toup:hover{opacity:1;filter:alpha(opacity=100);}
	#toup2{background:url(source/plugin/jz_toup/img/tm.png) -24px no-repeat #fff;height:64px;width:64px;display:block;opacity:0.6;filter:alpha(opacity=60);}#toup2:hover{opacity:1;filter:alpha(opacity=100);}
	#toup3{background:url(source/plugin/jz_toup/img/rocket.png) no-repeat 50% 0px;height:85px;display:block;width:35px;}
	#toup4{background:#fff;border-radius:5px;box-shadow:0px 0px 2px #6e6e6e;overflow:hidden;width:47px;height:106px;}#toup4 a{width:47px;margin:5px;display:block;background:url(source/plugin/jz_toup/img/qqm.png);}#toup4 .toup{background-position:0px -1px;height:22px;}#toup4 .feedback{background-position:0px -22px;height:32px;}#toup4 .bottom{background-position:0px -55px;height:22px;}#toup4 .toup:hover{background-position:-38px -1px;height:22px;}#toup4 .feedback:hover{background-position:-38px -22px;height:32px;}#toup4 .bottom:hover{background-position:-38px -55px;height:22px;}
	#toup5{background:#fff;bottom:25%;margin-left:-15px;width:180px;overflow:hidden;}#toup5 .silder{background:#fff;padding:10px;display:block;}#toup5 .uppanel a{width:49%;color:#000;padding:10px 0;display:inline-block;text-align:center;}
	#toup6{background:#000;width:180px;overflow:hidden;}#toup6 .silder{background:#000;padding:10px;display:block;}#toup6 .uppanel a{width:49%;padding:10px 0;display:inline-block;color:#fff;text-align:center;}
	#toup7{background:url(source/plugin/jz_toup/img/bdtb.gif) no-repeat;height:83px;display:block;width:23px;}#toup7:hover{background-position:-23px;}
	#toup8{background:url(source/plugin/jz_toup/img/moji.png) no-repeat;height:165px;display:block;width:32px;}
	#toup9{background:url(source/plugin/jz_toup/img/bdtp.png) no-repeat;height:35px;display:block;width:35px;}#toup9:hover{background-position:-42px 0px;}
	#toup10{background:url(source/plugin/jz_toup/img/bq.png) no-repeat;height:70px;display:block;width:70px;}#toup10:hover{background-position:-70px 0px;}
	#toup11{background:url(source/plugin/jz_toup/img/mb.png) no-repeat;height:75px;display:block;width:76px;}#toup11:hover{background-position:0px -75px;}
	#toup12{width:180px;} #toup12 .silde,#toup12 .silde img{background:#000;}#toup12 .toup{margin-left:40%;background:url(source/plugin/jz_toup/img/xht.gif) no-repeat;height:75px;display:block;width:76px;}
	#toup13{background:url(source/plugin/jz_toup/img/qzone.png) no-repeat;height:41px;display:block;width:52px;}#toup13:hover{background-position:-52px 0px;}
	#toup14{background:url(source/plugin/jz_toup/img/e.png) no-repeat;height:99px;display:block;width:15px;}#toup14:hover{background-position:-18px 0px;}
	#toup15{background:url(source/plugin/jz_toup/img/hq.gif) no-repeat;height:45px;display:block;width:35px;}
	#toup16{background:url(source/plugin/jz_toup/img/zw.png) no-repeat;height:100px;display:block;width:30px;}
	#toup17{background:url(source/plugin/jz_toup/img/e.gif) no-repeat;height:28px;display:block;width:56px;}
	#toup18{background:url(source/plugin/jz_toup/img/lan.gif) no-repeat;height:114px;display:block;width:67px;}
	#toup19{background:url(source/plugin/jz_toup/img/rqq.png) no-repeat;height:72px;display:block;width:44px;}
	#toup20{background:url(source/plugin/jz_toup/img/csdn.png) no-repeat;height:49px;display:block;width:48px;}#toup20:hover{background-position:-48px 0;}
	</style>
	<div class="demo">
	<li>1、天猫-黑<br/><a id="toup"></a></li>
	<li>2、天猫-白<a id="toup2"></a></li>
	<li>3、火箭样式<a id="toup3"></a></li>
	<li>4、QQ音乐<div id="toup4"><a class="toup"></a><a class="feedback"></a><a class="bottom"></a></li>
	<li>5、糗事百科-白<div id="toup5"><a class="silder"><img src=""></img></a><div class="uppanel"><a style="border-right:1px solid #ccc;">&#36820;&#22238;&#39030;&#37096;</a><a>&#24847;&#35265;&#24314;&#35758;</a></div></li>
	<li>6、糗事百科-黑<div id="toup6"><a class="silder"><img src=""></img></a><div class="uppanel"><a style="border-right:1px solid #ccc;">&#36820;&#22238;&#39030;&#37096;</a><a>&#24847;&#35265;&#24314;&#35758;</a></div></li>
	<li>7、百度贴吧样式<a id="toup7"></a></li>
	<li>8、中文墨迹<a id="toup8"></a></li>
	<li>9、百度贴吧<a id="toup9"></a></li>
	<li>10、标签<a id="toup10"></a></li>
	<li>11、木板<a id="toup11"></a></li>
	<li>12、小黑条</style><div id="toup12"><a class="silde"><img src=""></img></a><div><a class="toup"></a></div></div></li>
	<li>13、QQ空间<a id="toup13"></a></li>
	<li>14、简约英文<a id="toup14"></a></li>
	<li>15、小灰球<a id="toup15"></a></li>
	<li>16、简约中文<a id="toup16"></a></li>
	<li>17、英文墨迹<a id="toup17"></a></li>
	<li>18、经典蓝色<a id="toup18"></a></li>
	<li>19、热气球<a id="toup19"></a></li>
	<li>20、CSDN博客<a id="toup20"></a></li>
	
	</div>';
	$echo.=iconv("GBK",$_G['charset'],$content);
	echo $echo;
?>