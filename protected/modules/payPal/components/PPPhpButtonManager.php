<?php

class PPPhpButtonManager extends PPButtonManager {
	public function getButton($name) {
		$buttons = PPPhpButton::getButtons();
		return isset($buttons[$name]) ? $buttons[$name] : false;
	}

	protected function createNewButtonModel() {
		return new PPPhpButton;
	}
}
?>
