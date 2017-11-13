<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>    
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
    
	<div class="row">
		<?php echo  $form->labelEx($model,'gender', array('label'=>'Loại')); ?>
		<?php echo $form->dropDownList($model,'gender', Users::$aTypeAgent,array('style'=>'')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>        
    
        <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('style'=>'width:500px','maxlength'=>250)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>		
    
        <div class="row">
                <?php if (!$model->isNewRecord):?>
                    <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 140px;">
                        <label style="color: red;width: auto; ">Bỏ trống bên dưới nếu bạn không muốn đổi mật khẩu hiện tại</label>
                    </div>
                <?php endif?>
		<?php echo $form->labelEx($model,'password_hash'); ?>
		<?php echo $form->passwordField($model,'password_hash',array('style'=>'width:500px','maxlength'=>50,'value'=>'')); ?>
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('style'=>'width:500px','maxlength'=>50,'value'=>'')); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>        
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'code_account',array('label'=>'Mã Đại Lý'))); ?>
		<?php echo $form->textField($model,'code_account',array('style'=>'width:500px','maxlength'=>20)); ?>
		<?php echo $form->error($model,'code_account'); ?>
	</div>	
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'first_name',array('label'=>'Tên Đại Lý'))); ?>
		<?php echo $form->textField($model,'first_name',array('style'=>'width:500px','maxlength'=>150)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'payment_day',array('label'=>'Ngày Cập Nhật Sổ Quỹ'))); ?>
		<?php echo $form->textField($model,'payment_day',array('style'=>'width:113px','maxlength'=>150,'class'=>'number_only')); ?>
		<?php echo $form->error($model,'payment_day'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'address')); ?>
		<?php echo $form->textArea($model,'address',array('readonly'=>1 ,'style'=>'width:500px')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'beginning')); ?>
                <div class="fix_number_help">
		<?php echo $form->textField($model,'beginning',array('size'=>30,'maxlength'=>12,'class'=>'number_only')); ?>
                <div class="help_number"></div>
                </div>
		<?php echo $form->error($model,'beginning'); ?>
	</div>
	<div class="clr"></div>
    
    
        <?php if(!$model->isNewRecord):?>
	<div class="row" style="padding-left: 141px;">
		<a class='update_agent' href='<?php echo Yii::app()->createAbsoluteUrl("admin/site/update_agent_employee_maintain",array("agent_id"=>$model->id) );?>'>
			Cập Nhật Nhân Viên Bảo Trì
		</a><br/>
		<fieldset class='info_fieldset'>
			<legend>Danh Sách Nhân Viên Bảo Trì - NV Phục Vụ Khách Hàng</legend>
			<?php $listMany = GasOneMany::getArrModelOfManyId($model->id, ONE_AGENT_MAINTAIN);?>
			<div class='for_update_maintain fix_inner_filedset'>
				<ul>
				<?php if(count($listMany)>0) foreach ($listMany as $key=>$item): ?>
					<li><?php echo ($key+1).'.  '.($item->many?$item->many->code_bussiness.' - '.$item->many->first_name:'');?></li>
				<?php endforeach;?>
				</ul>
			</div>
		 </fieldset>
	</div>

	<div class="row" style="padding-left: 141px;">
		<a class='update_agent' href='<?php echo Yii::app()->createAbsoluteUrl("admin/site/update_agent_employee_accounting",array("agent_id"=>$model->id) );?>'>
			Cập Nhật Nhân Viên Kế Toán
		</a>
		<fieldset class='info_fieldset'>
			<legend>Danh Sách Nhân Viên Kế Toán</legend>
			<?php $listMany = GasOneMany::getArrModelOfManyId($model->id, ONE_AGENT_ACCOUNTING);?>
			<div class='for_update_accounting fix_inner_filedset'>
				<ul>
				<?php if(count($listMany)>0) foreach ($listMany as $key=>$item): ?>
					<li><?php echo ($key+1).'.  '.($item->many?$item->many->code_bussiness.' - '.$item->many->first_name:'');?></li>
				<?php endforeach;?>
				</ul>
			</div>			
		 </fieldset>		
	</div>    
        <?php endif;?>
    
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'province_id')); ?>
		<?php echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:500px','empty'=>'Select')); ?>
		<?php echo $form->error($model,'province_id'); ?>
	</div>    
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'district_id')); ?>
		<?php echo $form->dropDownList($model,'district_id', GasDistrict::getArrAll($model->province_id),array('style'=>'width:500px','empty'=>'Select')); ?>
		<?php echo $form->error($model,'district_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'ward_id')); ?>
		<?php echo $form->dropDownList($model,'ward_id', GasWard::getArrAll($model->province_id, $model->district_id),array('style'=>'width:500px','empty'=>'Select')); ?>                
		<?php echo $form->error($model,'ward_id'); ?>
	</div>	

	<div class="row">
                <?php echo $form->labelEx($model,'house_numbers') ?>
                <?php echo $form->textField($model,'house_numbers',array('style'=>'width:500px','maxlength'=>100)); ?>
                <?php echo $form->error($model,'house_numbers'); ?>
	</div> 	        
        
        <div class="row">
            <?php echo $form->labelEx($model,'street_id') ?>
            <?php echo $form->hiddenField($model,'street_id',array('style'=>'width:369px','maxlength'=>100)); ?>
            <?php 
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'attribute'=>'autocomplete_name_street',
                        'model'=>$model,
                        'sourceUrl'=>Yii::app()->createAbsoluteUrl('admin/ajax/autocomplete_data_streets'),
                        'options'=>array(
                                'minLength'=>MIN_LENGTH_AUTOCOMPLETE,
                                'multiple'=> true,
                                'search'=>"js:function( event, ui ) {
                                        $('#Users_autocomplete_name_street').addClass('grid-view-loading-gas');
                                        } ",
                                'response'=>"js:function( event, ui ) {
										var json = $.map(ui, function (value, key) { return value; });
										if(json.length<1){
											var error = '<div class=\'errorMessage clr autocomplete_name_text\'>Không tìm thấy dữ liệu.</div>';
											if($('.autocomplete_name_text').size()<1)
												$('.autocomplete_name_error').parent('div').find('.add_new_item').after(error);
											else
												$('.autocomplete_name_error').parent('div').find('.autocomplete_name_text').show();
											$('.remove_row_item').hide();
										}
								
                                        $('#Users_autocomplete_name_street').removeClass('grid-view-loading-gas');
                                        } ",
                                'select'=>"js:function(event, ui) {
                                        $('#Users_street_id').val(ui.item.id);
                                        var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveName(this)\'></span>';
                                        $('#Users_autocomplete_name_street').parent('div').find('.remove_row_item').remove();
                                        $('#Users_autocomplete_name_street').attr('readonly',true).after(remove_div);
										$('.autocomplete_name_error').parent('div').find('.autocomplete_name_text').hide();
                                }",
                        ),
                        'htmlOptions'=>array(
							'class'=>'autocomplete_name_error',
                            'size'=>45,
                            'maxlength'=>45,
                            'style'=>'float:left;width:369px;',
                            'placeholder'=>'Nhập tên đường tiếng việt không dấu',                            
                        ),
                )); 
                ?> 
                <script>
                    function fnRemoveName(this_){
                        $(this_).parent('div').find('input').attr("readonly",false); 
                        $("#Users_autocomplete_name_street").val("");
                        $("#Users_street_id").val("");
                    }
                </script>             
                <div class="add_new_item"><a class="iframe_create_street" href="<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/iframe_create_street') ;?>">Tạo Mới Đường</a><em> (Nếu trong danh sách không có)</em></div>
            <div class="clr"></div>
            <?php echo $form->error($model,'street_id'); ?>
	</div>        
        
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'status')); ?>
		<?php echo $form->dropDownList($model,'status', ActiveRecord::getUserStatus(),array('style'=>'width:500px')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

        <div class="row ">
		<?php echo Yii::t('translation', $form->labelEx($model,'last_logged_in', array('label'=>'Ngày Đánh PTTT'))); ?>
		<?php // Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model,        
                    'attribute'=>'last_logged_in',
                    'options'=>array(
                        'showAnim'=>'fold',
//                        'dateFormat'=> ActiveRecord::getDateFormatJquery(),
                        'dateFormat'=> 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                        'buttonImageOnly'=> true,                                
                    ),        
                    'htmlOptions'=>array(
                        'class'=>'',
                        'style'=>'width: 200px;margin-right:10px;',                        
                    ),
                ));
            ?>
            <?php echo $form->error($model,'last_logged_in'); ?>
	</div>
        
	<div class="row buttons" style="padding-left: 141px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
 .row .info_fieldset { margin-top:15px;width:486px;}
 .row .info_fieldset legend { font-weight:bold;font-size:15px;}
 .row .info_fieldset ul{ list-style:none;}
 .row .info_fieldset ul li{ font-size:15px;}
 .fix_inner_filedset {margin:-17px;}
</style>

<script>
function fnUpdateColorbox(){    
    $(".update_agent").colorbox({iframe:true,innerHeight:'500', innerWidth: '1050',close: "<span title='close'>close</span>"});
    $(".iframe_create_street").colorbox({iframe:true,innerHeight:'400', innerWidth: '700',close: "<span title='close'>close</span>"});
}	

$(document).ready(function() {
fnUpdateColorbox();

    $('#Users_province_id').change(function(){
        var province_id = $(this).val();        
//        if($.trim(gender)==''){
//            $('#Products_category_id').html('<option value="">Select category</option>');            
//            return;
//        }                    
        var url_ = "<?php echo Yii::app()->createAbsoluteUrl('admin/gascustomer/create');?>";
//		$('#Products_category_id').html('<option value="">Select category</option>');            
    $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        $.ajax({
            url: url_,
            data: {ajax:1,province_id:province_id},
            type: "get",
            dataType:'json',
            success: function(data){
                $('#Users_district_id').html(data['html_district']);
                $('#Users_storehouse_id').html(data['html_store']);
                $.unblockUI();
            }
        });
        
    });  
    
    $('#Users_district_id').live('change',function(){
        var province_id = $('#Users_province_id').val();   
        var district_id = $(this).val();        
        var url_ = "<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/get_slt_ward');?>";
        $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
        $.ajax({
                url: url_,
                data: {ajax:1,district_id:district_id,province_id:province_id},
                type: "get",
                dataType:'json',
                success: function(data){
                        $('#Users_ward_id').html(data['html_district']);                
                        $.unblockUI();
                }
        });
    });       
    
})

</script>
