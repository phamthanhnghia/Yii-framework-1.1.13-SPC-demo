<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php 
        $readonly = (Yii::app()->user->role_id==1)?false:true;
        ?>
	<div class="row">
		<?php echo $form->labelEx($model,'module'); ?>
		<?php echo $form->dropDownList($model,'module',array("front_end"=>"Front End","member"=>"Member")); ?>
		<?php echo $form->error($model,'module'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('readonly'=>$readonly,'size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('readonly'=>$readonly,'size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_name'); ?>
		<?php echo $form->textField($model,'page_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'page_name'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'sample_link'); ?>
		<?php echo $form->textField($model,'sample_link',array('style'=>'width:700px;','maxlength'=>255)); ?>
		<?php echo $form->error($model,'sample_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('style'=>'width:700px;','maxlength'=>500)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'variable'); ?>
		<?php echo $form->textField($model,'variable',array('style'=>'width:700px;','maxlength'=>255)); ?>
		<?php echo $form->error($model,'variable'); ?>
	</div>

<!--	<div class="row">
		<?php //echo $form->labelEx($model,'default_page_name'); ?>
		<?php //echo $form->textField($model,'default_page_name',array('size'=>120,'maxlength'=>500)); ?>
		<?php //echo $form->error($model,'default_page_name'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'keyword'); ?>
		<?php echo $form->textArea($model,'keyword',array('style'=>'width:700px;','rows'=>4, 'cols'=>89)); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('style'=>'width:700px;','rows'=>4, 'cols'=>89)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->