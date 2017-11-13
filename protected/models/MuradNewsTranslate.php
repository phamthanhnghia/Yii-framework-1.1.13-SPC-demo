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
class MuradNewsTranslate extends CActiveRecord
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
            return '{{_murad_news_translate}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, translate_id, language, name, short_content, content', 'safe'),
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
                'translate_id' => 'Translate',
                'language' => 'Language',
                'name' => 'Name',
                'short_content' => 'Short Content',
                'content' => 'Content',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }
    
    public function getName() { // Aug 04, 2016
        return $this->name;
    }
    public function getShortContent() {
        return $this->short_content;
    }
    public function getContent() {
        return $this->content;
    }

    protected function beforeSave() {
//        $aAttributes = array('short_content', 'content');// Aug 13, 2016 không thể remove kiểu này dc, sẽ bị lỗi js với tab và accrordtab
//        MyFormat::RemoveScriptOfModelField($this, $aAttributes);
        return parent::beforeSave();
    }
}