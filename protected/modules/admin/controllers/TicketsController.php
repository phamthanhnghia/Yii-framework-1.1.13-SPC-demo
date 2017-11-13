<?php

class TicketsController extends AdminController 
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
            $this->pageTitle = 'Xem ';
            try{
            $this->render('view',array(
                    'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
       die;
    }

    public function actionUpdate($id)
    {
        die;
    }

    /**
     * @Author: ANH DUNG Oct 14, 2014
     * @Todo: delete comment of ticket, only for admin
     * @Param: $id -- khong lam nua
     */
    public static function actionDelete_comment() {
        
    }
    
    public function actionDelete($id)
    {
            try
            {
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                if($model = $this->loadModel($id))
                {
                    if($model->delete())
                        Yii::log("Uid: " .Yii::app()->user->id. " Delete record ".  print_r($model->attributes, true), 'info');
                }

                $msg = "Delete Ticket thành công.";
                $FlashScenario = 'successUpdate';           
                Yii::app()->user->setFlash($FlashScenario, $msg);
                $this->redirect(array('index'));
            }
            else
            {
                Yii::log("Uid: " .Yii::app()->user->id. " Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }	
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

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $this->pageTitle = 'Hỗ Trợ Sử Dụng Phần Mềm ';
        try
        {            
        $ModelCreate=new GasTickets('create');
        $this->ProcessCreate($ModelCreate);

        $model=new GasTickets('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['GasTickets']))
            $model->attributes=$_GET['GasTickets'];

        $this->render('index',array(
            'model'=>$model, 
            'ModelCreate'=>$ModelCreate, 
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
    
    public function ProcessCreate($ModelCreate){
        if(isset($_POST['GasTickets']))
        {
            $ModelCreate->attributes=$_POST['GasTickets'];
            $ModelCreate->validate();
            if(!$ModelCreate->hasErrors()){               
               $msg = "Tạo mới ticket thành công.";
               $FlashScenario = 'successUpdate';
               if(!GasTickets::UserCanPostTicket()) {
                   $msg = "Có Lỗi không thể tạo ticket(exceed limit), liên hệ với admin quản trị.";
                   $FlashScenario = 'ErrorUpdate';
               }else{
                   GasTickets::SaveNewTicket($ModelCreate);
               }
               Yii::app()->user->setFlash($FlashScenario, $msg);
//               Yii::app()->user->setFlash('successUpdate', $msg);
               $this->redirect(array('index'));
            }
        }
    }

    /**
     * @Author: ANH DUNG Aug 11, 2014
     * @Todo: kiểm tr có thể reply ko
     * @Param: $model model 
     */
    public function CanReply($model){
        return true;// chỗ này không cần check nữa vì user ko thể vào đây được, chỗ pick ticket đã xử lý cái này rồi
        if($model->process_status == GasTickets::PROCESS_STATUS_PICK){
            $uidLogin = Yii::app()->user->id;
            if($uidLogin != $model->process_user_id || $uidLogin != $model->uid_login )
                return false;
        }
        return true;
    }
    
    /**
     * @Author: ANH DUNG Aug 09, 2014
     * @Todo: xử lý post reply tickeet, không xử lý get
     * @Param: $id pk
     */
    public function actionReply($id)
    {
    try
    {
        $model = $this->loadModel($id);
        $msg = "Có Lỗi không thể Reply Ticket ( invalid message ).";
        $FlashScenario = 'ErrorUpdate';
        $CanReply = $this->CanReply($model);
        if(isset($_POST['GasTickets']) && $model->status == GasTickets::STATUS_OPEN && $CanReply)
        {
            $model->attributes=$_POST['GasTickets'];
            $model->scenario = 'reply';
            $model->validate();
            if(!$model->hasErrors()){
               $msg = "Reply Ticket thành công.";
               $FlashScenario = 'successUpdate';
               if(!GasTickets::UserCanPostTicket()) {
                   $msg = "Có Lỗi không thể Reply Ticket vượt quá giới hạn ticket cho phép (exceed limit), liên hệ với admin quản trị.";
                   $FlashScenario = 'ErrorUpdate';
               }else{
                   GasTickets::SaveOneMessageDetail($model);
               }
            }
        }
        Yii::app()->user->setFlash($FlashScenario, $msg);
        $this->redirect(array('index'));
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
    
    public function actionClose_ticket($id)
    {        
    try
    {
        $model = $this->loadModel($id);
        if(!Yii::app()->request->isPostRequest || $model->uid_login != Yii::app()->user->id)
            throw new Exception('Invalid request');
        GasTickets::CloseTicket($model);
        $msg = "Close Ticket thành công.";
        $FlashScenario = 'successUpdate';           
        Yii::app()->user->setFlash($FlashScenario, $msg);
        $this->redirect(array('index'));
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
    
    public function actionPick_ticket($id)
    {
        $model = $this->loadModel($id);
        if($model->process_status == GasTickets::PROCESS_STATUS_PICK)
        { // nếu thời điểm người click sau thì sẽ không pick dc ticket và phải f5 để cập nhật
            die;
        }
        if(!Yii::app()->request->isPostRequest)
            throw new Exception('Invalid request');
        GasTickets::UpdateStatusTicket($model, GasTickets::PROCESS_STATUS_PICK);
        
        $ModelCreate=new GasTickets('create');
        $model=new GasTickets('search');
        $model->unsetAttributes();  // clear any default values
        $this->render('index',array(
            'model'=>$model, 
            'ModelCreate'=>$ModelCreate,
            'actions' => $this->listActionsCanAccess,
        ));
    }
    

    /**
     * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            try
            {
            $model=GasTickets::model()->findByPk($id);
            if($model===null)
            {
                Yii::log("The requested page does not exist.");
                throw new CHttpException(404,'The requested page does not exist.');
            }			
            return $model;
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

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
            try
            {
            if(isset($_POST['ajax']) && $_POST['ajax']==='gas-tickets-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
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
}
