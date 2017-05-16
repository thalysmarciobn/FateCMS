<?php
return [
    'web' => [
	    'title' => 'AQWorlds',
	    'base' => 'http://127.0.0.1/public/',
		'timezone' => 'Asia/Tokyo'
	],
	
	'email' => [
		'address' => 'email@gmail.com',
		'password' => '',
		'host' => 'mail.google.com',
		'port' => 587,
		'secure' => 'tls',
		'auth' => true,
		'debug' => 5,
		'debug out put' => 5
	],
	
	'database' => [
		'host' => '127.0.0.1',
		'dbuser' => 'root',
		'dbpass' => '3251thaX@',
		'dbname' => 'nemesis',
		'port' => 3306,
	],
	
	'game' => [
		'title' => 'Title Here',
		'flash' => 'Client.swf',
		'background' => 'Background.swf'
	]
];