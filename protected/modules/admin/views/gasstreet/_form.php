<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-street-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
        <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>        	
	
	<?php  /*
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'province_id')); ?>
		<?php echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;')); ?>
		<?php echo $form->error($model,'province_id'); ?>
	</div>
		*/?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name_vi'); ?>
	</div>

	<div class="row buttons" style="padding-left: 141px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        });
    });
</script>