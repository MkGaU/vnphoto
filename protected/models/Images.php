<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property integer $id
 * @property string $file
 * @property string $date_available
 * @property string $date_creation
 * @property string $name
 * @property string $comment
 * @property string $author
 * @property string $hit
 * @property integer $filesize
 * @property integer $width
 * @property integer $height
 * @property string $coi
 * @property string $representative_ext
 * @property string $date_metadata_update
 * @property double $rating_score
 * @property string $path
 * @property integer $storage_category_id
 * @property integer $level
 * @property string $md5sum
 * @property integer $added_by
 * @property integer $rotation
 */
class Images extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{images}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('filesize, width, height, storage_category_id, level, added_by, rotation', 'numerical', 'integerOnly' => true),
            array('rating_score', 'numerical'),
            array('file, name, author, path', 'length', 'max' => 255),
            array('hit', 'length', 'max' => 10),
            array('coi, representative_ext', 'length', 'max' => 4),
            array('md5sum', 'length', 'max' => 32),
            array('date_available, date_creation, comment, date_metadata_update', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, file, date_available, date_creation, name, comment, author, hit, filesize, width, height, coi, representative_ext, date_metadata_update, rating_score, path, storage_category_id, level, md5sum, added_by, rotation', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'file' => 'File',
            'date_available' => 'Date Available',
            'date_creation' => 'Date Creation',
            'name' => 'Name',
            'comment' => 'Comment',
            'author' => 'Author',
            'hit' => 'Hit',
            'filesize' => 'Filesize',
            'width' => 'Width',
            'height' => 'Height',
            'coi' => 'Coi',
            'representative_ext' => 'Representative Ext',
            'date_metadata_update' => 'Date Metadata Update',
            'rating_score' => 'Rating Score',
            'path' => 'Path',
            'storage_category_id' => 'Storage Category',
            'level' => 'Level',
            'md5sum' => 'Md5sum',
            'added_by' => 'Added By',
            'rotation' => 'Rotation',
        );
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('date_available', $this->date_available, true);
        $criteria->compare('date_creation', $this->date_creation, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('hit', $this->hit, true);
        $criteria->compare('filesize', $this->filesize);
        $criteria->compare('width', $this->width);
        $criteria->compare('height', $this->height);
        $criteria->compare('coi', $this->coi, true);
        $criteria->compare('representative_ext', $this->representative_ext, true);
        $criteria->compare('date_metadata_update', $this->date_metadata_update, true);
        $criteria->compare('rating_score', $this->rating_score);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('storage_category_id', $this->storage_category_id);
        $criteria->compare('level', $this->level);
        $criteria->compare('md5sum', $this->md5sum, true);
        $criteria->compare('added_by', $this->added_by);
        $criteria->compare('rotation', $this->rotation);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Images the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    

}
