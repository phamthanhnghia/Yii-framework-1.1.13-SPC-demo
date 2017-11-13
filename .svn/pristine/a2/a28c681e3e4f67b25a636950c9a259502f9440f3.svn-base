<?php

class GasLeaveController extends AdminController 
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->pageTitle = 'Xem ';
        $this->layout='ajax';
        $cUid = Yii::app()->user->id;
        try{
            $model = $this->loadModel($id);
            $cRole = Yii::app()->user->role_id;
            if( $cRole != ROLE_ADMIN && 
                $cRole != ROLE_DIRECTOR  && 
                !in_array($cRole, GasLeave::$ROLE_APPROVE_LEVEL_1) && 
                Yii::app()->user->id != $model->uid_login &&
                !in_array( $cUid, GasLeave::$LIST_UID_VIEW_ALL )
            ){
                die('<script type="text/javascript">parent.$.fn.colorbox.close();</script>'); 
            }
            $this->render('view',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $exc)
        {
            GasCheck::CatchAllExeptiong($exc);
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 28, 2014
     * @Todo: update status leave 
     */
    public function actionUpdate_status($id)
    {
        try{
            $this->layout='ajax';
            if(isset($_POST['GasLeave'])){
                $model = $this->loadModel($id);
                $model->attributes=$_POST['GasLeave'];
                $model->scenario = 'update_status';
                $model->validate();
                if(!$model->hasErrors()){
                    $this->ToUpdateStatus($model);
                    Yii::app()->user->setFlash('successUpdate', "Cập nhật trạng thái thành công.");
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/gasLeave/view', array('id'=>$model->id)));
                }
                $this->render('view',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
                ));                
            }
            die;
        }
        catch (Exception $exc)
        {
            GasCheck::CatchAllExeptiong($exc);
        }
    }
    
    // belong to actionUpdate_status
    public function ToUpdateStatus($model){
        $cRole = Yii::app()->user->role_id;
        $cUid  = Yii::app()->user->id;
        $attUpdate = array('status');
        if (in_array($cRole, GasLeave::$ROLE_APPROVE_LEVEL_1)) {
            // $model->status == GasLeave::STA_APPROVED_BY_MANAGE
            // 1. cap nhat uid cua director cho don nay
            // 2. doan nay xu ly quan ly approved vs rejected
            if($model->status == GasLeave::STA_APPROVED_BY_MANAGE){
                $model->to_uid_approved = GasLeave::UID_DIRECTOR;
                $attUpdate[] = "to_uid_approved";
            }
            $model->manage_note = MyFormat::removeBadCharacters($model->manage_note, array('RemoveScript'=>1));
            $model->manage_approved_uid = $cUid;
            $model->manage_approved_date = date("Y-m-d H:i:s");
            $model->manage_approved_status = $model->status;
            $attUpdate[] = "manage_note";
            $attUpdate[] = "manage_approved_uid";
            $attUpdate[] = "manage_approved_date";
            $attUpdate[] = "manage_approved_status";
        }elseif($cRole==ROLE_DIRECTOR || $cRole==ROLE_ADMIN){
            // 3. doan nay xu ly giam doc approved vs rejected
            $model->director_note = MyFormat::removeBadCharacters($model->director_note, array('RemoveScript'=>1));
            $model->approved_director_id = $cUid;
            $model->approved_director_date = date("Y-m-d H:i:s");
            $attUpdate[] = "director_note";
            $attUpdate[] = "approved_director_id";
            $attUpdate[] = "approved_director_date";
        }        
        $model->update($attUpdate);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {        
        $this->pageTitle = 'Tạo Mới ';
        $this->layout='ajax';
            try
            {
            $model=new GasLeave('create');
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['GasLeave']))
            {
                $model->attributes=$_POST['GasLeave'];
                $model->validate();
                if(!$model->hasErrors()){
                    $model->save();
//                    GasLeave::CheckAndSendMailToManager($model);// send mail to quan ly
                    GasScheduleEmail::BuildListNotifyLeaveApprove($model);// send mail to quan ly
                    Yii::app()->user->setFlash('successUpdate', "Thêm mới thành công.");
                   $this->redirect(array('create'));
                }				
            }

            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
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
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
//        $date = new DateTime('2014-09-27'); 
//        echo $date->format('l');die;
            $this->pageTitle = 'Cập Nhật ';
            $this->layout='ajax';
            try
            {
            $model=$this->loadModel($id);
            $model->scenario = 'update';
            $model->leave_date_from = MyFormat::dateConverYmdToDmy($model->leave_date_from);
            $model->leave_date_to = MyFormat::dateConverYmdToDmy($model->leave_date_to);
            if(!GasCheck::AgentCanUpdateLeaveUser($model)){
                $this->redirect(array('index'));
            }

            if(isset($_POST['GasLeave']))
            {
                $model->attributes=$_POST['GasLeave'];
                $model->validate();
                if(!$model->hasErrors()){
                    $model->save();
                    Yii::app()->user->setFlash('successUpdate', "Cập nhật thành công.");
                    $this->redirect(array('update','id'=>$model->id));
                }							
            }

            $this->render('update',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
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
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
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

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
            $this->pageTitle = 'Danh Sách ';
            try
            {
            $model=new GasLeave('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['GasLeave']))
                    $model->attributes=$_GET['GasLeave'];

            $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
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
     * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            try
            {
            $model=GasLeave::model()->findByPk($id);
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='gas-leave-form')
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
