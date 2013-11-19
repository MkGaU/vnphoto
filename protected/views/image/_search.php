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
                $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                    'model'=>$model,
                    'attribute'=>'Title',
                    'source'=>$this->createUrl('image/SuggestImages'),
                    'htmlOptions'=>array('size'=>60,'maxlength' => 255,'class'=>'form-control','placeholder'=>'search'),
                ));
//                echo $form->textField($model, 'Title', array('size' => 60, 'maxlength' => 255,
//                    'class' => 'form-control', 'placeholder' => 'search'));
                //echo $form->textField($model, 'Title', array('size' => 60, 'maxlength' => 150),
                    //array('class'=>'form-control', 'placeholder' => 'search'));
                ?>
                <span class="input-group-btn">
                    <?php
                    echo CHtml::tag('button', array('class' => 'btn btn-primary'),
                            '<span class="glyphicon glyphicon-search"></span>');
                    ?>
                </span> </div>
            <!-- /input-group --> 

            <!-- /input-group --> 

        </div>
        <!-- form group -->

        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox"  id="inlineCheckbox1" value="horizontal">
                horizontal </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="vertical" >
                vector </label>
        </div>

        <!--form group-->

        <div class="form-group">
            <div class="control-group">
                <div class="controls">
                    <select id="selectCatergory" class="form-control">
                        <option>Type</option>
                        <option> People </option>
                        <option>Animal</option>
                        <option>Landscape</option>
                    </select>
                </div>
            </div>
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
            <select id="selectPeopleSex" class="form-control">
                <option>Sex</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <!--form group--> 

        <!--Age-->
        <div class="form-group">
            <select id="selectPeopleAge" class="form-control">
                <option>Age</option>
                <option>Under 16</option>
                <option>16 -25</option>
                <option>25 - 50</option>
                <option>Upper 50</option>
            </select>
        </div>

        <!--form group-->
        <div class="form-group text-center">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary ">Search</button>
                <button type="reset" class="btn btn-default ">Clear</button>
            </div>
        </div>
    </form>
</div>

<?php $this->endWidget(); ?>