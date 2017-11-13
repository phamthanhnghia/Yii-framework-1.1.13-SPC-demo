<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=> GasCheck::getCurl(),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'type',array()); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name',array()); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>350)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description',array()); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'file_name',array()); ?>
		<?php echo $form->textField($model,'file_name',array('size'=>60,'maxlength'=>350)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'link',array()); ?>
		<?php echo $form->textArea($model,'link',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status',array()); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_display',array()); ?>
		<?php echo $form->textField($model,'order_display'); ?>
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