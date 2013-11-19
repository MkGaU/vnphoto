<?php echo CHtml::beginForm(array('/user/login')); 
    
$link = '//' .
Yii::app()->controller->uniqueid .
'/' . Yii::app()->controller->action->id;
echo CHtml::hiddenField('quicklogin', $link);
?>

        <?php echo CHtml::errorSummary($model); ?>
        
        <div class="row">
                <?php echo CHtml::activeLabelEx($model,'username'); ?>
                <?php echo CHtml::activeTextField($model,'username', array('size' => 30)) ?>
        </div>
        
        <div class="row" style="padding-top:12px;">
                <?php echo CHtml::activeLabelEx($model,'password'); ?>
                <?php echo CHtml::activePasswordField($model,'password', array('size' => 30)); ?>
        </div>
        
        <div class="row submit">
                <?php echo CHtml::submitButton('Login'); ?>
        </div>
        
<?php echo CHtml::endForm(); ?>