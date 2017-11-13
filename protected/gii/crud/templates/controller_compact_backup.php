<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo "AdminController \n"; ?>
{
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
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
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
            $model=new <?php echo $this->modelClass; ?>('create');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['<?php echo $this->modelClass; ?>']))
            {
                    $model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
                    $model->validate();
                    if(!$model->hasErrors()){
                            $model->save();
                            Yii::app()->user->setFlash('successUpdate', "Thêm mới thành công.");
                       $this->redirect(array('create'));
                    }				
            }

            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $exc)
            {
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
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
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['<?php echo $this->modelClass; ?>']))
            {
                    $model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
                            // $this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
                    $model->validate();
                    if(!$model->hasErrors()){
                            $model->save();
                            Yii::app()->user->setFlash('successUpdate', "Cập nhật thành công.");
                            $this->redirect(array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
                    }							
            }

            $this->render('update',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $exc)
            {
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
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
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
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
            $model=new <?php echo $this->modelClass; ?>('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['<?php echo $this->modelClass; ?>']))
                    $model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

            $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $exc)
            {
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
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
            $model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
            if($model===null)
            {
                Yii::log("The requested page does not exist.");
                throw new CHttpException(404,'The requested page does not exist.');
            }			
            return $model;
            }
            catch (Exception $exc)
            {
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
            }
            catch (Exception $exc)
            {
                Yii::log("Uid: " .Yii::app()->user->id. " Exception ".  $exc->getMessage(), 'error');
                $code = 404;
                if(isset($exc->statusCode))
                    $code=$exc->statusCode;
                if($exc->getCode())
                    $code=$exc->getCode();
                throw new CHttpException($code, $exc->getMessage());
            }
    }
}
