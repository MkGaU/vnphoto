<?php
class PPAccount extends CModel {
	public $username;
	public $password;
	public $signature;
	public $email;
	public $identityToken;

	public function attributeNames() {
		return array(
			'username',
			'password',
			'signature',
			'email',
			'identityToken',
		);
	}

	public function getNvp() {
		return array(
			'USER'=>$this->username,
			'PWD'=>$this->password,
			'SIGNATURE'=>$this->signature,
		);
	}
}

?>
