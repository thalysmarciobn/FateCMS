<?php
namespace Plugins;

class Ranking {
	
	private $containers = stdClass;
	
	public function build($containers) {
		$this->containers = $containers;
	}
	
	public function getRankingLevel($limit) {
		return $this->containers->get("database")->select()->from('users')->orderBy("level", "DESC")->limit($limit)->execute()->fetchAll();
	}
}