<?php
/* @var $this ImageController */
/* @var $dataProvider CActiveDataProvider */
//echo Yii::getVersion();
//echo phpinfo();
?>




<div class="container">
  <div class="row" style="height:400px; margin-top:100px;">
    <div class="col-lg-3"></div>
    <div class="col-xs-4" >
      
    
           <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl('image/index'),
        'method' => 'get',
                ));
           ?>
                      
        
            <div class="form-group">
            <div class="input-group">
                <?php 
            //echo CHtml::textField('search_key','',array('size' => 60,'placeholder'=>'search','class'=>'form-control'));
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model' => $model,
                    'name'=>'search_key',                      
                    'attribute' => 'Title',
                    'source' => $this->createUrl('image/SuggestImages'),
                    'htmlOptions' => array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'search'),
                ));
                    ?> 

                <span class="input-group-btn">
                    <?php
                    echo CHtml::tag('button', array('class' => 'btn btn-danger'), '<span class="glyphicon glyphicon-search"></span>');
                    
                    ?>
                </span> </div>
          <!-- /input-group --> 
           <?php $this->endWidget(); ?>
        </div>
        <!-- form group -->
        
        
    </div>
    <!-- collum content --> 
    
  </div>
  <!-- row --> 
</div>

        
