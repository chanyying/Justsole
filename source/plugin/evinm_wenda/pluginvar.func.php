<?php

if(!defined('IN_DISCUZ') && !defined('IN_ADMINCP')){
    exit('Aecsse Denied');
}

function pluginvarsfunc($pluginvars){
    global $_G, $lang;
    $extra = array();
    foreach($pluginvars as $var) {
        if(strexists($var['type'], '_')) {
            continue;
        }
        $var['variable'] = 'varsnew['.$var['variable'].']';
        if($var['type'] == 'number') {
            $var['type'] = 'text';
        } elseif($var['type'] == 'select') {
            $var['type'] = "<select name=\"$var[variable]\">\n";
            foreach(explode("\n", $var['extra']) as $key => $option) {
                $option = trim($option);
                if(strpos($option, '=') === FALSE) {
                    $key = $option;
                } else {
                    $item = explode('=', $option);
                    $key = trim($item[0]);
                    $option = trim($item[1]);
                }
                $var['type'] .= "<option value=\"".dhtmlspecialchars($key)."\" ".($var['value'] == $key ? 'selected' : '').">$option</option>\n";
            }
            $var['type'] .= "</select>\n";
            $var['variable'] = $var['value'] = '';
        } elseif($var['type'] == 'selects') {
            $var['value'] = dunserialize($var['value']);
            $var['value'] = is_array($var['value']) ? $var['value'] : array($var['value']);
            $var['type'] = "<select name=\"$var[variable][]\" multiple=\"multiple\" size=\"10\">\n";
            foreach(explode("\n", $var['extra']) as $key => $option) {
                $option = trim($option);
                if(strpos($option, '=') === FALSE) {
                    $key = $option;
                } else {
                    $item = explode('=', $option);
                    $key = trim($item[0]);
                    $option = trim($item[1]);
                }
                $var['type'] .= "<option value=\"".dhtmlspecialchars($key)."\" ".(in_array($key, $var['value']) ? 'selected' : '').">$option</option>\n";
            }
            $var['type'] .= "</select>\n";
            $var['variable'] = $var['value'] = '';
        } elseif($var['type'] == 'date') {
            $var['type'] = 'calendar';
            $extra['date'] = '<script type="text/javascript" src="static/js/calendar.js"></script>';
        } elseif($var['type'] == 'datetime') {
            $var['type'] = 'calendar';
            $var['extra'] = 1;
            $extra['date'] = '<script type="text/javascript" src="static/js/calendar.js"></script>';
        } elseif($var['type'] == 'forum') {
            require_once libfile('function/forumlist');
            $var['type'] = '<select name="'.$var['variable'].'"><option value="">'.cplang('plugins_empty').'</option>'.forumselect(FALSE, 0, $var['value'], TRUE).'</select>';
            $var['variable'] = $var['value'] = '';
        } elseif($var['type'] == 'forums') {
            $var['description'] = ($var['description'] ? (isset($lang[$var['description']]) ? $lang[$var['description']] : $var['description'])."\n" : '').$lang['plugins_edit_vars_multiselect_comment']."\n".$var['comment'];
            $var['value'] = dunserialize($var['value']);
            $var['value'] = is_array($var['value']) ? $var['value'] : array();
            require_once libfile('function/forumlist');
            $var['type'] = '<select name="'.$var['variable'].'[]" size="10" multiple="multiple"><option value="">'.cplang('plugins_empty').'</option>'.forumselect(FALSE, 0, 0, TRUE).'</select>';
            foreach($var['value'] as $v) {
                $var['type'] = str_replace('<option value="'.$v.'">', '<option value="'.$v.'" selected>', $var['type']);
            }
            $var['variable'] = $var['value'] = '';
        } elseif(substr($var['type'], 0, 5) == 'group') {
            if($var['type'] == 'groups') {
                $var['description'] = ($var['description'] ? (isset($lang[$var['description']]) ? $lang[$var['description']] : $var['description'])."\n" : '').$lang['plugins_edit_vars_multiselect_comment']."\n".$var['comment'];
                $var['value'] = dunserialize($var['value']);
                $var['type'] = '<select name="'.$var['variable'].'[]" size="10" multiple="multiple"><option value=""'.(@in_array('', $var['value']) ? ' selected' : '').'>'.cplang('plugins_empty').'</option>';
            } else {
                $var['type'] = '<select name="'.$var['variable'].'"><option value="">'.cplang('plugins_empty').'</option>';
            }
            $var['value'] = is_array($var['value']) ? $var['value'] : array($var['value']);

            $query = C::t('common_usergroup')->range_orderby_credit();
            $groupselect = array();
            foreach($query as $group) {
                $group['type'] = $group['type'] == 'special' && $group['radminid'] ? 'specialadmin' : $group['type'];
                $groupselect[$group['type']] .= '<option value="'.$group['groupid'].'"'.(@in_array($group['groupid'], $var['value']) ? ' selected' : '').'>'.$group['grouptitle'].'</option>';
            }
            $var['type'] .= '<optgroup label="'.$lang['usergroups_member'].'">'.$groupselect['member'].'</optgroup>'.
                ($groupselect['special'] ? '<optgroup label="'.$lang['usergroups_special'].'">'.$groupselect['special'].'</optgroup>' : '').
                ($groupselect['specialadmin'] ? '<optgroup label="'.$lang['usergroups_specialadmin'].'">'.$groupselect['specialadmin'].'</optgroup>' : '').
                '<optgroup label="'.$lang['usergroups_system'].'">'.$groupselect['system'].'</optgroup></select>';
            $var['variable'] = $var['value'] = '';
        } elseif($var['type'] == 'extcredit') {
            $var['type'] = '<select name="'.$var['variable'].'"><option value="">'.cplang('plugins_empty').'</option>';
            foreach($_G['setting']['extcredits'] as $id => $credit) {
                $var['type'] .= '<option value="'.$id.'"'.($var['value'] == $id ? ' selected' : '').'>'.$credit['title'].'</option>';
            }
            $var['type'] .= '</select>';
            $var['variable'] = $var['value'] = '';
        } elseif($var['type'] == 'mcheckbox' || $var['type'] == 'mcheckbox2'){
            $drkextra = explode(chr(10),$var['extra']);
            foreach($drkextra as $val){
                $extr = explode('=', $val);
                $arr[] = array($extr[0],trim($extr[1]));
            }
            $var['variable'] = array($var['variable'],$arr);
            unset($arr);
            $var['value'] = unserialize($var['value']);
        } elseif($var['type'] == 'portal'){
            include_once libfile('function/portalcp');
            $var['type'] = category_showselect('portal', $var['variable'], false, $var['value']);
        } elseif($var['type'] == 'portals'){
            $var['description'] = ($var['description'] ? (isset($lang[$var['description']]) ? $lang[$var['description']] : $var['description'])."\n" : '').$lang['plugins_edit_vars_multiselect_comment']."\n".$var['comment'];
            $var['value'] = dunserialize($var['value']);
            $var['value'] = is_array($var['value']) ? $var['value'] : array();
            require_once libfile('function/forumlist');
            $var['type'] = '<select name="'.$var['variable'].'[]" size="10" multiple="multiple"><option value="">'.cplang('plugins_empty').'</option>'.portalselect('catid', 0, '').'</select>';
            foreach($var['value'] as $v) {
                $var['type'] = str_replace('<option value="'.$v.'">', '<option value="'.$v.'" selected>', $var['type']);
            }
            $var['variable'] = $var['value'] = '';
        } elseif($var['type'] == 'mradio' || $var['type'] == 'mradio2'){
            $extras = explode(chr(10), $var['extra']);
            $a[] = $var['variable'];
            foreach($extras as $value){
                $extra = explode('=', $value);
                $b[$var['variable'].'ext'] = '';
                $c[] = $extra[0];
                $c[] = $extra[1];
                $c[] = $b;
                $d[] = $c;
                unset($b);
                unset($c);
            }
            $a[] = $d;
            unset($d);
            $var['variable'] = $a;
            unset($a);
            $extra = '';
        }
        showsetting(isset($lang[$var['title']]) ? $lang[$var['title']] : dhtmlspecialchars($var['title']), $var['variable'], $var['value'], $var['type'], '', 0, isset($lang[$var['description']]) ? $lang[$var['description']] : nl2br(dhtmlspecialchars($var['description'])), dhtmlspecialchars($var['extra']), '', true);
    }
    return $extra;
}

function portalselect($name='catid', $shownull=true, $current='') {
	global $_G;

	if(!isset($_G['cache']['portalcategory'])) {
		loadcache('portalcategory');
	}
	$category = $_G['cache']['portalcategory'];

	$select = "";
	if($shownull) {
		$select .= '<option value="">'.lang('portalcp', 'select_category').'</option>';
	}
	foreach ($category as $value) {
		if($value['level'] == 0) {
			$selected = ($current && $current==$value['catid']) ? 'selected="selected"' : '';
			$select .= "<option value=\"$value[catid]\"$selected>$value[catname]</option>";
			if(!$value['children']) {
				continue;
			}
			foreach ($value['children'] as $catid) {
				$selected = ($current && $current==$catid) ? 'selected="selected"' : '';
				$select .= "<option value=\"{$category[$catid][catid]}\"$selected>-- {$category[$catid][catname]}</option>";
				if($category[$catid]['children']) {
					foreach ($category[$catid]['children'] as $catid2) {
						$selected = ($current && $current==$catid2) ? 'selected="selected"' : '';
						$select .= "<option value=\"{$category[$catid2][catid]}\"$selected>---- {$category[$catid2][catname]}</option>";
					}
				}
			}
		}
	}
	return $select;
}

function haoteam_validator($addonid) {
	$array = cloudaddons_getmd5($addonid);
	if(cloudaddons_open('&mod=app&ac=validator&addonid='.$addonid.($array !== false ? '&rid='.$array['RevisionID'].'&sn='.$array['SN'].'&rd='.$array['RevisionDateline'] : '')) === '0') {
		cpmsg('cloudaddons_genuine_message', '', 'error', array('addonid' => $addonid));
	}
}

function importfile(){
    global $_G, $plugin, $pluginarray;
    $pname = $_GET['dir'] ? $_GET['dir'] : (isset($plugin[identifier]) ? $plugin[identifier] : $pluginarray['plugin']['identifier']);
    $extra = currentlang();
    $extra = $extra ? '_'.$extra : '';
    $importfile = DISCUZ_ROOT.'./source/plugin/'.$pname.'/discuz_plugin_'.$pname.$extra.'.xml';
    if(!file_exists($importfile)) {
        cpmsg('plugin_file_error', '', 'error');
    }
    return $importfile;
}

function check_table_is_exist($find_table) {
    return DB::fetch_first("SHOW TABLES LIKE '$find_table'");
}

class createantitheft{
    var $files = array();
    function createantitheft(){

    }

    function checkdir($oldDir, $identifier, $files){
        $oldDir = str_replace('', '/', $oldDir);
        $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';
        if (!is_dir($oldDir)) {
            return false;
        }
        $dirHandle = @opendir($oldDir);
        while (false !== ($file = readdir($dirHandle))) {
            if ($file == '.' || $file == '..' || $file == 'upload' || stripos($file, '.xml')) {
                continue;
            }
            if (!is_dir($oldDir.$file)) {
                $this->files[] = './source/plugin/'.$identifier.'/'.$file;
            } else {
                self::checkdir($oldDir.$file, $identifier, $this->files);
            }
        }
        closedir($dirHandle);
        return $this->files;
    }
}
?>

