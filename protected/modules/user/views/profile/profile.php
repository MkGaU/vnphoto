<ul class="nav nav-tabs">
    <li><?php echo CHtml::link('Edit Profile',array('//user/profile/edit')) ?></li>
    <li><?php echo CHtml::link('Change Password',array('//user/profile/changepassword')) ?></li>
    <li class="active"><?php echo CHtml::link('Profile',array('//user/profile')) ?></li>
    <li><?php echo Chtml::link('Logout',array('//user/logout')) ?></li>
   
</ul>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
//$this->menu=array(
//	((UserModule::isAdmin())
//		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
//		:array()),
//    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
//    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
//    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
//    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
//);
?><h3 class="col-lg-offset-4">Your profile</h3>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div id="container">
    
        <div class="col-lg-offset-3 col-lg-6">
 <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="h3 col-lg-offset-4">Your Profile</p>
                </div>
                <div class="panel-body">
                   
                
<table class="dataGrid col-lg-offset-4">
	<tr>
            <td> Username:</td>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
        
	<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
            <td>Var Name:</td>
		<th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr>
            <td>Email address:</td>
           
		<th class="label">   <?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
                
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr>
            <td>Create at:</td>
		<th class="label"> <?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo $model->create_at; ?></td>
	</tr>
	<tr>
            <td>Last visit:</td>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td><?php echo $model->lastvisit_at; ?></td>
	</tr>
	<tr>
            <td>Status:</td>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
</table>
                </div>
 </div>
            </div>
    </div>
