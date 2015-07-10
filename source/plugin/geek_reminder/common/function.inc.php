<?php

class Geek_Reminder
{
	public $point = array(
			'viewthread_title_extra',
			'viewthread_postheader',
			'viewthread_useraction',
			'viewthread_postfooter',
			'viewthread_postaction',
		);

	public $param_key = array(
				'isopen',
				'tid',
				'point',
				'content',
				'time',
				'advance',
				'url',
				'icon',
			);

	private $advance = array(
				'0' => 0,
				'5' => 5,
				'15'=>15,
				'30'=>30
			);

	public $l;
	public $g;
	public $c;
	public $icon;
	public $param;
	public $action;

	public function __construct()
	{
		global $_G;
		loadcache('geek_reminder');
		$this->l	= lang('plugin/geek_reminder');
		$this->g	= $_G;
		$this->c	= $this->g['cache']['geek_reminder'];
		$this->icon		= array(
							'3_1' => $this->l['small'],
							'2_1' => $this->l['normal'],
							'1_1' => $this->l['big']
						);
		$this->param	= array(
							'point' => $this->formatData( $this->point ),
							'icon'	=> $this->formatData( $this->icon ),
							'advance'=> $this->formatData( $this->advance)
						);
		$this->action = 'plugins&operation=config&do='. $_GET['do'] .'&identifier=geek_reminder&pmod=';
	}

	// 格式化数据
	public function format( $data )
	{
		$action = '/admin.php?action='. $this->action;

		foreach( $data as $k => &$v )
		{
			$v['isopen'] = ( $v['isopen'] ) ? $this->l['yes'] : $this->l['no'];
			$v['point'] = $this->point[$v['point']];
			$v['icon'] = $this->icon[$v['icon']];
			$v[] = '<a href="'. $action .'geek_manage&act=del&id='. $k .'"><font color=red>'. $this->l['del'] .'</font></a> | <a href="'. $action .'geek_manage&id='. $k .'">'. $this->l['edit'] .'</a> | <a href="http://connect.qq.com/intro/calendar">'. $this->l['code'] .'</a>';
			unset($v['content']);
			unset($v['url']);
		}

		return $data;
	}

	public function getCode($data)
	{
		return '<a href="http://qzs.qq.com/snsapp/app/bee/widget/open.htm#content=' . $this->encode($data['content']) .'&time=' . $data['time'] .'&advance=' . $data['advance'] .'&url=' . $this->encode($data['url']) . '" target="_blank"><img src="http://i.gtimg.cn/snsapp/app/bee/widget/img/' . $data['icon'] . '.png" style="border:0px;"/></a>';
	}

	private function encode($data)
	{
		return urlencode(iconv("gbk", "UTF-8", $data));
	}

	private function formatData($data)
	{
		$arr = array();
		foreach($data as $k => $v)
		{
			$arr[$k] = array($k, $v);
		}
		return $arr;
	}
}
?>