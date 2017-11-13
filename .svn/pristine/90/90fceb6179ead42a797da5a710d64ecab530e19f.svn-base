<?php

class MemberModule extends CWebModule
{
    public $defaultController = 'site';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'member.models.*',
			'member.components.*',
		));

        $this->setComponents(array(
            'user' => array(
                'class' => 'WebUser',
                'loginUrl' => Yii::app()->createUrl('member/site/login/'),
            ),
        ));
	}

	public function beforeControllerAction($controller, $action)
	{
            die; // add Aug 29, 2014
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
            Yii::app()->errorHandler->errorAction='member/site/error';
                
            // set pageTitle
            $act = explode('_', strtolower($action->id)); 
            $controller->pageTitle = ''.implode(' ', $act);
            
            $route = $controller->id . '/' . $action->id;
            // echo $route;
             $publicPages = array(
                'users/profile',
                'users/account_doctor',                 
                'users/edit_profile',                 
                'users/doctor_profile',                 
                'users/DoctorShowAppointment',
                'users/DoctorChangeAppointmentStatus',
                'users/DoctorAddAppointment',
                'site/cancel_appointment',
//                'site/error',
//                'site/forgot_password',
//                'site/change_password',
//		'site/register_confirm_code',
//                'site/captcha'
            );
        if(isset (Yii::app()->user->id)){    
            $mUser = Users::model()->findByPk(Yii::app()->user->id);                        
            if(is_null($mUser) || $mUser->status==STATUS_INACTIVE){                            
                Yii::app()->user->logout();
                Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/login'));
            }
        }
            if (in_array($route, $publicPages))
                if(!isset (Yii::app()->user->id))
                   Yii::app()->user->loginRequired();
            //die;
            /*if (!Yii::app()->user->isMember && !in_array($route, $publicPages)){
                //Yii::app()->getModule('member')->user->loginRequired();
                
            }
            else*/
                    return true;
		}
		else
			return false;
	}

}
