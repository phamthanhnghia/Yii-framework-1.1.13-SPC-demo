<?php if(!$model->isNewRecord): ?>
<div class="row">
    <?php echo $form->labelEx($model->mUsersRef,'image_sign',array()); ?>
            <?php echo $form->fileField($model->mUsersRef,'image_sign', array('accept'=>'image/*')); ?>
    <?php if(!empty($model->mUsersRef->image_sign)): ?>
    File hiện tại 
    <a class="gallery" href="<?php echo ImageProcessing::bindImageByModel($model->mUsersRef,'','',array('size'=>'size2'));?>">
        <img src="<?php echo ImageProcessing::bindImageByModel($model->mUsersRef,'','',array('size'=>'size1'));?>">
    </a>
    <?php endif;?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->mUsersRef,'reason_leave'); ?>
    <?php echo $form->textArea($model->mUsersRef,'reason_leave',array('rows'=>5,'cols'=>80,"placeholder"=>"")); ?>
    <?php echo $form->error($model->mUsersRef,'reason_leave'); ?>
</div>


<?php endif; ?>