<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

        <div class="row">
		<?php echo $form->label($model,'uid_login',array()); ?>
		<?php echo $form->textField($model,'uid_login',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_uid_approved',array()); ?>
		<?php echo $form->textField($model,'to_uid_approved',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid_leave',array()); ?>
		<?php echo $form->textField($model,'uid_leave',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leave_date_from',array()); ?>
		<?php echo $form->textField($model,'leave_date_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leave_date_to',array()); ?>
		<?php echo $form->textField($model,'leave_date_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status',array()); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'manage_approved_uid',array()); ?>
		<?php echo $form->textField($model,'manage_approved_uid',array('size'=>11,'maxlength'=>11)); ?>
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