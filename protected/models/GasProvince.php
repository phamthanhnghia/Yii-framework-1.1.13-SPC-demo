<?php

/**
 * This is the model class for table "{{_gas_province}}".
 *
 * The followings are the available columns in table '{{_gas_province}}':
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property integer $status
 */
class GasProvince extends CActiveRecord
{
    public static $SHORT_NAME_AGENT = array(
        100=>'Quận 2',
        101=>'Quận 4',
        102=>'Quận 7',
        103=>'Quận 8.1',
        104=>'Quận 8.2',
        105=>'Quận 9',
        106=>'Bình Thạnh',
        107=>'Gò Vấp',
        108=>'Hóc Môn',
        109=>'Lái Thiêu',
        110=>'Thủ Dầu Một',
        111=>'Bến Cát',
        112=>'Thủ Đức',
        113=>'Quận 3',
        114=>'Long Bình Tân',
        115=>'Dĩ An',
        116=>'Bình Đa',
        117=>'Thống Nhất',
        118=>'An Thạnh',
        119=>'Tân Định',
        120=>'Tân Sơn',
        121=>'Ngã 3 Trị An',
        122=>'Bình Tân',
        123=>'Trảng Dài',
        126=>'Tân Phú',
        235=>'Tân Bình 1',
        1210=>'Thuận Giao',
        1311=>'CH 1',
        1312=>'CH 2',
        1313=>'CH 3',
        1314=>'CH 4',
        1315=>'CH 5',        
        1457=>'Đồng An',
        25785=>'Kho Phước Tân',
        26282=>'Cửa hàng Huy Hoàng',
        26677=>'Kho Bến Cát',
        26678=>'Kho Tân Sơn',
    );
    
    const KV_MIEN_TAY = 18;
    
    const TINH_GIALAI = 5;
    const TINH_KONTUM = 6;
    public static $PROVINCE_TAY_NGUYEN = array(
        GasProvince::TINH_GIALAI,
        GasProvince::TINH_KONTUM,
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
            return '{{_gas_province}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('status', 'numerical', 'integerOnly'=>true),
                    array('name', 'length', 'max'=>200),
                    array('short_name', 'length', 'max'=>100),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, name, short_name, status', 'safe', 'on'=>'search'),
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
                    'name' => 'Name',
                    'short_name' => 'Short Name',
                    'status' => 'Status',
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
            $criteria->compare('t.name',$this->name,true);
            $criteria->compare('t.short_name',$this->short_name,true);
            $criteria->compare('t.status',$this->status);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
        ),
            ));
    }

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }

    public static function getArrAll()
    {
        $models = self::model()->findAll();
        return  CHtml::listData($models,'id','name');
    }        
        
    public static function getArrModel()
    {
        $criteria = new CDbCriteria;
        $models = self::model()->findAll($criteria);
        $res=array();
        foreach ($models as $item)
                $res[$item->id] = $item;
        return  $res;         
    }   	        
        
        
    public function beforeSave() {
        $this->short_name = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->name));
        return parent::beforeSave();
    }

    public function beforeValidate() {
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