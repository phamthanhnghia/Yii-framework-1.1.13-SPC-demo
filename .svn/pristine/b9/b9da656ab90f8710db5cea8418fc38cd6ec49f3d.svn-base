<?php $mIssueTicketsDetail = GasIssueTicketsDetail::model()->findByPk($model->issue_tickets_detail_id); ?>
<div id="printElement">
    <img src="<?php echo ImageProcessing::bindImageByModel($model,'','',array('size'=>'size2'));?>">
</div>
<ul class="clr">
    <?php foreach($mIssueTicketsDetail->rFileDetail as $key=>$item):?>
        <?php $link = Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasIssueTicketsDetailFile'));
            $class='';
            if($item->id==$model->id)
                $class='hight_light';
        ?>
    <li class="w-100 float_l"><a class="<?php echo $class;?>" href="<?php echo $link;?>">Hình <?php echo $key+1;?></a></li>    
    <?php endforeach;?>
</ul>