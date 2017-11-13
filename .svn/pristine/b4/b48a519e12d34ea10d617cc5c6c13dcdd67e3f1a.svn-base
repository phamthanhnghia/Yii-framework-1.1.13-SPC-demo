<?php
$ClassAddDivWrap = '';
if(isset($data['ClassAddDivWrap']))
    $ClassAddDivWrap= $data['ClassAddDivWrap'];
?>
<div class="unique_wrap_autocomplete <?php echo $ClassAddDivWrap;?>">
<?php 
if(!isset($data['url']))
    $data['url'] = Yii::app()->createAbsoluteUrl('admin/ajax/search_all_customer_storecard');
if(!isset($data['field_autocomplete_name']))
    $data['field_autocomplete_name'] = 'autocomplete_name';
$data['class_name'] = get_class($data['model']);
$idField = "#".$data['class_name']."_".$data['field_autocomplete_name'];

if(!isset($data['field_customer_id']))
    $data['field_customer_id'] = 'customer_id';
$idFieldCustomerID = "#".$data['class_name']."_".$data['field_customer_id'];
$ClassAdd = '';
if(isset($data['ClassAdd']))
    $ClassAdd = $data['ClassAdd'];
$placeholder = 'Nhập mã KH/NCC, Số ĐT. Tối thiểu '.MIN_LENGTH_AUTOCOMPLETE." ký tự";
if(isset($data['placeholder']))
    $placeholder = $data['placeholder'];

$ShowTableInfo = 1;// Sep 23, 2015
if(isset($data['ShowTableInfo']))
    $ShowTableInfo = $data['ShowTableInfo'];


$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'attribute'=>$data['field_autocomplete_name'],
        'model'=>$data['model'],
        'sourceUrl'=>$data['url'],
        'options'=>array(
                'minLength'=>MIN_LENGTH_AUTOCOMPLETE,
                'multiple'=> true,
        'search'=>"js:function( event, ui ) {
                $('$idField').addClass('grid-view-loading-gas');
                } ",
        'response'=>"js:function( event, ui ) {
                var json = $.map(ui, function (value, key) { return value; });
                var parent_div = $('$idField').closest('div.unique_wrap_autocomplete');
                if(json.length<1){
                    var error = '<div class=\'errorMessage clr autocomplete_name_text\'>Không tìm thấy dữ liệu.</div>';
                    if(parent_div.find('.autocomplete_name_text').size()<1)
                        parent_div.find('.autocomplete_name_error').after(error);
                    else
                        parent_div.find('.autocomplete_name_error').parent('div').find('.autocomplete_name_text').show();                                                    
                    parent_div.find('.autocomplete_name_error').parent('div').find('.remove_row_item').hide();                                                    
                }
                $('$idField').removeClass('grid-view-loading-gas');
                } ",

            'select'=>"js:function(event, ui) {
                    var parent_div = $('$idField').closest('div.unique_wrap_autocomplete');
                    $('$idFieldCustomerID').val(ui.item.id);
                    var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveName(this, \"$idField\", \"$idFieldCustomerID\")\'></span>';                    
                    $('$idField').parent('div').find('.remove_row_item').remove();
                    $('$idField').attr('readonly',true).after(remove_div);
                    
                    if($ShowTableInfo){
                        fnBuildTableInfo(ui.item, parent_div);
                        parent_div.find('.autocomplete_customer_info').show();
                    }
                    parent_div.find('.autocomplete_name_error').parent('div').find('.autocomplete_name_text').hide();
                    fnCallSomeFunctionAfterSelect(ui.item.id, '$idField', '$idFieldCustomerID');
                    fnCallSomeFunctionAfterSelectV2(ui, '$idField', '$idFieldCustomerID');
            }",
        ),
        'htmlOptions'=>array(
            'class'=>"autocomplete_name_error $ClassAdd" ,
            'size'=>30,
            'maxlength'=>45,
            'style'=>'float:left;',
            'placeholder'=>$placeholder,
        ),
)); 

$display='display: none;';

$info_name ='';
$info_code ='';
$info_address ='';
$info_phone ='';
$session=Yii::app()->session;
$mUserRelation = $data['model']->$data['name_relation_user'];
?>
<?php if($mUserRelation && $ShowTableInfo):?>
    <?php 
    $show_role_name = '';
    if(isset($data['show_role_name'])){
        $show_role_name = " - ".$session['ROLE_NAME_USER'][ $mUserRelation->role_id ];
    }
    $display='display:inline;';    
    $info_name = $mUserRelation->first_name . $show_role_name;
    if( $mUserRelation->role_id == ROLE_SALE ){
        $info_name = MyFormat::BuildNameSaleSystem( $mUserRelation );
    }
    $info_name_agent = $mUserRelation->name_agent;
    $info_code_account = $mUserRelation->code_account;
    $info_code_bussiness = $mUserRelation->code_bussiness;
    $info_address = $mUserRelation->address;
    $info_phone = $mUserRelation->phone;
    ?>
    <script>
        $(function(){
            var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveName(this, \"<?php echo $idField;?>\", \"<?php echo $idFieldCustomerID;?>\")\'></span>';
            $('<?php echo $idField;?>').val('<?php echo $info_name;?>').attr('readonly',true).after(remove_div);
        });
        
    </script>
    
<?php endif; ?>
<div class="clr"></div> 
<div class="autocomplete_customer_info " style="<?php echo $display;?>">
    <table>
        <tr>
            <td class="_l">Mã:</td>
            <td class="_r info_code"><?php echo $info_code;?></td>
        </tr>

        <tr>
            <td class="_l">Tên:</td>
            <td class="_r info_name"><?php echo $info_name;?></td>
        </tr>                    
        <tr>
            <td class="_l">Địa chỉ:</td>
            <td class="_r info_address"><?php echo $info_address;?></td>
        </tr>
        <tr>
            <td class="_l">Điện Thoại:</td>
            <td class="_r info_phone"><?php echo $info_phone;?></td>
        </tr>
    </table>
</div>
<div class="clr"></div>    

</div>
<script>
    function fnRemoveName(this_, idField, idFieldCustomer){
        $(this_).closest('div.unique_wrap_autocomplete').find(idField).attr("readonly",false);
        $(idField).val("");
        $(idFieldCustomer).val("");        
        $(this_).closest('div.unique_wrap_autocomplete').find('.autocomplete_customer_info').hide();
        fnAfterRemove(this_, idField, idFieldCustomer);
    }
    
    function fnAfterRemove(this_, idField, idFieldCustomer){}
    
    function fnBuildTableInfo(item, parent_div){
        parent_div.find(".info_name").text(item.name_customer);
        parent_div.find(".info_name_agent").text(item.name_agent);
        parent_div.find(".info_code_account").text(item.code_account);
        parent_div.find(".info_code_bussiness").text(item.code_bussiness);
        parent_div.find(".info_address").text(item.address);
        parent_div.find(".info_phone").text(item.phone);    
    }
    
    /* Mar 24, 2014 Dùng để gọi 1 số hàm bên ngoài truyền vào
     * một số view cần custom cái đó nên gọi,
     * sử dụng cho after select
     */
    function fnCallSomeFunctionAfterSelect(user_id, idField, idFieldCustomer){
        <?php if(isset($data['fnSelectCustomer'])): ?>
            <?php echo $data['fnSelectCustomer'];?>(user_id, idField, idFieldCustomer);
        <?php endif;?>
        
    }
    
    /** Sep 23, 2015 Dùng để gọi 1 số hàm bên ngoài truyền vào
     * một số view cần custom cái đó nên gọi,
     * @note: sử dụng cho after select
     * hàm này chuyển cả object ui vào, chứ không phải là bó gọn trong user_id
     */
    function fnCallSomeFunctionAfterSelectV2(ui, idField, idFieldCustomer){
        <?php if(isset($data['fnSelectCustomerV2'])): ?>
            <?php echo $data['fnSelectCustomerV2'];?>(ui, idField, idFieldCustomer);
        <?php endif;?>
    }
    
    
</script>
