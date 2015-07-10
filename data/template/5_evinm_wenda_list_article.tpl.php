<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list_article');
0
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/mobanbus_boohee/common/header.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './source/plugin/evinm_wenda/template/head.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/default/common/seditor.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/default/common/seditor.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/default/common/seditor.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/default/common/seditor.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/default/common/footer.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/mobanbus_boohee/common/header_common.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
|| checktplrefresh('./source/plugin/evinm_wenda/template/list_article.htm', './template/mobanbus_boohee/common/pubsearchform.htm', 1408078300, 'evinm_wenda', './data/template/5_evinm_wenda_list_article.tpl.php', './source/plugin/evinm_wenda/template', 'list_article')
;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<?php if($_G['config']['output']['iecompatible']) { ?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE<?php echo $_G['config']['output']['iecompatible'];?>" /><?php } ?>
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?><?php } if(empty($nobbname)) { ?> <?php echo $_G['setting']['bbname'];?><?php } ?></title>
<?php echo $_G['setting']['seohead'];?>

<meta name="keywords" content="<?php if(!empty($metakeywords)) { echo dhtmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { echo dhtmlspecialchars($metadescription); ?> <?php } if(empty($nobbname)) { ?>,<?php echo $_G['setting']['bbname'];?><?php } ?>" />
<meta name="generator" content="Discuz! <?php echo $_G['setting']['version'];?>" />
<meta name="author" content="Discuz! Team and Comsenz UI Team" />
<meta name="copyright" content="2001-2013 Comsenz Inc." />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle']) && strpos($_G['cookie']['extstyle'], TPLDIR) !== false) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>', DYNAMICURL = '<?php echo $_G['dynamicurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if(empty($_GET['diy'])) { $_GET['diy'] = '';?><?php } if(!isset($topic)) { $topic = array();?><?php } ?>
<!--[if lte IE 6]>
<script src="template/mobanbus_boohee/boohee_st/js/DD_belatedPNG_0.0.8a.js" type="text/javascript" type="text/javascript"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('div, ul, img, li, input , a, .slideshow div h3,.wrap1 div b, .slideBox .bd em, .pic_list li span, .index_tit h3, .button-large, .login_list .i_qq, .login_list .i_wb, .bg_png, .container .news_list a.read i, .focus_box .btn .prev, .focus_box .btn .next, .focus_box3 .btn3 .prev, .focus_box3 .btn3 .next, .bg-img');
    </script>
<![endif]-->
<meta name="application-name" content="<?php echo $_G['setting']['bbname'];?>" />
<meta name="msapplication-tooltip" content="<?php echo $_G['setting']['bbname'];?>" />
<?php if($_G['setting']['portalstatus']) { ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['1']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G['siteurl'].'portal.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/portal.ico" />
<?php } ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['2']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G['siteurl'].'forum.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/bbs.ico" />
<?php if($_G['setting']['groupstatus']) { ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['3']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G['siteurl'].'group.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/group.ico" />
<?php } if(helper_access::check_module('feed')) { ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['4']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G['siteurl'].'home.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/home.ico" />
<?php } if($_G['basescript'] == 'forum' && $_G['setting']['archiver']) { ?>
<link rel="archives" title="<?php echo $_G['setting']['bbname'];?>" href="<?php echo $_G['siteurl'];?>archiver/" />
<?php } if(!empty($rsshead)) { ?>
<?php echo $rsshead;?>
<?php } if(widthauto()) { ?>

<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>" />
<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
<?php } if($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>
<link rel="stylesheet" type="text/css" id="diy_common" href="data/cache/style_<?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } ?>

<script>
 paceOptions = {
   elements: true
 };
</script>
<script src="template/mobanbus_boohee/boohee_st/js/mobanbus_pace.js" type="text/javascript"></script>
<script src="template/mobanbus_boohee/boohee_st/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script>
 function load(time){
   var x = new XMLHttpRequest()
   x.send();
 };

 load(20);
 load(100);
 load(500);
 load(2000);
 load(3000);

 setTimeout(function(){
   Pace.ignore(function(){
     load(3100);
   });
 }, 4000);

 Pace.on('hide', function(){
   console.log('done');
 });
</script>

<script type="text/javascript">
var headtx = jQuery.noConflict();
headtx(document).ready(function(){
headtx("#simple-account-dropdown > .account").click(function(){
headtx("#simple-account-dropdown > .dropdown").fadeToggle("fast", function(){
if(headtx(this).css('display') == "none")
headtx("#simple-account-dropdown > .account").removeClass("active");
else
headtx("#simple-account-dropdown > .account").addClass("active");
});
});
});
</script>
</head><body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?><?php if($_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)) { ?> <?php echo $cat['bodycss'];?><?php } ?>" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?> <?php include template('common/header_diy'); ?> 
<?php } ?> 
<?php if(check_diy_perm($topic)) { ?> <?php
$diynav = <<<EOF
 
<a href="javascript:saveUserdata('diy_advance_mode', '');openDiy();">DIY</a> 

EOF;
?> 
<?php } ?> 
<?php if(CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)) { ?> 
<?php echo $diynav;?> 
<?php } ?> 
<?php if(empty($topic) || $topic['useheader']) { ?> 
<?php if($_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')) { ?>
<div class="xi1 bm bm_c"> 请选择 <a href="<?php echo $_G['siteurl'];?>forum.php?mobile=yes">进入手机版</a> <span class="xg1">|</span> <a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">继续访问电脑版</a> </div>
<?php } ?>

<!--顶部导航开始-->
<div id="headtop" class="cl"> 
  <?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_top'])) echo $_G['setting']['pluginhooks']['global_cpnav_top'];?>
  <div class="wp">
  
    <div class="logo">
      <h1> 
        <?php if(!isset($_G['setting']['navlogos'][$mnid])) { ?> 
        <a href="./" title="<?php echo $_G['setting']['bbname'];?>"><?php echo $_G['style']['boardlogo'];?></a> 
        <?php } else { ?> 
        <?php echo $_G['setting']['navlogos'][$mnid];?> 
        <?php } ?> 
      </h1>
    </div>  
  
    <div id="headnav" class="nav_box">
        <!--Start Navigation--> 
        <?php $mnid = getcurrentnav();?>        <ul id="menu-main-nav-menu" class="sf-menu sf-js-enabled sf-shadow">
          <?php if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { ?> 
          <?php if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
          <li <?php if($mnid == $nav['navid']) { ?>class="active" <?php } ?><?php echo $nav['nav'];?>></li>
          <?php } ?> 
          <?php } ?>
        </ul>   
      <!--End Navigation--> 
      
      <!--二级导航开始-->
      <?php if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
      <ul class="p_pop h_pop" id="plugin_menu" style="display: none">
        <?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?> 
        <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
        <li><?php echo $module['url'];?></li>
        <?php } ?> 
        <?php } ?>
      </ul>
      <?php } ?> 
  <?php echo $_G['setting']['menunavs'];?>      
    </div>

    <!-- Block user information module HEADER --> 
    <?php if($_G['uid']) { ?>
    <div id="header_user">
      <ul id="simple-account-dropdown-freebie">
                    <li><?php echo adshow("subnavbanner/a_mu");?><?php if($_G['setting']['search']) { $slist = array();?><?php if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><a href="javascript:;" rel="curforum" fid="{$_G['fid']}" >本版</a></li>
EOF;
?><?php } if($_G['setting']['portalstatus'] && $_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><a href="javascript:;" rel="article">文章</a></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><a href="javascript:;" rel="forum" class="curtype">帖子</a></li>
EOF;
?><?php } if(helper_access::check_module('blog') && $_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><a href="javascript:;" rel="blog">日志</a></li>
EOF;
?><?php } if(helper_access::check_module('album') && $_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><a href="javascript:;" rel="album">相册</a></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><a href="javascript:;" rel="group">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><a href="javascript:;" rel="user">用户</a></li>
EOF;
?>
<?php } if($_G['setting']['search'] && $slist) { ?>
<div id="scbar" class="<?php if($_G['setting']['srchhotkeywords'] && count($_G['setting']['srchhotkeywords']) > 5) { ?>scbar_narrow <?php } ?>cl">
<form id="scbar_form" method="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?>get<?php } else { ?>post<?php } ?>" autocomplete="off" onsubmit="searchFocus($('scbar_txt'))" action="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?><?php echo $searchparams['url'];?><?php } else { ?>search.php?searchsubmit=yes<?php } ?>" target="_blank">
<input type="hidden" name="mod" id="scbar_mod" value="search" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="srhlocality" value="<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
<?php if(!empty($searchparams['params'])) { if(is_array($searchparams['params'])) foreach($searchparams['params'] as $key => $value) { $srchotquery .= '&' . $key . '=' . rawurlencode($value);?><input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>" />
<?php } ?>
<input type="hidden" name="source" value="discuz" />
<input type="hidden" name="fId" id="srchFId" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="q" id="cloudsearchquery" value="" />

<style>
#scbar { overflow: visible; position: relative; }
#sg{ background: #FFF; width:456px; border: 1px solid #B2C7DA; }
.scbar_narrow #sg { width: 316px; }
#sg li { padding:0 8px; line-height:30px; font-size:14px; }
#sg li span { color:#999; }
.sml { background:#FFF; cursor:default; }
.smo { background:#E5EDF2; cursor:default; }
            </style>
            <div style="display: none; position: absolute; top:37px; left:44px;" id="sg">
                <div id="st_box" cellpadding="2" cellspacing="0"></div>
            </div>
<?php } ?>
<div class="header_search" role="search">
<input type="text" name="srchtxt" id="scbar_txt" value="请输入搜索内容" autocomplete="off" x-webkit-speech speech />
<button type="submit" name="searchsubmit" sc="1" value="true"></button>
</div>
</form>
</div>
<ul id="scbar_type_menu" class="p_pop" style="display: none;"><?php echo implode('', $slist);; ?></ul>
<script type="text/javascript">
initSearchmenu('scbar', '<?php echo $searchparams['url'];?>');
</script>
<?php } ?></li>
<li>
<div id="simple-account-dropdown">
<div class="account" style="margin-right:5px;">	
<span><img src="uc_server/avatar.php?uid=<?php echo $_G['uid'];?>&amp;size=small" style="width:26px; height:26px; margin-top:12px;"/></span>
</div>
<div class="dropdown" style="display: none; z-index:999999">
<ul>
                    <li><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><img src="uc_server/avatar.php?uid=<?php echo $_G['uid'];?>&amp;size=small" style="width:22px; height:22px; border-radius:2px;"/>&nbsp;&nbsp;&nbsp;我的空间</a></li>
                    <li><a href="home.php?mod=space&amp;do=doing"><img src="<?php echo IMGDIR;?>/gerenzx.png" />&nbsp;&nbsp;&nbsp;个人中心</a></li>
                    <li><a href="forum.php?mod=collection&amp;op=my"><img src="<?php echo IMGDIR;?>/biaoq.png" />&nbsp;&nbsp;&nbsp;我的专辑</a></li>
<li><a href="home.php?mod=space&amp;do=notice"><img src="<?php echo IMGDIR;?>/messages.png" />&nbsp;&nbsp;&nbsp;消息</a></li>
<li><a href="home.php?mod=spacecp"><img src="<?php echo IMGDIR;?>/star.png" />&nbsp;&nbsp;&nbsp;设置</a></li>
<li><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><img src="<?php echo IMGDIR;?>/searchn.png" />&nbsp;&nbsp;&nbsp;退出</a></li>
</ul>
</div>
</div>
</li>

                 </ul>
    </div>
    <?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
    <?php } elseif(!$_G['connectguest']) { ?>
    <div id="header_user">
      <ul id="header_nav">
        <li class="login_list"><a href="connect.php?mod=login&amp;op=init&amp;referer=forum.php&amp;statfrom=login"><i class="i_qq">腾讯QQ</i></a></li>
        <li class="login_list"><a class="login_block"  href="member.php?mod=register" class="btn-register">立即注册</a></li>
        <li class="login_list"><a class="login_block"  href="javascript:;" onClick="javascript:lsSubmit();" class="nousername">登录</a></li>
      </ul>
    </div>
    <div style="display:none"> 
      <?php include template('member/login_simple'); ?> 
    </div>
    <?php } else { ?>
    <?php } ?> 

    <div class="cl"></div>
  </div>
</div>
<!--顶部导航结束-->

<div id="mu" class="cl">
<?php if($_G['setting']['subnavs']) { if(is_array($_G['setting']['subnavs'])) foreach($_G['setting']['subnavs'] as $navid => $subnav) { if($_G['setting']['navsubhover'] || $mnid == $navid) { ?>
<ul class="cl <?php if($mnid == $navid) { ?>current<?php } ?>" id="snav_<?php echo $navid;?>" style="display:<?php if($mnid != $navid) { ?>none<?php } ?>">
<?php echo $subnav;?>
</ul>
<?php } } } ?>
</div>


<div class="bodycontainer clearfix navcontainer wp cl"><?php echo adshow("headerbanner/wp a_h");?><?php echo adshow("subnavbanner/a_mu");?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header'];?>
<?php } ?>
<div id="wp" class="wp cl">
<link rel="stylesheet" href="source/plugin/evinm_wenda/template/style/global.css">
<link rel="stylesheet" href="source/plugin/evinm_wenda/template/style/style.css">
<link rel="stylesheet" href="source/plugin/evinm_wenda/template/style/article.css">
<script src="source/plugin/evinm_wenda/template/js/5.js" type="text/javascript"></script>
 
    <div id="doc4">
         <?php if(empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']) { ?>
 <style type="text/css">
#hd {width:960px; margin:0 auto;}	
 </style>
 <?php } ?>
 <style type="text/css">
.grid-3 {width:100% !important;}
<?php if($config['openall'] == 1) { ?>
.mod-cate .item li {width:45%;}
<?php } ?>
 </style>
 <div id="header">
            <div class="search clearfix" style="float:none;padding-left:0;">
                <div class="logo" style="background:url(<?php echo $config['slogo'];?>) no-repeat;">
                    <a href="<?php if($rewrite == '1') { ?>wenda/ <?php } else { ?> plugin.php?id=evinm_wenda:index  <?php } ?>">
问答中心
                    </a>
                </div>
                <form class="sh-form" action="<?php if($rewrite == '1') { ?>wenda/search.html<?php } else { ?> plugin.php?id=evinm_wenda:search<?php } ?>" method="post">
                    <div class="ipt-sh">
                        <input maxlength="100" id="search_kw" type="text" name="s" autocomplete="off" value = "<?php echo $sk;?>"x-webkit-speech="" value="&nbsp;&nbsp;&nbsp;&nbsp;请输入内容......" style="color:gray;"          onfocus="javascript:if(this.value == '&nbsp;&nbsp;&nbsp;&nbsp;请输入内容......')          this.value = ''; this.style.color='black';"         onblur="if(this.value == '') {this.value = '&nbsp;&nbsp;&nbsp;&nbsp;请输入内容......';         this.style.color = 'gray';}">
                    </div>
                    <div class="bt-sh">
                        <button id="btn_search_ask" type="submit">
                            搜索答案
                        </button>
                    </div>
                </form>
                <div class="bt-ask">
                    <a href="<?php if($rewrite == '1') { ?>wenda/ask.html<?php } else { ?> plugin.php?id=evinm_wenda:ask<?php } ?>">
                        提问
                    </a>
                </div>

                <div class="bt-answer">
                    <a href="plugin.php?id=evinm_wenda:list">
                        回答
                    </a>
                </div>
            </div>
            <div class="main-nav clearfix">
                <ul class="list">
                    <li <?php if($_GET['id'] == 'evinm_wenda:index') { ?> class="on" <?php } ?>>
                        <a class="home" href="<?php if($rewrite == '1') { ?>wenda/ <?php } else { ?> plugin.php?id=evinm_wenda:index  <?php } ?>">
                            <span class="s0">
                                问答首页
                            </span>
                        </a>
                    </li>
                    <li id="navStore">
                        <a class="store" href="<?php if($rewrite == '1') { ?>wenda/list.html <?php } else { ?>plugin.php?id=evinm_wenda:list<?php } ?>">
                            <span class="s1">
                                问题库
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="forum.php?mod=forumdisplay&amp;fid=595">
                            <span class="s3">
                                问答活动
                            </span>
                        </a>
                    </li>
                    <li class=" <?php if($_GET['id'] == 'evinm_wenda:my') { ?>on<?php } ?>" >
                        <a href="<?php if($rewrite == '1') { ?>wenda/home_mypage.html <?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mypage<?php } ?>">
                            <span class="s4">
                                我的首页
                            </span>
                        </a>
                    </li>
                    <li class="last <?php if($_GET['id'] == 'evinm_wenda:ask') { ?>on<?php } ?>" >
                        <a href="<?php if($rewrite == '1') { ?>wenda/ask.html <?php } else { ?>plugin.php?id=evinm_wenda:ask<?php } ?>">
                            <span class="s5">
                                提问
                            </span>
                        </a>
                    </li>
                </ul>
                <p class="total">
                    累计提问：<?php echo $config['ask_nums'];?><span class="pipe"> | </span>
悬赏总额：<?php echo $config['ask_nums_o'];?><span class="pipe"> | </span>
                    待解决：<?php echo $config['ask_nums_d'];?>
                </p>
            </div>
        </div>


        <div id="panelStore" class="panel-q-store" style="display:none;">
            <div class="list">
                <ul class="clearfix"><?php if(is_array($list)) foreach($list as $mood) { ?><li>
<a href="<?php if($rewrite == '1') { ?>wenda/list-f<?php echo $mood['id'];?>.html<?php } else { ?>plugin.php?id=evinm_wenda:list&fcid=<?php echo $mood['id'];?><?php } ?>">
<?php echo $mood['name'];?>
</a>
</li>
<?php } ?>

                </ul>
            </div>
        </div>        <div id="bd" class="grid-3 clearfix">
            <div class="article">			
<?php if($vip['uid']) { ?>
<div class="cl mtm mbm">
<div class="doctor-yq">
<em title="特约专家" class="ico-yq">
</em>
<div class="doctor-yq-cons">
<a href="<?php if($rewrite == '1') { ?>wenda/home_mypage.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mypage<?php } ?>" class="pic" style="margin-top:5px;">
<?php echo $vip['avatar'];?>
</a>
<span class="doctor-info">
<span class="doc-name">
<a href="<?php if($rewrite == '1') { ?>wenda/home_mypage.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mypage<?php } ?>" title="" class="z">
<?php echo $vip['name'];?> 
</a>
<span title="LV<?php echo $vip['lvl'];?>" class="z ico-lv ico-lv-<?php echo $vip['lvl'];?>" style="height:16px; margin-top:6px; margin-left:5px;"></span>
</span>
<span class="doc-ks">
本分类
</span>
<span class="doc-ks">
特约专家
</span>

</span>
<span class="doctor-pj">
<p class="cons_text">
专家资料
</p>
<dl>
<dt>
采纳率
</dt>
<dd class="jd_bg" title="采纳率：<?php echo $info['cnl'];?>">
<i style="width:<?php echo $info['cnl'];?>%">
</i>
</dd>
<dd class="jd_fs">
<?php echo $info['cnl'];?>%
</dd>
</dl>
<dl class="jd2">
<dt>
回答数
</dt>
<dd class="jd_fs">
<?php echo $info['num_a'];?>
</dd>
</dl>
</span>
<div class="y cl" style="width:200px; height:80px; <?php if($config['fenlei_vip'] != "") { ?> background:url(<?php echo $config['fenlei_vip'];?>) no-repeat; margin-top:-6px;<?php } ?>">

</div>
</div>

</div>
</div>
<?php } ?>


                <div class="mod-question">
                    <div class="hd cl">
<div class="cl">
<div class="cl z">
<span class="ico">
</span>
<h3 class="title" style="padding:0">
<?php echo $ask['subject'];?>
</h3>
<span class="wealth">
<?php echo $ask['coin'];?>
<script language="JavaScript"> 
function delete_confirm(e) { 
 if (event.srcElement.outerText=="删除") 
  event.returnValue=confirm("您确认删除这个问题嘛?"); 
 } 
 document.onclick=delete_confirm; 
</script>
<?php if($ask['uid'] == $_G['uid']) { ?>
<span class="pipe"> | </span>
<a href="plugin.php?id=evinm_wenda:list_article&amp;qid=<?php echo $ask['id'];?>&amp;deletewt=yes">删除</a> 
<?php } ?>	
</span>	
</div>

<?php if($ask['lasttime'] > 0 && $ask['over'] !=1) { ?>						
<span class="y" style="margin-top:8px;">
剩余：<?php echo $ask['lasttime'];?>小时
</span>
<?php } ?>
</div>
                        <div class="label">
<?php if($ask['ishidden'] == '1') { ?>
<span class="pubtime"><?php echo $config['nick_nm'];?></span>
<?php } else { ?>
<a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $ask['uid'];?>&amp;do=profile" class="author">
                                <?php echo $ask['username'];?>
                            </a>
<?php } ?>
                            |
                            <span class="pubtime">
                                <?php echo $ask['posttime'];?>
                            </span>
                        </div>
                    </div>
                    <div class="bd cl ptm pbm" style="padding:10px 25px;">						
<div><?php echo $ask['message'];?></div>
<?php if($ask['pic'] != "") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $ask['pic'];?>" style="max-width: 680px;width: expression(this.width > 680 : true);"/></div>
<?php } ?>

<!-- 问题补充 -->
<?php if($askadd_num != 0 ) { ?>
<div class="askadd cl mtm">
<h3><b>问题补充：</b></h3>
<div><?php echo $askadd['message'];?></div>
<?php if($askadd['pic'] != "") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $askadd['pic'];?>" style="max-width: 680px;width: expression(this.width > 680 : true);"/></div>
<?php } ?>						
</div>
<?php } ?>
                    </div>

<div class="ft cl mtm">
<?php if($ask['over'] == 1) { } elseif($ask['over'] == 0 && $_G['uid'] == $ask['uid']) { $icd = $ask['id']+1;?><div class="ope-title"> <strong>处理提问</strong> 及时采纳满意回答并感谢回答者，可获得<span><?php echo $config['rule_jifen']['3'];?><?php echo $config['czjl_name'];?>奖励</span>。 还可以补充内容或提高悬赏吸引更多回答者： </div>
<div class="ope-action clearfix" id="ope-action">
<ul>
<li>
<a href="javascript:;" onclick="quickrelay(<?php echo $ask['id'];?>)" id="btn<?php echo $ask['id'];?>" alog-action="qb-ask-addit">
<i class="i-added">
</i>
补充问题
</a>
</li>
<li class="ope-spliter">
</li>
<li>
<a href="javascript:;" onclick="quickrelay(<?php echo $icd;?>)" id="btn<?php echo $icd;?>" alog-action="qb-add-reward">
<i class="i-enhance">
</i>
提高悬赏
</a>
</li>
<li class="ope-spliter">
</li>
<!-- 							<li>
<a href="#" alog-action="qb-adopt-btn">
<i class="i-adopt">
</i>
在线求助
</a>
</li> -->
<li class="ope-spliter ope-spliter-on" style="display: none;">
</li>
</ul>
</div>	


<div id="replybox_<?php echo $ask['id'];?>" style="display:none;" class="ope-action-show show-enhance flw_replybox cl" style="">
<div class="mod-answer-form" style="padding:0; border:none;">
<div class="bd">
<form enctype="multipart/form-data" action="" method="post">
<div id="editorwraper" class="textarea" style="padding:0">
<div class="tedt" style="border:none; width:100%;">
<div class="bar"><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'smilies'), $guestpost ? 1 : 0);?><script src="<?php echo $_G['setting']['jspath'];?>seditor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<div class="fpd">
<?php if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]');doane(event);"<?php } ?>>B</a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?php echo $seditor['0'];?>forecolor"<?php if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?php echo $seditor['0'];?>');doane(event);"<?php } ?>>Color</a>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img');doane(event);"<?php } ?>>Image</a>
<?php } if(in_array('link', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>url" href="javascript:;" title="添加链接" class="flnk"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'url');doane(event);"<?php } ?>>Link</a>
<?php } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>quote" href="javascript:;" title="引用" class="fqt"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'quote');doane(event);"<?php } ?>>Quote</a>
<?php } if(in_array('code', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>code" href="javascript:;" title="代码" class="fcd"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'code');doane(event);"<?php } ?>>Code</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('at', $seditor['1']) && $_G['group']['allowat']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>at.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<a id="<?php echo $seditor['0'];?>at" href="javascript:;" title="@朋友" class="fat"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'at');doane(event);"<?php } ?>>@朋友</a>
<?php } ?>
<?php echo $seditor['3'];?>
</div></div>
<div class="area">
<textarea rows="10" cols="80" name="message" id="fastpostmessage" tabindex="12" class="pt"><?php echo $askadd['message'];?></textarea>
</div>
</div>
</div>
<input name="ask_id" type="hidden" value="1349447622129340">
<input id="js-verify-answer" name="verify" type="hidden" value="">
<span class="addimg">
添加图片：<input name="user_upload_file[]" type="file" id="subjectimage" size="52">
</span>	
<a class="btn btn-32-gray btn-2" href="javascript:;" style="margin-left:15px;" onclick="display(<?php echo $ask['id'];?>)"  >
<em>										
取消										
</em>
</a>
<input type="submit" class="btn btn-2"  name="btn_moreq"  value="确定">	

</form>
</div>
</div>
</div>

<div id="replybox_<?php echo $icd;?>" style="display:none;" class="ope-action-show show-enhance flw_replybox cl" style="">
<p>
当您对问题悬赏更多积分时，该问题将会出现在所属分类的高悬赏问题列表上方，提高被回答者看到的几率。
<br>								
</p>
<p>
<form action="" method="post">
追加悬赏
<select name="enhance">
<option value="5" selected="selected">
5
</option>
<option value="10">
10
</option>
<option value="15">
15
</option>
<option value="20">
20
</option>
<option value="30">
30
</option>
<option value="40">
40
</option>
<option value="50">
50
</option>
</select>
分
</p>
<p class="act-buttons">
<span class="btn btn-2" style="padding:0;"><input type="submit" name="btn_zjxs" value="确定"></span>
<a class="btn btn-32-gray btn-2" href="javascript:;" onclick="display(<?php echo $icd;?>)"  >
<em>										
取消										
</em>
</a>
</p>
</form>
</div>
<?php } ?>						
</div>
                </div>
<?php if($ask['over'] == 0 && $_G['uid'] && $_G['uid'] != $ask['uid']) { if($vip['uid'] != "" && $config['is_onlyvip'] == 1) { if($vip['uid'] == $_G['uid']) { ?>
<div class="mod-answer-form">
<div class="hd">
<h4>
我来回答
</h4>
</div>
<div class="bd">
<form enctype="multipart/form-data" action="" method="post">
<div id="editorwraper" class="textarea" style="padding:0">
<div class="tedt" style="border:none; width:100%;">
<div class="bar"><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'smilies'), $guestpost ? 1 : 0);?><script src="<?php echo $_G['setting']['jspath'];?>seditor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<div class="fpd">
<?php if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]');doane(event);"<?php } ?>>B</a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?php echo $seditor['0'];?>forecolor"<?php if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?php echo $seditor['0'];?>');doane(event);"<?php } ?>>Color</a>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img');doane(event);"<?php } ?>>Image</a>
<?php } if(in_array('link', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>url" href="javascript:;" title="添加链接" class="flnk"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'url');doane(event);"<?php } ?>>Link</a>
<?php } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>quote" href="javascript:;" title="引用" class="fqt"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'quote');doane(event);"<?php } ?>>Quote</a>
<?php } if(in_array('code', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>code" href="javascript:;" title="代码" class="fcd"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'code');doane(event);"<?php } ?>>Code</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('at', $seditor['1']) && $_G['group']['allowat']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>at.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<a id="<?php echo $seditor['0'];?>at" href="javascript:;" title="@朋友" class="fat"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'at');doane(event);"<?php } ?>>@朋友</a>
<?php } ?>
<?php echo $seditor['3'];?>
</div></div>
<div class="area">
<textarea rows="10" cols="80" name="message" id="fastpostmessage" tabindex="12" class="pt"></textarea>
</div>
</div>
</div>
<input name="ask_id" type="hidden" value="1349447622129340">
<input id="js-verify-answer" name="verify" type="hidden" value="">
<span class="addimg">
添加图片：<input name="user_upload_file[]" type="file" id="subjectimage" size="52">
</span>

<input type="submit" class="btn btn-2"  name="btn_answer"  value="提交回答">

</form>
</div>
</div>
<?php } else { } } else { if($ask['is_anserd'] == 0) { ?>
<div class="mod-answer-form">
<div class="hd">
<h4>
我来回答
</h4>
</div>
<div class="bd">
<form enctype="multipart/form-data" action="" method="post">
<div id="editorwraper" class="textarea" style="padding:0">
<div class="tedt" style="border:none; width:100%;">
<div class="bar"><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'smilies'), $guestpost ? 1 : 0);?><script src="<?php echo $_G['setting']['jspath'];?>seditor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<div class="fpd">
<?php if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]');doane(event);"<?php } ?>>B</a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?php echo $seditor['0'];?>forecolor"<?php if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?php echo $seditor['0'];?>');doane(event);"<?php } ?>>Color</a>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img');doane(event);"<?php } ?>>Image</a>
<?php } if(in_array('link', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>url" href="javascript:;" title="添加链接" class="flnk"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'url');doane(event);"<?php } ?>>Link</a>
<?php } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>quote" href="javascript:;" title="引用" class="fqt"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'quote');doane(event);"<?php } ?>>Quote</a>
<?php } if(in_array('code', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>code" href="javascript:;" title="代码" class="fcd"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'code');doane(event);"<?php } ?>>Code</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('at', $seditor['1']) && $_G['group']['allowat']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>at.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<a id="<?php echo $seditor['0'];?>at" href="javascript:;" title="@朋友" class="fat"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'at');doane(event);"<?php } ?>>@朋友</a>
<?php } ?>
<?php echo $seditor['3'];?>
</div></div>
<div class="area">
<textarea rows="10" cols="80" name="message" id="fastpostmessage" tabindex="12" class="pt"></textarea>
</div>
</div>
</div>
<input name="ask_id" type="hidden" value="1349447622129340">
<input id="js-verify-answer" name="verify" type="hidden" value="">
<span class="addimg">
添加图片：<input name="user_upload_file[]" type="file" id="subjectimage" size="52">
</span>

<input type="submit" class="btn btn-2"  name="btn_answer"  value="提交回答">

</form>
</div>
</div>
<?php } } } elseif($ask['over'] == 1 && $answer_best['username'] != "") { ?>
<div class="mod-answer-one mod-answer-best">
<div class="hd">
<h4>
满意回答
</h4>
<p class="pubtime">
<?php echo $answer_best['posttime'];?>
</p>
<div class="ico-best">
</div>
</div>
<div class="bd">
<div class="econtent">
<?php if($istdyhz == 2) { ?>
<p>
对不起！系统置了查看答案的权限，您所在的用户组暂无权限查看此答案！
</p>
<?php } else { if($config['issale'] == 1 && $ask['sale'] == 1 && $isabuy < 1 && $answer_best['uid'] != $_G['uid'] && $_G['uid'] != $ask['uid']) { ?>
<p>
此答案已被设置为出售，您需要支付 <span class = "f60"><?php echo $sale;?></span> 积分来购买此答案。<a href="plugin.php?id=evinm_wenda:list_article&amp;qid=<?php echo $_GET['qid'];?>&amp;buy=1"><span class = "f60">立即购买！</span></a>
</p>
<?php } else { ?>
<p>
<?php echo $answer_best['message'];?>
</p>
<?php if($answer_best['pic'] !="") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $answer_best['pic'];?>" style="max-width: 680px;width: expression(this.width > 680 : true);"/></div>
<?php } } } ?>
</div>
</div>
<div class="ft" style="position: relative;">
<div class="vcard-user">
<a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $answer_best['uid'];?>" class="pic">
<?php echo $answer_best['avatar'];?>
</a>
<div class="text">
<p class="name">
回答者：
<a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $answer_best['uid'];?>">
<?php echo $answer_best['username'];?>
</a>
</p>
<p>
等级：
<span title="LV<?php echo $answer_best['lvl'];?>" class="ico-lv ico-lv-<?php echo $answer_best['lvl'];?>">
</span>
</p>
<p>
采纳率：
<em>
<?php echo $best_user_info['cnl'];?> %
</em>
</p>
</div>
</div>
<!-- 						<a class="btn btn-1 btn-zan ">
<span>
0
</span>
</a>
<span class="tips js-ilike-tips">
+1
</span> -->
</div>
</div>
<?php } elseif($ask['lasttime'] <= 0) { ?>
<div class="mod-answer-one mod-answer-best">
<div class="hd" style="padding-left:25px;">
<h4>
问题已关闭,未选择满意答案！
</h4>
</div>
<div class="bd">
<div class="econtent">
<p>
<?php echo $answer_best['message'];?>
</p>
<?php if($answer_best['pic'] !="") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $answer_best['pic'];?>" style="max-width: 680px;width: expression(this.width > 680 : true);"/></div>
<?php } ?>
</div>
</div>
</div>
<?php } if($ask['nums_a'] == 0 || $ask_num == 0) { ?>					
<?php } else { ?>
                <div class="mod-answer-list" id="answerList">
                    <div class="hd">
                        <h4>
                            回答
                            <span>
                                ( <?php echo $ask['nums_a'];?> )
                            </span>
                        </h4>
                        <span class="ico">
                        </span>
                    </div>
                    <div class="bd">
                        <ul class="list">
<?php if($list_answers) { if(is_array($list_answers)) foreach($list_answers as $list_answer) { if($list_answer['iszw'] == 0) { $zwqid = $list_answer['id'];?>                            <li class="item">
                                <div class="label">
                                    <a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $list_answer['uid'];?>" style="color: #0063C8;">
                                        <?php echo $list_answer['username'];?>
                                    </a>
                                    |
                                    <span title="LV<?php echo $list_answer['lvl'];?>" class="ico-lv ico-lv-<?php echo $list_answer['lvl'];?>">
                                    </span>
                                    |
                                    <span class="pubtime">
                                        <?php echo $list_answer['posttime'];?>
                                    </span>
<?php if($_G['adminid'] == 1) { ?>	
                                    |
                                    <span class="pubtime">
                                        <a href="plugin.php?id=evinm_wenda:list_article&amp;qid=<?php echo $ask['id'];?>&amp;action=delhf&amp;ansid=<?php echo $list_answer['id'];?>&amp;ansuid=<?php echo $list_answer['uid'];?>" style="color: #888">删除答案</a>
                                    </span>
<script language="JavaScript"> 
function delete_confirm(e) { 
 if (event.srcElement.outerText=="删除答案") 
  event.returnValue=confirm("您确认删除这条答案嘛?"); 
 } 
 document.onclick=delete_confirm; 
</script> 
<?php } ?>
                                </div>

<!--                                 <a data-agree="0" data-ask_id="1349447622129340" data-ans_id="1349447890065379"
                                class="btn btn-1 btn-zan ">
                                    <span>
                                        0
                                    </span>
                                </a> -->

<!--                                 <span class="tips js-ilike-tips">
                                    +1
                                </span> -->

                                <div class="econtent" >
<div><?php echo $list_answer['message'];?></div>
<?php if($list_answer['pic'] !="") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $list_answer['pic'];?>" style="max-width: 680px;width: expression(this.width > 680 : true);"/></div>
<?php } ?>

<!-- 追问 --><?php if(is_array($list_answers_zw)) foreach($list_answers_zw as $list_answer_zw) { if($list_answer_zw['iszw'] != 0 && $list_answer_zw['zw_aid'] == $list_answer['id']) { if($list_answer_zw['iszw'] == 1) { ?>
<dl class="replyask line mtm mbm cl">
<dt class="ask">
追问
</dt>
<dd class="replyask-content" >
<p>
<?php echo $list_answer_zw['message'];?>
</p>
<?php if($list_answer_zw['pic'] !="") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $list_answer_zw['pic'];?>" style="max-width: 680px;width: expression(this.width > 580 : true);"/></div>
<?php } ?>								
</dd>
</dl>
<?php } elseif($list_answer_zw['iszw'] == 2) { ?>
<dl class="replyask line mtm mbm cl">
<dt class="reply">
回答
</dt>
<dd class="replyask-content line">												
<p>
<?php echo $list_answer_zw['message'];?>
</p>
<?php if($list_answer_zw['pic'] !="") { ?>
<div class="cl ptm pbm" ><img src="<?php echo $list_answer_zw['pic'];?>" style="max-width: 680px;width: expression(this.width > 580 : true);"/></div>
<?php } ?>
</dd>
</dl>
<?php } } } ?>
                                </div>	

<!-- 按钮显示 -->
<?php if($ask['uid'] == $_G['uid']) { ?>
<a href="javascript:;" onclick="quickrelay(<?php echo $list_answer['id'];?>22)" id="btn<?php echo $list_answer['id'];?>22" alog-action="qb-add-reward"class="z btn-set-best btn-set-zw" style="padding-right:10px;"><span>追问</span></a>
<?php } elseif($_G['uid'] == $list_answer['uid'] && $list_answer['yzw'] > 0) { ?>
<a href="javascript:;" onclick="quickrelay(<?php echo $list_answer['id'];?>22)" id="btn<?php echo $list_answer['id'];?>22" alog-action="qb-add-reward"class="z btn-set-best btn-set-zwda" style="padding-right:10px;"><span>补充答案</span></a>
<?php } if($ask['uid'] == $_G['uid'] && $ask['over'] == 0) { ?>
<form action="" method="post" class="z">
<input type="hidden" name="qid"  value = "<?php echo $ask['id'];?>">
<input type="hidden" name="model"  value = "sb">
<input type="hidden" name="bestuid"  value = "<?php echo $list_answer['uid'];?>">
<input type="hidden" name="bestid"  value = "<?php echo $list_answer['id'];?>">
<input type="hidden" name="coin"  value = "<?php echo $ask['coin'];?>">
<span class="z cl">
<input type="submit" class="btn-set-best" value="" name="setbest" style="width: 110px;height: 28px;">
</span>
<?php if($config['issale'] == 1 && $ask['coin'] >= $config['sale_low']) { ?>	
<span class="z cl" style="margin-left:10px; margin-top:7px;">
<input name="sale" type="checkbox" value="1" /> 出售答案
</span>
<?php } ?>
</form>	
<?php } ?>
<div class="cl" style="width:100%;height:1px;clear:both;"></div>
<div id="replybox_<?php echo $list_answer['id'];?>22" style="display:none;" class="flw_replybox cl" style="">

<div class="mod-answer-form" style="padding:0; border:none;">
<div class="mtm">
<?php if($ask['uid'] == $_G['uid']) { ?>
<div class="zwtitle">继续追问：</div>
<?php } elseif($_G['uid'] == $list_answer['uid'] && $list_answer['yzw'] > 0) { ?>
<div class="zwtitle">补充答案：</div>
<?php } ?>
<form enctype="multipart/form-data" action="" method="post">
<div id="editorwraper" class="textarea" style="padding:0">
<div class="tedt" style="border:none; width:100%;">
<div class="bar"><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'smilies'), $guestpost ? 1 : 0);?><script src="<?php echo $_G['setting']['jspath'];?>seditor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<div class="fpd">
<?php if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]');doane(event);"<?php } ?>>B</a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?php echo $seditor['0'];?>forecolor"<?php if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?php echo $seditor['0'];?>');doane(event);"<?php } ?>>Color</a>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img');doane(event);"<?php } ?>>Image</a>
<?php } if(in_array('link', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>url" href="javascript:;" title="添加链接" class="flnk"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'url');doane(event);"<?php } ?>>Link</a>
<?php } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>quote" href="javascript:;" title="引用" class="fqt"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'quote');doane(event);"<?php } ?>>Quote</a>
<?php } if(in_array('code', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>code" href="javascript:;" title="代码" class="fcd"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'code');doane(event);"<?php } ?>>Code</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('at', $seditor['1']) && $_G['group']['allowat']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>at.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<a id="<?php echo $seditor['0'];?>at" href="javascript:;" title="@朋友" class="fat"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'at');doane(event);"<?php } ?>>@朋友</a>
<?php } ?>
<?php echo $seditor['3'];?>
</div></div>
<div class="area">
<textarea rows="10" cols="80" name="message" id="fastpostmessage" tabindex="12" class="pt"></textarea>
</div>
</div>
</div>
<input name="zw_hid" type="hidden" value="<?php echo $list_answer['id'];?>">
<input name="zw_uid" type="hidden" value="<?php echo $list_answer['uid'];?>">
<?php if($ask['uid'] == $_G['uid']) { ?>
<input name="zw_ac" type="hidden" value="1">
<?php } elseif($_G['uid'] == $list_answer['uid'] && $list_answer['yzw'] > 0) { ?>
<input name="zw_ac" type="hidden" value="2">
<?php } ?>
<input id="js-verify-answer" name="verify" type="hidden" value="">
<span class="addimg">
添加图片：<input name="user_upload_file[]" type="file" id="subjectimage" size="52">
</span>	
<a class="btn btn-32-gray btn-2" href="javascript:;" style="margin-left:15px;" onclick="display(<?php echo $list_answer['id'];?>22)"  >
<em>										
取消										
</em>
</a>
<input type="submit" class="btn btn-2"  name="btn_zhuiwen"  value="确定">										
</form>
</div>
</div>
</div>

                            </li>
<?php } } } ?>
                        </ul>
                    </div>
                </div>
<?php } ?>

                <div class="mod-relevant">
                    <div class="hd">
                        <h4>
                            相关问题
                        </h4>
                    </div>
                    <div class="bd">
                        <div class="cls-qa-list-1">
                            <ul class="list">
<?php if($list_like) { if(is_array($list_like)) foreach($list_like as $like) { ?>                                <li>
                                    <span class="s0">
                                        <span class="wealth">
                                            <?php echo $like['coin'];?>
                                        </span>
                                        <a target="_blank" href="<?php if($rewrite == '1') { ?>wenda/<?php echo $like['id'];?><?php } else { ?> plugin.php?id=evinm_wenda:list_article&qid=<?php echo $like['id'];?><?php } ?>">
<?php echo $like['subject'];?>
                                        </a>
                                    </span>
                                    <span class="s1">
                                        <span class="pubtime">
                                            <?php echo $like['posttime'];?>
                                        </span>
                                    </span>
                                </li>
<?php } } ?>
                            </ul>
                        </div>
                    </div>
                </div>
<?php if($config['isopenshare'] == 1) { ?>
<div class="wgt-share mtm cl">
<div class="line f-info">
<!-- JiaThis Button BEGIN -->
<div class="jiathis_style"><span class="jiathis_txt">分享到：</span>
<a class="jiathis_button_qzone"></a>
<a class="jiathis_button_tsina"></a>
<a class="jiathis_button_tqq"></a>
<a class="jiathis_button_renren"></a>
<a class="jiathis_button_kaixin001"></a>
<a class="jiathis_button_douban"></a>
<a class="jiathis_button_tieba"></a>
<a class="jiathis_button_baidu"></a>
<a class="jiathis_button_115"></a>
<a class="jiathis_button_hi"></a>
<a class="jiathis_button_xiaoyou"></a>
<a class="jiathis_button_qq"></a>
<a class="jiathis_button_xianguo"></a>
<a class="jiathis_button_fav"></a>
<a class="jiathis_button_51"></a>
<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
</div>
<script type="text/javascript" >
var jiathis_config={
summary:"",
hideMore:false
}
</script>
<script src="http://v3.jiathis.com/code_mini/jia.js" type="text/javascript" charset="utf-8"></script>
<!-- JiaThis Button END -->

</div>
</div>
<?php } ?>
            </div>
            <div class="aside">
            <div class="extra">
<?php if($_G['uid']) { ?>
<div class="mod-userinfo">
<div class="info">
<a href="<?php if($rewrite == '1') { ?>wenda/home_mypage.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mypage<?php } ?>" class="pic" style="margin-top:5px;">
<?php echo $user_info['avatar'];?> 
</a>
<div class="text">
<p class="name">
<a href="<?php if($rewrite == '1') { ?>wenda/home_mypage.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mypage<?php } ?>">
<?php echo $_G['username'];?>
</a>
</p>
<p>
<?php echo $config['points_name'];?> ：
<span class="wealth">
<?php echo $config['points_user'];?>
</span>
</p>
<p>
<span title="LV<?php echo $config['lvl'];?>" class="ico-lv ico-lv-<?php echo $config['lvl'];?>">
</span>
经验值：<?php echo $config['exp'];?>
</p>
</div>
</div>
<div class="status">
<table>
<tbody>
<tr>
<th class="first">
回答数
</th>
<th>
采纳率
</th>
<th>
提问数
</th>
</tr>
<tr>
<td class="first">
<a href="<?php if($rewrite == '1') { ?>wenda/home_mya.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mya<?php } ?>">
<?php echo $config['a_num'];?>
</a>
</td>
<td>
<a href="<?php if($rewrite == '1') { ?>wenda/home_mypage.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mypage<?php } ?>">
<?php echo $user_info['cnl'];?>%
</a>
</td>
<td>
<a href="<?php if($rewrite == '1') { ?>wenda/home_mya.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mya<?php } ?>">
<?php echo $config['ask_num'];?>
</a>
</td>
</tr>
</tbody>
</table>
</div>
<div class="qa-btn">
<ul class="clearfix">
<li class="asked">
<a href="<?php if($rewrite == '1') { ?>wenda/home_myq.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=myq<?php } ?>">
我提问的
</a>
</li>
<li class="answered">
<a href="<?php if($rewrite == '1') { ?>wenda/home_mya.html<?php } else { ?>plugin.php?id=evinm_wenda:my&ac=mya<?php } ?>">
我回答的
</a>
</li>
</ul>
</div>
</div>
<?php } else { ?>
                <div class="mod-userlogin">
                    <div class="bd clearfix">
                        <a href="member.php?mod=logging&amp;action=login&amp;referer=<?php echo rawurlencode($dreferer); ?>" onclick="showWindow('login', this.href);return false;" class="btn-login">
                            <span>
                                登录
                            </span>
                        </a>
                        <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" class="btn-reg ">
                            <span>
                                注册
                            </span>
                        </a>
                    </div>
                </div>
<?php } ?>
</div>
<div class="cl mtm">
<?php echo $config['list_ad1'];?>
</div>
            </div>
        </div>
 
 
 
    </div>

    <script src="source/plugin/evinm_wenda/template/js/1.js" type="text/javascript"></script>
    <script src="source/plugin/evinm_wenda/template/js/2.js" type="text/javascript"></script>    
<script src="source/plugin/evinm_wenda/template/js/3.js" type="text/javascript"></script>
    <script src="source/plugin/evinm_wenda/template/js/4.js" type="text/javascript"></script>

<script type="text/javascript">

var parentReplyId = '';

function addClass(id,stylestr){
var o=document.getElementById(id);
o.className=o.className+" "+stylestr;
o=null;
}		

function quickrelay(feedid) {

$('replybox_'+feedid).style.display = 'none';

var replyboxid = 'replybox_'+feedid;
if($(replyboxid).style.display == 'block') {
$(replyboxid).style.display = 'none';
}

if(parentReplyId && parentReplyId != feedid) {
var oldbox = $('replybox_'+parentReplyId);

oldbox.style.display = 'none';
}

if($(replyboxid).style.display == 'block' ) {
$(replyboxid).style.display = 'none';						

} else {				

$(replyboxid).style.display = 'block';
//addClass('btn'+feedid,'bt-qkanswer-on')	;				
}

parentReplyId = feedid;
}

function display(feedid) {
$('replybox_'+feedid).style.display = 'none';				
}


</script>	
<style type="text/css">
input.btn-set-best {border:0;}

</style>	</div>
<?php if(empty($topic) || ($topic['usefooter'])) { $focusid = getfocus_rand($_G[basescript]);?><?php if($focusid !== null) { $focus = $_G['cache']['focus']['data'][$focusid];?><?php $focusnum = count($_G['setting']['focus'][$_G[basescript]]);?><div class="focus" id="sitefocus">
<div class="bm">
<div class="bm_h cl">
<a href="javascript:;" onclick="setcookie('nofocus_<?php echo $_G['basescript'];?>', 1, <?php echo $_G['cache']['focus']['cookie'];?>*3600);$('sitefocus').style.display='none'" class="y" title="关闭">关闭</a>
<h2>
<?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?>
<span id="focus_ctrl" class="fctrl"><img src="<?php echo IMGDIR;?>/pic_nv_prev.gif" alt="上一条" title="上一条" id="focusprev" class="cur1" onclick="showfocus('prev');" /> <em><span id="focuscur"></span>/<?php echo $focusnum;?></em> <img src="<?php echo IMGDIR;?>/pic_nv_next.gif" alt="下一条" title="下一条" id="focusnext" class="cur1" onclick="showfocus('next')" /></span>
</h2>
</div>
<div class="bm_c" id="focus_con">
</div>
</div>
</div><?php $focusi = 0;?><?php if(is_array($_G['setting']['focus'][$_G['basescript']])) foreach($_G['setting']['focus'][$_G['basescript']] as $id) { ?><div class="bm_c" style="display: none" id="focus_<?php echo $focusi;?>">
<dl class="xld cl bbda">
<dt><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2" target="_blank"><?php echo $_G['cache']['focus']['data'][$id]['subject'];?></a></dt>
<?php if($_G['cache']['focus']['data'][$id]['image']) { ?>
<dd class="m"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" target="_blank"><img src="<?php echo $_G['cache']['focus']['data'][$id]['image'];?>" alt="<?php echo $_G['cache']['focus']['data'][$id]['subject'];?>" /></a></dd>
<?php } ?>
<dd><?php echo $_G['cache']['focus']['data'][$id]['summary'];?></dd>
</dl>
<p class="ptn cl"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2 y" target="_blank">查看 &raquo;</a></p>
</div><?php $focusi ++;?><?php } ?>
<script type="text/javascript">
var focusnum = <?php echo $focusnum;?>;
if(focusnum < 2) {
$('focus_ctrl').style.display = 'none';
}
if(!$('focuscur').innerHTML) {
var randomnum = parseInt(Math.round(Math.random() * focusnum));
$('focuscur').innerHTML = Math.max(1, randomnum);
}
showfocus();
var focusautoshow = window.setInterval('showfocus(\'next\', 1);', 5000);
</script>
<?php } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1) { ?>
<div class="focus patch" id="patch_notice"></div>
<?php } ?><?php echo adshow("footerbanner/wp a_f/1");?><?php echo adshow("footerbanner/wp a_f/2");?><?php echo adshow("footerbanner/wp a_f/3");?><?php echo adshow("float/a_fl/1");?><?php echo adshow("float/a_fr/2");?><?php echo adshow("couplebanner/a_fl a_cb/1");?><?php echo adshow("couplebanner/a_fr a_cb/2");?><?php echo adshow("cornerbanner/a_cn");?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer'];?>
<div id="ft" class="wp cl">
<div id="flk">
<p><?php if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
!$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile' || $nav['id'] == 'darkroom'))) { ?><?php echo $nav['code'];?><span class="pipe">|</span><?php } } ?>
                        </p><p>
                        <a href="portal.php?mod=topic&amp;topicid=15">关于我们</a>&nbsp;&nbsp;
                        <script src="http://s17.cnzz.com/stat.php?id=5158407&web_id=5158407" type="text/javascript" language="JavaScript"></script>&nbsp;&nbsp;
<a href="<?php echo $_G['setting']['siteurl'];?>" target="_blank"><?php echo $_G['setting']['sitename'];?></a>
<?php if($_G['setting']['icp']) { ?>( <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_G['setting']['icp'];?></a> )<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink'];?>
<?php if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?>
</p>
</div><?php updatesession();?><?php if($_G['uid'] && $_G['group']['allowinvisible']) { ?>
<script type="text/javascript">
var invisiblestatus = '<?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?>';
var loginstatusobj = $('loginstatusid');
if(loginstatusobj != undefined && loginstatusobj != null) loginstatusobj.innerHTML = invisiblestatus;
</script>
<?php } ?>
</div>
<?php } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if($_G['uid'] && helper_access::check_module('follow') && !isset($_G['cookie']['checkfollow'])) { ?>
<script src="home.php?mod=spacecp&ac=follow&op=checkfeed&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && !isset($_G['cookie']['checkpatch'])) { ?>
<script src="misc.php?mod=patch&action=checkpatch&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes') { if(check_diy_perm($topic) && (empty($do) || $do != 'index')) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy<?php if(!check_diy_perm($topic, 'layout')) { ?>_data<?php } ?>.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($space['self'] && CURMODULE == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1) { ?>
<script type="text/javascript">patchNotice();</script>
<?php } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && empty($_G['cookie']['pluginnotice'])) { ?>
<div class="focus plugin" id="plugin_notice"></div>
<script type="text/javascript">pluginNotice();</script>
<?php } if(!$_G['setting']['bbclosed'] && $_G['setting']['disableipnotice'] != 1 && $_G['uid'] && !empty($_G['cookie']['lip'])) { ?>
<div class="focus plugin" id="ip_notice"></div>
<script type="text/javascript">ipNotice();</script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_GET['do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } if(($_G['member']['newpm'] || $_G['member']['newprompt']) && empty($_G['cookie']['ignore_notice'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>html5notification.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var h5n = new Html5notification();
if(h5n.issupport()) {
<?php if($_G['member']['newpm'] && $_GET['do'] != 'pm') { ?>
h5n.shownotification('pm', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=pm', '<?php echo avatar($_G[uid],small,true);?>', '新的短消息', '有新的短消息，快去看看吧');
<?php } if($_G['member']['newprompt'] && $_GET['do'] != 'notice') { if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { $noticetitle = lang('template', 'notice_'.$key);?>h5n.shownotification('notice_<?php echo $key;?>', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=notice&view=<?php echo $key;?>', '<?php echo avatar($_G[uid],small,true);?>', '<?php echo $noticetitle;?> (<?php echo $val;?>)', '有新的提醒，快去看看吧');
<?php } } ?>
}
</script>
<?php } userappprompt();?><?php if($_G['basescript'] != 'userapp') { ?>
<div id="scrolltop">
<?php if($_G['fid'] && $_G['mod'] == 'viewthread') { ?>
<span><a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?><?php if($_GET['from']) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>" onclick="showWindow('reply', this.href)" class="replyfast" title="快速回复"><b>快速回复</b></a></span>
<?php } ?>
<span hidefocus="true"><a title="返回顶部" onclick="window.scrollTo('0','0')" class="scrolltopa" ><b>返回顶部</b></a></span>
<?php if($_G['fid']) { ?>
<span>
<?php if($_G['mod'] == 'viewthread') { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" hidefocus="true" class="returnlist" title="返回列表"><b>返回列表</b></a>
<?php } else { ?>
<a href="forum.php" hidefocus="true" class="returnboard" title="返回版块"><b>返回版块</b></a>
<?php } ?>
</span>
<?php } ?>
</div>
<script type="text/javascript">_attachEvent(window, 'scroll', function () { showTopLink(); });checkBlind();</script>
<?php } if(isset($_G['makehtml'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>html2dynamic.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var html_lostmodify = <?php echo TIMESTAMP;?>;
htmlGetUserStatus();
<?php if(isset($_G['htmlcheckupdate'])) { ?>
htmlCheckUpdate();
<?php } ?>
</script>
<?php } output();?></body>
</html>
</html>