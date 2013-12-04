<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs = array(
    'Images' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Image', 'url' => array('index')),
    array('label' => 'Create Image', 'url' => array('create')),
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$('#image-grid').yiiGridView('update', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
?>

<h1>Manage Images</h1>



<?php //echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
//    $this->renderPartial('_search', array(
//        'model' => $model,
//    ));
    ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(	
    'type'=>'striped bordered condensed',
    'id' => 'image-grid',
    'dataProvider' => $model->searchadmin(),
    'filter' => $model,
    'columns' => array(
        array(
            'name'=>'id',
            'type'=>'raw',
            'value'=>$model->id,
        ),
        array(
            'name' => 'Title',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->Title),$data->url)',
        ),
        array(
            'name'=>'thumbnails',
            'type'=>'raw',
            'value'=>  'CHtml::link(CHtml::image(Yii::app()->request->baseUrl.$data->thumbnails),$data->url)',
        ),
        array(
            'name' => 'status',
            'value' => 'Lookup::item("ImageStatus",$data->status)',
            'filter' => Lookup::items('ImageStatus'),
        ),
        array(
            'name' => 'CreatedTime',
            'type' => 'datetime',
            'filter' => false,
        ),
        array(
            'class' => 'CButtonColumn',
            
        ),
    ),
));
?>
