<?php
$this->breadcrumbs=array(
	'Xem Thông Báo',
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/ad_gas.css" />
<div class="ad_read_news">
    <section>
        <h1 class="title"><strong><?php echo $model->title;?></strong></h1>
        <div class="content document">
            <?php echo $model->cms_content;?>
        </div>
        <div class='clr'></div>
    </section>
</div>


<div class="ad_read_news">
    <section>
         <h1 class="title"><strong>Thông Báo Khác</strong></h1>
        <div class="content document">
        <?php
        $mCms = Cms::getAllShowIndexByStatus(STATUS_ACTIVE);
        if(count($mCms)>0): ?>
            <ul>
            <?php foreach($mCms as $cms): ?>
                <li>
                    <a class="gas_link" href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/news',array('id'=>$cms->id));?>">
                       <?php echo $cms->title;?>
                   </a>
                </li>
            <?php endforeach;?>
            </ul>
        <?php endif;?>
        </div>
    </section>
</div>