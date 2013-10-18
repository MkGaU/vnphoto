<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs = array(
    'Images' => array('index'),
    $model->Title,
);

?>


<div class="row">
    <div class="col-lg-5">
        <div class="thumbnail text-center"> 
            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'data' => $model,
                'attributes' => array(
                    array(
                        'type' => 'raw',
                        'value' => CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->ImgLink, "ImgLink", array('class' => 'img-responsive')),
                    ),
                ),
            ));
            ?>
        </div>
        <div class="navbar text-center">
            <ul class="nav navbar-nav">
                <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Lưu trữ			<strong class="caret"></strong></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-folder-open"></span> Album1</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-folder-open"></span> Album2</a></li>
                    </ul>
                </li>
                <li><a href="#">Ảnh liên quan</a></li>
                <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Chia sẻ			<strong class="caret"></strong></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Facebook</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Zing me</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4">
<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'bordered condensed',
    'data' => $model,
    'attributes' => array(
        array(
            'type' => 'html',
            'value' => CHtml::link('<h3>' . $model->Title . '</h3>', "", array('class' => 'label label-info')),
        ),
        array(
            'label' => CHtml::label('ID :', 'id', array('class' => 'text-muted')),
            'type' => 'text',
            'value' => $model->id,
        ),
        array(
            'label' => CHtml::label('Author : ', 'id', array('class' => 'text-muted')),
            'type' => 'text',
            'value' => $model->Author,
        ),
        array(
            'label' => CHtml::label('Tags : ', 'id', array('class' => 'text-muted')),
            'type' => 'text',
            'value' => $model->Tags,
        ),
    ),
    'itemTemplate' => "<div class=\"{class}\">{label}{value}</div>",
));
?>
        <div class="well">
            <form class="form-control-static" role="form" action="index.html" method="post" accept-charset="UTF-8">
                <div class="form-group">
                    <p>Định dạng: <span id="format">Jpg</span></p>
                </div>
                <div class="form-group">
                    <p>Kích thước: </p>
                    <label class="radio">
                        <input type="radio"  id="radioImage" value="small">
                        Nhỏ </label>
                    <label class="radio">
                        <input type="radio" id="radioImage" value="medium" >
                        Trung bình </label>
                    <label class="radio">
                        <input type="radio" id="radioImage" value="large" >
                        To </label>
                </div>
                <div class="form-group ">
                    <button class="btn btn-default">Tải về</button>
                </div>
            </form>
        </div>
        <div class="tags" style="border-top:1px solid #CCC;">
            <p>Tag: <a href="#">Vietnam</a>,<a href="#"> Girl</a>,<a href="#"> Áo dài</a></p>
        </div>
    </div>

</div>