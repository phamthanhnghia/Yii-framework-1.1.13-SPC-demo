<?php

class SiteController extends MemberController
{
    /**
     * Declares class-based actions.
     */
    public $attempts = 2;
    public $counter;
    
    public function accessRules() {
        return array();
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

	public function actionIndex()
	{
            $this->render('index');
	}
	
    public function actionview_cms(){
		$model = Cms::model()->find('slug="'.$_GET['id'].'"');
		$this->render('view_cms',array(
			'model'=>$model,
		));
	}    

     public function actionview_cms_slug($slug){
         $model = Cms::model()->findAll('slug="'.$slug.'" ORDER BY created_date ASC'); 
         if(count($model)>0){
            $this->render('view_cms_slug', array(
                'model'=>$model[0]));             
         }else
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
     }
        
     public function actionview_articles($slug){
         $model = Articles::model()->findAll('slug="'.$slug.'" ORDER BY created_date ASC'); 
         if(count($model)>0){
            $this->render('view_articles', array(
                'model'=>$model[0]));             
         }else
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
     }     
 
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }    
    
    public function checkIndexNumber($index_number){
        $count = Users::model()->count('index_number='.$index_number.'');
        if($count>0){
            $index_number = $this->checkIndexNumber(rand(100000, 1000000));
            return $index_number;
        }else 
            return $index_number;
    }
    
    
    public function checkVerifyCode($verify_code){
        $count = Users::model()->count('verify_code='.$verify_code.'');
        if($count>0){
            $verify_code = $this->checkIndexNumber(rand(100000, 1000000));
            return $verify_code;
        }else 
            return $verify_code;
    }

    public function actiontry_new_code(){
        try{
            if(!empty($_POST['type']) && !empty($_POST['value'])){
                if($_POST['type']=='new_code_email'){
                    $model = Users::model()->find('email="'.$_POST['value'].'"');
                    if(count($model)==1){
                        // gen new code
                        $model->verify_code = $this->checkVerifyCode(rand(100000, 1000000)); // Gen verify code and send qua mail or sms
                        $model->update();
                        // send mail
                        $this->doVerify($model,'email');
                        $json = CJavaScript::jsonEncode(array('success'=>true,'msg'=>'Generation new code successful. Please check email '.$model->email));
                    }else throw new Exception('Email not valid ');
                }elseif($_POST['type']=='new_code_phone'){ // try new code with phone sms
                    $model = Users::model()->find('phone="'.(int)$_POST['value'].'" AND area_code_id="'.(int)$_POST['area_code_id'].'"');
                    
                    if(count($model)==1){
                        // gen new code
                        $model->verify_code = $this->checkVerifyCode(rand(100000, 1000000)); // Gen verify code and send qua mail or sms
                        $model->update();
                        // send sms phone
                        if($this->doVerify($model,'phone_sms'))
                            $json = CJavaScript::jsonEncode(array('success'=>true,'msg'=>'Generation new code successful. Please check phone number '.$model->areaCodeRelation->area_code.$model->phone));
                        else 
                            throw new Exception('Can not send verify code to phone number: '.$model->areaCodeRelation->area_code.$model->phone);
                            //$json = CJavaScript::jsonEncode(array('success'=>false,'msg'=>'));
                    }else throw new Exception('Number phone not valid');
                    
                }else throw new Exception('Email or number phone not valid.');
                    
            }else throw new Exception('Email or number phone not valid ');
                   
        }catch(Exception $ex){
            $json = CJavaScript::jsonEncode(array('success'=>false,'msg'=>$ex->getMessage()));
        }
        echo $json;
        Yii::app()->end();
        
    }
    
    public function actionajax_check_mail(){
        try{
            if(isset($_POST['email'])){
                // 1 check rule email of model user
                // if ok rule email then check 2

                $model=new Users('register');
                $model->email = $_POST['email'];
                $jsonValidate = CActiveForm::validate($model);
                $error = CJSON::decode($jsonValidate);
                if(isset($error['Users_email']))
                    throw new Exception($error['Users_email'][0]);
                   
               $json = CJavaScript::jsonEncode(array('success'=>true));
            }else
                throw new Exception('email_empty');
        }catch( Exception $ex){
            $json = CJavaScript::jsonEncode(array('success'=>false,'msg'=>$ex->getMessage()));
        }
        echo $json;
        Yii::app()->end();
    }

    public function actionajax_check_phone(){
        try{
            if(isset($_POST['phone'])){
                $phone = $_POST['phone'];
                $area_code_id = $_POST['area_code_id'];
                $count = Users::model()->count('phone='.(int)$phone.' AND area_code_id='.(int)$area_code_id.'');
                if($count>0)
                    throw new Exception('The phone has exist');
                
               $json = CJavaScript::jsonEncode(array('success'=>true));
            }else
                throw new Exception('Phone is empty');
        }catch( Exception $ex){
            $json = CJavaScript::jsonEncode(array('success'=>false,'msg'=>$ex->getMessage()));
        }
        echo $json;
        Yii::app()->end();
    }

     public function actionverify_register_again(){
         $model = Users::model()->find('email="'.$_GET['email'].'"');
         if(count($model)==1)
            $this->render('register_confirm_code',array('model'=>$model));
         else
             $this->redirect(Yii::app()->createAbsoluteUrl('/'));
     }
    
    // Success register page
    public function actionSuccess($id){
        $this->render('success',array('model'=>$model));
    }
 
    
     public function actionview_page_slug($slug){
         $model = Posts::model()->findAll('slug="'.$slug.'" ORDER BY created_date DESC');
          
         if(count($model)>0){
            $this->render('view_page_slug', array(
                'model'=>$model[0]));             
         }else
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
     } 
    
    

}
