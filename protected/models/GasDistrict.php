<?php

/**
 * This is the model class for table "{{_gas_district}}".
 *
 * The followings are the available columns in table '{{_gas_district}}':
 * @property integer $id
 * @property integer $province_id
 * @property string $name
 * @property string $short_name
 * @property integer $status
 */
class GasDistrict extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasDistrict the static model class
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
            return '{{_gas_district}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('province_id, status', 'numerical', 'integerOnly'=>true),
                    array('name', 'length', 'max'=>150),
                    array('short_name', 'length', 'max'=>100),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, province_id, name, short_name, status', 'safe'),
                    array('province_id, name', 'required','on'=>'create,update'),
                    array('short_name+province_id', 'application.extensions.uniqueMultiColumnValidator'),
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
                'province' => array(self::BELONGS_TO, 'GasProvince', 'province_id'),
                'user' => array(self::BELONGS_TO, 'Users', 'user_id_create'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'province_id' => 'Tỉnh/TP',
                    'name' => 'Tên Quận/Huyện',
                    'short_name' => 'Tên Quận/Huyện',
                    'status' => 'Status',
                'user_id_create' => 'Người Tạo',
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

            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.province_id',$this->province_id);
            $criteria->compare('t.name',$this->name,true);
            $criteria->compare('t.short_name',$this->short_name,true);
            $criteria->compare('t.status',$this->status);
            $aWith=array();
            $aWith[] = 'province';  
            $criteria->together = true;
            $criteria->with = $aWith;
            $sort = new CSort();
            $sort->attributes = array(
//                    'name'=>'short_name',
                'province_id'=>array(
                        'asc'=>'province.name',
                        'desc'=>'province.name DESC',
                ),         
                'name'=>array(
                        'asc'=>'t.short_name',
                        'desc'=>'t.short_name DESC',
                ),         

            );    
            $sort->defaultOrder = 't.id DESC';                 
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                    ),
                    'sort' => $sort,
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

    public static function getArrAll($province_id='')
    {
        $criteria = new CDbCriteria;
        if(!empty($province_id))
            $criteria->compare('t.province_id', $province_id);
        else {
            return array();
        }
        return  CHtml::listData(self::model()->findAll($criteria),'id','name');
    }            

    public function beforeSave() {
        $this->name = trim($this->name);
        $this->short_name = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->name));
        if($this->isNewRecord){
            $this->user_id_create = Yii::app()->user->id;
        }            
        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->name = trim($this->name);
        $this->short_name = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->name));
        return parent::beforeValidate();
    }

    public function behaviors()
    {
        return array(
            'sluggable' => array(
                    'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                    'columns' => array('short_name'),
                    'unique' => true,
                    'update' => true,
            ), 
        );
    }           
        

        
}