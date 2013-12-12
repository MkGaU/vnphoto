<div class="well wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="form-group">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('class'=>'form-control','style'=>'width:250px','size'=>20,'maxlength'=>20)); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('class'=>'form-control','style'=>'width:250px','size'=>60,'maxlength'=>128)); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'activkey'); ?>
        <?php echo $form->textField($model,'activkey',array('class'=>'form-control','style'=>'width:250px','size'=>60,'maxlength'=>128)); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'create_at'); ?>
        <?php echo $form->textField($model,'create_at',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    
    <div class="form-group">
        <?php echo $form->label($model,'lastvisit_at'); ?>
        <?php echo $form->textField($model,'lastvisit_at',array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'superuser'); ?>
        <?php echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatus'),array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',$model->itemAlias('UserStatus'),array('class'=>'form-control','style'=>'width:250px')); ?>
    </div>

    <div class="form-group buttons">
        <button class="btn btn-success" type="submit">Search</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->