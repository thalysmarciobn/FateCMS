<?php
namespace Controllers\game;

class version {
	
	public function run($containers) {
		$containers->get("template")->plain("text/plain", $containers->get("core")->variables(array("status" => "success", "sFile" => $containers->get("settings")["game"]["flash"], "sTitle" => $containers->get("settings")["game"]["title"], "sBG" => $containers->get("settings")["game"]["background"])));
	}
}