<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	'Create',
);

?>
<?php    
       
    $this->menu =  array(array('label'=>'Manage Image','url'=>array('admin')));
   
 ?>
<?php $this->renderPartial('_uploadForm', array('model'=>$model)); ?>