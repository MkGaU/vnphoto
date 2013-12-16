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
                    'attribute' => 'Title',
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
        <div class="form-group">
            <?php
            echo $form->checkBoxList($model, 'tendency', array('Horizontal' => 'horizontal', 'Vertical' => 'vertical'), array('class' => 'row')
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
        <div class="form-group">
            <span class="label label-info"  data-toggle="collapse" data-target="#colorGroup">
                Color
                <span class="glyphicon glyphicon-chevron-down"></span>
            </span>
        </div>
        <div id="colorGroup" class="collapse">
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
//                Yii::app()->clientScript->registerScript('colorPicker', '
//                var myPicker = new jscolor.color(document.getElementById("myField1"), {required:false,hash:true,caps:false})
//                ');
//                echo $form->textField($model, 'imageColor', array('id' => 'myField1', 'class' => 'form-control', 'placeholder' => 'Color'));
                ?>
            </div>

            <?php

            function gwsc() {
                $cs = array('00', '33', '66', '99', 'CC', 'FF');

                for ($i = 0; $i < 6; $i++) {
                    for ($j = 0; $j < 6; $j++) {
                        for ($k = 0; $k < 6; $k++) {
                            $c = $cs[$i] . $cs[$j] . $cs[$k];
                            echo "<option value=\"$c\">#$c</option>\n";
                        }
                    }
                }
            }

            Yii::app()->clientScript->registerScript('colorpicker', '$(document).ready(function() {
            $("#picker").colorpicker({
                size: 20,                
                label: "Color: ",
                hide: false
            });
        });');
            ?>
            <select name="colour" id="picker" class="form-control">
                <option value="FFFFFF">FFFFFF</option>
                <option value="FFDFDF">FFDFDF</option>
                <option value="FFBFBF">FFBFBF</option>
                <option value="FF9F9F">FF9F9F</option>
                <option value="FF7F7F">FF7F7F</option>
                <option value="FF5F5F">FF5F5F</option>
                <option value="FF3F3F">FF3F3F</option>
                <option value="FF1F1F">FF1F1F</option>
                <option value="FF0000">FF0000</option>
                <option value="DF1F00">DF1F00</option>
                <option value="C33B00">C33B00</option>
                <option value="A75700">A75700</option>
                <option value="8B7300">8B7300</option>
                <option value="6F8F00">6F8F00</option>
                <option value="53AB00">53AB00</option>
                <option value="37C700">37C700</option>
                <option value="1BE300">1BE300</option>
                <option value="00FF00">00FF00</option>
                <option value="00DF1F">00DF1F</option>
                <option value="00C33B">00C33B</option>
                <option value="00A757">00A757</option>
                <option value="008B73">008B73</option>
                <option value="006F8F">006F8F</option>
                <option value="0053AB">0053AB</option>
                <option value="0037C7">0037C7</option>
                <option value="001BE3">001BE3</option>
                <option value="0000FF">0000FF</option>
                <option value="0000df">0000df</option>
                <option value="0000c3">0000c3</option>
                <option value="0000a7">0000a7</option>
                <option value="00008b">00008b</option>
                <option value="00006f">00006f</option>
                <option value="000053">000053</option>
                <option value="000037">000037</option>
                <option value="00001b">00001b</option>
                <option value="000000">000000</option>
            </select>.

        </div>
        <div class="form-group">
            <span class="label label-info"  data-toggle="collapse" data-target="#peopleGroup">
                People
                <span class="glyphicon glyphicon-chevron-down"></span>
            </span>
        </div>
        <!--People-->
        <div id="peopleGroup" class="collapse">

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

        </div>




        <!--form group-->
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary ">Search</button>
                <button type="reset" class="btn btn-default ">Clear</button>
<?php //echo CHtml::resetButton('Clear',array('class'=>'btn btn-default'))    ?>
            </div>
        </div>
    </form>
</div>

<?php $this->endWidget(); ?>