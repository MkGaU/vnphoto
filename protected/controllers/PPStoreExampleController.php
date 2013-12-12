<?php

/**
 * This is an example store using ppext. Products are stored in a local
 * session, buttons are stored in a local file. You should change this to
 * save both products and buttons in a database (PPDbButtonManager for
 * buttons and a custom model for your products).
 *
 * NB! DON'T USE QUOTES OR ANY PHP CODE IN PRODUCT NAMES, BUTTONS ARE SAVED
 * AS PHP CODE AND CAN EASILY BREAK (PPPhpButton SHOULD ONLY BE USED IN
 * EXAMPLES UNTIL THIS IS RESOLVED, USE PPDbButton FOR PRODUCTION ENVIRONMENTS).
 *
 * To receive notifications from PayPal, see PPDefaultController. It's using
 * PPPhpTransaction to validate and store transactions, in a production
 * environment you should use a database instead.
 *
 * According to PPPhpTransaction, transactions are valid if all of the
 * following is true:
 * 1. Payment status is "Completed"
 * 2. Transaction has not been processed earlier
 * 3. Receiver email mathes your account
 * 4. Currency is USD
 * 5. Payment amount is more than or equal to 5.00
 * You should change this to match your products, e.g. fetch payment amount
 * and currency from the product database.
 *
 * CREATED: 2010-12-17
 * UPDATED: 2010-12-17
 *
 * @author Stian Liknes <stianlik@gmail.com>
 */
class PPStoreExampleController extends Controller
{
	/**
	 * @var PPButtonManager
	 */
	protected $buttonManager = null;

	protected function beforeAction($action) {
		parent::beforeAction($action);
		$this->buttonManager = Yii::app()->getModule(PayPalModule::$id)->buttonManager;
		return true;
	}

	/**
	 * Public (customer) section.
	 */
	public function actionIndex()
	{
		$text = '<h1>Public section</h1>';
		$this->renderText($text.$this->getProductList());
	}

	/**
	 * Admin section.
	 * - Add products
	 * - Remove products
	 * - List products
	 */
	public function actionAdmin() {
		$text = '';
		if(Yii::app()->user->hasFlash('success')) {
			$text .= '<div class="info">';
			$text .= Yii::app()->user->getFlash('success');
			$text .= '</div>';
		}
		if(Yii::app()->user->hasFlash('error')) {
			$text .= '<div class="info">';
			$text .= Yii::app()->user->getFlash('error');
			$text .= '</div>';
		}

		$text .= CHtml::beginForm($this->createUrl('addProduct'), 'GET');
		$text .= CHtml::textField('name', 'Product name');
		$text .= CHtml::textField('price','20.00');
		$text .= CHtml::submitButton('Add product');
		$text .= Chtml::endForm()."<br />";

		$text .= CHtml::beginForm($this->createUrl('removeProduct'), 'GET');
		$text .= CHtml::textField('name', 'Product name');
		$text .= CHtml::submitButton('Remove product');
		$text .= Chtml::endForm()."<br />";

		$this->renderText($text.$this->getProductList());
	}

	/**
	 * Add product to local session and create buy now button at PayPal.
	 *
	 * Required GET variables:
	 * name = Product name
	 * price = Product price (always use two numbers after the separator, e.g. 20.00)
	 * 
	 */
	public function actionAddProduct() {
		// Save product in session
		$session = Yii::app()->session;
		$product = array($_GET['name'] => array('name'=>$_GET['name'],'price'=>$_GET['price']));
		$session['products'] = isset($session['products']) ? array_merge($session['products'],$product) : $product;

		// Create buy now button
		$nvp = array(
			'BUTTONTYPE'=>'BUYNOW',
			'L_BUTTONVAR0'=>'currency_code=USD',
			'L_BUTTONVAR1'=>'item_name='.$_GET['name'],
			'L_BUTTONVAR2'=>'amount='.$_GET['price'],
		);
		$result = $this->buttonManager->createButton($_GET['name'], $nvp);

		// Display result
		if ($result === false) {
			Yii::app()->user->setFlash('error','Could not create button, please review the error log.');
			$this->redirect($this->createUrl('admin'));
		}
		Yii::app()->user->setFlash('success','Successfully created new button.');
		$this->redirect($this->createUrl('admin'));
	}

	/**
	 * Remove product from session and delete buy now button from PayPal.
	 *
	 * Required GET variables:
	 * name = Product name
	 * price = Product price (always use two numbers after the separator, e.g. 20.00)
	 *
	 */
	public function actionRemoveProduct() {
		// Remove product from session
		if (isset($_SESSION['products'][$_GET['name']]))
			unset($_SESSION['products'][$_GET['name']]);

		// Remove button from PayPal
		$result = $this->buttonManager->manageButtonStatus($_GET['name']);

		// Display result
		if ($result === false) {
			Yii::app()->user->setFlash('error','Could not remove button, please review the error log.');
			$this->redirect($this->createUrl('admin'));
		}
		Yii::app()->user->setFlash('success','Successfully removed button.');
		$this->redirect($this->createUrl('admin'));
	}

	/**
	 * @return string List of products (HTML)
	 */
	private function getProductList() {
		$products = Yii::app()->session['products'];
		if (!is_array($products)) 
			return 'No products';
		$text = '';
		foreach($products as $k => $v) {
			$button = $this->buttonManager->getButton($k);
			if (!$button) continue;
			$text .= '<h2>'.$v['name'].'</h2>';
			$text .= '<p>Price: '.$v['price'].' USD</p>';
			$text .= $button->webSiteCode.'<br/>';
		}
		return $text;
	}
}