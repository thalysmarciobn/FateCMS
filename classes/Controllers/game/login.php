<?php
namespace Controllers\game;

use SimpleXMLElement;

class login {
	
	public function run($containers) {
		$xml[0] = new SimpleXMLElement('<login/>');
		if (isset($_POST["unm"]) && isset($_POST["pwd"])) {
			$exe[0] = $containers->get("database")->select()->from('users')->where('name', '=', $containers->get("core")->checkSQL($_POST['unm']))->where('hash', '=', $containers->get("core")->hashing($_POST['unm'], $_POST['pwd']))->execute();
			if ($exe[0]->rowCount() > 0) {
				$exe[1] = $exe[0]->fetch();
				if ($exe[1]["Access"] <= 0) {
					$xml[0]->addAttribute('bSuccess', '0');
					$xml[0]->addAttribute('sMsg', 'Your account has been disabled.');
				} else {
					if ($this->container->core->getCountryCode($_SERVER['REMOTE_ADDR']) != null) {
						$containers->get("database")->update(array('Address' => $_SERVER['REMOTE_ADDR']))->table('users')->where('id', '=', $exe[1]["id"])->execute();
						$xml[0]->addAttribute('bSuccess', '1');
						$xml[0]->addAttribute('userid', $exe[1]["id"]);
						$xml[0]->addAttribute('iAccess', $exe[1]["Access"]);
						$xml[0]->addAttribute('iAge', $exe[1]["Age"]);
						$xml[0]->addAttribute('sToken', $exe[1]["Hash"]);
						$xml[0]->addAttribute('iUpgDays', $exe[1]["UpgradeDays"]);
						$xml[0]->addAttribute('bCCOnly', '0');
						$xml[0]->addAttribute('strCountryCode', $this->container->core->getCountryCode($exe[1]["Address"]));
						$xml[0]->addAttribute('unm', $exe[1]["Name"]);
						$exe[2] = $containers->get("database")->select()->from('servers')->execute();
						if ($exe[2]->rowCount() > 0) {
							$exe[3] = $exe[2]->fetchAll();
							foreach ($exe[3] as $key => $server) {
								$xml[1] = $xml[0]->addChild('servers');
								$xml[1]->addAttribute('sName', $exe[3][$key]["Name"]);
								$xml[1]->addAttribute('sIP', $exe[3][$key]["IP"]);
								$xml[1]->addAttribute('iCount', $exe[3][$key]["Count"]);
								$xml[1]->addAttribute('iMax', $exe[3][$key]["Max"]);
								$xml[1]->addAttribute('bOnline', $exe[3][$key]["Online"]);
								$xml[1]->addAttribute('iChat', $exe[3][$key]["Chat"]);
								$xml[1]->addAttribute('bUpg', $exe[3][$key]["Upgrade"]);
								$xml[1]->addAttribute('sLang', $exe[3][$key]["Lang"]);
								$xml[1]->addAttribute('iPort', $exe[3][$key]["Port"]);
							}
						}
					}
				}
			} else {
				$xml[0]->addAttribute('bSuccess', '0');
				$xml[0]->addAttribute('sMsg', 'The username and password you entered did not match. Please check the spelling and try again.');
			}
		} else {
			$xml[0]->addAttribute('bSuccess', '0');
			$xml[0]->addAttribute('sMsg', 'Method not Allowed.');
		}
		$containers->get("template")->plain("text/plain", $xml[0]->asXML());
	}
}