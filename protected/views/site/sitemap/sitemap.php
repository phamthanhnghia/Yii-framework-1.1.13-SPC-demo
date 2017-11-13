<?php $this->renderPartial('application.views.news.detail.detail_banner',array("mCategory"=>null)); ?>

<section class="mainchild">
    <div class="container ">
        <div class="col-full BoxSitemap">
            <div class="page-header-cnt-2">SITEMAP</div>
            <?php echo MuradCategory::renderFeSitemap(); ?>
        </div>
    </div>
</section>