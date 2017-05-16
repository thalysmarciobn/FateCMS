<?php
namespace Fate;

use Fate\Template;

class Exception extends Template {
	
	public function __construct($title, $message) {
		$this->set("title", $title);
		$this->set("message", $message);
		$this->open("../classes/Fate/pages/exception.tpl");
		$this->show();
		exit();
	}
}