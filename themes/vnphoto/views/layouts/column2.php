<?php $this->beginContent('//layouts/main'); ?>
      <div class="row-fluid">
        <div class="span3">
         <?php // if(Yii::app()->user->getIsSuperuser()){
//			$this->beginWidget('zii.widgets.CPortlet', array(
//				
//			));
//			$this->widget('bootstrap.widgets.TbMenu', array(
//                                'type'=>'pills',
//				'items'=>$this->menu,
//				'htmlOptions'=>array('class'=>'sidebar'),
//			));
//                         $this->endWidget();
//         
//         }
		?>
		</div><!-- sidebar span3 -->

	<div class="span9">
		<div class="main">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>
