<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _search.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cms_content'); ?>
		<?php echo $form->textField($model,'cms_content',array('size'=>60,'maxlength'=>250)); ?>
	</div>

        
	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
       <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(

                'name'=>'Cms[created_date]',
                'model'=>$model,
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                'dateFormat'=>ActiveRecord::getDateFormatJquery(),
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;',
                	'readonly'=>'readonly',
                ),
            ));
        ?>		
	</div>
	
	
<?php /*
	<div class="row">
		<?php echo $form->label($model,'display_order'); ?>
		<?php echo $form->textField($model,'display_order'); ?>
	</div>
*/ ?>
	<div class="row">
		<?php echo $form->label($model,'show_in_menu'); ?>
		<?php echo $form->dropDownList($model,'show_in_menu',array(''=>'','0'=>'No','1'=>'Yes')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', ActiveRecord::getUserStatus(true)); ?>
	</div>

	
<?php /*
	<div class="row">
		<?php echo $form->label($model,'meta_keywords'); ?>
		<?php echo $form->textField($model,'meta_keywords',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meta_desc'); ?>
		<?php echo $form->textField($model,'meta_desc',array('size'=>60,'maxlength'=>250)); ?>
	</div>
*/ ?>
	<div class="row buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton('Search'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->