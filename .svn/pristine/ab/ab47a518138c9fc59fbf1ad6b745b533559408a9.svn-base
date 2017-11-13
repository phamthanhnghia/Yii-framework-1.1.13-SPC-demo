<?php

/**
 * This is the model class for table "{{_users}}".
 *
 * The followings are the available columns in table '{{_users}}':
 * @property string $id
 * @property string $email
 * @property string $password_hashf
 * @property string $temp_password
 * @property string $first_name
 * @property string $last_name
 * @property string $first_char
 * @property integer $login_attemp
 * @property string $created_date
 * @property string $last_logged_in
 * @property string $ip_address
 * @property integer $role_id
 * @property integer $application_id
 * @property integer $approved_status
 * @property string $gender
 * @property string $area_code_id
 * @property string $phone
 * @property string $status
 * @property string $verify_code
 * @property string $temp_appointment
 * @property string $i_am_doctor
 *
 * The followings are the available model relations:
 * @property Appointment[] $appointments
 * @property Booking[] $bookings
 * @property Doctor[] $doctors
 * @property DoctorPictures[] $doctorPictures
 * @property DoctorSpecialty[] $doctorSpecialties
 * @property InsurancesAccept[] $insurancesAccepts
 */
class Users_gas_bk extends CActiveRecord
{
    public $email_confirm;
    public $areaCode;
    public $areaCodeConfirm;
    public $password_confirm;
    public $mobile_confirm;
    public $full_name;
    public $username;
    /* for change pass in admin */
    public $md5pass;//current in db
    public $currentpassword; //in form
    public $newpassword;    
    /* for change pass in admin */
    
    public $file_excel;
    public $maintain_agent_id;
    public $agent_id_search;
    public $MAX_ID;
    public $autocomplete_name;
    public $autocomplete_name_street;
    public $autocomplete_name_parent;
    
    public $customer_id;
    public $assign_employee_sales;
    public $mUsersRef;
    public $password; // Oct 25, 2015 for app signup
    
    
    const WIDTH_freezetable = 1100;
    public $IsFromPtttExcel;// biến kiểm tra KH được tạo từ import pttt file excel thì = 1
    // vì tạo từ file excel nên không build address_vi như cũ được, phải làm khác
    
    public static $requestStatus = array('0' =>	'Inactive',
                                        '1' =>	'Active',
                                         '2' =>	'Unapproved');
    
    public static $gender = array('male'=>'Nam','female'=>'Nữ');

    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName()
    {
            return '{{_users}}';
    }

    public function rules()
    {
        return array(
    array('first_name, status', 'required','on'=>'create_customer'),
    array('first_name, status, gender', 'required','on'=>'update_customer'),

    //create account admin
    array('first_name,username, email, last_name, gender','required','on'=>'createAdmin, editAdmin'),
    array('password_hash, password_confirm','required','on'=>'createAdmin'),
    array('password_hash', 'length', 'min'=>6, 'max'=>32,'on'=>'createAdmin, editAdmin'),
    array('password_confirm', 'compare', 'compareAttribute'=>'password_hash','on'=>'editAdmin,createAdmin'),

    // create_agent
    array('email','unique','message'=>'This email address is not available','on'=>'editAdmin,createAdmin'),
    array('code_account','unique','message'=>'Mã khách hàng này đã tồn tại, mã KH phải là duy nhất','on'=>'create_customer,update_customer'),
	array('code_account','unique','message'=>'Mã User này đã tồn tại, mã User phải là duy nhất','on'=>'create_agent,update_agent'), 
//	array('code_bussiness','unique','message'=>'Mã member này đã tồn tại, mã member phải là duy nhất','on'=>'create_member,update_member'), 
    array('username', 'match','pattern'=>'/^[a-zA-Z\d_.]{2,30}$/i', 
        'message'=>'Username cannot include special characters: &%$#',),
    array('username, province_id', 'required','on'=>'create_agent,update_agent'),
    array('username', 'unique','message'=>' Username này đã tồn tại' ,'on'=>'create_agent,update_agent,create_member,update_member, update_customer_username'),
    array('password_hash, password_confirm','required','on'=>'create_agent'),
    array('password_hash', 'length', 'min'=>PASSW_LENGTH_MIN, 'max'=>PASSW_LENGTH_MAX,'on'=>'create_agent,update_agent,create_member,update_member'),
    array('password_confirm', 'compare', 'compareAttribute'=>'password_hash','on'=>'create_agent,update_agent,create_member,update_member, update_customer_username'),
    array('email','email','on'=>'create_member,update_member'),
    array('email','unique','on'=>'create_member,update_member'),
    array('first_name','required','on'=>'create_member,update_member'),
                    
 // create_agent                    

//array('login_attemp, role_id, application_id, approved_status', 'numerical', 'integerOnly'=>true),
    //BE change my password - Nguyen Dung
    array('email, last_name','required','on'=>'updateMyProfile'),
    array('currentpassword', 'comparePassword', 'on'=>'changeMyPassword'),
    array('currentpassword, newpassword, password_confirm', 'required','on' => "changeMyPassword"),
    array('newpassword','length', 'min'=>PASSW_LENGTH_MIN, 'max'=>PASSW_LENGTH_MAX,
        'tooLong'=>'Mật khẩu mới quá dài (tối đa '.PASSW_LENGTH_MAX.' ký tự).',
        'tooShort'=>'Mật khẩu mới quá ngắn (tối thiểu '.PASSW_LENGTH_MIN.' ký tự).',
        'on'=>'changeMyPassword'),
    array('password_confirm', 'compare', 'compareAttribute'=>'newpassword','message'=>'Xác nhận mật khẩu mới không đúng.' ,'on'=>'changeMyPassword'),
    //BE change my password - Nguyen Dung

    array('email, password_hash, temp_password', 'length', 'max'=>250),
    array('email','email','on'=>'editAdmin,createAdmin'),
    //array('phone','numerical', 'integerOnly'=>true),
    array('name_agent, code_account, code_bussiness, address, province_id, channel_id,district_id,,storehouse_id,sale_id,payment_day,', 'safe'),
    array('percent_target,beginning, parent_id', 'safe'),
    array('maintain_agent_id,is_maintain, agent_id_search', 'safe'),
    array('id, username, email, password_hash, temp_password, first_name, last_name, first_char, login_attemp, created_date, last_logged_in, ip_address, role_id, application_id, status, gender, phone, verify_code, area_code_id', 'safe'),
    array('house_numbers,street_id,address_vi,ward_id, type,address_temp,customer_id,assign_employee_sales', 'safe'),
    array('last_purchase', 'safe'),
                    
	
    array('file_excel', 'file', 'on'=>'import_customer',
        'allowEmpty'=>false,
        'types'=> 'xls,xlsx',
        'wrongType'=>'Chỉ cho phép tải file xls,xlsx',
        //'maxSize' => ActiveRecord::getMaxFileSize(), // 5MB
        //'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
    ),  

// create_maintain_user
 array('first_name, province_id,district_id,ward_id,phone,street_id,house_numbers', 'required','on'=>'create_maintain_user,update_customer_maintain'),
// array('code_bussiness', 'checkCodeCustomer','on'=>'create_maintain_user'),
 array('code_bussiness', 'checkCodeCustomer', 'on'=>'update_customer_maintain'),
// create_maintain_user	
array('first_name,gender', 'required','on'=>'dieuphoi_create_sale'),

// create_customer_store_card
// array('first_name, province_id,district_id,ward_id,phone,street_id,house_numbers', 'required','on'=>'create_customer_store_card,update_customer_store_card'), // Close Jan 15, 2015
 array('first_name, province_id,district_id,phone,street_id,house_numbers', 'required','on'=>'create_customer_store_card,update_customer_store_card'),
// array('area_code_id', 'required','on'=>'create_customer_store_card,update_customer_store_card'),// sửa ngày Mar 01, 2014 chỉ cho user điều phối tạo KH thẻ kho, đại lý không tạo nữa
// array('is_maintain, first_name, province_id,district_id,ward_id,phone,street_id,house_numbers', 'required','on'=>'create_customer_store_card,update_customer_store_card'), 
// vì cột is_maintain không dùng trong loại KH của thẻ kho nên ta sẽ dùng cho 1: KH bình bò, 2. KH mối
array('parent_id', 'checkParentCustomerStoreCard',
    'on'=>'update_customer_store_card        
'),
                    

// create_customer_store_card	

array('last_name', 'required',
    'message'=>'Chọn cách xưng hô với khách hàng',
    'on'=>'create_maintain_user,update_customer_maintain,
        create_marketdevelopment,update_marketdevelopment
         '),
// employees_create
 array('first_name', 'required','on'=>'employees_create,employees_update'),
// employees_create
// create gasmarketdevelopment
array('first_name,phone,province_id,district_id,ward_id,street_id,house_numbers ', 'required','on'=>'create_marketdevelopment,update_marketdevelopment'),
//array('first_name', 'checkUniqueCustomer','on'=>'create_marketdevelopment,update_marketdevelopment,create_maintain_user,update_customer_maintain'),
array('first_name', 'checkUniqueCustomer','on'=>'create_marketdevelopment,create_maintain_user,create_customer_store_card'),
// Api Signup Oct 25, 2015
    array('phone, first_name, password, province_id, district_id, ward_id, house_numbers, street', 'required','on'=>'ApiSignup'),
    array('password','length', 'min'=>PASSW_LENGTH_MIN, 'max'=>PASSW_LENGTH_MAX,
        'tooLong'=>'Mật khẩu mới quá dài (tối đa '.PASSW_LENGTH_MAX.' ký tự).',
        'tooShort'=>'Mật khẩu mới quá ngắn (tối thiểu '.PASSW_LENGTH_MIN.' ký tự).',
        'on'=>'ApiSignup'),
    array('password_confirm', 'compare', 'compareAttribute'=>'password','message'=>'Xác nhận mật khẩu mới không đúng.' ,'on'=>'ApiSignup'),
// Api Signup Oct 25, 2015
                    
		);
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'province' => array(self::BELONGS_TO, 'GasProvince', 'province_id'),
                'channel' => array(self::BELONGS_TO, 'GasChannel', 'channel_id'),
                'storehouse' => array(self::BELONGS_TO, 'GasStorehouse', 'storehouse_id'),
                'district' => array(self::BELONGS_TO, 'GasDistrict', 'district_id'),
                'sale' => array(self::BELONGS_TO, 'Users', 'sale_id'),
                'customer' => array(self::BELONGS_TO, 'Users', 'parent_id'),
                'AgentCustomer' => array(self::HAS_MANY, 'GasAgentCustomer', 'agent_id'),
                'CustomerAgent' => array(self::HAS_MANY, 'GasAgentCustomer', 'customer_id'),
                'CustomerMaintain' => array(self::HAS_MANY, 'GasMaintain', 'customer_id'),
                'CustomerMaintainCount'=>array(self::STAT, 'GasMaintain', 'customer_id'),
                'agentCustomerCount'=>array(self::STAT, 'GasAgentCustomer', 'agent_id'),

                'ward' => array(self::BELONGS_TO, 'GasWard', 'ward_id'),
                'street' => array(self::BELONGS_TO, 'GasStreet', 'street_id'),
                'by_agent' => array(self::BELONGS_TO, 'Users', 'area_code_id'),
                'payment' => array(self::BELONGS_TO, 'GasTypePay', 'payment_day'),
                'parent' => array(self::BELONGS_TO, 'Users', 'parent_id'),
                'rParent' => array(self::BELONGS_TO, 'Users', 'parent_id'),
                'rCreatedBy' => array(self::BELONGS_TO, 'Users', 'created_by'),

                'rProfileAgent' => array(self::HAS_MANY, 'GasProfile', 'agent_id'),
                'rUsersRef' => array(self::HAS_ONE, 'UsersRef', 'user_id',
                    'on'=>'rUsersRef.type='.UsersRef::TYPE_KH_STORECARD,
                ),
                'rUsersRefProfile' => array(self::HAS_ONE, 'UsersRef', 'user_id',
                    'on'=>'rUsersRefProfile.type='.UsersRef::TYPE_USER_PROFILE,
                ),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $aLabels=array();
        switch($this->scenario){
            case 'employees':
            case 'employees_create':
            case 'employees_update':                
                $aLabels = array(
                    'id' => 'ID',
                    'email' => 'Email',
                    'created_date' => 'Ngày Tạo',
                    'last_logged_in' => 'Last Logged In',
                    'ip_address' => 'Ip Address',
                    'status' => 'Trạng Thái',
                    'gender' => 'Giới Tính',
                    'phone' => 'Phone',
                    'first_name' => 'Tên Nhân Viên',
                    'last_name' => 'Cách Xưng Hô',		
                    'code_account' => 'Mã Hệ Thống',
                    'code_bussiness' => 'Mã Nhân Viên',
                    'address' => 'Địa Chỉ',
                    'province_id' => 'Tỉnh',
                    'channel_id' => 'Trạng Thái',
                    'district_id' => 'Quận Huyện',
                    'storehouse_id' => 'Chi Nhánh Giao',
                    'sale_id' => 'Nhân Viên Sale',
                    'role_id' => 'Chức Vụ',
                );                    
            break;

            default: // employers end up here
                $aLabels = array(
                    'id' => 'ID',
                    'email' => 'Email',
                    'email_confirm' => 'Confirm email',
                    'password_hash' => 'Password',
                    'password_confirm' => 'Confirm Password',
                    'temp_password' => 'Temp Password',
                    'last_name' => 'Cách Xưng Hô',			
                    'created_date' => 'Ngày Tạo',
                    'last_logged_in' => 'Last Logged In',
                    'ip_address' => 'Ip Address',
                    'status' => 'Trạng Thái',
                    'gender' => 'Giới Tính',
                    'phone' => 'Phone',
                    'full_name' => 'Name',
                    'area_code_id' => 'Area Code',
                    'currentpassword' => 'Mật Khẩu Hiện Tại',
                    'newpassword'=>'Mật Khẩu Mới',
                    'first_name' => 'Tên KH',
                    'name_agent' => 'Tên để sắp xếp (sort) tiếng việt ko dấu',
                    'code_account' => 'Mã KH Kế Toán',
                    'code_bussiness' => 'Mã KH Kinh Doanh',
                    'address' => 'Địa Chỉ',
                    'address_temp' => 'Địa Chỉ Mới',
                    'province_id' => 'Tỉnh',
                    'channel_id' => 'Trạng Thái',
                    'district_id' => 'Quận Huyện',
                    'storehouse_id' => 'Chi Nhánh Giao',
                    'sale_id' => 'Nhân Viên Sale',
                    'payment_day' => 'Hạn Thanh Toán',
                    'percent_target' => 'Phần trăm target',
                    'beginning' => 'Dư đầu kỳ',
                    'role_id' => 'Loại User',
                    'maintain_agent_id' => 'Đại Lý Theo Dõi',
                    'is_maintain' => 'Loại KH',
                    'agent_id_search' => 'Đại Lý',
                    'house_numbers' => 'Số Nhà + Thôn/Ấp',
                    'ward_id' => 'Phường/Xã',
                    'street_id' => 'Đường',
                    'parent_id' => 'Thuộc Hệ Thống',
                    'customer_id' => 'Khách Hàng',
                    'assign_employee_sales' => 'KH Có NV Sale',
                    'last_purchase' => 'Ngày Mua Hàng Cuối Cùng',
                );
            break;
        }

//            if($this->scenario=='create_customer_store_card' || $this->scenario=='update_customer_store_card'){
//                $aLabels['is_maintain'] = 'Loại KH';
//            }
        if($this->scenario=='dieuphoi_create_sale'){
            $aLabels['first_name'] = 'Họ Tên';
            $aLabels['gender'] = 'Loại Sale';
        }            
        return $aLabels;
    }

    public function compareEmail($attribute,$params)
	{
        if($this->email_confirm != $this->email){
           $this->addError("email_confirm","$this->email_confirm email is wrong.");
        }
    }
    	
    public function checkParentCustomerStoreCard($attribute,$params)
    {
        if(!$this->isNewRecord && trim($this->parent_id) !='' && $this->parent_id!=0){
            if($this->parent_id == $this->id){
                $this->addError("parent_id","Hệ thống của khách hàng không hợp lệ. Vui lòng chọn lại");
            }            
        }
    }
    	
    public function comparePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            if(trim($this->currentpassword) =='')
                $this->addError('currentpassword','Mật khẩu hiện tại trống.');
            else{
                //$tempPass = $this->currentpassword;
                //$this->currentpassword = md5(trim($this->currentpassword));
                if($this->md5pass != md5(trim($this->currentpassword))){
                        $this->addError('currentpassword','Mật khẩu hiện tại không đúng.');   
                }
                //$this->currentpassword = $tempPass;
            }
        }
    }  
	
    
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($criteria = NULL)
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.
    if($criteria == NULL)
        $criteria=new CDbCriteria;
        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.code_account', trim($this->code_account),true);
        $criteria->compare('t.code_bussiness',trim($this->code_bussiness),true);                
        $criteria->compare('t.address',$this->address,true);
        $criteria->compare('t.first_name',$this->first_name,true);
        $criteria->compare('t.name_agent',$this->name_agent,true);

        $criteria->compare('t.province_id',$this->province_id);
        $criteria->compare('t.district_id',$this->district_id);

        Users::LimitProvince($criteria); // ADD DEC 29, 2014

        $criteria->compare('t.role_id',$this->role_id);
        $criteria->compare('t.application_id',$this->application_id);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.gender',$this->gender,true);
        $criteria->compare('t.phone',$this->phone,true);
        $criteria->compare('t.verify_code',$this->verify_code,true);
//		$criteria->order = "t.code_account asc";
        $sort = new CSort();
        $sort->attributes = array(
            'code_account'=>'code_account',
            'code_bussiness'=>'code_bussiness',
            'first_name'=>'first_name',
            'last_logged_in'=>'last_logged_in',
            'username'=>'username',
            'payment_day'=>'payment_day',
            'beginning'=>'beginning',
            'gender'=>'gender',
            'province_id'=>'province_id',
            'district_id'=>'district_id',
        );    
        $sort->defaultOrder = 't.id DESC';  		

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 100,
            ),                    
            'sort' => $sort,
        ));
    }

    /**
     * @Author: ANH DUNG Dec 29, 2014
     * @Todo: limit province mien tay
     */
    public static function LimitProvince(&$criteria) {
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        $aRoleCheck = array(ROLE_DIEU_PHOI, ROLE_HEAD_OF_MAINTAIN);
        if(in_array($cRole, $aRoleCheck)){
            if (in_array($cUid, GasOrders::$ZONE_HCM)){
                $criteria->addNotInCondition('t.province_id', GasOrders::$PROVINCE_ZONE_MIEN_TAY);
            }elseif (in_array($cUid, GasOrders::$ZONE_MIEN_TAY)){
                $criteria->addInCondition('t.province_id', GasOrders::$PROVINCE_ZONE_MIEN_TAY);
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 29, 2014
     * @Todo: check user can access to view province
     */
    public static function CanAccessProvince($province_id) {
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        if( $cRole==ROLE_DIEU_PHOI){
            if(in_array($province_id, GasOrders::$PROVINCE_ZONE_MIEN_TAY)){
                return in_array($cUid, GasOrders::$ZONE_MIEN_TAY); // uid dieu phoi
            }elseif(in_array($province_id, GasOrders::$PROVINCE_ZONE_HCM)){
                return in_array($cUid, GasOrders::$ZONE_HCM);// uid dieu phoi
            }            
        }
        return true;
    }

    public function search_customer_maintain($criteria = NULL)
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.
    if($criteria == NULL)
                $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.code_account', trim($this->code_account),true);
            $criteria->compare('t.code_bussiness',trim($this->code_bussiness),true);                
            $criteria->compare('t.address',$this->address,true);
            $criteria->compare('t.first_name',$this->first_name,true);
            $criteria->compare('t.name_agent',$this->name_agent,true);
            $criteria->compare('t.province_id',$this->province_id);
            $criteria->compare('t.district_id',$this->district_id);
            $criteria->compare('t.role_id',$this->role_id);
            $criteria->compare('t.application_id',$this->application_id);
            $criteria->compare('t.status',$this->status);
            $criteria->compare('t.gender',$this->gender,true);
            $criteria->compare('t.phone',$this->phone,true);
            $criteria->compare('t.is_maintain',$this->is_maintain);
            $criteria->compare('t.verify_code',$this->verify_code,true);
            $criteria->compare('t.type', CUSTOMER_TYPE_MAINTAIN);
//		$criteria->order = "t.code_account asc";

            if(isset($this->agent_id_search) && !empty($this->agent_id_search)){
                $criteria->compare('t.area_code_id', $this->agent_id_search);
//                    $aCusId = GasMaintain::getCustomerOfAgent($this->agent_id_search);
//                    if(count($aCusId)>0)
//                        $criteria->addInCondition('t.id', $aCusId); 
            }

            $sort = new CSort();
            $sort->attributes = array(
                'code_account'=>'code_account',
                'code_bussiness'=>'code_bussiness',
                'first_name'=>'first_name',
                'created_date'=>'created_date',
                'is_maintain'=>'is_maintain',
            );    
            $sort->defaultOrder = 't.id DESC';                   

            if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT)
                $criteria->compare('t.area_code_id',Yii::app()->user->parent_id);

            $_SESSION['data-excel'] = new CActiveDataProvider($this, array(
                    'pagination'=>false,
                    'criteria'=>$criteria,
                    'sort' => $sort,
            ));                
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),         
                 'sort' => $sort,
            ));
    }

    public function search_customer_store_card($criteria = NULL)
    {
        if($criteria == NULL)
                $criteria=new CDbCriteria;

            $criteria->compare('t.id',$this->customer_id);
            $criteria->compare('t.code_account', trim($this->code_account),true);
            $criteria->compare('t.code_bussiness',trim($this->code_bussiness),true);                
            $criteria->compare('t.address',$this->address,true);
//		$criteria->compare('t.first_name',$this->first_name,true);
            $criteria->compare('t.name_agent',$this->name_agent,true);
            $criteria->compare('t.province_id',$this->province_id);
            $criteria->compare('t.district_id',$this->district_id);
            $criteria->compare('t.role_id',$this->role_id);
            $criteria->compare('t.application_id',$this->application_id);
            $criteria->compare('t.status',$this->status);
            $criteria->compare('t.gender',$this->gender,true);
            $criteria->compare('t.phone',$this->phone,true);
            $criteria->compare('t.sale_id',$this->sale_id);
            $criteria->compare('t.channel_id',$this->channel_id);
            $criteria->compare('t.is_maintain',$this->is_maintain);
            $criteria->compare('t.verify_code',$this->verify_code,true);
            $criteria->compare('t.type', CUSTOMER_TYPE_STORE_CARD);
            Users::LimitProvince($criteria); // ADD DEC 29, 2014
//		$criteria->order = "t.code_account asc";
//		$criteria->order = "t.id DESC";
            $criteria->compare('t.channel_id', $this->channel_id );// May 14, 2015

            if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT){
                $criteria->compare('t.area_code_id', MyFormat::getAgentId());                
            }
            if(Yii::app()->user->role_id==ROLE_SALE){
                $criteria->compare('t.sale_id', Yii::app()->user->id);
            }

            if(isset($this->agent_id_search) && !empty($this->agent_id_search)){
                $criteria->compare('t.area_code_id', $this->agent_id_search);                    
            }

            if(trim($this->assign_employee_sales)!=''){
                if($this->assign_employee_sales==1){
                    $criteria->addCondition("t.sale_id<>'' AND t.sale_id IS NOT NULL ");
                }elseif($this->assign_employee_sales==0){
                    $criteria->addCondition(" t.sale_id='' OR t.sale_id IS NULL ");
                }                    
            }

            $sort = new CSort();
            $sort->attributes = array(
                'code_account'=>'code_account',
                'code_bussiness'=>'code_bussiness',
                'first_name'=>'first_name',
                'created_date'=>'created_date',
                'is_maintain'=>'is_maintain',
                'username'=>'username',
            );
            $sort->defaultOrder = 't.id DESC';
            if($this->channel_id == Users::KHONG_LAY_HANG){
                $sort->defaultOrder = 't.last_purchase DESC';
            }

            $_SESSION['data-excel'] = new CActiveDataProvider($this, array(
                    'pagination'=>false,
                    'criteria'=>$criteria,
                    'sort' => $sort,
            ));                
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),         
                 'sort' => $sort,
            ));
    }
    
    public function searchGasEmployees($criteria = NULL)
    {
        if($criteria == NULL)
                $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.code_account', trim($this->code_account),true);
            $criteria->compare('t.code_bussiness',trim($this->code_bussiness),true);                
            $criteria->compare('t.address',$this->address,true);
            $criteria->compare('t.address_vi',$this->first_name,true);
            $criteria->compare('t.province_id',$this->province_id);
            $criteria->compare('t.district_id',$this->district_id);
            $criteria->compare('t.role_id',$this->role_id);
            $criteria->compare('t.status',$this->status);
            $criteria->compare('t.gender',$this->gender,true);
            $criteria->compare('t.phone',$this->phone,true);
            $criteria->compare('t.verify_code',$this->verify_code,true);
//		$criteria->order = "t.code_account asc";
            $sort = new CSort();
            $sort->attributes = array(
                'code_account'=>'code_account',
                'code_bussiness'=>'code_bussiness',
                'first_name'=>'first_name',
                'created_date'=>'created_date',
                'is_maintain'=>'is_maintain',
                'role_id'=>'role_id',
                'address'=>'address',
                'phone'=>'phone',
                'status'=>'status',
            );    
            $sort->defaultOrder = 't.id DESC';  
            $criteria->addInCondition('t.role_id', CmsFormatter::$aRoleMemNotLogin); 
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
//                            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        'pageSize'=> 50,
                    ),          
                 'sort' => $sort,
            ));
    }

    public function searchSale($criteria = NULL)
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

    if($criteria == NULL)
                $criteria=new CDbCriteria;

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.email',$this->email,true);
            $criteria->compare('t.first_name',$this->first_name,true);
            $criteria->compare('t.created_date',$this->created_date,true);
            $criteria->compare('t.last_logged_in',$this->last_logged_in,true);
            $criteria->compare('t.ip_address',$this->ip_address,true);
            $criteria->compare('t.role_id',$this->role_id);
            $criteria->compare('t.application_id',$this->application_id);
            $criteria->compare('t.status',$this->status);
            $criteria->compare('t.phone',$this->phone,true);
            $criteria->order = "t.id asc";

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
        ),                    
            ));
    }


    public function searchGasMember()
    {

            $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.username',$this->username,true);
            $criteria->compare('t.email',$this->email,true);
            $criteria->compare('t.address_vi',$this->first_name,true);
            $criteria->compare('t.created_date',$this->created_date,true);
            $criteria->compare('t.last_logged_in',$this->last_logged_in,true);
            $criteria->compare('t.code_account', trim($this->code_account),true);
            $criteria->compare('t.code_bussiness',trim($this->code_bussiness),true);                		
            if(isset($this->role_id) && trim($this->role_id)!=''){
                $criteria->compare('t.role_id',$this->role_id);
            }
            else{
//                $criteria->addInCondition('t.role_id',  CmsFormatter::$aRoleMemLogin);
                $criteria->addNotInCondition('t.role_id',  CmsFormatter::$aRoleMemNotLogin);
            }

            $criteria->addNotInCondition('t.role_id', Roles::$aRoleRestrict);
            $criteria->compare('t.address_vi',$this->address,true);
            $criteria->compare('t.phone',$this->phone,true);
            $criteria->compare('t.parent_id',$this->parent_id);
            $criteria->compare('t.status',$this->status);
//		$criteria->order = "t.id desc";
            $sort = new CSort();
            $sort->attributes = array(
                'email'=>'email',
                'code_account'=>'code_account',
                'code_bussiness'=>'code_bussiness',
                'username'=>'username',
                'first_name'=>'first_name',
                'last_logged_in'=>'last_logged_in',
                'phone'=>'phone',
                'address'=>'address',
                'role_id'=>'role_id',
                'gender'=>'gender',
                'status'=>'status',
                'created_date'=>'created_date',
                'parent_id'=>'parent_id',
//                    'customer_id'=>array(
//                            'asc'=>'customer.first_name',
//                            'desc'=>'customer.first_name DESC',
//                    ),         

            );    
            $sort->defaultOrder = 't.id DESC';                    

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> 100,
//                        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),                    
                'sort' => $sort,
            ));
    }

	
    public function searchAdmin($criteria = NULL)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.


        if($criteria == NULL)
            $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.username',$this->username,true);
        $criteria->compare('t.email',$this->email,true);
        $criteria->compare('t.password_hash',$this->password_hash,true);
        $criteria->compare('t.temp_password',$this->temp_password,true);
        $criteria->compare('t.first_name',$this->first_name,true);
        $criteria->compare('t.last_name',$this->last_name,true);
        $criteria->compare('t.first_char',$this->first_char,true);
        $criteria->compare('t.login_attemp',$this->login_attemp);
        $criteria->compare('t.created_date',$this->created_date,true);
        $criteria->compare('t.last_logged_in',$this->last_logged_in,true);
        $criteria->compare('t.ip_address',$this->ip_address,true);
        $criteria->compare('t.role_id',2);
        $criteria->compare('t.application_id',1);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.gender',$this->gender,true);
        $criteria->compare('t.phone',$this->phone,true);
        $criteria->compare('t.verify_code',$this->verify_code,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),            
        ));
    }

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
        
        public function unlinkAllFileInFolder($path) {
            $files = glob($path.'/*'); // get all file names
            foreach($files as $file){ // iterate files
                if(is_file($file))
                    unlink($file); // delete file
            }
        }
        

    public function beforeDelete()
    {
        try{
            $mDel = GasMaintain::model()->findAll('customer_id ='.$this->id);
            Users::deleteArrModel($mDel);
			
            $mDel = GasMaintainSell::model()->findAll('customer_id ='.$this->id);
            Users::deleteArrModel($mDel);
			
            $mDel = GasAgentCustomer::model()->findAll('customer_id ='.$this->id);
            Users::deleteArrModel($mDel);
			
            $mDel = GasDailyCash::model()->findAll('customer_id ='.$this->id);
            Users::deleteArrModel($mDel);
			
            $mDel = GasDailySelling::model()->findAll('customer_id ='.$this->id);
            Users::deleteArrModel($mDel);
            // up to 12-21-2013 thẻ kho
            // Now 26, 2015 không nên xóa dữ liệu của thẻ kho - chấp nhận dư thừa - vì Kiên lỡ tay xóa mất 1 KH nên sẽ đóng lại tránh xóa lần nữa
//            $mDel = GasStoreCard::model()->findAll('customer_id ='.$this->id);
//            Users::deleteArrModel($mDel);
            // Now 26, 2015 không nên xóa dữ liệu của thẻ kho - chấp nhận dư thừa - vì Kiên lỡ tay xóa mất 1 KH nên sẽ đóng lại tránh xóa lần nữa
			
            if($this->role_id == ROLE_AGENT){
		// 1. xóa những nhân viên bảo trì của đại lý
                GasOneMany::deleteOneByType($this->id, ONE_AGENT_MAINTAIN);
		// 2. xóa những nhân viên kế toán được gắn cho đại lý, vì mỗi đại lý dc gắn 1 số kế toán và nhân viên bảo trì thuộc đại lý đó	
                GasOneMany::deleteOneByType($this->id, ONE_AGENT_ACCOUNTING);
                $mDel = GasAgentCustomer::model()->findAll('agent_id ='.$this->id);
                Users::deleteArrModel($mDel);	
                // xóa những row đại lý dc nhân viên check bảo trì theo dõi, mỗi nhân viên dc theo dõi khoảng hơn 10 đại lý - gấn giống bên dưới
                $mDel = GasAgentCustomer::model()->findAll('maintain_agent_id ='.$this->id);
                Users::deleteArrModel($mDel);	
					
            }
	    // xóa những đại lý dc nhân viên check bảo trì theo dõi, mỗi nhân viên dc theo dõi khoảng hơn 10 đại lý
            $mDel = GasAgentCustomer::model()->findAll('employee_maintain_id ='.$this->id);
            Users::deleteArrModel($mDel);	

            $mDel = GasCustomerOrders::model()->findAll('customer_id ='.$this->id);
            Users::deleteArrModel($mDel);
            $mDel = UsersRef::model()->findAll('user_id ='.$this->id);
            Users::deleteArrModel($mDel);// Sep 29, 2015

        }catch(Exception $ex){
            echo $ex->getMessage();die;
        }

        return parent::beforeDelete();
    }
	
    public static function deleteArrModel($mDel){
        if(count($mDel)>0)
            foreach ($mDel as $item)
                    $item->delete();	
    }
    
//        public static function deleteOrderByUid($user_id){
//            $criteria=new CDbCriteria;
//            $criteria->compare('user_id',$user_id);
//            $models = Order::model()->findAll($criteria);
//            if(count($models)>0)
//                foreach($models as $item)
//                    $item->delete();
//        }
//        
//        public function beforeDelete123() {
//            OrderDetail::model()->deleteAll('order_id='.$this->id);
//            return parent::beforeDelete();
//        }
    
    
    public function activate()
    {
        $this->status = 1;
        $this->update(array('status'));
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update(array('status'));
    }

    public function customDeleteUser()
    {
        $this->status = 0;
        $this->update(array('status'));
    }

    public function behaviors()
    {
        return array(
//            'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
//            'sluggable' => array(
//                    'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
//                    'columns' => array('first_name'),
//                    'unique' => true,
//                    'update' => true,
//            ), 
        );
    }
    
    public function getInforUser($id = null,$name =null){
    	/**
		  * Get information user
    	 */
    	
    	$id 	= $id;
    	$name = trim($name);
    	if(empty($id)) return ;
    	if(!empty($name)) $result = Users::model()->findByPk($id)->$name;
    	else $result = Users::model()->findByPk($id);
    	return $result;
    }
    
    public static function loadItems($emptyOption=false)
    {
            $_items = array();
            if($emptyOption)
                    $_items[""]="";	
            $model=self::model()->findByPk(Yii::app()->user->getId());
            //foreach($models as $model)
                    $_items[$model->id]=$model->email;
            return $_items;		
    }
 
    public static function generateKey($user)
    {
        if(empty($user->email))
            $user->email = '';
        return md5($user->id . $user->email);
    }    
    
    public static function findByVerifyCode($verify_code){
        return Users::model()->find('verify_code='.$verify_code.'');
    }
 
    // $needMore['order'] t.province_id asc, t.id asc
    public static function getArrUserByRole($role_id='', $needMore=array())
    {
        $criteria = new CDbCriteria;
        if($role_id==ROLE_AGENT)
            $criteria->select = 'id, CONCAT(code_account," - ", first_name) as first_name, role_id';
        else
            $criteria->select = 'id, CONCAT(code_bussiness," - ", first_name) as first_name, gender,parent_id, role_id';
        
        if(!empty($role_id)){
            if(is_array($role_id)){
                $criteria->addInCondition('t.role_id', $role_id);
            }else{
                $criteria->compare('t.role_id', $role_id);
            }
        }
            
        GasAgentCustomer::initSessionAgent();
        $session=Yii::app()->session;
        if(isset($session['LIST_AGENT_OF_USER']) && count($session['LIST_AGENT_OF_USER'])){
            $criteria->addInCondition('t.id', $session['LIST_AGENT_OF_USER']); 
        }        
        $criteria->order = 'id ASC';
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        $criteria->compare('t.status', STATUS_ACTIVE);
        $models = self::model()->findAll($criteria);
        $aRes = array();
        if(isset($needMore['prefix_type_sale'])){
            foreach ( $models as $item){
                $typeSale = isset(Users::$aTypeSale[$item->gender])?Users::$aTypeSale[$item->gender]:'';
                $AgentBelongTo = $item->rParent?$item->rParent->first_name:'';
                $aRes[$item->id] = $item->first_name." - ".$typeSale." - $AgentBelongTo";
            }
            return $aRes;
        }
        
        // Dec 14, 2015 lấy tên user và role của user đó ra
        if(isset($needMore['get_name_and_role'])){
            foreach ( $models as $item){
                $aRes[$item->id] = $item->first_name." - ".$session['ROLE_NAME_USER'][$item->role_id];
            }
            return $aRes;
        }
        // Dec 14, 2015
        
        return  CHtml::listData($models,'id','first_name');            
    }
    
    public static function getArrUserByRoleForSetUpTarget($role_id, $needMore=array())
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id); 
        $criteria->order = 'id ASC';
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        $criteria->compare('t.status', STATUS_ACTIVE);
        if(isset($needMore['aTypeSaleNotIn'])){
            $criteria->addNotInCondition('t.gender', $needMore['aTypeSaleNotIn']);
        }
        if(isset($needMore['target_chuyenvien_kd_khuvuc'])){
            $criteria->compare('t.gender', Users::SALE_PTTT_KD_KHU_VUC);
        }
        $aRes = array();
        $models = self::model()->findAll($criteria);
        if(isset($needMore['aTypeSaleNotIn'])){
            foreach ( $models as $item){
                $typeSale = isset(Users::$aTypeSale[$item->gender])?Users::$aTypeSale[$item->gender]:'';
                $aRes[$item->id] = $item->code_bussiness."-".$item->first_name." - ".$typeSale;
            }
            return $aRes;
        }
        return  CHtml::listData($models,'id','first_name');            
    }
    
    
    public static function getArrUserPTTT($role_id, $needMore=array())
    {
        $criteria = new CDbCriteria;
        if($role_id==ROLE_AGENT)
            $criteria->select = 'id, CONCAT(code_account," - ", first_name) as first_name';
        else
            $criteria->select = 'id, CONCAT(code_bussiness," - ", first_name) as first_name';
        
        if(is_array($role_id)){
            $criteria->addInCondition('t.role_id', $role_id); 
        }else{
            $criteria->compare('t.role_id', $role_id); 
        }
        $criteria->compare('t.status', STATUS_ACTIVE);
        
//        GasAgentCustomer::initSessionAgent();
//        $session=Yii::app()->session;
//        if(isset($session['LIST_AGENT_OF_USER']) && count($session['LIST_AGENT_OF_USER'])){
//            $criteria->addInCondition('t.id', $session['LIST_AGENT_OF_USER']); 
//        }
        
        $criteria->order = 'id ASC';
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        
        $models = self::model()->findAll($criteria);		
        return  CHtml::listData($models,'id','first_name');            
    }            
 
    public static function getArrUserEmployeeAccounting($role_id='')
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, CONCAT(code_bussiness," - ", first_name) as first_name';
        if(!empty($role_id)){
            if(is_array($role_id)){
                $criteria->addInCondition('t.role_id', $role_id); 
            }else{
                $criteria->compare('t.role_id', $role_id); 
            }
        }
            
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 'code_bussiness ASC';
        $models = self::model()->findAll($criteria);		
        return  CHtml::listData($models,'id','first_name');            
    }            
 
 
    public static function getArrDropdown($role_id)
    {
        $criteria = new CDbCriteria;        
        $criteria->compare('t.role_id', $role_id);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 'code_bussiness ASC';
        $models = self::model()->findAll($criteria);		
        return  CHtml::listData($models,'id','first_name');            
    }            
 
    /**
     * @Author: ANH DUNG Apr 07, 2014
     * @Todo: do hàm bên trên getArrUserByRole lấy bị giới hạn 1 số điều kiện ($session=Yii::app()->session;)
     * hiện tại thì không nên sửa hàm đó, mà viết 1 hàm mới lấy list đại lý không theo điều kiện nào cả
     * dùng cho thống kê http://daukhimiennam.com/admin/gasreports/determineGasGoBack
     */
    public static function getArrUserByRoleNotCheck($role_id='')
    {
        $criteria = new CDbCriteria;
        if($role_id==ROLE_AGENT)
            $criteria->select = 'id, CONCAT(code_account," - ", first_name) as first_name';
        else
            $criteria->select = 'id, CONCAT(code_bussiness," - ", first_name) as first_name';
        
        if(!empty($role_id)){
            if(is_array($role_id)){
                $criteria->addInCondition('t.role_id', $role_id); 
            }else{
                $criteria->compare('t.role_id', $role_id); 
            }
        }
            
        $session=Yii::app()->session;
        if(isset($session['LIST_AGENT_OF_USER']) && count($session['LIST_AGENT_OF_USER'])){
            $criteria->addInCondition('t.id', $session['LIST_AGENT_OF_USER']); 
        } 
        
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 't.id ASC';
        if(is_array($role_id)){
            $criteria->order = 't.role_id DESC, t.id ASC';
        }
        
        $models = self::model()->findAll($criteria);		
        return  CHtml::listData($models,'id','first_name');            
    }     
    
    public static function getArrAgentNotWarehouse($needMore=array())
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, CONCAT(code_account," - ", first_name) as first_name';
        $criteria->compare('t.role_id', ROLE_AGENT); 
        if(isset($needMore['gender'])){ // xem có lấy kho hay đại lý
            // vì hệ thống chia ra kho và đại lý, nên có chỗ chỉ lấy đại lý, không lấy kho
            $criteria->compare('t.gender', $needMore['gender']);   
        }
        $criteria->order = "t.province_id asc, t.id asc";        
        if(isset($needMore['gender_sort'])){
            $criteria->order = "t.gender ".$needMore['gender_sort'].", t.id asc";        
        }
        
        $models = self::model()->findAll($criteria);		
        return  CHtml::listData($models,'id','first_name');
    }            
 
    // Lấy mảng id đại lý không lấy kho cho vào điều kiện inCondition
    public static function getArrIdAgentNotWarehouse($needMore=array())
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', ROLE_AGENT); 
        if(isset($needMore['gender'])){ // xem có lấy kho hay đại lý
            // vì hệ thống chia ra kho và đại lý, nên có chỗ chỉ lấy đại lý, không lấy kho
            if(is_array($needMore['gender'])){
                $criteria->addInCondition('t.gender', $needMore['gender']);
            }else{
                $criteria->compare('t.gender', $needMore['gender']);
            }
        }
        $criteria->order = "t.province_id asc, t.id asc";        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','id');            
    }           
    
    public static function getArrIdUserByRole($role_id=ROLE_AGENT)
    {
        $criteria = new CDbCriteria;
        if(!empty($role_id))
            $criteria->compare('t.role_id', $role_id);        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','id');            
    }            

    /**
     * @Author: ANH DUNG Mar 26, 2014
     * @Todo: lấy mảng id user theo 1 nhóm role dùng cho chtml
     * @Param: $aRoleId  array role
     */
    public static function getArrIdUserByArrayRole($aRoleId, $needMore=array())
    {
        $criteria = new CDbCriteria;        
        $criteria->addInCondition('t.role_id', $aRoleId);
        $criteria->compare('t.status', STATUS_ACTIVE);
        if(isset($needMore['gender'])){ // xem có lấy kho hay đại lý
            // vì hệ thống chia ra kho và đại lý, nên có chỗ chỉ lấy đại lý, không lấy kho
            if(is_array($needMore['gender']))
                $criteria->addInCondition('t.gender', $needMore['gender']);   
            else
                $criteria->compare('t.gender', $needMore['gender']);
        }
        
        if(isset($needMore['monitor_chuyenvien_kinhdoanh_khuvuc'])){
            $criteria->compare('t.is_maintain', 1);
        }
        
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','id');            
    }
    
    public static function getArrObjectUserByRole($role_id='', $aUid=array())
    {
        $criteria = new CDbCriteria;
        if(is_array($role_id)){// Add Dec 16, 2015 khong ro co anh huong den cho nao ko
            $criteria->addInCondition('t.role_id', $role_id);
        }else{
            if(!empty($role_id)){
                $criteria->compare('t.role_id', $role_id);
            }
        }
        if(count($aUid)>0){
            $criteria->addInCondition('t.id',$aUid);
        }
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = "t.id asc";
        $models = self::model()->findAll($criteria);
        $res=array();
        foreach ($models as $item)
                $res[$item->id] = $item;
        return  $res;         
    }   
    
    // return array
    public static function getArrObjectUserByArrUid($aUid, $role_id=ROLE_CUSTOMER, $needMore=array())
    {
        if(count($aUid)<1) return array();
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);   
        $criteria->addInCondition('t.id',$aUid);
        return self::model()->findAll($criteria);
    }   
	    
    public static function getArrObjectUserByRoleHaveOrder($role_id=ROLE_AGENT, $order='first_name')
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);   
        $criteria->order = "t.$order asc";
        $models = self::model()->findAll($criteria);
        $res=array();
        foreach ($models as $item)
                $res[$item->id] = $item;
        return  $res;         
    }   	
	    
    
    // Apr 11, 2014 lấy mảng các đại lý chia theo tỉnh
    public static function getArrObjecByRoleGroupByProvince($role_id=ROLE_AGENT, $needMore=array())
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);   
        if(isset($needMore['gender'])){ // xem có lấy kho hay đại lý
            // vì hệ thống chia ra kho và đại lý, nên có chỗ chỉ lấy đại lý, không lấy kho
            $criteria->compare('t.gender', $needMore['gender']);   
        }
        if($role_id==ROLE_SALE){
            $criteria->compare('t.status', STATUS_ACTIVE);
        }
        // dùng cho lấy sale mối của thống kê  daily sản lượng http://daukhimiennam.com/admin/gasreports/output_daily
        if(isset($needMore['aUid'])){
            $criteria->addInCondition('t.id', $needMore['aUid']);
        }
        
        $criteria->order = "t.province_id asc, t.id asc";
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        
        $models = self::model()->findAll($criteria);
        $res=array();
        if(isset($needMore['only_id_model'])){
            // chỉ dùng để lấy id=>model, ko gom theo tỉnh, phục vụ cho 1 số trường hợp
            foreach ($models as $item){
                $res[$item->id] = $item;
            }
        }else{
            foreach ($models as $item){
                $res[$item->province_id][] = $item;
            }
        }
        return  $res;         
    }   	
	
    public static function getArrCustomerForImport()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', ROLE_CUSTOMER);        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'code_account','id');            
    }            
    
    public static function getSelectByRole($role_id=ROLE_AGENT)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);   
        GasAgentCustomer::initSessionAgent();
        $session=Yii::app()->session;
        // chỗ này không hiểu giới hạn cho những role nào?
        // May 22, 2014 trả lời câu hỏi trên: chỗ này là giới hạn cho tất cả các user, mỗi user dc quản lý 1 số dại lý
        // được nhập khi tạo user login
        if(isset($session['LIST_AGENT_OF_USER']) && count($session['LIST_AGENT_OF_USER'])){            
            $criteria->addInCondition('t.id', $session['LIST_AGENT_OF_USER']); 
        }
//        $criteria->order = "t.name_agent asc";
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = "t.province_id asc, t.id asc";
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','first_name');            
    }
    
    public static function getSelectByRoleFinal($role_id, $needMore=array())
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);   
        GasAgentCustomer::initSessionAgent();
        $session=Yii::app()->session;
        // chỗ này không hiểu giới hạn cho những role nào?
        // May 22, 2014 trả lời câu hỏi trên: chỗ này là giới hạn cho tất cả các user, mỗi user dc quản lý 1 số dại lý
        // được nhập khi tạo user login
        if(isset($session['LIST_AGENT_OF_USER']) && count($session['LIST_AGENT_OF_USER'])){            
            $criteria->addInCondition('t.id', $session['LIST_AGENT_OF_USER']); 
        }
       
        if(isset($needMore['gender'])){ // xem có lấy kho hay đại lý
            // vì hệ thống chia ra kho và đại lý, nên có chỗ chỉ lấy đại lý, không lấy kho
            if(is_array($needMore['gender'])){
                $criteria->addInCondition('t.gender', $needMore['gender']);
            }else{
                $criteria->compare('t.gender', $needMore['gender']);
            }
        }        
//        $criteria->order = "t.id desc";
        $criteria->order = "t.province_id asc, t.id asc";
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'].", t.province_id asc, t.id asc";
        }
            
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','first_name');
    }
    
        
	
    public static function getSelectByRoleNotRoleAgent($role_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);   
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = "t.name_agent asc";
//        GasAgentCustomer::initSessionAgent();
//        $session=Yii::app()->session;
//        if(isset($session['LIST_AGENT_OF_USER']) && count($session['LIST_AGENT_OF_USER'])){
//            $criteria->addInCondition('t.id', $session['LIST_AGENT_OF_USER']); 
//        }		
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','first_name');            
    }      
	
    /* dùng get data cho select nhân viên bảo trì hay kế toán của đại lý
    * với những nhân viên này dc thiết đặt cho từng đại lý
    * dùng trong form nhập liệu bảo trì KH
    * dùng trong form nhập liệu bảo trì KH
    @param: $agent_id: mã đại lý -- Sep 27, 2014 note lại, chỗ này có thể là mã của giám sát pttt, vì hàm này sẽ lấy ra những người trong đội của giám sát đó
    @param: $type_one_many: mã của One many: ONE_AGENT_MAINTAIN , ONE_AGENT_ACCOUNTING
    @param: $agent_id_extra: mã của One many cho truong hop admin edit bao tri, gioi han lai select theo agent id
    */
    public static function getSelectByRoleForAgent($agent_id, $type_one_many, $agent_id_extra='', $needMore=array())
    {
//        if(Yii::app()->user->role_id==ROLE_ADMIN || isset($needMore['get_all']))
        if(isset($needMore['get_all']))
            $listMany = GasOneMany::getArrOfManyIdByType($type_one_many, $agent_id_extra);
        else
            $listMany = GasOneMany::getArrOfManyId($agent_id, $type_one_many);
        if(empty($agent_id) && isset($needMore['form_create']) ) return array();
        $criteria = new CDbCriteria;
        $criteria->addInCondition('t.id', $listMany); 
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = "t.code_bussiness asc";
        if(isset($needMore['status']))
                $criteria->compare("t.status",$needMore['status']);
        $models = self::model()->findAll($criteria);
        /* if($type_one_many == ONE_MONITORING_MARKET_DEVELOPMENT)
        var_dump($listMany); */
        $aRes=array();
//        if(isset($needMore['get_all'])){
        if(count($models)){
            foreach($models as $item){
                $aRes[$item->id]=$item->code_bussiness."-$item->first_name";
            }
        }
            return $aRes;
//        }
        
//        return  CHtml::listData($models,'id','first_name');            
    }  
	
	/* dùng get data cho thống kê bảo trì theo nhân viên bảo trì hay kế toán của đại lý
	* với những nhân viên này dc thiết đặt cho từng đại lý
	* dùng trong http://localhost/gas/admin/gasmaintain/Statistic_maintain
	@param: $type_one_many: mã của One many: ONE_AGENT_MAINTAIN , ONE_AGENT_ACCOUNTING
	@param: $AGENT_MODEL: array all agent array[agent_id]=>modelUser
	@return: array[agent_id]=>array model User
	*/	
    public static function getSelectEmployeeForAgent($type_one_many, $AGENT_MODEL)
    {
        $aRes=array();
        foreach($AGENT_MODEL as $agent_id=>$mUser){
                $listMany = GasOneMany::getArrOfManyId($agent_id, $type_one_many);        
                $criteria = new CDbCriteria;
                $criteria->addInCondition('t.id', $listMany); 
                $criteria->order = "t.first_name asc";
                $models = self::model()->findAll($criteria);
                if(count($models)>0){
                    $temp=array();
                    $temp['mAgent'] = $mUser;
                    $temp['mEmployee']= $models;
                    $aRes[$agent_id] = $temp;
                }
        }
        return  $aRes;
    }  
		
	
    public static function getArrUserForImport($role_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', $role_id);        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'code_account','id');            
    }            
    	
	
    public static function getArrSaleIdForImport()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', ROLE_CUSTOMER);
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','sale_id');            
    }   
    
    public static function getArrPaymentDayOfCustomer()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', ROLE_CUSTOMER);        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','payment_day');            
    }            
    
    
    public static function getCodeAccount($pk){
        $model = self::model()->findByPk($pk);
        if($model && !empty($model->code_account))
            return $model->code_account;
        return 'HM';
    }
    
    public static function getCodeBussiness($pk){
        $model = self::model()->findByPk($pk);
        if($model && !empty($model->code_bussiness))
            return $model->code_bussiness;
        return 'HM';
    }


    public function beforeSave() {
        self::TrimSomeValue($this);
        if($this->isNewRecord){
            $this->created_date=date('Y-m-d H:i:s');
        }		
        MyFunctionCustom::buildAddressUser($this);
        
        if($this->role_id==ROLE_CUSTOMER && $this->type != CUSTOMER_TYPE_STORE_CARD){
            $this->first_name = trim(str_replace(range(0,9),'', $this->first_name));
            if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT){
                // cột area_code_id để xác định KH này là của đại lý nào
                // parent_id ở đây dc sửa là đại lý của user đang login ROLE_SUB_USER_AGENT
                // dùng cho KH bảo trì + kh PTTT + kh thẻ kho 
                $this->area_code_id = Yii::app()->user->parent_id;
            }
        }
        $this->name_agent = strtolower(MyFunctionCustom::getNameRemoveVietnamese($this->first_name));
        return parent::beforeSave();
    }
 
    public static function check_duplicate(){
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', ROLE_CUSTOMER);        
        $models = self::model()->findAll($criteria);
        $arr = CHtml::listData($models,'id','code_account');
		// $arr = array(1=>'1233',2=>'12334',3 =>'Hello' ,4=>'hello', 5=>'U');
		// Convert every value to uppercase, and remove duplicate values
		$withoutDuplicates = array_unique(array_map("strtoupper", $arr));
		// The difference in the original array, and the $withoutDuplicates array
		// will be the duplicate values
		$duplicates = array_diff($arr, $withoutDuplicates);	
		if(count($duplicates)>0){
			echo '<pre>';
			echo print_r($duplicates);
			echo '</pre >';		
		}
    }
 
	// ANH DUNG 11-23-2013 To get array[]=[mMonitor]=>objmonitor,[mEmployee]=>arrayObjEmployee
	// use for /admin/gasmaintain/statistic_market_development_by_month. but not use
    public static function getArrObjectMonitorAndMarketEmployee($arrayIdMonitor, $order='first_name')
    {	
		$aRes=array();
		$arrayIdMonitor = count($arrayIdMonitor)>0?$arrayIdMonitor:Users::getArrIdUserByRole(ROLE_MONITORING_MARKET_DEVELOPMENT);
		
		foreach($arrayIdMonitor as $key=>$monitor_id){
			$listMany = GasOneMany::getArrOfManyId($monitor_id, ONE_MONITORING_MARKET_DEVELOPMENT);        
			
			$criteria = new CDbCriteria;
			$criteria->addInCondition('t.id', $listMany); 
			$criteria->order = "t.$order asc";
			$models = self::model()->findAll($criteria);
			if(count($models)>0){
				$temp=array();
				$temp['mMonitor'] = Users::model()->findByPk($monitor_id);
				$temp['mEmployee']= $models;
				$aRes[$monitor_id] = $temp;
			}	
		}		
        return  $aRes;    	
    }  
 
	// ANH DUNG 11-23-2013 To get array[]=[mMonitor]=>objmonitor,[mEmployee]=>arrayObjEmployee
	// use for /admin/gasmaintain/statistic_market_development_by_month
    public static function getArrIdObjectMonitorAndMarketEmployee($arrayIdMonitor, $order='first_name')
    {	
		$aRes=array();
		$arrayIdMonitor = count($arrayIdMonitor)>0?$arrayIdMonitor:Users::getArrIdUserByRole(ROLE_MONITORING_MARKET_DEVELOPMENT);
		
		foreach($arrayIdMonitor as $key=>$monitor_id){
			$listMany = GasOneMany::getArrOfManyId($monitor_id, ONE_MONITORING_MARKET_DEVELOPMENT);        
			
			$criteria = new CDbCriteria;
			$criteria->addInCondition('t.id', $listMany); 
			$criteria->order = "t.$order asc";
			$models = self::model()->findAll($criteria);
			$aRes[$monitor_id] = Users::model()->findByPk($monitor_id);
			if(count($models)>0){
				foreach($models as $item)
					$aRes[$item->id] = $item;
			}	
		}		
        return  $aRes;    	
    }  
 
    /**
     * @Author: ANH DUNG 11-27-2013
     * @Todo: get model user by multi attributes
     * @Param: array $attr array([id]=>1, [email]=>'anhdung@anhdung.com',['role_id'=>1]) 
     * @Return: model user or null
     */
    public static function getByAttributes($attr)
    {
        $criteria=new CDbCriteria; 
        $mUser = new Users();
        $hasCompare=false;
        if(count($attr)>0){
            foreach($attr as $name_attr=>$value){
                if($mUser->hasAttribute($name_attr)){
                    $criteria->compare("t.$name_attr", $value);   
                    $hasCompare=true;
                }
            }
            if($hasCompare)
                return self::model()->find($criteria);
        }        
        return null;
    } 
	
    public function beforeValidate() {
        self::TrimSomeValue($this);
        return parent::beforeValidate();
    }
    
    public static function TrimSomeValue($model){
        $model->first_name = trim($model->first_name);
        $model->username = trim($model->username);
        $model->email = trim($model->email);
        $model->phone = trim($model->phone);
        $model->phone = trim($model->phone,'-');
        $model->phone = trim($model->phone,'.');
    }
        
    /**
     * @Author: ANH DUNG Feb 22, 2014
     * @Todo: get array customer id cho vào incondition theo loại KH bình bò OR Kh mối
     * dùng cho thống kê daily Statistic::Output_daily()
     * @Param: $type là loại KH bò hay mối, nếu = 0 là lấy hết cả bò lẫn mối
     * @Return: array id customer
     */    
    public static function getCustomerBinhBoMoi($type=0)
    {
        $criteria=new CDbCriteria; 
        $criteria->compare("t.type", CUSTOMER_TYPE_STORE_CARD);   
        if($type){
            $criteria->compare("t.is_maintain", $type);   
        }
        return  CHtml::listData(self::model()->findAll($criteria),'id','id');   
    }  
    
    /**
     * @Author: ANH DUNG Mar 26, 2014
     * @Todo: get array customer id cho vào incondition theo sale
     * dùng cho thống kê daily Statistic::getOutputDailyForTarget()
     * @Param: $sale_id là 1 id hoặc array id
     * @Return: array id customer
     */    
    public static function getCustomerBySale($sale_id)
    {
        if(empty($sale_id))
            return array();
        $criteria=new CDbCriteria; 
        $criteria->compare("t.type", CUSTOMER_TYPE_STORE_CARD);   
        if(is_array($sale_id)){
            $criteria->addInCondition("t.sale_id", $sale_id);   
        }else{
            $criteria->compare("t.sale_id", $sale_id);   
        }
            
        return  CHtml::listData(self::model()->findAll($criteria),'id','id');   
    }     
    
    /**
     * @Author: ANH DUNG Mar 26, 2014
     * @Todo: get array customer id cho vào incondition theo đại lý
     * dùng cho thống kê daily Statistic::getOutputDailyForTarget()
     * @Param: $agent_id là 1 id hoặc array id
     * @Param: $type là loại KH bò hay mối, nếu = 0 là lấy hết cả bò lẫn mối
     * @Return: array id customer
     */    
    public static function getCustomerBySaleAndType($sale_id, $type)
    {
        if(empty($sale_id))
            return array();
        $criteria=new CDbCriteria; 
        $criteria->compare("t.type", CUSTOMER_TYPE_STORE_CARD);   
        if(is_array($sale_id)){
            $criteria->addInCondition("t.sale_id", $sale_id);   
        }else{
            $criteria->compare("t.sale_id", $sale_id);
        }
        $criteria->compare("t.is_maintain", $type);
            
        return  CHtml::listData(self::model()->findAll($criteria),'id','id');   
    }     
    
    /**
     * @Author: ANH DUNG Mar 26, 2014
     * @Todo: get array customer id cho vào incondition theo đại lý
     * dùng cho thống kê daily Statistic::getOutputDailyForTarget()
     * @Param: $agent_id là 1 id hoặc array id
     * @Param: $type là loại KH bò hay mối, nếu = 0 là lấy hết cả bò lẫn mối
     * @Return: array id customer
     */    
    public static function getCustomerByAgentAndType($agent_id, $type)
    {
        if(empty($agent_id))
            return array();
        $criteria=new CDbCriteria; 
        $criteria->compare("t.type", CUSTOMER_TYPE_STORE_CARD);   
        if(is_array($agent_id)){
            $criteria->addInCondition("t.area_code_id", $agent_id);   
        }else{
            $criteria->compare("t.area_code_id", $agent_id);   
        }
        $criteria->compare("t.is_maintain", $type);
            
        return  CHtml::listData(self::model()->findAll($criteria),'id','id');   
    }     
    
    
    /**
     * @Author: ANH DUNG Apr 03, 2014
     * @Todo: cập nhật  giá trị 0,1 cột first_char, cập nhật cho role sub user của đại lý
     * @Param: $user_id is agent id
     */
    public static function updateFirstChar($user_id, $value){
        $criteria=new CDbCriteria; 
        $criteria->compare("t.parent_id", $user_id);
        $criteria->compare("t.role_id", ROLE_SUB_USER_AGENT);
        $models = Users::model()->findAll($criteria);
        if($models){
            foreach($models as $model){
                $model->first_char = $value;
                $model->update(array('first_char'));
            }
        }
    }
    
    
    /**
     * @Author: ANH DUNG Apr 04, 2014
     * @Todo: LẤY mảng model user dựa vào mảng id user
     * @Param: array id=>model. $aId có thể là array(), khi đó sẽ return về array empty
     */
    public static function getArrayModelByArrayId($aId){
        $criteria=new CDbCriteria; 
        $criteria->addInCondition("t.id", $aId);           
        $aRes = array();
        $models = Users::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item){
                $aRes[$item->id] = $item;
            }
        }
        return $aRes;
    }
    
    // Now  20, 2014
    public static function getOnlyArrayModelByArrayId($aId, $needMore=array()){
        $criteria=new CDbCriteria; 
        $criteria->addInCondition("t.id", $aId);
        if(isset($needMore['order'])){            
            $criteria->order = $needMore['order'];
        }
        
        return Users::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Apr 25, 2014
     * @Todo: cập nhật loại KH cho các table liên quan nều bị change loại KH
     * @Param: $mUser model user
     */
    public static function changeTypeCustomer($mUser){
        // 1. model GasCashBookDetail 
        GasCashBookDetail::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
                    "`customer_id`=$mUser->id");
        // 2. model GasOrdersDetail
        GasOrdersDetail::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
                    "`customer_id`=$mUser->id");
        // 3. model GasRemain
        GasRemain::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
                    "`customer_id`=$mUser->id");
        // 4. model GasStoreCardDetail
        GasStoreCardDetail::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
                    "`customer_id`=$mUser->id");
    }
    
    /*
     * @Author: ANH DUNG Dec 28, 2015
     * @Todo: cập nhật loại Sale ID cho các table liên quan nều bị change Sale
     * @Param: $mUser model user
     */
    public function changeSale(){
        // 1. model GasIssueTickets 
        GasIssueTickets::model()->updateAll(array('sale_id'=>$this->sale_id),
                    "`customer_id`=$this->id");
//        // 2. model GasOrdersDetail
//        GasOrdersDetail::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
//                    "`customer_id`=$mUser->id");
//        // 3. model GasRemain
//        GasRemain::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
//                    "`customer_id`=$mUser->id");
//        // 4. model GasStoreCardDetail
//        GasStoreCardDetail::model()->updateAll(array('type_customer'=>$mUser->is_maintain),
//                    "`customer_id`=$mUser->id");
    }
    
    
    public static function getListOptions($aUid, $needMore=array())
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('t.id',$aUid);
        if(!isset($needMore['get_all'])){
            $criteria->compare('t.status', STATUS_ACTIVE);
        }
        $criteria->order = "t.name_agent asc";
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','first_name');
    } 
    
    /**
     * @Author: ANH DUNG Aug 08, 2014
     * @Todo: cập nhật lần mua hàng mới nhất của KH bò mối
     * @Param: $uid, $date 
     * @Return: full name with salution of user last_purchase
     */
    public static function UpdateLastPurchase($uid, $date){
        if(empty($uid)) return;
        self::model()->updateByPk($uid, array('last_purchase'=>$date));
    }
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: save sale, cho điều phối tạo sale
     * @Param: $model model 
     */
    public static function SaveSale($model){
        $aAttributes = array(
           'first_name','phone'
        );
        MyFormat::RemoveScriptAndBadCharOfModelField($model, $aAttributes, array('RemoveScript'=>1));
        $model->status = STATUS_ACTIVE;
        $model->role_id = ROLE_SALE;
        $model->created_by = Yii::app()->user->id;
        $model->application_id = BE;
        $model->username = '';
        $model->code_account = MyFunctionCustom::getNextIdForEmployee('Users');
        $model->code_bussiness = MyFunctionCustom::getCodeBusinessEmployee($model->first_name, array());
        $model->save();
    }
    
    // format shot name for report /admin/gasreports/inventory
    public static function formatShorNameAgent($ListOptionAgent){
        $aRes = array();
        $session=Yii::app()->session;
        if(!isset($session['SHORT_NAME_AGENT'])){
//        if(1){
            foreach($ListOptionAgent as $agent_id=>$agent_name): 
                $agent_name = str_replace(array("Đại lý","Đại Lý"), '', $agent_name);
                $agent_name = str_replace("Cửa hàng", 'CH', $agent_name);
                $temp = explode(" ", trim($agent_name));
                if(count($temp)>2){
                    $agent_name='';
                    foreach($temp as $key=>$item){
                        if($key==1)
                            $agent_name.=" $item<br/>";
                        else
                            $agent_name.=" $item";
                    }
                }
                $aRes[$agent_id] = trim($agent_name);
            endforeach;
            $session['SHORT_NAME_AGENT'] = $aRes;
        }
        return $session['SHORT_NAME_AGENT'];
    }
    
    /** sử dụng ở chỗ:
     * 1/ admin/gasreports/output_customer
     * 2/ cập nhật sau.... nếu có sử dụng ở chỗ khác
     * @Author: ANH DUNG Aug 16, 2014
     * @Todo: Users::InitSessionModelCustomer( array('arr_role_id' => array(ROLE_AGENT, ROLE_SALE)));
     * khởi tạo session model của hơn 2000 kh bò mối + đại lý + sale
     * @Param: $needMore
     */
    public static function InitSessionModelCustomer($needMore=array()){
        $session=Yii::app()->session;
        if(!isset($session['SESSION_MODEL_CUSTOMER_SALE_AGENT'])){
            $criteria=new CDbCriteria; 
            if(!isset($needMore['arr_role_id'])){
                $criteria->addInCondition('t.role_id', ROLE_CUSTOMER);
                $criteria->compare('t.type', CUSTOMER_TYPE_STORE_CARD);
            }else{
                $listRole = implode(',', $needMore['arr_role_id']);
                
                // CLOSE ON MAR 18, 2015 - lại chuyển  sang không close nữa
                $criteria->addCondition(" ( t.role_id=".ROLE_CUSTOMER." AND t.type=".CUSTOMER_TYPE_STORE_CARD." ) OR "
                        . " t.role_id IN ($listRole) ");
                /** @ITEM MAR182015 
                 * fix ON MAR 18, 2015 
                 *  nếu Kh lên đến 10 hay 15 ngàn thì liệu đưa hết vào session như bên trên liệu có dc ko
                 *  còn dùng theo kiểu (fix) bên dưới $session['ARRAY_OUTPUT_CUSTOMER_ID'] thì cảm giác có vẻ chậm hơn
                 *  
                 */
//                if(isset($session['ARRAY_OUTPUT_CUSTOMER_ID'])){
//                    $criteria->addCondition(" t.id IN (".  implode(',', $session['ARRAY_OUTPUT_CUSTOMER_ID'] ).") OR "
//                        . " t.role_id IN ($listRole) ");
//                }else{
//                    return ;
//                }

            }
            // có thể chỗ này add thêm điều kiện last purchase, hay loại KH bò mối gì đó, tùy theo perform của request
            $aRes = array();
            $models = Users::model()->findAll($criteria);
            foreach($models as $item){
                $aRes[$item->id]['first_name'] = $item->first_name;
                $aRes[$item->id]['address'] = $item->address;
            }
            $session['SESSION_MODEL_CUSTOMER_SALE_AGENT'] = $aRes;
        }
        return $session['SESSION_MODEL_CUSTOMER_SALE_AGENT'];
    }
    
    public static function ResetPassword(&$model){
        $model->temp_password = ActiveRecord::randString();
        $model->password_hash = md5($model->temp_password);
        $model->update(array('temp_password', 'password_hash'));
    }
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: get list user có mail và active
     * @return array $model
     */
    public static function GetListUserMail($needMore = array() ) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', STATUS_ACTIVE); 
        if(isset($needMore['aRoleId'])){
            $criteria->addInCondition('t.role_id', $needMore['aRoleId']);
        }
        if(isset($needMore['aUidNotReset'])){// loại những user không phải reset pass ra
            $criteria->addNotInCondition('t.id', $needMore['aUidNotReset']);
        }
        if(isset($needMore['aUid'])){ // Sep 23, 2015 chuyển sang search uid
            $criteria->addInCondition('t.id', $needMore['aUid']);
        }
        
        // không nên có đk này,vì sẽ xử lý user login 2 chỗ bị đẩy ra, khi đó sẽ inactive user và send mail reset pass
        $criteria->addCondition('t.email <> "" AND t.email IS NOT NULL ');
//        $criteria->addInCondition('t.id', $aUid, 'OR'); // for test send mail
        return Users::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Now 21, 2014
     * @Todo: tìm những user có sale, lấy mảng id user theo 1 nhóm role dùng cho chtml, 
     * @Param: $aRoleId  array role
     */
    public static function getArrIdUserByArrayRoleHaveSale($aRoleId, $needMore=array())
    {
        $criteria = new CDbCriteria;        
        $criteria->addInCondition('t.role_id', $aRoleId);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->addCondition("t.sale_id<>'' AND t.sale_id IS NOT NULL ");
        if(isset($needMore['order'])){
            $criteria->order = $needMore['order'];
        }
        $models = self::model()->findAll($criteria);
        $aRes = array();
        foreach ( $models  as $item ){
            $aRes[$item->province_id]['LIST_ID'][] = $item->sale_id;
            $aRes[$item->province_id]['LIST_MODEL'][] = $item;
        }
        // to be continue
        return $aRes;
    }    
    
    /**
     * @Author: ANH DUNG Dec 27, 2014
     * @Todo: get agent_id ( is area_code_id) của Kh bò mối
     * @Param: $customer_id
     */
    public static function GetAgentIdOfCustomer($customer_id) {
        $model = self::model()->findByPk($customer_id);
        if($model){
            return $model->area_code_id;
        }
        return '';
    }
    
    
    /**
     * @Author: ANH DUNG Dec 30, 2014
     * @Todo: get array model user by array role id
     * @Param: $aRoleId
     */
    public static function getFindAllByArrayRole($aRoleId)
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('t.role_id', $aRoleId);
        $criteria->compare('t.status', STATUS_ACTIVE);
        return self::model()->findAll($criteria);
    } 
    
    /**
     * @Author: ANH DUNG Dec 30, 2014
     * @Todo: get info user by field_name
     * @Param: $mUser
     */
    public static function GetInfoField($mUser, $field_name) {
        if($mUser){
            return $mUser->$field_name;
        }
        return "";
    }
    
    /**
     * @Author: ANH DUNG Jan 17, 2015
     * @Todo: cập nhật loại sale cho 1 số table khi change type
     * @Param: $model model Users
     */
    public static function UpdateSaleType($model) {
//     1. to day only for GasBussinessContract Jan 17, 2015
        // 2. user sale
        $type = GasBussinessContract::TYPE_SALE_MOI_CHUYEN_VIEN;
        $type_customer = STORE_CARD_KH_MOI;
        if( $model->gender == Users::SALE_BO){
            $type = GasBussinessContract::TYPE_SALE_BO;
            $type_customer = STORE_CARD_KH_BINH_BO;
        }elseif($model->gender == Users::SALE_MOI){
            $type = GasBussinessContract::TYPE_SALE_MOI_NORMAL;
        }
        
        GasBussinessContract::model()->updateAll(array('type'=>$type,'type_customer'=>$type_customer),
                    "`uid_login`=$model->id");
//                    "`customer_id`=$item->id AND date_delivery>='2014-10-01' ");
    }
    
    /**
     * @Author: ANH DUNG Feb 13, 2015
     * @Todo: reset all ngày cập nhật sổ quỹ - thẻ kho của All đại lý về 1 giá trị
     */
    public static function ResetAllDateUpdateStoreCard() {
        if( isset($_GET['reset_date']) ){
            $reset_date = (int)$_GET['reset_date'];
            $criteria = new CDbCriteria();
            $criteria->compare('role_id', ROLE_AGENT);
//            $models = Users::model()->findAll($criteria);
//            echo '<pre>';
//            print_r(count($models));
//            echo '<pre>';
//            exit;
            
            Users::model()->updateAll(array('payment_day'=>$reset_date),
                    $criteria);
        }
    }
    
    
    /**
     * @Author: ANH DUNG Mar 15, 2015
     * @Todo: init session Chtml::listdata(id=>name) of nhân viên PTTT
     * khởi tạo kiểu này để trong grid sẽ không phải query nhiều lần
     * @param: $role_id = ROLE_EMPLOYEE_MARKET_DEVELOPMENT
     */
    public static function InitSessionNameUserByRole($role_id) {
        $session=Yii::app()->session;
        if(!isset($session['SESSION_LIST_NAME_BY_ROLE'])){
            $criteria=new CDbCriteria; 
            $criteria->compare('t.role_id', $role_id);
            $aRes = array();
            $models = Users::model()->findAll($criteria);
            foreach($models as $item){
                $aRes[$item->id] = $item->first_name;
            }
            $session['SESSION_LIST_NAME_BY_ROLE'] = $aRes;
        }
        return $session['SESSION_LIST_NAME_BY_ROLE'];
    }
    
    
    /**
     * @Author: ANH DUNG Apr 03, 2015
     * @Todo: search khách hàng không lấy hàng từ 15 đến 30 ngày
     */
    public function searchBuy15_30(){
        $criteria=new CDbCriteria;
        $today = date("Y-m-d");
        $date_to = MyFormat::modifyDays($today, 15, '-');
        $date_from = MyFormat::modifyDays($today, 30, '-');
        $criteria->addBetweenCondition("t.last_purchase",$date_from,$date_to);
        
        self::AddCriteriaSame($this, $criteria);

        $sort = new CSort();
        $sort->attributes = array(
            'code_account'=>'code_account',
            'code_bussiness'=>'code_bussiness',
            'first_name'=>'first_name',
            'created_date'=>'created_date',
            'is_maintain'=>'is_maintain',
            'last_purchase'=>'last_purchase',
        );
        $sort->defaultOrder = 't.last_purchase DESC';

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort' => $sort,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Apr 03, 2015
     * @Todo: search khách hàng không lấy hàng từ 31 đến 45 ngày
     */
    public function searchBuy31_45(){
        $criteria=new CDbCriteria;
        $today = date("Y-m-d");
        $date_to = MyFormat::modifyDays($today, 31, '-');
        $date_from = MyFormat::modifyDays($today, 45, '-');
        $criteria->addBetweenCondition("t.last_purchase",$date_from,$date_to);
        
        self::AddCriteriaSame($this, $criteria);

        $sort = new CSort();
        $sort->attributes = array(
            'code_account'=>'code_account',
            'code_bussiness'=>'code_bussiness',
            'first_name'=>'first_name',
            'created_date'=>'created_date',
            'is_maintain'=>'is_maintain',
            'last_purchase'=>'last_purchase',
        );
        $sort->defaultOrder = 't.last_purchase DESC';

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort' => $sort,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Apr 03, 2015
     * @Todo: search khách hàng không lấy hàng từ trên 45
     */
    public function searchBuyAbove45(){
        $criteria=new CDbCriteria;
        $today = date("Y-m-d");
        $date_from = MyFormat::modifyDays($today, 46, '-');
        $criteria->addCondition("t.last_purchase<='$date_from'");
        // last_purchase có thể null cho 1 số KH chưa có xuất bán lần nào, có thể do tạo lỗi hoặc do chỉ có nhập từ KH đó
//        $criteria->addCondition("t.last_purchase<='$date_from' OR t.last_purchase IS NULL");
//        $criteria->addCondition('t.last_purchase <> "" AND t.last_purchase IS NOT NULL ');
        
        self::AddCriteriaSame($this, $criteria);

        $sort = new CSort();
        $sort->attributes = array(
            'code_account'=>'code_account',
            'code_bussiness'=>'code_bussiness',
            'first_name'=>'first_name',
            'created_date'=>'created_date',
            'is_maintain'=>'is_maintain',
            'last_purchase'=>'last_purchase',
        );
        $sort->defaultOrder = 't.last_purchase DESC';

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort' => $sort,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Apr 03, 2015
     * @Todo: add 1 số điều kiện chung cho 3 hàm search table
     */
    public static function AddCriteriaSame($model, &$criteria){
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        $criteria->compare('t.id', $model->customer_id);
        $criteria->compare('t.sale_id', $model->sale_id);
        $criteria->compare('t.area_code_id', $model->agent_id_search);
        $criteria->compare('t.is_maintain', $model->is_maintain);
        $criteria->compare('t.role_id',$model->role_id);
        $criteria->compare('t.type',$model->type);
        $criteria->compare('t.channel_id', Users::CON_LAY_HANG);
        $aTypeBoMoi = array(STORE_CARD_KH_BINH_BO, STORE_CARD_KH_MOI);
        $criteria->addInCondition( 't.is_maintain', $aTypeBoMoi);
    }
    
    /**
     * @Author: ANH DUNG Apr 10, 2015
     * @Todo: dùng cột address_temp để lưu json cho 1 số thông tin
     * hiện tại bây giờ là mới dùng cho đại lý, để lưu thông tin 
     * ngày nhập gas dư và thẻ kho mới nhất
     * @Param: $uId id user
     * @Param: $key ex: date_last_gas_remain, date_last_storecard
     * @Param: $value ex: 2015-10-04
     */
    public static function UpdateKeyInfo($mUser, $key, $value) {
        $json = json_decode($mUser->address_temp, true);
        if(!is_array($json)){
            $json = array();
        }
        $json[$key]=$value;
        $mUser->address_temp = json_encode($json);
        $mUser->update(array('address_temp'));
    }
    
    /**
     * @Author: ANH DUNG Apr 10, 2015
     */
    public static function GetKeyInfo($mUser, $key) {
        $json = json_decode($mUser->address_temp, true);
        if(isset($json[$key])){
            return $json[$key];
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Apr 10, 2015
     */
    public static function GetKeyInfoById($uId, $key) {
        $mUser = self::model()->findByPk($uId);
        return self::GetKeyInfo($mUser, $key);
    }
    
    /**
     * @Author: ANH DUNG Apr 15, 2015
     * @Todo: get type customer: bo, moi, xe rao ...
     * @Param: $model model Users
     */
    public static function GetTypeCustomer($model) {
        if(is_null($model)) return '';
        return $model->is_maintain;
    }
    
    /**
     * @Author: ANH DUNG Apr 15, 2015
     * @Todo: get sale id of customer: bo, moi, xe rao ...
     * @Param: $model model Users
     */
    public static function GetSaleIdOfCustomer($model) {
        if(is_null($model)) return '';
        return $model->sale_id;
    }
    
        /**
     * @Author: ANH DUNG Apr 15, 2015
     * @Todo: get type sale
     * @Param: $model model Users
     */
    public static function GetTypeSale($model) {
        if(is_null($model)) return '';
        return $model->gender;
    }
    
    public static function GetAgentIdOfCustomerByModel($model) {
        if(is_null($model)) return '';
        return $model->area_code_id;
    }
    
    public static function GetAddressUser($model) {
        if(is_null($model)) return '';
        return $model->address;
    }
    
    /**
     * @Author: ANH DUNG Apr 22, 2015
     * @Todo: get id province_id id tỉnh của đại lý
     * @Param: $id agent hoặc bất kỳ user nào, phục vụ cho báo cáo của thẻ kho, tăng giảm sản lương theo tỉnh
     */
    public static function GetProvinceId($id) {
        $model = self::model()->findByPk($id);
        if($model){
            return $model->province_id;
        }
        return 0;
    }
    
    /**
     * @Author: ANH DUNG May 27, 2015
     * @Todo: load model user ref to model User
     */
    public function LoadUsersRef() {        
        if($this->rUsersRef){
            $this->mUsersRef = $this->rUsersRef;
        }else{
            $this->mUsersRef = new UsersRef();
            $this->mUsersRef->user_id = $this->id; 
        }
        $this->mUsersRef->getMapFieldContact();
    }
    
    /**
     * @Author: ANH DUNG Sep 02, 2015
     * @Todo: load model user ref to model User
     */
    public function LoadUsersRefImageSign() {        
        if($this->rUsersRefProfile){
            $this->mUsersRef = $this->rUsersRefProfile;
        }else{
            $this->mUsersRef = new UsersRef();
            $this->mUsersRef->user_id = $this->id; 
            $this->mUsersRef->type = UsersRef::TYPE_USER_PROFILE; 
        }
    }
    
    /**
     * @Author: ANH DUNG May 27, 2015
     * @Todo: update model user ref
     */
    public function SaveUsersRef() {
        $this->mUsersRef->setFieldContact();
        if(is_null($this->mUsersRef->id)){
            if(trim($this->mUsersRef->reason_leave) != '' || trim($this->mUsersRef->contact_person) != ''){
                $this->mUsersRef->save();
            }
        }else{
            $this->mUsersRef->update();
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 29, 2015
     * @Todo: get field of UserRef
     * @Param: $field_name
     */
    public function getUserRefField($field_name) {
        $mUserRef = $this->rUsersRef;
        if($mUserRef){
            if( in_array($field_name, $mUserRef->ARR_FIELD_CONTACT)){
                return $mUserRef->getFieldContact($field_name);
            }
            return $mUserRef->$field_name;
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG May 27, 2015
     * @Todo: update khong lay hang
     */
    public function UpdateKhongLayHang() {
        if($this->role_id == ROLE_CUSTOMER && $this->type == CUSTOMER_TYPE_STORE_CARD){
            $this->channel_id = Users::KHONG_LAY_HANG;
            $this->update(array('channel_id'));
        }
    }
    
    public function getCustomerReasonLeave() {
        if($this->rUsersRef){
            return $this->rUsersRef->getReasonLeave();
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Jun 09, 2015
     * @Todo: update back lai lay hang
     * tu dong cap nhat lai trang thai lay hang khi nhap the kho
     */
    public static function UpdateBackLayHang($id) {
        $model = Users::model()->findByPk($id);
        if($model){
            $model->channel_id = Users::CON_LAY_HANG;
            $model->update(array('channel_id'));
        }
    }
    
    /** cái này chắc chỉ dùng cho dc bên support customer
     * @Author: ANH DUNG Sep 23, 2015
     * @Todo: get model sub user agent by agent id
     * @param array $agent_id chuyển sang chọn nhiều người thực hiện
     * vì khi lưu xuống db nó sẽ là json
     */
    public static function getModelSubUserAgentByAgentId($agent_id) {
        if(empty($agent_id) || (is_array($agent_id) && count($agent_id)<1 )){
            return array();
        }
        $listModelUser = self::getOnlyArrayModelByArrayId($agent_id);
        $aRes = array();
        foreach($listModelUser as $mUser){
            if($mUser->role_id == ROLE_AGENT){
                $aModelUser = $mUser->getModelSubAgent();
                foreach($aModelUser as $item){
                    $aRes[] = $item;
                }
            }else{
                $aRes[] = $mUser;
            }
        }
        return $aRes;
    }
    
    /**
     * @Author: ANH DUNG Sep 23, 2015
     * @Todo: get list model sub agent by $agent_id
     * @Param: $agent_id id agent
     */
    public function getModelSubAgent() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.role_id', ROLE_SUB_USER_AGENT);
        $criteria->compare('t.parent_id', $this->id);
        return self::model()->findAll($criteria);
    }

    /**
     * @Author: ANH DUNG Sep 19, 2015
     * @Todo: something
     * @Param: $model
     */
    public function getNameWithRole() {
        if(isset(Yii::app()->session)){
            $session=Yii::app()->session;
            $role_name = $session['ROLE_NAME_USER'][$this->role_id];
        }else{
            $role_name = Roles::model()->findByPk($this->role_id)->role_name;
        }
        
        return $this->first_name." - $role_name";
    }
    
    /**
     * @Author: ANH DUNG Oct 09, 2015
     * @Todo: API find user login with email - api login app login
     * @Param: $email
     */
    public static function ApiGetUserLogin($username) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.username', $username);
        $criteria->addInCondition('t.role_id', Users::$API_ROLE_LOGIN);
        return self::model()->find($criteria);
    }
    public static $API_ROLE_LOGIN = array(ROLE_E_MAINTAIN, ROLE_DIEU_PHOI, ROLE_CUSTOMER, ROLE_HEAD_OF_MAINTAIN, 
        ROLE_SALE, ROLE_HEAD_GAS_BO, ROLE_HEAD_GAS_MOI, ROLE_DIRECTOR_BUSSINESS, ROLE_DIRECTOR, ROLE_CHIEF_MONITOR, ROLE_MONITOR_AGENT,
        ROLE_AUDIT, ROLE_ACCOUNTING);
    
    /**
     * @Author: ANH DUNG Oct 09, 2015
     */
    public function getFullName() {
        return $this->first_name; 
    }
    public function getEmail() {
        return $this->email; 
    }
    public function getPhone() {
        return $this->phone; 
    }
    public function getAddress() {
        return $this->address; 
    }
    public function getInfoLoginMember() {
        $res = '';
        if(!empty($this->email)){
            $res .= $this->email."<br>"; 
        }
        if(!empty($this->username)){
            $res .= "<b>Username:</b> ".$this->username."<br>"; 
        }
        if(!empty($this->temp_password)){
            $res .= "<b>Pass:</b> ".$this->temp_password."<br>"; 
        }
        if(!empty($this->phone)){
            $res .= "<b>Phone:</b> ".$this->phone.""; 
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Dec 04, 2015
     * @Todo: 
     */
    public static function getDataAutocomplete($term, $cRole, $cUid) {
        $criteria = new CDbCriteria();
//            $criteria->addCondition(" ( t.role_id=".ROLE_CUSTOMER." AND t.type=".CUSTOMER_TYPE_STORE_CARD." OR t.role_id=".ROLE_AGENT. ") "); 
        $criteria->addCondition(" t.role_id IN ('".ROLE_CUSTOMER."', '".ROLE_AGENT."')"); 
        $criteria->addSearchCondition('t.address_vi', $term, true); // true ==> LIKE '%...%'
        $aTypeNot = array(CUSTOMER_TYPE_MAINTAIN, CUSTOMER_TYPE_MARKET_DEVELOPMENT);
        $criteria->addNotInCondition( 't.type', $aTypeNot);
        $criteria->limit = 30;
//        if($cRole == ROLE_SALE || $cRole == ROLE_EMPLOYEE_MARKET_DEVELOPMENT){
//            $criteria->compare('t.sale_id', $cUid);
//        }// Close on Dec 24, 2015 search phản ánh sự việc thì không giới hạn KH
        return Users::model()->findAll($criteria);
    }
    
        
    public static function getChtmlByRoleAndField($role_id, $field_name1 = "id", $field_name2 = "first_name")
    {
        $criteria = new CDbCriteria;
        if(!empty($role_id))
            $criteria->compare('t.role_id', $role_id);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models, $field_name1, $field_name2);            
    }
    
    /**
     * @Author: ANH DUNG Dec 21, 2015
     * @Todo: get type customer text
     */
    public function getTypeCustomerText() {
        if(isset(CmsFormatter::$CUSTOMER_BO_MOI[$this->is_maintain])){
            return CmsFormatter::$CUSTOMER_BO_MOI[$this->is_maintain];
        }
        return "";
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: set không lấy hàng với những KH không lây hàng quá 60 ngày
     * @note: run OK on Dec 22, 2015 - done 1148 KH
     */
    public static function moveToKhongLayHang() {
        $criteria=new CDbCriteria;
        $criteria->addCondition("DATE_ADD(last_purchase, INTERVAL 60 DAY) < CURDATE() AND last_purchase IS NOT NULL ");
        $criteria->compare('channel_id', Users::CON_LAY_HANG);
        $aTypeBoMoi = array(STORE_CARD_KH_BINH_BO, STORE_CARD_KH_MOI);
        $criteria->addInCondition( 'is_maintain', $aTypeBoMoi);
        $aUpdate = array('channel_id' => Users::KHONG_LAY_HANG);
        $CountData = self::model()->count($criteria);
//        echo "Khong lay Hang: $CountData ----";
        self::model()->updateAll($aUpdate, $criteria);
        
        $ResultRun = "CRON chuyển KH sang trạng thái Không Lấy hàng moveToKhongLayHang : ".$CountData.' done ';
        if($CountData){
            Logger::WriteLog($ResultRun);
        }        
    }
    
//    $criteria->addCondition("t.last_purchase<='$date_from'");
}