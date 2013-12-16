<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<h3 class="col-lg-offset-4"><?php echo UserModule::t("Restore"); ?></h3>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form col-lg-offset-4">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="form-group">
		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email',array('class'=>'form-control','style'=>'width:250px')) ?>
		<p class="hint" style="color:red;"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	
	<div class="form-group submit">
		<button class="btn btn-success" type="submit">Restore</button>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php endif; ?> 