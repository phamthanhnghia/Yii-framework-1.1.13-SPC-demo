<?php

/**
 * This is the model class for table "{{_gas_master_lookup}}".
 *
 * The followings are the available columns in table '{{_gas_master_lookup}}':
 * @property integer $id
 * @property string $name
 * @property integer $display_order
 * @property integer $type 
 * @property integer $status
 * @property string $name_vi
 */
class GasLookup extends _BaseModel
{
    const TYPE_BRAND = 1;
    
        
    /**
     * @Author: ANH DUNG Feb 23, 2016
     * @Todo: get array type of Lookup
     */
    public function getArrayType() {
        return array(
            GasLookup::TYPE_BRAND=>"Brand"
        );
    }
    
    /**
     * @Author: ANH DUNG Feb 23, 2016
     */
    public function getType() {
        $aType = $this->getArrayType();
        return isset($aType[$this->type]) ? $aType[$this->type] : "";
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getDisplayOrder() {
        return $this->display_order;
    }
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasMasterLookup the static model class
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
            return '{{_gas_master_lookup}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type', 'required'),
            array('name', 'length', 'max'=>200),
            array('slug, id, name, display_order, type, status, name_vi', 'safe'),
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
            'name' => 'Tên',
            'display_order' => 'Thứ Tự Hiển Thị',
            'type' => 'Loại',
            'status' => 'Status',
            'name_vi' => 'Name Vi',
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
        $criteria->compare('t.name',$this->name_vi,true);
        $criteria->compare('t.display_order',$this->display_order);
        $criteria->compare('t.type',$this->type);
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
    
    protected function beforeValidate() {
        $this->name_vi = MyFunctionCustom::remove_vietnamese_accents($this->name);
        return parent::beforeValidate();
    }
    
    public function behaviors(){
        return array(
            'sluggable' => array(
                'class'=>'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('name_vi'),
                'unique' => true,
                'update' => true,
            ),
        );
    }

    
}