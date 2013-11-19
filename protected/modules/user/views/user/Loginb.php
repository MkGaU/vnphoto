<div class="span-8">
<div class="form box">
<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::errorSummary($model); ?>

<div class="row">
<?php echo CHtml::activeLabelEx($model,'username'); ?>
<?php echo CHtml::activeTextField($model,'username', array('size'=>35)) ?>
</div>
<div class="row">
<?php echo CHtml::activeLabelEx($model,'password'); ?>
<?php echo CHtml::activePasswordField($model,'password', array('size'=>35)) ?>
</div>
<div class="row">
<p class="hint">
<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
</p>
</div>
<div class="row rememberMe">
<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
</div>
<div class="row submit">
<?php echo CHtml::submitButton(UserModule::t("Login")); ?>
</div>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
</div>

<?php
$form = new CForm(array(
'elements'=>array(
'username'=>array(
'type'=>'text',
'maxlength'=>32,
),
'password'=>array(
'type'=>'password',
'maxlength'=>32,
),
'rememberMe'=>array(
'type'=>'checkbox',
)
),

'buttons'=>array(
'login'=>array(
'type'=>'submit',
'label'=>'Login',
),
),
), $model);
?>