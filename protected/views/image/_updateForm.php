<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>
<html>
    <head>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'image-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',),
        ));
        ?>
      
    
        <?php
        $cs = Yii::app()->clientScript;
            /* @var $theme CTheme */
            $theme = Yii::app()->theme;
            $cs->registerPackage('jquery');            
            //$cs->registerScriptFile($theme->baseUrl . '/js/ImageColorPicker/dist/jquery-1.4.4.min.js');
            $cs->registerScriptFile($theme->baseUrl . '/js/ImageColorPicker/dist/jquery-ui-1.8.9.custom.min.js');
            $cs->registerScriptFile($theme->baseUrl . '/js/ImageColorPicker/dist/jquery.ImageColorPicker.js');
           
      
            $cs->registerScript('colorPicker', 
                    '$(document).ready(function() {
                $("#pic").ImageColorPicker({
                    afterColorSelected: function(event, color) {
                        $("#result1").val(color);
                    }
                });

            });');
        ?>
  
    </head>
    <body>
        <div class="col-lg-5">   


            <?php echo CHtml::image(Yii::app()->request->baseUrl . $model->thumbnails, "thumb", array('class' => "img-thumbnail", 'id' => 'pic'));
            ?> 

            <div class="panel">
                <ul class="pager">            
                    <li class="previous"><?php echo CHtml::link('previous', array('update', 'id' => $model->getPreviousId())) ?></li>
                    <li class="next"><?php echo CHtml::link('Next', array('update', 'id' => $model->getNextId())) ?></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4" style="margin-top:20px;">
            <form role="form" action="" method="post">
                
                <div class="form-group">
                    <p><span class="text-muted">Image Id: </span><span><?php echo $model->id ?></span></p>
    <!--      <p class="note">Fields with <span class="required">*</span> are required.</p>       -->
                    <?php echo $form->errorSummary($model); ?>       
                  
                        <?php echo $form->labelEx($model, 'Title', array('class' => 'text-muted')); ?>
                        <?php echo $form->textField($model, 'Title', array('size' => 60, 'maxlength' => 150, 'class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'Title'); ?>
                  
                </div>
                <div class="form-group">
                    <p class="text-muted">Description</p>
                    <textarea class="form-control" rows="4"> It's been more than a decade since we have been operating in the realm of tourism with a literally wide range of packages for every of your Vietnam travel and tours.</textarea>
                </div>
                <div class="form-group">
                    <p class="text-muted">Catergory</p>
                    <select id="selectCatergory" class="form-control">
                        <option>Nature</option>
                        <option>people</option>
                        <option>Culture</option>
                        <option>Economy</option>
                        <option>Fashion</option>
                    </select>
                </div>
                <div class="form-group">      
                    <?php echo $form->labelEx($model, 'tags', array('class' => 'text-muted')); ?>
                    <?php
//                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//                        'model' => $model,
//                        'attribute' => 'tags',
//                        'source'=>"js:function(request, response) {
//                                $.getJSON('".$this->createUrl('image/SuggestTags')."', {
//                                    term: extractLast(request.term)
//                                }, response);
//                            }",                        
//                        'htmlOptions' => array(
//                            'size' => 50,
//                            //'data-role' => 'tagsinput'
//                        ),
//                    ));
                     $this->widget('CAutoComplete', array(
                    'model' => $model,
                    'attribute' => 'tags',
                    'url'=>array('image/SuggestTags'),
                     'multiple'=>true,
                    'htmlOptions' => array(
                        'class'=>'form-control',
                        'placeholder' => 'Add Tags',
                        //'data-role'=>'tagsinput',
                        ),
                )); 
                    ?>

                    <?php echo $form->error($model, 'tags'); ?>
                </div>
                <p class="text-muted">People</p>
                <div class="form-group">
                    <select id="selectPeopleAmount" class="form-control">
                        <option>People Amount</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>

                <!--Sex-->
                <div class="form-group">
                    <?php
                    echo $form->dropDownList($model, 'sex', Lookup::items('sex'), array('empty' => 'Sex', 'class' => 'form-control'));
                    ?>
                </div>

                <!--form group--> 

                <!--Age-->
                <div class="form-group">
                    <?php
                    echo $form->dropDownList($model, 'ageType', Lookup::items('age'), array('empty' => 'Age', 'class' => 'form-control'));
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo $form->label($model, 'status', array('class' => 'text-muted'));
                    echo $form->dropDownList($model, 'status', Lookup::items('ImageStatus'), array('class' => 'form-control'));
                    ?>
                </div>
                <div class='form-group'>

                    <div id="result"></div>
                    <?php
                    
                    echo $form->textField($model, 'imageColor', array('id' => 'result1', 'class' => 'form-control'));
                    ?>
                </div>
                <div class="form-group">
                    <div class="btn-group">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
                        <input type="reset" class="btn btn-default" value="Undo">
                        <input type="button" class="btn btn-default" value="Cancel">
                    </div>
                </div>

            </form>
        </div>
        <?php $this->endWidget(); ?>


    </body>
</html>