<?php 
    $mCat = MuradCategory::model()->findByPk($model->category_id);
?>
<?php include "detail_banner.php"; ?>

<section class="mainchild">
    <div class="container">
        <?php $this->widget('News', array('mNews'=>$model)); ?>
        <div class="col-right">
            <?php if($model->id == MuradNews::PAGE_AGENT_LOCATION): ?>
                <?php include "DetailAgentMap.php"; ?>
            <?php else: ?>
                <?php include "DetailNormal.php"; ?>
            <?php endif; ?>
        </div>
    </div>
</section>