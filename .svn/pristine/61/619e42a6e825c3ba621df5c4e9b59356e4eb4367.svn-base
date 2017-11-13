<?php

/**
 * This is the model class for table "{{_murad_product_info}}".
 *
 * The followings are the available columns in table '{{_murad_product_info}}':
 * @property integer $id
 * @property integer $product_id
 * @property string $description
 * @property string $info
 * @property string $short_description
 * @property string $how_to_use
 */
class MuradProductInfo extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradProductInfo the static model class
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
        return '{{_murad_product_info}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('url_video, component, id, product_id, short_description, description, info, how_to_use', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rProduct' => array(self::BELONGS_TO, 'MuradProduct', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'product_id' => 'Product',
            'description' => 'Description',
            'info' => 'Info',
            'short_description' => 'Short Description',
            'how_to_use' => 'How To Use',
            'component' => 'Thành Phần',
            'url_video' => 'Iframe Video',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.product_id',$this->product_id);
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public function getShortDescription() {
        return nl2br($this->short_description);
    }
    public function getDescription() {
        return $this->description;
    }
    
    public function getInfo() {
        return $this->info;
    }
    
    public function getHowToUse() {
        return $this->how_to_use;
    }
    
    public function getComponent() {
        return $this->component;
    }
    
    public function getIframeVideo() {
        return $this->url_video;
    }
    
    protected function beforeSave() {
        $this->url_video = str_replace('<iframe width="853" height="480"', '<iframe width="100%" height="300"', $this->url_video);
        return parent::beforeSave();
    }
}