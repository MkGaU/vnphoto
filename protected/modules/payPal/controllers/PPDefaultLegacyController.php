<?php

class PPDefaultLegacyController extends Controller
{
	public function actionIndex()
	{
		$this->renderText("PayPal example controller");
	}

	/**
	 * Show payment details to customer when PDT is received.
	 */
	public function actionPdt() {
		$pdt = new PPPdtAction($this, "pdt");

		// Just invoking a success event, processing done by IPN listener
		$pdt->onRequest = array($this, "pdtRequest");

		// Notify user about successfull payment
		$pdt->onSuccess = array($this, "pdtSuccess");

		// Notify user about failed payment
		$pdt->onFailure = array($this, "pdtFailure");

		$pdt->run();
	}

	/**
	 * Process payment and notify user if IPN is received.
	 */
	public function actionIpn() {
		$ipn = new PPIpnAction($this,"ipn");

		/*
		 * Process payment
		 *
		 * See PPPhpTransaction for validation details, important values:
		 * - PPPhpTransaction::currency = Valid currency (default: USD)
		 * - PPPhpTransaction::amount = Minumum payment amount (default: 5.00)
		 *
		 * I recommend using an active record for storage / validation.
		 */
		$ipn->onRequest = array($this, "ipnRequest");

		// Ignoring failures
		$ipn->onFailure = array($this, "ipnFailure");

		// Send confirmation mail to customer
		$ipn->onSuccess = array($this, "ipnSuccess");

		$ipn->run();
	}

	public function pdtRequest($event) {
		$event->sender->onSuccess($event);
	}

	public function pdtSuccess ($event) {
		$str = "Success<br />";
		foreach ($event->details as $k => $v)
			$str.="$k => $v<br />";
		$event->sender->controller->renderText($str);
	}

	public function pdtFailure($event) {
		$event->sender->controller->renderText("Failure");
	}

	public function ipnRequest($event) {
		// Check if this is a transaction
		if (!isset($event->details["txn_id"])) {
			$event->msg = "Missing txn_id";
			Yii::log($event->msg,"warning","payPal.controllers.DefaultController");
			$event->sender->onFailure($event);
			return;
		}
		
		// Put payment details into a transaction model
		$transaction = new PPPhpTransaction;
		$transaction->paymentStatus = $event->details["payment_status"];
		$transaction->mcCurrency = $event->details["mc_currency"];
		$transaction->mcGross = $event->details["mc_gross"];
		$transaction->receiverEmail = $event->details["receiver_email"];
		$transaction->txnId = $event->details["txn_id"];

		// Failed to process payment: Log and invoke failure event
		if (!$transaction->save()) {
			$event->msg = "Could not process payment";
			Yii::log("{$event->msg}\nTransaction ID: {$event->details["txn_id"]}", "error",
					"payPal.controllers.DefaultController");
			$event->sender->onFailure($event);
		}

		// Successfully processed payment: Log and invoke success event
		else if ($transaction->save()) {
			$event->msg = "Successfully processed payment";
			Yii::log("{$event->msg}\nTransaction ID: {$event->details["txn_id"]}", "info",
					"payPal.controllers.DefaultController");
			$event->sender->onSuccess($event);
		}
	}

	public function ipnSuccess($event) {
		$to = $event->details["payer_email"];
		$from = $event->details["receiver_email"];
		$subject = "Payment received";
		$body = "Your payment has been processed.\n" .
			"Receiver: $from\n" .
			"Amount: {$event->details["mc_gross"]} {$event->details["mc_amount"]}\n";
		$headers="From: $from\r\nReply-To: $from";
		mail($to,$subject,$body,$headers);
	}

	function ipnFailure($event) {
		// Could e.g. send a notification mail on certain events
	}
}