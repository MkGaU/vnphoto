
<div id="container">
    
        <div class="col-lg-offset-3 col-lg-6">
            
            <!--Main content -->
            
            <h3 class="text-center">Thank you for payment</h3>
            <?php if (Yii::app()->user->isGuest){ ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <p><span class="h4">Please waiting in 30 minutes to begin download   </span>       Browse our entire collections</p>
                    <div class="pull-right"><?php if (Yii::app()->user->isGuest) {
                        echo CHtml::link('Continue',array('//user/RegisterB'),array('class' => 'btn btn-default')); 
                    }
                            else CHtml::link('Continue',array('//image/index'),array('class' => 'btn btn-default'))
                            ?></div>
                </div>
               
              
               
            </div><!--End register-->
            <?php } ?>
            
           
            <!--end -Continued Form-->
            
           
        </div>
    <!--End content -->
</div>

