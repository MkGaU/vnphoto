<ul class="nav nav-tabs">
    <li ><?php echo CHtml::link('Mange Users',array('//user/admin')) ?></li>
    <li class="active"><?php echo CHtml::link('List User',array('//user')) ?></li>
    <li><?php echo CHtml::link('Create User',array('//user/admin/create')) ?></li>
      <li ><?php echo Chtml::link('Manage profile field',array('//user/profileField/admin')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
//if(UserModule::isAdmin()) {
//	$this->layout='//layouts/column2';
//	$this->menu=array(
//	    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
//	    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
//	);
//}
?>

<h3 class="col-lg-offset-4"><?php echo UserModule::t("List User"); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
       'type'=>'striped bordered condensed',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		'create_at',
		'lastvisit_at',
	),
)); ?>
