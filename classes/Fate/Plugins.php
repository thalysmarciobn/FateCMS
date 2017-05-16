<?php
namespace Fate;

class Plugins {
	
	private $plugins = array();
	private $containers = stdClass;
	
	public function __construct($containers) {
		$this->containers = $containers;
	}
	
	public function put($k, $v) {
		if ($this->plugins[$k] != null) {
			throw new Exception("Plugins", "plugin '" . $k . "' in use.");
		} else {
			$this->plugins[$k] = $v;
			$this->plugins[$k]->build($this->containers);
		}
	}
	
	public function get($k) {
		if ($this->plugins[$k] != null) {
			return $this->plugins[$k];
		} else {
			throw new Exception("Plugin", "plugin '" . $k . "' not found.");
		}
	}
}