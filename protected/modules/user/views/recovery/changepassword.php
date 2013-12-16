<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>

<h3 class="col-lg-offset-4"><?php echo UserModule::t("Change Password"); ?></h3>


<div class="form col-lg-offset-4">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="form-group">
	<?php echo CHtml::activeLabelEx($form,'password'); ?>
	<?php echo CHtml::activePasswordField($form,'password',array('class'=>'form-control','style'=>'width:250px')); ?>
	<?php echo CHtml::error($form, 'password',array('style'=>'color:red;')); ?>
        <p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="form-group">
	<?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?>
	<?php echo CHtml::activePasswordField($form,'verifyPassword',array('class'=>'form-control','style'=>'width:250px')); ?>
	<?php echo CHtml::error($form, 'verifyPassword',array('style'=>'color:red;')); ?>
        </div>
	
	
	<div class="form-group submit">
            <button class="btn btn-success" type="submit">Save</button>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->