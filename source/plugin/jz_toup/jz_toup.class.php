<?php 
// 判断常量,通过主入口进入插件
if(!defined('IN_DISCUZ')) {
	exit('Access Denied!');
}

/**
 * 插件回到顶部,全局部分
 */
class plugin_jz_toup {
	/**
	 * 嵌入点global_footer页脚
	 */
	public function global_footer() {
		global $_G; // 全局变量
		$jz = array();
		$jz = $_G['cache']['plugin']['jz_toup']; // 插件存储变量

		// 判断开关按钮
		$status = $jz['status'];
		if(intval($status) != 1) {
			return '';
		}

		$style = $jz['style']; // 定义样式
		$bottom = $jz['bottom']; // 距离底部
		$silde = $jz['silde']; // 幻灯片(图片及图片链接)
		$kf = $jz['kf']; // 联系方式(qq|10000)
		$k = (explode("|",$kf));

		// 导入js(showtop(),gotop()),隐藏官方回到顶部样式
		$toup .= "<script src=\"source/plugin/jz_toup/js/top.js\" type=\"text/javascript\"></script>
				<style>#scrolltop{display:none;}</style>";

		// 开关选择样式
		switch($style) {
			case '1': // 天猫样式-黑
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/tm.png) 20px no-repeat #000;height:64px;width:64px;display:block;opacity:0.6;filter:alpha(opacity=60);}#toup:hover{opacity:1;filter:alpha(opacity=100);}</style>
					<a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '2': // 天猫样式-白
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/tm.png) -24px no-repeat #fff;height:64px;width:64px;display:block;opacity:0.6;filter:alpha(opacity=60);}#toup:hover{opacity:1;filter:alpha(opacity=100);}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '3': // 火箭样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/rocket.png) no-repeat 50% 0px;height:85px;display:block;width:35px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '4': // QQ音乐样式
				$toup .= "<style type=\"text/css\">#toup{background:#fff;visibility:hidden;border-radius:5px;box-shadow:0px 0px 2px #6e6e6e;overflow:hidden;position:fixed;bottom:".$bottom.";width:47px;height:106px;}#toup a{width:47px;margin:5px;display:block;background:url(source/plugin/jz_toup/img/qqm.png);}#toup .toup{background-position:0px -1px;height:22px;}#toup .feedback{background-position:0px -22px;height:32px;}#toup .bottom{background-position:0px -55px;height:22px;}#toup .toup:hover{background-position:-38px -1px;height:22px;}#toup .feedback:hover{background-position:-38px -22px;height:32px;}#toup .bottom:hover{background-position:-38px -55px;height:22px;}</style><div id=\"toup\"><a class=\"toup\" title=\"&#22238;&#39030;&#37096;\" href=\"javascript:;\" onclick=\"window.scrollTo('0','0')\"></a>";
				if($k['0'] == "email"){
					$toup .= "<a class=\"feedback\" title=\"&#24847;&#35265;&#24314;&#35758;\" href=\"mailto:{$k['1']}\"></a>";
				}elseif($k['0'] == "qq"){
					$toup .= "<a class=\"feedback\" title=\"&#24847;&#35265;&#24314;&#35758;\" href=\"mailto:{$k['1']}\"></a>";
				}elseif($k['0'] == "url"){
					$toup .= "<a class=\"feedback\" title=\"&#24847;&#35265;&#24314;&#35758;\" href=\"http://wpa.qq.com/msgrd?v=3&uin={$k['1']}&site=qq&menu=yes\" target=\"_blank\"></a>";
				}
				$toup .= "<a class=\"bottom\" title=\"&#21040;&#24213;&#37096;\" href=\"javascript:;\" onclick=\"window.scrollTo('0','99999999999')\"></a></div>";
				break;
			case '5': // 糗事百科样式-白
				$s = (explode("|",$silde));
				$toup .= "<style type=\"text/css\">#toup{background:#fff;visibility:hidden;position:fixed;bottom:".$bottom.";margin-left:-15px;width:180px;overflow:hidden;}#toup .silder{background:#fff;padding:10px;display:block;}#toup .uppanel a{width:49%;padding:10px 0;display:inline-block;text-align:center;}</style><div id=\"toup\"><a class=\"silder\" href=\"{$s['1']}\"><img src=\"{$s['0']}\"></img></a><div class=\"uppanel\"><a href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\" style=\"border-right:1px solid #ccc;\">&#36820;&#22238;&#39030;&#37096;</a>";
				if($k['0'] == "email"){
					$toup .= "<a href=\"mailto:{$k['1']}\" title=\"&#24847;&#35265;&#24314;&#35758;\">&#24847;&#35265;&#24314;&#35758;</a></div></div>";
				}elseif($k['0'] == "qq"){
					$toup .= "<a href=\"mailto:{$k['1']}\" title=\"&#24847;&#35265;&#24314;&#35758;\">&#24847;&#35265;&#24314;&#35758;</a></div></div>";
				}elseif($k['0'] == "url"){
					$toup .= "<a href=\"http://wpa.qq.com/msgrd?v=3&uin={$k['1']}&site=qq&menu=yes\" title=\"&#24847;&#35265;&#24314;&#35758;\" target=\"_blank\">&#24847;&#35265;&#24314;&#35758;</a></div></div>";
				}
				break;
			case '6': // 糗事百科样式-黑
				$s = (explode("|",$silde));
				$toup .= "<style type=\"text/css\">#toup{background:#000;width:180px;visibility:hidden;position:fixed;bottom:".$bottom.";margin-left:-15px;overflow:hidden;}#toup .silder{background:#000;padding:10px;display:block;}#toup .uppanel a{width:49%;padding:10px 0;color:#fff;display:inline-block;text-align:center;border-top:1px solid #fff;}</style><div id=\"toup\"><a class=\"silder\" href=\"{$s['1']}\"><img src=\"{$s['0']}\"></img></a><div class=\"uppanel\"><a href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\" style=\"border-right:1px solid #ccc;\">&#36820;&#22238;&#39030;&#37096;</a>";
				if($k['0'] == "email"){
					$toup .= "<a href=\"mailto:{$k['1']}\" title=\"&#24847;&#35265;&#24314;&#35758;\">&#24847;&#35265;&#24314;&#35758;</a></div></div>";
				}elseif($k['0'] == "qq"){
					$toup .= "<a href=\"mailto:{$k['1']}\" title=\"&#24847;&#35265;&#24314;&#35758;\">&#24847;&#35265;&#24314;&#35758;</a></div></div>";
				}elseif($k['0'] == "url"){
					$toup .= "<a href=\"http://wpa.qq.com/msgrd?v=3&uin={$k['1']}&site=qq&menu=yes\" target=\"_blank\" title=\"&#24847;&#35265;&#24314;&#35758;\">&#24847;&#35265;&#24314;&#35758;</a></div></div>";
				}
				break;
			case '7': // 百度贴吧样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/bdtb.gif) no-repeat;height:83px;display:block;width:23px;}#toup:hover{background-position:-23px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '8': // 中文墨迹样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/moji.png) no-repeat;height:165px;display:block;width:32px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '9': // 百度图库样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/bdtp.png) no-repeat;height:35px;display:block;width:35px;}#toup:hover{background-position:-42px 0px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '10': // 标签样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/bq.png) no-repeat;height:70px;display:block;width:70px;}#toup:hover{background-position:-70px 0px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '11': // 木板样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/mb.png) no-repeat;height:75px;display:block;width:76px;}#toup:hover{background-position:0px -75px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '12': // 小黑条样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";}#toup .silde,#toup .silde img{background:#000;}#toup .toup{margin-left:40%;background:url(source/plugin/jz_toup/img/xht.gif) no-repeat;height:75px;display:block;width:76px;}</style><div id=\"toup\"><a class=\"silde\" href=\"{$s['1']}\"><img src=\"{$s['0']}\"></img></a><div><a class=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a></div></div>";
				break;
			case '13': // QQ空间样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/qzone.png) no-repeat;height:41px;display:block;width:52px;}#toup:hover{background-position:-52px 0px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '14': // 简约英文样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/e.png) no-repeat;height:99px;display:block;width:15px;}#toup:hover{background-position:-18px 0px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '15': // 小灰球样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/hq.gif) no-repeat;height:45px;display:block;width:35px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '16': // 简约中文样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/zw.png) no-repeat;height:100px;display:block;width:30px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '17': // 英文墨迹样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/e.gif) no-repeat;height:28px;display:block;width:56px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '18': // 蓝色经典样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/lan.gif) no-repeat;height:114px;display:block;width:67px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '19': // 热气球样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/rqq.png) no-repeat;height:72px;display:block;width:44px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			case '20': // CSDN样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/csdn.png) no-repeat;height:49px;display:block;width:48px;}#toup:hover{background-position:-48px 0;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
			default: // 默认样式
				$toup .= "<style type=\"text/css\">#toup{position:fixed;visibility:hidden;bottom:".$bottom.";background:url(source/plugin/jz_toup/img/mb.png) no-repeat;height:75px;display:block;width:76px;}#toup:hover{background-position:0px -75px;}</style><a id=\"toup\" href=\"javascript:;\" title=\"&#22238;&#39030;&#37096;\" onclick=\"goTop();\"></a>";
				break;
		}

		return $toup; // 返回html插入页面
	}
} 


 ?>