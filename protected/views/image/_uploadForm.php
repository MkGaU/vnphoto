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
        'enctype' => 'multipart/form-data',
         'multiple' =>'multiple'),
        ));
?>




<div class="col-lg-5" style="margin-top:20px;">
    <form role="form" action="" method="post">
        <div class="col-lg-6 text-left">

            <div class="form-group">             

                <?php
                if (Yii::app()->user->hasFlash('success'))
                    echo '<div class="flash-success" >' . TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, Yii::app()->user->getFlash('success')) . '</div>';
                else
                    echo '<div class="flash-success">' . TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, Yii::app()->user->getFlash('failure')) . '</div>';
                Yii::app()->clientScript->registerScript(
                        'myHideEffect', '$(".flash-success").animate({opacity: 1.0}, 1100).fadeOut("slow");', CClientScript::POS_READY
                );
                ?>
                <?php

                $this->widget('CMultiFileUpload', array(
                    'name' => 'Image',
                    'model' => $model,
                    'attribute' => 'filename',
                    'accept' => 'jpg|png',
                    'duplicate' => 'Duplicate file!', 
                    'denied' => 'Invalid file type', 
                    'max' => 10,
                    'remove' => Yii::t('ui', 'Remove'),
                    'htmlOptions' => array('size' => 50),
                ));
                
                
                ?>
      
            </div>
            <div class="form-group">
             
                <?php
                    echo $form->labelEx($model, 'Tags', array('class' => 'text-muted'));
                    $this->widget('CAutoComplete', array(
                    'model' => $model,
                    'attribute' => 'tags',
                    'url' => array('image/SuggestTags'),
                    'multiple' => true,
                    'htmlOptions' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Add Tags',
                    //'data-role'=>'tagsinput',
                    ),
                )); 
                ?>
            </div>
            <div class="form-group">
                <div class="btn-group">
                    <?php echo CHtml::button('Upload', array('submit' => array('image/Create'), 
                        'class' => 'btn btn-primary', 'value' => 'Upload')); ?>

                </div>
            </div>
        </div>
    </form>
    <?php $this->endWidget(); ?>
