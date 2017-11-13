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
class Users extends _BaseModel
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
    array('password_confirm', 'compare', 'compareAttribute'=>'password_hash','on'=>'create_agent,update_agent,create_member,update_member'),
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

    array('email','email','on'=>'editAdmin,createAdmin'),
    array('name_agent, code_account, code_bussiness, address, province_id, channel_id,district_id,,storehouse_id,sale_id,payment_day', 'safe'),
    array('percent_target,beginning, parent_id', 'safe'),
    array('maintain_agent_id,is_maintain, agent_id_search', 'safe'),
    array('id, username, email, password_hash, temp_password, first_name, last_name, first_char, login_attemp, created_date, last_logged_in, ip_address, role_id, application_id, status, gender, phone, verify_code, area_code_id', 'safe'),
    array('house_numbers,street_id,address_vi,ward_id, type,address_temp,customer_id,assign_employee_sales', 'safe'),
    array('last_purchase', 'safe'),
                    
    );
}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rProvince' => array(self::BELONGS_TO, 'GasProvince', 'province_id'),
            'rDistrict' => array(self::BELONGS_TO, 'GasDistrict', 'district_id'),
            'rSale' => array(self::BELONGS_TO, 'Users', 'sale_id'),
            'rCustomer' => array(self::BELONGS_TO, 'Users', 'parent_id'),
//            'AgentCustomer' => array(self::HAS_MANY, 'GasAgentCustomer', 'agent_id'),
//            'CustomerAgent' => array(self::HAS_MANY, 'GasAgentCustomer', 'customer_id'),
//            'agentCustomerCount'=>array(self::STAT, 'GasAgentCustomer', 'agent_id'),
            'rWard' => array(self::BELONGS_TO, 'GasWard', 'ward_id'),
            'rStreet' => array(self::BELONGS_TO, 'GasStreet', 'street_id'),
            'rCreatedBy' => array(self::BELONGS_TO, 'Users', 'created_by'),

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
	
    public function search($criteria = NULL)
    {
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
    
    
    public function searchGasMember()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.username',$this->username,true);
        $criteria->compare('t.email',$this->email,true);
        $criteria->compare('t.address_vi',$this->first_name,true);
        $criteria->compare('t.code_account', trim($this->code_account),true);
        $criteria->compare('t.code_bussiness',trim($this->code_bussiness),true);                		
        if(isset($this->role_id) && trim($this->role_id)!=''){
            $criteria->compare('t.role_id',$this->role_id);
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
    
    
}