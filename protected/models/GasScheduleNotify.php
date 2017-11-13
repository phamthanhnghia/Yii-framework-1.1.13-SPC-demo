<?php

/**
 * This is the model class for table "{{_gas_schedule_notify}}".
 *
 * The followings are the available columns in table '{{_gas_schedule_notify}}':
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property string $obj_id
 * @property string $time_send
 * @property string $created_date
 * @property string $title
 */
class GasScheduleNotify extends CActiveRecord
{
    const MAX_SEND = 20; // giới hạn max gửi 1 lần
    const MAX_COUNT_RUN = 2; // giới hạn max số lần gửi lại
    // tất cả notify sẽ đưa vào list chờ gửi hết, để không bị gửi sót cái nào
    const UPHOLD_ALERT_10 = 1;
    const UPHOLD_DINH_KY_1_DAY = 2;
    const ISSUE_TICKET = 3;
    const UPHOLD_CREATE = 4;//Dec 21, 2015 bị phân tích thiếu, tất cả notify sẽ đưa vào list chờ gửi hết, để không bị gửi sót cái nào
    // vì nếu send luôn thì có thể user bị offline nên không Nhận được, khi nhận được thì client sẽ gửi request lên server report nhận được
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasScheduleNotify the static model class
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
            return '{{_gas_schedule_notify}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, user_id, type, obj_id, time_send, created_date', 'safe'),
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
     * @Author: ANH DUNG Dec 02, 2015
     * @Todo: insert to db
     * @Flow1: bao tri su co 10 phut
     * 1/ insert 2 record to db 10' va 20'
     * 2/ cron send notify bình thường, send xong thì xóa notify đi
     * 3/ nếu user update status: xử lý hoặc Hoàn Thành thì xóa hết notify đi => End
     * @Flow2: bao tri định kỳ
     * 1/ đầu tháng chạy cron tạo các record trong tháng cho KH 
     * 2/ khi cron chạy thì tạo mới record Reply rồi mới send notify cho KH gửi lúc 6h sáng ngày YC
     * 3/ sau khi send thì xóa cron đi => End
     * @param: $json_var array any variable
     */
    public static function InsertRecord($user_id, $type, $obj_id, $time_send, $title, $json_var) {
        if(empty($time_send)){
            $time_send = date("Y-m-d H:i:s");
        }
        $AppLogin = UsersTokens::getByUserId($user_id);
        if(!$AppLogin){
            // kiểm tra user id này có login = app chưa 
            // nếu chưa login = app thì sẽ không build notify
            return;
        }
        
        $model = new GasScheduleNotify();
        $model->user_id = $user_id;
        $model->type = $type;
        $model->obj_id = $obj_id;
        $model->time_send = $time_send;
        $model->title = $title;
        $model->username = $model->rUser ? $model->rUser->username : "";
        $model->json_var = json_encode($json_var);
        $model->save();
    }

    /**
     * @Author: ANH DUNG Dec 02, 2015
     * @Todo: delete all by some condtion
     */
    public static function DeleteAllByType($type, $obj_id) {
        $criteria = new CDbCriteria;
        $criteria->compare("type", $type);
        $criteria->compare("obj_id", $obj_id);
        self::model()->deleteAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2015
     * @Todo: run cron notify
     */
    public static function RunCron() {
        $from = time();
        $data = self::getDataCron();
        foreach($data as $mScheduleNotify){
            switch ($mScheduleNotify->type){
                case GasScheduleNotify::UPHOLD_ALERT_10:
                    self::HandleAlert10($mScheduleNotify);
                    break;
                case GasScheduleNotify::UPHOLD_DINH_KY_1_DAY:
                    self::HandleAlertDinhKy($mScheduleNotify);
                    break;
                case GasScheduleNotify::ISSUE_TICKET:
                    self::HandleAlertIssueTicket($mScheduleNotify);
                    break;
                case GasScheduleNotify::UPHOLD_CREATE:
                    self::UpholdCreate($mScheduleNotify);
                    break;
            }
//            $mScheduleNotify->delete();// Xóa luôn sau khi send notify
            $mScheduleNotify->plusRun();// plus 1 when run
            // close on Dec 22, 2015 sẽ không xóa ở đây nữa, mà khi nào client nhận dc notify thì mới xóa, nếu chưa nhận dc thì cứ send bình thường
        }
        $to = time();
        $second = $to-$from;
        $CountData = count($data);
        $ResultRun = "CRON Notify App: ".$CountData.' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes ';
        $ResultRun .= implode(" --- ", CHtml::listData($data, "user_id", "username"));
        if($CountData){
            Logger::WriteLog($ResultRun);
        }
    }

    /**
     * @Author: ANH DUNG Dec 21, 2015
     * BT sự cố tạo mới và reply
     */
    public static function UpholdCreate($mScheduleNotify) {
        $mUphold = GasUphold::model()->findByPk($mScheduleNotify->obj_id);
        if($mUphold){
            $mUphold->ApiSendNotify(array($mScheduleNotify->user_id), $mScheduleNotify->title, 0, $mScheduleNotify);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2015
     * BT sự cố 10' send 1 lần ( send 2 lần cho 1 Record)
     */
    public static function HandleAlert10($mScheduleNotify) {
        $mUphold = GasUphold::model()->findByPk($mScheduleNotify->obj_id);
        if($mUphold){
            $mUphold->NotifyCronAlert($mScheduleNotify);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2015
     * BT định kỳ, gửi 6h sáng mỗi ngày
     */
    public static function HandleAlertDinhKy($mScheduleNotify) {
        $mUphold = GasUphold::model()->findByPk($mScheduleNotify->obj_id);
        if($mUphold){
            // 1. tạo 1 record mới của Reply 
            $mReply = GasUpholdReply::CronCreateReplyDinhKy($mUphold);
            // 2. send notify theo model Reply moi tao
            $json_var = array("reply_id" => $mReply->id);
            $mScheduleNotify->UpdateJsonVar($json_var);
            $mUphold->NotifyCronAlertDinhKy($mReply, $mScheduleNotify);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: phải update lại cái reply_id vì khi view ở history nếu không có cái reply_id này thì không view dc
     */
    public function UpdateJsonVar($json_var) {
        $this->json_var = json_encode($json_var);
        $this->update(array('json_var'));
    }
    
    /**
     * @Author: ANH DUNG Dec 11, 2015
     * Issue Ticket notify
     */
    public static function HandleAlertIssueTicket($mScheduleNotify) {
        $mIssue = GasIssueTickets::model()->findByPk($mScheduleNotify->obj_id);
        if($mIssue){
            $aUid = array($mScheduleNotify->user_id);
            $mIssue->ApiSendNotify($aUid, $mScheduleNotify);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2015
     * @Todo: get data thỏa mãn cron để send
     */
    public static function getDataCron() {
        // Dec 26, 2015 xử lý khi count_run > 5 thì ngừng send lại, có thể user đã offline
        // Nếu user online trở lại thì ở hàm update config mình sẽ reset count_run về 0 cho những count run > 5
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.time_send <= NOW() AND t.count_run < ".GasScheduleNotify::MAX_COUNT_RUN);
        $criteria->order = "t.count_run ASC, t.id DESC";
        $criteria->limit = GasScheduleNotify::MAX_SEND;
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: get data thỏa mãn condition
     * @param $user_id 
     * @param $notify_id primary key
     * @param $type 
     * @param $obj_id 
     */
    public static function getRecord($user_id, $notify_id, $type, $obj_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.id", $notify_id);
        $criteria->compare("t.user_id", $user_id);
        $criteria->compare("t.type", $type);
        $criteria->compare("t.obj_id", $obj_id);
        return self::model()->find($criteria);
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
     * @Author: ANH DUNG Dec 26, 2015
     * @Todo: reset so lần count run của notify = 0
     * update khi app run update config
     */
    public static function ResetCountRun($user_id) {
        $criteria = new CDbCriteria();
        $criteria->compare( 'user_id', $user_id);
        $aUpdate = array('count_run' => 0);
        GasScheduleNotify::model()->updateAll($aUpdate, $criteria);
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: move những record được tạo 1 ngày trước qua bên table history
     * GasScheduleNotify::moveNotifyToHistory();
     */
    public static function moveNotifyToHistory() {
        $from = time();
        $criteria=new CDbCriteria;
        $criteria->addCondition("DATE_ADD(created_date, INTERVAL 1 DAY) < NOW()");
        $models = self::model()->findAll($criteria);
        $CountData = count($models);
        foreach($models as $mScheduleNotify) {
            GasScheduleNotifyHistory::InsertNew($mScheduleNotify);
        }
        $to = time();
        $second = $to-$from;
        $ResultRun = "CRON App MoveNotifyToHistory : ".$CountData.' done in: '.($second).'  Second  <=> '.round($second/60, 2).' Minutes ';
        if($CountData){
            Logger::WriteLog($ResultRun);
        }
    }
    
    
}