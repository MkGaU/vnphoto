<?php

class GenerateForm extends CFormModel
{
	public $items;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('items', 'safe'),
		);
	}
}
