<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$return = <<<EOF


EOF;
 if($_G['basescript'] != 'userapp') { 
$return .= <<<EOF

<style type="text/css"> 
#scrolltop {
   display: none;
}
ul#navmenu ul
{ 
display: none; 
position: absolute; 
left: -233px;
bottom: 5px;
} 
ul#navmenu li:hover ul ul, 
ul#navmenu li.iehover ul ul,  { 
display: none; 
} 
ul#navmenu li:hover ul, 
ul#navmenu ul li:hover ul, 
ul#navmenu ul ul li:hover ul, 
ul#navmenu li.iehover ul, 
ul#navmenu ul li.iehover ul, 
ul#navmenu ul ul li.iehover ul { 
display: block; 
} 

EOF;
 if($this->jz52_temp != 5 && $this->jz52_temp != 7) { 
$return .= <<<EOF

#jz52top a {margin: 6px 0;}

EOF;
 } if($this->jz52_thew == 1) { 
$return .= <<<EOF

#jz52top { visibility: visible; right: 10px; }

EOF;
 } else { 
$return .= <<<EOF

#jz52top { z-index: 960; visibility: visible; right: 50%; margin-right: -{$jz52w}px; }

EOF;
 } 
$return .= <<<EOF

#jz52topa { visibility: hidden;}

#jz52top, #jz52top a { border: none;}

#jz52top { position: fixed; bottom: 40px; display: block; width: 40px; background: none repeat scroll 0% 0% transparent; border: 0px #cdcdcd solid; border-radius: 3px; border-top: 0; cursor: pointer; }
#jz52top:hover { text-decoration: none; }

EOF;
 if($this->jz52_temp == 1) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #f8f8f8 url('source/plugin/jz52_top/template/jz52top1.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 2) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #00a398 url('source/plugin/jz52_top/template/jz52top.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 3) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #7f7f7f url('source/plugin/jz52_top/template/jz52top2.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 4) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #7f7f7f url('source/plugin/jz52_top/template/jz52top3.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 5) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('source/plugin/jz52_top/template/jz52top4.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 6) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('source/plugin/jz52_top/template/jz52top5.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 7) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('source/plugin/jz52_top/template/jz52top6.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 8) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('source/plugin/jz52_top/template/jz52top7.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } 
$return .= <<<EOF

                a.jz52topa:hover { background-position: -40px 0px !important;}
a.replyfast { background-position: 0 -40px !important; }
a.replyfast:hover { background-position: -40px -40px !important;}
a.returnlist { background-position: 0 -80px !important; }
a.returnlist:hover { background-position: -40px -80px !important;}
a.returnboard { background-position: -80px -240px !important; }
a.returnboard:hover { background-position: -120px -240px !important;}
a.jzqr { background-position: 0 -120px !important; }
a.jzqr:hover { background-position: -40px -120px !important;}
                a.jzwx { background-position: 0 -320px !important; }
a.jzwx:hover { background-position: -40px -320px !important;}					
a.jzkf { background-position: -80px 0px !important; }
a.jzkf:hover { background-position: -120px -0px !important;}
a.jzfx { background-position: -80px -40px !important; }
a.jzfx:hover { background-position: -120px -40px !important;}
.jzfxn { background: #fff !important; width: 231px !important; height: 260px !important; }
a.jzlast { background-position: -80px -80px !important; }
a.jzlast:hover { background-position: -120px -80px !important;}
a.jznext { background-position: -80px -120px !important; }
a.jznext:hover { background-position: -120px -120px !important;}				
a.jzsct { background-position: 0px -160px !important; }
a.jzsct:hover { background-position: -40px -160px !important;}				
a.jzscb { background-position: -80px -160px !important; }
a.jzscb:hover { background-position: -120px -160px !important;}				
a.jzqqq { background-position: 0px -200px !important; }
a.jzqqq:hover { background-position: -40px -200px !important;}				
a.jzwo { background-position: -80px -200px !important; }
a.jzwo:hover { background-position: -120px -200px !important;}
a.jzzdy { background-position: 0px -240px !important; }
a.jzzdy:hover { background-position: -40px -240px !important;}
a.jzfbzt { background-position: 0px -280px !important; }
a.jzfbzt:hover { background-position: -40px -280px !important;}

#jzqrn { background: #fff !important; width: 231px !important; height: 260px !important; }
#jzqrn { border: 1px solid rgb(210, 210, 210); }
#jzqrn p {
    font-size: 15px;
    padding-bottom: 15px;
    text-align: center;
color: #999;
    font-family: Microsoft YaHei;
}
#jzwon { background: #fff !important; width: 231px !important; height: 260px !important; }
#jzwon { border: 1px solid rgb(210, 210, 210); }
#jzfxn { border: 1px solid rgb(210, 210, 210); }
#jzfxn h3 {
    height: 23px;
    background: none repeat scroll 0% 0% rgb(250, 250, 250);
    border-bottom: 1px solid rgb(236, 236, 236);
    padding: 10px 0px 0px 10px;
}
#jzfxn .bdsharebuttonbox { padding: 13px 0px 0px 20px; }
#jzfxn .bdsharebuttonbox a, #jzfxn .bdsharebuttonbox .bds_more {
    float: left;
    font-size: 12px;
    padding-left: 25px;
    line-height: 16px;
text-align: left;
    height: 16px;
    background: url("http://bdimg.share.baidu.com/static/api/img/share/icons_1_16.png?v=01d441d0.png") no-repeat scroll 0px 0px ;
    background-repeat: no-repeat;
    cursor: pointer;
    margin: 6px 6px 6px 0px;
text-indent: 0;
    overflow: hidden;
width: 68px;
}
#jzfxn .bdsharebuttonbox .bds_qzone {
    background-position: 0px -52px !important;
}
#jzfxn .bdsharebuttonbox .bds_tsina {
    background-position: 0px -104px !important;
}
#jzfxn .bdsharebuttonbox .bds_tqq {
    background-position: 0px -260px !important;
}
#jzfxn .bdsharebuttonbox .bds_renren {
    background-position: 0px -208px !important;
}
#jzfxn .bdsharebuttonbox .bds_tqf {
    background-position: 0px -364px !important;
}
#jzfxn .bdsharebuttonbox .bds_tieba {
    background-position: 0px -728px !important;
}
#jzfxn .bdsharebuttonbox .bds_sqq {
    background-position: 0px -2652px !important;
}
#jzfxn .bdsharebuttonbox .bds_hi {
    background-position: 0px -416px !important;
}
#jzfxn .bdsharebuttonbox .bds_isohu {
    background-position: 0px -3016px !important;
}
#jzfxn .bdsharebuttonbox .bds_weixin {
    background-position: 0px -1612px !important;
}
#jzfxn .bdsharebuttonbox .bds_t163 {
    background-position: 0px -832px !important;
}
#jzfxn .bdsharebuttonbox .bds_tsohu {
    background-position: 0px -520px !important;
}
#jzfxn .bdsharebuttonbox .bds_baidu {
    background-position: 0px -2600px !important;
}
#jzfxn .bdsharebuttonbox .bds_qq {
    background-position: 0px -624px !important;
}
#jz52top a b {
    visibility: hidden;
    font-weight: normal;
}
</style> 

<script type="text/javascript"> 
// JavaScript Document
function goTopEx(){
        var obj=document.getElementById("goTopBtn");
        function getScrollTop(){
                return document.documentElement.scrollTop || document.body.scrollTop;
            }
        function setScrollTop(value){
            if(document.documentElement.scrollTop){
                    document.documentElement.scrollTop=value;
                }else{
                    document.body.scrollTop=value;
                }
                
            }    
        window.onscroll=function(){getScrollTop()>0?obj.style.display="":obj.style.display="none";
                    var h=document.body.scrollHeight - getScrollTop() - obj.offsetTop - obj.offsetHeight;
                    obj.style.bottom=0+"px";
                    if(h<350){
                        obj.style.bottom=340+"px";
                        obj.style.top="auto";
                    }

        
        }
        obj.onclick=function(){

            var goTop=setInterval(scrollMove,10);
            function scrollMove(){
                    setScrollTop(getScrollTop()/1.1);
                    if(getScrollTop()<1)clearInterval(goTop);

                }
        }
    }

</script> 

<div id="jz52top" >
    <span>
<DIV style="DISPLAY: none" id="goTopBtn" ><a title="返回顶部" class="jz52topa" ><b>返回顶部</b></a></DIV>
</span>
    <SCRIPT type=text/javascript>goTopEx();</SCRIPT>


EOF;
 if($this->jz52_fbztkg == 1) { 
$return .= <<<EOF

    
EOF;
 if($_G['fid'] && $_G['mod'] == 'viewthread' || $_G['mod'] == 'forumdisplay' ) { if(!$_GET['archiveid']) { 
$return .= <<<EOF

<span>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid={$_G['fid']}" class="jzfbzt" title="发布主题"><b>发布主题</b></a>
</span>

EOF;
 } } else { 
$return .= <<<EOF

<span><a class="jzfbzt" href="forum.php?mod=misc&amp;action=nav" title="发布主题" onclick="showWindow('nav', this.href, 'get', 0)" ><b>发布主题</b></a></span>	

EOF;
 } } if($_G['fid'] && $_G['mod'] == 'viewthread') { if($this->jz52_ln == 1) { 
$return .= <<<EOF

<span><a class="jzlast" href="forum.php?mod=redirect&amp;goto=nextoldset&amp;tid={$_G['tid']}" title="上个主题" ><b>上个主题</b></a></span>	
<span><a class="jznext" href="forum.php?mod=redirect&amp;goto=nextnewset&amp;tid={$_G['tid']}" title="下个主题" ><b>下个主题</b></a></span>

EOF;
 } 
$return .= <<<EOF

<span><a href="forum.php?mod=post&amp;action=reply&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;extra={$_GET['extra']}&amp;page={$page}
EOF;
 if($_GET['from']) { 
$return .= <<<EOF
&amp;from={$_GET['from']}
EOF;
 } 
$return .= <<<EOF
" onclick="showWindow('reply', this.href)" class="replyfast" title="快速回复"><b>快速回复</b></a></span>	

EOF;
 if($this->jz52_sctz == 1) { 
$return .= <<<EOF

<span><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id={$_G['tid']}&amp;formhash={$__FORMHASH}" id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' 人已收藏'" title="!fav_thread!" class="jzsct" ><b>收藏帖子</b></a></span>

EOF;
 } } 
$return .= <<<EOF
	

EOF;
 if($_G['fid']) { if($_G['mod'] == 'viewthread') { 
$return .= <<<EOF

<span>		
<a href="forum.php?mod=forumdisplay&amp;fid={$_G['fid']}" hidefocus="true" class="returnlist" title="返回列表"><b>返回列表</b></a>
</span>	

EOF;
 } else { 
$return .= <<<EOF

<span>	
<a  href="forum.php" hidefocus="true" class="returnboard" title="返回首页"><b>返回首页</b></a>
</span>
    
EOF;
 if($this->jz52_scbk == 1 && CURMODULE!='group') { 
$return .= <<<EOF

<span><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id={$_G['fid']}&amp;handlekey=favoriteforum&amp;formhash={$__FORMHASH}" id="a_favorite" title="收藏板块"  class="jzscb" onclick="showWindow(this.id, this.href, 'get', 0);"><b>收藏板块</b></a></span>
    
EOF;
 } } } if($this->jz52_kf == 1) { 
$return .= <<<EOF

    <span><a href="{$this->jz52_kfurl}" title="联系我们" class="jzkf" target="_blank" ><b>联系我们</b></a></span>
    
EOF;
 } if($this->jz52_qqqan == 1) { 
$return .= <<<EOF

    <span><a rel="nofollow" title="官方QQ群" class="jzqqq" href="javascript:;" onclick="showWindow('qqgroup','plugin.php?id=jz52_top:qqgroup')"><b>官方QQ群</b></a></span>	
    
EOF;
 } 
$return .= <<<EOF

    
EOF;
 if($this->jz52_zdy == 1) { 
$return .= <<<EOF

    <span>{$this->jz52_zdybt}</span>	

EOF;
 } if($this->jz52_fenxiang == 1) { 
$return .= <<<EOF

<span><ul id="navmenu"> <li><a title="分享"  class="jzfx" ><b>分享</b></a> <ul> <div class="jzfxn" id="jzfxn">
{$this->jz52_fenxidm}
</div> </ul></li></ul> </span>
    
EOF;
 } if($this->jz52_gzwx == 1) { 
$return .= <<<EOF

<span><ul id="navmenu"> <li><a title="关注微信"  class="jzwx" href="javascript:void(0)"><b>关注微信</b></a> <ul> <div id="jzqrn">
{$this->jz52_gzwxdm}
</div> </ul></li></ul> </span>	
    
EOF;
 } 
$return .= <<<EOF
	

EOF;
 if($this->jz52_qr == 1) { 
$return .= <<<EOF

<span><ul id="navmenu"> <li><a title="QR Code"  class="jzqr" href="forum.php?mobile=yes"><b>QR Code</b></a> <ul> <div id="jzqrn">
{$this->jz52_qrimg}
</div> </ul></li></ul> </span>	
    
EOF;
 } if($this->jz52_grzx == 1) { 
$return .= <<<EOF

<span>
<ul id="navmenu"> 
<li><a title="个人中心" class="jzwo" ><b>个人中心</b></a> 

<ul> <div id="jzwon">

<style type="text/css">

#jzgrzxkp {
height: 260px;
width: 231px;
background:#f2f6f8 ;
font-family: Microsoft YaHei;
}

#jzgrzxkp .jzgrzxkptop {
height: 140px;
background:  
EOF;
 if($this->jz52_grzxbjthe == 1) { } elseif($this->jz52_grzxbjthe == 2) { 
$return .= <<<EOF
url("source/plugin/jz52_top/template/1.jpg") no-repeat 0 0
EOF;
 } elseif($this->jz52_grzxbjthe == 3) { 
$return .= <<<EOF
url("source/plugin/jz52_top/template/2.jpg") no-repeat 0 0
EOF;
 } elseif($this->jz52_grzxbjthe == 4) { 
$return .= <<<EOF
url("source/plugin/jz52_top/template/3.jpg") no-repeat 0 0
EOF;
 } elseif($this->jz52_grzxbjthe == 5) { 
$return .= <<<EOF
url("source/plugin/jz52_top/template/4.jpg") no-repeat 0 0
EOF;
 } 
$return .= <<<EOF
  {$this->jz52_grzxbjs} ;
color: #fff;
}

#jzgrzxkp .jzgrzxkptop a{

color: #fff;
}

#jzgrzxkp .jzgrzxkptop h3 {
 height: 16px;
font-weight:normal;
    padding: 8px 0px 0px 10px;
font-size: 16px;
}

#jzgrzxkp .jzgrzxkptop .jzgrzxkpthtle {
height: 35px;
}
#jzgrzxkp .jzgrzxkptop .jzgrzxkpimg {
height: 73px;
text-align:center;
}

#jzgrzxkp .jzgrzxkptop .jzgrzxkpimg img {
width: 58px;
border-radius: 100px;
padding: 2px;
background: none repeat scroll 0% 0% #fff;
margin-top: 5px;
}

#jzgrzxkp .jzyhm {
    font-size: 15px;
    line-height: 22px;
text-align: center;
padding-bottom: 10px;
text-align:center;
}

#jzgrzxkp .jzyhm a {
    width: 231px;
    height: 15px;
text-align:center;
background: none ;
}

#jzgrzxkp .jzgrzxkpbox  { height: 120px; }

#jzgrzxkp .jzgrzxkpbox a {background:url("source/plugin/jz52_top/template/gr.png") no-repeat 0 0  ; width:57px;height:60px;float:left; margin: 0px;}

.box01{background-position: 0px 0px !important;}
.box02{background-position: -57px 0px !important;}
.box03{background-position: -114px 0px !important;}
.box04{background-position: -171px 0px !important;}

.box05{background-position: 0px -60px !important;}
.box06{background-position: -57px -60px !important;}
.box07{background-position: -114px -60px !important;}
.box08{background-position: -171px -60px !important;}

</style>

<div id="jzgrzxkp" class="jzgrzxkp">
<div class="jzgrzxkptop">
<div class="jzgrzxkpthtle">
<h3>个人中心</h3>
</div>  
<div class="jzgrzxkpimg">
<img src="{$this->jz52_uc}/avatar.php?uid={$_G['uid']}&size=big">
</div>

EOF;
 if($_G['uid']) { 
$return .= <<<EOF
    
<div class="jzyhm"><a href="home.php?mod=space&amp;uid={$_G['uid']}" target="_blank" title="访问我的空间" >{$_G['member']['username']}</a></div>

EOF;
 } else { 
$return .= <<<EOF
   
<div class="jzyhm"><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href)">登录或注册</a></div>

EOF;
 } 
$return .= <<<EOF
 
</div>
<div class="jzgrzxkpbox">
<a href="home.php?mod=space&amp;do=favorite&amp;view=me" class="box01" target="_blank"  title="收藏" ></a>
<a href="forum.php?mod=guide&amp;view=my" class="box02" target="_blank"  title="帖子" ></a>
<a href="home.php?mod=space&amp;do=friend" class="box03" class="box04" target="_blank"  title="好友" ></a>
<a href="home.php?mod=space&amp;do=pm" class="box04" target="_blank"  title="消息" ></a>
<a href="home.php?mod=spacecp" class="box05" target="_blank" title="设置" ></a>
<a href="home.php?mod=medal" class="box06" target="_blank" title="勋章" ></a>
<a href="home.php?mod=task" class="box07" target="_blank" title="任务" ></a>

EOF;
 if($_G['uid']) { 
$return .= <<<EOF

<a href="member.php?mod=logging&amp;action=logout&amp;formhash={$__FORMHASH}" class="box08" title="退出" ></a>

EOF;
 } 
$return .= <<<EOF

</div>
</div>
</div>
</ul>
</li>
</ul>
</span>	

EOF;
 } 
$return .= <<<EOF

</div>

EOF;
 } 
$return .= <<<EOF


EOF;
?>