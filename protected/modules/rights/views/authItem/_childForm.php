<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>
	
	<div class="form-group">
		<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions, array('class'=>'form-control','style'=>'width:250px')); ?>
		<?php echo $form->error($model, 'itemname'); ?>
	</div>
	
	<div class="row buttons">
            <button class='btn btn-success' type='submit'>Add</button>
		<?php// echo CHtml::submitButton(Rights::t('core', 'Add')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>