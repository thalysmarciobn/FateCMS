<?php
namespace Fate;

class Routes {
	
	private $routes = array();
	
	public function put($k, $v) {
		if ($this->routes[$k] != null) {
			throw new Exception("Routes", "router '" . $k . "' in use.");
		} else {
			$this->routes[$k] = $v;
		}
	}
	
	public function get($k) {
		if ($this->routes[$k] != null) {
			return $this->routes[$k];
		} else {
			throw new Exception("404", "Router not found.");
		}
	}
}