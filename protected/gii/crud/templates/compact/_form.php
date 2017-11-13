<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>\n"; ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo "<?php echo MyFormat::BindNotifyMsg(); ?>\n"; ?>    
        <?php /*echo "
        <?php  if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class='success_div'><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>  	
            "; */?>
	<?php /*echo "<?php echo \$form->errorSummary(\$model); ?>\n"; */ ?>	
        <?php // echo MyFormat::BindNotifyMsg(); ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
    <div class="row">
        <?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
        <?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
        <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
    </div>
<?php
}
?>
	<div class="row buttons" style="padding-left: 141px;">
		<?php //echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save')); ?>
        <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>\$model->isNewRecord ? 'Create' :'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        });
        
    });
</script>