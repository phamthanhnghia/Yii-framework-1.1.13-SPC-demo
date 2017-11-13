<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <div class="row">
            <?php echo $form->label($model,'menu_name'); ?>
            <?php echo $form->textField($model,'menu_name',array('size'=>30,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'menu_link'); ?>
        <?php echo $form->textField($model,'menu_link',array('size'=>50,'maxlength'=>255)); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'parent_id'); ?>
        <?php echo Menus::getDropDownList('Menus[parent_id]','Menus_parent_id',$model->parent_id,true); ?>
    </div>

    <div class="row buttons">
            <span class="btn-submit"><?php echo CHtml::submitButton('Search'); ?></span>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->