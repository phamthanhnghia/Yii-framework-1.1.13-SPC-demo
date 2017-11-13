<?php

/**
 * This is the model class for table "{{_murad_banner}}".
 *
 * The followings are the available columns in table '{{_murad_banner}}':
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $description
 * @property string $file_name
 * @property string $link
 * @property integer $status
 * @property integer $order_display
 * @property string $created_date
 */
class MuradBanner extends _BaseModel
{
    public $pathUpload = 'upload/banner';
    const TYPE_HOME_TOP = 1;
    const TYPE_PRODUCT_LIST = 2;
    
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get array dropdown
     */
    public function getArrayType() {
        return array(
            MuradBanner::TYPE_HOME_TOP => "Home Top",
            MuradBanner::TYPE_PRODUCT_LIST => "Product List",
        );
    }
    
    /**
     * @Author: ANH DUNG Feb 23, 2016
     */
    public function getType() {
        $aType = $this->getArrayType();
        return isset($aType[$this->type]) ? $aType[$this->type] : '';
    }
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradBanner the static model class
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
        return '{{_murad_banner}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name,type', 'required', 'on'=>'create,update'),
            array('name', 'length', 'max'=>350),
            array('id, type, name, description, file_name, link, status, order_display, created_date', 'safe'),
            array('file_name', 'file','on'=>'UploadFile',
                    'allowEmpty'=>true,
                    'types'=> $this->allowImageType,
                    'wrongType'=> "Chỉ cho phép định dạng file ".  $this->allowImageType." .",
                    'maxSize'   => $this->maxImageFileSize,
                    'tooLarge'  =>'The file was larger than '. ActiveRecord::convertByte2Mb($this->maxImageFileSize) .'. Please upload a smaller file.',
            ),
            
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
            'type' => 'Type',
            'name' => 'Name',
            'description' => 'Description',
            'file_name' => 'File Name',
            'link' => 'Link',
            'status' => 'Status',
            'order_display' => 'Order Display',
            'created_date' => 'Created Date',
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
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.description',$this->description,true);
        $criteria->compare('t.file_name',$this->file_name,true);
        $criteria->compare('t.link',$this->link,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.order_display',$this->order_display);
        $criteria->compare('t.created_date',$this->created_date,true);
        $criteria->order = "t.id DESC";

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
    
    protected function beforeDelete() {
        $this->RemoveFileOnly('file_name');
        return parent::beforeDelete();
    }
    
    /** fix Feb 17, 2016
     * @Author: ANH DUNG Feb 25, 2015
     * To do: delete file scan
     * @param: $modelRemove model GasFile
     * @param: $fieldName is file_name
     * @param: $aSize
     */
    public function RemoveFileOnly($fieldName) {
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $this->$fieldName);
    }

    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get banner at home page
     */
    public static function getByType($type) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->compare("t.type", $type);
        $criteria->order = "t.order_display ASC";
        return self::model()->findAll($criteria);
    }
    
}