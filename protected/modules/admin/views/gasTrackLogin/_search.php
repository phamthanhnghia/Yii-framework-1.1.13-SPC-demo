<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
            <?php echo $form->labelEx($model,'uid_login'); ?>            
            <?php echo $form->hiddenField($model,'uid_login'); ?>
            <?php
                // widget auto complete search user customer and supplier
                $aData = array(
                    'model'=>$model,
                    'field_autocomplete_name'=>'autocomplete_name',
                    'field_customer_id'=>'uid_login',
                    'name_relation_user'=>'rUidLogin',
                    'placeholder'=>'Nhập Tên User',
                    'url' => Yii::app()->createAbsoluteUrl('admin/ajax/search_user_login'),
                );
                $this->widget('ext.SpaAutocompleteCustomer.SpaAutocompleteCustomer',
                    array('data'=>$aData));                                        
            ?>
        </div>

	<div class="row">
            <?php echo $form->label($model,'admin_login'); ?>
            <?php echo $form->dropDownList($model,'admin_login', CmsFormatter::$yesNoFormat,array('empty'=>'Select' ,'style'=>'')); ?>
	</div>	
	<div class="row">
            <?php echo $form->label($model,'role_name'); ?>
            <?php echo $form->dropDownList($model,'role_name',Roles::loadItems(),array('empty'=>'Select' ,'style'=>'')); ?>
            <?php echo $form->error($model,'role_name'); ?>
	</div>	
    
        <div class="row">
            <?php echo $form->label($model,'type',array()); ?>
            <?php echo $form->dropDownList($model,'type', GasTrackLogin::$TYPE_TRACK,array('class'=>'','empty'=>'Select')); ?>
	</div>    
	<div class="row">
		<?php echo $form->label($model,'ip_address',array()); ?>
		<?php echo $form->textField($model,'ip_address',array('size'=>60,'maxlength'=>50)); ?>
	</div>

	<div class="row">
            <?php echo $form->label($model,'country',array()); ?>
            <?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	

	<div class="row">
            <?php echo $form->label($model,'description',array()); ?>
            <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>200)); ?>
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
    
	<div class="row">
		<?php echo Yii::t('translation', $form->label($model,'created_date')); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'created_date',
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
                            'style'=>'height:20px;',
                        ),
                    ));
                ?> 
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