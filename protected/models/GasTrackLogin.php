<?php

/**
 * This is the model class for table "{{_gas_track_login}}".
 *
 * The followings are the available columns in table '{{_gas_track_login}}':
 * @property string $id
 * @property string $uid_login
 * @property string $ip_address
 * @property string $country
 * @property string $description
 * @property string $created_date
 */
class GasTrackLogin extends CActiveRecord
{
    const TYPE_LOGIN = 1;
    const TYPE_ADMIN_INACTIVE = 2;
    const TYPE_TWO_LOGIN_SAME_TIME = 3;
    const TYPE_COOKIE = 4;
    public static $TYPE_TRACK = array(
        GasTrackLogin::TYPE_LOGIN => 'Login',
        GasTrackLogin::TYPE_ADMIN_INACTIVE => 'Admin Inactive',
        GasTrackLogin::TYPE_TWO_LOGIN_SAME_TIME => 'Login cùng tài khoản',
        GasTrackLogin::TYPE_COOKIE => 'Login by cookie',
    );
    
    public static $TYPE_RISK = array(
        GasTrackLogin::TYPE_ADMIN_INACTIVE,
        GasTrackLogin::TYPE_TWO_LOGIN_SAME_TIME,
    );
    
    public static $ARR_COUNTRY_LOGIN = array(
        'Vietnam'=>'Vietnam',
        'Other'=>'Other',
    );
    
    
    public $username;
    public $full_name;
    public $role_name;
    public $date_from;
    public $date_to;    
    public $autocomplete_name;
    public $admin_login;
    public $country_login;
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_gas_track_login}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('country_login,admin_login,role_name,type,country_detail,full_name,username,id, uid_login, ip_address, country, description, created_date', 'safe'),
            array('date_from,date_to', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            return array(
                'rUidLogin' => array(self::BELONGS_TO, 'Users', 'uid_login'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'uid_login' => 'Uid Login',
            'ip_address' => 'Ip Address',
            'country' => 'Country',
            'description' => 'Description',
            'created_date' => 'Ngày Login',
            'full_name' => 'Tên User',
            'date_from' => 'Từ Ngày',
            'date_to' => 'Đến Ngày',
            'role_name' => 'Chức Vụ',
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
        $criteria->compare('t.uid_login',$this->uid_login,true);
        $criteria->compare('t.ip_address', trim($this->ip_address),true);
        $criteria->compare('t.country', trim($this->country),true);
        $criteria->compare('t.description', trim($this->description),true);
        $criteria->compare('t.type',$this->type);
        if(!empty($this->created_date)){
            $this->created_date = MyFormat::dateDmyToYmdForAllIndexSearch($this->created_date);
            $criteria->compare('t.created_date',$this->created_date,true);
        }
        if(!empty($this->role_name)){
            $criteria->compare('rUidLogin.role_id',$this->role_name);
        }
        if($this->admin_login){
            $criteria->compare('t.role_id', ROLE_ADMIN);
        }
        if($this->country_login){
            if($this->country_login == 'Vietnam'){
                $criteria->compare('t.country', trim($this->country_login));
            }else{
                $criteria->addCondition('t.country<>"Vietnam"');
            }            
        }
        
        $date_from = '';
        $date_to = '';
        if(!empty($this->date_from)){
            $date_from = MyFormat::dateDmyToYmdForAllIndexSearch($this->date_from)." 00:00:00";
        }
        if(!empty($this->date_to)){
            $date_to = MyFormat::dateDmyToYmdForAllIndexSearch($this->date_to)." 23:59:59";
        }
        if(!empty($date_from) && empty($date_to))
                $criteria->addCondition("t.created_date>='$date_from'");
        if(empty($date_from) && !empty($date_to))
                $criteria->addCondition("t.created_date<='$date_to'");
        if(!empty($date_from) && !empty($date_to))
                $criteria->addBetweenCondition("t.created_date",$date_from,$date_to);
        
//        if(!empty($this->uid_login) || !empty($this->username) || !empty($this->full_name) || !empty($this->role_name) ){
            $criteria->with = array('rUidLogin');
//        }
        
        $sort = new CSort();
        $sort->attributes = array(
            'uid_login'=>'uid_login',
            'ip_address'=>'ip_address',
            'country'=>'country',
            'description'=>'description',
            'created_date'=>'created_date',
            'type'=>'type',
            'username'=>array(
                    'asc'=>'rUidLogin.username',
                    'desc'=>'rUidLogin.username DESC',
            ),      
            'full_name'=>array(
                    'asc'=>'rUidLogin.code_bussiness',
                    'desc'=>'rUidLogin.code_bussiness DESC',
            ),      
            'role_name'=>array(
                    'asc'=>'rUidLogin.role_id',
                    'desc'=>'rUidLogin.role_id DESC',
            ),      
        );    
        $sort->defaultOrder = 't.id desc';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => $sort,
            'pagination'=>array(
                'pageSize'=> 100,
            ),
        ));
    }

    public function defaultScope()
    {
        return array();
    }
    
    /**
     * @Author: ANH DUNG Aug 28, 2015
     * @Todo: save Only admin login by cookie 
     * @param: $type: const TYPE_LOGIN = 1; const TYPE_ADMIN_INACTIVE = 2;
     */
    public static function AdminLoginCookie($description){
        GasTrackLogin::SaveTrackLogin(self::TYPE_COOKIE, $description); // Aug 28, 2015
    }
    
    /**
     * @Author: ANH DUNG Aug 22, 2014
     * @Todo: save track user login
     * @param: $type: const TYPE_LOGIN = 1; const TYPE_ADMIN_INACTIVE = 2;
     */
    public static function SaveTrackLogin($type=1, $description=''){
        // http://www.yiiframework.com/extension/geoip/
        $model = new GasTrackLogin();
        $model->uid_login = Yii::app()->user->id;
        $model->role_id = Yii::app()->user->role_id;        
        $model->type = $type;
        $model->ip_address = MyFormat::getIpUser();
        $model->country = '';
        if( $model->ip_address != '::1' && $model->ip_address != '127.0.0.1'){
            $location = Yii::app()->geoip->lookupLocation($model->ip_address);
            if( !is_null($location) ){
                $model->country =  $location->countryName;
                $model->description =  $location->region." - $location->regionName - $location->city - PostalCode: $location->postalCode";
            }else{
                $model->country =  "Empty";
                $model->description = "Empty";
            }            
        }
        if($description != ''){
            $model->description = $description;
        }
        
        $model->save();
        /* Location attributes:
        $location->countryCode
        $location->countryCode3
        $location->countryName
        $location->region
        $location->regionName
        $location->city
        $location->postalCode
        $location->latitude
        $location->longitude
        $location->areaCode
        $location->dmaCode
         */
    }
    
    /**
     * @Author: ANH DUNG Aug 22, 2014
     * @Todo: cron clean track login
     */
    public static function CronCleanTrackLogin(){
        $days_keep_track_login = Yii::app()->setting->getItem('days_keep_track_login');
        $criteria = new CDbCriteria();
//        $criteria->addCondition("");
//        $criteria->addCondition("DATE_ADD(created_date,INTERVAL $days_keep_track_login DAY) < CURDATE()");
        $criteria->addCondition("DATE_ADD(created_date,INTERVAL $days_keep_track_login DAY) < CURDATE()");
//        echo $count = self::model()->count($criteria); die;
        self::model()->deleteAll($criteria);        
    }
    
    /**
     * @Author: ANH DUNG Sep 23, 2014
     * @Todo: delelogin of admin
     */
    public static function CleanAdminLogin() {
        if(isset($_GET['clean_admin'])){
            $criteria = new CDbCriteria();
            $criteria->compare('uid_login', 2);
            self::model()->deleteAll($criteria);
        }
    }
    
}