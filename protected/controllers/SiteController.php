<?php

class SiteController extends Controller
{
    public function init() {
        GasCheck::CheckIpOtherCountryV2FeOnlyDie();
        return parent::init();
    }
    
    /**
     * Declares class-based actions.
     */
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
        $this->pageTitle = "Home";
        try{
            $aBanner = MuradBanner::getByType(MuradBanner::TYPE_HOME_TOP);
            MyFormat::registerOpenGraph('og:title', Yii::app()->params['title']);
            MyFormat::registerOpenGraph('og:description', Yii::app()->params['meta_description']);
            MyFormat::registerOpenGraph('og:image', ImageProcessing::bindImageByModel($aBanner[0]));
            $this->render('index',array(
                'aBanner'=>$aBanner,
            ));
        }catch (Exception $e)
        {
            throw new CHttpException(404, $e->getMessage());
        }
    }
  
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
//        $this->redirect('underConstruction');
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    
    public function actionUnderConstruction(){
//        if(Yii::app()->params['server_maintenance']=='no')
//            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/index'));
         $this->pageTitle = 'Hệ thống không truy cập';
         $this->render('underconstruction');
     }

    public function actionContactUs()
    {
        $this->pageTitle = "Liên hệ";
        try{
            $this->render('ContactUs/ContactUs',array(
            ));
        }catch (Exception $e)
        {
            throw new CHttpException(404, $e->getMessage());
        }
    }
     
    /**
     * @Author: ANH DUNG Mar 28, 2016
     */
    public function actionAboutUs()
    {
        $this->pageTitle = "Về Murad";
        try{
            $this->render('AboutUs/AboutUs',array(
            ));
        }catch (Exception $e)
        {
            throw new CHttpException(404, $e->getMessage());
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 08, 2016
     */
    public function actionSitemap()
    {
        try{
            $this->pageTitle = "Sitemap";
            $this->render('sitemap/sitemap',array(
            ));
        }catch (Exception $e)
        {
            throw new CHttpException(404, $e->getMessage());
        }
    }
     
   
}