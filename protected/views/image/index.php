<?php
/* @var $this ImageController */
/* @var $dataProvider CActiveDataProvider */

?>
<div class="well col-lg-3">
      <form  role="form" action="image_detail.html" method="post" accept-charset="UTF-8">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Tìm kiếm">
            <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span> </div>
          <!-- /input-group --> 
          
          <!-- /input-group --> 
          
        </div>
        <!-- form group -->
        
        <div class="form-group">
          <label class="checkbox-inline">
            <input type="checkbox"  id="inlineCheckbox1" value="horizontal">
            Ảnh ngang </label>
          <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox2" value="vertical" >
            Ảnh dọc </label>
        </div>
        
        <!--form group-->
        
        <div class="form-group">
          <div class="control-group">
            <div class="controls">
              <select id="selectCatergory" class="form-control" >
                <option>Loại ảnh</option>
                <option> Ảnh người </option>
                <option>Ảnh vật</option>
                <option>Ảnh phong cảnh</option>
              </select>
            </div>
          </div>
        </div>
        
        <!--End Catergory--> 
        
        <!--People-->
        <div class="form-group">
          <label class="label label-info">Tìm ảnh người</label>
        </div>
        <!--quantity-->
        <div class="form-group">
          <select id="selectPeopleAmount" class="form-control" disabled>
            <option>So nguoi</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
          </select>
        </div>
        
        <!--Sex-->
        <div class="form-group">
          <select id="selectPeopleSex" class="form-control">
            <option>Giới tính</option>
            <option>Nam</option>
            <option>Nữ</option>
          </select>
        </div>
        
        <!--form group--> 
        
        <!--Age-->
        <div class="form-group">
          <select id="selectPeopleAge" class="form-control">
            <option>Do tuoi</option>
            <option>duoi 16</option>
            <option>16 -25</option>
            <option>25 - 50</option>
            <option>Tren 50</option>
          </select>
        </div>
        
        <!--form group-->
        <div class="form-group text-center">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary ">Tìm Kiếm</button>
            <button type="button" class="btn btn-default ">Bỏ chọn</button>
          </div>
        </div>
      </form>
    </div>
 
<div class="col-lg-9">
    <div class="list-image">  
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'template'=>"{sorter}\n{pager}\n{summary}</br></br></br>{items}\n{sorter}",        
        'pager' => array(
                        'cssFile' => Yii::app()->baseUrl . '/css/.css',
                        'header' => false,
                        'firstPageLabel' => 'First',
                        'prevPageLabel' => 'Previous',
                        'nextPageLabel' => 'Next',
                        'lastPageLabel' => 'Last',
                    ), 
                       
        
)); ?>
    </div>
</div>