<!--for print-->
<div class="sprint" style=" padding-right: 743px;">
    <a class="button_print" href="javascript:void(0);" title="In Văn Bản">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/print.png">
    </a>
</div>
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.printElement.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".button_print").click(function(){
                $('#printElement').printElement({ overrideElementCSS: ['<?php echo Yii::app()->theme->baseUrl;?>/css/print-store-card.css'] });
        });
    });
</script>

<!--for print-->
<?php if($ClassName == 'GasProfileDetail'):?>
    <?php $mProfile = GasProfile::model()->findByPk($model->profile_id); ?>
    <div id="printElement">
        <img src="<?php echo  ImageProcessing::bindImageByModel($model,'','',array('size'=>'size2'));?>">
    </div>
    <ul class="clr">
        <?php foreach($mProfile->rProfileDetail as $key=>$item):?>
            <?php $link = Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id)); 
                $class='';
                if($item->id==$model->id)
                    $class='hight_light';
            ?>
        <li class="w-100 float_l"><a class="<?php echo $class;?>" href="<?php echo $link;?>">Hình <?php echo $key+1;?></a></li>    
        <?php endforeach;?>
    </ul>
<?php elseif($ClassName == 'GasFileScanDetail'):?>
    <?php include 'ViewImageGasFileScanDetail.php';?>
<?php elseif($ClassName == 'GasSalesFileScanDetai'):?>
    <?php include 'ViewImageGasSaleFileScanDetail.php';?>
<?php elseif($ClassName == 'GasCustomerCheck'):?>
    <?php include 'ViewImageGasCustomerCheck.php';?>
<?php elseif($ClassName == 'GasIssueTicketsDetailFile'):?>
    <?php include 'ViewImageGasIssueTicketsDetailFile.php';?>
<?php elseif($ClassName == 'GasFile'):?>
    <?php include 'ViewImageGasFile.php';?>
<?php endif;?>