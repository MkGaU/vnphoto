<ul class="nav nav-tabs">
    <li ><?php echo CHtml::link('Assignments',array('//rights/assignment/view')) ?></li>
    <li class="active"><?php echo CHtml::link('Permissions',array('//rights/authItem/permissions')) ?></li>
    <li><?php echo CHtml::link('Roles',array('//rights/authItem/roles')) ?></li>
    <li ><?php echo Chtml::link('Tasks',array('//rights/authItem/tasks')) ?></li>
    <li><?php echo Chtml::link('Operations',array('//rights/authItem/operations')) ?></li>
   
</ul>
<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Permissions'),
); ?>

<div id="permissions">

	<h3 class="col-lg-offset-4"><?php echo Rights::t('core', 'Permissions'); ?></h3>

	<p>
		<?php echo Rights::t('core', 'Here you can view and manage the permissions assigned to each role.'); ?><br />
		<?php echo Rights::t('core', 'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.', array(
			'{roleLink}'=>CHtml::link(Rights::t('core', 'Roles'), array('authItem/roles')),
			'{taskLink}'=>CHtml::link(Rights::t('core', 'Tasks'), array('authItem/tasks')),
			'{operationLink}'=>CHtml::link(Rights::t('core', 'Operations'), array('authItem/operations')),
		)); ?>
	</p>

	<p><?php echo CHtml::link(Rights::t('core', 'Generate items for controller actions'), array('authItem/generate'), array(
	   	'class'=>'generator-link',
	)); ?></p>

	<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Rights::t('core', 'No authorization items found.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,
	)); ?>

	<p class="info">*) <?php echo Rights::t('core', 'Hover to see from where the permission is inherited.'); ?></p>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Rights::t('core', 'Source'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>

</div>
