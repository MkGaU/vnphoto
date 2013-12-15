<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $Title
 * @property String $filename
 * @property string $Author
 * @property integer $Category
 * @property string $sex
 * @property string $tags
 * @property string $description
 * @property string $ImgLink
 * @property String $imageColor
 * @property integer $format
 * @property integer $size
 * @property integer $width
 * @property integer $height
 * @property string $tendency
 * @property string $thumbnails
 * @property integer $CreatedTime
 * @property integer $UpdateTime
 */
class Image extends CActiveRecord {

    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;

    private $_oldTags;   

    /**
     * @return string the associated database table name
     */

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Image the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('filename, status', 'required'),            
            array('status', 'in', 'range' => array(1, 2, 3), 'allowEmpty' => true, 'on' => 'update'),            
            array('filename', 'file', 'allowEmpty' => true, 'types' => 'jpg,png', 'on' => 'update', 'maxSize' => 1024 * 1024 * 15, 'tooLarge' => 'File has to smaller than 15MB'),
            array('Category, ageType, status, size, width, height, CreatedTime, UpdateTime', 'numerical', 'integerOnly'=>true),
            array('Title, ImgLink, thumbnails, filename, description', 'length', 'max' => 255),
            array('Author, ageType', 'length', 'max' => 11),
            array('tendency, sex, imageColor', 'length', 'max'=>25),
            array('tags', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'Tags can only contain word characters.'),
            array('tags', 'normalizeTags'),
            array('format, size, width, height', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, Title, Author, Category, ageType, tags, ImgLink, thumbnails, CreatedTime, UpdateTime, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Author' => array(self::BELONGS_TO, 'User', 'Author'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'Title' => 'Title',
            'Author' => 'Author',
            'Category' => 'Category',
            'sex'=>'Sex',
            'ageType' => 'AgeType',
            'tags' => 'Tags',
            'status' => 'Status',
            'description'=>'Description',
            'ImgLink' => 'Img Link',
            'format' => 'Format',
            'size' => 'Size',
            'imageColor'=>'ImageColor',
            'width' => 'Width',
            'height' => 'Height',
            'tendency' => 'Tendency',
            'thumbnails' => 'Thumbnails',
            'CreatedTime' => 'Created Time',
            'UpdateTime' => 'Update Time',
        );
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl() {
        return Yii::app()->createUrl('image/view', array(
                    'id' => $this->id,
                    'title' => $this->Title,
        ));
    }

    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks() {
        $links = array();
        foreach (Tags::string2array($this->tags) as $tag)
            $links[] = CHtml::link(CHtml::encode($tag), array('image/index', 'tag' => $tag), array('class' => 'tag label label-info'));
        return $links;
    }

    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute, $params) {
        $this->tags = Tags::array2string(array_unique(Tags::string2array($this->tags)));
    }

    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    protected function afterFind() {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria(array(
            'condition' => 'status=' . self::STATUS_PUBLISHED,
            'order' => 'UpdateTime DESC',
        ));

        $criteria->compare('id', $this->id);
        $criteria->compare('Title', $this->Title, true);
        $criteria->compare('Author', $this->Author, true);
        $criteria->compare('Category', $this->Category);
        $criteria->compare('sex', $this->sex);
        $criteria->compare('ageType', $this->ageType);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('imageColor', $this->imageColor,true);
        $criteria->compare('status', $this->status);
        $criteria->compare('description', $this->description,true);
        $criteria->compare('format',$this->format,true);
        $criteria->compare('tendency', $this->tendency,true);
        $criteria->compare('ImgLink', $this->ImgLink, true);
        $criteria->compare('format', $this->format, true);
        $criteria->compare('thumbnails', $this->thumbnails, true);
        $criteria->compare('CreatedTime', $this->CreatedTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchadmin() {
        $criteria = new CDbCriteria;
        
        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->Title, true);

        $criteria->compare('status', $this->status);

        $criteria->compare('thumbnails', $this->thumbnails, TRUE);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'status, UpdateTime DESC',
            ),
        ));
    }
    

    /*
     * Return next ID compare current ID
     */

    public function getNextId() {
        $record = self::model()->find(array(
            'condition' => 'id>:current_id',
            'order' => 'id ASC',
            'limit' => 1,
            'params' => array(':current_id' => $this->id),
        ));
        if ($record !== null)
            return $record->id;
        return $this->id;
    }

    /*
     * Return previous ID compare current ID
     */

    public function getPreviousId() {
        $record = self::model()->find(array(
            'condition' => 'id<:current_id',
            'order' => 'id DESC',
            'limit' => 1,
            'params' => array(':current_id' => $this->id),
        ));
        if ($record !== null)
            return $record->id;
        return $this->id;
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->CreatedTime = $this->UpdateTime = time();
                $this->Author = Yii::app()->user->name;
               
            }
            else
                $this->UpdateTime = time();
            return true;
        }
        else
            return false;
    }
    
    /**
     * This is invoked after the record is saved.
     */
    protected function afterSave() {
         $this->iduser= Yii::app()->user->id;
        $this->addImages();
        parent::afterSave();
        Tags::model()->updateFrequency($this->_oldTags, $this->tags);
    }

    

}
