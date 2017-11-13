<?php

class SettingController extends AdminController
{    
    public function TestSms() {
//        $sms = new GasScheduleSms('GetBalance');
//        $sms->getBalance();
        
        $sms = new GasScheduleSms();
        $sms->sendSmsTest();
    }

    /**
     * @Author: ANH DUNG Jan 12, 2016
     */
    public function HandleTestSendMail() {
        if(isset($_GET['test_send_mail'])){
            SendEmail::TestCron();// Test send mail function
            $this->redirect(array('index'));
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 15, 2016
     */
    public function resizeProduct() {
        return ;
        $models = MuradProductImage::model()->findAll();
        foreach($models as $model){
            $model->resizeImage('file_name');
        }
        echo '<pre>';
        print_r(count($models));
        echo '</pre>';
        die;
    }
    
    /**
     * Manages all models.
     */
    public function actionIndex()
    {

//        $this->resizeProduct();
//        $this->TestSms();
//        UsersRef::UpdateJsonContactPerson();
//        UpdateSql::UpdateSaleIdSomeTable();
//        UpdateSql::IssueTicketUpdateTypeCustomer();
        
//        $a = MyFormat::addDays(date('Y-m-d H:i:s'), (2.5*60), "+", 'minutes', 'Y-m-d H:i:s');
//        echo '<pre>';
//        print_r($a);
//        echo '</pre>';
//        die;
//        UpdateSql::UpdateProvinceIdAgentOfStorecard(); // Apr 22, 2015
//        UpdateSql::UpdateLastInputRemainStorecard();
//        Users::UpdateKeyInfo(100, 'date_last_storecard', '2015-04-10');
//        UpdateSql::Agent2014UpdateImportExport();// Mar 11, 2015 
//        GasLeave::OnlyUpdateCName(); // Run Mar 08, 2015 - 290 done in: 1 Second
//        SendEmail::TestLeaveAlertSend();die;
//        SendEmail::TestCron();die; // Test send mail function
//        GasMaintainSell::DeleteByAgentId(314408);
//        $this->DeleteSomeRow();
        try {
        $this->HandleTestSendMail();
        $this->layout ='column1';
        $model = new SettingForm;
        $model->scenario = "updateSettings";
        $setting = Yii::app()->setting;
        if (isset($_POST['SettingForm'])) {
            $model->attributes = $_POST['SettingForm'];
            if ($model->validate()) {
                $setting->setDbItem('transportType', $model->transportType);
                foreach(SettingForm::$arrSmtp as $key => $value)
                {
                    $setting->setDbItem($value, $model->$value);
                }

                foreach(SettingForm::$arrGeneral as $key => $value)
                {
                    if($value != 'image_watermark')
                    $setting->setDbItem($value, $model->$value);                        
                }

                // DEC 29, 2014 ANH DUNG CLOSE
//                $setting->setDbItem('paypal_email_address', $model->paypal_email_address);
//
//                $setting->setDbItem('paypalType', $model->paypalType);
//                if($model->paypalType == 'live') {
//                    $setting->setDbItem('paypalURL', str_replace('sandbox.', '', SettingForm::$_paypalURL));
//                } else { //paypalType = 'test'
//                    if(strpos($model->paypalURL, 'sandbox.') == false) {
//                        $setting->setDbItem('paypalURL', str_replace('paypal', 'sandbox.paypal', SettingForm::$_paypalURL));
//                    }
//                }


                $setting->setDbItem('title', $model->title);

                $file = CUploadedFile::getInstance($model,'image_watermark2');
                if($file !== null){
                    $baseImagePath = ROOT . '/upload/admin/settings/';
                    $name = preg_replace('/\.\w+$/', '', $file->name);
                    $newName = $name . '_' . time() . rand(1,10000).'.' . $file->extensionName;
                    Yii::log($newName, 'error');
                    if($file->saveAs($baseImagePath.$newName))
                    {
                        $model->image_watermark = $newName;
                        $setting->setDbItem('image_watermark', $newName);
                    }
                } else{
                    $model->image_watermark = $setting->getItem('image_watermark');
                    $setting->setDbItem('image_watermark', $setting->getItem('image_watermark'));
                }

                Yii::app()->user->setFlash('setting', 'Setting has been updated.');
            }
        } else {
            $temp = $setting->getItem('transportType');
            if (!empty($temp)) {
                $model->transportType = $setting->getItem('transportType');
            } else if(!empty(Yii::app()->mail->transportType)) {
                $model->transportType = Yii::app()->mail->transportType;
            }

            foreach(SettingForm::$arrSmtp as $key => $value)
            {                
                $temp = $setting->getItem($value);
                if (!empty($temp)) {
                    $model->$value = $setting->getItem($value);
                } else if(!empty(Yii::app()->mail->transportOptions[$key])) {
                    $model->$value = Yii::app()->mail->transportOptions[$key];
                }
            }

            foreach(SettingForm::$arrGeneral as $key => $value)
            {                
                $temp = $setting->getItem($value);
                if (!empty($temp)) {
                    $model->$value = $setting->getItem($value);
                } else if(!empty(Yii::app()->mail->transportOptions[$key])) {
                    $model->$value = Yii::app()->mail->transportOptions[$key];
                }
            }

             // DEC 29, 2014 ANH DUNG CLOSE
//            $temp = $setting->getItem('paypalURL');
//            if (!empty($temp)) {
//                $model->paypalURL = $setting->getItem('paypalURL');
//            } else if(!empty(Yii::app()->params['paypalURL'])) {
//                $model->paypalURL = Yii::app()->params['paypalURL'];
//            }
//
//            $temp = $setting->getItem('paypalType');
//            if (!empty($temp)) {
//                $model->paypalType = $setting->getItem('paypalType');
//            } else {
//                $model->paypalType = 'live';
//            }
//
//            $temp = $setting->getItem('paypal_email_address');
//            if (!empty($temp)) {
//                $model->paypal_email_address = $setting->getItem('paypal_email_address');
//            } else if(!empty(Yii::app()->params['paypal_email_address'])) {
//                $model->paypal_email_address = Yii::app()->params['paypal_email_address'];
//            }

            $temp = $setting->getItem('title');
            if (!empty($temp)) {
                $model->title = $setting->getItem('title');
            } else if(!empty(Yii::app()->params['title'])) {
                $model->title = Yii::app()->params['title'];
            }

        }
        $this->render('index', array('model' => $model, ));
    } catch (Exception $exc) {
        MyFormat::catchAllException($exc);
    }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Setting::model()->findByPk($id);
        if ($model === null)
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'setting-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    /**
     * @Author: ANH DUNG Oct 13, 2015
     * @Todo:  may xoa dum tao ban hang bt+pttt cua quan 10
        [09:59:09] ngoc_kien1: tu ngay 18/07/2015 den ngay 17/09/2015
        415 results ah  
     * @Param: 
     */
    public function DeleteSomeRow() {
        
        $from = time();
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition("t.date_sell","2015-07-23","2015-10-21");
//        $criteria->compare("t.agent_id", 242369);// quan 10
//        $criteria->compare("t.agent_id", 100);// quận 2
//        $criteria->compare("t.agent_id", 102);// quận 7
        $criteria->compare("t.agent_id", 658920);// quận 7
        $models = GasMaintainSell::model()->findAll($criteria);
        echo '<pre>';
        print_r(count($models));
        echo '</pre>';
        die;
        foreach($models as $item){
            $item->delete();
        }
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
        
        
    }
    
    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Setting'])) {
            $model->attributes = $_POST['Setting'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    
}
