<?php

/**
 * This is the model class for table "{{_gas_file}}".
 *
 * The followings are the available columns in table '{{_gas_file}}':
 * @property string $id
 * @property integer $type
 * @property string $belong_id
 * @property string $file_name
 * @property integer $order_number
 * @property string $created_date
 */
class GasFile extends CActiveRecord
{
    const TYPE_1_BREAK_TASK = 1;
    const TYPE_2_SUPPORT_CUSTOMER = 2;
    const TYPE_3_UPHOLD_REPLY = 3;
    const TYPE_4_SUPPORT_CUSTOMER_COMPLETE = 4;
    const TYPE_5_UPDATE_SOON = 5;
    
    // array type => name model
    public static $TYPE_MODEL = array(
        GasFile::TYPE_1_BREAK_TASK => "GasBreakTaskDaily",
        GasFile::TYPE_2_SUPPORT_CUSTOMER => "GasSupportCustomer",
        GasFile::TYPE_3_UPHOLD_REPLY => "GasUpholdReply",
        GasFile::TYPE_4_SUPPORT_CUSTOMER_COMPLETE => "GasSupportCustomer",
    );
    
    public static $TYPE_RESIZE_IMAGE = array(
        GasFile::TYPE_1_BREAK_TASK,
        GasFile::TYPE_3_UPHOLD_REPLY, 
        GasFile::TYPE_4_SUPPORT_CUSTOMER_COMPLETE, 
    );
    
    public static $AllowFile = 'jpg,jpeg,png';
    public static $pathUpload = 'upload/all_file';
    public static $aSize = array(
        'size1' => array('width' => 128, 'height' => 96), // small size, dùng ở form update văn bản
//        'size2' => array('width' => 1536, 'height' => 1200), // Close on Dec 10, 2015 resize ra hình to quá, không cần thiết
        'size2' => array('width' => 1024, 'height' => 900), // size view, dùng ở xem văn bản
    );
    /** @note: về size ảnh. với tấm 3mb thì 'width' => 1536 cho ra resize là 1.3 mb
     *  còn với 'width' => 1024, thì cho ra size 627 kb => cũng vẫn còn lớn
     * 
     */
    
    const IMAGE_MAX_UPLOAD = 10;
    const IMAGE_MAX_UPLOAD_SHOW = 1;
    const IMAGE_MAX_UPLOAD_APP = 3; // Oct 22, 2015 limit for app upload
    
    /** Mar 06, 2015
     * dùng để quản lý file của các table mà có lượng file ít và sẽ không cut data
     * dựa theo type
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
            return '{{_gas_file}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, type, belong_id, file_name, order_number, created_date', 'safe'),
            array('file_name', 'file','on'=>'UploadFile',
                    'allowEmpty'=>true,
                    'types'=> GasFile::$AllowFile,
                    'wrongType'=> "Chỉ cho phép định dạng file ".  GasFile::$AllowFile." .",
                    'maxSize'   => ActiveRecord::getMaxFileSize(),
                    'minSize'   => ActiveRecord::getMinFileSize(),
                    'tooLarge'  =>'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
                    'tooSmall'  =>'The file was smaller than '.(ActiveRecord::getMinFileSize()/1024).' KB. Please upload a bigger file.',                    
            ),
            
            array('file_name', 'file', 'on'=>'UploadFilePdf',
                'allowEmpty'=>true,
                'types'=> GasSupportCustomer::$AllowFilePdf,
                'wrongType'=>"Chỉ cho phép tải file ".GasSupportCustomer::$AllowFilePdf,
                'maxSize' => ActiveRecord::getMaxFileSize(), // 5MB
                'tooLarge' => 'File quá lớn, cho phép '.(ActiveRecord::getMaxFileSize()/1024).' KB. Vui lòng up file nhỏ hơn.',
            ),
            
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'belong_id' => 'Belong',
            'file_name' => 'File Name',
            'order_number' => 'Order Number',
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
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.belong_id',$this->belong_id,true);
        $criteria->compare('t.file_name',$this->file_name,true);
        $criteria->compare('t.order_number',$this->order_number);
        $criteria->compare('t.created_date',$this->created_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public function defaultScope()
    {
        return array();
    }
    
    /*** MAR 06,2015  HANDLE VALIDATE AND SAVE MULTI FILE ********/
    
    /**
     * @Author: ANH DUNG Mar 06, 2015
     * @Todo: validate multi file 
     * @Param: $mBelongTo is may be model GasBreakTaskDaily OR ANY MODEL OTHER
     * chỗ này cứ truyền vào model bình thường
     * * @Important làm theo kiểu này thì sẽ không cho update record, mà sẽ là luôn xóa đi và tạo lại
     * hoặc là cái created date của record belongto kia sẽ không update cái created date
     */
    public static function ValidateFile($mBelongTo, $needMore = array() ) {
        $ClassName = get_class($mBelongTo);
        $ok=false; // for check if no file submit
        if(isset($_POST[$ClassName]['file_name'])  && count($_POST[$ClassName]['file_name'])){
            foreach($_POST[$ClassName]['file_name'] as $key=>$item){                
                $mFile = new GasFile('UploadFile');
                $mFile->file_name  = CUploadedFile::getInstance($mBelongTo,'file_name['.$key.']');
                $mFile->validate();
                if(!is_null($mFile->file_name) && !$mFile->hasErrors() ){
                    $ok=true;
                    MyFormat::IsImageFile($_FILES[$ClassName]['tmp_name']['file_name'][$key]);
                    $FileName = MyFunctionCustom::remove_vietnamese_accents($mFile->file_name->getName());
                    if(strlen($FileName) > 100 ){
                        $mFile->addError('file_name', "Tên file không được quá 100 ký tự, vui lòng đặt tên ngắn hơn");
                    }
                }
                if($mFile->hasErrors()){
                    $mBelongTo->addError('file_name', $mFile->getError('file_name'));
                }
            }
        }
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
    public static function SaveRecordFile($mBelongTo, $type) {
        $ClassName = get_class($mBelongTo);
        $mBelongTo = MyFormat::loadModelByClass($mBelongTo->id, $ClassName);
        set_time_limit(7200);
        if(isset($_POST[$ClassName]['file_name'])  && count($_POST[$ClassName]['file_name'])){
            foreach($_POST[$ClassName]['file_name'] as $key=>$item){
                $mFile = new GasFile();
                $mFile->type =  $type;
                $mFile->belong_id = $mBelongTo->id;
                $created_date = explode(' ', $mBelongTo->created_date);
                $mFile->created_date = $created_date[0];
                $mFile->order_number = $key+1;
                $mFile->file_name  = CUploadedFile::getInstance($mBelongTo,'file_name['.$key.']');
                if(!is_null($mFile->file_name)){
                    $mFile->file_name  = self::saveFile($mFile, 'file_name', $key);
                    $mFile->save();
                    if(in_array($type, self::$TYPE_RESIZE_IMAGE)){
                        self::resizeImage($mFile, 'file_name');
                    }
                }
            }
        }        
    }
    
    /**
     * @Author: ANH DUNG Mar 06, 2015
     * To do: save file 
     * @param: $model model GasFile
     * @param: $count 1,2,3
     * @return: name of image 
     */
    public static function  saveFile($model, $fieldName, $count)
    {        
        if(is_null($model->$fieldName)) return '';
        $year = MyFormat::GetYearByDate($model->created_date);
        $month = MyFormat::GetYearByDate($model->created_date, array('format'=>'m'));
        $pathUpload = GasFile::$pathUpload."/$year/$month";
        $ext = strtolower($model->$fieldName->getExtensionName());
        
//        $fileName = time();
//        $fileName = $fileName."-".ActiveRecord::randString().$count.'.'.$ext;
        
        $FileNameClient = strtolower(MyFunctionCustom::remove_vietnamese_accents($model->$fieldName->getName()));
        $FileNameClient = str_replace($ext, "", $FileNameClient);
        $fileName = time()."$count-".MyFunctionCustom::slugify($FileNameClient).'.'.$ext;
        
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $model->$fieldName->saveAs($pathUpload.'/'.$fileName);
        return $fileName;
    }
    
    /**
     * @Author: ANH DUNG Mar 06, 2015
     * To do: resize file scan
     * @param: $model model GasFile
     * @param: $fieldName 
     */
    public static function resizeImage($model, $fieldName) {
        $year = MyFormat::GetYearByDate($model->created_date);
        $month = MyFormat::GetYearByDate($model->created_date, array('format'=>'m'));
        $pathUpload = GasFile::$pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->file = $model->$fieldName;
        $ImageHelper->aRGB = array(0, 0, 0);//full black background
        $ImageHelper->thumbs = self::$aSize;
//        $ImageHelper->createFullImage = true ;
        $ImageHelper->createThumbs();
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $model->$fieldName);        
    }
    
    /**
     * @Author: ANH DUNG Feb 25, 2015
     * To do: delete file scan
     * @param: $modelRemove model GasFile
     * @param: $fieldName is file_name
     * @param: $aSize
     */
    public static function RemoveFileOnly($modelRemove, $fieldName) {
        $aDate = explode('-', $modelRemove->created_date);
        $pathUpload = GasFile::$pathUpload."/$aDate[0]/$aDate[1]";            
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);
        foreach ( GasFile::$aSize as $key => $value) {
            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $key . '/' . $modelRemove->$fieldName);
        }
    } 
    
    protected function beforeDelete() {
        self::RemoveFileOnly($this, 'file_name');
        return parent::beforeDelete();
    }
    
    /*** MAR 06,2015 END HANDLE VALIDATE AND SAVE MULTI FILE ********/
    
    /**
     * @Author: ANH DUNG Mar 06, 2015
     * @Todo: delete by type and belong_id
     * @Param: $model
     */
    public static function DeleteByBelongIdAndType($belong_id, $type) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.belong_id', $belong_id);
        $criteria->compare('t.type', $type);
        $models = self::model()->findAll($criteria);
        foreach($models as $item){
            $item->delete();
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 04, 2015
     * @Todo: validate multi file 
     * @Param: $model is model GasSupportCustomer
     */
    public static function ValidateFilePdf($model) {
        $cRole = Yii::app()->user->role_id;
        $ok=false; // for check if no file submit
        if(isset($_POST['GasSupportCustomer']['file_name'])  && count($_POST['GasSupportCustomer']['file_name'])){
            foreach($_POST['GasSupportCustomer']['file_name'] as $key=>$item){
                $mFile = new GasFile('UploadFilePdf');
                $mFile->file_name  = CUploadedFile::getInstance($model,'file_name['.$key.']');
                if(!is_null($mFile->file_name)){
                    $ok=true;
                }
                $mFile->validate();
                if($mFile->hasErrors()){
                    $model->addError('file_design', $mFile->getError('file_name'));
                }
            }
        }
        if(!$ok && $model->scenario == 'tech_create' && $cRole != ROLE_SUB_USER_AGENT ){ // ko co file submit
            $model->addError('file_design', "Chưa upload file");
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2015
     * @Todo: something
     */
    public function getForceLinkDownload() {        
        $link = Yii::app()->createAbsoluteUrl('admin/ajax/forceDownload', array('id'=>$this->id, 'model'=>'GasFile'));
        return "<a target='_blank' href='$link'>$this->file_name</a>";
    }
    /**
     * @Author: ANH DUNG Sep 04, 2015
     * @Todo: something
     */
    public function getSrcForceDownload() {
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = GasFile::$pathUpload."/$year/$month/$this->file_name";
        return $pathUpload;
    }
    
    /**
     * @Author: ANH DUNG Oct 27, 2015
     * @Todo: Api save record multi file for one detail
     * @Param: $mGasIssueTickets GasIssueTickets
     * * chỗ này cứ truyền vào model bình thường
     * phần xử lý này $mRoot = GasIssueTickets::model()->findByPk($mGasIssueTickets->id); // để lấy created_date, không thể find rồi đưa vào biến $model dc vì còn liên quan đến get file
     * sẽ xử lý trc khi gọi hàm này
     * @Important làm theo kiểu này thì sẽ không cho update record, mà sẽ là luôn xóa đi và tạo lại
     * hoặc là cá created date của record belongto kia sẽ không update cái created date
     * @chu-y: cái explode(' ', $mBelongTo->created_date);
     */
    public static function ApiSaveRecordFile($mBelongTo, $type) {
        $ClassName = get_class($mBelongTo);
        $mBelongTo = MyFormat::loadModelByClass($mBelongTo->id, $ClassName);
        set_time_limit(7200);
        if(isset($_FILES['file_name']['name'])  && count($_FILES['file_name']['name'])){
            foreach($_FILES['file_name']['name'] as $key=>$item){
                $mFile = new GasFile();
                $mFile->type =  $type;
                $mFile->belong_id = $mBelongTo->id;
                $created_date = explode(' ', $mBelongTo->created_date);
                $mFile->created_date = $created_date[0];
                $mFile->order_number = $key+1;
                $mFile->file_name  = CUploadedFile::getInstanceByName( "file_name[$key]");
                if(!is_null($mFile->file_name)){
                    $mFile->file_name  = self::saveFile($mFile, 'file_name', $key);
                    $mFile->save();
                    if(in_array($type, self::$TYPE_RESIZE_IMAGE)){
                        self::resizeImage($mFile, 'file_name');
                    }
                }
            }
        }        
    }
    
}