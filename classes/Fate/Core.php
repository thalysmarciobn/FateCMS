<?php
namespace Fate;

class Core {
	
	public function checkSQL($query) {
		$query = preg_replace(sql_regcase("(from|union|select|order by|insert|delete|where|drop table|show tables)"), "", $query);
		$query = trim($query);
		$query = strip_tags($query);
		$query = addslashes($query);
		return $query;
	}
	
	public function hashing($x, $y) {
		return strrev(strtoupper(substr(hash('sha512', $y . strtolower($x)), strlen($x), 17)));
	}
	
	public function setSession($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	public function getSession($key) {
		return $_SESSION[$key];
	}
	
	public function destroySession() {
		session_destroy();
	}
	
	public function test() {
		print "ok";
	}
	
	public function variables($variables) {
		$string = "";
		foreach($variables as $key => $value) {
			$string .= $key . "=" . $value;
			@$end = end(array_keys(@$variables));
			if ($key != $end) {
				$string .= "&";					
			}
		}
		return $string;
	}
}