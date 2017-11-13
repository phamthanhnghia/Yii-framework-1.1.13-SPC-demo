<?php

class GasmemberController extends AdminController
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        try{
            $model = $this->loadModel($id);
//            $model->LoadUsersRefImageSign();
            $this->pageTitle = 'Xem Member - '. $model->first_name;                    
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
        $this->pageTitle = 'Tạo Mới Member';
        try
        {
        $model=new Users('create_member');
        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            //if($model->role_id==ROLE_ADMIN) // BY NGUYEN DUNG
            // $model->role_id = ROLE_MEMBER;
            $model->application_id = BE;
            $model->temp_password =  $_POST['Users']['password_hash'];
            $model->validate();
            if(!$model->hasErrors()){
               $model->scenario = NULL;
               $model->code_account = MyFunctionCustom::getNextIdForEmployee('Users');
               $model->code_bussiness = MyFunctionCustom::getCodeBusinessEmployee($model->first_name, array());
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
            $code = 404;
            if(isset($e->statusCode))
                $code=$e->statusCode;
            if($e->getCode())
                $code=$e->getCode();
            throw new CHttpException($code, $e->getMessage());
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        try
        {
        $model=$this->loadModel($id);
        $this->pageTitle = 'Cập Nhật Member - '. $model->first_name;
        $model->scenario = 'update_member';        
        $oldName = MyFunctionCustom::getNameRemoveVietnamese($model->first_name);
        $model->autocomplete_name_street = $model->rStreet?$model->rStreet->name:'';
        // Dec 04, 2015
        $model->LoadUsersRefImageSign();
        $model->mUsersRef->old_image_sign = $model->mUsersRef->image_sign;
        // Dec 04, 2015

        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            //if($model->role_id==ROLE_ADMIN) // BY NGUYEN DUNG
            // $model->role_id = ROLE_MEMBER;
            $model->application_id = BE;
            $model->validate();
            $model->mUsersRef->attributes = $_POST['UsersRef'];
            $model->mUsersRef->image_sign  = CUploadedFile::getInstance($model->mUsersRef, 'image_sign');
            $model->mUsersRef->validate();
            UsersRef::validateFile($model);

            if(!$model->hasErrors() && !$model->mUsersRef->hasErrors()){
                $aUpdate = array('username','code_account','role_id','first_name','address',
                    'province_id','district_id','status','email',
                    'ward_id','house_numbers','street_id','parent_id','address_vi',
                    'sale_id','is_maintain','phone'
                    );

                if(empty($model->code_account)){
                    $model->code_account = MyFunctionCustom::getNextIdForEmployee('Users');
                }
                $newName = MyFunctionCustom::getNameRemoveVietnamese($model->first_name);
                $aUpdate[] = 'code_bussiness';
                if(strtolower($oldName) !=  strtolower($newName)){                            
                    //$needMore = array('id_not_in'=>$model->id);
                    $model->code_bussiness = MyFunctionCustom::getCodeBusinessEmployee($model->first_name, array());
                }
                if(isset($_POST['Users']['gender'])){
                    $aUpdate[] = 'gender';                                
                }

                if(!empty($model->password_hash)){
                    $model->temp_password = $model->password_hash;
                    $model->password_hash = md5($model->password_hash);
                    $aUpdate[] = 'temp_password';
                    $aUpdate[] = 'password_hash';
                }
                $model->update($aUpdate);
                $this->handleSaveUpdate($model);// Dec 04, 2015

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
            $code = 404;
            if(isset($e->statusCode))
                $code=$e->statusCode;
            if($e->getCode())
                $code=$e->getCode();
            throw new CHttpException($code, $e->getMessage());
        }
    }
    
    
    /**
     * @Author: ANH DUNG Dec 04, 2015
     * @Todo: xử lý save ảnh đại diện của member
     */
    public function handleSaveUpdate($model){
        if(!is_null($model->mUsersRef->image_sign)){
            UsersRef::RemoveFileOnly($model->mUsersRef->id, 'image_sign');
            $model->mUsersRef->image_sign = UsersRef::saveFile($model->mUsersRef, 'image_sign');
            UsersRef::resizeImage($model->mUsersRef, 'image_sign');
        }else{
            $model->mUsersRef->image_sign = $model->mUsersRef->old_image_sign;
        }
        if($model->mUsersRef->isNewRecord){
            $model->mUsersRef->save();
        }else{
            $model->mUsersRef->update();
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
                            Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else
            {
                Yii::log("Invalid request. Please do not repeat this request again.");
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
        $this->pageTitle = 'Danh Sách Member';
            try
            {
            $model=new Users('search');
            $model->unsetAttributes();  // clear any default values
            $model->status = STATUS_ACTIVE;
            if(isset($_GET['Users']))
                    $model->attributes=$_GET['Users'];

            $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
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
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
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
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }
    }

    public function actionEmployees(){
//            MyFunctionCustom::updateCodeAccountUser();            
        $this->pageTitle = 'QL Nhân Viên';
        try{
            $model=new Users('employees');
            $model->unsetAttributes();  // clear any default values
            $model->status = STATUS_ACTIVE;
            if(isset($_GET['Users']))
                $model->attributes=$_GET['Users'];
            $this->render('Employees',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
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

    public function actionEmployees_create(){
        $this->pageTitle = 'Tạo Mới Nhân Viên';
        $this->layout='ajax';
        $model=new Users('employees_create');

        $needMore['msg'] = '';
        if(isset($_POST['Users'])){
            $aAttSave = array('first_name','role_id','code_bussiness',
            'address','phone','email','province_id','district_id','status',
            'address_vi',
            );				
            $model->attributes = $_POST['Users'];
            $model->validate($aAttSave);
            if(!$model->hasErrors()){
                    $model = MyFunctionCustom::clearHtmlModel($model, $aAttSave);
                    $model->application_id = BE;
                    $model->code_account = MyFunctionCustom::getNextIdForEmployee('Users');
                    $model->code_bussiness = MyFunctionCustom::getCodeBusinessEmployee($model->first_name, array());
                    $aAttSave[] = 'code_account';
                    $aAttSave[] = 'application_id';
                    $model->save(true, $aAttSave);                        
                    $needMore['msg'] = 'Thêm Thành Công Nhân Viên: '.$model->first_name;
                    $model = new Users('employees_create');
            }                                    
        }            
        $this->render('Employees_create',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
                'needMore'=>$needMore,
        ));
    }

    public function actionEmployees_update($id){
        $this->pageTitle = 'Cập Nhật Nhân Viên';
        $this->layout='ajax';
        $model = $this->loadModel($id);
        $oldName = MyFunctionCustom::getNameRemoveVietnamese($model->first_name);
        $needMore['msg'] = '';
        $model->scenario = 'employees_update';
        if(isset($_POST['Users'])){
            $aAttSave = array('first_name','role_id',
            'address','phone','email','province_id','district_id','status',
            'address_vi',
            );				
            $model->attributes = $_POST['Users'];
            $model->validate($aAttSave);
            if(!$model->hasErrors()){
                $model = MyFunctionCustom::clearHtmlModel($model, $aAttSave);
                $newName = MyFunctionCustom::getNameRemoveVietnamese($model->first_name);
                if(strtolower($oldName) !=  strtolower($newName)){
                    $aAttSave[] = 'code_bussiness';
                    //$needMore = array('id_not_in'=>$model->id);
                    $model->code_bussiness = MyFunctionCustom::getCodeBusinessEmployee($model->first_name, array());
                }

                $model->update($aAttSave);
                $needMore['msg'] = 'Cập Nhật Thành Công Nhân Viên: '.$model->first_name;					
            }                                    
        }
        $this->render('Employees_update',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            'needMore'=>$needMore,
        ));

    }

    public function actionEmployees_view($id){
        $this->layout='ajax';
        $model = $this->loadModel($id);
        $this->render('Employees_view',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));

    }

    // 10-24-2013
    public function actionExport_list_employees(){

    }        
        

	/**
     * Handle the ajax request. This process changes the status of member to 1 (mean active)
     * @param type $id the id of member need changed status to 1
     */
    public function actionAjaxActivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'activate'))
            {
                $model->activate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
            
    }

    /**
     * Handle the ajax request. This process changes the status of member to 0 (mean deactive)
     * @param type $id the id of member need changed status to 0
     */
    public function actionAjaxDeactivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'deactivate'))
            {
                $model->deactivate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }            
    }        
    
    public function actionMail_reset_password($id){
        try{
            $model = $this->loadModel($id);
            SendEmail::ResetPasswordModelAndSendMail($model);
            Yii::app()->user->setFlash('successUpdate', "Gửi mail reset password thành công.");
            $this->redirect(array('index','id'=>$model->id));  
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
        
        
}
