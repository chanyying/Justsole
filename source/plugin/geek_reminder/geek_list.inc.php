<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
@include DISCUZ_ROOT. 'source/plugin/geek_reminder/common/function.inc.php';
$geek = new Geek_Reminder();
showtableheader();
showsubtitle(array( $geek->l['set_isopen'], $geek->l['set_tid'], $geek->l['set_point'], $geek->l['set_time'], $geek->l['set_advance'], $geek->l['set_icon'], $geek->l['ctrl'] ), 'header partition', array( 'width="10%"', 'width="10%"', 'width="20%"', 'width="20%"', 'width="10%"', 'width="10%"', 'width="20%"'));
if( empty($geek->c) )
{
	showtitle( $geek->l['tips_not_set'] );
} else {
	$cache = $geek->format( $geek->c );
	foreach($cache as $v)
	{
		showtablerow( 'hover', array('width=100'), $v );
	}
}
showformheader();