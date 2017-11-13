<?php

class GasagentController extends AdminController
{
    
//         public function accessRules()
//        {
//            return array();
//        } 

    public function actionView($id)
    {
        $this->pageTitle = 'Xem Đại Lý';
        try{
            $model = $this->loadModel($id);
            if(!Users::CanAccessProvince($model->province_id)){
                $this->redirect(array('index'));
            }
            $this->render('view',array(
                    'model'=> $model, 'actions' => $this->listActionsCanAccess,
            ));
        }
            catch (Exception $e)
            {
                Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->pageTitle = 'Tạo Mới Đại Lý';
            try
            {
            $model=new Users('create_agent');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Users']))
            {
                    $model->attributes=$_POST['Users'];
                    $model->role_id = ROLE_AGENT;
                    $model->temp_password =  $_POST['Users']['password_hash'];
                    $model->application_id = BE;
                    $model->code_bussiness = $model->code_account;
                    $model->validate();
                    if(!$model->hasErrors()){
                       $model->scenario = NULL;
                        $model->save();
                        $model->password_hash =  md5($_POST['Users']['password_hash']);
                        $model->update(array('password_hash'));
                        $this->redirect(array('view','id'=>$model->id));
                    }

            }

            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                throw  new CHttpException("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage());     
            }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->pageTitle = 'Cập Nhật Đại Lý';
            try
            {
            $model=$this->loadModel($id);
            $model->scenario = 'update_agent';
            $model->autocomplete_name_street = $model->street?$model->street->name:'';
            if(isset($_POST['Users']))
            {
                $aAttSave = array('username','code_account','code_bussiness',
                            'first_name','address','province_id','district_id','ward_id',
                            'house_numbers','street_id','status',
                            'beginning','payment_day','gender','last_logged_in',
                    );	
                    $model->attributes=$_POST['Users'];
                    $model->role_id = ROLE_AGENT;
                    $model->application_id = BE;
                    $model->code_bussiness = $model->code_account;
                    $model->validate($aAttSave);
                    if(!$model->hasErrors()){
                        if(!empty($model->password_hash)){
                            $model->temp_password = $model->password_hash;
                            $model->password_hash = md5($model->password_hash);
                            $aAttSave[] = 'temp_password';
                            $aAttSave[] = 'password_hash';
                        }
                        $model->update($aAttSave);
                        $this->redirect(array('view','id'=>$model->id));
                    }
            }

            $this->render('update',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                throw  new CHttpException("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage());     
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
            catch (Exception $e)
            {
                Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                throw new CHttpException(400,$e->getMessage());
            }
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $this->pageTitle = 'Danh Sách Đại Lý';
        try
        {
            Users::ResetAllDateUpdateStoreCard();
        $model=new Users('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Users']))
                $model->attributes=$_GET['Users'];
        $model->role_id = ROLE_AGENT;
        $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
            throw  new CHttpException("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage());     
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
            $model=Users::model()->findByPk($id);
            if($model===null)
            {
                Yii::log("The requested page does not exist.");
                throw new CHttpException(404,'The requested page does not exist.');
            }			
            return $model;
            }
            catch (Exception $e)
            {
                Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                throw  new CHttpException("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage());     
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
            }
            catch (Exception $e)
            {
                Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                throw  new CHttpException("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage());     
            }
    }



    public function actionAdd_customer_of_agent(){
        $this->layout = 'ajax';
        $model = new GasAgentCustomer();
        $model->agent_id = $_GET['agent_id'];
        $msg= '';
        if(isset($_POST['GasAgentCustomer']) && !empty($_POST['GasAgentCustomer']['customer_id'])){
            $model->attributes=$_POST['GasAgentCustomer'];
            $criteria=new CDbCriteria;
            $criteria->compare('agent_id',$model->agent_id);
            $criteria->compare('customer_id',$model->customer_id);
            $newModel = GasAgentCustomer::model()->find($criteria);
            if(!$newModel){
                $model->save();
                $msg= 'Thêm Thành Công Khách Hàng: '.$model->customer->first_name;
                // cập nhật cờ báo đại lý có KH mới, nên khởi tạo lại session KH của đại lý
                // AjaxControllers public function actionSearch_user_by_code()
                Users::updateFirstChar($model->agent_id, 1);
            }else
                $msg= 'Khách Hàng: '.$model->customer->first_name.' - Đã Được Thêm Trước Đây';

        }
        $this->render('add_customer_of_agent',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            'msg'=>$msg,
        ));
    }        


    public function actionDelete_customer_agent(){
        $this->layout='';
        if(isset($_GET['id'])){
            GasAgentCustomer::model()->deleteByPk($_GET['id']);
            $model = GasAgentCustomer::model()->findByPk($_GET['id']);
            // cập nhật cờ báo đại lý có KH mới, nên khởi tạo lại session KH của đại lý
            // AjaxControllers public function actionSearch_user_by_code()
            if($model)
                Users::updateFirstChar($model->agent_id, 1);
//                die('<script type="text/javascript">$.fn.yiiGridView.update("users-grid");</script>'); 
        }
    }    
}
