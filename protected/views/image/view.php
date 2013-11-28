<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs = array(
    'Images' => array('index'),
    $model->Title,
);
$this->menu = array(
    array('label' => 'List Image', 'url' => array('index')),
    array('label' => 'Create Image', 'url' => array('create')),
    array('label' => 'Update Image', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Manage Image', 'url' => array('admin')),
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
                        'value' => CHtml::image(Yii::app()->request->baseUrl . $model->thumbnails, "ImgLink", array('class' => 'img-responsive')),
                    ),
                ),
                'itemTemplate' => "<div class=\"{class}\">{label}{value}</div>",
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
                    'label' => CHtml::label('Posted on : ', 'id', array('class' => 'text-muted')),
                    'type' => 'text',
                    'value' => date('M j, Y', $model->UpdateTime),
                ),
            ),
            'itemTemplate' => "<div class=\"{class}\">{label}{value}</div>",
        ));
        ?>       
     
        <div class="well">
            <form class="form-control-static" role="form" action="index.html" method="post" accept-charset="UTF-8">
                <div class="form-group">
                    <p>Format : <span id="format"><?php echo $model->format ?></span></p>
                </div>
                <div class="form-group">
                    <p>Dimensions : <?php echo $model->width.' x '.$model->height ; ?></span></p>
                </div>
                <div class="form-group">
                    <p>Size : <?php echo number_format($model->size/1048576,2);?> MB</p>
                    <?php
                    $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'primary',
                        'toggle' => 'radio', // 'checkbox' or 'radio'
                        'buttonType' => 'button',
                        'buttons' => array(
                            array('label' => 'small'),
                            array('label' => 'medium'),
                            array('label' => 'large'),
                        ),
                    ));
                    ?>                 
                </div>
                 
                <div class="form-group ">
                    <?php
                    $this->widget('bootstrap.widgets.TbDetailView', array(
                        'type' => 'bordered condensed',
                        'data' => $model,
                        'attributes' => array(
                            array(
                                'type' => 'raw',
                                'value' => function($data) {
                                    return CHtml::link('Download', array('Image/DownloadFile',
                                                'id' => $data->id,
                                                'file_name' => $data->ImgLink,
                                                'file_field' => 'ImgLink'), 
                                            array('class' => 'btn btn-default')
                                    );
                                }),
                        ),
                        'itemTemplate' => "<div class=\"{class}\">{label}{value}</div>",
                    ));
                    ?>

                    <!--                    <button class="btn btn-default">Download</button>-->

                </div>
            </form>
        </div>
        <div class="form-group">            
            <?php
            $this->widget('bootstrap.widgets.TbDetailView', array(
                'type' => 'bordered condensed',
                'data' => $model,
                'attributes' => array(
                    array(
                        'label' => CHtml::label('Tags : ', 'id', array('class' => 'text-muted')),
                        'type' => 'html',
                        'value' => implode(' ',$model->tagLinks),
                    ),
                ),
                'itemTemplate' => "<div class=\"{class}\">{label}{value}</div>",
            ));
            ?>
            
        </div>
    </div>

</div>