<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-ward-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
        <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'province_id')); ?>
		<?php echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:387px','empty'=>'Select')); ?>
		<?php echo $form->error($model,'province_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'district_id')); ?>
		<?php echo $form->dropDownList($model,'district_id', GasDistrict::getArrAll($model->province_id),array('style'=>'width:387px',)); ?>
		<?php echo $form->error($model,'district_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
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
$(document).ready(function() {
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        });
        
    $('#GasWard_province_id').change(function(){
        var province_id = $(this).val();        
        var url_ = "<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/get_slt_district');?>";
        $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        $.ajax({
            url: url_,
            data: {ajax:1,province_id:province_id},
            type: "get",
            dataType:'json',
            success: function(data){
                $('#GasWard_district_id').html(data['html_district']);                
                $.unblockUI();
            }
        });
        
    });    
});

</script>
