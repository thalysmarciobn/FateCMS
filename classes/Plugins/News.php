<?php
namespace Plugins;

class News {
	
	private $containers = stdClass;
	
	public function build($containers) {
		$this->containers = $containers;
	}
	
	public function getNews($limit) {
		return $this->containers->get("database")->select()->from('fate_news')->orderBy("id", "DESC")->limit($limit)->execute()->fetchAll();
	}
	
	public function getNewsPagination($x, $y) {
		return $this->containers->get("database")->select()->from('fate_news')->orderBy("id", "DESC")->limit($x, $y)->execute()->fetchAll();
	}
}