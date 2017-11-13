<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<?php 
$defaultBanner = Yii::app()->createAbsoluteUrl("/")."/upload/banner_news/AboutSkGas.jpg";
?>
<section class="bannerchild">
    <img src="<?php echo $defaultBanner; ?>" alt=""/>
</section>

<section class="mainchild">
    <div class="container">
        <h1>Error <?php echo $code; ?></h1>
        <?php echo CHtml::encode($message); ?>
    </div>
</section>