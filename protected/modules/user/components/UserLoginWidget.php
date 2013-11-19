<?php
Yii::import('zii.widgets.CPortlet');

class UserLoginWidget extends CPortlet
{
        public function init()
        {
                $this->title=Yii::t('user', 'Login');
                parent::init();
        }

        protected function renderContent()
        {
                $this->render('userLogin', array('model' => new UserLogin()));
        }
} 
?>