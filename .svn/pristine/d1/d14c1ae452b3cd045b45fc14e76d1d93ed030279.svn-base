<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-leave-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
        
        <?php  if(Yii::app()->user->hasFlash('successUpdate')): ?>
            <div class='success_div'><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
        <?php endif; ?>  	
        
        <div class="row">
            <div style="width: 80%;float: left;padding-bottom: 5px;padding-left: 140px;">
                <label style="color: red;width: auto; ">Chú ý: nếu bạn không biết chọn người duyệt là ai, vui lòng hỏi cấp quản lý</label>
            </div>
            <div class="clr"></div>
            <?php echo $form->labelEx($model,'to_uid_approved'); ?>
            <?php echo $form->dropDownList($model,'to_uid_approved', GasLeave::ListoptionApprove(),array('empty'=>'Select', 'class'=>'w-400')); ?>
            <?php echo $form->error($model,'to_uid_approved'); ?>
        </div>            
            
            
        <?php if(GasLeave::CanAutocomplete()): ?>
	<div class="row">
            <?php echo $form->labelEx($model,'uid_leave'); ?>
            <?php echo $form->hiddenField($model,'uid_leave', array('class'=>'')); ?>
            <?php
            // .. tất cả các TH dc xử lý trên action ajax roi
            // 1. TH giám sát PTTT search nhân viên trong đội của giám sát đó
            // 2. user đại lý search nhân viên kế toán + nhân viên giao hàng của đại lý đó
            // 3. không search, là những loại user còn lại của hệ thống
            $url = Yii::app()->createAbsoluteUrl('admin/ajax/search_user_leave');
            // widget auto complete search user customer and supplier
            $aData = array(
                'model'=>$model,
                'field_customer_id'=>'uid_leave',
                'url'=> $url,
                'name_relation_user'=>'rUidLeave',
                'show_role_name'=> 1,
                'ClassAdd'=> 'w-400',
            );
            $this->widget('ext.SpaAutocompleteCustomer.SpaAutocompleteCustomer',
                array('data'=>$aData));                                        
            ?>
            <?php echo $form->error($model,'uid_leave'); ?>
	</div>
        <?php endif;?>
            
	<div class="row">
		<?php echo $form->labelEx($model,'leave_date_from'); ?>
		<?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'leave_date_from',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                            'minDate'=> '0',
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                            'buttonImageOnly'=> true,                                
                        ),        
                        'htmlOptions'=>array(
                            'class'=>'w-16',
                            'style'=>'height:20px;',
                                'readonly'=>'readonly',
                        ),
                    ));
                ?>  
		<?php echo $form->error($model,'leave_date_from'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'leave_date_to'); ?>
		<?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'leave_date_to',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                            'minDate'=> '0',
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                            'buttonImageOnly'=> true,                                
                        ),
                        'htmlOptions'=>array(
                            'class'=>'w-16',
                            'style'=>'height:20px;',
                                'readonly'=>'readonly',
                        ),
                    ));
                ?>  
		<?php echo $form->error($model,'leave_date_to'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'leave_content'); ?>
		<?php echo $form->textArea($model,'leave_content',array('rows'=>5,'cols'=>80,"placeholder"=>"")); ?>
		<?php echo $form->error($model,'leave_content'); ?>
	</div>
	<div class="row buttons" style="padding-left: 141px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Create' :'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
        <input class='cancel_iframe' type='button' value='Cancel'>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });
        
    });
</script>
<script>
    $(window).load(function(){ // không dùng dc cho popup
        fnResizeColorbox();
        parent.$('.SubmitButton').trigger('click');
    });
    
    function fnResizeColorbox(){
//        var y = $('body').height()+100;
        var y = $('#main_box').height()+100;
        parent.$.colorbox.resize({innerHeight:y});        
    }
</script>