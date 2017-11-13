<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'murad-banner-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>350)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type', $model->getArrayType(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>
    <div class="row">
        <div class="note_red">
            <label>Recommend 1300 x 684 (width x height). Allow <?php echo $model->allowImageType; ?>, max = <?php echo ActiveRecord::convertByte2Mb($model->maxImageFileSize); ?></label>
        </div>
        <?php echo $form->labelEx($model,'file_name'); ?>
        <?php echo $form->fileField($model,'file_name[]', array('accept'=>'image/*')); ?>
        <?php echo $form->error($model,'file_name'); ?>
        <?php if(!empty($model->file_name)): ?>
            File hiện tại 
            <?php echo $model->getImageThumbTemp(); ?>
        <?php endif;?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'link'); ?>
        <?php echo $form->textArea($model,'link',array('rows'=>3, 'cols'=>100)); ?>
        <?php echo $form->error($model,'link'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $model->optionActive,array('style'=>'')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'order_display'); ?>
        <?php echo $form->dropDownList($model,'order_display', MyFormat::BuildNumberOrder(50),array('style'=>'')); ?>
        <?php echo $form->error($model,'order_display'); ?>
    </div>

    <div class="row buttons" style="padding-left: 141px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Create' :'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });
        jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1',innerHeight:'1000', innerWidth: '1050' });
    });
</script>
