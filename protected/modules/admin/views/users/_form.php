<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-model-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>38,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_hash'); ?>
		<?php echo $form->passwordField($model,'password_hash',array('size'=>38,'maxlength'=>250)); ?>
        <?php echo $form->hiddenField($model,'temp_password',array('size'=>38,'maxlength'=>250)); ?>
        <?php echo $form->hiddenField($model,'created_date', array('value'=>date("d/m/y"))); ?>
        <?php echo $form->hiddenField($model,'last_logged_in'); ?>
        <?php echo $form->hiddenField($model,'login_attemp'); ?>
        <?php echo $form->hiddenField($model,'ip_address',array('size'=>20,'maxlength'=>30)); ?>
        <?php echo $form->hiddenField($model,'application_id',array('value'=>'1')); ?>
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nick_name'); ?>
		<?php echo $form->textField($model,'nick_name',array('size'=>38,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'nick_name'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>38,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
        <?php echo $form->dropDownList($model,'city_id', ActiveRecord::getCity()); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'name'=>'ManageModel[dob]',
				'value' => $model->dob,
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy/mm/dd'
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;'
                ),
            ));
        ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bust'); ?>
		<?php echo $form->textField($model,'bust'); ?>
		<?php echo $form->error($model,'bust'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'waist'); ?>
		<?php echo $form->textField($model,'waist'); ?>
		<?php echo $form->error($model,'waist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hips'); ?>
		<?php echo $form->textField($model,'hips'); ?>
		<?php echo $form->error($model,'hips'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dress_size'); ?>
		<?php echo $form->textField($model,'dress_size',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dress_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shoes_size'); ?>
		<?php echo $form->textField($model,'shoes_size',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'shoes_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bust_cup_size'); ?>
		<?php echo $form->textField($model,'bust_cup_size',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bust_cup_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_out_side'); ?>
		<?php echo $form->dropDownList($model,'work_out_side', array('1' =>	'Active','0'	=>	'Inactive')); ?>
		<?php echo $form->error($model,'work_out_side'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		 <span class="btn-active"><?php echo $form->dropDownList($model,'status', ActiveRecord::getUserStatus()); ?></span>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
        <span class="btn-submit"> <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->