<?php

/**
 * This is the model class for table "{{_gas_ward}}".
 *
 * The followings are the available columns in table '{{_gas_ward}}':
 * @property integer $id
 * @property integer $province_id
 * @property integer $district_id
 * @property string $name
 * @property string $name_vi
 * @property string $slug
 */
class GasWard extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasWard the static model class
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
            return '{{_gas_ward}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('province_id, district_id, name', 'required'),
                    array('province_id, district_id', 'numerical', 'integerOnly'=>true),
                    array('name, name_vi, slug', 'length', 'max'=>200),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, province_id, district_id, name, name_vi, slug', 'safe'),
                array('name_vi+district_id+province_id', 'application.extensions.uniqueMultiColumnValidator'),
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
                'district' => array(self::BELONGS_TO, 'GasDistrict', 'district_id'),
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
                    'district_id' => 'Quận/Huyện',
                    'name' => 'Tên Phường/Xã',
                    'name_vi' => 'Tên Phường/Xã',
                    'slug' => 'Slug',
                    'user_id_create' => 'Người Tạo',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.province_id',$this->province_id);
        $criteria->compare('t.district_id',$this->district_id);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.name_vi',$this->name_vi,true);
        $criteria->compare('t.slug',$this->slug,true);
        $aWith=array();
        $aWith[] = 'province';  
        $aWith[] = 'district';  
        $criteria->together = true;
        $criteria->with = $aWith;
        $sort = new CSort();
        $sort->attributes = array(
            'province_id'=>array(
                    'asc'=>'province.name',
                    'desc'=>'province.name DESC',
            ),
            'district_id'=>array(
                    'asc'=>'district.name',
                    'desc'=>'district.name DESC',
            ),
            'name'=>array(
                    'asc'=>'t.name_vi',
                    'desc'=>'t.name_vi DESC',
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

    public static function getArrAll($province_id='', $district_id='')
    {
        $criteria = new CDbCriteria;
        if(!empty($province_id))
                $criteria->compare('t.province_id', $province_id);
        if(!empty($district_id))
                $criteria->compare('t.district_id', $district_id);
        if(empty($province_id) && empty($district_id))
        {
            return array();
        }

        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','name');
    }

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }

    public function beforeSave() {
        $this->name = trim($this->name);
        $this->name_vi = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->name));            
        if($this->isNewRecord){
            $this->user_id_create = Yii::app()->user->id;
        }                        
        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->name = trim($this->name);
        $this->name_vi = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->name));
        return parent::beforeValidate();
    }

    public function behaviors()
    {
        return array(
            'sluggable' => array(
                    'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                    'columns' => array('name_vi'),
                    'unique' => true,
                    'update' => true,
            ), 
        );
    }            
}