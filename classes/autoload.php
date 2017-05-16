<?php
$data["request"] = strtolower(basename($_SERVER['REQUEST_URI']));
$data["name"] = strtolower(basename( __FILE__ ));
if($data["request"] == $data["name"]) exit("<strong> Error: Auto load.</strong>");
function __autoload($class_name) {
	include("../classes/". strtolower($class_name) .".php"); 
}
?>