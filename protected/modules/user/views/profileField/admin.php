<ul class="nav nav-tabs">
    <li ><?php echo CHtml::link('Mange Users',array('//user/admin')) ?></li>
    <li class="active"><?php echo Chtml::link('Manage profile field',array('//user/profileField/admin')) ?></li>
    <li><?php echo CHtml::link('Create ProfileField',array('//user/profileField/create')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t('Manage'),
);
//$this->menu=array(
//    array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
//    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
//    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('profile-field-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h3 class="col-lg-offset-4"><?php echo UserModule::t('Manage Profile Fields'); ?></h3>



</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'varname',
			'type'=>'raw',
			'value'=>'UHtml::markSearch($data,"varname")',
		),
		array(
			'name'=>'title',
			'value'=>'UserModule::t($data->title)',
		),
		array(
			'name'=>'field_type',
			'value'=>'$data->field_type',
			'filter'=>ProfileField::itemAlias("field_type"),
		),
		'field_size',
		//'field_size_min',
		array(
			'name'=>'required',
			'value'=>'ProfileField::itemAlias("required",$data->required)',
			'filter'=>ProfileField::itemAlias("required"),
		),
		//'match',
		//'range',
		//'error_message',
		//'other_validator',
		//'default',
		'position',
		array(
			'name'=>'visible',
			'value'=>'ProfileField::itemAlias("visible",$data->visible)',
			'filter'=>ProfileField::itemAlias("visible"),
		),
		//*/
		array(
			'class'=>'CButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
