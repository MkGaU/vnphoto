<div class="wide form col-lg-offset-4">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="form-group">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'varname'); ?>
        <?php echo $form->textField($model,'varname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'field_type'); ?>
        <?php echo $form->dropDownList($model,'field_type',ProfileField::itemAlias('field_type'),array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'field_size'); ?>
        <?php echo $form->textField($model,'field_size',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'field_size_min'); ?>
        <?php echo $form->textField($model,'field_size_min',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'required'); ?>
        <?php echo $form->dropDownList($model,'required',ProfileField::itemAlias('required'),array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'match'); ?>
        <?php echo $form->textField($model,'match',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'range'); ?>
        <?php echo $form->textField($model,'range',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'error_message'); ?>
        <?php echo $form->textField($model,'error_message',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'other_validator'); ?>
        <?php echo $form->textField($model,'other_validator',array('size'=>60,'maxlength'=>5000,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'default'); ?>
        <?php echo $form->textField($model,'default',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'widget'); ?>
        <?php echo $form->textField($model,'widget',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'widgetparams'); ?>
        <?php echo $form->textField($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'position'); ?>
        <?php echo $form->textField($model,'position',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'visible'); ?>
        <?php echo $form->dropDownList($model,'visible',ProfileField::itemAlias('visible'),array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group buttons">
        <button class="btn btn-success" type="submit">Search</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form --> 