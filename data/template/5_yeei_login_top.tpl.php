<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__VERHASH = VERHASH;$top = <<<EOF

<script src="source/plugin/yeei_login/template/img/jquery-1.6.4.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="source/plugin/yeei_login/template/img/style.css" />
<!-- ��jquery ͬ���������ģ�壩���ֳ�ͻ ���޸Ĵ˴� jq -->
<script language="javascript" >	var jq = jQuery.noConflict();</script>
<script type="text/javascript">
        jq(function() {
    var topHead = jq('#yeei_logon_head').position().top;
            jq(window).scroll(function() {
                if (jq(window).scrollTop() > topHead) {
    jq('#yeei-login-Top').fadeIn(100);
jq('#yeei_login_ad').fadeIn(100);
var topHr = jq('#yeei-login-Top').height()+'px';

EOF;
 if($this->location == '2') { 
$top .= <<<EOF

jq('#yeei_login_ad').css("bottom",topHr);

EOF;
 } else { 
$top .= <<<EOF

                    jq('#yeei_login_ad').css("top",topHr);
                    
EOF;
 } 
$top .= <<<EOF

                } else {
jq('#yeei-login-Top').fadeOut(100);
jq('#yeei_login_ad').fadeOut(100);
                };
            });
        });
   jq(function() {

             jq("#ls_cookietimes").click(function() {
       
                  if (jq("#ls_cookietimes").attr("checked")) {
                      jq("#ls_cookietimes2").attr("checked",true);
                  }else{
      jq("#ls_cookietimes2").attr("checked",false);
  }
             });
        });
function lsSubmits(op) {
var op = !op ? 0 : op;
if($('ls_usernames').value == '' || $('ls_passwords').value == '') {
showWindow('login', 'member.php?mod=logging&action=login' + (op ? '&cookietime=1' : ''));
} else {
ajaxpost('lsforms', 'return_ls', 'return_ls');
}
return false;
}

function closeYeei(){
    jq("#yeei-login-Top").remove();
jq("#yeei_login_ad").remove();
}


</script>
<style type="text/css">

EOF;
 if($this->location == '2') { 
$top .= <<<EOF

body{ padding-bottom:{$this->ftheight}px}

EOF;
 } 
$top .= <<<EOF

#yeei-login-Top .con{ background:{$this->bgcolor}; }
#yeei-login-Top .remi{ color:{$this->color}}
#yeei-login-Top .bot a{color:{$this->acolor}}
</style>


EOF;
 if($this->adswi) { 
$top .= <<<EOF

<div class="wp cl"><div id="yeei_login_ad" class="wp ">{$this->adcode}</div></div>

EOF;
 } 
$top .= <<<EOF

<div id="yeei-login-Top" 
EOF;
 if($this->location == '2' ) { 
$top .= <<<EOF
 style="bottom:0px!important;top:auto"
EOF;
 } 
$top .= <<<EOF
 >

<div class="con">
<div class="wp cl">	

EOF;
 if($this->closeyeei) { 
$top .= <<<EOF

<style type="text/css">
#yeei-login-Top .y { margin-right:50px;}
</style>
<a id="closes" href="javascript:;" onclick="closeYeei();" title="�ر�"></a>

EOF;
 } 
$top .= <<<EOF

<div class="z yah">
<div class="remi yah">
{$this->explan} 
</div>
</div>
<div class="y">
<form method="post" autocomplete="off" id="lsforms" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes&amp;infloat=yes&amp;lssubmit=yes" onsubmit="
EOF;
 if($_G['setting']['pwdsafety']) { 
$top .= <<<EOF
pwmd5('ls_passwords');
EOF;
 } 
$top .= <<<EOF
return lsSubmits();">
<span id="return_ls" style="display:none"></span>
<table cellspacing="0" cellpadding="0">
<tbody>
<tr>

EOF;
 if(!$_G['setting']['autoidselect']) { 
$top .= <<<EOF

<td><input type="text" tabindex="1001" onblur="if(this.value == ''){this.value = '用户名';this.className = 'ipo ipoS';}" onfocus="if(this.value == '用户名'){this.value = '';this.className = 'ipo';}" value="用户名" class="ipo ipoS" id="ls_usernames" name="username"></td>

EOF;
 } else { 
$top .= <<<EOF

<td><input type="text" tabindex="1001" onblur="if(this.value == ''){this.value = '
EOF;
 if(getglobal('setting/uidlogin')) { 
$top .= <<<EOF
UID/
EOF;
 } 
$top .= <<<EOF
用户名/Email';this.className = 'ipo ipoS';}" onfocus="if(this.value == '
EOF;
 if(getglobal('setting/uidlogin')) { 
$top .= <<<EOF
UID/
EOF;
 } 
$top .= <<<EOF
用户名/Email'){this.value = '';this.className = 'ipo';}" value="
EOF;
 if(getglobal('setting/uidlogin')) { 
$top .= <<<EOF
UID/
EOF;
 } 
$top .= <<<EOF
用户名/Email" class="ipo ipoS" id="ls_usernames" name="username"></td>

EOF;
 } 
$top .= <<<EOF

<td><input type="password" tabindex="1002" onblur="if(this.value == ''){this.value = '******';this.className = 'ipo ipoS';}" onfocus="if(this.value == '******'){this.value = '';this.className = 'ipo';}" value="******" autocomplete="off" class="ipo ipoS" id="ls_passwords" name="password"></td>
<td><button tabindex="904" class="push" type="submit" id="sqgn" onMouseOver="showMenu({'ctrlid':'sqgn','ctrlclass':'a','duration':2});"><em>登录</em></button></td>
<td>
&nbsp;<a class="reg" href="member.php?mod=register"><em>{$_G['setting']['reglinkname']}</em></a>
<input style="display:none" type="checkbox" id="ls_cookietimes2" value="2592000" name="cookietime">
</td>
</tr>

EOF;
 if($this->location == '2') { 
$top .= <<<EOF

<tr>
<td><div class="bot">
<label class="ls" for="ls_cookietimes"><input type="checkbox" tabindex="1003" value="2592000" class="pc" id="ls_cookietimes" name="cookietime">自动登录</label>
<a style="margin-left:30px" checked onclick="showWindow('login', 'member.php?mod=logging&amp;action=login&amp;viewlostpw=1')" href="javascript:;">找回密码</a>
</div></td>
<td>

</td>
<td></td>
<td></td>
</tr>

EOF;
 } 
$top .= <<<EOF

</tbody>
</table>
<input type="hidden" name="quickforward" value="yes" />
<input type="hidden" name="handlekey" value="ls" />
</form>

EOF;
 if($_G['setting']['pwdsafety']) { 
$top .= <<<EOF

<script src="{$_G['setting']['jspath']}md5.js?{$__VERHASH}" type="text/javascript" reload="1"></script>

EOF;
 } 
$top .= <<<EOF

</div>


</div>
</div>

</div>

<div id="sqgn_menu" class="yeei_login_menu" style="display: none;">

EOF;
 if($this->location != '2') { 
$top .= <<<EOF

<div class="yeei_login_top">
<a class="y" onclick="showWindow('login', 'member.php?mod=logging&amp;action=login&amp;viewlostpw=1')" href="javascript:;">找回密码</a>
<label class="ls" for="ls_cookietimes"><input type="checkbox" tabindex="1003" value="2592000" class="pc" id="ls_cookietimes" name="cookietime">自动登录</label>
</div>

EOF;
 } if($this->qqurl || $this->sinaurl || $this->baiduurl || $this->taobaourl || $this->sllurl) { 
$top .= <<<EOF

<div class="fast" 
EOF;
 if($this->location == '2' ) { 
$top .= <<<EOF
 style="border:none;padding-top:3px;}"
EOF;
 } 
$top .= <<<EOF
>

EOF;
 if($this->qqurl) { 
$top .= <<<EOF

<a href="{$this->qqurl}" class="qqurl"></a>

EOF;
 } if($this->sinaurl) { 
$top .= <<<EOF

<a href="{$this->sinaurl}" class="sinaurl"></a>

EOF;
 } if($this->baiduurl) { 
$top .= <<<EOF

<a href="{$this->baiduurl}" class="baiduurl"></a>

EOF;
 } if($this->taobaourl) { 
$top .= <<<EOF

<a href="{$this->taobaourl}" class="taobaourl"></a>

EOF;
 } if($this->sllurl) { 
$top .= <<<EOF

<a href="{$this->sllurl}" class="sllurl"></a>

EOF;
 } 
$top .= <<<EOF

</div>

EOF;
 } 
$top .= <<<EOF

</div>





EOF;
?>