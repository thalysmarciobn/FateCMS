<?php
namespace Controllers;

class home {
	
	public function run($containers) {
		$containers->get("template")->set("name", $containers->get("settings")["web"]["title"]);
		$containers->get("template")->set("base", $containers->get("settings")["web"]["base"]);
		$containers->get("template")->set("serverTime", date("H:i:s") . " " . $containers->get("settings")["web"]["timezone"]);
		$containers->get("template")->set("playersOnline", $containers->get("database")->select()->from("users")->where("CurrentServer", "!=", "Offline")->execute()->rowCount());
		$containers->get("template")->open("home.tpl");
		$containers->get("template")->show();
	}
}