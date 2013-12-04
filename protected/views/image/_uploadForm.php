<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'image-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',),
        ));
?>




<div class="col-lg-4" style="margin-top:20px;">
            <form role="form" action="" method="post">
    <div class="col-lg-6 text-left">

        <div class="form-group">             

            <?php if (Yii::app()->user->hasFlash('success'))
            
                  echo Yii::app()->user->getFlash('success'); 
                  else
                      echo Yii::app()->user->getFlash('failure'); 
        ?>
            <?php
//                $this->widget('ext.dropzone.EDropzone', array(
//                    'model' => $model,
//                    'attribute' => 'filename',
//                    'name'=>'Image',
//                    'url' => $this->createUrl('image/Create'),
//                    'mimeTypes' => array('image/jpeg', 'image/png'),
//                    'onSuccess' => 'someJsFunction();',
//                    'options' => array(),
//                ));
            $this->widget('CMultiFileUpload', array(
                'name' => 'Image',
                'model' => $model,
                'attribute' => 'filename',
                'accept' => 'jpg|png',
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
                'max' => 10,
                'remove' => Yii::t('ui', 'Remove'),                
                'htmlOptions' => array('size' => 50),
            ));
            ?>
            
        </div>
        
                
                <div class="form-group">
                   
                   
                        <?php echo $form->textField($model, 'Title', array('class' => 'form-control')); ?>
                        
                </div>
     

<div class="form-group">
    <div class="btn-group">
        <?php echo CHtml::button('Upload',array('submit'=>array('image/create'),'class' => 'btn btn-primary', 'value' => 'Upload')); ?>
      
    </div>
</div>
</div>
    </form>
<?php $this->endWidget(); ?>
