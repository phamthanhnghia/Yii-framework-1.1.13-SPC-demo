<?php

class MuradProductController extends AdminController 
{
    public $pluralTitle = "Products";
    public $singleTitle = "Products";
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->pageTitle = 'Xem Product';
        try{
            $model = $this->loadModel($id);
            $model->aModelDetail = $model->rDetail;
            $model->mDetail = new MuradProductImage();
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->pageTitle = 'Tạo Mới ';
        try
        {
        $model=new MuradProduct('create');
        $model->mDetail = new MuradProductImage();
        $model->mInfo = new MuradProductInfo();

        if(isset($_POST['MuradProduct']))
        {
            $model->attributes=$_POST['MuradProduct'];
            $model->mDetail->attributes = $_POST['MuradProductImage'];
            $model->mInfo->attributes = $_POST['MuradProductInfo'];
            $model->validate();
            $model->ValidateFile('file_name', array());
//            $model->ValidateMultiFile(array('required'=>1));
            $model->ValidateMultiFile();
            if(!$model->hasErrors()){
                $model->save();
                $model->SaveModelInfo();
                $model->SaveRecordMultiFile();
                $model->saveMultiType();
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
        $this->pageTitle = 'Cập Nhật  Product';
        try
        {
            $model=$this->loadModel($id);
            $model->scenario = 'update';
            $model->old_file_name = $model->file_name;
            $model->aModelDetail = $model->rDetail;
            $model->mDetail = new MuradProductImage();
            $model->mInfo = $model->rProductInfo ? $model->rProductInfo : new MuradProductInfo();
            $model->type = $model->getMultiType();

            if(isset($_POST['MuradProduct']))
            {
                $model->attributes=$_POST['MuradProduct'];
                $model->mDetail->attributes = $_POST['MuradProductImage'];
                $model->mInfo->attributes = $_POST['MuradProductInfo'];
                $model->validate();
                $model->ValidateMultiFile();
                $model->ValidateFile('file_name');
                if(!$model->hasErrors()){
                    $model->file_name = $model->old_file_name;
                    $model->update();
                    $model->SaveModelInfo();
                    if(is_array($model->mDetail->aIdNotIn) && count($model->mDetail->aIdNotIn)){
                        MuradProductImage::deleteByNotInId($model->id, $model->mDetail->aIdNotIn);
                    }else{
                        MuradProductImage::deleteByProductId($model->id);
                    }
                    $model->SaveRecordMultiFile();
                    $model->saveMultiType();
                    MuradProductImage::UpdateOrderNumberFile($model);
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
        $this->pageTitle = 'Danh Sách  Product';
        try
        {
        $model=new MuradProduct('search');
        $this->ImportProduct($model);
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['MuradProduct']))
                $model->attributes=$_GET['MuradProduct'];

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
            $model=MuradProduct::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='murad-product-form')
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
    
    
    /**
     * @Author: ANH DUNG Mar 14, 2016
     */
    public function ImportProduct($model) {
        if(isset($_GET['ImportProduct'])){
            $data = array();
            if(isset($_POST['MuradProduct']))
            {
                $model->attributes=$_POST['MuradProduct'];
                $model->file_name=$_FILES['MuradProduct'];
                if(!$model->hasErrors()){
                    MuradProduct::ImportExcelProduct($model, $data);
                    if(!isset($data['errors'])){
                        Yii::app()->user->setFlash( MyFormat::SUCCESS_UPDATE, "Import thành công: ".$data['count_insert'] );
                        $this->redirect(array('index','ImportProduct'=>1));
                    }
                }
            }
            $this->render('import/ImportProduct',array(
                'model'=>$model, 'data'=>$data, 'actions' => $this->listActionsCanAccess,
            ));
            die;
        }
    }
    
    
}
