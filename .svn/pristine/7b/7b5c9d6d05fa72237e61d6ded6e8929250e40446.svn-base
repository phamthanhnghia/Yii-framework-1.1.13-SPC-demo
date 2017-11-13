<div class="row">
    <div class="note_red">
        <label>Upload image có trong bài viết</label>
    </div>
    <?php echo $form->labelEx($model,'uploadMulti'); ?>
    <?php // echo $form->fileField($model,'uploadMulti[]', array('accept'=>'image/*', "multiple"=>1)); ?>
    <?php
      $this->widget('CMultiFileUpload', array(
         'model'=>$model,
         'attribute'=>'uploadMulti',
         'accept'=>'jpg|jpeg|gif|png',
         'options'=>array(
            // 'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
            // 'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
            // 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
            // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
            // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
            // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
         ),
         'denied'=>'File is not allowed',
         'max'=>50, // max 10 files
      ));
    ?>
    
</div>
<div class='clr l_padding_20'></div>
<div class="row">
    <div class="">
        <label>Preview Image</label>
    </div>
    <div class="float_l">
        <?php echo $model->getListFileMulti(); ?>
    </div>
</div>
<div class='clr'></div>
