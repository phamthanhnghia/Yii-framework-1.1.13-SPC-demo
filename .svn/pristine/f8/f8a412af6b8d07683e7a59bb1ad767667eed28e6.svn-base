<?php

/**
 * This is the model class for table "{{_logger}}".
 *
 * The followings are the available columns in table '{{_logger}}':
 * @property integer $id
 * @property string $level
 * @property string $category
 * @property integer $logtime
 * @property string $message
 */
class Logger extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Logger the static model class
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
            return '{{_logger}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
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
                    'level' => 'Level',
                    'category' => 'Category',
                    'logtime' => 'Logtime',
                    'message' => 'Message',
                    'ip_address' => 'ip address',
                    'country' => 'Country',
                    'description' => 'Description',
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

            $criteria->compare('id',$this->id);
            $criteria->compare('level',$this->level,true);
            $criteria->compare('category',$this->category,true);
            $criteria->compare('logtime',$this->logtime);
            $criteria->compare('message',$this->message,true);
            $sort = new CSort();
            $sort->attributes = array(
                'uid_login'=>'uid_login',
                'ip_address'=>'ip_address',
                'country'=>'country',
                'description'=>'description',
                'created_date'=>'created_date',

            );    
            $sort->defaultOrder = 't.id desc';

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'sort' => $sort,
                    'sort' => $sort,
                    'pagination'=>array(
                        'pageSize'=> 100,
                    ),
            ));
    }
        
    /**
     * @Author: ANH DUNG Sep 28, 2014
     * @Todo: write log
     */
    public static function WriteLog($message,$level='info',$category='anhdung') {
        $model = new Logger();
        $model->message = $message;
        $model->level = $level;
        $model->category = $category;
        $model->logtime = time();
        $model->save();
    }

    
}