<?php

/**
 * This is the model class for table "{{_murad_product_image}}".
 *
 * The followings are the available columns in table '{{_murad_product_image}}':
 * @property string $id
 * @property integer $type
 * @property integer $product_id
 * @property string $file_name
 * @property integer $order_number
 * @property string $created_date
 */
class MuradProductImage extends _BaseModel
{
    public $aIdNotIn;
    public $pathUpload = 'upload/products';
    public $aSize = array(
        'size1' => array('width' => 291, 'height' => 291), // size view home
        'size2' => array('width' => 391, 'height' => 391), // size view detail
        'size3' => array('width' => 600, 'height' => 600), // size view zoom
    );
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MuradProductImage the static model class
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
            return '{{_murad_product_image}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, type, product_id, file_name, order_number, created_date', 'safe'),
            array('aIdNotIn', 'safe'),
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
                'product_id' => 'Product',
                'file_name' => 'File Name',
                'order_number' => 'Order Number',
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
        $criteria->order = "t.id DESC";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Feb 18, 2016
     * @Todo: render html of image thumb
     */
    public function getImageThumbTemp() {
        $imageUrl = ImageProcessing::bindImageByModel($this, 'size1');
        $imageUrlS3 = ImageProcessing::bindImageByModel($this, 'size3');
        return "<a rel='group1' class='gallery' href='$imageUrlS3'>"
                . "<img class='image_thumb_temp' src='$imageUrl'>"
                . "</a>";
    }
    
    /**
     * @Author: ANH DUNG Sep 06, 2014
     * @Todo: delete detail by $profile_id
     * @Param: $profile_id
     */
    public static function deleteByProductId($product_id){
        $criteria = new CDbCriteria();
        $criteria->compare("t.product_id", $product_id);
        $models = self::model()->findAll($criteria);
        MyFormat::deleteArrModel($models);        
    }

    /**
     * @Author: ANH DUNG May 18, 2014
     * @Todo: delete record by file_scan_id and array id not in
     * @Param: $file_scan_id 
     * @Param: $aIdNotIn 
     */
    public static function deleteByNotInId($product_id, $aIdNotIn){
        $criteria = new CDbCriteria();
        $criteria->compare("t.product_id", $product_id);
        $criteria->addNotInCondition("t.id", $aIdNotIn);
        $models = self::model()->findAll($criteria);
        MyFormat::deleteArrModel($models);
    }

    /**
     * @Author: ANH DUNG Aug 31, 2014
     * @Todo: update order number of file
     * @param: $model model GasProfile
     */
    public static function UpdateOrderNumberFile($model){
        $sql='';
        $tableName = self::model()->tableName();
        if(isset($_POST['MuradProductImage']['aIdNotIn'])  && count($_POST['MuradProductImage']['aIdNotIn'])){
            foreach($_POST['MuradProductImage']['aIdNotIn'] as $key=>$pk){
                $order_number = isset($_POST['MuradProductImage']['order_number'][$key])?$_POST['MuradProductImage']['order_number'][$key]:1;
                if($pk){
                    $sql .= "UPDATE $tableName SET "
                        . " `order_number`=\"$order_number\" "
                        . "WHERE `id`=$pk ;";
                }
            }
        }
        if(trim($sql)!='')
            Yii::app()->db->createCommand($sql)->execute();
    }

    /**
     * @Author: ANH DUNG May 18, 2014
     * To do: delete file scan
     * @param: $model model user
     * @param: $fieldName is avatar, agent_company_logo
     * @param: $aSize
     */
    public function RemoveFileOnly($fieldName) {
        $modelRemove = self::model()->findByPk($this->id);
        if (is_null($modelRemove) || empty($modelRemove->$fieldName))
            return;
        $year = MyFormat::GetYearByDate($this->created_date);
        $month = MyFormat::GetYearByDate($this->created_date, array('format'=>'m'));
        $pathUpload = $this->pathUpload."/$year/$month";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);
        foreach ( $this->aSize as $key => $value) {
            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $key . '/' . $modelRemove->$fieldName);
        }
    }
    
    protected function beforeDelete() {
        $this->RemoveFileOnly('file_name');
        return parent::beforeDelete();
    }
    
}