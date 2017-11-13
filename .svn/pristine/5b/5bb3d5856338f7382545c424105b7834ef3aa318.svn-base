<?php

/**
 * This is the model class for table "{{_seo}}".
 *
 * The followings are the available columns in table '{{_seo}}':
 * @property string $id
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $sample_link
 * @property string $page_name
 * @property string $variable
 * @property string $default_page_name
 * @property string $title
 * @property string $keyword
 * @property string $description
 */
class Seo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seo the static model class
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
		return '{{_seo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
//			array('controller, action, page, page_name, default_page_name, title', 'required'),
			array('module', 'length', 'max'=>50),
			array('controller, action, sample_link, page_name, variable', 'length', 'max'=>255),
			array('default_page_name, title', 'length', 'max'=>500),
			array('keyword, description', 'safe'),
			array('id, module, controller, action, sample_link, page_name, variable, default_page_name, title, keyword, description', 'safe'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'controller' => 'Controller',
			'action' => 'Action',
			'sample_link' => 'Sample Link',
			'page_name' => 'Page Name',
			'variable' => 'Variable',
			'module' => 'Module',
			'default_page_name' => 'Default Page Name',
			'title' => 'Title',
			'keyword' => 'Keyword',
			'description' => 'Description',
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

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('t.module',$this->module,true);
		$criteria->compare('t.controller',$this->controller,true);
		$criteria->compare('t.action',$this->action,true);
		$criteria->compare('t.sample_link',$this->sample_link,true);
		$criteria->compare('t.page_name',$this->page_name,true);
		$criteria->compare('t.variable',$this->variable,true);
		$criteria->compare('t.default_page_name',$this->default_page_name,true);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.keyword',$this->keyword,true);
		$criteria->compare('t.description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    /*
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
	*/

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
}