<?php

/**
 * This is the model class for table "{{_gas_schedule_notify_history}}".
 *
 * The followings are the available columns in table '{{_gas_schedule_notify_history}}':
 * @property string $id
 * @property integer $status
 * @property string $user_id
 * @property integer $type
 * @property string $obj_id
 * @property string $time_send
 * @property string $created_date
 * @property string $username
 * @property string $title
 * @property string $json_var
 */
class GasScheduleNotifyHistory extends CActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_VIEW = 2;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasScheduleNotifyHistory the static model class
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
            return '{{_gas_schedule_notify_history}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, status, user_id, type, obj_id, time_send, created_date, username, title, json_var', 'safe'),
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
            'status' => 'Status',
            'user_id' => 'User',
            'type' => 'Type',
            'obj_id' => 'Obj',
            'time_send' => 'Time Send',
            'created_date' => 'Created Date',
            'username' => 'Username',
            'title' => 'Title',
            'json_var' => 'Json Var',
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
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.obj_id',$this->obj_id,true);
        $criteria->compare('t.time_send',$this->time_send,true);
        $criteria->compare('t.created_date',$this->created_date,true);
        $criteria->compare('t.username',$this->username,true);
        $criteria->compare('t.title',$this->title,true);
        $criteria->compare('t.json_var',$this->json_var,true);

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
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: copy từ bảng schedule notify sang bảng history
     * khi ở dưới app client send request lên là đã nhận dc thì sẽ tạo mới record bên history và xóa bên bảng notify đi
     * @Param: $mScheduleNotify model schedule notify
     */
    public static function InsertNew($mScheduleNotify) {
        $mHistory = new GasScheduleNotifyHistory();
        $aFieldNotCopy = array('id');
        MyFormat::copyFromToTable($mScheduleNotify, $mHistory, $aFieldNotCopy);
        $mHistory->status = GasScheduleNotifyHistory::STATUS_NEW;
        // Add new history
        $mHistory->save();
        //client was received then delete schedule notify
        $mScheduleNotify->delete();
        $mHistory->HandleUpholdCount();
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: xử lý đếm số lần notify cho bảo trì sự cố
     * @Param: 
     */
    public function HandleUpholdCount() {
        if($this->type == GasScheduleNotify::UPHOLD_ALERT_10){
            $mUphold = GasUphold::model()->findByPk($this->obj_id);
            if($mUphold){
                $mUphold->NotifyCountAlertUpdate($this);
            }
        }
    }
    
    /**
    * @Author: ANH DUNG Dec 22, 2015
    * @Todo: get listing notify history of user
    * @param: $q object post params
    * @param:  $mUser model user login
    */
    public static function ApiListing($q, $mUser) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id', $mUser->id);
        $criteria->compare('t.status', $q->type);
        $criteria->order = 't.id DESC';
        $dataProvider=new CActiveDataProvider('GasScheduleNotifyHistory',array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize' => GasAppOrder::API_LISTING_ITEM_PER_PAGE,
                'currentPage' => (int)$q->page,
            ),
          ));
        return $dataProvider;
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: get any thing from json var
     * @param: $field_name ex: reply_id của Uphold
     */
    public function getFromJsonVar($field_name) {
        $res = "0";
        $aJsonVar = json_decode($this->json_var, true);
        if(!empty($aJsonVar) && isset($aJsonVar[$field_name])){
            $res = $aJsonVar[$field_name];
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: get by id and user_id
     */
    public static function getByUserId($id, $user_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.id", $id);
        $criteria->compare("t.user_id", $user_id);
        return self::model()->find($criteria);
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     */
    public function setStatus($status) {
        $this->status = $status;
        $this->update(array('status'));
    }
    
    /**
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: get by id and user_id
     *  khi user view từ notify thì update status notify history luôn
     * @param $user_id
     * @param $type array or one
     * @param $obj_id
     */
    public static function updateStatusViewByAttribute($user_id, $type, $obj_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("user_id", $user_id);
        if(is_array($type)){
            $criteria->addInCondition("type", $type);
        }else{
            $criteria->compare("type", $type);
        }
        $criteria->compare("obj_id", $obj_id);
        $aUpdate = array('status' => self::STATUS_VIEW);
        self::model()->updateAll($aUpdate, $criteria);
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
     * @Author: ANH DUNG Dec 22, 2015
     * @Todo: get by id and user_id
     */
    public static function countByUserId($user_id, $status) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", $status);
        $criteria->compare("t.user_id", $user_id);
        return self::model()->count($criteria);
    }
    
}