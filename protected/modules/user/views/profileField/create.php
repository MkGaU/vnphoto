<ul class="nav nav-tabs">
    <li ><?php echo CHtml::link('Mange Users',array('//user/admin')) ?></li>
    <li><?php echo Chtml::link('Manage profile field',array('//user/profileField/admin')) ?></li>
    <li class="active"><?php echo CHtml::link('Create ProfileField',array('//user/profileField/create')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t('Create'),
);
//$this->menu=array(
//    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
//    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
//);
?>
<h3 class="col-lg-offset-4"><?php echo UserModule::t('Create Profile Field'); ?></h3>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>