<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'murad-product-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>
    <?php if(!$model->isNewRecord): ?>
    <div class="row">
        <label>&nbsp;</label><?php echo $model->getName(true); ?>
    </div>
    <div class="clr"></div>
    <?php endif; ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>350)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'name_vi_show'); ?>
        <?php echo $form->textField($model,'name_vi_show',array('size'=>60,'maxlength'=>350)); ?>
        <?php echo $form->error($model,'name_vi_show'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'featured'); ?>
        <?php echo $form->checkBox($model,'featured',array('class'=>'')); ?>
        <?php echo $form->error($model,'featured'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'code_real'); ?>
        <?php echo $form->textField($model,'code_real',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'code_real'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id', $model->getDropdownCategory(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'category_id'); ?>
    </div>
    
    <div class="row">
        <div class="note_red">
            <label>Mỗi sản phẩm có thể thuộc 2 category riêng biệt</label>
        </div>
        <?php echo $form->labelEx($model,'category_id_2'); ?>
        <?php echo $form->dropDownList($model,'category_id_2', $model->getDropdownCategory(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'category_id_2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <div class="fix-label">
        <?php
           $this->widget('ext.multiselect.JMultiSelect',array(
                 'model'=>$model,
                 'attribute'=>'type',
                 'data' => $model->getArrayType(),
                 // additional javascript options for the MultiSelect plugin
                 'options'=>array(),
                 // additional style
//                 'htmlOptions'=>array('style' => 'width: 350px;'),
           ));    
       ?>
        </div>
        <?php echo $form->error($model,'type'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'price_retail'); ?>
        <?php echo $form->textField($model,'price_retail',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'price_retail'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'price_discount'); ?>
        <?php echo $form->textField($model,'price_discount',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'price_discount'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'unit'); ?>
        <?php echo $form->textField($model,'unit',array('size'=>50,'placeholder'=>"đơn vị:chai, lọ, cái")); ?>
        <?php echo $form->error($model,'unit'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'unit_use'); ?>
        <?php echo $form->textField($model,'unit_use',array('size'=>50,'placeholder'=>"đơn vị sử dụng: l, ml, gram...")); ?>
        <?php echo $form->error($model,'unit_use'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'size'); ?>
        <?php echo $form->textField($model,'size',array('size'=>50,'placeholder'=>"1 chai bao nhiêu ml:vd 200ml")); ?>
        <?php echo $form->error($model,'size'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'display_order'); ?>
        <?php echo $form->dropDownList($model,'display_order', MyFormat::BuildNumberOrder(100) ,array()); ?>
        <?php echo $form->error($model,'display_order'); ?>
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
        <?php echo $form->labelEx($model->mInfo,'url_video'); ?>
        <?php echo $form->textArea($model->mInfo,'url_video',array('rows'=>6, 'cols'=>100)); ?>
        <?php echo $form->error($model->mInfo,'url_video'); ?>
    </div>
    <div class="">
    <?php include 'upload_multi_file.php';?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model->mInfo,'short_description'); ?>
        <?php echo $form->textArea($model->mInfo,'short_description',array('rows'=>3, 'cols'=>120)); ?>
        <?php echo $form->error($model->mInfo,'short_description'); ?>
    </div>
    
    <div class="row editor_area123 be_editor_full">
        <?php echo $form->labelEx($model->mInfo,'description'); ?>
            <div style="padding-left:141px;">
                    <?php
                    $this->widget('ext.niceditor.nicEditorWidget', array(
                            "model" => $model->mInfo, // Data-Model
                            "attribute" => 'description', // Attribute in the Data-Model
                            "config" => array(
                                "fullPanel"=>true,
//                                "maxHeight" => "200px",   
//                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
                            ),
                            "width" => "900px", // Optional default to 100%
                            "height" => "150px", // Optional default to 150px
                    ));
                    ?>
            </div>
        <?php echo $form->error($model->mInfo,'description'); ?>
    </div>
    <div class='clr'></div>
    <div class="row editor_area123 be_editor_full">
        <?php echo $form->labelEx($model->mInfo,'info'); ?>
            <div style="padding-left:141px;">
                    <?php
                    $this->widget('ext.niceditor.nicEditorWidget', array(
                            "model" => $model->mInfo, // Data-Model
                            "attribute" => 'info', // Attribute in the Data-Model
                            "config" => array(
                                "fullPanel"=>true,
//                                "maxHeight" => "200px",   
//                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
                            ),
                            "width" => "900px", // Optional default to 100%
                            "height" => "300px", // Optional default to 150px
                    ));
                    ?>
            </div>
        <?php echo $form->error($model->mInfo,'info'); ?>
    </div>
    <div class='clr'></div>
    <div class="row editor_area123 be_editor_full">
        <?php echo $form->labelEx($model->mInfo,'how_to_use'); ?>
            <div style="padding-left:141px;">
                    <?php
                    $this->widget('ext.niceditor.nicEditorWidget', array(
                            "model" => $model->mInfo, // Data-Model
                            "attribute" => 'how_to_use', // Attribute in the Data-Model
                            "config" => array(
                                "fullPanel"=>true,
//                                "maxHeight" => "200px",   
//                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
                            ),
                            "width" => "900px", // Optional default to 100%
                            "height" => "300px", // Optional default to 150px
                    ));
                    ?>
            </div>
        <?php echo $form->error($model->mInfo,'how_to_use'); ?>
    </div>
    <div class='clr'></div>
    
    <div class="row editor_area123 be_editor_full">
        <?php echo $form->labelEx($model->mInfo,'component'); ?>
            <div style="padding-left:141px;">
                    <?php
                    $this->widget('ext.niceditor.nicEditorWidget', array(
                            "model" => $model->mInfo, // Data-Model
                            "attribute" => 'component', // Attribute in the Data-Model
                            "config" => array(
                                "fullPanel"=>true,
//                                "maxHeight" => "200px",   
//                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
                            ),
                            "width" => "900px", // Optional default to 100%
                            "height" => "300px", // Optional default to 150px
                    ));
                    ?>
            </div>
        <?php echo $form->error($model->mInfo,'component'); ?>
    </div>
    
    
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $model->optionActive,array('style'=>'')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    
    
    
    <div class="row buttons" style="">
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
