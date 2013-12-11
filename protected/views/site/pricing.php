
<div id="container">
    
        <div class="col-lg-offset-3 col-lg-6">
            
            <!--Main content -->
            
            <h3 class="text-center">Royalty-Free Photos. Simple Pricing</h3>
            <?php if (Yii::app()->user->isGuest){ ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <p><span class="h4">Register Only  </span>       Browse our entire collections</p>
                    <div class="pull-right"><?php echo CHtml::link('Try for free',array('//user/RegisterB'))?></div>
                </div>
               
              
               
            </div><!--End register-->
            <?php } ?>
            
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
                <a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver=nhaqueonline_24h@yahoo.com.vn&product_name=vietnam photo&price=2000&return_url=http://localhost:1080/vnphoto/index.php/site/pricing&comments=Không" ><img src="https://www.nganluong.vn/data/images/buttons/3.gif"  border="0" /></a> 
            </div>
            
            <!--Continued Form-->
            <div class="pull-right">
            <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick-subscriptions">

                <!-- IPN and PDT URLs -->
                <input type="hidden" name="notify_url" value="http://localhost:1080/vnphoto/index.php" />
                <input type="hidden" name="return" value="http://localhost:1080/vnphoto/index.php" />
                <input type="hidden" name="rm" value="0" />

                <!-- Specify details about receiver, and customer -->
                <input type="hidden" name="business" value="nhaqueonline_24h@yahoo.com.vn" />
                <input type="hidden" name="custom" value="PASSTHROUGH-VARIABLE" />

                <!-- Specify details about the item that buyers will purchase. -->
                <input type="hidden" name="item_name" value="photo" />
                <input type="hidden" name="currency_code" value="USD" />

                <input type="hidden" name="no_shipping" value="1" />
                <input type="hidden" name="no_note" value="1" />
                <input type="image" src="http://www.paypal.com/en_US/i/btn/btn_subscribe_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
                <input type="hidden" name="a3" value="0.01">
                <input type="hidden" name="p3" value="1">
                <input type="hidden" name="t3" value="M">
                <input type="hidden" name="src" value="1">
                <input type="hidden" name="sra" value="1">
        </form>
            </div>
            <!--end -Continued Form-->
            
           
        </div>
    <!--End content -->
</div>

