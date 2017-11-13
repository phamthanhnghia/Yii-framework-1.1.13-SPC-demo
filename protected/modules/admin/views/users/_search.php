<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <div class="group-1">
        
        <div class="row">
            <?php echo $form->label($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>29,'maxlength'=>250)); ?>
        </div>
		
        <div class="row">
            <?php echo $form->label($model,'nick_name'); ?>
            <?php echo $form->textField($model,'nick_name',array('size'=>29,'maxlength'=>150)); ?>
        </div>
        
        <div class="row">
            <?php echo $form->label($model,'city_id'); ?>
            <?php echo $form->dropDownList($model,'city_id', ActiveRecord::getCity()); ?>
        </div>
    </div>
    
    <div class="group-2">
        <div class="row">
            <?php echo $form->label($model,'dob'); ?>
            <?php //echo $form->textField($model,'dob'); ?>
                    <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'name'=>'ManageModel[dob]',
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd/mm/yy'
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px;'
                            ),
                        ));
                    ?>
        </div>

        <div class="row">
            <?php echo $form->label($model,'height'); ?>
            <?php echo $form->textField($model,'height'); ?>
        </div>

        <div class="row">
            <?php echo $form->label($model,'weight'); ?>
            <?php echo $form->textField($model,'weight'); ?>
        </div>

        <div class="row buttons">
            <span class="btn-submit"><?php echo CHtml::submitButton('Search'); ?></span> 
        </div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->