<?php

/**
 * This is the model class for table "{{_actions_users}}".
 *
 * The followings are the available columns in table '{{_actions_users}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $action_id
 * @property string $can_access
 */
class ActionsUsers extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ActionsUsers the static model class
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
            return '{{_actions_users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('user_id', 'numerical', 'integerOnly'=>true),
                    array('can_access', 'length', 'max'=>10),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, user_id, can_access', 'safe', 'on'=>'search'),
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
                'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'user_id' => 'User',
                    'action_id' => 'Action',
                    'can_access' => 'Can Access',
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
            $criteria->compare('user_id',$this->user_id);		
            $criteria->compare('can_access',$this->can_access,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    // May 08, 2014 bb code - ANH DUNG ADD
    public static function getActionArrayByUserIdAndControllerId($user_id, $controller_id, $can_access = 'allow')
    {
        $aActions = array();
        $criteria = new CDbCriteria;
        $criteria->compare('t.user_id', $user_id);
        $criteria->compare('t.controller_id', $controller_id);
        $criteria->compare('t.can_access', $can_access);
        $model = self::model()->find($criteria);
        if ($model)
        {                
            if(!empty($model->actions))
            {
                $aActions = explode(', ', $model->actions);
            }
        }
        return $aActions;
    }

    /**
     * @Author: ANH DUNG May 13, 2014
     * @Todo: get list action of contronller of current user login
     * @Param: $controllerName
     * @Return: array('Index','Create'...)
     */
    public static function getActionArrayAllowForCurrentUserByControllerName($controllerName)
    {
        $aResult = array();
        $user_id = Yii::app()->user->id;
        $mUser = Users::model()->findByPk($user_id);
        $mController = Controllers::getByName($controllerName);
        // ANH DUNG FIX  NOW 14, 2014
        if($mController)
        {
//          NOW 14, 2014 => findAll sai khi check null(BB) $mActionsUsers = ActionsUsers::model()->findAll('user_id='.$user_id.' AND controller_id='.$mController->id);
            $mActionsUsers = ActionsUsers::model()->find('user_id='.$user_id.' AND controller_id='.$mController->id);
//            if($mActionsUsers == NULL)
            if( is_null($mActionsUsers) )
            {
                $aActionsAllowGroup = ActionsRoles::getActionArrayByRoleIdAndControllerId($mUser->role_id, $mController->id);
                $aResult = $aActionsAllowGroup;
            }
            else{
                $aActionsAllowUser = ActionsUsers::getActionArrayByUserIdAndControllerId($user_id, $mController->id);
                $aResult = $aActionsAllowUser;
            }
                
        }
//        if($mController)
//        {
//            $mActionsUsers = ActionsUsers::model()->findAll('user_id='.$user_id.' AND controller_id='.$mController->id);
//            $aActionsAllowGroup = ActionsRoles::getActionArrayByRoleIdAndControllerId($mUser->role_id, $mController->id);
//            $aActionsAllowUser = ActionsUsers::getActionArrayByUserIdAndControllerId($user_id, $mController->id);
//            if($mActionsUsers == NULL)
//            {
//                $aResult = $aActionsAllowGroup;
//            }
//            else
//                $aResult = $aActionsAllowUser;
//        }
        
        

        return $aResult;
    }

    public static function isAllowAccess($controllerName, $actionName)
    {
        $aActionAllowed = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($controllerName);
        if(in_array(ucfirst($actionName), $aActionAllowed))
        {
            return true;
        }
        return false;
    }        
    // END May 08, 2014 bb code - ANH DUNG ADD
    
        
    /**
     * @Author: ANH DUNG Jan 02, 2015
     * @Todo: get name alias controller action
     */
    public static function GetAliasControllers() {
        return $aControllers = array(
            'MuradProduct'=>array(
                'alias'=>'Quản Lý Sản Phẩm - MuradProduct',
                'actions'=>array(
                    'Index'=>array('alias'=>'Quản Lý Sản Phẩm ',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha. EX 'childActions'=>array('Approve','Reject')
                                    ),
                    'Create'=>array('alias'=>'Tạo mới',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'Update'=>array('alias'=>'Cập nhật',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'View'=>array('alias'=>'Xem',
                                    'childActions'=>array('Text_view')
                                    ),                             
                    'Delete'=>array('alias'=>'Xóa',
                                    'childActions'=>array()
                                    ),
                    )
            ),/* end controller */

            'MuradVideo'=>array(
                'alias'=>'Quản Lý VIDEO + AUDIO - MuradVideo',
                'actions'=>array(
                    'Index'=>array('alias'=>'Quản Lý VIDEO + AUDIO',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha. EX 'childActions'=>array('Approve','Reject')
                                    ),
                    'Create'=>array('alias'=>'Tạo mới',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'Update'=>array('alias'=>'Cập nhật',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'View'=>array('alias'=>'Xem',
                                    'childActions'=>array('Text_view')
                                    ),                             
                    'Delete'=>array('alias'=>'Xóa',
                                    'childActions'=>array()
                                    ),
                    )
            ),/* end controller */
        
            'MuradBanner'=>array(
                'alias'=>'Quản Lý Banner - MuradBanner',
                'actions'=>array(
                    'Index'=>array('alias'=>'Quản Lý Banner',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha. EX 'childActions'=>array('Approve','Reject')
                                    ),
                    'Create'=>array('alias'=>'Tạo mới',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'Update'=>array('alias'=>'Cập nhật',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'View'=>array('alias'=>'Xem',
                                    'childActions'=>array('Text_view')
                                    ),                             
                    'Delete'=>array('alias'=>'Xóa',
                                    'childActions'=>array()
                                    ),
                    )
            ),/* end controller */
        
            'MuradCategory'=>array(
                'alias'=>'Quản Lý Category - muradCategory',
                'actions'=>array(
                    'Index'=>array('alias'=>'Quản Lý Category',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha. EX 'childActions'=>array('Approve','Reject')
                                    ),
                    'Create'=>array('alias'=>'Tạo mới',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'Update'=>array('alias'=>'Cập nhật',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'View'=>array('alias'=>'Xem',
                                    'childActions'=>array('Text_view')
                                    ),                             
                    'Delete'=>array('alias'=>'Xóa',
                                    'childActions'=>array()
                                    ),
                    )
            ),/* end controller */
        
         
            'MuradNews'=>array(
                'alias'=>'Quản Lý Tin tức - MuradNews',
                'actions'=>array(
                    'Index'=>array('alias'=>'Quản Lý Tin tức',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha. EX 'childActions'=>array('Approve','Reject')
                                    ),
                    'Create'=>array('alias'=>'Tạo mới',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'Update'=>array('alias'=>'Cập nhật',
                                    'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
                                    ),
                    'View'=>array('alias'=>'Xem',
                                    'childActions'=>array('Text_view')
                                    ),                             
                    'Delete'=>array('alias'=>'Xóa',
                                    'childActions'=>array()
                                    ),
                    )
            ),/* end controller */
        
         
        
//        'Gasward'=>array(
//            'alias'=>'Quản Lý Phường Xã - Gasward',
//            'actions'=>array(
//                'Index'=>array('alias'=>'Danh Sách Phường Xã',
//                                'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
//                                ),
//                'Create'=>array('alias'=>'Tạo mới',
//                                'childActions'=>array()//những actions mà sẽ được cấp quyền hoặc hủy theo action cha (Index)
//                                ),
//                'View'=>array('alias'=>'Xem',
//                                'childActions'=>array()
//                                ),
//                'Update'=>array('alias'=>'Cập nhật',
//                                'childActions'=>array()
//                                ),
////                'Delete'=>array('alias'=>'Xóa',
////                                'childActions'=>array()
////                                ),
//                )
//            ),/* end controller */            
        
        /******** May 13, 2014 ANH DUNG ***********/
        );
    }
    
}