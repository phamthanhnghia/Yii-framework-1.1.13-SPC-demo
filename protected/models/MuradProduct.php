<?php

/**
 * This is the model class for table "{{_murad_product}}".
 *
 * The followings are the available columns in table '{{_murad_product}}':
 * @property integer $id
 * @property string $code_real
 * @property integer $category_id
 * @property string $name
 * @property integer $status
 * @property integer $type
 * @property string $price_retail
 * @property string $unit
 * @property string $unit_use
 * @property string $size
 * @property string $name_vi
 * @property string $slug
 * @property string $short_description
 * @property string $description
 */
class MuradProduct extends _BaseModel
{
    //    1: Sữa rửa mặt, 2: Điều trị, 3: Kem dưỡng, chống nắng
    const TYPE_SUA_RUA_MAT = 1;
    const TYPE_DIEU_TRI = 2;
    const TYPE_KEM_DUONG = 3;
    const TYPE_KEM_DUONG_CHONG_NANG = 4;
    const TYPE_TONER = 5;
    const TYPE_MAT_NA = 6;
    const TYPE_VIEN_UONG = 7;
    const TYPE_MAT_MOI = 8;
    const TYPE_BODY = 9;
    
    // Sua rua mat, Dieu Tri, Kem duong Ẩm/ Bảo Vệ, kem dưỡng ẩm/chống nắng/bảo vệ, Toner, mặt nạ, Viên uống 
    
    public $aModelDetail;
    public $mDetail;
    public $file_name;
    public $mInfo;
    public $pathUpload = 'upload/banner_product';
    
    public static $TYPE_STEP1 = array(MuradProduct::TYPE_SUA_RUA_MAT, MuradProduct::TYPE_TONER);
    public static $TYPE_STEP2 = array(MuradProduct::TYPE_DIEU_TRI, MuradProduct::TYPE_MAT_NA);
    public static $TYPE_STEP3 = array(MuradProduct::TYPE_KEM_DUONG, MuradProduct::TYPE_VIEN_UONG, MuradProduct::TYPE_KEM_DUONG_CHONG_NANG);
    
    public function getArrayType() {
        return array(
            MuradProduct::TYPE_SUA_RUA_MAT => "Sữa Rửa Mặt",
            MuradProduct::TYPE_TONER => "Toner",
            MuradProduct::TYPE_DIEU_TRI => "Serum Điều Trị",
            MuradProduct::TYPE_KEM_DUONG => "Kem Dưỡng Ẩm/ Bảo Vệ",
            MuradProduct::TYPE_MAT_MOI => "Mắt & Môi",
            MuradProduct::TYPE_MAT_NA => "Mặt Nạ",
            MuradProduct::TYPE_BODY => "Body",
            MuradProduct::TYPE_KEM_DUONG_CHONG_NANG => "Chống Nắng",
            MuradProduct::TYPE_VIEN_UONG => "Viên Uống",
        );
    }
    
    
    
    /**
     * @Author: ANH DUNG May 05, 2016
     * @Todo: yc chia lam 3 cot ở menu sản phẩm
     */
    public function getArrayTypeFe1() {
        return array(
            MuradProduct::TYPE_SUA_RUA_MAT => "Sữa Rửa Mặt",
            MuradProduct::TYPE_TONER => "Toner",
            MuradProduct::TYPE_DIEU_TRI => "Serum Điều Trị",
        );
    }
    public function getArrayTypeFe2() {
        return array(
            MuradProduct::TYPE_KEM_DUONG => "Kem Dưỡng Ẩm/ Bảo Vệ",
            MuradProduct::TYPE_MAT_MOI => "Mắt & Môi",
            MuradProduct::TYPE_MAT_NA => "Mặt Nạ",
        );
    }
    public function getArrayTypeFe3() {
        return array(
            MuradProduct::TYPE_BODY => "Body",
            MuradProduct::TYPE_KEM_DUONG_CHONG_NANG => "Chống Nắng",
            MuradProduct::TYPE_VIEN_UONG => "Viên Uống",
        );
    }
    
    
    public function getArrayTypeSlug() {
        return array(
            MuradProduct::TYPE_SUA_RUA_MAT => "sua-rua-mat",
            MuradProduct::TYPE_TONER => "toner",
            MuradProduct::TYPE_DIEU_TRI => "serum-dieu-tri",
            MuradProduct::TYPE_KEM_DUONG => "kem-duong-am-bao-ve",
            MuradProduct::TYPE_MAT_MOI => "mat-moi",
            MuradProduct::TYPE_MAT_NA => "mat-na",
            MuradProduct::TYPE_BODY => "body",
            MuradProduct::TYPE_KEM_DUONG_CHONG_NANG => "chong-nang",
            MuradProduct::TYPE_VIEN_UONG => "vien-uong",
        );
    }
    
    /**
     * @Author: ANH DUNG Mar 24, 2016
     * @Todo: get id type by slug of type
     */
    public function getIdTypeBySlugType($slug) {
        return array_search($slug, $this->getArrayTypeSlug());
    }
    
    public function getType() {
        $aType = $this->getArrayType();
        $aRes = array();
        foreach($this->rType as $mOneMany){
            $aRes[] = $aType[$mOneMany->many_id];
        }
        if(count($aRes)){
            return implode("<br> ", $aRes);
        }
        return "";
    }
    
    public function getTypeText() {
        $aType = $this->getArrayType();
        return isset($aType[$this->type]) ? $aType[$this->type]: "";
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradProduct the static model class
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
        return '{{_murad_product}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required', 'on'=>"create, update"),
            array('name', 'length', 'max'=>350),
            array('file_name, name_vi_show, featured, display_order, category_id_2, price_discount, id, code_real, category_id, name, status, type, price_retail, unit, unit_use, size, name_vi, slug', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rDetail' => array(self::HAS_MANY, 'MuradProductImage', 'product_id',
                'order'=>'rDetail.order_number ASC',
            ),
            'rCategory' => array(self::BELONGS_TO, 'MuradCategory', 'category_id'),
            'rProductInfo' => array(self::HAS_ONE, 'MuradProductInfo', 'product_id'),
            'rType' => array(self::HAS_MANY, 'GasOneManyBig', 'one_id',
                'on'=>'rType.type='.  GasOneManyBig::TYPE_PRODUCT_TYPE,
//                'order'=>'rDetail.order_number ASC',
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'code_real' => 'Code Real',
            'category_id' => 'Category',
            'name' => 'Name',
            'status' => 'Status',
            'type' => 'Type',
            'price_retail' => 'Price Retail',
            'unit' => 'Unit',
            'unit_use' => 'Unit Use',
            'size' => 'Size',
            'name_vi' => 'TV khong dau',
            'name_vi_show' => 'Tên Tiếng Việt',
            'slug' => 'Slug',
            'category_id_2' => 'Category 2',// Mar 14, 2016
            'display_order' => 'Thứ tự hiển thị',// Mar 14, 2016
            'featured' => 'Sản phẩm nổi bật',// Mar 14, 2016
            'file_name' => 'Banner',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.code_real',$this->code_real,true);
        $criteria->compare('t.category_id',$this->category_id);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.featured',$this->featured);
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
//                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                'pageSize'=> 50,
            ),
        ));
    }
    
    protected function beforeValidate() {
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
     */
    public function getDropdownCategory($needMore=array()) {
        $aModelCat = MuradCategory::getByCatType(MuradCategory::CAT_PRODUCT);
        if(isset($needMore['GetModel'])){
            return $aModelCat;
        }
        return CHtml::listData($aModelCat, "id", "name");
    }
    
    
    public function getCodeReal() {
        return $this->code_real;
    }

    public function getPriceRetail($format=false) {
        if($format){
            return ActiveRecord::formatCurrency($this->price_retail);
        }
        return $this->price_retail;
    }
    
    public function getPriceDiscount($format=false) {
        if($format){
            return ActiveRecord::formatCurrency($this->price_discount);
        }
        return $this->price_discount;
    }
    
    public function getNameViShow() {
        return $this->name_vi_show;
    }
    
    public function getSizeFe() {
        return $this->size." $this->unit_use / $this->unit";
    }
    
    public function getUnit() {
        return $this->unit;
    }
    
    public function getUnitUse() {
        return $this->unit_use;
    }
    public function getSize() {
        return $this->size;
    }
    public function getFeatured() {
        return $this->getYesNoText('featured');
    }
    
    public function getShortDescription() {
        $mProductInfo = $this->rProductInfo;
        if($mProductInfo){
            return $mProductInfo->getShortDescription();
        }
        return "";
    }
    public function getDescription() {
        $mProductInfo = $this->rProductInfo;
        if($mProductInfo){
            return $mProductInfo->getDescription();
        }
        return "";
    }
    
    public function getInfo() {
        $mProductInfo = $this->rProductInfo;
        if($mProductInfo){
            return $mProductInfo->getInfo();
        }
        return "";
    }
    
    public function getHowToUse() {
        $mProductInfo = $this->rProductInfo;
        if($mProductInfo){
            return $mProductInfo->getHowToUse();
        }
        return "";
    }
    
    public function getComponent() {
        $mProductInfo = $this->rProductInfo;
        if($mProductInfo){
            return $mProductInfo->getComponent();
        }
        return "";
    }
    
    public function getIframeVideo() {
        $mProductInfo = $this->rProductInfo;
        if($mProductInfo){
            return $mProductInfo->getIframeVideo();
        }
        return "";
    }
    
    public function getCategory($field_name = "name") {
        $mCategory = $this->rCategory;
        if($mCategory){
            return $mCategory->$field_name;
        }
        return "";
    }
    
    public function getName($getLink = false, $needMore = array()) {
        if($getLink){
            return "<a href='{$this->getUrlProductDetail()}'>$this->name</a>";
        }
        if(isset($needMore['strip_tags'])){
            return strip_tags($this->name);
        }
        return $this->name;
    }
    
    protected function beforeSave() {
        $this->category_type = $this->getCategory('type');
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get list product by category
     */
    public static function getByCaterory($category_id, $type) {
        $criteria = new CDbCriteria();
        if(is_array($category_id)){
            $criteria->addInCondition("t.category_id", $category_id);
        }else{
//            $criteria->compare("t.category_id", $category_id);
            $criteria->addCondition("t.category_id=$category_id OR t.category_id_2=$category_id");
        }
        $criteria->compare("t.status", STATUS_ACTIVE);
//        $aProductIdByType = GasOneManyBig::getArrOfOneId($type, GasOneManyBig::TYPE_PRODUCT_TYPE);
//        $criteria->addInCondition("t.id", $aProductIdByType);
        MuradProduct::getCriteriaType($criteria, $type);
        $criteria->order = "t.name";
        
        return new CActiveDataProvider('MuradProduct', array(
            'criteria'=>$criteria,
            'pagination'=>array(
//                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                'pageSize'=> 6,
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Mar 24, 2016
     * @param: $type: is one or array
     */
    public static function getCriteriaType(&$criteria, $type) {
        $aProductIdByType = GasOneManyBig::getArrOfOneId($type, GasOneManyBig::TYPE_PRODUCT_TYPE);
        $criteria->addInCondition("t.id", $aProductIdByType);
    }
    
    /**
     * @Author: ANH DUNG Mar 07, 2016
     * @Todo: get list product by category type
     */
    public static function getByCateroryType($category_type) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.category_type", $category_type);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->order = "t.name";
        return MuradProduct::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get image of product
     */
    public function getUrlImageDefault($size = 'size1', $needMore = array()) {
        $mImage = $this->rDetail;
        if(isset($mImage[0])){
            return ImageProcessing::bindImageByModel($mImage[0], $size);
        }
        return "";
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: 
     */
    public function getUrlProductDetail($needMore = array()) {
        return Yii::app()->createAbsoluteUrl("product/detail", array('slug'=> $this->slug));
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: FE get html product Detail
     */
    public function getHtmlProductDetail($needMore = array()) {
        $html = "";
        $html .= "<a href='{$this->getUrlProductDetail()}'>";
            $html .= "<img src='{$this->getUrlImageDefault()}' alt=''/>";
        $html .= "</a>";
        return $html;
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: FE get html price product Detail
     */
    public function getHtmlProductPrice($needMore=array()) {
        $price_retail = $this->getPriceRetail();
        $price_discount = $this->getPriceDiscount();
        $html = "";
        if($price_discount>0){
            $html .= "<span class='price1 p-discount'>{$this->getPriceRetail(true)}đ</span><span class='price-ds'>{$this->getPriceDiscount(true)}</span>";
        }else{
            $html .= "<span class='price1'>{$this->getPriceRetail(true)}đ</span>";
        }
        if(isset($needMore['get_div_price'])){
            $html = "<div class='price'>$html</div>";
        }
        return $html;
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get relate product at product detail
     */
    public function getRelateProduct() {
        $criteria = new CDbCriteria();
        $criteria->compare("t.category_id", $this->category_id);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $aType = $this->getMultiType();
        if(in_array(MuradProduct::TYPE_VIEN_UONG, $aType)){
            MuradProduct::getCriteriaType($criteria, $aType);
        }
        $criteria->order = "t.id DESC";
        $criteria->limit = 10;
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Mar 14, 2016
     * @Todo: get feature product at home page
     */
    public static function getFeaturedProduct() {
        $criteria = new CDbCriteria();
        $criteria->limit = 10;
        self::getFeaturedCrit($criteria);
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Mar 19, 2016
     * @Todo: get same criteria of featured product
     */
    public static function getFeaturedCrit(&$criteria) {
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->compare("t.featured", STATUS_ACTIVE);
        $criteria->order = "t.id DESC";
    }
    
    /**
     * @Author: ANH DUNG Mar 14, 2016
     * @Todo: get CActiveDataProvider feature product at home page
     */
    public static function getFeaturedProductGrid() {
        $criteria = new CDbCriteria();
        self::getFeaturedCrit($criteria);
        return new CActiveDataProvider('MuradProduct', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 18,
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Mar 01, 2016
     */
    public function SaveModelInfo() {
        $this->mInfo->product_id = $this->id;
        if($this->mInfo->isNewRecord){
            $this->mInfo->save();
        }else{
            $this->mInfo->update();
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 07, 2016
     * @Todo: save multi type of product
     */
    public function saveMultiType() {
        GasOneManyBig::saveArrOfManyId($this->id, GasOneManyBig::TYPE_PRODUCT_TYPE, 'MuradProduct', 'type');
    }
    
    /**
     * @Author: ANH DUNG Mar 07, 2016
     * @Todo: get multi type format for multiselect
     */
    public function getMultiType() {
        return CHtml::listData($this->rType, 'many_id', 'many_id');
    }
    
    /**
     * @Author: ANH DUNG Mar 14, 2016
     */
    public static function getFeaturedUrl() {
        return Yii::app()->createAbsoluteUrl("product/featured");
    }
    
    /**
     * @Author: ANH DUNG Jan 13, 2016
     * @Todo: import from excel
     */
    public static function ImportExcelProduct($model, &$data){
        /* 1. get all Product with format array(code=>model)
         * 2. compare product to insert
         */
        set_time_limit(7200);
    try {
        $FileName = $_FILES['MuradProduct']['tmp_name']['file_name'];
        if(empty($FileName)) return;
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $inputFileType = PHPExcel_IOFactory::identify($FileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        $objPHPExcel = @$objReader->load(@$_FILES['MuradProduct']['tmp_name']['file_name']);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow(); // e.g. 10

        $success = 1;
        $aRowInsert=array();
        $aErrors=array();
        $dbCount = 0;
        
        for ($row = 2; $row <= $highestRow; ++$row)
        {
                
            // file excel cần format column theo dạng text hết để người dùng nhập vào khi đọc không lỗi
            $code_real = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()));
            $name = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()));
            $category_id = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()));
            $type = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(3, $row)->getValue()));
            $unit = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()));
            $unit_use = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(5, $row)->getValue()));
            $size = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(6, $row)->getValue()));
            $price_retail = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()));
            $file_image = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(8, $row)->getValue()));
            $short_description = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(9, $row)->getValue()));
            $description = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(10, $row)->getValue()));
            $info = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(11, $row)->getValue()));
            $component = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(12, $row)->getValue()));
            $how_to_use = trim(MyFormat::escapeValues($objWorksheet->getCellByColumnAndRow(13, $row)->getValue()));
            /*
             * 1. xử lý name bỏ dấu - và upper chữ đầu 
             * 2. xử lý type one many  sau khi insert
             * 3. xử lý $short_description, $description, $info, $component, $how_to_use
             * 4. xử lý import image
             */
            // 1. xử lý name bỏ dấu - và upper chữ đầu 
            $temp = array_map('ucfirst',explode("-", $name));
            $name = implode(" ", $temp);
            $aCat = explode(",", $category_id);
            $model = new MuradProduct();
            $model->code_real = $code_real;
            $model->category_id = $aCat[0];
            $model->category_id_2 = isset($aCat[1]) ? $aCat[1] : 0;
            $model->name = $name;
            $model->status = 1;
            $model->price_retail = $price_retail;
            $model->unit = $unit;
            $model->unit_use = $unit_use;
            $model->size = $size;
            $model->save();
            
            // 2. xử lý type one many  sau khi insert
//            GasOneManyBig::saveArrOfManyId($this->id, GasOneManyBig::TYPE_PRODUCT_TYPE, 'MuradProduct', 'type');
            $mOneMany = new GasOneManyBig();
            $mOneMany->one_id = $model->id;
            $mOneMany->many_id = $type;
            $mOneMany->type = GasOneManyBig::TYPE_PRODUCT_TYPE;
            $mOneMany->save();
            
            // 3. xử lý $short_description, $description, $info, $component, $how_to_use
            $mProductInfo = new MuradProductInfo();
            $mProductInfo->product_id = $model->id;
            $mProductInfo->short_description = $short_description;
            $mProductInfo->description = $description;
            $mProductInfo->info = $info;
            $mProductInfo->how_to_use = $how_to_use;
            $mProductInfo->component = $component;
            $mProductInfo->save();
            
            // 4. xử lý import image
            self::CopyProductImageFromFtpUpload($model, $file_image, $aErrors);
        }
        
        echo '<pre>';
        print_r($aErrors);
        echo '</pre>';
        die("$row done");
        }catch (Exception $e)
        {
            Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
            $code = 404;
            if(isset($e->statusCode))
                $code=$e->statusCode;
            if($e->getCode())
                $code=$e->getCode();
            throw new CHttpException($code, $e->getMessage());
        }
    }
    
    public static $DirUploadFtpProduct = "themes/image_product";
    
    /**
     * @Author: ANH DUNG Oct 07, 2014
     * @Todo: copy technical image product admin upload ftp before
     * @param: $arr_product_id array(product_id => product_id)
     */
    public static function CopyProductImageFromFtpUpload($mProduct, $file_image, &$aErrors) {
        $mFile = new MuradProductImage();
        $mProduct = MuradProduct::model()->findByPk($mProduct->id);
        $year = date("Y");
        $month = date("m");
        $pathUpload = $mFile->pathUpload."/$year/$month";
        $imageHelper = new ImageHelper();
        $filename = Yii::getPathOfAlias('webroot') . '/'. $pathUpload . "/".$file_image;
        $fileFtp = Yii::getPathOfAlias('webroot') . '/'.self::$DirUploadFtpProduct."/$file_image";
//            if(!is_file($filename) && is_file($fileFtp)){
        if(is_file($fileFtp)){
            // 1. create dir with product id
            $imageHelper->createDirectoryByPath($pathUpload);
            // 2. copy file from ftp then save to right folder
//            $url = Yii::app()->createAbsoluteUrl('/')."/".self::$DirUploadFtpProduct."/$file_image";
//            $path = "/".Product::$staticSize."/$item->id";
//                MyFormat::DownloadFileUsingCurl($url, $path, $file_image );
            $path_from = Yii::getPathOfAlias('webroot') . '/'.self::$DirUploadFtpProduct."/$file_image";
            $path_to = Yii::getPathOfAlias('webroot') . '/'. $pathUpload . "/".$file_image;
            MyFormat::CopyFile($path_from, $path_to);


            $tmp = explode(" ", $mProduct->created_date);
            $created_date = $tmp[0];
            
            $mFile->file_name = $file_image;
            $mFile->product_id = $mProduct->id;
            $mFile->created_date = $created_date;
            $mFile->order_number = 1;
            $mFile->save();
            $mFile->resizeImage('file_name');
        }else{
            $aErrors[] = $file_image;
        }
    }
 
    /**
     * @Author: ANH DUNG Mar 24, 2016
     * @Todo: get CActiveDataProvider product by type at home page
     */
    public function getProductByType() {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        if(!empty($this->category_id )){
            $criteria->addCondition("t.category_id=$this->category_id OR t.category_id_2=$this->category_id");
        }
        MuradProduct::getCriteriaType($criteria, $this->type);
        $criteria->order = "t.display_order ASC, t.name ASC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 9,
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Mar 24, 2016
     * @Todo: get url product type
     * @Param: int $typeId 
     */
    public function getUrlType($typeId) {
        $aTypeSlug = $this->getArrayTypeSlug();
        $slug = isset($aTypeSlug[$typeId]) ? $aTypeSlug[$typeId] : "";
        return Yii::app()->createAbsoluteUrl("product/type", array('slug'=>$slug));
    }
    
        
    /**
     * @Author: ANH DUNG Mar 14, 2016
     * @Todo: get CActiveDataProvider feature product at home page
     */
    public function getListFe($needMore=array()) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        if(isset($needMore['ArrCategory'])){
            $criteria->addInCondition('t.category_id', $needMore['ArrCategory']);
        }
        $criteria->order = "t.category_id ASC, t.name ASC";
        $aRes = array();
        $models = MuradProduct::model()->findAll($criteria);
        foreach($models as $model) {
            $aRes[$model->category_id][] = $model;
        }
        return $aRes;
    }
    
    /**
     * @Author: ANH DUNG Apr 20, 2016
     * @Todo: home random product
     */
    public static function getRandomProduct() {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->order = 'RAND()';
        return self::model()->find($criteria);
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
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $this->$fieldName);
    }
    
}