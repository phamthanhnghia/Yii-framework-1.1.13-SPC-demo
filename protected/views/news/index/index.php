<?php
$titleCat = 'Blog';
$session = Yii::app()->session;
if(isset($session["ModelCategory"])){
    $titleCat = $session["ModelCategory"]->getName();
}
?>

<section class="bannerlider"></section>
<section class="mainchild ">
    <div class="container contentchild">
        <ol class="breadcrumb">
            <li><a href="<?php echo MyFormat::getUrlHomeFe(); ?>">Home</a></li>
            <li class="active"><?php echo $titleCat;?></li>
        </ol>
        <div class="col2two clearfix">
                <div class="col-left"> 
<!--                 <div class="home_title">
                    <span>Blog</span>
                </div>-->
            <div class="page-title"><h2><?php echo $titleCat;?></h2></div>
                <?php include "index_grid.php"; ?>
            </div>
            <?php $this->widget('NewsBoxRight', array()); ?>
        </div>

       </div>

</section>
