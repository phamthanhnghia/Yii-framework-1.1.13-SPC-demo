<?php

/**
 * This is the model class for table "{{_languages}}".
 *
 * The followings are the available columns in table '{{_languages}}':
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property integer $status
 */
class Languages extends _BaseModel {

    public static $aCode = array(
        "vi" => "Việt Nam",
        "en" => "English",
    );
    public static function getCurrentImage(){
        return Yii::app()->theme->baseUrl."/img/lang_".Yii::app()->language.".jpg";
    }
    
    public static function getCurrentLangText(){
        return isset(Languages::$aCode[Yii::app()->language]) ?  Languages::$aCode[Yii::app()->language] : Languages::$aCode['vi'];
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     * @Todo: check valid lang
     */
    public static function getValidLang($lang){
        return isset(Languages::$aCode[$lang]) ? $lang : "vi";
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_languages}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title,code', 'required', 'on' => 'create, update'), 
            array('id, title, code, status', 'safe'),
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
            'id' => Yii::t('translation','ID'),
            'title' => Yii::t('translation','Title'),
            'code' => Yii::t('translation','Code'),
            'status' => Yii::t('translation','Status'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('code',$this->code,true);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->params['defaultPageSize'],
                ),
        ));
    }


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

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Languages the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function nextOrderNumber()
    {
        return Languages::model()->count() + 1;
    }

    public static function getAlllanguage(){
        $criteria=new CDbCriteria;
        $criteria->order = 't.id ASC';
        return Languages::model()->findAll($criteria);
    }

    public static function getListLanguage()
    {
        $criteria = new CDbCriteria ();
        $criteria->compare('status', STATUS_ACTIVE);
        $criteria->order = 't.default DESC, t.title ASC';
        $data = Languages::model()->findAll($criteria);
        return CHtml::listData($data, 'id', 'title');
    }

    public static function getListLanguageFE()
    {
        $criteria = new CDbCriteria ();
        $criteria->compare('status', STATUS_ACTIVE);
        $criteria->order = 't.default DESC, t.title ASC';
        $data = Languages::model()->findAll($criteria);
        return CHtml::listData($data, 'code', 'title');
    }

    public function showDefault(){
        if($this->default){
            return 'Default';
        }
        return "";
    }
    
    /**
     * @Author: ANH DUNG Jun 18, 2016
     */
    public function getLinkUpdateText() {
        $link = Yii::app()->createAbsoluteUrl("admin/languages/updateTextTranslate", array('id'=>  $this->id));
        return "<a href='$link' target='_blank'>Update Text</a>";
    }

}
