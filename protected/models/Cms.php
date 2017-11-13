<?php

/**
 * This is the  model class for table  "{{cms}}".
 *
 * The followings are the available columns in table '{{cms}}':
 * @property integer $id
 * @property string $title
 * @property string $banner
 * @property string $cms_content
 * @property string $created_date
 * @property integer $display_order
 * @property integer $show_in_menu
 * @property string $place_holder_id
 * @property integer $creator_id
 * @property integer $status
 * @property string $short_content
 * @property string $link
 * @property string $meta_keywords
 * @property string $meta_desc
 */
class Cms extends CActiveRecord
{
        public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cms the static model class
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
		return '{{_cms}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('display_order, show_in_menu, creator_id, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('banner', 'length', 'max'=>128),
			array('place_holder_id', 'length', 'max'=>50),
			array('link', 'length', 'max'=>255),
			array('cms_content, short_content, meta_keywords, meta_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, banner, cms_content, created_date, display_order, show_in_menu, place_holder_id, creator_id, status, short_content, link, meta_keywords, meta_desc', 'safe', 'on'=>'search'),
                        array('banner', 'file', 
                            'types'=>'jpg, gif, png',
                            'allowEmpty'=>true,
                            'maxSize'   => ActiveRecord::getMaxFileSize(),
                            'tooLarge'  =>'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
                            ),
                        array(
                            'banner','match',
                            'pattern'=>'/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:;{}\\\\]{3}$/', 
                            'message'=>'Image files name cannot include special characters: &%$#',
                        ),
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
			'place_holder' => array(self::BELONGS_TO, 'PlaceHolders', 'place_holder_id'),
			'creator' => array(self::BELONGS_TO, 'Users', 'creator_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Tiêu Đề',
                        'slug' => 'Slug',
			'banner' => 'Banner',
			'cms_content' => 'Nội Dung',
			'created_date' => 'Ngày Tạo',
			'display_order' => 'Thứ Tự',
			'show_in_menu' => 'Hiển Thị Ở Trang Chủ',
			'place_holder_id' => 'Place Holder',
			'creator_id' => 'Creator',
			'status' => 'Trạng Thái',
			'short_content' => 'Nội Dung Ngắn',
			'link' => 'Link',
			'meta_keywords' => 'Meta Keywords',
			'meta_desc' => 'Meta Desc',
			
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('cms_content',$this->cms_content,true);
		if(isset($this->created_date) && !empty($this->created_date))
		{
			$date = strtotime(str_replace('/','-',$this->created_date));
			$date = date('Y-m-d',$date);
			$criteria->compare('created_date',$date ,true);	
		}
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('show_in_menu',$this->show_in_menu);
		$criteria->compare('place_holder_id',$this->place_holder_id,true);
		$criteria->compare('creator_id',$this->creator_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('slug',$this->slug,true);
                $criteria->order = 't.id DESC';

		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>50,
                    ),
		));
	}
	
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
            $this->image=CUploadedFile::getInstance($this,'banner');

            if($this->isNewRecord)
            {
                $this->created_date=date('Y-m-d H:i:s');
                $this->creator_id=Yii::app()->user->id;
                if(!is_null($this->image))
                {
                        $this->banner = $this->image->getName();
                        // begin for resize image
                        $this->image=EUploadedImage::getInstance($this,'banner');
                        $this->image->maxWidth = 750;
                        //$this->image->maxHeight = 87;
                        // end for resize image       
                        $this->image->saveAs('upload/cms/banner/'.$this->banner);
                }

            }else{
                $model =  Cms::model()->findByPk($this->id);

                if(!is_null($this->image))
                    $this->banner = $this->image->getName();
                // not update banner
                //if(empty($this->banner))
                  //      $this->banner = $model->banner;
                // update new banner
                if(!empty($this->banner) && $this->banner != $model->banner)
                {
                    if(file_exists('upload/cms/banner/'.$model->banner) && !empty($model->banner)) 
                        unlink('upload/cms/banner/'.$model->banner);
                    $this->banner = $this->image->getName();
                    // begin for resize image
                    $this->image=EUploadedImage::getInstance($this,'banner');
                    $this->image->maxWidth = 750;
                    //$this->image->maxHeight = 87;
                    // end for resize image       
                    $this->image->saveAs('upload/cms/banner/'.$this->banner);
                }
            }
            
            $this->created_date=date('Y-m-d H:i:s');
            $this->cms_content = InputHelper::removeScriptTagOnly($this->cms_content);
            $this->short_content = InputHelper::removeScriptTagOnly($this->short_content);
            $this->slug = '';
            return parent::beforeSave();
	}
        
        protected function beforeDelete() {
            if(file_exists('upload/cms/banner/'.$this->banner) && !empty($this->banner)) 
                unlink('upload/cms/banner/'.$this->banner);
            return true;
        }
	
        public static function getByIdAndStatus($id, $status){
            $criteria=new CDbCriteria;
            $criteria->compare('id',$id);
            $criteria->compare('status',$status);            
            return Cms::model()->find($criteria);
        }        
        
        public static function getAllShowIndexByStatus($status, $show_in_menu=1){
            $criteria=new CDbCriteria;
            $criteria->order = 't.created_date DESC, t.display_order ASC';
            $criteria->compare('t.status',$status);            
            $criteria->compare('t.show_in_menu',$show_in_menu);            
            return Cms::model()->findAll($criteria);
        }       
        
        public static function getAllActive(){
            $criteria=new CDbCriteria;
            $criteria->order = 't.created_date DESC, t.display_order ASC';
            $criteria->compare('t.status', STATUS_ACTIVE);
            return Cms::model()->findAll($criteria);
        }        
        
        public static function getNewsPopup(){
            $criteria=new CDbCriteria;
            $criteria->order = 't.created_date DESC';
            $criteria->compare('t.status', STATUS_ACTIVE);            
            $criteria->compare('t.show_in_menu', STATUS_ACTIVE);            
            return Cms::model()->find($criteria);
        }            
        
        public static function getLatestNews(){
            $criteria=new CDbCriteria;
            $criteria->order = 't.created_date DESC';
            $criteria->compare('t.status', STATUS_ACTIVE);            
            return Cms::model()->find($criteria);
        }            
        
        public function activate()
        {
            $this->status = 1;
            $this->update(array('status'));
        }

        public function deactivate()
        {
            $this->status = 0;
            $this->update(array('status'));
        }    
        
        public function activateField($field_name)
        {
            $this->$field_name = 1;
            $this->created_date = date('Y-m-d H:i:s');
            $this->update(array($field_name, 'created_date'));
        }

        public function deactivateField($field_name)
        {
            $this->$field_name = 0;
            $this->update(array($field_name));
        }    
        
}