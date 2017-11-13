<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-materials-sell-form-popup',
	'enableAjaxValidation'=>false,
)); ?>
        <p class="note">Thêm khách hàng cho đại lý <?php echo $model->agent?$model->agent->first_name:'';?></p>
        <div class="success_div"><?php echo $msg;?></div>
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'customer_id')); ?>
                <?php echo $form->hiddenField($model,'customer_id'); ?>
                <?php 
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                    'attribute'=>'autocomplete_name',
                                'model'=>$model,
                                'sourceUrl'=>Yii::app()->createAbsoluteUrl('admin/ajax/search_all_customer_storecard'),
                //                                'name'=>'my_input_name',
                                'options'=>array(
                                        'minLength'=>MIN_LENGTH_AUTOCOMPLETE,
                                        'multiple'=> true,
                                    'select'=>"js:function(event, ui) {
                                            $('#GasAgentCustomer_customer_id').val(ui.item.id);
                                            var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveName(this)\'></span>';
                                            $('#GasAgentCustomer_autocomplete_name').parent('div').find('.remove_row_item').remove();
                                            $('#GasAgentCustomer_autocomplete_name').attr('readonly',true).after(remove_div);
                                            fnBuildTableInfo(ui.item);
                                            $('.autocomplete_customer_info').show();
                                    }",
                                ),
                                'htmlOptions'=>array(
                                    'size'=>45,
                                    'maxlength'=>45,
                                    'style'=>'float:left;',
                                    'placeholder'=>'Nhập tên hoặc mã kế toán, kinh doanh',
                                ),
                        )); 
                        ?>        
                        <script>
                            function fnRemoveName(this_){
                                $(this_).prev().attr("readonly",false); 
                                $("#GasAgentCustomer_autocomplete_name").val("");
                                $("#GasAgentCustomer_customer_id").val("");
                                $('.autocomplete_customer_info').hide();
                            }
                        function fnBuildTableInfo(item){
                            $(".info_name").text(item.value);
                            $(".info_name_agent").text(item.name_agent);
                            $(".info_code_account").text(item.code_account);
                            $(".info_code_bussiness").text(item.code_bussiness);
                            $(".info_address").text(item.address);
                            $(".info_name_sale").text(item.sale);
                        }
                            
                        </script>        
                        <div class="clr"></div>		
		<?php echo $form->error($model,'customer_id'); ?>
                <?php $display='display:inline;';
                    $info_name ='';
                    $info_name_agent ='';
                    $info_address ='';
                    $info_code_account ='';
                    $info_code_bussiness ='';
                    $info_name_sale ='';
                        if(empty($model->customer_id)) $display='display: none;';
                        else{
                            $info_name = $model->customer->first_name;
                            $info_name_agent = $model->customer->name_agent;
                            $info_code_account = $model->customer->code_account;
                            $info_code_bussiness = $model->customer->code_bussiness;
                            $info_address = $model->customer->address;
                            $info_name_sale = $model->customer->sale?$model->customer->sale->first_name:'';
                        }
                        $display='display: none;';
                ?>                        
                <div class="autocomplete_customer_info" style="<?php echo $display;?>">
                <table>
                    <tr>
                        <td class="_l">Mã Hệ Thống:</td>
                        <td class="_r info_code_account"><?php echo $info_code_account;?></td>
                    </tr>
					
                    <tr>
                        <td class="_l">Mã Khách Hàng:</td>
                        <td class="_r info_code_bussiness"><?php echo $info_code_bussiness;?></td>
                    </tr>
					
                    <tr>
                        <td class="_l">Nhân viên sale:</td>
                        <td class="_r info_name_sale"><?php echo $info_name_sale;?></td>
                    </tr>
                    <tr>
                        <td class="_l">Tên khách hàng:</td>
                        <td class="_r info_name"><?php echo $info_name;?></td>
                    </tr>
<!--                    <tr>
                        <td class="_l">Tên phụ:</td>
                        <td class="_r info_name_agent"><?php echo $info_name_agent;?></td>
                    </tr>-->
                    
                    <tr>
                        <td class="_l">Địa chỉ:</td>
                        <td class="_r info_address"><?php echo $info_address;?></td>
                    </tr>
                </table>
            </div>
            <div class="clr"></div>    		
            <?php echo $form->error($model,'customer_id'); ?>
	</div>
        
	<div class="row buttons" style="padding-left: 140px;">
            <input type="submit" value="Thêm Khách Hàng" onclick="fnSubmit();" class="btnSubmit" onclick="">
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        parent.$.fn.yiiGridView.update("users-grid");   
    });
    
function fnSubmit(){
    $('.autocomplete_customer_info').hide();
}



</script>