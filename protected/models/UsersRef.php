<?php

/**
 * This is the model class for table "{{_users_ref}}".
 *
 * The followings are the available columns in table '{{_users_ref}}':
 * @property string $id
 * @property string $user_id
 * @property string $reason_leave
 */
class UsersRef extends CActiveRecord
{
    const TYPE_KH_STORECARD = 1;
    const TYPE_USER_PROFILE = 2;
    public $old_image_sign;
    
    public static $AllowFile = 'jpg,jpeg,png';
    public static $aSize = array(
        'size1' => array('width' => 120, 'height' => 120),
        'size2' => array('width' => 500, 'height' => 500),
    );
    public static $pathUpload = 'upload/member/image_sign';
    
    public $contact_person_name;// Dec 28, 2015, người liên hệ
    public $contact_boss_name;// tên chủ quán
    public $contact_boss_phone;// phone
    public $contact_manage_name;// tên quản lý
    public $contact_manage_phone;
    public $contact_technical_name;// tên nv kỹ thuật
    public $contact_technical_phone;
    //contact_person_name, contact_boss_name, contact_boss_phone, contact_manage_name, contact_manage_phone, contact_technical_name, contact_technical_phone
    
    public $ARR_FIELD_CONTACT = array('contact_person_name', 'contact_boss_name', 'contact_boss_phone', 'contact_manage_name', 'contact_manage_phone', 'contact_technical_name', 'contact_technical_phone');
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() { return '{{_users_ref}}';}

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('reason_leave', 'required', 'on'=> 'CustomerLeave'),
            array('contact_person_name, contact_boss_name, contact_boss_phone, contact_manage_name, contact_manage_phone, contact_technical_name, contact_technical_phone, contact_person, id, user_id, reason_leave, image_sign', 'safe'),
            array('image_sign', 'file','on'=>'UploadImageSign',
                'allowEmpty'=>true,
                'types'=> self::$AllowFile,
                'wrongType'=> "Chỉ cho phép định dạng file ".self::$AllowFile." .",
                'maxSize'   => ActiveRecord::getMaxFileSize(),
                'minSize'   => ActiveRecord::getMinFileSize(),
                'tooLarge'  =>'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
                'tooSmall'  =>'The file was smaller than '.(ActiveRecord::getMinFileSize()/1024).' KB. Please upload a bigger file.',
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $mUser = $this->rUser;
        $aRes = array(
            'id' => 'ID',
            'user_id' => 'User',
            'reason_leave' => 'Lý do không lấy hàng',
            'image_sign' => 'File ảnh đại diện',
            'contact_person' => 'Người liên hệ',
            'contact_person_name' => 'Người liên hệ',
            'contact_boss_name' => 'Tên chủ quán',
            'contact_boss_phone' => 'Sđt chủ quán',
            'contact_manage_name' => 'Tên quản lý',
            'contact_manage_phone' => 'Sđt quản lý',
            'contact_technical_name' => 'Tên NV kỹ thuât',
            'contact_technical_phone' => 'Sđt NV kỹ thuât',
        );
        
//        if($mUser && $mUser->role_id != ROLE_CUSTOMER){
//            $aRes['reason_leave'] = "Ghi chú";
//        }
        return $aRes;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.reason_leave',$this->reason_leave,true);

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
    
    /**
     * @Author: ANH DUNG May 27, 2015
     * @Todo: OOP get info field
     */
    public function getReasonLeave() {
        return nl2br($this->reason_leave);
    }
    
    protected function beforeSave() {
        $aAttributes = array('reason_leave');
        MyFormat::RemoveScriptOfModelField($this, $aAttributes);
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Jun 14, 2014 
     * @Todo:validate file submit
     * @Param: $model model UsersRef
     */
    public static function validateFile($model, $needMore=array()){
        $mUserRef = new UsersRef('UploadImageSign');
        $mUserRef->image_sign  = CUploadedFile::getInstance($mUserRef, 'image_sign');
        if(!is_null($mUserRef->image_sign)){
            MyFormat::IsImageFile($_FILES['UsersRef']['tmp_name']['image_sign']);
        }
        $mUserRef->validate();
        if($mUserRef->hasErrors('image_sign')){
            $model->mUsersRef->addError('image_sign', $mUserRef->getError('image_sign'));                    
        }
    }
    
    /**
     * Sep 02, 2015 - ANH DUNG
     * To do: save file 
     * @param: $model UsersRef
     * @param: $count 1,2,3
     * @return: name of image upload/transactions/property_document
     */
    public static function saveFile($model, $fieldName)
    {
        if(is_null($model->$fieldName)) return '';
        $cUid = Yii::app()->user->id;
        $pathUpload = self::$pathUpload;
        $ext = $model->$fieldName->getExtensionName();
        $fileName = $cUid."-".ActiveRecord::randString().'.'.$ext;
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $model->$fieldName->saveAs($pathUpload.'/'.$fileName);
        return $fileName;
    }
    
    /*
     * @Author: ANH DUNG Sep 02, 2015
     * To do: resize file image sign
     * @param: $model model UsersRef
     * @param: $fieldName 
     */
    public static function resizeImage($model, $fieldName) {
        $pathUpload = self::$pathUpload;
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->file = $model->$fieldName;
        $ImageHelper->aRGB = array(0, 0, 0);//full black background
        $ImageHelper->thumbs = self::$aSize;
//        $ImageHelper->createFullImage = true;
        $ImageHelper->createThumbs();
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $model->$fieldName);        
    }
    
        
    /**
     * @Author: ANH DUNG Sep 02, 2015
     * To do: delete file scan
     * @param: $model model UsersRef
     * @param: $fieldName is avatar, agent_company_logo
     * @param: $aSize
     */
    public static function RemoveFileOnly($pk, $fieldName) {
        $modelRemove = self::model()->findByPk($pk);
        if (is_null($modelRemove) || empty($modelRemove->$fieldName))
            return;
        $pathUpload = self::$pathUpload;
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);
        foreach ( self::$aSize as $key => $value) {
            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $key . '/' . $modelRemove->$fieldName);
        }
    }   
    
    protected function beforeDelete() {
        self::RemoveFileOnly($this->id, 'image_sign');
        return parent::beforeDelete();
    }
    
    /**
     * @Author: ANH DUNG Dec 19, 2015
     */
    public function ApiGetAvatar() {
        return array(
            'thumb'=>ImageProcessing::bindImageByModel($this,'','',array('size'=>'size1')),
            'large'=>ImageProcessing::bindImageByModel($this,'','',array('size'=>'size1')),
        );
    }
    
    /**
     * @Author: ANH DUNG Dec 16, 2015
     * @todo: khởi tạo session 1 số thông tin của user theo role
     * su dung lan 1: admin/gasreports/Target_sale_cvkv
     */
    public static function InitSessionMonitor($aRoleId) {
        $aUser = Users::getArrObjectUserByRole($aRoleId);
//        $aMonitorPttt = Users::getArrObjectUserByRole(array(ROLE_MONITORING_MARKET_DEVELOPMENT));
        $session=Yii::app()->session;
        $aRes = array();
//        if(!isset($session['SESS_USER_INFO'])){
            foreach($aUser as $model) {
                $temp = array();
                $temp['first_name'] = $model->first_name;
                $temp['parent_id'] = $model->parent_id;
                $temp['array_agent_id'] = GasAgentCustomer::getEmployeeMaintainAgent($model->id);
//                $temp['more_info....'] = $model->parent_id; co the them thong tin ve sau
                $aRes[$model->id] = $temp;
            }
            $session['SESS_USER_INFO'] = $aRes;
//        }
    }
    
    /**
     * @Author: ANH DUNG Dec 18, 2015
     * @Todo: get note chỉ với user hệ thống, cột này với KH là lý do không lấy hàng
     */
    public function getNote() {
        return nl2br($this->reason_leave);
    }
    //contact_person_name, contact_boss_name, contact_boss_phone, contact_manage_name, contact_manage_phone, contact_technical_name, contact_technical_phone
    /**
     * @Author: ANH DUNG Dec 28, 2015
     * $name_field: may be: contact_person_name or contact_boss_name...
     */
    public function getFieldContact($field_name) {
        $temp = json_decode($this->contact_person, true);
        if(is_array($temp) && isset($temp[$field_name])){
            return $temp[$field_name];
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Dec 28, 2015
     */
    public function setFieldContact() {
        $json = array();
        foreach($this->ARR_FIELD_CONTACT as $field_name) {
            $json[$field_name] = $this->$field_name;
        }
        $this->contact_person = json_encode($json);
    }
    
    public function getMapFieldContact() {
        foreach($this->ARR_FIELD_CONTACT as $field_name) {
            $this->$field_name = $this->getFieldContact($field_name);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 28, 2015
     * @Todo: update lại data của cũ cua contact_person vào json
     */
    public static function UpdateJsonContactPerson() {
        $from = time();
        $models = self::model()->findAll();
        foreach($models as $model) {
            $model->contact_person_name = $model->contact_person;
            $model->setFieldContact();
            $model->update(array('contact_person'));
        }
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;
    }
    
    
}