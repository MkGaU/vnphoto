<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>
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
<ul class="nav nav-tabs">
    <li><a href="acount_detail.html">Home</a></li>
    <li><a href="#">Users</a></li>
    <li class="active"><a href="#">Photos</a></li>
    <li><a href="#">Catergories</a></li>
    <li><a href="#">Confirmation</a></li>
</ul>
</div>
<div class="col-lg-1"></div>
<div class="col-lg-4"> 

    <div class="panel text-center">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>


    <?php echo CHtml::image(Yii::app()->request->baseUrl . $model->thumbnails, "thumb", array('class' => "img-thumbnail"));
    ?> 
    
    <div class="panel">
        <ul class="pager">            
            <li class="previous"><?php echo CHtml::link('previous', array('update','id'=>$model->getPreviousId())) ?></li>
            <li class="next"><?php echo CHtml::link('Next', array('update','id'=>$model->getNextId())) ?></li>
        </ul>
    </div>
</div>
<div class="col-lg-3 text-left" style="margin-top:20px;">
    <form role="form" action="" method="post">
        <p><span class="text-muted">Image Id: </span><span><?php echo $model->id ?></span></p>
        <div class="form-group">

    <!--      <p class="note">Fields with <span class="required">*</span> are required.</p>       -->
            <?php echo $form->errorSummary($model); ?>       
            <div class="row">
                <?php echo $form->labelEx($model, 'Title', array('class' => 'text-muted')); ?>
                <?php echo $form->textField($model, 'Title', array('size' => 60, 'maxlength' => 150, 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'Title'); ?>
            </div>
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
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model' => $model,
                'attribute' => 'tags',
                'source' => $this->createUrl('image/SuggestTags'),
                'htmlOptions' => array(
                    'size' => 50,
                    'data-role' => 'tagsinput'
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
                <option>under 16</option>
                <option>16 -25</option>
                <option>25 - 50</option>
                <option>after 50</option>
            </select>
        </div>
        <div class="form-group">
            <?php
            echo $form->label($model, 'status', array('class' => 'text-muted'));
            echo $form->dropDownList($model, 'status', Lookup::items('ImageStatus'), array('class' => 'form-control'));
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



