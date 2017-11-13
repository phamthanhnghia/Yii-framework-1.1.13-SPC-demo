<?php
class _BaseModelMulti extends _MultilanguagesModel
{
    public $optionYesNo = array('1' => 'Yes', '0' => 'No');
    public $optionActive = array('1' => 'Shown', '0' => 'Hidden');
    public $optionGender = array('1' => 'Male', '0' => 'Female', '2' => 'Unspecified');
    public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
    public $defineImageSize = array();
    public $allowImageType = 'jpg,png,jpeg';
    public $maxImageFileSize = 10145728; // 10MB
    public $fieldDateTime = "created_date"; // date or time to create dir save file of image
    public $countQtyFile = 1; // count qty of file of image
    public $old_file_name; // to save old file name of model when update
    public $RemoveOldFile = false;
    public $pathUploadMuti = '';

    public function tablePrefix()
    {
        return $tablePrefix = Yii::app()->db->tablePrefix;
    }

    public function getStatusText() {
        return isset($this->optionActive[$this->status]) ? $this->optionActive[$this->status]:"";
    }
    
    public function getYesNoText($field_name) {
        return isset($this->optionYesNo[$this->$field_name]) ? $this->optionYesNo[$this->$field_name]:"";
    }

    public function getName() {
        if($this->rTranslateOne){
            return $this->rTranslateOne->getName();
        }
        return "";
    }
    public function getContent() {
        if($this->rTranslateOne){
            return $this->rTranslateOne->getContent();
        }
        return "";
    }
    public function getShortContent() {
        if($this->rTranslateOne){
            return $this->rTranslateOne->getShortContent();
        }
        return "";
    }
    public function getNameForSlug() {
        return $this->name_for_slug;
    }
    
    public function getSlug() {
        return $this->slug;
    }
    
    public function getCreatedDate() {
        return MyFormat::dateConverYmdToDmy($this->created_date, "d/m/Y H:i");
    }
    /**
     * return array fieldName=>value. Usefull for send email. special param need to overrite or add to this array.
     * $param = array(
    '{FULL_NAME}'   => $mUser->full_name,
    '{EMAIL}'       => $mUser->email,
    '{PHONE}'       => $mUser->phone
    );
     */
    public function getParamArray()
    {
        $param = array();
        foreach ($this->attributes as $fieldName=>$value)
        {
            $param['{'.strtoupper($fieldName).'}'] = $value;
        }
        return $param;
    }
     
    /** fix from Feb 17, 2016
     * @Author: ANH DUNG Mar 06, 2015
     * @Todo: validate multi file 
     * @Param: $mBelongTo is may be model GasBreakTaskDaily OR ANY MODEL OTHER
     * chỗ này cứ truyền vào model bình thường
     * * @Important làm theo kiểu này thì sẽ không cho update record, mà sẽ là luôn xóa đi và tạo lại
     * hoặc là cái created date của record belongto kia sẽ không update cái created date
     */
    public function ValidateFile($name_field, $needMore = array()) {
        $ClassName = get_class($this);
        $ok=false; // for check if no file submit
        if(isset($_POST[$ClassName][$name_field])  && count($_POST[$ClassName][$name_field])){
            foreach($_POST[$ClassName][$name_field] as $key=>$item){
//                $mFile = new MuradBanner('UploadFile');
                $mFile = call_user_func(array($ClassName, 'model'));
                $mFile->scenario = "UploadFile";
                $mFile->$name_field  = CUploadedFile::getInstance($this,"{$name_field}[".$key.']');
                $mFile->validate();
                if(!is_null($mFile->$name_field) && !$mFile->hasErrors() ){
                    $ok=true;
                    MyFormat::IsImageFile($_FILES[$ClassName]['tmp_name'][$name_field][$key]);
                    $FileName = MyFunctionCustom::remove_vietnamese_accents($mFile->$name_field->getName());
                    if(strlen($FileName) > MyFormat::MAX_LENGTH_IMAGE ){
                        $mFile->addError($name_field, "Tên file không được quá 100 ký tự, vui lòng đặt tên ngắn hơn");
                    }
                    $this->RemoveOldFile = true;
                }
                if($mFile->hasErrors()){
                    $this->addError($name_field, $mFile->getError($name_field));
                }
            }
        }
        if(!$ok && isset($needMore['required'])){
            $this->addError($name_field, "Chưa chọn file");
        }
        $this->$name_field="";
    }
    
     /**
     * @Author: ANH DUNG Mar 06, 2015
     * @Todo: save record multi file for one detail
     * @Param: $mGasIssueTickets GasIssueTickets
     * * chỗ này cứ truyền vào model bình thường
     * phần xử lý này $mRoot = GasIssueTickets::model()->findByPk($mGasIssueTickets->id); // để lấy created_date, không thể find rồi đưa vào biến $model dc vì còn liên quan đến get file
     * sẽ xử lý trc khi gọi hàm này
     * @Important làm theo kiểu này thì sẽ không cho update record, mà sẽ là luôn xóa đi và tạo lại
     * hoặc là cá created date của record belongto kia sẽ không update cái created date
     * @chu-y: cái explode(' ', $mBelongTo->created_date);
     */
    public function SaveRecordOneFile($name_field, $needMore = array()) {
        $ClassName = get_class($this);
        $mBelongTo = MyFormat::loadModelByClass($this->id, $ClassName);
        set_time_limit(7200);
        $has_upload_file = false;
        if(isset($_POST[$ClassName][$name_field])  && count($_POST[$ClassName][$name_field])){
            foreach($_POST[$ClassName][$name_field] as $key=>$item){
//                $mFile = call_user_func(array($ClassName, 'model'));
                $mBelongTo->$name_field  = CUploadedFile::getInstance($this,"{$name_field}[".$key.']');
                if(!is_null($mBelongTo->$name_field)){
                    $has_upload_file = true;
                    $this->RemoveFileOnly($name_field);
                    $mBelongTo->$name_field  = $mBelongTo->saveFile($name_field, $key);
                    $mBelongTo->update(array($name_field));
                    if(isset($needMore['resize'])){// chua xử lý cái này
                        $mBelongTo->resizeImage($name_field);
                    }
                }
            }
        }
        
        if(!$has_upload_file){
            $mBelongTo->$name_field  = $this->old_file_name;
            $mBelongTo->update(array($name_field));
        }
        
    }    
   
    /** fix from Feb 17, 2016
     * @Author: ANH DUNG Mar 06, 2015
     * To do: save file 
     * @param: $model model GasFile
     * @param: $count 1,2,3
     * @return: name of image 
     */
    public function saveFile($fieldName, $count)
    {
        if(is_null($this->$fieldName)) return '';
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ext = strtolower($this->$fieldName->getExtensionName());
        $FileNameClient = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->$fieldName->getName()));
        $FileNameClient = str_replace($ext, "", $FileNameClient);
        $fileName = time()."-$count-".MyFunctionCustom::slugify($FileNameClient).'.'.$ext;
        
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $this->$fieldName->saveAs($pathUpload.'/'.$fileName);
        return $fileName;
    }
    
    /** Fix
     * @Author: ANH DUNG Feb 18, 2016
     * @Todo: sửa lại hàm trên
     * @Param: $this->mDetail ở đây là multi model detail của image
     * @param: $this là model root
     * VD: nếu $this là Product thì $this->mDetail là Multi ProductImage
     */
    public function ValidateMultiFile($needMore = array()) {
        $ClassName = get_class($this->mDetail);
        $ok=false; // for check if no file submit
        if(isset($_POST[$ClassName]['file_name'])  && count($_POST[$ClassName]['file_name'])){
            foreach($_POST[$ClassName]['file_name'] as $key=>$item){
                $mFile = call_user_func(array($ClassName, 'model'));
                $mFile->scenario = "UploadFile";
                $mFile->file_name  = CUploadedFile::getInstance($this->mDetail,'file_name['.$key.']');
                $mFile->validate();
                if(!is_null($mFile->file_name) && !$mFile->hasErrors() ){
                    $ok=true;
                    MyFormat::IsImageFile($_FILES[$ClassName]['tmp_name']['file_name'][$key]);
                    $FileName = MyFunctionCustom::remove_vietnamese_accents($mFile->file_name->getName());
                    if(strlen($FileName) > MyFormat::MAX_LENGTH_IMAGE ){
                        $mFile->addError('file_name', "Tên file không được quá 100 ký tự, vui lòng đặt tên ngắn hơn");
                    }
                }
                if($mFile->hasErrors()){
                    $this->addError('file_name', $mFile->getError('file_name'));
                }
            }
        }
        if(!$ok && isset($needMore['required'])){
            $this->addError('file_name', "Chưa chọn file");
        }
    }

    /** Fix
     * @Author: ANH DUNG Feb 18, 2016
     * @Todo: sửa lại hàm trên
     * @Param: $this->mDetail ở đây là multi model detail của image
     * @param: $this là model root
     * VD: nếu $this là Product thì $this->mDetail là Multi ProductImage
     */
    public function SaveRecordMultiFile($needMore = array()) {
        $ClassName = get_class($this->mDetail);
        $ClassNameBelongTo = get_class($this);
        $mBelongTo = MyFormat::loadModelByClass($this->id, $ClassNameBelongTo);
        set_time_limit(7200);
        $tmp = explode(" ", $mBelongTo->created_date);
        $created_date = $tmp[0];
        if(isset($_POST[$ClassName]['file_name'])  && count($_POST[$ClassName]['file_name'])){
            foreach($_POST[$ClassName]['file_name'] as $key=>$item){
//                $mFile = call_user_func(array($ClassName, 'model'));
                $mFile = new $ClassName();
                $mFile->file_name  = CUploadedFile::getInstance($this->mDetail,'file_name['.$key.']');
                $mFile->product_id = $this->id;
                $mFile->created_date = $created_date;
                $mFile->order_number = isset($_POST[$ClassName]['order_number'][$key]) ? $_POST[$ClassName]['order_number'][$key] : 1;
                if(!is_null($mFile->file_name)){
                    $mFile->file_name = $mFile->saveFile('file_name', $key);
                    $mFile->save();
                    if(!isset($needMore['not_resize'])){
                        $mFile->resizeImage('file_name');
                    }
                }
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 18, 2016
     * To do: resize file scan
     * @param: $fieldName 
     */
    public function resizeImage($fieldName) {
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->file = $this->$fieldName;
//        $ImageHelper->aRGB = array(0, 0, 0);//full black background
        $ImageHelper->thumbs = $this->aSize;
        $ImageHelper->createFullImage = false;
        $ImageHelper->createThumbs();
//        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $this->$fieldName);
    }   
    
    /**
     * @Author: ANH DUNG Feb 18, 2016
     * @Todo: check cho phép xóa record hệ thống
     */
    public function canDeleteData(){
        if(Yii::app()->params['enable_delete'] == 'no'){
            return false;
        }
        return true;// Feb 18, 2016 thấy ko cần check điều kiện ở dưới nữa
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, Yii::app()->params['delete_global_days'], '-');
        return MyFormat::compareTwoDate($this->created_date, $dayAllow);
    }
    
        
    /**
     * @Author: ANH DUNG Feb 18, 2016
     * @Todo: render html of image thumb in backend
     */
    public function getImageThumbTemp() {
        $imageUrl = ImageProcessing::bindImageByModel($this);
        return "<a class='gallery' href='$imageUrl'>"
                . "<img class='image_thumb_temp' src='$imageUrl'>"
                . "</a>";
    }
    
    /**
     * @Author: ANH DUNG Mar 29, 2016
     * @return: upload/news/editor/2016/03
     */
    public function getPathUpload() {
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        return $pathUpload = "{$this->pathUploadMuti}/$year/$month/$this->id";
    }
    
    /**
     * @Author: ANH DUNG Mar 29, 2016
     * @Todo: handle validate multi file
     */
    public function CheckMultiFile() {
        $ClassName = get_class($this);
        $photos = CUploadedFile::getInstancesByName("{$ClassName}[uploadMulti]");
        // proceed if the images have been set
        if (isset($photos) && count($photos) > 0) {
            // go through each uploaded image
            foreach ($photos as $key => $pic) {
                MyFormat::IsImageFile($pic->getTempName());
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 29, 2016
     * @Todo: handle validate multi file
     */
    public function SaveMultiFile() {
        $ClassName = get_class($this);
        $photos = CUploadedFile::getInstancesByName("{$ClassName}[uploadMulti]");
        $pathUpload = $this->getPathUpload();
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $aFiles = $this->getArrayFile($pathUpload);
        $plus = 0;
        if(count($aFiles) > 2){
            $plus = count($aFiles)-2;
        }
        
        // proceed if the images have been set
        if (isset($photos) && count($photos) > 0) {
            // go through each uploaded image
            foreach ($photos as $key => $pic) {
                $ext = strtolower($pic->getExtensionName());
//                $FileNameClient = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->$fieldName->getName()));
//                $FileNameClient = str_replace($ext, "", $FileNameClient);
                $fileName = date("Ymd")."-$this->id-".($key+$plus).'.'.$ext;
                $pic->saveAs($pathUpload.'/'.$fileName);
            }
        }
    }
    
    
    
}
?>
