<ul class="nav nav-tabs">
    <li ><?php echo CHtml::link('List Image',array('//image/index')) ?></li>
    <li ><?php echo CHtml::link('Mange Image',array('//image/admin')) ?></li>
    <li ><?php echo CHtml::link('Create Image',array('//image/create')) ?></li>
    <li class="active"><?php echo CHtml::link('Update Image',array('//image/update')) ?></li>
    <li ><?php echo CHtml::link('View Image',array('view', 'id'=>$model->id)) ?></li>
</ul>
<br></br>

<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->Title=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Image', 'url'=>array('index')),
//	array('label'=>'Create Image', 'url'=>array('create')),
//	array('label'=>'View Image', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Image', 'url'=>array('admin')),
//);
?>



<?php $this->renderPartial('_updateForm', array('model'=>$model)); ?>