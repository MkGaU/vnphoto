<ul class="nav nav-tabs " >
    
    <li><?php echo CHtml::link('Edit Profile',array('//user/profile/edit')) ?></li>
    <li class="active"><?php echo CHtml::link('Change Password',array('//user/profile/changepassword')) ?></li>
    <li ><?php echo CHtml::link('Profile',array('//user/profile')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?>

<h3 class="col-lg-offset-4">Change password</h3>

<div class="form col-lg-offset-4" >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="form-group">
	<?php echo $form->labelEx($model,'oldPassword'); ?>
	<?php echo $form->passwordField($model,'oldPassword',array('style'=>'width:250px','class'=>'form-control')); ?>
	<?php echo $form->error($model,'oldPassword'); ?>
	</div>
	
	<div class="form-group">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password',array('style'=>'width:250px','class'=>'form-control')); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="form-group">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword',array('style'=>'width:250px','class'=>'form-control')); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="form-group">
            <button class="btn btn-success" type="submit">Save</button>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->