<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>



</div><!-- search-form -->
<div class="well col-lg-3">
    <form  role="form" action="image_detail.html" method="post" accept-charset="UTF-8">
        <div class="form-group">
            <div class="input-group">
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model' => $model,
                    'attribute' => 'tags',
                    'source' => $this->createUrl('image/SuggestImages'),
                    'htmlOptions' => array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'search'),
                )); //              
                ?>

                <span class="input-group-btn">
                    <?php
                    echo CHtml::tag('button', array('class' => 'btn btn-primary'), '<span class="glyphicon glyphicon-search"></span>');
                    ?>
                </span> </div>
            <!-- /input-group --> 

            <!-- /input-group --> 

        </div>
        <!-- form group -->

        <div class="form-group">


            <?php
            echo $form->checkBoxList($model, 'dimension', array('Horizontal' => 'horizontal', 'Vertical' => 'vertical'), array('class' => 'row')
            );
            ?>


        </div>

        <!--form group-->

        <div class="form-group">
            <?php
            echo $form->dropDownlist($model, 'Category', Lookup::items('Category'), array('empty' => 'Category', 'class' => 'form-control'));
            ?>
        </div>

        <!--End Catergory--> 

        <!--People-->
        <div class="form-group">
            <label class="label label-info">People</label>
        </div>
        <!--quantity-->
        <div class="form-group">
            <select id="selectPeopleAmount" class="form-control">
                <option>People number</option>
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
        <div>


            <?php
//            Yii::app()->clientScript->registerScript('colorPicker','
//                    $(document).ready(
//		function()
//		{
//			$("#Binded").jPicker();
//		});
//                ');
            //echo $form->textField($model,'imageColor',array('id'=>'Binded','class'=>'form-control'));
            ?>
            <div class="form-group">
           <?php
            Yii::app()->clientScript->registerScript('colorPicker', '
                var myPicker = new jscolor.color(document.getElementById("myField1"), {required:false,hash:true,caps:false})
                ');
            echo $form->textField($model, 'imageColor', array('id' => 'myField1', 'class' => 'form-control','placeholder'=>'Color'));
            ?>
            </div>
            <?php
//            echo $form->labelEx($model,'imageColor');
//            $this->widget('ext.colorpicker.ColorPicker', array(
//                'model' => $model,
//                'attribute' => 'imageColor',             
//                //'name'=>'color1',
//               
//            ));
            ?>



        </div>
<!--        <script type="text/javascript">
            jQuery(document).ready(function($) {
    $('#color1').colorPicker();
  });
        </script>-->
        <!--form group-->
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary ">Search</button>
                <button type="reset" class="btn btn-default ">Clear</button>
                <?php //echo CHtml::resetButton('Clear',array('class'=>'btn btn-default'))?>
            </div>
        </div>
    </form>
</div>

<?php $this->endWidget(); ?>