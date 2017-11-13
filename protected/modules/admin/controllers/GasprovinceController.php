<?php

class GasprovinceController extends AdminController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $this->pageTitle = 'Xem Tỉnh - Thành Phố';
                try{
                $this->render('view',array(
			'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    $code = 404;
                    if(isset($e->statusCode))
                        $code=$e->statusCode;
                    if($e->getCode())
                        $code=$e->getCode();
                    throw new CHttpException($code, $e->getMessage());
                }
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $this->pageTitle = 'Tạo Mới Tỉnh - Thành Phố';
                try
                {
		$model=new GasProvince('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GasProvince']))
		{
			$model->attributes=$_POST['GasProvince'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    $code = 404;
                    if(isset($e->statusCode))
                        $code=$e->statusCode;
                    if($e->getCode())
                        $code=$e->getCode();
                    throw new CHttpException($code, $e->getMessage());
                }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $this->pageTitle = 'Tạo Mới Tỉnh - Thành Phố';
                try
                {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GasProvince']))
		{
			$model->attributes=$_POST['GasProvince'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    $code = 404;
                    if(isset($e->statusCode))
                        $code=$e->statusCode;
                    if($e->getCode())
                        $code=$e->getCode();
                    throw new CHttpException($code, $e->getMessage());
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
                                Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
                {
                    Yii::log("Invalid request. Please do not repeat this request again.");
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }	
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    throw new CHttpException(400,$e->getMessage());
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
            $this->pageTitle = 'Danh Sách Tỉnh - Thành Phố';
                try
                {
		$model=new GasProvince('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GasProvince']))
			$model->attributes=$_GET['GasProvince'];

		$this->render('index',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    $code = 404;
                    if(isset($e->statusCode))
                        $code=$e->statusCode;
                    if($e->getCode())
                        $code=$e->getCode();
                    throw new CHttpException($code, $e->getMessage());
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
		$model=GasProvince::model()->findByPk($id);
		if($model===null)
                {
                    Yii::log("The requested page does not exist.");
                    throw new CHttpException(404,'The requested page does not exist.');
                }			
		return $model;
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    $code = 404;
                    if(isset($e->statusCode))
                        $code=$e->statusCode;
                    if($e->getCode())
                        $code=$e->getCode();
                    throw new CHttpException($code, $e->getMessage());
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='gas-province-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                }
                catch (Exception $e)
                {
                    Yii::log("Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
                    $code = 404;
                    if(isset($e->statusCode))
                        $code=$e->statusCode;
                    if($e->getCode())
                        $code=$e->getCode();
                    throw new CHttpException($code, $e->getMessage());
                }
	}
}