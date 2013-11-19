
<div class="container" style="margin-top:40px;">
  <div class="row"> 
    
    <div class="col-lg-1"></div>
    <!-- register form -->
    <div class="col-lg-3" >

<?php 

$this->renderPartial('/user/registration', array('model'=>$model,'profile'=>$profile));
?>
    </div>
     <div class="col-lg-1" style="border-right:1px solid #999; height:500px;">
    </div>
    <div class="col-lg-1">
    </div>
    <div class="col-lg-3">
<?php 
$this->renderPartial('/user/login', array('model_l'=>$model_l));
?>
</div>
    
       
    
  </div>
</div>


