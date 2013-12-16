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


        $cs->registerScript('colorPicker', '$(document).ready(function() {
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
        <div class="col-lg-5" >           
            <div class="form-group">
                

                <?php
                
                if (Yii::app()->user->hasFlash('success'))
                    echo '<div class="flash-success" >' . TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, Yii::app()->user->getFlash('success')) . '</div>';
                else
                    echo '<div class="flash-success">' . TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, Yii::app()->user->getFlash('failure')) . '</div>';
                Yii::app()->clientScript->registerScript(
                        'myHideEffect', '$(".flash-success").animate({opacity: 1.0}, 1100).fadeOut("slow");', CClientScript::POS_READY
                );
                ?>
            </div>
            <div class="form-group">
                <?php
                echo CHtml::label('ID :', '', array('class' => 'text-muted'));
                echo $model->id;
                ?>
            </div>
            <div class="form-group">
<!--      <p class="note">Fields with <span class="required">*</span> are required.</p>       -->
                <?php echo $form->errorSummary($model); ?>       

                <?php echo $form->labelEx($model, 'Title', array('class' => 'text-muted')); ?>
                <?php echo $form->textField($model, 'Title', array('size' => 60, 'maxlength' => 150, 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'Title'); ?>

            </div>
            <div class='form-group'>

                <?php
//            Yii::app()->clientScript->registerScript('colorPicker', '
//                var myPicker = new jscolor.color(document.getElementById("result1"), {required:false,hash:true,caps:false})
//                ');
                ?>
                <?php
                echo CHtml::label('Color code (hex)', '', array('class' => 'text-muted'));
                echo $form->textField($model, 'imageColor', array('id' => 'result1', 'class' => 'form-control', 'placeholder' => 'Color code'));
                ?>
            </div>
            <div class="form-group">
                <p class="text-muted">Description</p>
                <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'rows' => '4')); ?>
            </div>
            <div class="form-group">
                <p class="text-muted">Catergory</p>
                <?php echo $form->dropDownList($model, 'Category', Lookup::items('category'), array('class' => 'form-control', 'empty' => 'Category')); ?>
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
                    'url' => array('image/SuggestTags'),
                    'multiple' => true,
                    'htmlOptions' => array(
                        'class' => 'form-control',
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

            <div class="form-group">
                <div class="btn-group">
                    <?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
                    <?php echo CHtml::button('Update', array('submit' => array('image/update','id'=>$model->id), 
                        'class' => 'btn btn-primary', 'value' => 'Update')); ?>
                    <input type="reset" class="btn btn-default" value="Undo">

                </div>


            </div>
        </div>
        <?php $this->endWidget(); ?>


    </body>
</html>