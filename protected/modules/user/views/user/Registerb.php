<div class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="http://www.google.com">Photos</a>
      <p class="navbar-text"> <span class="glyphicon glyphicon-earphone"> 0163-255-7717</span> </p>
    </div>
    <div class="navbar-collapse collapse"> 
      <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav navbar-right">
        
        <!--sign in -->
        
        <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown"> <?php echo 'Xin chào <strong>' . Yii::app()->session->get('admin') . '</strong>'?> <span id="username" class="text-danger"></span> <strong class="caret"></strong></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://localhost:1080/yiiapp/index.php/images/create">Tải ảnh lên</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ảnh đã  tải về máy</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Thông tin tài khoản cá nhân</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Đăng xuất</a></li>
          </ul>
        </li>
        <li><a href="https://www.google.com.vn">Xem hình thức thanh toán <span class="glyphicon glyphicon-circle-arrow-right"></span></a> </li>
      </ul>
    </div>
  </div>
  
  <!-- /.navbar-collapse --> 
  
</div>
<!-- container -->


<!-- end navbar row--> 

<!--Logo-->
<div class="container">
  <div class="row">
    <div class="col-lg-6" >
      <p class="h1">Vietnam<span class="text-danger">Photos</span></p>
    </div>
  </div>
</div>
<!--End logo --> 

<!-- MAIN CONTAINER -->

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



<!--Footer-->


<!--Footer-->

<div class="footer">
  <div class="panel-footer">
    <div class="row">
      <div class="col-xs-2"></div>
      <div class="col-xs-2">
        <p class="text-muted"> <strong>Vietnamphotos.com</strong></p>
        <a href="http://google.com" class="text-muted">Trang chủ</a><br>
        <a href="http://google.com" class="text-muted">Thông tin</a><br>
      </div>
      <div class="col-xs-2" >
        <p class="text-muted"><strong>Liên hệ và hỗ trợ</strong></p>
        <a href="http://google.com" class="text-muted">Liên hệ với chúng tôi</a><br>
        <p class="text-muted">.............................</p>
        <p class="text-muted">Điện thoại hỗ trợ</p>
        <p class="text-muted">0163 255 7717</p>
      </div>
      <div class="col-xs-2" >
        <p class="text-muted"><strong>Lựa chọn ngôn ngữ</strong></p>
        <a href="http://google.com" class="text-muted">Tiếng Việt</a><br>
        <a href="http://google.com" class="text-muted">English</a><br>
      </div>
    </div>
  </div>
</div>

