<?php
/** Author: bb - recode ANH DUNG
 * May 13, 2014
 */
class RolesAuthController extends AdminController
{
    public $aControllers;
    
    public function init() {
        $this->aControllers = ActionsUsers::GetAliasControllers();
        return parent::init();
    }
    // ANH DUNG
    public function actionResetRoleCustomOfUser($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('user_id', $id);
        ActionsUsers::model()->deleteAll($criteria);
        $this->redirect(array('user','id'=>$id));
        
        // bb root
//        $aUserId = array();
//        $criteria = new CDbCriteria;
//        $criteria->compare('t.role_id', $id);
//        $mUsers = Users::model()->findAll($criteria);
//        if ($mUsers)
//            $aUserId = CHtml::listData($mUsers, 'id', 'id');
//        
//        $criteria = new CDbCriteria;
//        $criteria->addInCondition('user_id', $aUserId);
//        ActionsUsers::model()->deleteAll($criteria);
//        $this->redirect(array('group','id'=>$id));        
    }
    
    //bb
    public function actionGroup($id)
    {
        try
        {
            $mGroup = Roles::model()->findByPk($id);
            $this->pageTitle = 'Phân Quyền Cho Role Groups - '.$mGroup->role_name;
            if(isset($_POST['submit']))
            {
                foreach ($this->aControllers as $keyController => $aController) 
                {
                    $mController = Controllers::getByName($keyController);
                    if($mController)
                    {
                        $mController->addGroupRoles($this->postArrayCheckBoxToAllowDenyValue($keyController), $id);
                        Yii::app()->user->setFlash('successUpdate', "Cập Nhật Thành Công");
                    }                    
                }
                $this->refresh();
            }
            $this->render('group',array(
                    'id'=>$id,
                    'mGroup'=>$mGroup,
                    'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $exc)
        {
            Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
            $code = 404;
            if(isset($exc->statusCode))
                $code=$exc->statusCode;
            if($exc->getCode())
                $code=$exc->getCode();
            throw new CHttpException($code, $exc->getMessage());
        }
    }
    /*/bb**
     * thiet lap quyen trong user se uu tien cao nhat. user deny hoac allow thi se k phu thuoc group.
     * not yet test check it
     */
    public function actionUser($id)
    {            
        try
        {
            $mUser = Users::model()->findByPk($id);
            $this->pageTitle = 'Phân Quyền Cho Users - '.$mUser->first_name;
            if(is_null($mUser))
                throw new Exception('Phân quyền cho user tồn tại');
           if(isset($_POST['submit']))
            {
                foreach ($this->aControllers as $keyController => $aController)
                {
                    $mController = Controllers::getByName($keyController);
                    if($mController)
                    {
                        $mController->addUserRoles($this->postArrayCheckBoxToAllowDenyValue($keyController), $id);
                        Yii::app()->user->setFlash('successUpdate', "Cập Nhật Thành Công");
                    }
                }
                $this->refresh();
            }
            $this->render('user',array(
                    'id'=>$id,
                    'mUser'=>$mUser,
                    'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $exc)
        {
            Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
            $code = 404;
            if(isset($exc->statusCode))
                $code=$exc->statusCode;
            if($exc->getCode())
                $code=$exc->getCode();
            throw new CHttpException($code, $exc->getMessage());
        }
    }
    
    //bb
    public function postArrayCheckBoxToAllowDenyValue($keyController)
    {
        $aResult = array();
        $aControllers = $this->aControllers;
        foreach($aControllers[$keyController]['actions'] as $keyAction=>$aAction){
            if(isset($_POST[$keyController][$keyAction]))
            {
                $aResult[$keyAction] = 'allow';
                foreach($aAction['childActions'] as $childAction)
                {
                    $aResult[$childAction] = 'allow';
                }
            }
            else
            {
                $aResult[$keyAction] = 'deny';
                foreach($aAction['childActions'] as $childAction)
                {
                    $aResult[$childAction] = 'deny';
                }
            }
        }
        return $aResult;
    }

}
