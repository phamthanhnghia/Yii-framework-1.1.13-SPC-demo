<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: Roles.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */

/**
 * This is the model class for table "{{roles}}".
 *
 * The followings are the available columns in table '{{roles}}':
 * @property integer $id
 * @property string $role_name
 * @property string $role_short_name
 * @property integer $application_id
 */
class Roles extends CActiveRecord
{
    public static  $aRoleRestrict = array(ROLE_ADMIN);
    // ROLE_SECURITY_SYSTEM add from Dec 13, 2014
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_roles}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('role_name', 'required'),
            array('id, role_name, role_short_name, application_id,status', 'safe',),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
//            'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
            'rUser' => array(self::HAS_MANY, 'Users', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'role_name' => 'Tên Chức Vụ',
                    'role_short_name' => 'Tên Tiếng Anh',
                    'application_id' => 'Application',
                    'status' => 'Status',                    
            );
    }

    /**
     * Loads the application items for the specified type from the database.
     * @param boolean the item is empty
     */
    public static function loadItems($emptyOption=false)
    {
            $_items = array();
            if($emptyOption)
                    $_items[""]="";	
            $models=self::model()->findAll(array(
                    'order'=>'id DESC',
            ));
            foreach($models as $model)
            {
                if(!in_array( $model->id, Roles::$aRoleRestrict) ){
                    $_items[$model->id]=$model->role_name;
                }
            }
            return $_items;
    }

    /**
     * Loads the application items for the specified type from the database.
     * @param ARRAY the item is empty
     */
    public static function getDataSelect($notInRole=array())
    {
        $criteria = new CDbCriteria;     
        if(count($notInRole)>0)
            $criteria->addNotInCondition('t.id', $notInRole);       
        $criteria->order = 'id DESC';
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','role_name');            

    }
        
	// Roles::getArrRoleName();
    public static function getArrRoleName()
    {
        $criteria = new CDbCriteria;       
       //$criteria->compare('t.role_id', $role_id);        
        $models = self::model()->findAll($criteria);
        return  CHtml::listData($models,'id','role_name');            
    }           
		
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('role_name',$this->role_name,true);
        $criteria->compare('application_id',$this->application_id);
        $criteria->addNotInCondition('t.id', self::$aRoleRestrict);
        $criteria->order = "t.id DESC";

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                'pageSize'=> 100,
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

    public static function getDropdownList() {
        $criteria = new CDBcriteria();
        $criteria->compare('t.status', 1);
        $criteria->addCondition('t.id<>1');
         return CHtml::listData(Roles::model()->findAll($criteria), 'id', 'role_name');
    }
    
    public static function listOptions(){
        $criteria = new CDbCriteria();
        $criteria->compare("t.application_id", BE);
        $criteria->order = 't.id DESC';
        $models = self::model()->findAll($criteria);
        return CHtml::listData($models, 'id', 'role_name');
    } 
    
    public static function getAppicationIdByRoleId($role_id){        
        $model = Roles::model()->findByPk($role_id);
        if($model)
            return $model->application_id;
        return 0;
    }
    
    /**
     * @Author: ANH DUNG Nov 21, 2014
     * @Todo: get role name by id
     * @Param: $id
     */
    public static function GetRoleNameById($id) {
        $model = Roles::model()->findByPk($id);
        if($model){
            return $model->role_name;
        }
        return '';
    }
    
}