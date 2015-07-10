<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_ly_weibo_bind extends discuz_table {
	
	public function __construct() {
		$this->_table='ly_weibo_bind';
		$this->_pk='uid';
		parent::__construct();
	}

	public function fetch_by_weibo_uid($weibo_uid) {
		return DB::fetch_first("SELECT * FROM %t WHERE weibo_uid=%d", array($this->_table, $weibo_uid));
	}

	public function fetch_by_discuz_uid($weibo_uid) {
		return DB::fetch_first("SELECT * FROM %t WHERE uid=%d", array($this->_table, $weibo_uid));
	}
}
?>