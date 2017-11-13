<?php

class ProductController extends Controller
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
        die;
    }
    
//    public function actionDetail($slug)
//    {
//        try{
//            $mProduct = MyFormat::getBySlug("MuradProduct", $slug);
//            $nameProduct = strip_tags($mProduct->getName());
//            MyFormat::registerOpenGraph('og:title', $nameProduct);
//            MyFormat::registerOpenGraph('og:description', strip_tags($mProduct->getDescription()));
//            MyFormat::registerOpenGraph('og:image', $mProduct->getUrlImageDefault('size2'));
//            $this->pageTitle = $nameProduct;
//            $this->render('detail/detail',array(
//                "mProduct"=>$mProduct,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
//    
//    
//    /**
//     * @Author: ANH DUNG Mar 14, 2016
//     * @Todo: show list featured product
//     */
//    public function actionFeatured()
//    {
//        try{
//            $this->pageTitle = "Sản phẩm nổi bật";
//            $DataProviderFeatured = MuradProduct::getFeaturedProductGrid();
//            $this->render('Featured/Featured',array(
//                "DataProviderFeatured"=>$DataProviderFeatured,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
//    
//    /**
//     * @Author: ANH DUNG Mar 24, 2016
//     * @Todo: show list product type
//     */
//    public function actionType($slug)
//    {
//        try{
//            $mProduct = new MuradProduct();
//            $idType = $mProduct->getIdTypeBySlugType($slug);
//            if(!$idType){
//                throw new Exception('Invalid request type');
//            }
//            
//            $mProduct->type = $idType;
//            $this->pageTitle = $mProduct->getTypeText();
//            $mProduct->name = $this->pageTitle;
////            $DataProviderProduct = $mProduct->getProductByType();
//            $this->render('ListByType/ListByType',array(
//                "mProduct"=>$mProduct,
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
//    
//    /**
//     * @Author: ANH DUNG Mar 28, 2016
//     * @Todo: show list product
//     */
//    public function actionList()
//    {
//        try{
//            $model = new MuradProduct();
//            $this->pageTitle = "Danh sách sản phẩm";            
//            $this->render('ListAll/List', array(
//                "model"=>$model
//            ));
//        }catch (Exception $e)
//        {
//            throw new CHttpException(404, $e->getMessage());
//        }
//    }
   
}