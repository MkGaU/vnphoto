

<h3>Already have an account?</h3>

<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form">
    <?php echo CHtml::beginForm(); ?>

   
    <?php echo CHtml::errorSummary($model_l); ?>

    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model_l, 'username'); ?>
        <?php echo CHtml::activeTextField($model_l, 'username', array('class' => 'form-control')) ?>
        <?php echo CHtml::error($model_l,'username',array('style'=>'color:red;')); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model_l, 'password'); ?>
        <?php echo CHtml::activePasswordField($model_l, 'password', array('class' => 'form-control')) ?>
        <?php echo CHtml::error($model_l,'password',array('style'=>'color:red;')); ?>
    </div>

    <div class="form-group">
        <p class="hint">
            <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
        </p>
    </div>

    <div class="row rememberMe">
        <?php echo CHtml::activeCheckBox($model_l, 'rememberMe'); ?>
        <?php echo CHtml::activeLabelEx($model_l, 'rememberMe'); ?>
    </div>

    <div class="form-group">
        <button class="btn btn-success" type="submit">Sign in</button>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements' => array(
        'username' => array(
            'type' => 'text',
            'maxlength' => 32,
        ),
        'password' => array(
            'type' => 'password',
            'maxlength' => 32,
        ),
        'rememberMe' => array(
            'type' => 'checkbox',
        )
    ),
    'buttons' => array(
        'login' => array(
            'type' => 'submit',
            'label' => 'Login',
        ),
    ),
        ), $model_l);
?>