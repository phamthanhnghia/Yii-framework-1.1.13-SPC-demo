<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'province_id',array()); ?>
		<?php echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;','empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'district_id',array()); ?>
		<?php echo $form->dropDownList($model,'district_id', GasDistrict::getArrAll($model->province_id),array('style'=>'width:387px','empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name',array()); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_vi',array('label'=>'Tên Tiếng Việt Không Dấu')); ?>
		<?php echo $form->textField($model,'name_vi',array('size'=>60,'maxlength'=>200)); ?>
	</div>


	<div class="row buttons" style="padding-left: 159px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>Yii::t('translation','Search'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->


<script>
$(document).ready(function() {
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