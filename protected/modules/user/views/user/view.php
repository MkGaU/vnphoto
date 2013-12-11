<ul class="nav nav-tabs">
    <li class="active"><?php echo CHtml::link('View Users') ?></li>
    <li ><?php echo CHtml::link('List User',array('//user')) ?></li>
    
</ul>
<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('index'),
	$model->username,
);
//$this->layout='//layouts/column2';
//$this->menu=array(
//    array('label'=>UserModule::t('List User'), 'url'=>array('index')),
//);
?>
<h1><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h1>
<?php 

// For all users
	$attributes = array(
			'username',
	);
	
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),

				));
		}
	}
	array_push($attributes,
		'create_at',
		array(
			'name' => 'lastvisit_at',
			'value' => (($model->lastvisit_at!='0000-00-00 00:00:00')?$model->lastvisit_at:UserModule::t('Not visited')),
		)
	);
			
     $this->widget('bootstrap.widgets.TbDetailView', array(
        'type'=>'striped condensed condensed',
		'data'=>$model,
		'attributes'=>$attributes,
	));

?>
