<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _form.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="form editor_area_size ">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-templates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email_subject'); ?>
		<?php echo $form->textField($model,'email_subject',array('class'=>'w-500','maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parameter_description'); ?>
		<?php echo $form->textArea($model,'parameter_description',array('class'=>'w-500','rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'parameter_description'); ?>
	</div>
        
        <div class="row editor_area123 be_editor_full">
            <?php echo Yii::t('translation', $form->labelEx($model,'email_body')); ?>
                <div style="padding-left:141px;">
                        <?php
                        $this->widget('ext.niceditor.nicEditorWidget', array(
                                "model" => $model, // Data-Model
                                "attribute" => 'email_body', // Attribute in the Data-Model        
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
            <?php echo $form->error($model,'email_body'); ?>
	</div>
	<div class='clr'></div>

        <div class="row" style="display: none;">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
    .nicEdit-pane, .nicEdit-pane textarea { width: 900px !important;}
    
    </style>