<?php

/**
 * This is the model class for table "{{_murad_category}}".
 *
 * The followings are the available columns in table '{{_murad_category}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $category_type
 * @property integer $type
 * @property string $name_vi
 * @property string $slug
 * @property string $meta_keywords
 * @property string $meta_description
 */
class MuradCategory extends _BaseModelMulti
{
    const CAT_PRODUCT   = 1;// Feb 18, 2016 các loại cần quản lý category
    const CAT_NEWS      = 2; // is field category_type
    const CAT_CMS_PAGE  = 3;
//    const CAT_AUDIO     = 4;
    
//    const TYPE_MUN = 1;// type này chỉ dùng cho Product hoặc cái khác nếu phát sinh ...
    const TYPE_ABOUT_SK_GAS = 1;// type này chỉ dùng cho Product hoặc cái khác nếu phát sinh ...
//    const TYPE_NAM_LAOHOA = 2;//category type: Mụn, Nám & lão hóa, Cellulite, Vấn đề da khác
    const TYPE_BUSINESS_AREAS = 2;//category type: Mụn, Nám & lão hóa, Cellulite, Vấn đề da khác
//    const TYPE_CELLULITE = 3;
    const TYPE_INVESTOR_RELATIONS = 3;
//    const TYPE_DA_KHAC = 4;
    const TYPE_CSR = 4;
    const TYPE_PR_ROOM = 5;
    const TYPE_CAREERS = 6;
    
    public $pathUpload = 'upload/banner_categroy';
    
    // Jul 23, 2016 for multilang
    public $modelTranslate  = 'MuradCategoryTranslate';// Jun 19, 2016
    public $slug_default    = 'name_vi';// Jun 19, 2016
    public $name;// Aug 04, 2016
    // Jul 23, 2016 for multilang
    /**
     * @Author: ANH DUNG Mar 24, 2016
     * @Todo: get array id thuộc về News nhưng mà không thuộc Blog, sẽ là các page trên hệ thống nhwg about us, contact us
     */
    public static function getIdNotBlog() {
        return array(
            MuradCategory::NEWS_PAGES,
        );
    }
    
    public function getArrayType() {
        return array(
            MuradCategory::TYPE_ABOUT_SK_GAS => "AboutSkGas",
            MuradCategory::TYPE_BUSINESS_AREAS => "BusinessAreas",
//            MuradCategory::TYPE_INVESTOR_RELATIONS => "InvestorRelations",
            MuradCategory::TYPE_CSR => "Csr",
            MuradCategory::TYPE_PR_ROOM => "PrRoom",
            MuradCategory::TYPE_CAREERS => "Careers",
        );
    }
    
    public function getArrayTypeIcon() {
        return array(
            MuradCategory::TYPE_ABOUT_SK_GAS => "fa-home",
            MuradCategory::TYPE_BUSINESS_AREAS => "fa-file-text",
            MuradCategory::TYPE_INVESTOR_RELATIONS => "fa-pie-chart",
            MuradCategory::TYPE_CSR => "fa-heart",
            MuradCategory::TYPE_PR_ROOM => "fa-magic",
            MuradCategory::TYPE_CAREERS => "fa-globe",
        );
    }
    
    /**
     * @Author: ANH DUNG Feb 18, 2016
     * @Todo: get array type text
     */
    public function getArrayCategoryType() {
        return array(
//            MuradCategory::CAT_PRODUCT => "Product",// Jul 25, 2016 tạm close lại vì chưa sử dụng, sẽ mở sau
            MuradCategory::CAT_NEWS     => "News",
            MuradCategory::CAT_CMS_PAGE => "CMS Page",
//            MuradCategory::CAT_AUDIO => "Audio",
        );
    }

    public function getCategoryTypeText() {
        $aCatType = $this->getArrayCategoryType();
        return isset($aCatType[$this->category_type]) ? $aCatType[$this->category_type] : '';
    }
    
    public function getType() {
        $aType = $this->getArrayType();
        return isset($aType[$this->type]) ? $aType[$this->type] : "";
    }
    
    public function getMetaKeywords() {
        return $this->meta_keywords;
    }
    public function getMetaDescription() {
        return $this->meta_description;
    }
    public function getNameTranslate() {
        if(isset($this->rMulti[0])){
            return $this->rMulti[0]->getName();
        }
        return $this->name_for_slug;
    }
   
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradCategory the static model class
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
        return '{{_murad_category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, category_type', 'required', 'on'=>'create, update'),
            array('name', 'length', 'max'=>350),
            array('name_for_slug, order_display, file_name, color, id, name, status, category_type, type, name_vi, slug, meta_keywords, meta_description', 'safe'),
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
            'rTranslate' => array(self::HAS_MANY, $this->modelTranslate, 'translate_id','limit' => 1,'on'=>"rTranslate.language='". Yii::app()->language ."'"),
            'rTranslateOne' => array(self::HAS_ONE, $this->modelTranslate, 'translate_id', 'on'=>"rTranslateOne.language='".Yii::app()->language."'"),
//            'rMulti' => array(self::HAS_MANY, $this->modelTranslate, 'translate_id', "joinType"=>"RIGHT JOIN", 'on'=>"rMulti.language='". Yii::app()->language ."'"),
            'rMulti' => array(self::HAS_MANY, $this->modelTranslate, 'translate_id', 'on'=>"rMulti.language='". Yii::app()->language ."'"),// Aug 0, 2016 không cần dùng hàm trên
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
            'name' => 'Name',
            'status' => 'Status',
            'category_type' => 'Category Type',
            'type' => 'Type',
            'name_vi' => 'Name Vi',
            'slug' => 'Slug',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'file_name' => 'Banner',
            'order_display' => 'Order Display',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.category_type',$this->category_type);
        $criteria->compare('t.type',$this->type);
//        $criteria->order = "t.category_type DESC, t.id DESC";
        $criteria->order = " t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 50,
            ),
        ));
    }

    protected function beforeValidate() {
        $this->attributes = $this->getDataValidateWithLanguage($this->languageDefault);
        $this->name_for_slug = $this->name;
        $this->name_vi = MyFunctionCustom::remove_vietnamese_accents($this->name);
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
     * @Todo: get by category type
     * @Param: $category_type
     */
    public static function getByCatType($category_type, $needMore = array()) {
        $criteria = new CDbCriteria();
        if(!empty($category_type)){
            if(is_array($category_type)){
                $criteria->addInCondition("t.category_type", $category_type);
            }else{
                $criteria->compare("t.category_type", $category_type);
            }
        }
        $criteria->compare("t.status", STATUS_ACTIVE);
        if($category_type == MuradCategory::CAT_NEWS){
            if(isset($needMore['limit_blog'])){
                $criteria->addNotInCondition("t.id", MuradCategory::getIdNotBlog());
            }
        }
        $criteria->order = "t.type ASC, t.id DESC";
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        $models = self::model()->findAll($criteria);
        $aRes = array();
        if(isset($needMore['ListDataBE'])){
            foreach($models as $item){
                $aRes[$item->id] = $item->getName();
            }
            return $aRes;
        }
        return $models;
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: format array cat by array type => model cat
     */
    public function formatCatByType() {
        $models = MuradCategory::getByCatType(MuradCategory::CAT_PRODUCT);
        $aRes = array();
        foreach($models as $model){
            $aRes[$model->type][] = $model;
        }
        return $aRes;
    }
    
    public function getUrlListProduct($needMore = array()) {
        return Yii::app()->createAbsoluteUrl("product/index", array('category_slug'=>$this->slug));
    }
    
    public static function getUrlListProductByType($category_type, $needMore = array()) {
        $aTypeSlug = MuradCategory::model()->getArrayTypeSlug();
        return Yii::app()->createAbsoluteUrl("product/index", array('category_type'=>$aTypeSlug[$category_type]));
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get model by slug
     */
    public static function getByType($type_slug, &$NameCategory) {
        $aTypeSlug = MuradCategory::model()->getArrayTypeSlug();
        $aTypeTextVi = MuradCategory::model()->getArrayType();
        $type = array_search ($type_slug, $aTypeSlug);
        if($type){
            $NameCategory = $aTypeTextVi[$type];
        }else{
            return array();
        }
        
        $criteria = new CDbCriteria();
        $criteria->compare("t.type", $type);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $models = MuradCategory::model()->findAll($criteria);
        return CHtml::listData($models, 'id', 'id');
    }
    
    /**
     * @Author: ANH DUNG Mar 09, 2016
     * @Todo: at HOme Page category Type
     */
    public static function getArrayModelByArrayId($aId, $needMore=array()) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.id", $aId);
        $models = MuradCategory::model()->findAll($criteria);
        $aRes = array();
        foreach($models as $model){
            $aRes[$model->id] = $model;
        }
        return $aRes;
    }
    
    /**
     * @Author: ANH DUNG Mar 24, 2016
     * @Todo: init session of cat news blog at FE
     */
    public static function initSessionHome() {
        $aCat = MuradCategory::getByCatType(MuradCategory::CAT_NEWS, array('limit_blog'=>1,'order'=>"t.id ASC"));
        $session = Yii::app()->session;
        $session['HOME_CAT_MEWS'] = $aCat;
        if(!isset($session['HOME_CAT_MEWS'])){
            
        }
    }
    
    /**
     * @Author: ANH DUNG Jun 13, 2015
     * @Todo: something
     */
    public function getColor() {
        return "#".$this->color;
    }

    public function getColorBox() {
        return '<div class="colorSelector"><div style="background-color: '.$this->getColor().' "></div></div>';
    }

    protected function beforeDelete() {
        $this->RemoveFileOnly('file_name');
        MyFormat::deleteModelDetailByRootId('MuradCategoryTranslate', $this->id, 'translate_id');
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
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $this->$fieldName);
    }
    
    public function getImageThumbTemp() {
        if($this->file_name != ''){
            return parent::getImageThumbTemp();
        }
        return "";
    }
    
    /**
     * @Author: ANH DUNG Aug 02, 2016
     * @Todo: get all Category then put to session make menu
     */
    public function getCatShowFe() {
        $models = $this->getCatShowFeData();
        $aRes = array();
        foreach($models as $item){
            $aRes[$item->type][] = $item;
        }
        return $aRes;
    }
    
    public function getCatShowFeData() {// ANH DUNG Aug 02, 2016
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->with = array('rMulti');
        $criteria->order = "t.order_display ASC";
        return self::model()->findAll($criteria);
    }
    
    public static function renderFeMenu() {
        $modelCat = new MuradCategory();
        return $modelCat->getFeTopMenuHtml();
    }
    public static function renderFeMenuFooter() {
        $modelCat = new MuradCategory();
        return $modelCat->getFeMenuFooterHtml();
    }
    
    public static function renderFeMenuLeft($type_id) {
        $modelCat = new MuradCategory();
        return $modelCat->getFeMenuLeftHtml($type_id);
    }
    
    public static function renderFeSitemap() {
        $modelCat = new MuradCategory();
        return $modelCat->getFeSitemapHtml();
    }
    
    /**
     * @Author: ANH DUNG Aug 04, 2016
     * @todo: render menu top at FE
     */
    public function getFeTopMenuHtml() {
        $aCatByType = $this->getCatShowFe();
        $aCatTypeIcon = $this->getArrayTypeIcon();
        $str = "";
        $str .= "<div class='mainmenu'>";
            $str .= "<div id='sidebar-btn'>";
               $str .= "<span></span>";
               $str .= "<span></span>";
               $str .= "<span></span>";
            $str .= "</div>";
            $str .= "<div id='sidebar'>";
            $str .= "<ul class='menu clearfix'>";
        
        foreach($this->getArrayType() as $type_id=>$type_key){
            $CatRootLabel = MyFormat::label($type_key);
            $icon = isset($aCatTypeIcon[$type_id]) ? $aCatTypeIcon[$type_id] : $aCatTypeIcon[1];
            $str .= "<li class='RootMenuLi'><a class='RootMenuLink ToCopy$type_key'>$CatRootLabel</a>";
                $str .= "<div class='divmenu'>";
                    $str .= "<div class='container'>";
                        $str .= "<h3><span><i class='fa $icon'></i></span>$CatRootLabel</h3>";
                        $str .= "<ul class='menusub'>";
                            foreach($aCatByType[$type_id] as $key=>$mCat){
                                $classFirst = "FirstCatMenu";
                                if($key != 0){
                                    $classFirst = "";
                                }
                                $url = MuradNews::getUrlDetailBySlug($mCat->news_slug);
                                $str .= "<li><a class='$classFirst' href='$url'>{$mCat->getNameTranslate()}</a></li>";
                            }
                        $str .= "</ul>";
                    $str .= "</div>";
                $str .= "</div>";
            $str .= "</li>";
        }
        
                $str .= "</ul>";
            $str .= "</div>";
        $str .= "</div>";// end mainmenu
        return $str;
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2016
     * @todo: render menu footer at FE
     */
    public function getFeMenuFooterHtml() {
        $aCatByType = $this->getCatShowFe();
        $str = "";
        foreach($this->getArrayType() as $type_id=>$type_key){
            $CatRootLabel = MyFormat::label($type_key);
            $str .= "<div class='col-md-2 col-sm-6 col-xs-12'>";
            $str .= "<h3>$CatRootLabel</h3>";
                $str .= "<ul class=''>";
                    foreach($aCatByType[$type_id] as $mCat){
                        $url = MuradNews::getUrlDetailBySlug($mCat->news_slug);
                        $str .= "<li><a href='$url'>{$mCat->getNameTranslate()}</a></li>";
                    }
                $str .= "</ul>";
            $str .= "</div>";
        }

//        $str .= "</div>";// ko hiểu sao có cái đóng div này Aug 26, 2016
        return $str;
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     * @todo: render menu sitemap at FE
     */
    public function getFeSitemapHtml() {
        $session=Yii::app()->session;
        $aCatByType = $this->getCatShowFe();
        $aNewByRoot = MuradNews::getByCatRoot("");
        $str = "";
        foreach($this->getArrayType() as $type_id=>$type_key){
            $CatRootLabel = MyFormat::label($type_key);
            $str .= "<div class='col-md-6 col-sm-6 col-xs-12'>";
            $str .= "<h3>$CatRootLabel</h3>";
                $str .= "<ul class='menu_sitemap'>";
                    foreach($aCatByType[$type_id] as $mCat){
                        $url = MuradNews::getUrlDetailBySlug($mCat->news_slug);
                        $str .= "<li>";
                        $str .= "<a href='$url'>{$mCat->getNameTranslate()}</a>";
                        self::getEachNewsOnCat($aNewByRoot, $str, $mCat->id, $session);
                        $str .= "</li>";
                    }
                $str .= "</ul>";
            $str .= "</div>";
        }

//        $str .= "</div>";// ko hiểu sao có cái đóng div này Aug 26, 2016
        return $str;
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     * @Todo: get each news on cat
     */
    public static function getEachNewsOnCat($aNewByRoot, &$str, $category_id, $session) {
        // for each news on cat
        $str .= "<ul class='menu_news'>";
        if(isset($aNewByRoot[$category_id])):
            foreach($aNewByRoot[$category_id] as $mNews):
                $urlNews = $mNews->getUrlDetail();
                $ActiveMenuSub = "";
                if(isset($session['ACTIVE_NEWS']) && $session['ACTIVE_NEWS']->id == $mNews->id){
                    $ActiveMenuSub = "ActiveMenuSub";
                }
        
                $str .= "<li class='$ActiveMenuSub'>";
                    $str .= "<a href='$urlNews'>{$mNews->getName()}</a>";
                $str .= "</li>";
            endforeach;
        endif;
        $str .= "</ul>";
        // for each news on cat
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     * @todo: render menu left at FE
     */
    public function getFeMenuLeftHtml($type_id) {
        $session=Yii::app()->session;
        $aCatByType = $this->getCatShowFe();
        $aCatRoot = $this->getArrayType();
        $aNewByRoot = MuradNews::getByCatRoot($type_id);
        $str = "";
        $type_key = isset($aCatRoot[$type_id]) ? $aCatRoot[$type_id] : "";
        $CatRootLabel = MyFormat::label($type_key);
        $str .= "<div class='page-header'>$CatRootLabel</div>";
        $str .= "<ul class='menuchild'>";
        foreach($aCatByType[$type_id] as $mCat){
            $url = MuradNews::getUrlDetailBySlug($mCat->news_slug);// get url view detail news
            $ActiveMenuParent = "";
            if(isset($session['ACTIVE_NEWS']) && $session['ACTIVE_NEWS']->category_id == $mCat->id){
                $ActiveMenuParent = "ActiveMenuParent";
            }
            $str .= "<li class='$ActiveMenuParent'>";
                $str .= "<a href='$url'>{$mCat->getNameTranslate()}</a>";
                self::getEachNewsOnCat($aNewByRoot, $str, $mCat->id, $session);
            $str .= "</li>";
        }
        $str .= "</ul>";
        return $str;
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2016
     * @Todo: update slug of new to category
     */
    public static function updateSlugNews($category_id) {
        if(empty($category_id)){
            return ;
        }
        $mNews = MuradNews::getFirstNewsByCategory($category_id);
        if($mNews){
            $mCat = self::model()->findByPk($category_id);
            $mCat->news_slug = $mNews->slug;
            $mCat->update(array('news_slug'));
        }
    }
    
}