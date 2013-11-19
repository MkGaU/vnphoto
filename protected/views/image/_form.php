<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<div class="form">

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


    <p class="note">Fields with <span class="required">*</span> are required.</p>       
    <?php echo $form->errorSummary($model); ?>
    <?php ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'Title'); ?>
        <?php echo $form->textField($model, 'Title', array('size' =>60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'Title'); ?>
    </div>

    <div class="row">
       
            <?php echo $form->labelEx($model, 'filename'); ?>
            <?php echo $form->fileField($model, 'filename'); ?>
            <?php echo $form->error($model, 'filename'); ?>
       
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tags'); ?>
        <?php
       $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                'model'=>$model,
                'attribute'=>'tags',
                'source'=>$this->createUrl('image/SuggestTags'),                
                'htmlOptions'=>array(
                    'size'=>50,
                    'data-role'=>'tagsinput'
                    ),
            ));
        ?>
        <p class="hint">Please separate different tags with commas.</p>
    <?php echo $form->error($model, 'tags'); ?>
    </div>
        <?php if ($model->isNewRecord != '1') { ?>
        <div class="row">
        <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->ImgLink, "ImgLink", array("width" => 200)); ?> 

        </div>
<?php } ?>


    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div>
