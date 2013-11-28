<?php

Yii::import('ext.helpers.EDownloadHelper');

class ImageController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'DownloadFile', 'Upload', 'SuggestImages', 'SuggestTags'),
                'roles' => array('uploader'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function createThumbnail($imagePath, $imageThumbPath) {
        $im = new Imagick();
        $im->readImage(Yii::app()->basePath . '/..' . $imagePath);

        $watermark = new Imagick();
        $watermark->readimage(Yii::app()->basePath . '/../watermark/w3-fix.png');

        //get size original image and watermark image
        $iWidth = $im->getimagewidth();
        $iHeight = $im->getimageheight();
        $wWidth = $watermark->getimagewidth();
        $wHeight = $watermark->getimageheight();

        if ($iHeight > $wHeight || $iWidth > $wWidth) {
            // resize the watermark
            $watermark->scaleImage($iWidth, $iHeight);

            // get new size
            $wWidth = $watermark->getImageWidth();
            $wHeight = $watermark->getImageHeight();
        }

        // calculate the position
        $x = ($iWidth - $wWidth) / 2;
        $y = ($iHeight - $wHeight) / 2;

        $im->compositeimage($watermark, Imagick::COMPOSITE_OVER, $x, $y);

        /*         * * thumbnail the image ** */

        $im->thumbnailImage(460, null);
        $im->writeimage(Yii::app()->basePath . '/..' . $imageThumbPath);
    }

    public function createMkdir($y, $m, $d) {
        $basePath = Yii::app()->basePath . '/../images/' . $y . '/' . $m . '/' . $d;
        $path = '/images/' . $y . '/' . $m . '/' . $d;
        if (!file_exists($basePath . '/thumbs')) {
            mkdir($basePath . '/thumbs', 0, true);
            return $path;
        }
        return $path;
    }

    public function actionForm() {
        $model = new Image();
        Yii::import("xupload.models.XUploadForm");
        $photos = new XUploadForm();
        if (isset($_POST['Image'])) {
            //Assign our safe attributes
            $model->attributes = $_POST['Image'];
            //Start a transaction in case something goes wrong
            $transaction = Yii::app()->db->beginTransaction();
            try {
                //Save the model to the database
                if ($model->save()) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->handleException($e);
            }
        }
        $this->render('_form', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }

    public function actionUpload() {
        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = realpath(Yii::app()->getBasePath() . "/../images/uploads/tmp/") . "/";
        $publicPath = Yii::app()->getBaseUrl() . "/images/uploads/tmp/";

        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $filename .= "." . $model->file->getExtensionName();
                if ($model->validate()) {
                    //Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);
                    chmod($path . $filename, 0777);
                    //here you can also generate the image versions you need 
                    //using something like PHPThumb
                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('images')) {
                        $userImages = Yii::app()->user->getState('images');
                    } else {
                        $userImages = array();
                    }
                    $userImages[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated
                        "thumb" => $path . $filename,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                    );
                    Yii::app()->user->setState('images', $userImages);

                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
                            "thumbnail_url" => $publicPath . "thumbs/$filename",
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $filename
                            )),
                            "delete_type" => "POST"
                )));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Image();

        if (isset($_POST['Image'])) {
            $model->attributes = $_POST['Image'];
            $model->filename = CUploadedFile::getInstance($model, 'filename');
            //Get image extension
            $model->format = $model->filename->getExtensionName();
            //Get image size in bytes
            $model->size = $model->filename->getSize();
            //Get path of the uploaded file on the server
            $path = $model->filename->getTempName();
            //Get dimension of image that uploaded
            $dimension = new Imagick();
            $dimension->readimage($path);
            $model->width = $dimension->getimagewidth();
            $model->height = $dimension->getimageheight();
            // Encrypt name of image by md5
            $thumbName = md5(date('dmy') . time() . rand());
            $imageName = md5(date('YMD') . time() . rand());
            $model->ImgLink = $this->createMkdir(date('Y', time()), date('m', time()), date('d', time())) . '/' . $imageName . '.' . $model->format;
            $model->thumbnails = $this->createMkdir(date('Y', time()), date('m', time()), date('d', time())) . '/thumbs/' . $thumbName . '.' . $model->format;
            if ($model->save()) {
                $model->filename->saveAs(Yii::app()->basePath . '/..' . $model->ImgLink);
                $this->createThumbnail($model->ImgLink, $model->thumbnails);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Image'])) {
            $model->attributes = $_POST['Image'];
//            $uploadedFile = CUploadedFile::getInstance($model, 'ImgLink');
//            $model->ImgLink = $uploadedFile;
            if ($model->save()) {
//                $imagePath = Yii::app()->basePath . '/../images/';
//                $uploadedFile->saveAs($imagePath . $uploadedFile);  // image will uplode to rootDirectory
//                $this->createThumbnail($imagePath, $uploadedFile);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Image('search');
        $model->unsetAttributes(); // clear any default values


        if (isset($_GET['tag'])) {
            $criteria = new CDbCriteria(array(
                'condition' => 'status=' . Image::STATUS_PUBLISHED,
                'order' => 'UpdateTime DESC',
            ));
            $criteria->addSearchCondition('tags', $_GET['tag']);

            $dataProvider = new CActiveDataProvider('image', array(
                'pagination' => array(
                    'pageSize' => Yii::app()->params['postsPerPage'],
                ),
                'criteria' => $criteria,
            ));

            $this->render('index', array(
                'dataProvider' => $dataProvider,
                'model' => $model,
            ));
        } else {
            if (isset($_GET['Image']))
                $model->attributes = $_GET['Image'];

//send model object for search
            $this->render('index', array(
                'dataProvider' => $model->search(),
                'model' => $model)
            );
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Image('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Image']))
            $model->attributes = $_GET['Image'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Suggests tags based on the current user input.
     * This is called via AJAX when the user is entering the tags input.
     */
    public function actionSuggestTags() {
        $criteria = new CDbCriteria;
        $criteria->alias = "image";
        $criteria->condition = "image.tags like '" . $_GET['term'] . "%'";

        $dataProvider = new CActiveDataProvider(get_class(Image::model()), array(
            'criteria' => $criteria, 'pagination' => false,
        ));
        $tags = $dataProvider->getData();

        $return_array = array();
        foreach ($tags as $tag) {
            $return_array[] = array(
                'label' => $tag->tags,
                'value' => $tag->tags,
            );
        }
        echo CJSON::encode($return_array);
    }

    public function actionSuggestImages() {
        $criteria = new CDbCriteria;
        $criteria->alias = "image";
        $criteria->condition = "image.Title like '" . $_GET['term'] . "%'";

        $dataProvider = new CActiveDataProvider(get_class(Image::model()), array(
            'criteria' => $criteria, 'pagination' => false,
        ));
        $images = $dataProvider->getData();

        $return_array = array();
        foreach ($images as $image) {
            $return_array[] = array(
                'label' => $image->Title,
                'value' => $image->Title,
                'id' => $image->id,
            );
        }

        echo CJSON::encode($return_array);
    }

    /*
     * Download files that current user picked
     * Using helpers extension
     */

    public function actionDownloadFile($id, $file_name) {
        $model = $this->loadModel($id);
        EDownloadHelper::download(Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $file_name);

        echo stream_get_contents($model->$file_field, -1, 0);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Image the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Image::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Image $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'image-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSimilarImage() {
        
    }

}
