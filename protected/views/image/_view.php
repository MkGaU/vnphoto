<?php
/* @var $this ImageController */
/* @var $data Image */
?>


<?php $pageSize = $widget->dataProvider->getPagination()->pageSize; ?>

<?php if ($index == 0) echo '<div class="row">'; ?>
<div class="span3">

    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px">

        <?php
        echo CHtml::link(
                CHtml::image(Yii::app()->request->baseUrl . $data->thumbnails, " ", array('class' => 'img-responsive imageBlock')), array('view', 'id' => $data->id), array('class' => 'thumbnail'));
        ?>            
    </div>
</div>

<?php
if ($index != 0 && $index != $pageSize && ($index + 1) % 4 == 0)
    echo '</div><div class="row">';
?>

<?php if (($index + 1) == $pageSize) echo '</div>'; ?>

