<h1><?php echo Yii::t('translation', 'Tạo Mới Đường'); ?></h1>

<div class="form">

<?php
//MyFunctionCustom::updateAllModel('GasDistrict');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-district-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
        <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>        	

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>36,'maxlength'=>200)); ?>
		<!--<p style="margin: 0;padding:0; padding-left: 138px;">
		Quy Ước Nhập: Chu Văn An <font style="color:red;">không nhập </font> Đường Chu Văn An	
					</p>-->
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
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>  
<script>
    $(document).ready(function(){
        parent.fnUpdateColorbox();   
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        });
    });
</script>