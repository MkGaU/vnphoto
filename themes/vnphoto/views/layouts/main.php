
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-select.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/gridview.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-theme.css" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/ImageColorPicker/dist/ImageColorPicker.css"  media="screen" charset="utf-8"/>
<link rel="Stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/jPicker/css/jpicker-1.1.6.min.css" />
<link rel="Stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/jPicker/jPicker.css" />
<link rel="Stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/colorpicker/jquery.colourPicker.css" />

<!-- Le fav and touch icons -->
</head>

<body>

<!-- NAVBAR HEADER -->

<div class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
       <p class="navbar-brand"> <?php 
        if(Yii::app()->user->getIsSuperuser()){
            echo Chtml::link('Home',array('//site/Administrator'));       
        }else{
            echo Chtml::link('Home',array('//image/FirstIndex'));
        }
      ?></p>
      <p class="navbar-text"> <span class="glyphicon glyphicon-earphone"> 0163-255-7717</span> </p>
    
    </div>
    
    <div class="navbar-collapse collapse"> 
        
      <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav navbar-right">
        
        <!--sign in -->
        
        <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?php if(!Yii::app()->user->isGuest){echo 'Hello <strong class="text-danger">' . Yii::app()->session->get('admin') . '</strong>'?> <strong class="caret"></strong></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
              <li role="presentation"><?php echo CHtml::link('Upload',array('//image/create'),array('role'=>'menuitem','tabindex'=>'-1'))?></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ảnh đã  tải về máy</a></li>
            <li role="presentation"><?php echo CHtml::link('Invidvidual profile',array('//user/profile'),array('role'=>'menuitem','tabindex'=>'-1'))?></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><?php echo CHtml::link('Logout',array('//user/logout'),array('role'=>'menuitem','tabindex'=>'-1'))?></li>
          </ul>
        </li>
        <?php }?>

        <li><?php echo CHtml::link('View Plans & Pricing <span class="glyphicon glyphicon-circle-arrow-right"></span>',array('//site/pricing'))?></li>


        <li><?php if(Yii::app()->user->isGuest){ echo CHtml::link('Sign in',array('//user/Registerb'),array('role'=>'menuitem','tabindex'=>'-1'))?>  </li>
        <?php } ?> 
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
    <div class="col-lg-12">
      <p class="h1">Vietnam<span class="text-danger">Photos</span></p>
      
    </div>

    <div class="col-lg-5">
      <form role="form" action="index.html" method="post" accept-charset="UTF-8">
        <div class="form-group">
<!--          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
            <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
            </span> </div>  -->
        </div>
      </form>
    </div>

  </div>
</div>
<!--End logo --> 

<!-- Main Container -->
<div class="container"> 
  
  <!-- row main content-->
  <div class="row"> 
    <!--Side bar-->
    
    
    <!--end collum sidebar -->     
    <!--start collum primary-->     
      
<?php //$this->renderPartial('/_menu'); ?>
	<?php echo $content; ?>
 
    
    <!--end primary--> 
    
  </div>
  <!-- end main row --> 
  
</div>
<!-- End Container --> 

<!--Footer-->

<div class="footer">
  <div class="panel-footer">
   <footer>
        <div class="row">
		<div class="col-lg-offset-1">
        <p>© 2013 VietnamPhoto   <a href="#">Home</a> · <a href="#">About</a> .</p>
		</div>
		<div class="row">
        <div class="col-lg-3 col-lg-offset-1">
          <img class="img-circle"  alt="140x140" style="width: 140px; height: 140px;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/Vietnam icon.png">
          <h3>VIETNAMPHOTO</h3>
			<p>Millions of stock photographs, illustrations from artists all around Vietnam.</p>	  
          
		
        
        </div><!-- /.col-lg-3 col-lg-offset-1 -->
        <div class="col-lg-3 col-lg-offset-1">
          
          <h2>Contact & Support</h2>
		
          <p>VietnamPhoto provides support for your product in many ways. Find out what options are available to you and how you can contact us. Contact VietnamPhoto for support - ‎Complimentary Support</p>
		   <a class="text-muted">Contact Us</a>
		    <p>.......................</p>
		    <p>Sales and Support:</p>
			<p class="text-muted">+84 1632557717</p>
			
			<a class="text-muted" href="#">Vietnamphoto-support@gmail.com</a>
		   
		   <div style="margin-top:20px;">
             <p>Follow us: 
			<span> <img class="follow-icon" src="<?php echo Yii::app()->theme->baseUrl;?>/images/facebook-icon25x25.png">  </span>
			<span> <img class="follow-icon" src="<?php echo Yii::app()->theme->baseUrl;?>/images/gplusicon-25x25.png">  </span>
			<span> <img class="follow-icon" src="<?php echo Yii::app()->theme->baseUrl;?>/images/v5-twitter-icon-25x25px.png">  </span>
			
		     </p>
		 </div>
        </div><!-- col-lg-2 col-lg-offset-1 -->
        <div class="col-lg-3 col-lg-offset-1 ">
          
          <h2>Legal</h2>
          
          			
			<p><a class="text-muted">Website Terms of Use</a></p>
			<p><a class="text-muted">Photo Licensing Terms</a></p>
			<p><a class="text-muted">Privacy Policy</a></p>
		   
		   <div style="margin-top:20px;">
		  <img class="img-circle"  alt="140x140" style="width: 140px;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/worldmap_sm.png">
		  </div>
		 
		</div>
          <!-- /.col-lg-4 -->
      </div><!-- /.row -->
   </footer>
  </div>
</div>

<!-- END FOOTER-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 


<!--jPikercolor-->

<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jPicker/jPicker-1.1.6.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jPicker/jPicker-1.1.6.min.js" type="text/javascript"></script>
<!--jscolor-->
<script  src="<?php echo Yii::app()->theme->baseUrl;?>/js/jscolor/jscolor.js" type="text/javascript"></script>

<!--colorPicker-->
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>js/colorpicker1/src/jquery.simple-color.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/colorpicker/jquery.colourPicker.js" type="text/javascript"></script>
<!--<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/colorPicker/jquery.colorPicker.min.js" type="text/javascript"></script>-->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
</body>
</html>
