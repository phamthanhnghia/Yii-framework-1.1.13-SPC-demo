<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'murad-video-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>
    <?php if(!$model->isNewRecord): ?>
    <div class="row">
        <label>&nbsp;</label><?php echo $model->getUrlVideoDetail(array("url"=>1)); ?>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>350)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id', $model->getDropdownCategory(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'category_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type', $model->getArrayType(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $model->optionActive,array('style'=>'')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'is_feature'); ?>
        <?php echo $form->dropDownList($model,'is_feature', $model->optionYesNo,array('style'=>'')); ?>
        <?php echo $form->error($model,'is_feature'); ?>
    </div>
    
    
    <div class="row">
        <div class="note_red">
            <label><?php echo $model->RecommendSize; ?>. Allow <?php echo $model->allowImageType; ?>, max = <?php echo ActiveRecord::convertByte2Mb($model->maxImageFileSize); ?></label>
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
        <?php echo $form->textArea($model,'link',array('rows'=>10, 'cols'=>100, 'placeholder'=>'May be Iframe')); ?>
        <?php echo $form->error($model,'link'); ?>
    </div>
    
    <div class="row editor_area123 be_editor_full">
        <?php echo $form->labelEx($model,'content'); ?>
            <div style="padding-left:141px;">
                <?php
                $this->widget('ext.niceditor.nicEditorWidget', array(
                        "model" => $model, // Data-Model
                        "attribute" => 'content', // Attribute in the Data-Model        
//                                "defaultValue"=>$model->content,
                        "config" => array(
                            "fullPanel"=>true,
//                                "maxHeight" => "200px",   
//                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
                        ),
                        "width" => "900px", // Optional default to 100%
                        "height" => "500px", // Optional default to 150px
                ));
                ?>
            </div>
        <?php echo $form->error($model,'content'); ?>
    </div>
    <div class='clr'></div>
    
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