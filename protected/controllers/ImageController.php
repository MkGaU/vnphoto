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

    public function actions() {
        return array(
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
                'actions' => array('create', 'update', 'DownloadFile', 'Upload', 'SuggestImages', 'SuggestTags', 'Form', 'upload'),
                'users' => array('@'),
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

    // Note: $image is an Imagick object, not a filename! See example use below.
    function autoRotateImage($image) {
        $orientation = $image->getImageOrientation();

        switch ($orientation) {
            case imagick::ORIENTATION_BOTTOMRIGHT:
                $image->rotateimage("#000", 180); // rotate 180 degrees
                break;

            case imagick::ORIENTATION_RIGHTTOP:
                $image->rotateimage("#000", 90); // rotate 90 degrees CW
                break;

            case imagick::ORIENTATION_LEFTBOTTOM:
                $image->rotateimage("#000", -90); // rotate 90 degrees CCW
                break;
        }

        // Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image!
        $image->setImageOrientation(imagick::ORIENTATION_TOPLEFT);
    }

    public function createThumbnail($imagePath, $imageThumbPath) {
        $im = new Imagick();
        $im->readImage(Yii::app()->basePath . '/..' . $imagePath);
        $this->autoRotateImage($im);
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

    public function defineDimension($path) {
        $dimension = new Imagick;
        $dimension->readimage($path);
        $this->autoRotateImage($dimension);
        $w = $dimension->getimagewidth();
        $h = $dimension->getimageheight();
        if ($w > $h) {
            $type = 'vertical';
        } else {
            $type = 'horizontal';
        }
        return array($w, $h, $type);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Image;
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Image'])) {
            $model->attributes = $_POST['Image'];
            $images = CUploadedFile::getInstancesByName('Image');

            if (isset($images) && count($images) > 0) {
                foreach ($images as $image => $pic) {
                    $model->filename = $pic->name;
                    //Get image extension
                    $model->format = $pic->getExtensionName();
                    //Get image size in bytes
                    $model->size = $pic->getSize();
                    //Get path of the uploaded file on the server
                    $path = $pic->getTempName();
                    //Get dimension of image that uploaded
                    $r = $this->defineDimension($path);
                    $model->width = $r[0];
                    $model->height = $r[1];
                    $model->dimension = $r[2];
                    // Encrypt name of image by md5
                    $thumbName = md5(date('dmy') . time() . rand());
                    $imageName = md5(date('YMD') . time() . rand());


                    $model->ImgLink = $this->createMkdir(date('Y', time()), date('m', time()), date('d', time())) . '/' . $imageName . '.' . $model->format;
                    $model->thumbnails = $this->createMkdir(date('Y', time()), date('m', time()), date('d', time())) . '/thumbs/' . $thumbName . '.' . $model->format;
                    if ($pic->saveAs(Yii::app()->basePath . '/..' . $model->ImgLink)) {
                        $model->setIsNewRecord(true);
                        $this->createThumbnail($model->ImgLink, $model->thumbnails);
                        $model->save();
                        $model->id+=1;
                        Yii::app()->user->setFlash('success', "Upload Successful");
                    }
                    else
                        Yii::app()->user->setFlash('failure', "Upload Failure");
                }
                $this->redirect(array('create'));
            }else {
                Yii::app()->user->setFlash('failure', "Upload Failure");
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
                $this->redirect(array('update', 'id' => $model->id));
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
        $delete = $this->loadModel($id);
        $delete->delete();
        unlink(getcwd() . $delete->ImgLink);
        unlink(getcwd() . $delete->thumbnails);
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
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = Tags::model()->suggestTags($keyword);
            if ($tags !== array())
                echo implode("\n", $tags);
        }
//        if(isset($_GET['term'])&&($keyword=trim($_GET['term']))!=='')
//                {
//                        $suggest=  Tags::model()->suggestTags($keyword);
//                        echo CJSON::encode($suggest);
//                }
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

    public function actionForm() {
        $model = new Image;
        Yii::import("xupload.models.XUploadForm");
        $photos = new XUploadForm;
        //Check if the form has been submitted
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
        $this->render('upload', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }

    public function actionUpload1() {
        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = realpath(Yii::app()->getBasePath() . "/../images/uploads/tmp/") . "/";
        //$publicPath = Yii::app()->getBaseUrl() . "/images/uploads/tmp/";
        //This is for IE which doens't handle 'Content-type: application/json' correctly
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
            $image = new Image;
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $image->size = $model->file->getSize();
                $image->filename = $model->file->getName();
                $image->format = $model->file->getExtensionName();
                //Get path of the uploaded file on the server
                $paths = $model->file->getTempName();
                //Get dimension of image that uploaded
                $r = $this->defineDimension($paths);
                $image->width = $r[0];
                $image->height = $r[1];
                $image->dimension = $r[2];
                $thumbName = md5(date('dmy') . time() . rand());
                $imageName = md5(date('YMD') . time() . rand());

                $image->ImgLink = $this->createMkdir(date('Y', time()), date('m', time()), date('d', time())) . '/' . $imageName . '.' . $model->format;
                $image->thumbnails = $this->createMkdir(date('Y', time()), date('m', time()), date('d', time())) . '/thumbs/' . $thumbName . '.' . $model->format;
                if ($model->validate()) {
                    //Move our file to our temporary dir
                    $model->file->saveAs(Yii::app()->basePath . '/..' . $model->ImgLink);
                    //chmod($path . $filename, 0777);
                    //here you can also generate the image versions you need 
                    //using something like PHPThumb
                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('images')) {
                        $userImages = Yii::app()->user->getState('images');
                    } else {
                        $userImages = array();
                    }
                    $userImages[] = array(
                        "path" => Yii::app()->basePath . '/..' . $image->ImgLink,
                        //the same file or a thumb version that you generated
                        "thumb" => Yii::app()->basePath . '/..' . $image->thumbnails,
                        "filename" => $imageName . $image->format,
                        'size' => $image->size,
                        'mime' => $image->format,
                        'name' => $image->name,
                    );
                    Yii::app()->user->setState('images', $userImages);

                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => Yii::app()->basePath . '/..' . $image->ImgLink,
                            "thumbnail_url" => Yii::app()->basePath . '/..' . $image->thumbnails,
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $imageName . $image->format,
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

}
