<?php
/**
 *      ��Ȩ����: �ó���Ϊ [DiscuzCMS!] ������������, ����ӵ�иò�Ʒ֪ʶ��Ȩ,���д����Ȩ��[DiscuzCMS!]����, �����ھ�Ϊ��ҵ����, ��Ϊ�������ṩʹ����Ȩ.
 *		��������: δ���ٷ���Ȩʹ���޸Ļ��ߴ�������������Ȩ��Υ����Ϊ, ������׷��һ����ط�������.
 *		�ٷ���վ: http://www.DiscuzCMS.com 
**/

if(!defined('IN_DISCUZ')) {exit('Access Denied');}

loadcache('plugin');
$sale_config = $_G['cache']['plugin']['sale'];
$sale_config['root'] = $sale_config['siteurl']."sale.php";
$sale_config['uc'] = $_G['ucenterurl'];
$sale_config['sale'] = $sale_config['siteurl']."source/plugin/sale/";
$sale_config['ue'] = $sale_config['sale']."ueditor/";

$_lang = lang('plugin/sale');
?>