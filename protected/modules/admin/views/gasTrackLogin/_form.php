<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-track-login-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
        
        <?php  if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class='success_div'><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>  	
            	
	<div class="row">
		<?php echo $form->labelEx($model,'uid_login'); ?>
		<?php echo $form->textField($model,'uid_login',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'uid_login'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'ip_address'); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ip_address'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'description'); ?>
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