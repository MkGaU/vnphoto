<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
             'upload'=>'application.controllers.upload.UploadFileAction',
            
            'widget'=>array(
                                'class'=>'CViewAction',
                                'basePath'=>'widgets',
                        ),
             'extension'=>array(
                                'class'=>'CViewAction',
                                'basePath'=>'extensions',
                        ),
                        'module'=>array(
                                'class'=>'CViewAction',
                                'basePath'=>'modules',
                        ),
                        'design'=>array(
                                'class'=>'CViewAction',
                                'basePath'=>'designs',
                        ),
                        // ajaxContent action renders "static" pages stored under 'protected/views/site/pages'
                        // They can be accessed via: index.php?r=site/ajaxContent&view=FileName
                        'ajaxContent'=>array(
                                'class'=>'ext.actions.XAjaxViewAction',
                        ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        Yii::import("xupload.models.XUploadForm");
        $model = new XUploadForm;
        $this -> render('index', array('model' => $model, ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    public function actionUpload()
        {
                if(isset($_FILES['files']))
                {
                        // delete old files
                        foreach($this->findFiles() as $filename)
                                unlink(Yii::app()->params['uploadDir'].$filename);

                        //upload new files
                        foreach($_FILES['files']['name'] as $key=>$filename)
                                move_uploaded_file($_FILES['files']['tmp_name'][$key],Yii::app()->params['uploadDir'].$filename);
                }
                $this->redirect(array('site/widget','view'=>'multifileupload'));
        }
 /**
         * @return array filename
         */
        public function findFiles()
        {
                return array_diff(scandir(Yii::app()->params['uploadDir']), array('.', '..'));
        }
    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}