<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'role_id'); ?>
		<?php echo $form->dropDownList($model,'role_id',Roles::loadItems(),array('style'=>'width:355px','empty'=>'Select')); ?>
	</div>	

	<div class="row">
            <?php echo $form->label($model,'first_name',array('label'=>'Tên NV',)); ?>
            <?php echo $form->textField($model,'first_name',array('maxlength'=>90,'style'=>'float:left;width:352px;','placeholder'=>'nhập tiếng việt không dấu')); ?>
	</div>
	<div class="row">
            <?php echo $form->label($model,'username',array()); ?>
            <?php echo $form->textField($model,'username',array('maxlength'=>90,'style'=>'float:left;width:352px;')); ?>
	</div>
    
	<div class="row">
            <?php echo $form->label($model,'parent_id', array('label'=>'Thuộc Đại Lý')); ?>
            <?php echo $form->dropDownList($model,'parent_id', Users::getArrUserByRole(ROLE_AGENT),array('style'=>'width:355px', 'empty'=>'Select')); ?>
	</div>	    
    
	<div class="row">
		<?php echo $form->label($model,'code_account',array()); ?>
		<?php echo $form->textField($model,'code_account',array('maxlength'=>90,'style'=>'float:left;width:352px;')); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'code_bussiness',array()); ?>
		<?php echo $form->textField($model,'code_bussiness',array('maxlength'=>90,'style'=>'float:left;width:352px;')); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'address',array()); ?>
		<?php echo $form->textField($model,'address',array('size'=>55,'maxlength'=>500,'style'=>'width:352px;','placeholder'=>'nhập tiếng việt không dấu')); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'phone',array()); ?>
		<?php echo $form->textField($model,'phone',array('size'=>55,'maxlength'=>500,'style'=>'width:352px;')); ?>
	</div>
    
	<div class="row">
            <?php echo Yii::t('translation', $form->label($model,'status')); ?>
            <?php echo $form->dropDownList($model,'status', ActiveRecord::getUserStatus(), array('empty'=>'Select')); ?>
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