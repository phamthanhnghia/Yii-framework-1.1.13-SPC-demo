<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-tickets-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
        
        <?php  if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class='success_div'><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>  	
            	
	<div class="row">
		<?php echo $form->labelEx($model,'code_no'); ?>
		<?php echo $form->textField($model,'code_no',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'code_no'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'agent_id'); ?>
		<?php echo $form->textField($model,'agent_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'agent_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'uid_login'); ?>
		<?php echo $form->textField($model,'uid_login',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'uid_login'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'send_to_id'); ?>
		<?php echo $form->textField($model,'send_to_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'send_to_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'admin_new_message'); ?>
		<?php echo $form->textField($model,'admin_new_message'); ?>
		<?php echo $form->error($model,'admin_new_message'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'process_status'); ?>
		<?php echo $form->textField($model,'process_status'); ?>
		<?php echo $form->error($model,'process_status'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'process_time'); ?>
		<?php echo $form->textField($model,'process_time'); ?>
		<?php echo $form->error($model,'process_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'process_user_id'); ?>
		<?php echo $form->textField($model,'process_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'process_user_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>
	<div class="row buttons" style="padding-left: 141px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Create' :'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });
        
    });
</script>