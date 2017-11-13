<h1>Cập nhật cân lại gas lần <?php echo $_GET['type']; ?></h1>

<div class="form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-district-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Đại lý cân lần 1: <?php echo $model->agent?$model->agent->first_name:'';?>. Seri bình: <?php echo $model->seri;?></p>
        <!--<p class="note_focus">Chỉ cập nhật khi số Kg gas dư bị lệch so với lần cân đầu tiên</p>-->
        <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>        	
	
        <div class="row display_none">
            <?php echo $form->labelEx($model,'amount_empty'); ?>
            <?php echo $form->hiddenField($model,'amount_empty',array('class'=>'amount_empty','size'=>10,'maxlength'=>6)); ?>  Kg
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'amount_empty'); ?>
            <?php echo $model->amount_empty; ?>  Kg
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'amount_gas_vo_binh', array('label'=>$model->getAttributeLabel('amount_gas_vo_binh')." Lần ".$_GET['type'])); ?>
            <?php echo $form->textField($model,'amount_gas_vo_binh',array('class'=>'amount_gas_vo_binh number_only_v1','size'=>10,'maxlength'=>6)); ?>  Kg
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'amount_gas_'.$_GET['type'], array('label'=>"Gas Dư Cân Lần ".$_GET['type'])); ?>
            <?php echo $form->textField($model,'amount_gas_'.$_GET['type'],array('class'=>'amount_gas_final number_only_v1','size'=>10,'maxlength'=>6, 'readonly'=>1)); ?>  Kg
            <?php echo $form->error($model,'amount_gas_'.$_GET['type']); ?>
        </div>

	<div class="row buttons" style="padding-left: 289px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
            <button name="yt123" type="button" id="yw0" class="btn btn-small btn_cancel">Cancel</button>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
    div.form .row label { width: 289px; }
</style>


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>  
<script>
    $(document).ready(function(){	
        parent.fnUpdateColorbox();   
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        });
        
        $('.amount_gas_vo_binh').change(function(){
            var amount_gas_vo_binh = $(this).val();
            var amount_empty = $('.amount_empty').val();
            var  amount = parseFloat(amount_gas_vo_binh-amount_empty);
            amount = Math.round(amount * 100) / 100;
            $('.amount_gas_final').val(amount);            
        });
        
        $('.btn_cancel').click(function(){
            parent.$.fn.colorbox.close();
        });
        
//        parent.$.fn.yiiGridView.update("gas-remain-grid");
    });
</script>