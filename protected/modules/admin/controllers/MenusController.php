<?php

class MenusController extends AdminController
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
            'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model =new Menus();
        if(isset($_POST['Menus']))
        {
            $model->attributes=$_POST['Menus'];
            if($model->save())
            {
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
             'actions' => $this->listActionsCanAccess,
        ));
    }
    
    public function actionGetactioncheckbox()
    {
        if(isset($_POST['controller']) && isset($_POST['module']))
        {
            $actions = ControllerActionsName::getActions($_POST['controller'],$_POST['module']);
            if($actions != null)
            {
                $array_action = array_map('trim',explode(",",trim($actions)));
                MyDebug::output($array_action);
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        if(isset($_POST['Menus']))
        {
            $model->attributes=$_POST['Menus'];
            if($model->update())
            {
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('update',array(
            'model'=>$model,
             'actions' => $this->listActionsCanAccess,
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
    /*
                $menus = Menus::model()->findAll();
                $idChild = Menus::model()->findAllChild($id,$menus);
                if(count($idChild)>0)
                    Menus::model()->deleteByPk($idChild);
    */
            $this->loadModel($id)->delete();
            RolesMenus::model()->deleteAll(array('condition'=>'menu_id = '.$id));

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
        $model=new Menus('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Menus']))
            $model->attributes=$_GET['Menus'];

        $this->render('admin',array(
            'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Menus::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='menus-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
