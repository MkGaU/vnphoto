<?php
/* @var $this ImageController */
/* @var $dataProvider CActiveDataProvider */
//echo Yii::getVersion();
//echo phpinfo();
?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiListView.update('imageslistview', { 
        //this entire js section is taken from admin.php. w/only this line diff
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>

<div class="col-lg-9">
    <div class="list-image">

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'id' => 'imageslistview', // must have id corresponding to js above
            'template' => "{sorter}{pager}\n{summary}\n{items}",
            'pager' => array(
                'cssFile' => Yii::app()->baseUrl . '/css/.css',
                'header' => false,
                'firstPageLabel' => 'First',
                'prevPageLabel' => 'Previous',
                'nextPageLabel' => 'Next',
                'lastPageLabel' => 'Last',
            ),
            
        ));
        ?> 
    </div>
</div>
