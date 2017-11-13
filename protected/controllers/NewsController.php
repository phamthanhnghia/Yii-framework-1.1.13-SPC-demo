<?php

class NewsController extends Controller
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
//        $this->pageTitle = "Blog, news";
//        try{
//            $dataProvider = MuradNews::SearchFE();
//            $this->render('index/index',array(
//                "dataProvider"=>$dataProvider
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
    }
    
    public function actionDetail($slug)
    {
        try{
            $model = MyFormat::getBySlugMulti("MuradNews", $slug);
            $this->pageTitle = $model->getNameForSlug();
            MyFormat::registerOpenGraph('og:title', $model->getNameForSlug());
            MyFormat::registerOpenGraph('og:description', strip_tags($model->getShortContent()));
            $urlImage = Yii::app()->createAbsoluteUrl("/")."/themes/gas/logo.png";
            MyFormat::registerOpenGraph('og:image', $urlImage);
            $session=Yii::app()->session;
            $session['ACTIVE_NEWS'] = $model;
            $this->render('detail/detail',array(
                "model"=>$model,
            ));
        }catch (Exception $e)
        {
            throw new CHttpException(404, $e->getMessage());
        }
    }
    
   
}