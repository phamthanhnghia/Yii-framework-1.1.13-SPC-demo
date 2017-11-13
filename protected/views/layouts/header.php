<header>
    <div class="container">
        <div class="logo">
            <a href="<?php echo Yii::app()->createAbsoluteUrl("/");?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt=""/></a>
        </div>
        <div class="nav-top">
            <ul class="link-top">
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl("site/sitemap");?>">SITEMAP</a></li>
<!--                <li><a href="#">KOREAN</a></li>
                <li><a href="#">SJ GROUP</a></li>-->
                <li class="link-custom"><a href="#"><?php echo MyFormat::label('CustomerCenter'); ?></a></li>
            </ul>
            <?php include "header_lang.php"; ?>
            <?php echo MuradCategory::renderFeMenu(); ?>
        </div>
    </div>
</header>