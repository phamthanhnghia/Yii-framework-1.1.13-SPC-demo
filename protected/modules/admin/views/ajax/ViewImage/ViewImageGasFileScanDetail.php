<?php $mFileScan = GasFileScan::model()->findByPk($model->file_scan_id); ?>
<div id="printElement">
    <img src="<?php echo ImageProcessing::bindImageByModel($model,'','',array('size'=>'size1'));?>">
</div>
<ul class="clr">
    <?php foreach($mFileScan->rFileScanDetail as $key=>$item):?>
        <?php $link = Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasFileScanDetail'));
            $class='';
            if($item->id==$model->id)
                $class='hight_light';
        ?>
    <li class="w-100 float_l"><a class="<?php echo $class;?>" href="<?php echo $link;?>">Hình <?php echo $key+1;?></a></li>    
    <?php endforeach;?>
</ul>