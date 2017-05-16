<?php
namespace Fate;

class Containers {
	
	private $containers = array();
	
	public function put($k, $v) {
		if ($this->containers[$k] != null) {
			throw new Exception("Container", "container '" . $k . "' in use.");
		} else {
			$this->containers[$k] = $v;
		}
	}
	
	public function get($k) {
		if ($this->containers[$k] != null) {
			return $this->containers[$k];
		} else {
			throw new Exception("Container", "container '" . $k . "' not found.");
		}
	}
}