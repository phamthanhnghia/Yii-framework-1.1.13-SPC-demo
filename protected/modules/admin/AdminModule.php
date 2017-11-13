<?php

class AdminModule extends CWebModule
{
    public $defaultController = 'site';

    public function init()
    {
//            Yii::app()->session->clear();
//            Yii::app()->session->destroy();
//            Yii::app()->cache->flush();
//            Yii::app()->user->logout();            
        try {
//            GasCheck::CheckIpOtherCountry();// Aug 08, 2016 tam dong lai
            $this->setImport(array(
                    'admin.models.*',
                    'admin.components.*',
            ));

            $this->setComponents(array(
                'user' => array(
                    'class' => 'WebUser',
                    //'loginUrl' => Yii::app()->createUrl('admin/site/login'),
                ),
            ));

            Yii::app()->user->setStateKeyPrefix('_admin');                

        } catch (Exception $e) {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());                
        }
    }

    public function beforeControllerAction($controller, $action)
    {
        try {
//            Yii::app()->language = 'en'; // Aug 07, 2016 for Backend show TEST
//                Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/UnderConstruction'));
            $mUser = null; // Jan 28, 2015 for one query to handle check current User
            if(isset(Yii::app()->user->id)){
                $mUser = Users::model()->findByPk(Yii::app()->user->id);
            }
//            $this->AutoLogin();
//            MyFunctionCustom::initNameOfRole();
//            MyFunctionCustom::checkServerMaintenance($mUser);
//            GasAgentCustomer::initSessionAgent();

//            if( Yii::app()->params['check_login_same_account'] == 'yes'){
//                if( isset (Yii::app()->user->id) && strtolower($action->id) != "emptycontent"){
//                    GasCheck::checkLogoutUser($mUser);// check  2 tài khoản login cùng lúc
//                }
//            }
            
            if(parent::beforeControllerAction($controller, $action))
            {
                Yii::app()->errorHandler->errorAction='admin/site/error';
                $route = $controller->id . '/' . $action->id;
                $publicPages = array(
                    'site/login',
                    'site/error',
                );
//                if (!in_array($route, $publicPages))
//                    if(!isset (Yii::app()->user->id))
//                        Yii::app()->user->loginRequired();

                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
        }
    }
        
        
    public function AutoLogin(){
        if(!isset(Yii::app()->user->id)){
            if(isset($_COOKIE[VERZ_COOKIE_ADMIN])){
                $data = json_decode($_COOKIE[VERZ_COOKIE_ADMIN],true);
                // Dec 13, 2014 kiểm tra có cho login = cookie hay không, 
                // sẽ chỉ cho login = cookie khi mà được bật lên trong config, cái này hàng ngày sẽ chỉ mở ra 1 lần cho login rồi đóng lại luôn
                if( $data[VERZLOGIN] == "tamdiephmgas35" ){
                    GasCheck::CheckAllowAdminCookie();
                    $LoginLog = "Success Login Cookie";
                    Logger::WriteLog($LoginLog);
                }
                $model=new AdminLoginForm();
                $model->username = $data[VERZLOGIN];
                $model->password = $data[VERZLPASS];
                $model->md5_pwd = $data[VERZLPASS];
                if($model->validate()){
                    if( $data[VERZLOGIN] == "tamdiephmgas35" ){
                        GasTrackLogin::AdminLoginCookie($LoginLog); // Aug 28, 2015
                    }                    
                    /* Change at yii 1.1.13:
                     * we not use: if (strpos(Yii::app()->user->returnUrl,'/index.php')===false) to check returnUrl
                     */    
                    if (strtolower(Yii::app()->user->returnUrl)!==strtolower(Yii::app()->baseUrl.'/'))
                        Yii::app()->controller->redirect(Yii::app()->user->returnUrl);                                                        
                    Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/index'));
                }
                
          }
      }
    }
        
                
}
