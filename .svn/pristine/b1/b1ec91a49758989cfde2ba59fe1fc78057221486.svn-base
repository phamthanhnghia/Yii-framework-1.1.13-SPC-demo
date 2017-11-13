<?php 
$defaultBanner = Yii::app()->createAbsoluteUrl("/")."/upload/banner_news/AboutSkGas.jpg";
if(isset($mCat) && $mCat->getType()){
    $defaultBanner = Yii::app()->createAbsoluteUrl("/")."/upload/banner_news/{$mCat->getType()}.jpg";
}
?>
<section class="bannerchild">
    <img src="<?php echo $defaultBanner; ?>" alt=""/>
</section>