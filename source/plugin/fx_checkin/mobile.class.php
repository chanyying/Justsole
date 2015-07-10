<?php
if(!defined('IN_DISCUZ')) exit('Access Denied');
class mobileplugin_fx_checkin{
        function global_header_mobile(){
			global $_G;
			if (!$_G['cache']['plugin']['fx_checkin']['config']){
				C::t('#fx_checkin#rates_plugin')->check_rates();
				if ($_G['cache']['plugin']['fx_checkin']['self']['todayrank']==0){
					return ' [<a href="plugin.php?id=fx_checkin:checkin&formhash='.FORMHASH.'">'.lang('plugin/fx_checkin', 'alt2').'</a>]';
				}else{
					return '';
				}
			}
			
        }
}
?>