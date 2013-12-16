<ul class="nav nav-tabs">
    <li class="active"><?php echo CHtml::link('Edit Profile',array('//user/profile/edit')) ?></li>
    <li><?php echo CHtml::link('Change Password',array('//user/profile/changepassword')) ?></li>
    <li><?php echo CHtml::link('Profile',array('//user/profile')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
//$this->menu=array(
//	((UserModule::isAdmin())
//		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
//		:array()),
//    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
//    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
//    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
//    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
//);
?><h1 class="col-lg-offset-4"><?php echo UserModule::t('Edit profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div id="container">
    
        <div class="col-lg-offset-3 col-lg-6">
 <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="h3 col-lg-offset-4">Edit profile</p>
                </div>
                <div class="panel-body">
<div class="form col-lg-offset-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="form-group">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('class'=>'form-control','style'=>'width:250px','size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control','style'=>'width:250px','size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control','style'=>'width:250px','size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group buttons">
            <button class='btn btn-success' type='submit'> Save</button>
            <?php //echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
     </div>
            </div>
    </div>
