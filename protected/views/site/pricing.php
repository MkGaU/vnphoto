
<div id="container">
    
        <div class="col-lg-offset-3 col-lg-6">
            
            <!--Main content -->
            
            <h3 class="text-center">Royalty-Free Photos. Simple Pricing</h3>
            <?php if (Yii::app()->user->isGuest){ ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <p><span class="h4">Register Only  </span>       Browse our entire collections</p>
                    <div class="pull-right"><?php echo CHtml::link('Try for free',array('//user/RegisterB'),array('class' => 'btn btn-success'))?></div>
                
                </div>
               
              
            </div><!--End register-->
            <?php } ?>
            <p>To pay by check or bank transfer, please email your username and subscription choice to support@vietnamphoto.com <p>
             
            <!-- Subcriptions-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="h4">License</p>
                </div>
                <div class="panel-body">
                    <div class="col-lg-5">
                        <p class="h4"> Subscriptions</p>
                        <p class="">Download all images every day in month, including access to all JPEG and Vector sizes</p>
                    </div>
                    
                    <div class="col-lg-offset-2 col-lg-2 text-center " style="border-left : 1px solid #CCC">
                       
                        <p class="price">   <strong> $20 </strong> <span class="text-muted">USD</span></p>
                        <p>1 month</p> 
                        <input type="radio" checked>
                        
                 

                    
                    </div>
                
                </div>
            
            </div><!-- end  Subcriptions -->
            
            <div>
                  </div>
            
            <!--Continued Form-->
            <div class="pull-right">
            <a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver=erikp.vn@gmail.com&product_name=vietnam photo&price=2000&return_url=http://localhost:1080/vnphoto/index.php/site/PricingSuccess&comments=Không" ><img src="https://www.nganluong.vn/data/images/buttons/3.gif"  border="0" /></a> 
         
            </div>
            <!--end -Continued Form-->
            
           
        </div>
    <!--End content -->
</div>

