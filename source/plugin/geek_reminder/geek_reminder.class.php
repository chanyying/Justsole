<?php
/**
 * QQ Reminder
 * @author Geek_louis <402035985@qq.com>
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
@include DISCUZ_ROOT. './source/plugin/geek_reminder/common/function.inc.php';
class plugin_geek_reminder
{
	private $c;
	private $l;
	private $g;
	private $tid;
	private $m;

	public function __construct()
	{
		$this->m = new Geek_Reminder();
		$this->g = $this->m->g;
		$this->c = $this->m->c;
		$this->l = $this->m->l;
		$this->tid = $this->g['thread']['tid'];
	}

	protected function display($ex)
	{
		if( $this->tid )
		{
			if( $data = $this->c[$this->tid] )
			{
				if( $this->m->point[$data['point']] == $ex )
				{
					return $this->m->getCode($data);
				}
			}
			return ( $code ) ? $code : false;
		}
	}

}

class plugin_geek_reminder_forum extends plugin_geek_reminder
{
	public function viewthread_title_extra()
	{
		return $this->display(__FUNCTION__);
	}

	public function viewthread_postheader()
	{
		return array($this->display(__FUNCTION__));
	}

	public function viewthread_useraction()
	{
		return $this->display(__FUNCTION__);
	}

	public function viewthread_postfooter()
	{
		return array($this->display(__FUNCTION__));
	}

	public function viewthread_postaction()
	{
		return array($this->display(__FUNCTION__));
	}
}

?>