<?php

class PPPhpButton extends CModel {
	private static $buttons = null;
	public $name = "default";
	public $webSiteCode;
	public $emailLink;
	public $hostedButtonId;

	public function  __construct($name = null, $webSiteCode = null,
			$emailLink = null, $hostedButtonId = null) {
			$this->name = $name;
			$this->webSiteCode = $webSiteCode;
			$this->emailLink = $emailLink;
			$this->hostedButtonId = $hostedButtonId;
	}

	public function attributeNames() {
		return array(
			'name',
			'webSiteCode',
			'emailLink',
			'hostedButtonId',
		);
	}

	public function save() {
		self::addButton($this);
		return self::write();
	}

	public function delete() {
		self::getButtons();
		unset(self::$buttons[$this->name]);
		return self::write();
	}

	public static function getButtons() {
		if (self::$buttons == null) {
			$fn = Yii::app()->modulePath."/payPal/data/buttons.php";
			self::$buttons = require($fn);
		}
		return self::$buttons;
	}

	public static function addButton($button) {
		self::getButtons();
		self::$buttons[$button->name] = $button;
	}

	private static function write() {
		$fn = Yii::app()->modulePath."/payPal/data/buttons.php";
		$content = "<?php\nreturn array(\n";
		foreach (self::getButtons() as $k => $v) {
			$wsc = preg_replace('/\n/', '\\n',$v->webSiteCode);
			$wsc = preg_replace('/"/', '\"',$wsc);
			$content .= "\t'$v->name'=>new PPPhpButton(\n" .
					"\t\t\"{$v->name}\",\n" .
					"\t\t\"{$wsc}\",\n" .
					"\t\t\"{$v->emailLink}\",\n" .
					"\t\t\"{$v->hostedButtonId}\"\n" .
				"\t),\n";
		}
		$content .= ");\n?>";
		if (!($fp = fopen($fn, 'w')))
			return false;
		$result = fwrite($fp, $content);
		return fclose($fp) && $result;
	}
}

?>
