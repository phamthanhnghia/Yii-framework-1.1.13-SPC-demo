<?php

class SiteController extends AdminController
{
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform  actions
                'actions'=>array(
                     'Login', 'Logout', 'Error','captcha',
                    ),
                'users'=>array('*'),
            ),  
            array('allow',   //allow authenticated user to perform actions
                'actions'=>array(
                    'Update_agent_employee_maintain','Update_agent_employee_accounting', 'AutocompleteCustomerMaintain',
                    'Change_my_password','AutocompleteCustomerPTTT','autocompleteSellCustomerMaintainAndPTTT',
                    'index','News','Maintenance','Profile'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                    'users'=>array('*'),
            ),            
                      
        );
    }
    
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                    'class'=>'CCaptchaAction',
                    'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                    'class'=>'CViewAction',
            ),
        );
    }	

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            $eMessage = strtolower($error['message']);

            if(strpos($eMessage, "able to resolve the request") || strpos($eMessage, "authorized to perform")
                    || strpos($eMessage, "command failed")
            ){
                $error['message'] = 'Bạn không có quyền truy cập hoặc trang yêu cầu không tồn tại';
                $uid = isset(Yii::app()->user->id)?Yii::app()->user->id:'EMPTY';
                Yii::log("Hack Try By UID: $uid ", 'error');
            }
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }            
    }

    public function actionIndex()
    {           
        $this->pageTitle = 'Trang Chủ';
        $this->render('index');
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {        
        try {
            if(isset(Yii::app()->user->id))
                $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
            $model=new AdminLoginForm;
            if(isset($_POST['AdminLoginForm']))
            {
                $model->attributes=$_POST['AdminLoginForm'];
                $model->username =  trim($model->username);
                $model->password =  trim($model->password);
                if($model->validate()){
                    /* Change at yii 1.1.13:
                     * we not use: if (strpos(Yii::app()->user->returnUrl,'/index.php')===false) to check returnUrl
                     */  
//                    GasCheck::checkSubUserAgent();
//                    MyFunctionCustom::initNameOfRole();
//                    GasTrackLogin::SaveTrackLogin(); // Aug 22, 2014
//                    GasCheck::CheckAllowAdmin();// Now 26, 2014
                    if (strtolower(Yii::app()->user->returnUrl)!==strtolower(Yii::app()->baseUrl.'/')){
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                    
                    switch (Yii::app()->user->role_id){
                        case ROLE_ADMIN:
                            $this->redirect(Yii::app()->createAbsoluteUrl('admin/site/index'));
                        break;

                        default :$this->redirect(Yii::app()->createAbsoluteUrl('admin/site/index'));
                    }
                }
                
            }
            $this->render('login', array('model'=>$model));
        } catch (Exception $e) {
            Yii::log("Bug Login Exception ". $e->getMessage(), 'error');
            $code = 404;
            if(isset($e->statusCode))
                $code=$e->statusCode;
            if($e->getCode())
                $code=$e->getCode();            
            throw new CHttpException($code, "Invalid request login.");
        }
        
    }
    
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        GasCheck::LogoutUser();
    }
 
    public function updateUid(){			
            $i = 102;
            $criteria = new CDbCriteria;
            $criteria->addCondition('t.id>'.$i); 
            $models = Users::model()->findAll($criteria);
            foreach($models as $item){
                    $item->id=$i;
                    $item->update(array('id'));
                    $i++;
            }					
    }

    public function actionChange_my_password()
    {
        if(Yii::app()->user->id == '')
         $this->redirect(array('login'));
        $model=Users::model()->findByPk(Yii::app()->user->id);
        if($model===null)
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $model->scenario = 'changeMyPassword';
        $model->md5pass = $model->password_hash;

        if(isset($_POST['Users']))
        {
            $model->currentpassword=$_POST['Users']['currentpassword'];
            $model->newpassword=$_POST['Users']['newpassword'];
            $model->password_confirm=$_POST['Users']['password_confirm'];
            if($model->validate())
            {
                $model->newpassword = $_POST['Users']['newpassword'];
                $model->password_hash = md5($model->newpassword);
                $model->temp_password = $model->newpassword;
                if($model->save()) {
                    Yii::app()->user->setFlash('successChangeMyPassword', "Đổi Mật Khẩu Thành công.");
                    $this->redirect(array('site/change_my_password'));
                }
            }
        }

        $this->render('change_my_password',array(
                'model'=>$model,
        ));
    }        

    /**
     * @Author: ANH DUNG Jan 02, 2015
     * @Todo: tạm đóng chức năng thêm và sửa của thẻ kho
     */
    public function actionMaintenance() {
        $this->render('Maintenance',array(
                'actions' => $this->listActionsCanAccess,
        ));
    }
    
    /**
     * @Author: ANH DUNG Sep 02, 2015
     * @Todo: user profile
     */
    public function actionProfile() {
        $model = MyFormat::loadModelByClass(Yii::app()->user->id, 'Users');
        $model->LoadUsersRefImageSign();
        $model->mUsersRef->old_image_sign = $model->mUsersRef->image_sign;
        if(isset($_POST['UsersRef'])){
            $model->mUsersRef->attributes = $_POST['UsersRef'];
            $model->mUsersRef->image_sign  = CUploadedFile::getInstance($model->mUsersRef, 'image_sign');
            $model->mUsersRef->validate();
            UsersRef::validateFile($model);
            if(!$model->mUsersRef->hasErrors()){
                $this->handleSaveUpdate($model);
            }
        }
        
        $this->render('user/profile',array(
            'model'=>$model,
        ));
    }
    
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
        Yii::app()->user->setFlash( MyFormat::SUCCESS_UPDATE, 'Cập nhật thành công' );
        $this->redirect(array('profile'));
    }
    
}