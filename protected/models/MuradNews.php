<?php

/**
 * This is the model class for table "{{_murad_news}}".
 *
 * The followings are the available columns in table '{{_murad_news}}':
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property integer $category_id
 * @property integer $feature_image
 * @property string $name_vi
 * @property string $slug
 * @property string $content
 * @property string $created_date
 */
class MuradNews extends _BaseModelMulti
{
    public $pathUpload = 'upload/news';
    public $pathUploadMuti = 'upload/news/editor';
    public $uploadMulti;
    public $aSize = array(
        'size1' => array('width' => 55, 'height' => 55), // size view home
        'size2' => array('width' => 775, 'height' => 421), // size view detail
//        'size3' => array('width' => 600, 'height' => 600), // size view zoom
    );
    
    const TYPE_LASTEST = 1;
    const TYPE_MOST_VIEW = 2;

    const PAGE_AGENT_LOCATION = 5;// Business Locations

    // Jul 23, 2016 for multilang
    public $modelTranslate  = 'MuradNewsTranslate';// Jun 19, 2016
    public $slug_default    = 'name_vi';// Jun 19, 2016
    public $name;// Aug 05, 2016
    public $content;
    public $short_content;
    // Jul 23, 2016 for multilang
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradNews the static model class
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
            return '{{_murad_news}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required', 'on'=>"create, update"),
            array('name', 'length', 'max'=>350),
            array('type_category_root, category_id_2, order_display, uploadMulti, short_content, id, name, status, category_id, feature_image, name_vi, slug, content, created_date', 'safe'),
            array('feature_image', 'file','on'=>'UploadFile',
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
            'rCategory2' => array(self::BELONGS_TO, 'MuradCategory', 'category_id_2'),
//            'rTranslate' => array(self::HAS_MANY, $this->modelTranslate, 'translate_id','limit' => 1,'on'=>"rTranslate.language='".Yii::app()->language."'"),
            'rTranslate' => array(self::HAS_MANY, $this->modelTranslate, 'translate_id','limit' => 1,'on'=>"rTranslate.language='". Yii::app()->language ."'"),
            'rTranslateOne' => array(self::HAS_ONE, $this->modelTranslate, 'translate_id', 'on'=>"rTranslateOne.language='".Yii::app()->language."'"),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name_for_slug' => 'Tiêu Đề',
            'name' => 'Tiêu Đề',
            'status' => 'Trạng thái',
            'category_id' => 'Category 1',
            'feature_image' => 'Feature Image',
            'name_vi' => 'Name Vi',
            'slug' => 'Slug',
            'content' => 'Nội dung',
            'created_date' => 'Ngày tạo',
            'short_content' => 'Short Content',
            'uploadMulti' => 'Upload hình ảnh',
            'order_display' => 'Thứ Tự Hiển Thị',
            'category_id_2' => 'Category 2',
            'type_category_root' => 'Category Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.category_id',$this->category_id);
        $criteria->compare('t.type_category_root', $this->type_category_root);
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 50,
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     * @Todo: fix update category type
     */
    public static function updateFixAll() {
        $models = self::model()->findAll();
        foreach($models as $item){
            $item->validate();
            $item->update(array('category_type', 'type_category_root'));
        }
        die;
    }
        
    protected function beforeValidate() {
        $this->attributes = $this->getDataValidateWithLanguage($this->languageDefault);
        $this->name_for_slug = $this->name;
        $this->name_vi = MyFunctionCustom::remove_vietnamese_accents($this->name);
        $mCategory = $this->rCategory;
        if($mCategory){
            $this->category_type        = $mCategory->category_type;
            $this->type_category_root   = $mCategory->type;
        }
        $mCategory2 = $this->rCategory2;
        if($mCategory2){
            $this->category_type_2      = $mCategory2->category_type;
            $this->type_category_root_2 = $mCategory2->type;
        }
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
        return MuradCategory::getByCatType(MuradCategory::CAT_NEWS, array('ListDataBE'=>1));
    }
        
    public function getCategory() {
        $mCategory = $this->rCategory;
        if($mCategory){
            return $mCategory->getName();
        }
        return "";
    }
    
    public function getCategory2() {
        $mCategory = $this->rCategory2;
        if($mCategory){
            return $mCategory->getName();
        }
        return "";
    }
    
    protected function beforeDelete() {
        $this->RemoveFileOnly('feature_image');
        MyFormat::deleteModelDetailByRootId('MuradNewsTranslate', $this->id, 'translate_id');
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
        if(empty($this->feature_image)){
            return "";
        }
        $imageUrl = ImageProcessing::bindImageByModel($this, 'size1');
        $imageUrlS3 = ImageProcessing::bindImageByModel($this, 'size2');
        return "<a rel='group1' class='gallery' href='$imageUrlS3'>"
                . "<img class='image_thumb_temp' src='$imageUrl'>"
                . "</a>";
    }
    
    public function getUrlImage($size) {
        if(empty($this->feature_image)){
            return "";
        }
        return ImageProcessing::bindImageByModel($this, $size);;
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get list product by category
     */
    public static function SearchFE() {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->addNotInCondition("t.category_id", MuradCategory::getIdNotBlog());
        if(isset($_GET['slug'])){
            $mCat = MyFormat::getBySlug("MuradCategory", $_GET['slug']);
            $criteria->compare("t.category_id", $mCat->id);
            $session = Yii::app()->session;
            $session["ModelCategory"] = $mCat;
        }
        $criteria->order = "t.id DESC";
        
        return new CActiveDataProvider('MuradNews', array(
            'criteria'=>$criteria,
            'pagination'=>array(
//                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                'pageSize'=> 10,
            ),
        ));
    }

    /**
     * @Author: ANH DUNG Feb 24, 2016
     */
    public function getFeCreatedDate() {
        return MyFormat::dateConverYmdToDmy($this->created_date);
    }
    
    public function getFeShortContent() {
        return MyFunctionCustom::ShortenString($this->content, 200);
    }
    
    public function getUrlDetail($needMore = array()) {
        $url = Yii::app()->createAbsoluteUrl("news/detail", array('slug'=> $this->slug, 'lang'=>Yii::app()->language));
        $target = "";
        if(isset($needMore['target'])){
            $target = "target='_blank'";
        }
        if(isset($needMore['url'])){
            $url = "<a $target href='$url'>{$this->getName()}</a>";
        }
        return $url;
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2016
     * @Todo: get url detail by slug
     */
    public static function getUrlDetailBySlug($slug) {
        return Yii::app()->createAbsoluteUrl("news/detail", array('slug'=> $slug, 'lang'=>Yii::app()->language));
    }
        
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get relate product at product detail
     */
    public static function getRelateNews($type) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->addNotInCondition("t.category_id", MuradCategory::getIdNotBlog());
        $criteria->order = "t.id DESC, t.name ASC"; // TYPE_LASTEST
        if($type == MuradNews::TYPE_LASTEST){
            $criteria->order = "t.id DESC, t.name ASC"; // TYPE_LASTEST
        }
        $criteria->limit = 10;
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Mar 24, 2016
     */
    public static function getUrlContacUs() {
        return Yii::app()->createAbsoluteUrl("site/contactUs");
        $session = Yii::app()->session;
        if(!isset($session['URL_CONTACT_US'])){
            $model = MuradNews::getModelContacUs();
            $url = Yii::app()->createAbsoluteUrl("site/contactUs");
            $session['URL_CONTACT_US'] = $aCat;
        }else{
            return $session['URL_CONTACT_US'];
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 24, 2016
     */
    public static function getModelContacUs() {
        return MuradNews::model()->findByPk(MuradNews::ID_CONTACT_US);
    }
    
    /**
     * @Author: ANH DUNG Mar 28, 2016
     */
    public static function getModelPage($id) {
        return MuradNews::model()->findByPk($id);
    }

    /**
     * @Author: ANH DUNG Mar 29, 2016
     * @Todo: get list file in this 
     */
    public function getListFileMulti() {
        $pathUpload = $this->getPathUpload();
        $aFiles = $this->getArrayFile($pathUpload);
        $res = '';
        foreach ($aFiles as $key => $value) 
        {
            if (!in_array($value,array(".",".."))) 
            {
                $url = Yii::app()->createAbsoluteUrl("/")."/$pathUpload/$value";
                $urlDelete = Yii::app()->createAbsoluteUrl("admin/muradNews/update", array('id'=>$this->id, 'delete_file'=>$value));
                $htmlDelete = "<a title='delete image' href='$urlDelete' class='btn_closed_tickets' alert_text='Bạn chắc chắn muốn xóa'><strong>Delete</strong></a>";
                if(!$this->canDeleteImage()):
                    $htmlDelete = '';
                endif;
                
                
                $classElement = "classElement$key";
                $temp = "<div class='box_temp_image float_l l_padding_20'>
                            <img src='$url' width='100' height='100'>
                            <span class='$classElement display_none'>$url</span>
                            <br>
                            <a title='$url' href='javascript:void(0)' data-class='$classElement' class='copyToClipboard'>Copy URL</a>
                            $htmlDelete
                        </div>";

                $res .= $temp;
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Mar 29, 2016
     * @Todo: delete file
     */
    public function deleteFileDirectory($controller) {
        if(isset($_GET['delete_file'])){
            $ImageHelper = new ImageHelper();
            $ImageHelper->folder = '/'.$this->getPathUpload();
            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $_GET['delete_file']);
            $controller->redirect(array('update','id'=>$this->id));
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 29, 2016
     * @Todo: get array file name at directory
     */
    public function getArrayFile($pathUpload) {        
        $directory = Yii::getPathOfAlias('webroot')."/$pathUpload";
        if(is_dir($directory)){
            return $aFiles = scandir($directory);
        }
        return array();
    }
    
    /**
     * @Author: ANH DUNG Mar 30, 2016
     * @Todo: get nice url by id
     */
    public static function getUrlById($id) {
        $model = MuradNews::model()->findByPk($id);
        if($model){
            return Yii::app()->createAbsoluteUrl("site/pages", array('slug'=>$model->slug));
        }
        return "";
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2016
     * @Todo: lấy tin tức có order_display = 1 của category để update slug newss qua category
     * @Param: $category_id
     */
    public static function getFirstNewsByCategory($category_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.category_id", $category_id);
        $criteria->order = "t.order_display ASC";
        $criteria->limit = 1;
        return self::model()->find($criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 04, 2016
     * @todo: disable delete image all in system
     */
    public function canDeleteImage() {
        if(Yii::app()->params['DeleteImage'] == 'no'){
            return false;
        }
        return true;
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     * @Todo: get list new by type_category_root
     */
    public static function getByCatRoot($type_category_root) {
        $criteria = new CDbCriteria();
        if(!empty($type_category_root)){
            $criteria->addCondition("t.type_category_root=$type_category_root OR t.type_category_root_2=$type_category_root" );
        }
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->order = "t.order_display";
        $models = self::model()->findAll($criteria);
        $aRes = array();
        foreach($models as $item){
            $aRes[$item->category_id][] = $item;
            if(!empty($item->category_id_2)){
                $aRes[$item->category_id_2][] = $item;
            }
        }
        return $aRes;
    }

}