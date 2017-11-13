<?php

/**
 * This is the model class for table "{{_gas_schedule_sms}}".
 *
 * The followings are the available columns in table '{{_gas_schedule_sms}}':
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property string $obj_id
 * @property string $time_send
 * @property string $created_date
 * @property string $username
 * @property string $title
 * @property string $json_var
 * @property string $count_run
 * @property string $smsid
 * @property string $code_response
 * @property string $phone
 */
class GasScheduleSms extends CActiveRecord
{
//    const ApiKey = "B48C7FC3EA5B38E62AA66D218787DD"; // Dung
//    const SecrectKey = "8DE5CF5CC63D6E755A30DD3B01E9C3";
    
    const ApiKey = "31D1BA34A27FEC756DBC5D9816D101"; // Kien
    const SecrectKey = "F3EF34221C6A72CE62BC1E3364E62F";
    
    
    public $SERVICE_URI = "http://api.esms.vn/MainService.svc/xml/";
    
    const SEND_SMS_RANDOM_FAST = 7;
    const SEND_SMS_FIX = 6;
    const SEND_SMS_1900X = 4;

    const SMS_RESPONSE_SUCCESS = "100";
    const SMS_RESPONSE_UNKNOW = "99";
    const SMS_RESPONSE_LOGIN_FAIL = "101";
    const SMS_RESPONSE_ACCOUNT_LOCK = "102";
    const SMS_RESPONSE_NOT_ENOUGH_MONEY = "103";
    const SMS_RESPONSE_BRANDNAME_FAIL = "104";

    const SMS_STATUS_WAITING_VALID = 1;
    const SMS_STATUS_WAITING_SENT = 2;
    const SMS_STATUS_SENDING = 3;
    const SMS_STATUS_REJECT = 4;
    const SMS_STATUS_SENT = 5;
    const SMS_STATUS_DELETED = 6;
    
    // Jan 05, 2016
    const MAX_SEND = 20; // giới hạn max gửi 1 lần
    const MAX_COUNT_RUN = 1; // giới hạn max số lần gửi lại
    // tất cả sms sẽ đưa vào list chờ gửi hết, để không bị gửi sót cái nào, cac Type send
    const TYPE_UPHOLD = 1;

    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: insert to db
     * @Flow1: bao tri su co send SMS 
     * 1/ insert record to db 
     * 2/ cron send notify (every minutes) bình thường, send xong thì move notify sang history
     */
    public static function InsertRecord($user_id, $type, $obj_id, $time_send, $title, $json_var) {
//        return ;// only for test debug
        if(empty($time_send)){
            $time_send = date("Y-m-d H:i:s");
        }
        $mUser = Users::model()->findByPk($user_id);
        if(!$mUser || trim($mUser->phone) == "" || empty($mUser->phone) ){
            // kiểm tra user exists khong + co phone number khong
            // nếu chưa login = app thì sẽ không build notify
            return;
        }
        
        $model = new GasScheduleSms();
        $model->phone = $mUser->phone;
        $model->user_id = $user_id;
        $model->type = $type;
        $model->obj_id = $obj_id;
        $model->time_send = $time_send;
//        $model->title = $title;
        $model->title = trim(MyFunctionCustom::remove_vietnamese_accents($title));
        $model->username = $model->rUser ? $model->rUser->username : "";
        $model->json_var = json_encode($json_var);
        $model->save();
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: run cron notify SMS
     */
    public static function RunCron() {
        $from = time();
        $data = self::getDataCron();
        foreach($data as $mScheduleSms){
            switch ($mScheduleSms->type){
                case GasScheduleSms::TYPE_UPHOLD:
                    $mScheduleSms->sendSmsUphold();
                    break;
//                case GasScheduleNotify::UPHOLD_DINH_KY_1_DAY:
//                    self::HandleAlertDinhKy($mScheduleSms);
//                    break;
            }
        }
        $to = time();
        $second = $to-$from;
        $CountData = count($data);
        $ResultRun = "CRON Notify SMS: ".$CountData.' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes ';
        $ResultRun .= json_encode(CHtml::listData($data, "username", "phone"));
        if($CountData){
            Logger::WriteLog($ResultRun);
        }
    }

    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: get data thỏa mãn cron để send
     */
    public static function getDataCron() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.time_send <= NOW() AND t.count_run < ".self::MAX_COUNT_RUN);
        $criteria->order = "t.count_run ASC, t.id DESC";
        $criteria->limit = GasScheduleNotify::MAX_SEND;
        return self::model()->findAll($criteria);
    }

    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: send SMS 
     * @Param: string $resource : SendMultipleSMS_v3
     * http://api.esms.vn/MainService.svc/xml/SendMultipleSMS_v3
        ?Phone={Phone}&Content={Content}&ApiKey={ApiKey}&
         * SecretKey={SecretKey}&IsUnicode={IsUnicode}&
         * Brandnamme={BrandnameCode}&SmsType={SmsType}&RequestID={RequestID}
     */
    public function sendSmsUphold() {
        $this->setServiceUri('SendMultipleSMS_v3');
        $aParams = array(
            "Phone" => $this->phone,
            "Content" => urlencode($this->title),
            "ApiKey" => GasScheduleSms::ApiKey,
            "SecretKey" => GasScheduleSms::SecrectKey,
            "IsUnicode" => "false",
            "Brandnamme" => "",
            "SmsType" => GasScheduleSms::SEND_SMS_RANDOM_FAST,
            "RequestID" => $this->id,
        );
        $fields_string = "";
        $this->buildStringParam($aParams, $fields_string);
        
        $this->SERVICE_URI = $this->SERVICE_URI."?$fields_string";
//        echo '<pre>';
//        print_r($this->SERVICE_URI);
//        echo '</pre>';
//        die;
        $response = $this->MakeRequestGet();
        $this->updateSomeResponse($response);
        if(isset($response['CodeResult']) && $response['CodeResult'] == self::SMS_RESPONSE_SUCCESS){
            // move luôn sang history
            GasScheduleSmsHistory::InsertNew($this);
        }else{ }
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     */
    public function updateSomeResponse($response) {
        $this->count_run += 1;
        $aUpdate = array('count_run');
        if(isset($response['CodeResult'])){
            $this->code_response = $response['CodeResult'];
            $aUpdate[] = 'code_response';
        }
        if(isset($response['SMSID'])){
            $this->smsid = $response['SMSID'];
            $aUpdate[] = 'smsid';
        }
        $this->update($aUpdate);
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: 
     * @Param: $resource là GetBalance hoac: GetSmsStatus
     */
    public function setServiceUri($resource) {
        $this->SERVICE_URI .= $resource;
    }

    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: cộng số lần run của notify thêm 1
     */
    public function plusRun() {
        $this->count_run += 1;
        $this->update(array('count_run'));
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: make request send to server
     */
    public function MakeRequestGet(){
        //open connection
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL, $this->SERVICE_URI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
        $xml = simplexml_load_string($result); // xml response 
        $json = json_encode($xml);
        $aJson = json_decode($json,TRUE);
        return $aJson;
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: make request send to server
     */
    public function MakeRequestPost($json_data){
        //set POST variables
        $fields = array(
            'q' => $json_data,
        );

        $fields_string = "";
        //url-ify the data for the POST
        foreach($fields as $key=>$value) 
        { 
            $fields_string .= $key.'='.$value.'&'; 
            
        }
        $fields_string = rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $this->SERVICE_URI);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
        return $result;
    }
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_gas_schedule_sms}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, user_id, type, obj_id, time_send, created_date, username, title, json_var, count_run', 'safe'),
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
            return array(
                'id' => 'ID',
                'user_id' => 'User',
                'type' => 'Type',
                'obj_id' => 'Obj',
                'time_send' => 'Time Send',
                'created_date' => 'Created Date',
                'username' => 'Username',
                'title' => 'Title',
                'json_var' => 'Json Var',
                'count_run' => 'Count Run',
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
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.obj_id',$this->obj_id,true);
        $criteria->compare('t.time_send',$this->time_send,true);
        $criteria->compare('t.created_date',$this->created_date,true);
        $criteria->compare('t.username',$this->username,true);
        $criteria->compare('t.title',$this->title,true);
        $criteria->compare('t.json_var',$this->json_var,true);
        $criteria->compare('t.count_run',$this->count_run,true);

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
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: GetBalance 
     * @Param: string $resource : GetBalance
     * http://api.esms.vn/MainService.svc/xml/GetBalance/{APIKey}/{SecrectKey}
     */
    public function getBalance() {
        $this->SERVICE_URI = $this->SERVICE_URI."/".GasScheduleSms::ApiKey."/".GasScheduleSms::SecrectKey;
        $response = $this->MakeRequestGet();
        echo '<pre>';
        print_r($response);
        echo '</pre>';
        die;
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     */
    public function buildStringParam($aParams, &$fields_string) {
        //url-ify the data for the GET
        foreach($aParams as $key=>$value) 
        { 
            $fields_string .= $key.'='.$value.'&'; 
            
        }
        $fields_string = rtrim($fields_string, '&');
    }
    
    /**
     * @Author: ANH DUNG Jan 05, 2016
     * @Todo: send SMS 
     * @Param: string $resource : SendMultipleSMS_v3
     * http://api.esms.vn/MainService.svc/xml/SendMultipleSMS_v3
?Phone={Phone}&Content={Content}&ApiKey={ApiKey}&
         * SecretKey={SecretKey}&IsUnicode={IsUnicode}&
         * Brandnamme={BrandnameCode}&SmsType={SmsType}&RequestID={RequestID}
     */
    public function sendSmsTest() {
        $this->setServiceUri('SendMultipleSMS_v3');
      $Phone = "01684331552";
//      $Content = "Daukhimiennam.com gửi tin nhắn \nsử dụng tiếng \nviệt cộng hòa xã hội chủ nghĩa";
      $Content = "Daukhimiennam.com gửi tin nhắn \nsử dụng tiếng \nviệt. Nguyễn Tiến Dũng";
      $ApiKey = GasScheduleSms::ApiKey;
      $SecretKey = GasScheduleSms::SecrectKey;
      $IsUnicode = "true";
      $Brandnamme = "";
      $SmsType = GasScheduleSms::SEND_SMS_RANDOM_FAST;
      $RequestID = "1";// là id trong table sms của daukhimiennam.com
      
      $aParams = array(
          "Phone"=>$Phone,
          "Content"=>urlencode($Content),
          "ApiKey"=>$ApiKey,
          "SecretKey"=>$SecretKey,
          "IsUnicode"=>$IsUnicode,
          "Brandnamme"=>$Brandnamme,
          "SmsType"=>$SmsType,
          "RequestID"=>$RequestID,
      );
      $fields_string = "";
      $this->buildStringParam($aParams, $fields_string);
        
        $this->SERVICE_URI = $this->SERVICE_URI."?$fields_string";
//        echo '<pre>';
//        print_r($this->SERVICE_URI);
//        echo '</pre>';
//        die;
        $response = $this->MakeRequestGet();
        echo '<pre>';
        print_r($response);
        echo '</pre>';
        die;
    }
    
    
    
    
    
}