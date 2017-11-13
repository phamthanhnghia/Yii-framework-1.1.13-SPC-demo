<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: CmsController.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
class CmsController extends AdminController
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
            $model=new Cms;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Cms']))
            {
                    $model->attributes=$_POST['Cms'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
            $model=$this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Cms']))
            {
                    //var_dump($model->banner);die;
                    $oldBanner = $model->banner;
                    $model->attributes=$_POST['Cms'];
                    if(empty($_POST['Cms']['useBanner']))                        
                        $model->banner = $oldBanner ;
                    else if(!empty($_POST['Cms']['useBanner']) && $_POST['Cms']['useBanner']=='on')
                            if(file_exists('upload/cms/banner/'.$oldBanner) && !empty($oldBanner)) 
                                 unlink('upload/cms/banner/'.$oldBanner);
                    if($model->save())
                        $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('update',array(
                    'model'=>$model,'actions' => $this->listActionsCanAccess,
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
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
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
            {
                Yii::log('Invalid request. Please do not repeat this request again.');
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }			
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
//        phpinfo();die;
        $model=new Cms();
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Cms']))
                $model->attributes=$_GET['Cms'];

        $this->render('index',array(
                'model'=>$model,'actions' => $this->listActionsCanAccess,
        ));

    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            $model=Cms::model()->findByPk($id);
            if($model===null)
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='cms-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }

    public function actionUploadFile()
    {
        echo 1;die;
        return array(
            'upload'=>array(
                'class'=>'xupload.actions.XUploadAction',
                'path' =>Yii::app() -> getBasePath() . "/../banner",
                'publicPath' => Yii::app() -> getBaseUrl() . "/banner",
            ),
        );
    }


        public function actions()
    {
        return array(
            'upload'=>array(
                'class'=>'xupload.actions.XUploadAction',
                'path' =>Yii::app() -> getBasePath() . "/../uploads",
                'publicPath' => Yii::app() -> getBaseUrl() . "/uploads",
            ),
        );
    }


    public function actionAjaxActivateField($id, $field_name) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'activateField'))
            {
//                $session=Yii::app()->session;
//                $session['HAS_READ_NEWS'] = 0;
                Yii::app()->setting->setDbItem('show_popup_news', 1);
                $model->activateField($field_name);
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
    public function actionAjaxDeactivateField($id, $field_name) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'deactivateField'))
            {
                Yii::app()->setting->setDbItem('show_popup_news', 0);
                $model->deactivateField($field_name);
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }

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

    public function actionNews($id)
    {
        $model=$this->loadModel($id);
        if($model->status!=STATUS_ACTIVE)
            $this->redirect (Yii::app()->createAbsoluteUrl ('admin/site'));
        if(isset($_GET['HAS_READ_NEWS'])){
            $session=Yii::app()->session;
            $tempArrId = array();
            if(!isset($session['ARR_ID_NEWS'][$id]))
            {
                if(!isset($session['ARR_ID_NEWS'])){
                    $tempArrId = array($id=>$id);
                }else{
                    $tempArrId = $session['ARR_ID_NEWS'];
                    $tempArrId[$id]=$id;
                }
                $session['ARR_ID_NEWS'] = $tempArrId;
            }
        }
        $this->render('News',array(
                'model'=>$model,'actions' => $this->listActionsCanAccess,
        ));
    }    
    
}
