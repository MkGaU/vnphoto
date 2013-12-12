<script  src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.js" type="text/javascript"></script>
<!-- row contain main content -->
<div class="row " style="margin-top: 20px;">
    <div class="well col-lg-2">
        
    
    <ul class="nav nav-pills nav-stacked">
    <li class="active"> <?php echo CHtml::link('Dashboard',array('site/Administrator'))?></li>
     <li ><?php echo CHtml::link('Photo Management',array('image/admin'))?> </li>
      <li><?php  echo CHtml::link('User Management',array('user/admin'))?></li>
     <li><?php  echo CHtml::link('Permission Management',array('/rights'))?></li>
   
     <li> </li>
      </ul>
    </div>
    
    <div class="col-lg-9">
        <!-- main contents -->
        
            <div style="border-bottom: 2px solid #CCC; margin-bottom: 10px;"><h3>Dashboard</h3></div>
      
                
                <!-- button group -->
		<div class="row text-center">
               
			<div class="col-lg-3">

                                   <?php $image = CHtml::image(Yii::app()->baseUrl.'/images/Backend/images.png');?>
                              <a><?php echo CHtml::link($image,array('/image/admin'))?> </a>
                               
                               <br>
                             <span class="h4 text-default">Photos Management</span>
                              
			</div>
                    
                    
                        <div class="col-lg-3">
                            <?php $image = CHtml::image(Yii::app()->baseUrl.'/images/Backend/users.png');?>
                              <a><?php echo CHtml::link($image,array('/user/admin'))?> </a>
                               <br>
                               <span class="h4 text-default">Users management</span>
                               
			</div>
                    
                           <div class="col-lg-3">
                             <?php $image = CHtml::image(Yii::app()->baseUrl.'/images/Backend/categories.png');?>
                              <a><?php echo CHtml::link($image,array('/rights'))?> </a>
                               <br>
                               <span class="h4 text-default">Permission management</span>
                               
			</div>
                    

               	</div>
		 <!--end button group -->
		
		
		
		
        <!-- end main contents-->
    </div>


    
    
</div>







