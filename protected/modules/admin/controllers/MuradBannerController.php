<?php

class MuradBannerController extends AdminController 
{
    public $pluralTitle = "Home Banner";
    public $singleTitle = "Home Banner";
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
            GasCheck::CatchAllExeptiong($exc);
        }

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->pageTitle = 'Tạo Mới ';
            try
            {
            $model=new MuradBanner('create');

            if(isset($_POST['MuradBanner']))
            {
                $model->attributes=$_POST['MuradBanner'];
                $model->validate();
                $model->ValidateFile('file_name', array('required'=>1));
                if(!$model->hasErrors()){
                    $model->save();
                    $model->SaveRecordOneFile('file_name');
                    Yii::app()->user->setFlash( MyFormat::SUCCESS_UPDATE, "Thêm mới thành công." );
                    $this->redirect(array('create'));
                }
            }

            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $exc)
            {
                GasCheck::CatchAllExeptiong($exc);
            }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->pageTitle = 'Cập Nhật ';
        try
        {
        $model=$this->loadModel($id);
        $model->scenario = 'update';
        $model->old_file_name = $model->file_name;
        if(isset($_POST['MuradBanner']))
        {
            $model->attributes=$_POST['MuradBanner'];
            $model->validate();
            $model->ValidateFile('file_name');
            if(!$model->hasErrors()){
                $model->file_name = $model->old_file_name;
                $model->update();
                $model->SaveRecordOneFile('file_name');
                Yii::app()->user->setFlash( MyFormat::SUCCESS_UPDATE, "Cập nhật thành công." );
                $this->redirect(array('update','id'=>$model->id));
            }
        }

        $this->render('update',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $exc)
        {
            GasCheck::CatchAllExeptiong($exc);
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
                GasCheck::CatchAllExeptiong($exc);
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
        $model=new MuradBanner('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['MuradBanner']))
                $model->attributes=$_GET['MuradBanner'];

        $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $exc)
        {
            GasCheck::CatchAllExeptiong($exc);
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
        $model=MuradBanner::model()->findByPk($id);
        if($model===null)
        {
            Yii::log("The requested page does not exist.");
            throw new CHttpException(404,'The requested page does not exist.');
        }			
        return $model;
        }
        catch (Exception $exc)
        {
            GasCheck::CatchAllExeptiong($exc);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='murad-banner-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        }
        catch (Exception $exc)
        {
            GasCheck::CatchAllExeptiong($exc);
        }
    }
}
