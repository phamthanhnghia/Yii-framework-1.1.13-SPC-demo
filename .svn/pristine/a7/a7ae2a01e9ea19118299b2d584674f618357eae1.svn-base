<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'code_no',array()); ?>
		<?php echo $form->textField($model,'code_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_id',array()); ?>
		<?php echo $form->textField($model,'agent_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid_login',array()); ?>
		<?php echo $form->textField($model,'uid_login',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title',array()); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'send_to_id',array()); ?>
		<?php echo $form->textField($model,'send_to_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_new_message',array()); ?>
		<?php echo $form->textField($model,'admin_new_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status',array()); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'process_status',array()); ?>
		<?php echo $form->textField($model,'process_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'process_time',array()); ?>
		<?php echo $form->textField($model,'process_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'process_user_id',array()); ?>
		<?php echo $form->textField($model,'process_user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date',array()); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row buttons" style="padding-left: 159px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Search',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->