<?php

class PPIpnAction extends CAction {
	/**
	 * Process the IPN request.
	 *
	 * Payment processing:
	 *
	 * 1. Confirm the payment status
	 * 2. Validate that the receiver_email is an email address registered in
	 *    your PayPal account, to prevent the payment from being sent to a
	 *	  fraudster’s account.
     * 3. Make sure that the txn_id is not a duplicate to prevent someone
	 *    from using reusing an old, completed transaction.
     * 4. Check other transaction details, such as the item number, price, and
	 *    currency to confirm that the price has not been changed.
	 * 5. Save transaction
	 *
	 * Listeners should run onSucces or onFailure after processing a request.
	 *
	 * @param PPEvent $event
	 */
	public function onRequest($event) {
		$this->raiseEvent("onRequest", $event);
	}

	/**
	 * Action performed if processing succeeds.
	 *
	 * @param PPEvent $event Event
	 */
	public function onSuccess($event) {
		$this->raiseEvent("onSuccess", $event);
	}


	/**
	 * Action performed if any step fails.
	 *
	 * @param PPEvent $event
	 */
	public function onFailure($event) {
		$this->raiseEvent("onFailure", $event);
	}
	
	public function run() {
		$event = new PPEvent($this);

		/* If transaction id is missing, it's logged and a failure event is raised */
		// 2010-10-28: TESTED OK
//		if (!isset($_POST['txn_id'])) {
//			$event->msg = "IPN Listner recieved an HTTP request without a Transaction ID.";
//			Yii::log($event->msg, "error", "payPal.controllers.ipn.PPIpnAction");
//			$this->onFailure($event);
//			return;
//		}

		/** Send IPN Request (HTTP POST) to PayPal **/
		// 2010-10-28: TESTED OK
		$event->requestAr = array_merge(array("cmd"=>"_notify-validate"), $_POST);
		$postVars = PPUtils::implode('&',PPUtils::urlencode($event->requestAr));
		$response = PPUtils::httpPost(PPUtils::getUrl(PPUtils::IPN), $postVars, false);

		/** If IPN request fails it is logged and a failure event is raised **/
		// 2010-10-28: TESTED OK
		if ($response["status"] == false) {
			$event->msg = "HTTP POST request to PayPal failed";
			Yii::log("{$event->msg}\nRequest:\n$postVars", "error", "payPal.controllers.ipn.PPIpnAction");
			$this->onFailure($event);
			return;
		}

		// It will only be one line in the response
		$event->responseAr = explode("\n", $response["httpResponse"]);

		/** If PayPal is unable to verify a request it is logged and a failure event is raised **/
		// 2010-10-28: TESTED OK
		if (count($event->responseAr) < 1 || $event->responseAr[0] != 'VERIFIED') {
			$event->msg = "IPN request failed";
			Yii::log("{$event->msg}\nRequest:\n$postVars\nResponse:\n{$response["httpResponse"]}",
					"error", "payPal.controllers.ipn.PPIpnAction");
			$this->onFailure($event);
			return;
		}

		/** Log successfull request and raise a onRequest event */
		// 2010-10-28: TESTED OK
		$event->details = $event->requestAr;
		$event->msg = "Successfull IPN request";
		Yii::log("{$event->msg}\nRequest:\n$postVars\nResponse:\n{$response["httpResponse"]}",
					"info", "payPal.controllers.ipn.PPIpnAction");
		$this->onRequest($event);
	}
}
?>