<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name',array()); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row more_col">
                <div class="col1">
                        <?php echo Yii::t('translation', $form->label($model,'date_from')); ?>
                        <?php 
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'=>$model,        
                                'attribute'=>'date_from',
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=> MyFormat::$dateFormatSearch,
        //                            'minDate'=> '0',
//                                    'maxDate'=> '0',
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'showOn' => 'button',
                                    'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                                    'buttonImageOnly'=> true,                                
                                ),        
                                'htmlOptions'=>array(
                                    'class'=>'w-16',
                                    'size'=>'16',
                                    'style'=>'float:left;',                               
                                ),
                            ));
                        ?>     		
                </div>
                <div class="col2">
                        <?php echo Yii::t('translation', $form->label($model,'date_to')); ?>
                        <?php 
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'=>$model,        
                                'attribute'=>'date_to',
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=> MyFormat::$dateFormatSearch,
        //                            'minDate'=> '0',
                                    'maxDate'=> '0',
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'showOn' => 'button',
                                    'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                                    'buttonImageOnly'=> true,                                
                                ),        
                                'htmlOptions'=>array(
                                    'class'=>'w-16',
                                    'size'=>'16',
                                    'style'=>'float:left;',
                                ),
                            ));
                        ?>     		
                </div>
            </div>  

	<div class="row buttons" style="padding-left: 159px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Search',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->