<?php

class MuradNewsController extends AdminController 
{
    public $pluralTitle = "Tin Tức";
    public $singleTitle = "Tin Tức";
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
        $model=new MuradNews('create');
        if(isset($_POST['MuradNews']))
        {
//            $model->attributes=$_POST['MuradNews'];
//            $model->validate();
            $model->attributes =  $model->getDataValidate();

//            $model->ValidateFile('feature_image', array('required'=>1));
            $model->ValidateFile('feature_image', array());
            if(!$model->hasErrors()){
                $model->save();
                $model->saveDataWithLanguage('MuradNews');
                $model->SaveRecordOneFile('feature_image', array('resize'=>1));
                MuradCategory::updateSlugNews($model->category_id);
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
        try{
        $model=$this->loadModel($id);
        $model->scenario = 'update';
        $model->old_file_name = $model->feature_image;
        $model->deleteFileDirectory($this);

        if(isset($_POST['MuradNews'])){
//            $model->attributes=$_POST['MuradNews'];
            $model->attributes =  $model->getDataValidate();
            $model->CheckMultiFile();
            $model->validate();
            $model->ValidateFile('feature_image');
            if(!$model->hasErrors()){
                if($model->RemoveOldFile){
                    $model->RemoveFileOnly('feature_image');
                }
                $model->update();
                $model->saveDataWithLanguage('MuradNews');
                $model->SaveRecordOneFile('feature_image', array('resize'=>1));
                $model->SaveMultiFile();
                MuradCategory::updateSlugNews($model->category_id);
                Yii::app()->user->setFlash( MyFormat::SUCCESS_UPDATE, "Cập nhật thành công." );
                $this->redirect(array('update','id'=>$model->id));
            }
        }

        $this->render('update',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
        }catch (Exception $exc){
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
        try{
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
        }catch (Exception $exc){
            GasCheck::CatchAllExeptiong($exc);
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
//        echo '<pre>';
//        print_r(MyFormat::makeRequestApi('http://spj.daukhimiennam.com/api/spj/getLocationAgent'));
//        echo '</pre>';
//        die;
        $this->pageTitle = 'Tin Tức List';
        try{
        $model=new MuradNews('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['MuradNews']))
                $model->attributes=$_GET['MuradNews'];

        $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
        }catch (Exception $exc){
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
        $model=MuradNews::model()->findByPk($id);
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

}
