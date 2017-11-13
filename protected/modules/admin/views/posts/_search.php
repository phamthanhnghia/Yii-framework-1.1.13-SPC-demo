<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	

	<div class="row">
		<?php echo Yii::t('translation',$form->label($model,'title')) ; ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>63)); ?>
	</div>	

	<div class="row">
		<?php echo Yii::t('translation',$form->label($model,'content')) ; ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation',$form->label($model,'status')) ; ?>
		<?php echo $form->dropDownList($model,'status',array(''=>'Select status',1=>'Active',0=>'Inactive' ));?>
	</div>
    
    <div class="row">
		<label for="Categories_layout_id">Category</label>
        <?php echo Categories::getDropDownList('Posts[category]','Menus_parent_id',null,true); ?>
	</div>

	<div class="row"> 
		<?php echo Yii::t('translation',$form->label($model,'layout_id')) ; ?>
		<?php echo $form->textField($model,'layout_id'); ?>
 	</div> 

 
 <!--  
	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'meta_keywords'); ?>
		<?php echo $form->textField($model,'meta_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meta_desc'); ?>
		<?php echo $form->textField($model,'meta_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'featured_image'); ?>
		<?php echo $form->textField($model,'featured_image',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
	</div>

	

    <div class="row">
        <?php echo $form->labelEx($model,'created'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'created', //attribute name
            'mode'=>'datetime', //use "time","date" or "datetime" (default)
            'options'=>array(
                'showAnim'=>'fold',
                'showButtonPanel'=>true,
                'autoSize'=>true,
                'dateFormat'=>'dd/mm/yy',
                'timeFormat'=>'hh:mm:ss',
                'width'=>'120',
                'separator'=>' ',
            ),
            'htmlOptions' => array(
                'style' => 'width:180px;',
            ),
        ));
        ?>
        <?php echo $form->error($model,'created'); ?>
    </div>	
	
    <div class="row">
        <?php echo $form->labelEx($model,'modified'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'modified', //attribute name
            'mode'=>'datetime', //use "time","date" or "datetime" (default)
            'options'=>array(
                'showAnim'=>'fold',
                'showButtonPanel'=>true,
                'autoSize'=>true,
                'dateFormat'=>'dd/mm/yy',
                'timeFormat'=>'hh:mm:ss',
                'width'=>'120',
                'separator'=>' ',
            ),
            'htmlOptions' => array(
                'style' => 'width:180px;',
            ),
        ));
        ?>
        <?php echo $form->error($model,'modified'); ?>
    </div>	
 -->	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton( Yii::t('translation','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->