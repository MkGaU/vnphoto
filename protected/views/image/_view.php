<?php
/* @var $this ImageController */
/* @var $data Image */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('Photo')); ?>:</b>
	<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/data/'.$data->filename,"filename",array("width"=>200)),array('view','id'=>$data->id)); ?>
	<br />

	


</div>
