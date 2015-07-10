<?php

if(!defined('IN_DISCUZ')) {
       exit('Access Denied'); 
}

class plugin_fx_checkin {
	public function __construct(){
		global $_G;
		if (!$_G['cache']['plugin']['fx_checkin']['config']){
			C::t('#fx_checkin#rates_plugin')->check_rates();
		}
	}
	function global_header(){
		global $_G;
		$html = '<link rel="stylesheet" type="text/css" href="source/plugin/fx_checkin/images/css.css" />';
		$self = $_G['cache']['plugin']['fx_checkin']['self'];
		if ($self['todayrank']>0){
			$html .= '<div id="fx_checkin2_menu" class="tip tip_2" style="display: none; "><div class="tip_horn"></div><div class="tip_c">'.lang('plugin/fx_checkin', 'checkin_success',$self).'</div></div>';
		}
		
		$html .='<div id="fx_checkin_menu" class="tip tip_2 moods_tip" style="display: none; ">';
		$html .='<div class="tip_horn"></div>';
		$html .='<div class="pic"><div class="ico"></div></div>';
		$html .='<div class="item" id="fx_checkin_menut" >'.lang('plugin/fx_checkin', 'checkin_success2',$self).'</p></div>';
		$html .='<div class="item2" id="fx_checkin_menub">';
		$html .=lang('plugin/fx_checkin', 'checkin_success3',$self);
		$html .='</div></div></div>';

		$html .='<script type="text/javascript">';
		$html .='var fx_calendarshow = 0;';
		if ($self['todayrank']>0){
			$html .='var fx_chk_menu=true;';
		}else{
			$html .='var fx_chk_menu=false;';
		}
		$html .='function fx_checkin_menu(ctrlid){if (fx_chk_menu){showMenu({\'ctrlid\':ctrlid,\'menuid\':\'fx_checkin_menu\',\'pos\':\'34!\',\'duration\':2});}}function fx_checkin(){if (!fx_chk_menu){showWindow(\'fx_checkin\', \'plugin.php?id=fx_checkin:checkin&formhash='.FORMHASH.'&'.FORMHASH.'\');}}</script>';
		return $html;
	}
	function global_usernav_extra3(){
		global $_G;
		if ($_G['cache']['plugin']['fx_checkin']['con_open'] && $_G['cache']['plugin']['fx_checkin']['style_topshow']){
			if ($_G['cache']['plugin']['fx_checkin']['self']['todayrank']==0){
				return '<em style="position:relative;" id="fx_checkin_topb" ><a href="javascript:;" onmouseover="fx_checkin_menu(\'fx_checkin_topb\');" onclick="fx_checkin()"><img id="fx_checkin_b" src="source/plugin/fx_checkin/images/mini.gif" alt="'.lang('plugin/fx_checkin', 'alt2').'" style="position:relative;top:5px;height:18px;"></a></em>';
			}else{
				return '<em style="position:relative;" id="fx_checkin_topb" ><a href="plugin.php?id=fx_checkin:list" onmouseover="fx_checkin_menu(\'fx_checkin_topb\');" onclick="fx_checkin()"><img id="fx_checkin_b" src="source/plugin/fx_checkin/images/mini2.gif" alt="'.lang('plugin/fx_checkin', 'alt3').'" style="position:relative;top:5px;height:18px;"></a></em>';
			}
		}
	}

}

class plugin_fx_checkin_forum extends plugin_fx_checkin {
	function index_side_top(){
		global $_G;
		$self = $_G['cache']['plugin']['fx_checkin']['self'];
		$html = '';
		if ($_G['cache']['plugin']['fx_checkin']['con_open'] && $_G['cache']['plugin']['fx_checkin']['style_rightshow']){
			$html .='<div class="moods_opt_box" >';
			$html .='<div class="moods_opt"><div class="con">';
			$html .='<a href="plugin.php?id=fx_checkin:list" id="fx_checkin_level" target="_blank" title="'.lang('plugin/fx_checkin', 'alt1').'">';
			if ($self['todayrank']>0){
				$html .='<span class="tit">'.lang('plugin/fx_checkin', 'self_level').'</span><span class="num" node-type="num">'.$self['level'].'</span>';
			}else{
				$html .='<span class="tit">'.lang('plugin/fx_checkin', 'today_checkin').'</span><span class="num" node-type="num">'.$_G['cache']['plugin']['fx_checkin']['config']['rank'].'</span>';
			}
			$html .='</a></div>';
			$html .='<div class="opt" id="fx_checkin_signb" onmouseover="fx_checkin_menu(\'fx_checkin_signb\');" onclick="fx_checkin()">';
			if ($self['todayrank']>0){
				$html .='<p class="ed"><i class="icon_moods_a"></i></p>';
				$html .='<p class="days">'.lang('plugin/fx_checkin', 'checkin_success4',$self).'</p>';
			}else{
				$html .='<p class="moods"><a href="javascript:;" onclick="return false;" node-type="sign-in"><i class="icon_moods_b"></i></a></p>';
			}
			$html .='</div></div>';
			$html .='<div class="moods_medal"><div class="medal_inner">';
			if ($_G['cache']['plugin']['fx_checkin']['fun_colorname']>0){
				$html_colorname = ($self['constant'] < $_G['cache']['plugin']['fx_checkin']['fun_colorname']) ? '<i class="icon_or_g"' : '<i class="icon_or"';
				$html_colorname .=' id="fx_checkin_icon_or" onmouseover="showMenu({\'ctrlid\':\'fx_checkin_icon_or\',\'pos\':\'34\',\'duration\':2});"></i>';
			}
			if ($_G['cache']['plugin']['fx_checkin']['fun_double']>0){
				$html_double = ($self['constant'] < $_G['cache']['plugin']['fx_checkin']['fun_double']) ? '<i class="icon_dou_g"' : '<i class="icon_dou"';
				$html_double .=' id="fx_checkin_icon_dou" onmouseover="showMenu({\'ctrlid\':\'fx_checkin_icon_dou\',\'pos\':\'34\',\'duration\':2});"></i>';
			}
			$html .= ($_G['cache']['plugin']['fx_checkin']['fun_colorname'] <= $_G['cache']['plugin']['fx_checkin']['fun_double']) ? $html_colorname.$html_double : $html_double.$html_colorname ;

			$html .='<i class="icon_wait_g" id="fx_checkin_icon_wait" onmouseover="showMenu({\'ctrlid\':\'fx_checkin_icon_wait\',\'pos\':\'34\',\'duration\':2});"></i>';
			$html .='</div></div>';
			$html .='</div>';
		
			if ($_G['cache']['plugin']['fx_checkin']['fun_colorname']>0){
				$html .='<div id="fx_checkin_icon_or_menu" class="tip tip_2 moods_tip" style="display: none; "><div class="tip_horn"></div>';
				$html .='<div class="pic"><i class="or_n"></i></div>';
				$html .='<div class="item">'.lang('plugin/fx_checkin', 'fun_colorname').'</div>';
				$html .='<div class="item2">'.lang('plugin/fx_checkin', 'fun_dayhit',array($_G['cache']['plugin']['fx_checkin']['fun_colorname'])).'</div></div>';
			}
			if ($_G['cache']['plugin']['fx_checkin']['fun_double']>0){
				$html .='<div id="fx_checkin_icon_dou_menu" class="tip tip_2 moods_tip" style="display: none; "><div class="tip_horn"></div>';
				$html .='<div class="pic"><i class="dou_n"></i></div>';
				$html .='<div class="item">'.lang('plugin/fx_checkin', 'fun_double').'</div>';
				$html .='<div class="item2">'.lang('plugin/fx_checkin', 'fun_dayhit',array($_G['cache']['plugin']['fx_checkin']['fun_double'])).'</div></div>';
			}
			$html .='<div id="fx_checkin_icon_wait_menu" class="tip tip_2 moods_tip" style="display: none; "><div class="tip_horn"></div>';
			$html .='<div class="pic"><i class="wait_n"></i></div>';
			$html .='<div class="item"><p><br><b>'.lang('plugin/fx_checkin', 'fun_more').'</b></p></div></div>';
		}
		
		return $html;

	}
	function forumdisplay_author_output(){
		global $_G,$verifyuids;
		if ($_G['cache']['plugin']['fx_checkin']['fun_colorname'] > 0){
			$userinfo = C::t('#fx_checkin#rates_plugin')->fetch_all($verifyuids);
			foreach($_G['forum_threadlist'] as $key => $thread) {
				if ($userinfo[$thread['authorid']]['constant'] >= $_G['cache']['plugin']['fx_checkin']['fun_colorname']){
					$_G['forum_threadlist'][$key]['author']= '<font color="#ff873d">'.$thread['author'].'</font>';
					//$_G['forum_threadlist'][$key]['lastposter']= '<font color="#ff873d">'.$thread['lastposter'].'</font>';
				}
			}
		}
	}
	
	function viewthread_profileside_output($a){
		global $_G,$postlist,$uids;
		if (!$_G['cache']['plugin']['fx_checkin']['users']){
			$_G['cache']['plugin']['fx_checkin']['users'] = C::t('#fx_checkin#rates_plugin')->fetch_all($uids);
		}
		$userinfo = $_G['cache']['plugin']['fx_checkin']['users'];
		$echoq = array();
		if ($_G['cache']['plugin']['fx_checkin']['fun_colorname'] > 0){
			foreach($postlist as $pid => $post) {
				if ($userinfo[$post['authorid']]['constant'] >= $_G['cache']['plugin']['fx_checkin']['fun_colorname']){
					$echoq[] = '<script type="text/javascript">var hhd= $("pid'.$pid.'").getElementsByClassName("xw1");if (hhd[0].innerHTML = "'.$post['author'].'"){hhd[0].style.color = "#ff873d";}</script>';
				}else{
					$echoq[] = '';
				}
			}
		}
		return $echoq;
	}
	function viewthread_sidetop_output(){
		global $_G,$postlist,$uids;
		$item = '';
		if (!$_G['cache']['plugin']['fx_checkin']['users']){
			$_G['cache']['plugin']['fx_checkin']['users'] = C::t('#fx_checkin#rates_plugin')->fetch_all($uids);
		}
		$userinfo = $_G['cache']['plugin']['fx_checkin']['users'];
		foreach($postlist as $pid => $post) {
			$item = '';
			if ($_G['cache']['plugin']['fx_checkin']['style_pointshow']){
				$item .= '<div style="margin-left:18px;" ';
				if ($post['upgradecredit'] !== false){
					$item .= ' id="g_up'.$post[pid].'" onmouseover="showMenu({\'ctrlid\':this.id, \'pos\':\'12!\'});"';
				}
				$item .= ' ><span class="user_level"><em class="level_num">'.$post['stars'].'</em><em class="level_name"><a href="home.php?mod=spacecp&ac=usergroup&gid='.$post[groupid].'" target="_blank">'.$post[authortitle].'</a></em></span><div class="cl"></div>';
				if ($post['upgradecredit'] !== false){
					$item .= '<div class="user_expbar" >';
					$num = ($post['credits'] / ($post['credits']+$post['upgradecredit'])) * 100;
					$item .= '<div class="user_expbar_current" style="width: '.$num.'%;"><div class="user_expnum"><span class="cur">'.$post['credits'].'</span>/<span>'.($post['credits']+$post['upgradecredit']).'</span></div></div></div>';
				}
				$item .='</div>';
			}
			if ($_G['cache']['plugin']['fx_checkin']['style_levelshow']){
				if ($userinfo[$post['authorid']]['level']){
					$item .='<dl class="pil cl"  title="'.lang('plugin/fx_checkin', 'alt4').'">';
					$item .='<dt>'.lang('plugin/fx_checkin', 'alt5').'</dt><dd><font color="#FF8243">'.$userinfo[$post['authorid']]['level'].'</font></dd>';
					if ($userinfo[$post['authorid']]['up'] == 0){
						$item .='<dt>'.lang('plugin/fx_checkin', 'alt6').'</dt><dd><i class="fx_up0"></i></dd>';
					}elseif ($userinfo[$post['authorid']]['up'] > 0){
						$item .='<dt>'.lang('plugin/fx_checkin', 'alt6').'</dt><dd><i class="fx_up1"></i>'.$userinfo[$post['authorid']]['up'].'</dd>';
					}else{
						$item .='<dt>'.lang('plugin/fx_checkin', 'alt6').'</dt><dd><i class="fx_up2"></i>'.abs($userinfo[$post['authorid']]['up']).'</dd>';
					}
					$item .='</dl>';
				}
			}
			$echoq[] = $item;
		}
		
		return $echoq;
	}

}

?>