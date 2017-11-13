<?php
/**
 * This is the model class for table "{{_gas_comment}}".
 *
 * The followings are the available columns in table '{{_gas_comment}}':
 * @property string $id
 * @property integer $type
 * @property string $belong_id
 * @property string $content
 * @property string $created_date
 */
class GasComment extends CActiveRecord
{
    const TYPE_1_SPANCOP = 1; // tab comment báo cáo KH chuyên đề đặc biệt
    const TYPE_2_SUPPORT_AGENT = 2; // Now 02, 2015 Đề xuất sửa chữa của đại lý
    const TYPE_3_COMING_SOON = 3; 
    
    // array type => name model
    public static $TYPE_MODEL = array(
        GasComment::TYPE_1_SPANCOP => "GasBussinessContract",
        GasComment::TYPE_2_SUPPORT_AGENT => "GasSupportAgent"
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
        return '{{_gas_comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, type, belong_id, content, created_date', 'safe'),
            array('content', 'required', 'on'=>'spancop_comment'),
            array('content','length', 'max'=> 2000),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rUidLogin' => array(self::BELONGS_TO, 'Users', 'uid_login'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'belong_id' => 'Belong',
            'uid_login' => 'Người Tạo',
            'content' => 'Content',
            'created_date' => 'Created Date',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;
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
    
    protected function beforeSave() {
        $aAttributes = array('content');
        MyFormat::RemoveScriptOfModelField($this, $aAttributes);
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2015
     * @Todo: all record will save here
     * @Param: $model
     */
    public function SaveRow($mBelongTo, $type) {
        $this->belong_id = $mBelongTo->id;
        $this->type = $type;
        $this->uid_login = Yii::app()->user->id;
        $this->save();
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2015
     * @Todo: something
     */
    public function getUidLogin() {
        $mUser = $this->rUidLogin;
        if($mUser){
            return $mUser->first_name;
        }
        return '';
    }
    
    public function getContent() {
        return nl2br($this->content);
    }
    
    /**
     * @Author: ANH DUNG Nov 19, 2015
     * @Todo: something
     * @Param: 
     */
    public function ShowItem() {
        $cmsFormater = new CmsFormatter();
        return "<b>{$this->getUidLogin()}</b> <i>{$cmsFormater->formatDateTime($this->created_date)}</i>: ".nl2br($this->content)."<br>";
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2015
     * @Todo: something
     * @Param: $model
     */
    public static function DeleteByType($belong_id, $type) {
        $criteria = new CDbCriteria;
        $criteria->compare('belong_id', $belong_id);
        $criteria->compare('type', $type);
        self::model()->deleteAll($criteria);
    }
    
    // Now 02, 2015 for demo text show
//    public function formatSpancopReport($model){
//        $cmsFormater = new CmsFormatter();
//       $res = "";
//       foreach($model->rComment as $mComment){
//           $res .= "<b>{$mComment->getUidLogin()}</b> <i>{$cmsFormater->formatDateTime($mComment->created_date)}</i>: ".nl2br($mComment->getContent())."<br>";
//       }
//       $note = "<b>Ghi chú: </b>".nl2br($model->note);
//       $res = "$res".$note;
//       return $res;
//   }
    
}