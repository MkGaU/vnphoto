<?php

class PPPhpTransaction extends CModel {
	// Settings
	static public $currency = "USD";
	static public $amount = "5.00";

	// Details from PayPal (PPEvent::details)
	public $paymentStatus;
	public $txnId;
	public $receiverEmail;
	public $mcCurrency;
	public $mcGross;

	// Used for PHP file storage
	static private $transactions = null;

	/**
	 * Used for PHP file storage.
	 * @param string $txnId
	 */
	public function  __construct($txnId = null) {
		$this->txnId = $txnId;
	}

	/**
	 * @return array Validation rules for the transaction
	 */
	public function rules() {
		return array(
			// Only process completed payments
			array('paymentStatus', 'compare', 'compareValue' => 'Completed'),

			// Do not process duplicates
			array('txnId','uniqueValidator'),

			// Only process payments sent to configured account
			array('receiverEmail','compare', 'compareValue' => Yii::app()->getModule('payPal')->account->email),

			// Check currency
			array('mcCurrency', 'compare', 'compareValue' => self::$currency),

			// Check payment amount
			array('mcGross', 'paymentValidator', 'amount'),
		);
	}

	public function attributeNames() {
		return array(
			array('paymentStatus', 'txnId', 'receiverEmail', 'mcCurrency', 'mcGross', 'quantity')
		);
	}

	/**
	 * Same as Yii's unique validator, but for PHP file storage.
	 *
	 * @param mixed $attribute
	 * @param array $params Not in use
	 */
	public function uniqueValidator($attribute, $params) {
		foreach ($this->getTransactions() as $v) {
			if ($v->txnId == $this->$attribute) {
				$this->addError($attribute, "Transaction is a duplicate", "error", "payPal.model.PPPhpTransaction");
				return;
			}
		}
	}

	/**
	 * Validate payment.
	 * 
	 * @param string $attribute mc_gross from PayPal
	 * @param array $params
	 */
	public function paymentValidator($attribute, $params) {
		if ($attribute < self::$amount)
			$this->addError($attribute, "Insufficient payment amount");
	}

	/**
	 * Save transaction to PHP file (Webroot/modules/payPal/data/transactions.php).
	 * 
	 * @return true on success, false on failure
	 */
	public function save() {
		if (!$this->validate())
			return false;
		self::addTransaction($this);
		$fn = Yii::app()->modulePath."/payPal/data/transactions.php";
		$content = "<?php\nreturn array(\n";
		foreach (self::getTransactions() as $v)
			$content .= "\tnew PPPhpTransaction('{$v->txnId}'),\n";
		$content .= ");\n?>";
		$fp = fopen($fn, 'w');
		fwrite($fp, $content);
		fclose($fp);
		return true;
	}

	/**
	 * If $this->transactions == null, all transactions are loaded by
	 * including a PHP file (see save()).
	 * @return array Transactions
	 */
	static public function getTransactions() {
		if (self::$transactions == null) {
			$fn = Yii::app()->modulePath."/payPal/data/transactions.php";
			self::$transactions = require($fn);
		}
		return self::$transactions;
	}

	/**
	 * @param PPPhpTransaction $txn
	 */
	static public function addTransaction($txn) {
		self::getTransactions();
		self::$transactions[] = $txn;
	}
}

?>
