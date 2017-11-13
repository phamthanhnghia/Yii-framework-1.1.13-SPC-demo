<?php

class VideosController extends Controller
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

//    public function actionIndex()
//    {
//        $this->pageTitle = "Video";
//        try{
//            $model = new MuradVideo();
//            $this->render('index/index',array(
//                "model"=>$model,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
//    
//    /**
//     * @Author: ANH DUNG Mar 14, 2016
//     * @Todo: view detail video
//     */
//    public function actionDetail($slug)
//    {
//        try{
//            $model = MyFormat::getBySlug("MuradVideo", $slug);
//            if($model->type != MuradVideo::TYPE_VIDEO){
//                throw new Exception('Invalid request');
//            }
//            $this->pageTitle = $model->getName();
//            
//            MyFormat::registerOpenGraph('og:title', $this->pageTitle);
//            MyFormat::registerOpenGraph('og:description', strip_tags($this->pageTitle));
//            MyFormat::registerOpenGraph('og:image', $model->getUrlImage('size1'));
//            $this->render('index/detail',array(
//                "model"=>$model,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
//    
//    /**
//     * @Author: ANH DUNG Mar 14, 2016
//     * @Todo: view detail radio
//     */
//    public function actionDetailRadio($slug)
//    {
//        try{
//            $model = MyFormat::getBySlug("MuradVideo", $slug);
//            if($model->type != MuradVideo::TYPE_AUDIO){
//                throw new Exception('Invalid request');
//            }
//            $this->pageTitle = $model->getName();
//            MyFormat::registerOpenGraph('og:title', $this->pageTitle);
//            MyFormat::registerOpenGraph('og:description', strip_tags($this->pageTitle));
//            MyFormat::registerOpenGraph('og:image', $model->getUrlImage('size1'));
//            $this->render('Audio/detail',array(
//                "model"=>$model,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
//    
//    public function actionRadio()
//    {
//        $this->pageTitle = "Radio";
//        try{
//            $model = new MuradVideo();
//            $this->render('Audio/index',array(
//                "model"=>$model,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
   
}