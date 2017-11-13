<?php 
MuradCategory::initSessionHome();
$session = Yii::app()->session;
$aTypeCat = isset($session['HOME_ARR_TYPE_CAT']) ? $session['HOME_ARR_TYPE_CAT'] : array();
$aCategoryProduct = isset($session['HOME_CAT_PRODUCT']) ? $session['HOME_CAT_PRODUCT'] : array();

$aCatNews = isset($session['HOME_CAT_MEWS']) ? $session['HOME_CAT_MEWS'] : array();
?>
<div class="box-footer2 clearfix">
    <div class="col-f1">
        <h3>Blog</h3>
        <ul>
            <?php foreach ($aCatNews as $mCat): ?>
                <li><a href="<?php echo $mCat->getUrlCategoryNews();?>"><?php echo $mCat->getName(); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <?php foreach ($aTypeCat as $type => $type_name): ?>
    <div class="col-f1">
        <h3><?php echo $type_name; ?></h3>
        <ul>
            <?php foreach ($aCategoryProduct[$type] as $modelCat): ?>
                <li><a href="<?php echo $modelCat->getUrlListProduct();?>"><?php echo $modelCat->getName(); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</div>
