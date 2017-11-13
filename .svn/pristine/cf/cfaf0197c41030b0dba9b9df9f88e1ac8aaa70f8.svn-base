<?php 
//    $mWeeks = GasWeekSetup::GetWeekNumber($model->year, $model->month);
    $tabActive = 0;
?>
<div id="tabs" class="BindChangeSearchCondition">
    <ul>
        <li>
            <a class="" href="#tabs-1">Đơn chờ duyệt</a>
        </li>
        <li>
            <a class="" href="#tabs-2">Đơn đã duyệt cho nghỉ phép</a>
        </li>
        <li>
            <a class="" href="#tabs-3">Đơn không cho phép nghỉ</a>
        </li>
    </ul>
    
    <div id="tabs-1">
        <?php include 'index_tab_1.php';?>
    </div>
    <div id="tabs-2">
        <?php include 'index_tab_2.php';?>
    </div>
    <div id="tabs-3">
        <?php include 'index_tab_3.php';?>
    </div>
    
</div>    


<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<script>
$(function() {
    $( "#tabs" ).tabs({ active: <?php echo $tabActive;?> });
});
</script>