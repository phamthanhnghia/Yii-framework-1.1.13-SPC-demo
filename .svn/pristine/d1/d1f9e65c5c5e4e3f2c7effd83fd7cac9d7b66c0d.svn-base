<?php

/**
 * This is the model class for table "{{_gas_schedule_email}}".
 *
 * The followings are the available columns in table '{{_gas_schedule_email}}':
 * @property string $id
 * @property integer $type
 * @property integer $email_template_id
 * @property string $user_id
 * @property string $time_send
 * @property string $created_date
 */
class GasScheduleEmail extends CActiveRecord
{
    const MAX_SEND = 20; // Feb 26, 2015
    const MAIL_PRIMARY = "nkhuongminh@gmail.com"; // Sep 17, 2015
    const MAIL_SECOND  = "nkhuongminh1@gmail.com"; // Sep 17, 2015
    const MAIL_THIRD  = "nkhuongminh2@gmail.com"; // Oct 22, 2015
    
    /* TYPE SEND MAIL */
    const MAIL_RESET_PASS = 1;
    const MAIL_TEXT_ALERT = 2;
    const MAIL_SUPPORT_CUSTOMER_CHANGE_STATUS = 3;
    const MAIL_ISSUE_TICKET_CHANGE = 4;
    const MAIL_LEAVE_APPROVE = 5;
    /* TYPE SEND MAIL */
    
    // 3: support customer, 4: ticket change, 5 nghi phep
    // DELETE FROM `c1gas35`.`gas_gas_schedule_email` WHERE `gas_gas_schedule_email`.`type` =2
    // Mar 14, 2015 => 1240 rows deleted. (Query took 0.0143 sec)
    
    // Jan 26,2015 
    public static $UID_NOT_RESET_PASS = array(
        111250, // Bùi Đức Hoàn giam doc kinh doanh
        136808, // Đoàn Ngọc Hải Triều truong phong kinh doanh gas moi
        114943, // Phạm Văn Đức truong phong kinh doanh gas bo
        26676, // Vũ Thái Long giam doc
        303, // Nguyễn Văn Đợt Tổng giám sát
        112677, // Kho Bến Cát User Đại Lý
//        142134, // Anh Dũng NB
        258737, // Nguyễn Ngọc Kiên - TP Pháp Lý
        710677, // Hoàng Anh - NV Giám Sát
    );
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasScheduleEmail the static model class
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
            return '{{_gas_schedule_email}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, type, email_template_id, user_id, time_send, created_date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'type' => 'Type',
                    'email_template_id' => 'Email Template',
                    'user_id' => 'User',
                    'time_send' => 'Time Send',
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
        $criteria->compare('t.email_template_id',$this->email_template_id);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.time_send',$this->time_send,true);
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
        return array(
                //'condition'=>'',
        );
    }
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: build email reset pass to all user have email
     * then insert to table GasScheduleEmail at 1h AM. about 2h AM will send 
     */
    public static function BuildListResetPass() {
        /* Lấy toàn bộ những user có email và insert vào bảng chờ gửi (GasScheduleEmail)
         * lúc 1h, sau đó 2h sẽ chạy cron send. Cron send sẽ luôn chạy 1 lần every 10 phút
         * nhưng trong hàm send reset pass mình kiểm tra nếu giờ nhỏ hơn 2 thì return luôn
         * vì lúc 1h mới có list reset paass 
         */
        $aUid = GasScheduleEmail::$UID_NOT_RESET_PASS;// Jan 26,2015 user không cần reset pass
        // get list user có mail và active
        $aModelUserMail = Users::GetListUserMail( array('aUidNotReset'=>$aUid) );
        $aRowInsert=array();
        foreach($aModelUserMail as $model){
            self::BuildListResetPassGetArrayInsert($model, $aRowInsert);
        }
        $tableName = GasScheduleEmail::model()->tableName();
        $sql = "insert into $tableName (type,
                    email_template_id,
                    user_id,
                    email
                    ) values ".implode(',', $aRowInsert);
        if(count($aRowInsert)>0)
            Yii::app()->db->createCommand($sql)->execute();
    }
    
    // belong to BuildListResetPass
    public static function BuildListResetPassGetArrayInsert($model, &$aRowInsert) {
        $type = self::MAIL_RESET_PASS;
        $email_template_id = SendEmail::MAIL_RESET_PASS;
        $aRowInsert[]="('$type',
                        '$email_template_id', 
                        '$model->id',
                        '$model->email'
                        )";
    }
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: run cron every 10 phut send mail reset pass, moi lan send khoang 50 cai
     * se run vao luc 2h sang
     * @Param: $model
     */
    public static function RunCronSendResetPass() {
        if(date("H") < 2 ) return; // OPEN IT ON LIVE
        $from = time();
        $aModelScheduleEmail = array();// for delete all after send mail
        $aIdScheduleEmail = array();// for delete all after send mail
        $aModelUser = array(); // for one query to table user
        $aIdUser = array();// for one query to table user
        GasScheduleEmail::GetInfoUser($aModelScheduleEmail, $aIdScheduleEmail, $aModelUser, $aIdUser, self::MAIL_RESET_PASS);
        if( count($aIdUser) < 1 ) { return; }
        foreach($aModelUser as $model){
            SendEmail::ResetPasswordModelAndSendMail($model); // OPEN IT ON LIVE
        }
        GasScheduleEmail::DeleteAllByArrayId( $aIdScheduleEmail );
        $to = time();
        $second = $to-$from;
        $ResultRun = "CRON Mail ResetPassByRole: ".count($aIdUser).' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes';
        Logger::WriteLog($ResultRun);
    }
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: get list array model user reset
     */
    public static function GetInfoUser( &$aModelScheduleEmail, &$aIdScheduleEmail, &$aModelUser, &$aIdUser, $type) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.type', $type);
        $criteria->order = "t.id ASC";
        $criteria->limit = GasScheduleEmail::MAX_SEND;
        $models = GasScheduleEmail::model()->findAll($criteria);
        $aModelScheduleEmail = $models;
        $aIdScheduleEmail = CHtml::listData( $models,'id','id');
        $aIdUser = CHtml::listData( $models,'user_id','user_id');
        $aModelUser = Users::getOnlyArrayModelByArrayId($aIdUser);
    }
    
    /**
     * @Author: ANH DUNG Nov 19, 2014
     * @Todo: delete all GasScheduleEmail by list id
     */
    public static function DeleteAllByArrayId($aIdScheduleEmail) {
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $aIdScheduleEmail);
        GasScheduleEmail::model()->deleteAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: run cron every 10 phut send mail alert khi có văn bản mới cho user nào có mail
     */
    public static function RunCronSendTextAlert( &$CountSend ) {
        $from = time();
        $aModelScheduleEmail = array();// for delete all after send mail
        $aIdScheduleEmail = array();// for delete all after send mail
        $aModelUser = array(); // for one query to table user
        $aIdUser = array();// for one query to table user
        GasScheduleEmail::GetInfoUser($aModelScheduleEmail, $aIdScheduleEmail, $aModelUser, $aIdUser, self::MAIL_TEXT_ALERT);
        $CountSend = count($aIdUser);
        if( $CountSend < 1 ) { return; }
//        $text_id = $aModelScheduleEmail[0]->obj_id;
        $mText = GasText::model()->findByPk($aModelScheduleEmail[0]->obj_id);
        foreach($aModelUser as $mUser){
            SendEmail::TextAlert($mUser, $mText); // OPEN IT ON LIVE
        }
        GasScheduleEmail::DeleteAllByArrayId( $aIdScheduleEmail );
        $to = time();
        $second = $to-$from;
        $ResultRun = "CRON Email văn bản mới - Text Alert: ".count($aIdUser).' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes';
        self::WriteLogEmailSend($ResultRun, $aModelUser);
        Logger::WriteLog($ResultRun);
    }       
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: run cron every 10 phut send mail alert khi có văn bản mới cho user nào có mail
     * @param: $text_id  pk cua van ban moi
     */
    public static function BuildListTextAlert($text_id) {
        /* Lấy toàn bộ những user có email và insert vào bảng chờ gửi (GasScheduleEmail)
         * sau đó Cron send sẽ luôn chạy 1 lần every 10 phút
         */
        // get list user có mail và active
        $aModelUserMail = Users::GetListUserMail();
        $aRowInsert=array();
        foreach($aModelUserMail as $model){
            self::BuildListTextAlertGetArrayInsert($model, $aRowInsert, $text_id);
        }
        GasScheduleEmail::RunSqlInsert($aRowInsert);
    }
    
    // belong to BuildListTextAlert
    public static function BuildListTextAlertGetArrayInsert($model, &$aRowInsert, $text_id) {
        $type = self::MAIL_TEXT_ALERT;
        $email_template_id = SendEmail::MAIL_TEXT_ALERT;
        $aRowInsert[]="('$type',
                        '$email_template_id', 
                        '$text_id', 
                        '$model->id',
                        '$model->email'
                        )";
    }    
    
    /**
     * @Author: ANH DUNG Dec 30, 2014
     * @Todo: run cron every 10 phut send mail notify user lien quan đến support customer
     * @param: $support_customer_id  pk cua support customer liên quan
     */
    public static function BuildListNotifySupportCustomer($support_customer_id) {
        return ; // Oct 22, 2015 tắt send mail, User tự lên check
        /* Lấy toàn bộ những user có email và insert vào bảng chờ gửi (GasScheduleEmail)
         * sau đó Cron send sẽ luôn chạy 1 lần every 10 phút
         */
        // get list user có mail và active        
        $aModelUserMail = GasSupportCustomer::GetListModelUserNotify($support_customer_id);
        $aRowInsert=array();
        foreach($aModelUserMail as $mUser){
            self::BuildListNotifySupportCustomerGetArrayInsert($mUser, $aRowInsert, $support_customer_id);
        }
        GasScheduleEmail::RunSqlInsert($aRowInsert);
    }
    
    // belong to BuildListNotifySupportCustomer
    public static function BuildListNotifySupportCustomerGetArrayInsert($mUser, &$aRowInsert, $support_customer_id) {
        $type = self::MAIL_SUPPORT_CUSTOMER_CHANGE_STATUS;
        $email_template_id = SendEmail::MAIL_SUPPORT_CUSTOMER_CHANGE_STATUS;
        if(trim($mUser->email) != ""){
            $aRowInsert[]="('$type',
                            '$email_template_id',
                            '$support_customer_id',
                            '$mUser->id',
                            '$mUser->email'
                            )";
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 30, 2014
     * @Todo: buid sql insert and run
     * @Param: $aRowInsert array data
     */
    public static function RunSqlInsert($aRowInsert) {
        $tableName = GasScheduleEmail::model()->tableName();
        $sql = "insert into $tableName (type,
                    email_template_id,
                    obj_id,
                    user_id,
                    email
                    ) values ".implode(',', $aRowInsert);
        if(count($aRowInsert)>0)
            Yii::app()->db->createCommand($sql)->execute();
    }
    
    /**
     * @Author: ANH DUNG Dec 30, 2014
     * @Todo: run cron every 10 phut send mail alert khi có notify
     * hàm này có thể dùng chung cho về sau nữa, chung cho các notify của table khác
     */
    public static function RunCronSendNotifySupportCustomer( &$CountSend, $type, $info_show ) {
        $from = time();
        $aModelScheduleEmail = array();// for delete all after send mail
        $aIdScheduleEmail = array();// for delete all after send mail
        $aModelUser = array(); // for one query to table user
        $aIdUser = array();// for one query to table user
        GasScheduleEmail::GetInfoUser($aModelScheduleEmail, $aIdScheduleEmail, $aModelUser, $aIdUser, $type);
        $CountSend = count($aIdUser);
        if( $CountSend < 1 ) { return; }

        if($type == GasScheduleEmail::MAIL_SUPPORT_CUSTOMER_CHANGE_STATUS){
            $mSupportCustomer = GasSupportCustomer::model()->findByPk($aModelScheduleEmail[0]->obj_id);
            foreach($aModelUser as $mUser){
                if(trim($mUser->email) != '' && $mSupportCustomer){
                    SendEmail::SupportCustomerChangeStatus($mUser, $mSupportCustomer);
                }
            }
        }
        elseif($type == GasScheduleEmail::MAIL_ISSUE_TICKET_CHANGE){ // update more at here
            $mGasIssueTicketsDetail = GasIssueTicketsDetail::model()->findByPk($aModelScheduleEmail[0]->obj_id);
            foreach($aModelUser as $mUser){
                if(trim($mUser->email) != '' && $mGasIssueTicketsDetail){
                    SendEmail::IssueTicketReply($mUser, $mGasIssueTicketsDetail);
                }
            }
        }
        // Feb 26, 2015 Fix không cho send mail ngay khi tạo, phải luôn vào schedule
        elseif($type == GasScheduleEmail::MAIL_LEAVE_APPROVE){ // update more at here
            $mGasLeave = GasLeave::model()->findByPk($aModelScheduleEmail[0]->obj_id);
            foreach($aModelUser as $mUser){
                if(trim($mUser->email) != '' && $mGasLeave){
                    SendEmail::LeaveAlertSend($mUser, $mGasLeave);
                }
            }
        }
        // Feb 26, 2015
                
        GasScheduleEmail::DeleteAllByArrayId( $aIdScheduleEmail );
        $to = time();
        $second = $to-$from;
        $ResultRun = "CRON $info_show: ".count($aIdUser).' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes ';
        self::WriteLogEmailSend($ResultRun, $aModelUser);
        Logger::WriteLog($ResultRun);
    }
    
    
    /*****  Feb 25, 2015 ISSUE TICKET *****/
    /**
     * @Author: ANH DUNG Feb 25, 2015
     * @Todo: run cron every 10 phut send mail notify user lien quan đến ISSUE TICKET
     * @param: $support_customer_id  pk cua support customer liên quan
     */
    public static function BuildListNotifyIssueTicket($issue_tickets_detail_id) {
        /* Lấy toàn bộ những user có email và insert vào bảng chờ gửi (GasScheduleEmail)
         * sau đó Cron send sẽ luôn chạy 1 lần every 10 phút
         */
        // get list user có mail và active        
        $aModelUserMail = GasIssueTickets::GetListModelUserNotify($issue_tickets_detail_id);
        $aRowInsert=array();
        foreach($aModelUserMail as $mUser){
            self::BuildListNotifyIssueTicketGetArrayInsert($mUser, $aRowInsert, $issue_tickets_detail_id);
        }
        GasScheduleEmail::RunSqlInsert($aRowInsert);
    }
    
    // belong to BuildListNotifySupportCustomer
    public static function BuildListNotifyIssueTicketGetArrayInsert($mUser, &$aRowInsert, $issue_tickets_detail_id) {
        $type = self::MAIL_ISSUE_TICKET_CHANGE;
        $email_template_id = SendEmail::MAIL_ISSUE_TICKET_CHANGE;
        if($mUser && trim($mUser->email) != ""){
            $aRowInsert[]="('$type',
                            '$email_template_id',
                            '$issue_tickets_detail_id',
                            '$mUser->id',
                            '$mUser->email'
                            )";
        }
    }
    
    /*****  Feb 25, 2015 ISSUE TICKET *****/
    
    /*****  Feb 26, 2015 BUG - RESOLVE - ALL EMAIL WILL PUT TO TABLE SCHEDULE *****/
    /*****  Feb 26, 2015 LEAVE - NGHI PHEP *****/
    /**
     * @Author: ANH DUNG Feb 26, 2015
     * @Todo: run cron every 5 phut (20 mail) send mail notify user lien quan đến leave approve
     * Hôm nay bị bug, khi gmail send 1000 mail thì bị limit trong 1 ngày, không send dc nữa
     * nên những email gửi ngay sẽ văng ra lỗi và không gửi được => Solution: sẽ đưa vào scheule hết
     * @param: $model  model GasLeave
     */
    public static function BuildListNotifyLeaveApprove($model) {
        /* Lấy toàn bộ những user có email và insert vào bảng chờ gửi (GasScheduleEmail)
         * sau đó Cron send sẽ luôn chạy 1 lần every 10 phút
         */
        // get list user có mail và active
        $aRowInsert=array();
        $mUserApproved = Users::model()->findByPk( $model->to_uid_approved );
        if($mUserApproved){
//       Apr 07, 2015 bỏ đoạn check này vì check nhiều quá
//            if( in_array($mUserApproved->role_id, GasLeave::$ROLE_APPROVE_LEVEL_1) ){
                $aModelUserMail = array($mUserApproved);
//                MyFormat::AddEmailAnhDung($aModelUserMail);// only for test
                foreach($aModelUserMail as $mUser){
                    self::BuildListNotifyLeaveApproveGetArrayInsert($mUser, $aRowInsert, $model->id);
                }
                GasScheduleEmail::RunSqlInsert($aRowInsert);
//            }Apr 07, 2015 bỏ đoạn check này vì check nhiều quá
        }
    }
    
    // belong to BuildListNotifySupportCustomer
    public static function BuildListNotifyLeaveApproveGetArrayInsert($mUser, &$aRowInsert, $leave_id) {
        $type = self::MAIL_LEAVE_APPROVE;
        $email_template_id = SendEmail::MAIL_LEAVE_APPROVE;
        if(trim($mUser->email) != ""){
            $aRowInsert[]="('$type',
                            '$email_template_id',
                            '$leave_id',
                            '$mUser->id',
                            '$mUser->email'
                            )";
        }
    }
    
    /*****  Feb 26, 2015 LEAVE - NGHI PHEP *****/
 
    
    /**
     * @Author: ANH DUNG Sep 16, 2015
     * @Todo: write email send to log
     * @Param: $model
     */
    public static function WriteLogEmailSend(&$ResultRun, $aModelUser) {
        $sEmail = "";
        foreach($aModelUser as $mUser){
            $sEmail .= " --- $mUser->email";
        }
        $ResultRun .= "<br> $sEmail";
    }
    
        
    /**
     * @Author: ANH DUNG Sep 18, 2015
     * @Todo: writelog khi build list send mail
     * @Param: $info: text xác định đang chạy ở function nào, $aModelUserMail
     */
    public static function WritelogDebugBuildMail($info, $aModelUserMail) {
        GasScheduleEmail::WriteLogEmailSend($info, $aModelUserMail);
        Logger::WriteLog($info);
    }
    
}