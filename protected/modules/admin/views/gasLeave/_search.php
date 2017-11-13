<?php 
$SubmitButtonClass = '';
$ButtonType = 'submit';
$display_none = 'display_none';
if($is_tab==0){
    $display_none = '';    
    $SubmitButtonClass='SubmitButton btn_cancel';
    $ButtonType = 'button';
}

?>
<div class="wide form  <?php echo $display_none; ?>" style="padding:0;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

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
//                        'maxDate'=> '0',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                        'buttonImageOnly'=> true,                                
                    ),
                    'htmlOptions'=>array(
                        'class'=>'w-16 date_from',
                        'size'=>'16',
                        'class_update_val'=>'date_from',
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
//                        'maxDate'=> '0',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                        'buttonImageOnly'=> true,                                
                    ),
                    'htmlOptions'=>array(
                        'class'=>'w-16 date_to',
                        'size'=>'16',
                        'class_update_val'=>'date_to',
                        'style'=>'float:left;',
                    ),
                ));
            ?>
        </div>
    </div>
    
    
    <div class="row">
        <?php echo $form->labelEx($model,'to_uid_approved'); ?>
        <?php echo $form->dropDownList($model,'to_uid_approved', GasLeave::ListoptionApprove(),array('empty'=>'Select', 'class'=>'w-400 to_uid_approved',"class_update_val"=>'to_uid_approved')); ?>
        <?php echo $form->error($model,'to_uid_approved'); ?>
    </div>
    
    <div class="row">
        <?php // echo $form->textField($model,'uid_login', array('class'=>'uid_auto_hidden uid_login_hidden', 'class_update_val'=>'uid_login_hidden')); ?>
        <?php echo $form->hiddenField($model,'uid_login', array('class'=>'uid_auto_hidden uid_login_hidden', 'class_update_val'=>'uid_login_hidden')); ?>
        <?php if($is_tab==0): ?>
        <?php echo $form->labelEx($model,'uid_login'); ?>
        <?php 
            // widget auto complete search user customer and supplier
            $aData = array(
                'model'=>$model,
                'field_customer_id'=>'uid_login',
                'url'=> Yii::app()->createAbsoluteUrl('admin/ajax/search_user_leave'),
                'name_relation_user'=>'rUidLogin',
                'fnSelectCustomer'=>'fnAfterSelectSaleOrAgent',
            );
            $this->widget('ext.SpaAutocompleteCustomer.SpaAutocompleteCustomer',
                array('data'=>$aData));                                        
        ?>
        <?php endif; ?>
    </div>
    <div class="row">      
        <?php // echo $form->textField($model,'uid_leave', array('class'=>'uid_auto_hidden uid_leave_hidden', 'class_update_val'=>'uid_leave_hidden')); ?>
        <?php echo $form->hiddenField($model,'uid_leave', array('class'=>'uid_auto_hidden uid_leave_hidden', 'class_update_val'=>'uid_leave_hidden')); ?>
        <?php if($is_tab==0): ?>
        <?php echo $form->labelEx($model,'uid_leave'); ?>
        <?php 
            // widget auto complete search user customer and supplier
            $aData = array(
                'model'=>$model,
                'field_customer_id'=>'uid_leave',
                'url'=> Yii::app()->createAbsoluteUrl('admin/ajax/search_user_leave'),
                'name_relation_user'=>'rUidLeave',
                'field_autocomplete_name'=>'autocomplete_name_v1',
                'fnSelectCustomer'=>'fnAfterSelectSaleOrAgent',
            );
            $this->widget('ext.SpaAutocompleteCustomer.SpaAutocompleteCustomer',
                array('data'=>$aData));
        ?>                        
        <?php endif; ?>
    </div>
    
	<div class="row buttons" style="padding-left: 159px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>$ButtonType,
            'label'=>'Search',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            'htmlOptions' => array('class' => $SubmitButtonClass),
        )); ?>	
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->