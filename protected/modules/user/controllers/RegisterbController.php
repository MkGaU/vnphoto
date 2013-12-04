<?php

class RegisterbController extends Controller
{
	public $defaultAction = 'registerb';

	/**
	 * Displays the login page
	 */
        public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	 public function  actionRegisterb(){
             if (Yii::app()->user->isGuest) {
             $model_l = new UserLogin;
             $model = new RegistrationForm;
             $profile=new Profile;
            $profile->regMode = true;
        
        if(isset($_POST['UserLogin'])) {
                // Process your site login here
                $model_l->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model_l->validate()) {
					$this->lastViset();
                                         if(Yii::app()->user->getIsSuperuser()){
                                          $this->redirect(Yii::app()->user->returnUrl=='application/views/image/index.php'); 
                                        }
                                        else {
                                            $this->redirect(Yii::app()->user->returnUrl);
                                            
                                      }
//					if (Yii::app()->user->returnUrl=='application/views/image/index.php')
//						$this->redirect(Yii::app()->controller->module->returnUrl);
//					else
//						$this->redirect(Yii::app()->user->returnUrl);
				}

                /* ..... */
              
        } 
        else if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } 
        else if(isset($_POST['RegistrationForm'])) {
            if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model,$profile));
				Yii::app()->end();
			}
            $model->attributes=$_POST['RegistrationForm'];
					$profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
					if($model->validate()&&$profile->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->superuser=0;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
						if ($model->save()) {
							$profile->user_id=$model->id;
							$profile->save();
							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
								UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}
							
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
								}
								$this->refresh();
							}
						}
					} else $profile->validate();
                // Process your user sign-up here
        }
        
        
        $this->render('/user/Registerb', array('model_l'=>$model_l, 'model'=>$model,'profile'=>$profile));
        } else
			$this->redirect(Yii::app()->controller->module->returnUrl);
       
            
        }
        private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}


}