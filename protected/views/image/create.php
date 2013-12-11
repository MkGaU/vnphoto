<ul class="nav nav-tabs">
    <li ><?php echo CHtml::link('List Image',array('//image/index')) ?></li>
    <li ><?php echo CHtml::link('Mange Image',array('//image/admin')) ?></li>
    <li class="active"><?php echo CHtml::link('Create Image',array('//image/create')) ?></li>
</ul>
<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	'Create',
);

?>
<?php    
       
//    $this->menu =  array(array('label'=>'Manage Image','url'=>array('admin')));
   
 ?>
<?php $this->renderPartial('_uploadForm', array('model'=>$model)); ?>