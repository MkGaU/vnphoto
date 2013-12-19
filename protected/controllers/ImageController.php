<?php

Yii::import('ext.helpers.EDownloadHelper');

class ImageController extends Controller
 {

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
            'DownloadFile'+'upload',
             'rights',
            

          // 'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     *//*
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'search', 'SuggestImages', 'FirstIndex'),
                'users' => array('*'),
                )
           
        );
    }
    
    /*
     * the default action for the controller
     */
    public function allowedActions() {
        return 'FirstIndex';
    }
    public $defaultAction = 'FirstIndex';

    /*
     * Display first page of site
     */

    public function actionFirstIndex() {
        $model = new Image;
        $this->render('index', array('model' => $model));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('viewDetail', array(
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
        $or = $this->defineDimension(Yii::app()->basePath . '/..' . $imagePath);
        if ($or[2] == 'vertical') {
            $im->thumbnailImage(460, null);
        } else {
            $im->thumbnailimage(null, 460);
        }
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
        $dimension = new Imagick();
        $dimension->readimage($path);
        $this->autoRotateImage($dimension);
        $w = $dimension->getimagewidth();
        $h = $dimension->getimageheight();
        if ($w > $h) {
            $tendency = 'vertical';
        } else {
            $tendency = 'horizontal';
        }
        return array($w, $h, $tendency);
    }

    /**
     * Creates a new model.
     * 
     */
    public function actionCreate() {
        $model = new Image;
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
                    $model->tendency = $r[2];
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

            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Update Successful");
                $this->redirect(array('update', 'id' => $model->id));
            } else {
                $this->redirect(array('update', 'id' => $model->id));
                Yii::app()->user->setFlash('failure', "Update Failure");
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

            $this->render('mainView', array(
                'dataProvider' => $dataProvider,
                'model' => $model,
            ));
        } else {
            if (isset($_GET['Image']))
                $model->attributes = $_GET['Image'];


            $this->render('mainView', array(
                'dataProvider' => $model->search(),
                'model' => $model,
            ));
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

        $suggest = array();
        foreach ($images as $image) {
            $suggest[] = array(
                'label' => $image->Title,
                'value' => $image->Title,
                'id' => $image->id,
            );
        }

        echo CJSON::encode($suggest);
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

}
