<?php
/* @var $this ImageController */
/* @var $data Image */

?>


  
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px">           
            <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/images/' . $data->ImgLink, "dg",
                    array('class'=>'img-responsive')),
                    array('view', 'id' => $data->id),
                    array('class'=>'thumbnail')); ?>            
        </div>


