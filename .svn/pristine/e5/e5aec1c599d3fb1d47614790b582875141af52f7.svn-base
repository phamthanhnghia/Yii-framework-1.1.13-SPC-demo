<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-lookup-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type', $model->getArrayType(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'display_order'); ?>
        <?php echo $form->dropDownList($model,'display_order', MyFormat::BuildNumberOrder(50),array('style'=>'')); ?>
        <?php echo $form->error($model,'display_order'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $model->optionActive,array('style'=>'')); ?>
        <?php echo $form->error($model,'status'); ?>
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
        
    });
</script>