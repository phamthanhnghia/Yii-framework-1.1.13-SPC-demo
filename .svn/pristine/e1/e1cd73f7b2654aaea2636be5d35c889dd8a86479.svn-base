<?php

class LanguagesController extends AdminController 
{
    public $pluralTitle = "Languages";
    public $singleTitle = "Languages";
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
        try{
        $model=new Languages('create');

        if(isset($_POST['Languages']))
        {
            $model->attributes=$_POST['Languages'];
            $model->validate();
            if(!$model->hasErrors()){
                $model->save();
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

        if(isset($_POST['Languages']))
        {
            $model->attributes=$_POST['Languages'];
                    // $this->redirect(array('view','id'=>$model->id));
            $model->validate();
            if(!$model->hasErrors()){
                $model->save();
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
        $this->pageTitle = 'Languages List ';
        try
        {
        $model=new Languages('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Languages']))
                $model->attributes=$_GET['Languages'];

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
        $model=Languages::model()->findByPk($id);
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
     * @Author: ANH DUNG Jun 19, 2016
     * @Todo: update lang to file
     */
    public function actionUpdateTextTranslate($id){
        $model = $this->loadModel($id);
        $lang = $model->code;
        $arrError = array();
        $nameTranslation = "translation";
        $nameSystem = "system";

        //get languages root
//        $translate_root =  include Yii::app()->basePath .'/messages/en/translation.php';
//        $view_root =  include Yii::app()->basePath .'/messages/en/system.php';
//        $file_root =  array_merge($translate_root,$view_root);
        
        // 2 file root
        $fTranslationRoot     =  Yii::app()->basePath ."/messages/en/$nameTranslation.php";
        $fSystemRoot        =  Yii::app()->basePath ."/messages/en/$nameSystem.php";
        $dir = Yii::app()->basePath .'/messages/' .$lang;
        // 2 file to copy nếu chưa có tạo
        $fTranslationUpdate   = Yii::app()->basePath ."/messages/" .$lang."/$nameTranslation.php";
        $fSystemUpdate        = Yii::app()->basePath ."/messages/" .$lang."/$nameSystem.php";

        if (!is_dir($dir)){
            @mkdir ($dir);
            @chmod($dir, 0777);
        }
        if(!file_exists($fTranslationUpdate)){// tạo mới nếu chưa có
            @copy($fTranslationRoot, $fTranslationUpdate) ;
        }
        if(!file_exists($fSystemUpdate)) {
            @copy($fSystemRoot, $fSystemUpdate);
        }
//        sleep(3); // Dec 31, 2014 for read update file
        $fileTranslation  =  include $fTranslationUpdate;
        $fileSystem     =  include $fSystemUpdate;
        $aField =  array_merge($fileTranslation,$fileSystem);
        $aDataFile = array($nameTranslation=>$fileTranslation, $nameSystem=>$fileSystem);
        
        $this->handlePost($arrError, $model, $aDataFile, $lang);
        $this->render('_form_translate',array(
		'aField'=>$aField, 'error'=>$arrError,"model"=>$model,
	));
        
        die;
    }
    
    /**
     * @Author: ANH DUNG Jun 19, 2016
     * @Todo: handle save file
     */
    public function handlePost(&$arrError, $model, $aDataFile, $lang) {
        if(isset($_POST['SavePost'])){
            foreach ($_POST as $key =>$val){
               if($val =='') {
                   $arrError[$key] = 'Field cannot be blank.';
                   $model->addError('email', $key." Field cannot be blank.");
               }
            }
            
            if(count($arrError) == 0 ){
                foreach ($aDataFile as $label => $dataField){
                     $tmp = "<?php return array( ";
                         foreach ($dataField as $k1 =>$v1){
                             $str = str_replace('.', '_', $k1);
                             if(array_key_exists($str, $_POST)){
                                 $tmp .= '"'.$k1.'" =>' . '"' . $_POST[$str] . '"' . ',';
                             }
                         }
                    $tmp .="); ?>";
                    $file_translate= Yii::app()->basePath .'/messages/'.$lang.'/' .$label  .'.php';
                    file_put_contents($file_translate, $tmp) or die("Cannot write to file"); 
                }
                sleep(5); // Dec 31, 2014 for read update file
                Yii::app()->user->setFlash( MyFormat::SUCCESS_UPDATE, "Cập nhật thành công." );
                $this->redirect(Yii::app()->createAbsoluteUrl("admin/languages/updateTextTranslate", array('id'=>$model->id)));
           }
        }
    }



}
