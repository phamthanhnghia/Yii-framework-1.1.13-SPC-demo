<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>    
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
        
        <div class="row">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username',array('style'=>'width:450px','maxlength'=>250)); ?>
            <?php echo $form->error($model,'username'); ?>
	</div>		
    
        <div class="row">
            <?php if (!$model->isNewRecord):?>
                <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 140px;">
                    <label style="color: red;width: auto; ">Bỏ trống bên dưới nếu bạn không muốn đổi mật khẩu hiện tại</label>
                </div>
            <?php endif?>
            <?php echo $form->labelEx($model,'password_hash'); ?>
            <?php echo $form->passwordField($model,'password_hash',array('style'=>'width:450px','maxlength'=>50,'value'=>'')); ?>
            <?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'password_confirm'); ?>
            <?php echo $form->passwordField($model,'password_confirm',array('style'=>'width:450px','maxlength'=>50,'value'=>'')); ?>
            <?php echo $form->error($model,'password_confirm'); ?>
	</div>    
        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('style'=>'width:450px','maxlength'=>250)); ?>
            <?php echo $form->error($model,'email'); ?>
	</div>	    
    
        <div class="row">
            <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 140px;">
                <label style="color: red;width: auto; ">Bỏ trống dòng Mã Member </label>
            </div>
            <?php echo Yii::t('translation', $form->labelEx($model,'code_bussiness',array('label'=>'Mã Member'))); ?>
            <?php echo $form->textField($model,'code_bussiness',array('style'=>'width:450px','placeholder'=>'Không được nhập dòng này nha còi')); ?>
            <?php echo $form->error($model,'code_bussiness'); ?>
	</div>	
	
	<div class="row">
            <?php echo $form->labelEx($model,'role_id'); ?>
            <?php echo $form->dropDownList($model,'role_id',Roles::loadItems(),array('class'=>'role_id' ,'style'=>'width:450px')); ?>
            <?php echo $form->error($model,'role_id'); ?>
	</div>	
	
	<div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'first_name',array('label'=>'Tên Member'))); ?>
            <?php echo $form->textField($model,'first_name',array('style'=>'width:450px','class'=>'PreventPaste')); ?>
            <?php echo $form->error($model,'first_name'); ?>
	</div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'phone') ?>
            <?php echo $form->textField($model,'phone',array('class'=>'phone_number_only no_phone_number_text w-450', 'maxlength'=>20)); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>

	<div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'address')); ?>
            <?php echo $form->textArea($model,'address',array('style'=>'width:450px','readonly'=>1)); ?>
            <?php echo $form->error($model,'address'); ?>
	</div>

            <?php if(!$model->isNewRecord):?>
                <!--NV PTTT-->
                <div class="row" style="padding-left: 141px;">
                    <a class='update_agent' href='<?php echo Yii::app()->createAbsoluteUrl("admin/ajax/update_market_development_employee",array("employee_id"=>$model->id) );?>'>
                            Cập Nhật Nhân Viên Phát Triển Thị Trường
                    </a><br/>
                    <fieldset class='info_fieldset'>
                            <legend>Danh Sách Nhân Viên Phát Triển Thị Trường</legend>
                            <?php $listMany = array(); // $listMany = GasOneMany::getArrModelOfManyId($model->id, ONE_MONITORING_MARKET_DEVELOPMENT);?>
                            <div class='for_update_maintain fix_inner_filedset'>
                                    <ul>
                                    <?php if(count($listMany)>0) foreach ($listMany as $key=>$item): ?>
                                            <li><?php echo ($key+1).'.  '.($item->many?$item->many->code_bussiness.' - '.$item->many->first_name:'');?></li>
                                    <?php endforeach;?>
                                    </ul>
                            </div>
                     </fieldset>
                </div>
    
                <!-- DEC 06, 2014 1 NHÂN VIÊN QUẢN LÝ NHIỀU NV KHÁC, THUỘC NHIỀU ROLE KHÁC NHAU -->
                <div class="row" style="padding-left: 141px;">
                    <a class='update_agent' href='<?php echo Yii::app()->createAbsoluteUrl("admin/ajax/update_manage_multiuser",array("employee_id"=>$model->id) );?>'>
                            Cập Nhật Nhân Viên Dưới Quyền Quản Lý
                    </a><br/>
                    <fieldset class='info_fieldset'>
                            <legend>Danh Sách Nhân Viên Dưới Quyền Quản Lý</legend>
                            <?php // $listMany = GasOneMany::getArrModelOfManyId($model->id, ONE_USER_MANAGE_MULTIUSER);?>
                            <div class='for_update_manage_multiuser fix_inner_filedset'>
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
		<?php echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('class'=>'','empty'=>'Select')); ?>
		<?php echo $form->error($model,'province_id'); ?>
	</div>
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'district_id')); ?>
		<?php echo $form->dropDownList($model,'district_id', GasDistrict::getArrAll($model->province_id),array('class'=>'','empty'=>'Select')); ?>
		<?php echo $form->error($model,'district_id'); ?>
	</div>
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'ward_id')); ?>
		<?php echo $form->dropDownList($model,'ward_id', GasWard::getArrAll($model->province_id, $model->district_id),array('style'=>'','empty'=>'Select')); ?>                
		<?php echo $form->error($model,'ward_id'); ?>
	</div>	
	
	<div class="row">
                <?php echo $form->labelEx($model,'house_numbers') ?>
                <?php echo $form->textField($model,'house_numbers',array('style'=>'width:343px','maxlength'=>100)); ?>
                <?php echo $form->error($model,'house_numbers'); ?>
	</div> 	
	
	<div class="row">
            <?php echo $form->labelEx($model,'street_id') ?>
            <?php echo $form->hiddenField($model,'street_id',array('style'=>'width:343px','maxlength'=>100)); ?>
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
                                        var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveNameStreet(this)\'></span>';
                                        $('#Users_autocomplete_name_street').parent('div').find('.remove_row_item').remove();
                                        $('#Users_autocomplete_name_street').attr('readonly',true).after(remove_div);
										$('.autocomplete_name_error').parent('div').find('.autocomplete_name_text').hide();
                                }",
                        ),
                        'htmlOptions'=>array(
                            'class'=>'autocomplete_name_error',
                            'size'=>45,
                            'maxlength'=>45,
                            'style'=>'float:left;width:343px;',
                            'placeholder'=>'Nhập tên đường tiếng việt không dấu',                            
                        ),
                )); 
                ?> 
                <script>
                    function fnRemoveNameStreet(this_){
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
            <?php echo $form->dropDownList($model,'status', ActiveRecord::getUserStatus()); ?>
            <?php echo $form->error($model,'status'); ?>
	</div>
        <?php include "_form_avatar.php"; ?>

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

<script>
$(document).ready(function() {
    jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
    $('.form').find('button:submit').click(function(){
        $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
    });

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


    fnUpdateColorbox();
}); /* end $(document).ready(function() */

	function fnUpdateColorbox(){    
		$(".update_agent").colorbox({iframe:true,innerHeight:'500', innerWidth: '1050',close: "<span title='close'>close</span>"});
	}			
</script>
