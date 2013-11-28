<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<?php
		$this->widget('xupload.XUpload', array(
			'url' => Yii::app()->createUrl("site/upload", array("parent_id" => 1)),
			'model' => $model,
			'attribute' => 'file',
			'multiple' => true,
		));
		?>

