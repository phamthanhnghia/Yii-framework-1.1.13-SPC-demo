<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=> GasCheck::getCurl(),
	'method'=>'get',
)); ?>
	<div class="row">
		<?php echo $form->label($model,'name',array()); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>350)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'code_real',array()); ?>
		<?php echo $form->textField($model,'code_real',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_id',array()); ?>
		<?php echo $form->dropDownList($model,'category_id', $model->getDropdownCategory(),array('empty'=>'Select')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'type',array()); ?>
		<?php echo $form->dropDownList($model,'type', $model->getArrayType(),array('empty'=>'Select')); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'status',array()); ?>
		<?php echo $form->dropDownList($model,'status', $model->optionActive,array('empty'=>'Select')); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'featured',array()); ?>
		<?php echo $form->dropDownList($model,'featured', $model->optionYesNo,array('empty'=>'Select')); ?>
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