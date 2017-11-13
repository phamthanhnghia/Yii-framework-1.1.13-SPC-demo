<?php

/**
 * This is the model class for table "{{_gas_leave_holidays}}".
 *
 * The followings are the available columns in table '{{_gas_leave_holidays}}':
 * @property string $id
 * @property string $name
 * @property string $date
 */
class GasLeaveHolidays extends CActiveRecord
{
    public $date_from;
    public $date_to;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasLeaveHolidays the static model class
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
            return '{{_gas_leave_holidays}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('name', 'length', 'max'=>255),
                    array('name, date', 'required'),
                    array('date_from,date_to,id, name, date', 'safe'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
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
                    'name' => 'Tên Ngày Lễ',
                    'date' => 'Ngày Dương Lịch',
                'date_from' => 'Từ Ngày',
                    'date_to' => 'Đến Ngày',      
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
		$criteria->compare('t.name',$this->name,true);
		$date_from = '';
                $date_to = '';
                if(!empty($this->date_from)){
                    $date_from = MyFormat::dateDmyToYmdForAllIndexSearch($this->date_from);
                }
                if(!empty($this->date_to)){
                    $date_to = MyFormat::dateDmyToYmdForAllIndexSearch($this->date_to);
                }
                
                if(!empty($date_from) && empty($date_to))
                        $criteria->addCondition("t.date>='$date_from'");
                if(empty($date_from) && !empty($date_to))
                        $criteria->addCondition("t.date<='$date_to'");
                if(!empty($date_from) && !empty($date_to))
                        $criteria->addBetweenCondition("t.date",$date_from,$date_to);

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
    
    
    protected function beforeSave() {
        if(strpos($this->date, '/')){
            $this->date = MyFormat::dateConverDmyToYmd($this->date);
            MyFormat::isValidDate($this->date);
        }
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: get number of days holidays
     * @Param: $date_from: 2014-09-27
     * @Param: $date_to: 2014-09-28
     * @return: number of day
     */
    public static function getNumberOfDayHolidays($date_from, $date_to) {
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.date", $date_from, $date_to);
        return self::model()->count($criteria);
    }
    
}