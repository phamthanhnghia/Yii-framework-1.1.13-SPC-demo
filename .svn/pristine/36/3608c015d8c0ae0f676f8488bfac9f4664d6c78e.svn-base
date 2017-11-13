<?php 
    $ClassName = GasFile::$TYPE_MODEL[$model->type];
    $mVirtual = call_user_func(array($ClassName, 'model'));
    $mBelongto = $mVirtual->findByPk($model->belong_id); ?>
<div id="printElement">
    <img src="<?php echo ImageProcessing::bindImageByModel($model,'','',array('size'=>'size2'));?>">
</div>
<ul class="clr">
    <?php foreach($mBelongto->rFile as $key=>$item):?>
        <?php $link = Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasFile'));
            $class='';
            if($item->id==$model->id)
                $class='hight_light';
        ?>
    <li class="w-100 float_l"><a class="<?php echo $class;?>" href="<?php echo $link;?>">Hình <?php echo $key+1;?></a></li>    
    <?php endforeach;?>
</ul>