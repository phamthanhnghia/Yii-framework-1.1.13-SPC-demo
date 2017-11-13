<?php

/**
 * This is the model class for table "{{_murad_news_translate}}".
 *
 * The followings are the available columns in table '{{_murad_news_translate}}':
 * @property string $id
 * @property string $translate_id
 * @property string $language
 * @property string $name
 * @property string $short_content
 * @property string $content
 */
class MuradCategoryTranslate extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradNewsTranslate the static model class
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
        return '{{_murad_category_translate}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('translate_id', 'length', 'max'=>11),
            array('name', 'length', 'max'=>230),
            array('id, translate_id, language, name', 'safe'),
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
            'translate_id' => 'Translate',
            'language' => 'Language',
            'name' => 'Name',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.translate_id',$this->translate_id,true);
        $criteria->compare('t.language',$this->language,true);
        $criteria->compare('t.name',$this->name,true);
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public function getName() {
        return $this->name;
    }
}