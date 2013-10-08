<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <tt><?php echo __FILE__; ?></tt>.</p>

<?php $this->beginWidget('application.extensions.thumbnailer.Thumbnailer', array(
 
        'thumbsDir' => 'data/thumbs',
        'thumbWidth' => 200,
        'thumbHeight' => 150, // Optional
    )
); ?>
 
// This portion is captured by the widget
<img src="data/10583.jpg" />
<img src="data/10583.jpg" />
<img src="data/10583.jpg" /> 


<?php $this->endWidget(); ?>