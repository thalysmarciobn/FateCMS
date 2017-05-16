<?php
namespace Fate;

use Fate\Routes;
use Fate\Containers;
use Fate\Plugins;
use Fate\PDO\Database;
use Fate\Core;
use Fate\Template;
use Fate\PayPal;
use Email\PHPMailer;

class App  {
	private $settings = array();
	private $plugins = stdClass;
	private $containers = stdClass;
	private $routes = stdClass;
	private $phpMailer = stdClass;
	
	public function __construct() {
		$this->settings = include "../settings.php";
		$this->containers = new Containers();
		$this->routes = new Routes();
		$this->plugins = new Plugins($this->containers);
		$this->phpMailer = new PHPMailer();
		$this->containers->put("settings", $this->settings);
		$this->containers->put("database", new Database("mysql:host=" . $this->settings["database"]["host"] . ";dbname=" . $this->settings["database"]["dbname"] . ";charset=utf8", $this->settings["database"]["dbuser"], $this->settings["database"]["dbpass"]));
		$this->containers->put("core", new Core());
		$this->containers->put("template", new Template($this->plugins));
		date_default_timezone_set($this->settings["web"]["timezone"]);
	}
	
	public function getContainers() {
		return $this->containers;
	}
	
	public function getPlugins() {
		return $this->plugins;
	}
	
	public function getRoutes() {
		return $this->routes;
	}
	
	public function sendEmail($email, $login, $body) {
		$this->phpMailer->IsSMTP(); 
		$this->phpMailer->SMTPDebug  = 0;  
		$this->phpMailer->Host       = $this->settings["email"]["host"];
		$this->phpMailer->Port       = $this->settings["email"]["port"];
		$this->phpMailer->Secure     = $this->settings["email"]["secure"];
		$this->phpMailer->Auth       = $this->settings["email"]["auth"];
		$this->phpMailer->From       = $this->settings["email"]["address"];
		$this->phpMailer->Username   = $this->settings["email"]["address"];
		$this->phpMailer->Password   = $this->settings["email"]["password"];
		$this->phpMailer->FromName   = $this->settings["web"]["title"];
		$this->phpMailer->Subject    = 1;
		$this->phpMailer->MsgHTML($body);
		$this->phpMailer->AddAddress($email, $login);
		if(!$this->phpMailer->Send()) {
			throw new Exception("SMTP", "Can't connect to SMTP");
		}
	}
	
	public function run() {
		if ($this->routes->get($_GET["fate"]) != null) {
			$this->routes->get($_GET["fate"])->run($this->containers);
		}
	}
}