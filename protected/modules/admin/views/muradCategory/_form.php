<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/colorpicker/colorpicker.js"></script>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" media="screen" />
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'murad-category-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>
    <br><div class="clr"></div>
    <input type="submit" class="" value="Save">
    <?php include "_form_lang.php"; ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'order_display'); ?>
        <?php echo $form->dropDownList($model,'order_display', MyFormat::BuildNumberOrder(100),array('style'=>'')); ?>
        <?php echo $form->error($model,'order_display'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'category_type'); ?>
        <?php // echo $form->dropDownList($model,'category_type', $model->getArrayCategoryType(),array('empty'=>'Select')); ?>
        <?php echo $form->dropDownList($model,'category_type', $model->getArrayCategoryType(),array()); ?>
        <?php echo $form->error($model,'category_type'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type', $model->getArrayType(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>
    <div class="clr"></div>
    <div class="row">
        <?php echo $form->labelEx($model,'color'); ?>
        <?php echo $form->textField($model,'color',array('class'=>'ColorPicker float_l r_margin_20', 'readonly'=>1)); ?>
        <div class="colorSelector"><div style="background-color: <?php echo $model->getColor();?>"></div></div>
        <?php echo $form->error($model,'color'); ?>
    </div>    
    <div class="clr"></div>
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
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $model->optionActive,array('style'=>'')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'meta_keywords'); ?>
        <?php echo $form->textArea($model,'meta_keywords',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'meta_keywords'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'meta_description'); ?>
        <?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'meta_description'); ?>
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

<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });
        $( "#tabs" ).tabs({ active: 0 });
    });
</script>

<script>
    $(function(){
//         $('.ColorPicker').ColorPicker();
        $('.ColorPicker').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            },
            onChange: function (hsb, hex, rgb) {
                $('.colorSelector div').css('backgroundColor', '#' + hex);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
    });
</script>