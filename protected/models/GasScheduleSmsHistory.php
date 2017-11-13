<?php

/**
 * This is the model class for table "{{_gas_schedule_sms_history}}".
 *
 * The followings are the available columns in table '{{_gas_schedule_sms_history}}':
 * @property string $id
 * @property string $smsid
 * @property integer $code_response
 * @property string $phone_number
 * @property string $user_id
 * @property string $username
 * @property integer $type
 * @property string $obj_id
 * @property string $title
 * @property string $json_var
 * @property string $count_run
 * @property string $time_send
 * @property string $created_date
 * @property string $created_date_on_history
 */
class GasScheduleSmsHistory extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasScheduleSmsHistory the static model class
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
            return '{{_gas_schedule_sms_history}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, smsid, code_response, phone_number, user_id, username, type, obj_id, title, json_var, count_run, time_send, created_date, created_date_on_history', 'safe'),
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
            'smsid' => 'Smsid',
            'code_response' => 'Code Response',
            'phone_number' => 'Phone Number',
            'user_id' => 'User',
            'username' => 'Username',
            'type' => 'Type',
            'obj_id' => 'Obj',
            'title' => 'Title',
            'json_var' => 'Json Var',
            'count_run' => 'Count Run',
            'time_send' => 'Time Send',
            'created_date' => 'Created Date',
            'created_date_on_history' => 'Created Date On History',
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
            $criteria->compare('t.smsid',$this->smsid,true);
            $criteria->compare('t.code_response',$this->code_response);
            $criteria->compare('t.phone_number',$this->phone_number,true);
            $criteria->compare('t.user_id',$this->user_id,true);
            $criteria->compare('t.username',$this->username,true);
            $criteria->compare('t.type',$this->type);
            $criteria->compare('t.obj_id',$this->obj_id,true);
            $criteria->compare('t.title',$this->title,true);
            $criteria->compare('t.json_var',$this->json_var,true);
            $criteria->compare('t.count_run',$this->count_run,true);
            $criteria->compare('t.time_send',$this->time_send,true);
            $criteria->compare('t.created_date',$this->created_date,true);
            $criteria->compare('t.created_date_on_history',$this->created_date_on_history,true);

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
     * @Todo: copy từ bảng schedule SMS notify sang bảng history
     * khi send thành công thì sẽ move sang history
     * @Param: $mScheduleSms model schedule notify
     */
    public static function InsertNew($mScheduleSms) {
        $mHistory = new GasScheduleSmsHistory();
        $aFieldNotCopy = array('id');
        MyFormat::copyFromToTable($mScheduleSms, $mHistory, $aFieldNotCopy);
        // Add new history
        $mHistory->save();
        //client was received then delete schedule notify SMS
        $mScheduleSms->delete();
    }
}