<?php
namespace Controllers\game;

class signup {
	
	public function run($containers) {
		if (isset($_POST['strUsername']) && isset($_POST['strPassword']) && isset($_POST['strEmail']) && isset($_POST['strGender']) && isset($_POST['intAge']) && isset($_POST['intColorEye']) && isset($_POST['intColorSkin']) && isset($_POST['intColorHair']) && isset($_POST['intColorHair']) && isset($_POST['HairID'])) {
			$exe[0] = $containers->get("database")->select()->from('users')->where('name', '=', $containers->get("core")->checkSQL($_POST['strUsername']))->execute();
			if ($exe[0]->rowCount() <= 0) {
				$containers->get("database")->insert(array('Name', 'Hash', 'Coins', 'Email', 'Gender', 'Age', 'ColorEye', 'ColorSkin', 'ColorHair', 'HairID', 'DateCreated', 'UpgradeExpire', 'HouseInfo', 'Address'))->into('users')->values(array($containers->get("core")->checkSQL($_POST['strUsername']), $containers->get("core")->hashing($_POST['strUsername'], $_POST['strPassword']), '10000', $containers->get("core")->checkSQL($_POST['strEmail']), $containers->get("core")->checkSQL($_POST['strGender']), $containers->get("core")->checkSQL($_POST['intAge']), dechex($_POST['intColorEye']), dechex($_POST['intColorSkin']), dechex($_POST['intColorHair']), $containers->get("core")->checkSQL($_POST['HairID']), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), '', $_SERVER['REMOTE_ADDR']))->execute(true);
				$userId = $containers->get("database")->lastInsertId();
				switch ($_POST['ClassID']) {
					case 4:
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('4', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('7', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						break;
					case 3:
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('3', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('7', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						break;
					case 2:
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('2', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('6', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						break;
					case 1:
					default:
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('1', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						$containers->get("database")->insert(array('ItemID', 'UserID', 'Equipped', 'Bank', 'Quantity', 'EnhID', 'DatePurchased'))->into('users_items')->values(array('5', $userId, '1', '0', '1', '1', date("Y-m-d H:i:s")))->execute(true);
						break;
				}
				$containers->get("template")->plain("text/plain", $containers->get("core")->variables(array("status" => "Success")));
			} else {
				$containers->get("template")->plain("text/plain", $containers->get("core")->variables(array("status" => "Taken", "strReason" => "Username already exists!")));
			}
		} else {
			$containers->get("template")->plain("text/plain", $containers->get("core")->variables(array("status" => "Taken", "strReason" => "Method not Allowed!")));
		}
	}
}