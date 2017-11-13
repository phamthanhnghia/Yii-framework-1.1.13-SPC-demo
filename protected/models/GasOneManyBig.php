<?php

/**
 * This is the model class for table "{{_gas_one_many_big}}".
 *
 * The followings are the available columns in table '{{_gas_one_many_big}}':
 * @property string $id
 * @property integer $one_id
 * @property integer $many_id
 * @property integer $type
 */
class GasOneManyBig extends CActiveRecord
{
    // các define trước của Type ở ngoài config.local
    const TYPE_PRODUCT_TYPE = 1;// Mar 07, 2016 product type
    const TYPE_ORDER_PROMOTION = 10;// Dec 30, 2015 type user nhận đặt hàng KM 
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{_gas_one_many_big}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, one_id, many_id, type', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
//			'one' => array(self::BELONGS_TO, 'Users', 'one_id'),
//            'material' => array(self::BELONGS_TO, 'GasMaterials', 'many_id'),
            // add more if need
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'one_id' => 'One',
            'many_id' => 'Many',
            'type' => 'Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.type',$this->type);
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
        
// get mảng many id cho drop downlist or checkbox list multiselect
    public static function getArrOfManyId($one_id, $type)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.one_id',$one_id);
        $criteria->compare('t.type',$type);
        $criteria->order = "t.id asc";
        return CHtml::listData(self::model()->findAll($criteria),'many_id','many_id');  
    }

    /**
     * @Author: ANH DUNG Mar 07, 2016
     * @Todo: 1. for product: get list product id by product type id
     */
    public static function getArrOfOneId($many_id, $type)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.many_id',$many_id);
        if(is_array($type)){
            $criteria->addInCondition('t.type',$type);
        }else{
            $criteria->compare('t.type',$type);
        }
        
        $criteria->group = "t.one_id";
        return CHtml::listData(self::model()->findAll($criteria),'one_id','one_id');  
    }
    // get mảng many id cho drop downlist or checkbox list multiselect
    public static function getArrModelOfManyId($one_id, $type)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.one_id',$one_id);
        $criteria->compare('t.type',$type);
        $criteria->order = "t.id asc";
        return  self::model()->findAll($criteria);  
    }
	
	/**
     * @Author: ANH DUNG Sep 24, 2015
     * @Todo: something
     * GasOneManyBig::saveArrOfManyId($model->id, ONE_SELL_MAINTAIN_PROMOTION, 'GasMaintainSell', 'one_many_gift');
     */
    public static function saveArrOfManyId($one_id, $type, $name_model, $name_field)
    {
        GasOneManyBig::deleteOneByType($one_id, $type);
        $aRowInsert=array();
        
        if (isset($_POST[$name_model][$name_field]) && is_array($_POST[$name_model][$name_field]) && count($_POST[$name_model][$name_field]) > 0) {
                foreach ($_POST[$name_model][$name_field] as $item) {
                        $aRowInsert[]="('$one_id',
                '$item',
                '$type'    
                )";
                }
                $tableName = self::model()->tableName();
            $sql = "insert into $tableName (one_id,
                            many_id,
                            type
                            ) values ".implode(',', $aRowInsert);
            if(count($aRowInsert)>0)
                Yii::app()->db->createCommand($sql)->execute();          			
			
        }		
    }
    
    public static function deleteOneByType($one_id, $type=false){
        $criteria=new CDbCriteria;
        $criteria->compare('one_id',$one_id);
        if($type){
            $criteria->compare('type',$type);
        }
        self::model()->deleteAll($criteria);        
    }
    
    /**
     * @Author: ANH DUNG Sep 25, 2015
     * @Todo: get array model user order by thứ tự thêm vào
     */
    public static function getArrayModelUser($one_id, $type, $needMore=array()) {
        $aUid = GasOneManyBig::getArrOfManyId($one_id, $type);
        $aModelUser = Users::getArrayModelByArrayId($aUid);
        $aRes = array();
        if(isset($needMore['get_id_name'])){
            foreach($aUid as $id){// for kiểu này để giữ lại cái order như khi thêm mới
                $aRes[$id] = $aModelUser[$id]->first_name;
            }
        }else{
            foreach($aUid as $id){// for kiểu này để giữ lại cái order như khi thêm mới
                $aRes[$id] = $aModelUser[$id];
            }
        }
        return $aRes;
    }
    
}