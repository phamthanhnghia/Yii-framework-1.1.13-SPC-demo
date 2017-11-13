<?php

class SendEmail {
    const MAIL_REQUEST_RESET_PASS = 1;
    const MAIL_RESET_PASS = 3; // mail reset pass send luc 2h AM
    const MAIL_TEXT_ALERT = 4; // gửi mail alert khi có văn bản mới
    const MAIL_LEAVE_ALERT = 5; // gửi mail alert cho user quản lý khi có người thuộc cấp quản lý đó  nghỉ phép
    const MAIL_SUPPORT_CUSTOMER_CHANGE_STATUS = 6; // gửi mail notify cho user lien quan khi support customer change status
    const MAIL_ISSUE_TICKET_CHANGE = 7; // gửi mail notify cho user lien quan khi issue ticket có reply
    const MAIL_LEAVE_APPROVE = 8; // gửi mail notify cho user QUAN LY, KHI CO NHAN VIEN NGHI PHEP
    
    // reset pass of agent (hoặc các loại user khác) 1 ngày 1 lần = cron job
    public static function ResetPassByRole(){
        $from = time();
        $aRole = array(ROLE_SUB_USER_AGENT);
        $aUid = array(
            136839, // NV Giám Sát Admin Ngọc Kiên
            142134, // NV Giám Sát dungninhbinh
        );
        $criteria = new CDbCriteria();
//        $criteria->compare('t.status', STATUS_ACTIVE); // không nên có đk này,vì sẽ xử lý user login 2 chỗ bị đẩy ra, khi đó sẽ inactive user và send mail reset pass
        $criteria->addInCondition('t.role_id', $aRole);
        $criteria->addInCondition('t.id', $aUid, 'OR'); // for test send mail
        $models = Users::model()->findAll($criteria);
        foreach($models as $model){
            SendEmail::ResetPasswordModelAndSendMail($model);
        }
        
        $to = time();
        $second = $to-$from;
        $ResultRun = "Mail ResetPassByRole: ".count($models).' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes';
        Logger::WriteLog($ResultRun);        
    }
    
    // to do: reset pass + update model + send mail
    // @param: $model is model user
    public static function ResetPasswordModelAndSendMail($model){
        if(trim($model->email)!=''){
            Users::ResetPassword($model);
            SendEmail::ResetPassword($model);
        }
    }
    
    /**
     * @Author: ANH DUNG Now 20, 2014:
     * @Todo: send mail alert khi có văn bản mới cho user nào có mail
     * @Param: $mUser
     * @Param: $mText
     */
    public static function TextAlert($mUser, $mText){
        if(trim($mUser->email)!=''){
            SendEmail::TextAlertSend($mUser, $mText);
        }
    }

    public static function ResetPassword($model) {
         $aBody = array(
            '{NAME}' => $model->first_name,
            '{EMAIL}' => $model->email,
            '{DATE_APPLY}' => date('d-m-Y'),
            '{PASSWORD_NEW}' => $model->temp_password,
        );   
        $aSubject = array(
            '{NAME}' => $model->first_name,
            '{DATE_APPLY}' => date('d-m-Y'),
        );
        CmsEmail::sendmail(SendEmail::MAIL_RESET_PASS, $aSubject, $aBody, $model->email);
    }
    
    /**
     * @Author: ANH DUNG Nov 20, 2014
     * @Todo: belong to TextAlert
     */
    public static function TextAlertSend($mUser, $mText) {
        $cmsFormater = new CmsFormatter();
        $date_published  = $cmsFormater->formatDate( $mText->date_published );
        $type = GasText::getTypeText($mText->type);
        $Title = "Văn Bản Mới: $type $mText->number_sign - Ngày Ban Hành: $date_published";
        $LinkView = Yii::app()->createAbsoluteUrl("admin/gasText/text_view", array('id' => $mText->id));
        $LinkView = "<a href='$LinkView' target='_blank'>Click Here To View</a>";
        $aBody = array(
            '{NAME}' => $mUser->first_name,
            '{EMAIL}' => $mUser->email,
            '{DATE_PUBLISHED}' => $date_published, // Ngày ban hành
            '{TITLE}' => $Title,
            '{SHORT_CONTENT}' => $mText->short_content, // trích yếu tóm tắt
            '{LINK_VIEW}' => $LinkView, // LINK VIEW DETAIL
        );   
        $aSubject = array(
            '{NAME}' => $mUser->first_name,
            '{TITLE}' => $Title,
        );
        CmsEmail::sendmail(SendEmail::MAIL_TEXT_ALERT, $aSubject, $aBody, $mUser->email);
    }    
    
    /**
     * @Author: ANH DUNG Nov 21, 2014
     * @Todo: test send leave alert
     */
    public static function TestLeaveAlertSend() {
        $mUser = Users::model()->findByPk(142134);
        $mLeave = GasLeave::model()->findByPk(39);
        self::LeaveAlertSend($mUser, $mLeave);
    }
    
    /**
     * @Author: ANH DUNG Nov 21, 2014
     * @Todo: gửi mail alert cho user quản lý khi có người thuộc cấp quản lý đó nghỉ phép
     * @param model $mUser model user quản lý sẽ send mail notify
     * @param model $mLeave model leave - người nghỉ
     */
    public static function LeaveAlertSend($mUser, $mLeave) {
        if(trim($mUser->email) == '') return ;
        $cmsFormater = new CmsFormatter();
        $date  = $cmsFormater->formatLeaveDate( $mLeave );
        $LEAVE_NAME = '';
        $LEAVE_POSITION = '';
        $mUserLeave = $mLeave->rUidLeave;
        if( $mUserLeave ){
            $LEAVE_NAME = $mUserLeave->first_name;
            $LEAVE_POSITION = Roles::GetRoleNameById( $mUserLeave->role_id );
        }
        
        $aBody = array(
            '{NAME}' => $mUser->first_name,
            '{EMAIL}' => $mUser->email,
            '{LEAVE_NAME}' => $LEAVE_NAME, // ten nguoi nghi
            '{LEAVE_POSITION}' => $LEAVE_POSITION,// chuc vu
            '{LEAVE_DATE}' => $date, // ngay nghi
            '{LEAVE_CONTENT}' => $mLeave->leave_content, // ly do
        );   
        $aSubject = array(
            '{NAME}' => $mUser->first_name,
            '{LEAVE_NAME}' => $LEAVE_NAME, // ten nguoi nghi
            '{LEAVE_POSITION}' => $LEAVE_POSITION,// chuc vu
        );
        CmsEmail::sendmail(SendEmail::MAIL_LEAVE_ALERT, $aSubject, $aBody, $mUser->email);
    }
    
    /**
     * @Author: ANH DUNG Dec 30, 2014
     * @Todo: mail cron khi SupportCustomer change status
     */
    public static function SupportCustomerChangeStatus($mUser, $mSupportCustomer) {
        $cmsFormater = new CmsFormatter();
        $date_request  = $cmsFormater->formatDate( $mSupportCustomer->date_request );
        $customer_name = $cmsFormater->formatNameUser($mSupportCustomer->rCustomer);
        $status = GasSupportCustomer::GetStatusSupport($mSupportCustomer);
        $approved_name = GasSupportCustomer::GetLastUpdateStatus($mSupportCustomer);
        $approved_name = str_replace("<br>", " - ", $approved_name);
        $item_name = $mSupportCustomer->formatGasSupportCustomerItemName();
        $detail = $mSupportCustomer->SupportCustomerInfo();
        $Title = "Đề xuất hỗ trợ KH: $customer_name - [$status]";
        $time_doing_real = MyFormat::datetimeDbDatetimeUser($mSupportCustomer->time_doing_real);
        $last_note = GasSupportCustomer::GetLastUpdateNote($mSupportCustomer);
        $aBody = array(
            '{NAME}' => $mUser->first_name,
            '{EMAIL}' => $mUser->email,
            '{CUSTOMER_NAME}' => $customer_name,
            '{DATE_REQUEST}' => $date_request, // Ngày Đề xuất
            '{TIME_DOING_REAL}' => $time_doing_real, // Ngày THI CONG THUC TE
            '{STATUS}' => $status,
            '{ARPPROVED_NAME}' => $approved_name, // nguoi duyet va thoi gian
            '{ITEM_NAME}' => $item_name."<hr><b>Chi Tiết Khách Hàng: </b><br>$detail", // 
            '{TITLE}' => $Title, // 
            '{LAST_NOTE}' => $last_note, // GHI CHU MOI NHAT
            '{DELOY_BY}' => $mSupportCustomer->getDeloyHtml(), // Sep 23, 2015 Đơn vị thực hiện 
        );   
        $aSubject = array(
            '{NAME}' => $mUser->first_name,
            '{TITLE}' => $Title,
        );
        CmsEmail::sendmail(SendEmail::MAIL_SUPPORT_CUSTOMER_CHANGE_STATUS, $aSubject, $aBody, $mUser->email);
    }    
    
    /**
     * @Author: ANH DUNGFeb 25, 2015
     * @Todo: mail cron khi issue change reply 
     */
    public static function IssueTicketReply($mUser, $mGasIssueTicketsDetail) {
        $cmsFormater = new CmsFormatter();
        $mGasIssueTickets = GasIssueTickets::model()->findByPk($mGasIssueTicketsDetail->ticket_id);
        if(is_null($mGasIssueTickets)){
            return ;
        }
        $mCustomer = $mGasIssueTickets->rCustomer;
        $date_reply  = $cmsFormater->formatDate( $mGasIssueTicketsDetail->created_date );
        $customer_name = $cmsFormater->formatNameUserWithTypeBoMoi($mCustomer);
        $uIdPost = $mGasIssueTicketsDetail->rUidPost;
        $name_user_login = $cmsFormater->formatNameUser($uIdPost);
        $POSITION = '';
        if($uIdPost){
            $POSITION = Roles::GetRoleNameById( $uIdPost->role_id );
        }
        $DetailIssue = $mGasIssueTickets->getDetailIssue($mGasIssueTicketsDetail);
        
        $aBody = array(
            '{NAME}' => $mUser->first_name,
            '{EMAIL}' => $mUser->email,
            '{CUSTOMER_NAME}' => $customer_name,
            '{DATE_REPLY}' => $date_reply, // Ngày REPLY
            '{MESSAGE}' => $mGasIssueTicketsDetail->message . $DetailIssue, // MESSAGE REPLY
            '{NAME_USER_LOGIN}' => $name_user_login." - $POSITION", // MESSAGE REPLY
            '{TITLE}' => $mGasIssueTickets->title, // 
        );   
        $aSubject = array(
            '{NAME}' => $mUser->first_name,
            '{TITLE}' => $mGasIssueTickets->title, //
            '{CUSTOMER_NAME}' => $customer_name,
        );
        CmsEmail::sendmail(SendEmail::MAIL_ISSUE_TICKET_CHANGE, $aSubject, $aBody, $mUser->email);
    }

    /**
     * @Author: ANH DUNG Aug 19, 2014
     * @Todo: dùng để test xem cron chạy đúng ko
     */
    public static function TestCron() {
        $MailTest = 'dung.nt@verzdesign.com.sg';
        $aBody = array();
        $aSubject = array();
        CmsEmail::sendmail(SendEmail::MAIL_REQUEST_RESET_PASS, $aSubject, $aBody, $MailTest);
//        $MailTest1 = 'nguyendungww@gmail.com';
//        CmsEmail::sendmail(SendEmail::MAIL_REQUEST_RESET_PASS, $aSubject, $aBody, $MailTest1);
    }
}

?>
