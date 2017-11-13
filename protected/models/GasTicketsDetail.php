<?php

/**
 * This is the model class for table "{{_gas_tickets_detail}}".
 *
 * The followings are the available columns in table '{{_gas_tickets_detail}}':
 * @property string $id
 * @property string $ticket_id
 * @property string $message
 * @property string $uid_post
 * @property integer $type
 * @property string $created_date
 */
class GasTicketsDetail extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasTicketsDetail the static model class
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
            return '{{_gas_tickets_detail}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, ticket_id, message, uid_post, type, created_date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rUidPost' => array(self::BELONGS_TO, 'Users', 'uid_post'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'ticket_id' => 'Ticket',
                    'message' => 'Message',
                    'uid_post' => 'Uid Post',
                    'type' => 'Type',
                    'created_date' => 'Created Date',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('t.ticket_id',$this->ticket_id,true);
		$criteria->compare('t.message',$this->message,true);
		$criteria->compare('t.uid_post',$this->uid_post,true);
		$criteria->compare('t.type',$this->type);
		$criteria->compare('t.created_date',$this->created_date,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
        ),
            ));
    }

    /*
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	*/

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }
    
    /**
     * @Author: ANH DUNG Aug 09, 2014
     * @Todo: get detail ticket by ticket_id
     * @Param: $ticket_id
     */       
    public static function getByTicketId($ticket_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.ticket_id', $ticket_id);
        $criteria->order = 't.id DESC';
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 09, 2014
     * @Todo: delete detail ticket by ticket_id
     * @Param: $ticket_id
     */       
    public static function deleteByTicketId($ticket_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.ticket_id', $ticket_id);
        $models = self::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item){
                $item->delete();
            }
        }
    }
    
}