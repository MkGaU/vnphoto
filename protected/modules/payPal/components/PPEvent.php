<?php
class PPEvent extends CEvent {
	/**
	 * @var array HTTP response from PayPal in array(..,name => value,..) form
	 */
	public $responseAr = array();

	/**
	 * @var array HTTP request to PayPal array(..,name => value,..) form
	 */
	public $requestAr = array();	// HTTP Request sent to PayPal

	/**
	 * @var array Verified payment details in array(..,name => value,..) form
	 */
	public $details = array();

	/**
	 * @var array Description of event, useful for logging, user notification, etc.
	 */
	public $msg = "";
}
?>
