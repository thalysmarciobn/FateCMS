<?php
namespace Plugins;

class PayPal {
	
	private $containers = stdClass;
	
	public function __construct($containers) {
	    $this->containers = $containers;
	}
	
	public function check() {
		$req = 'cmd=_notify-validate';
		$header = "";
		
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "& " . $key . "=" . $value;
		}
		
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen('www.paypal.com', 80, $errno, $errstr, 30);
		if($fp) {
			fputs($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets($fp, 1024);
				if (strcmp($res, "VERIFIED") == 0) {
					$payment_status = $_POST['payment_status'];
					$transaction_id = $_POST['txn_id'];
					$payer_email 	= $_POST['payer_email'];
					$amount_paid	= $_POST['mc_gross'];
					$custom			= $_POST['custom'];
					if ($payment_status == 'Completed') {
						$this->containers->get("database")->insert(array('payment_status', 'transaction_id', 'payer_email', 'amount_paid', 'custom', 'date'))->into('fate_payments')->values(array($payment_status, $transaction_id, $payer_email, $amount_paid, $custom, date("Y-m-d H:i:s")))->execute(true);
					} else if ($payment_status == "Canceled_Reversal") {
						$this->containers->get("database")->insert(array('custom', 'date'))->into('fate_payments_flagged')->values(array($custom, date("Y-m-d H:i:s")))->execute(true);
					}
				}
			}
		}
		fclose($fp);
	}
}