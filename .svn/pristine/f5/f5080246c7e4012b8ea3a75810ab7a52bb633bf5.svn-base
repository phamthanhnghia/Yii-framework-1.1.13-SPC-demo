<?php

/**
 * This is the model class for table "{{_gas_tickets}}".
 *
 * The followings are the available columns in table '{{_gas_tickets}}':
 * @property string $id
 * @property string $code_no
 * @property string $agent_id
 * @property string $uid_login
 * @property string $title
 * @property string $send_to_id
 * @property integer $admin_new_message
 * @property integer $status
 * @property integer $process_status
 * @property string $process_time
 * @property string $process_user_id
 * @property string $created_date
 */
class GasTickets extends CActiveRecord
{
    public $MAX_ID;
    public $message;
    public $autocomplete_name;
    
    const TYPE_SENT = 1;
    const TYPE_RECEIVED = 2;
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;
    const ADMIN_SEND = 1;
    
    const PROCESS_STATUS_NEW = 1;
    const PROCESS_STATUS_PICK = 2;
    const PROCESS_STATUS_FINISH = 3;
    
    const DIEU_PHOI_CHUONG = 57916;
    
    public static $HANDLE_TICKET = array(
        GasTickets::DIEU_PHOI_CHUONG=>'Trần Quang Chương (Tạo KH)',
        345432=>'Lâm Thị Kim Nhung (Tạo KH, KV Miền Tây)',
    );
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_gas_tickets}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {            
        return array(
            array('title, message', 'required','on'=>'create'),
            array('message', 'required','on'=>'reply'),
            array('title', 'length', 'max'=>250),
            array('message, id, code_no, agent_id, uid_login, title, send_to_id, admin_new_message, status, process_status, process_time, process_user_id, created_date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rAgent' => array(self::BELONGS_TO, 'Users', 'agent_id'),
            'rTicketDetail' => array(self::HAS_MANY, 'GasTicketsDetail', 'ticket_id',
                'order'=>'rTicketDetail.id DESC',
            ),
            'rUidLogin' => array(self::BELONGS_TO, 'Users', 'uid_login'),
            'rSendToId' => array(self::BELONGS_TO, 'Users', 'send_to_id'),
            'rProcessUserId' => array(self::BELONGS_TO, 'Users', 'process_user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'code_no' => 'Code No',
            'agent_id' => 'Agent',
            'uid_login' => 'Uid Login',
            'title' => 'Tiêu Đề',
            'send_to_id' => 'Send To',
            'admin_new_message' => 'Admin New Message',
            'status' => 'Status',
            'process_status' => 'Trạng Thái',
            'process_time' => 'Thời Điểm',
            'process_user_id' => 'Người Xử Lý',
            'created_date' => 'Ngày Tạo',
            'message' => 'Nội Dung Yêu Cầu Hỗ Trợ',
        );
    }

    /**
     * @Author: ANH DUNG Aug 10, 2014
     * @Todo: dùng cho đại lý list những ticket của đại lý đã submit
     */
    public function searchOpen()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.code_no',$this->code_no,true);
        $criteria->compare('t.agent_id',$this->agent_id,true);
        $criteria->compare('t.title',$this->title,true);
        $uidLogin = Yii::app()->user->id;
//        $criteria->addCondition("t.uid_login=$uidLogin OR t.send_to_id=$uidLogin" );
        $criteria->addCondition(
                " ( t.uid_login=$uidLogin OR ".
                " ( t.send_to_id=$uidLogin AND t.admin_new_message=".GasTickets::ADMIN_SEND." ) )"
                ); 
        
//        $criteria->compare('t.uid_login', Yii::app()->user->id);
//        $criteria->compare('t.send_to_id',$this->send_to_id,true);
        $criteria->compare('t.status', GasTickets::STATUS_OPEN);
        $criteria->compare('t.process_status',$this->process_status);
        $criteria->compare('t.process_user_id',$this->process_user_id,true);
        $criteria->order = 't.process_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> self::GetPageSize(),
            ),
        ));
    }
    
    public function searchClose()
    {
        $uidLogin = Yii::app()->user->id;
        $criteria=new CDbCriteria;
        $criteria->compare('t.code_no',$this->code_no,true);
        $criteria->compare('t.agent_id',$this->agent_id,true);        
        $criteria->compare('t.title',$this->title,true);
        $criteria->compare('t.status', GasTickets::STATUS_CLOSE);
//        $criteria->compare('t.send_to_id',$this->send_to_id,true);
//        $criteria->compare('t.uid_login', Yii::app()->user->id);
        $criteria->addCondition("( t.uid_login=$uidLogin OR ( t.send_to_id=$uidLogin AND t.process_user_id<>$uidLogin ))" );
        
        $criteria->compare('t.process_status',$this->process_status);
        $criteria->compare('t.process_user_id',$this->process_user_id,true);
        $criteria->order = 't.process_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 20,
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Aug 10, 2014
     * @Todo: dùng cho user được phép xử lý ticket, sẽ load những ticket mới của đại lý submit lên
     */
    public function searchNeedProcess()
    {
        $cRole = Yii::app()->user->role_id;
        $criteria=new CDbCriteria;
        $criteria->compare('t.code_no',$this->code_no,true);
        $criteria->compare('t.agent_id',$this->agent_id,true);
        $criteria->compare('t.title',$this->title,true);
        $criteria->addCondition("t.uid_login<>".Yii::app()->user->id);
//        if($cRole != ROLE_ADMIN && $cRole != ROLE_DIEU_PHOI){
        if($cRole != ROLE_ADMIN){
            $criteria->compare('t.send_to_id', Yii::app()->user->id);
        }
        $criteria->addCondition("t.admin_new_message<>".GasTickets::ADMIN_SEND);
        // loại những ticket do admin send cho user ra, 
        // những ticket đó sẽ đưa vào phần Open Ticket của từng user
        $criteria->addInCondition('t.process_status', array(GasTickets::PROCESS_STATUS_NEW,GasTickets::PROCESS_STATUS_PICK));        
        $criteria->compare('t.process_user_id',$this->process_user_id);
        $criteria->compare('t.status', GasTickets::STATUS_OPEN);
        $criteria->order = 't.process_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> self::GetPageSize(),
            ),
        ));
    }
    /**
     * @Author: ANH DUNG Aug 10, 2014
     * @Todo: dùng cho user được phép xử lý ticket, sẽ load những ticket đã xử lý xong của đại lý submit lên
     */
    public function searchNeedProcessDone()
    {
        $uidLogin = Yii::app()->user->id;
        $criteria=new CDbCriteria;
        $criteria->compare('t.code_no',$this->code_no,true);
        $criteria->compare('t.agent_id',$this->agent_id,true);
        $criteria->compare('t.title',$this->title,true);
        $criteria->addCondition("t.uid_login<>".$uidLogin);
        if(Yii::app()->user->role_id != ROLE_ADMIN){
            $criteria->compare('t.send_to_id', $uidLogin);
            $criteria->addCondition("t.process_user_id=$uidLogin" );
        }
        $criteria->addCondition("t.admin_new_message<>".GasTickets::ADMIN_SEND); 
        // loại những ticket do admin send cho user ra, 
        // những ticket đó sẽ đưa vào phần Open Ticket của từng user
        $criteria->addInCondition('t.process_status', array(GasTickets::PROCESS_STATUS_FINISH));
//        $criteria->compare('t.process_user_id',$this->process_user_id,true);
        $criteria->order = 't.process_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 10,
            ),
        ));
    }
    
    public function searchNeedProcessButClosed()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.code_no',$this->code_no,true);
        $criteria->compare('t.agent_id',$this->agent_id,true);
        $criteria->compare('t.title',$this->title,true);
        if(Yii::app()->user->role_id != ROLE_ADMIN){
            $criteria->compare('t.send_to_id', Yii::app()->user->id);
        }        
        $criteria->addInCondition('t.process_status', array(GasTickets::PROCESS_STATUS_NEW,GasTickets::PROCESS_STATUS_PICK));
        $criteria->compare('t.status', GasTickets::STATUS_CLOSE);
        $criteria->compare('t.process_user_id',$this->process_user_id,true);
        $criteria->order = 't.process_time DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 10,
            ),
        ));
    }
    
    public static function GetPageSize(){
        return Yii::app()->params['ticket_page_size'];
    }

    public function defaultScope()
    {
        return array();
    }
    
    /**
     * @Author: ANH DUNG Aug 09, 2014
     * @Todo: save new ticket and detail new ticket
     * @Param: $model model 
     */
    public static function SaveNewTicket($model){
        $model->title = trim(InputHelper::removeScriptTag($model->title));
        $model->code_no = MyFunctionCustom::getNextId('GasTickets', 'T'.date('y'), LENGTH_TICKET,'code_no');
        if(Yii::app()->user->role_id == ROLE_SUB_USER_AGENT ){
            $model->agent_id = MyFormat::getAgentId();
        }
        $model->uid_login = Yii::app()->user->id;        
        $model->save();
        GasTickets::SaveOneMessageDetail($model);
    }
    
    // to do save one message to detail
    public static function SaveOneMessageDetail($mTicket){
//        if(!self::UserCanPostTicket()) return;        
        $mDetail = new GasTicketsDetail();
        $mDetail->ticket_id = $mTicket->id;
        $mDetail->message = trim(InputHelper::removeScriptTag($mTicket->message));
        $mDetail->uid_post = Yii::app()->user->id;
        $mDetail->type = GasTickets::TYPE_SENT;
        if($mTicket->uid_login != $mDetail->uid_post){
            $mDetail->type = GasTickets::TYPE_RECEIVED;
            GasTickets::UpdateStatusTicket($mTicket, GasTickets::PROCESS_STATUS_FINISH);
        }else{
            if($mTicket->process_status != GasTickets::PROCESS_STATUS_PICK)
                GasTickets::UpdateStatusTicket($mTicket, GasTickets::PROCESS_STATUS_NEW);
        }
        // Jan 26, 2015 thêm cột lưu lại tên user ở thời điểm xử lý ticket
        if($mDetail->rUidPost){
            $mDetail->c_name = MyFormat::GetNameWithLevel($mDetail->rUidPost);
        }
        $mDetail->save();
    }
       
    /**
     * @Author: ANH DUNG Aug 09, 2014
     * @Todo: cập nhật trạng thái của ticket, chỗ này dùng cho update pending vs finish
    // trạng thái free của ticker: 1: new, 2: user pick, 3: finish
     * @Param: $mTicket model gastickets
     * @Param: $status 1,2,3 GasTickets::PROCESS_STATUS_FINISH
     */
    public static function UpdateStatusTicket($mTicket, $status){
        $attUpdate = array('process_status','process_time');
        $mTicket->process_status = $status;
        $mTicket->process_time = date('Y-m-d H:i:s');
//        if($status != GasTickets::PROCESS_STATUS_NEW){ // luôn cập nhật process_user_id vì mình sẽ căn cứ vào process_status để show or hide name 
            $mTicket->process_user_id = Yii::app()->user->id;
            $attUpdate[] = 'process_user_id';
//        }
        $mTicket->update($attUpdate);
    }
    
    public static function CloseTicket($mTicket){
        $mTicket->status = GasTickets::STATUS_CLOSE;
        $mTicket->update(array('status'));
    }
        
    // kiểm tra cho user giới hạn 50 hoặc hơn 50 ticket 1 ngày, trong sysconfig
    public static function UserCanPostTicket(){
        $session=Yii::app()->session;
        $today = date('Y-m-d');
        if(!isset($session['CURRENT_POST_TICKET'][$today])){
            $aSetTo = array($today=>1);
            $session['CURRENT_POST_TICKET'] = $aSetTo;            
        }else{
            if($session['CURRENT_POST_TICKET'][$today] > Yii::app()->params['limit_post_ticket']){
                return false;
            }
            $CurrentPost = $session['CURRENT_POST_TICKET'][$today];
            $CurrentPost++;
            $aSetTo = array($today=>$CurrentPost);
            $session['CURRENT_POST_TICKET'] = $aSetTo;
        }
        return true;
    }
    
    
    // dùng để hiện thị tên ở ngoài, có thể format màu mè hoặc link gì đó ở chỗ này dc
    public static function ShowNameReply($mUser){
        if(is_null($mUser)) return '';
        return $mUser->first_name;
//        $session=Yii::app()->session;
//        return $mUser->first_name." - ".$session['ROLE_NAME_USER'][$mUser->role_id];
    }
    // dùng để hiện thị tên ở ngoài, có thể format màu mè hoặc link gì đó ở chỗ này dc
    public static function ShowNameReplyAtDetailTicket($mUser, $needMore = array()){
        if(is_null($mUser)) return '';
        if ( isset($needMore['mDetailTicket']) ){            
            // Jan 26, 2015 thêm cột lưu lại tên user ở thời điểm xử lý ticket
            $mDetailTicket = $needMore['mDetailTicket'];
            if( !empty($mDetailTicket->c_name) ){
                return $mDetailTicket->c_name;
            }
        }
        
        return $mUser->first_name;
//        $session=Yii::app()->session;
//        return $mUser->first_name." - ".$session['ROLE_NAME_USER'][$mUser->role_id];
    }
    
    protected function beforeDelete() {
        GasTicketsDetail::deleteByTicketId($this->id);
        return parent::beforeDelete();
    }
    
    /**
     * @Author: ANH DUNG Aug 10, 2014
     * @Todo: lấy danh sách người xử lý, hiện tại chỉ cho 1 điều phối xử lý tạo KH
     */
    public static function GetListSendTo(){
//        $res = array(57916=>'Nguyễn Hoàng Thúc(Tạo KH, Sale)');
        $res = GasTickets::$HANDLE_TICKET;
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Aug 10, 2014
     * @Todo: lấy danh sách người xử lý, hiện tại chỉ cho 1 điều phối xử lý tạo KH
     */
    public static function CountNotify(){
        $uidLogin = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', GasTickets::STATUS_OPEN);
        $strStatus =  GasTickets::PROCESS_STATUS_NEW.','.GasTickets::PROCESS_STATUS_PICK;
        if(GasCheck::isAllowAccess('tickets', 'pick_ticket')): 
            // nếu là user xử lý ticket thì sẽ ntn
            if(Yii::app()->user->role_id == ROLE_ADMIN){
                $criteria->addCondition(
                    " ( t.send_to_id=0 AND t.process_status=".GasTickets::PROCESS_STATUS_NEW .") OR ".
                    " (t.process_status=".GasTickets::PROCESS_STATUS_NEW ." AND t.uid_login<>$uidLogin) OR".
//                    " ( t.process_status IN ($strStatus) AND t.uid_login<>$uidLogin) OR".
                    " (t.process_status=".GasTickets::PROCESS_STATUS_PICK ." AND t.uid_login<>$uidLogin AND t.process_user_id=$uidLogin) OR".
                    " (t.process_status=".GasTickets::PROCESS_STATUS_FINISH ." AND t.uid_login=$uidLogin AND t.process_user_id<>$uidLogin)"
                    ); 
            }else{ // điều phối xử lý ticket
                $criteria->addCondition(
                    " ( t.uid_login=$uidLogin AND t.process_status=".GasTickets::PROCESS_STATUS_FINISH.") OR ".
                    " ( t.send_to_id=$uidLogin AND t.process_status=".GasTickets::PROCESS_STATUS_NEW ." ) OR ".
                    " ( t.send_to_id=$uidLogin AND t.process_status=".GasTickets::PROCESS_STATUS_PICK ." AND t.process_user_id=$uidLogin )"
//                    " ( t.send_to_id=$uidLogin AND t.process_status IN ($strStatus) )"
                    ); 
            }
        else: // nếu là đại lý gửi
//            $criteria->compare('t.uid_login', $uidLogin);
//            $criteria->addInCondition('t.process_status', array(GasTickets::PROCESS_STATUS_FINISH));
            $criteria->addCondition(
                " ( t.uid_login=$uidLogin AND t.process_status=".GasTickets::PROCESS_STATUS_FINISH.") OR ".
                " ( t.send_to_id=$uidLogin AND t.process_status=".GasTickets::PROCESS_STATUS_NEW ." )"
                ); 
        endif;
        
        return self::model()->count($criteria);
    }
}