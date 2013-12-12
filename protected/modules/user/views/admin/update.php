<ul class="nav nav-tabs">
    <li class="active"><?php echo CHtml::link('Mange Users',array('//user/admin')) ?></li>
    <li><?php echo CHtml::link('List User',array('//user')) ?></li>
    <li><?php echo CHtml::link('Create User',array('//user/admin/create')) ?></li>
      <li><?php echo Chtml::link('Manage profile field',array('//user/profileField/admin')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Update')),
);
//$this->menu=array(
//    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
//    array('label'=>UserModule::t('View User'), 'url'=>array('view','id'=>$model->id)),
//    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
//    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
//    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
//);
?>

<h3 class="col-lg-offset-4"><?php echo  UserModule::t('Update User')." ".$model->id; ?></h3>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>