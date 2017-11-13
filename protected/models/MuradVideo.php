<?php

/**
 * This is the model class for table "{{_murad_video}}".
 *
 * The followings are the available columns in table '{{_murad_video}}':
 * @property string $id
 * @property integer $category_id
 * @property integer $type
 * @property string $name
 * @property integer $status
 * @property integer $is_feature
 * @property string $name_vi
 * @property string $slug
 * @property string $link
 * @property string $created_date
 */
class MuradVideo extends _BaseModel
{
    const TYPE_VIDEO = 1;
    const TYPE_AUDIO = 2;
    
    public $pathUpload = 'upload/video_image';
    public $aSize = array(
        'size1' => array('width' => 382, 'height' => 200), // size view list
        'size2' => array('width' => 100, 'height' => 55), // size view box relate
    );
    
    public $RecommendSize = "Recommend 292 x 158 (width x height)";
    
    /**
     * @Author: ANH DUNG Feb 23, 2016
     * @Todo: get array dropdown
     */
    public function getArrayType() {
        return array(
            MuradVideo::TYPE_VIDEO => "Video",
            MuradVideo::TYPE_AUDIO => "Audio",
        );
    }
    
    /**
     * @Author: ANH DUNG Feb 23, 2016
     */
    public function getType() {
        $aType = $this->getArrayType();
        return isset($aType[$this->type]) ? $aType[$this->type] : '';
    }
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradVideo the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{_murad_video}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required', 'on'=>'create, update'),
            array('name', 'length', 'max'=>350),
            array('content, id, category_id, type, name, status, is_feature, name_vi, slug, link, created_date', 'safe'),
            array('file_name', 'file','on'=>'UploadFile',
                    'allowEmpty'=>true,
                    'types'=> $this->allowImageType,
                    'wrongType'=> "Chỉ cho phép định dạng file ".  $this->allowImageType." .",
                    'maxSize'   => $this->maxImageFileSize,
                    'tooLarge'  =>'The file was larger than '. ActiveRecord::convertByte2Mb($this->maxImageFileSize) .'. Please upload a smaller file.',
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rCategory' => array(self::BELONGS_TO, 'MuradCategory', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id' => 'Category',
            'type' => 'Type',
            'name' => 'Name',
            'status' => 'Status',
            'is_feature' => 'Is Feature',
            'name_vi' => 'Name Vi',
            'slug' => 'Slug',
            'link' => 'Link',
            'created_date' => 'Created Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.category_id',$this->category_id);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.is_feature',$this->is_feature);
        $criteria->compare('t.link',$this->link,true);
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 50,
            ),
        ));
    }

    protected function beforeValidate() {
        $this->name_vi = MyFunctionCustom::remove_vietnamese_accents($this->name);
        $this->link = str_replace('width="853"', 'width="100%"', $this->link);
        return parent::beforeValidate();
    }
    
    public function behaviors(){
        return array(
            'sluggable' => array(
                'class'=>'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('name_vi'),
                'unique' => true,
                'update' => true,
            ),
        );
    }
    
        /**
     * @Author: ANH DUNG Feb 18, 2016
     */
    public function getDropdownCategory() {
        return CHtml::listData(MuradCategory::getByCatType(array(MuradCategory::CAT_VIDEO, MuradCategory::CAT_AUDIO)), "id", "name");
    }
        
    public function getCategory() {
        $mCategory = $this->rCategory;
        if($mCategory){
            return $mCategory->name;
        }
        return "";
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getLink() {
        return $this->link;
    }
    
    /**
     * @Author: ANH DUNG Mar 09, 2016
     * @Todo: get list video by category
     */
    public function SearchFE($category_id, $type_video_audio) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.category_id", $category_id);
        $criteria->compare("t.type", $type_video_audio);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->order = "t.id DESC";
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
//                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                'pageSize'=> 12,
            ),
        ));
    }
    
    protected function beforeDelete() {
        $this->RemoveFileOnly('file_name');
        return parent::beforeDelete();
    }
    
    /** fix Feb 17, 2016
     * @Author: ANH DUNG Feb 25, 2015
     * To do: delete file scan
     * @param: $modelRemove model GasFile
     * @param: $fieldName is file_name
     * @param: $aSize
     */
    public function RemoveFileOnly($fieldName) {
        $modelRemove = self::model()->findByPk($this->id);
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);
        foreach ( $this->aSize as $key => $value) {
            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $key . '/' . $modelRemove->$fieldName);
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 23, 2016
     * @Todo: render html of image thumb
     */
    public function getImageThumbTemp() {
        if(empty($this->file_name)){
            return "";
        }
        $imageUrl = ImageProcessing::bindImageByModel($this, 'size1');
        $imageUrlS2 = ImageProcessing::bindImageByModel($this, 'size2');
        return "<a rel='group1' class='gallery' href='$imageUrl'>"
                . "<img class='image_thumb_temp' src='$imageUrl'>"
                . "</a>";
    }
        
    public function getUrlImage($size) {
        if(empty($this->file_name)){
            return Yii::app()->createAbsoluteUrl('/')."/upload/noimage/noimage-muradvn.jpg";
        }
        return ImageProcessing::bindImageByModel($this, $size);;
    }
    
    public function getUrlVideoDetail($needMore = array()) {
        if($this->type == MuradVideo::TYPE_VIDEO){
            $url = Yii::app()->createAbsoluteUrl("videos/detail", array('slug'=> $this->slug));
        }else{
            $url = Yii::app()->createAbsoluteUrl("videos/detailRadio", array('slug'=> $this->slug));
        }
        if(isset($needMore['url'])){
            $url = "<a href='$url'>{$this->getName()}</a>";
        }
        return $url;
    }
    
    /**
     * @Author: ANH DUNG Mar 14, 2016
     * @Todo: get feature product at home page
     */
    public static function getFeaturedVideo($type, $aIdNotIn) {
        $criteria = new CDbCriteria();
        $criteria->limit = 10;
        $criteria->compare("t.type", $type);
        $criteria->addNotInCondition("t.id", $aIdNotIn);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->order = "t.name";
        return self::model()->findAll($criteria);
    }
    
    
    /**
     * @Author: ANH DUNG Apr 27, 2016
     * @Todo: only dev fix resize
     */
    public static function DevFixResizeAll() {
        $models = MuradVideo::model()->findAll();
        foreach($models as $model){
            $model->resizeImage("file_name");
        }
        echo '<pre>';
        print_r(count($models));
        echo '</pre>';
        die;
        
    }
}