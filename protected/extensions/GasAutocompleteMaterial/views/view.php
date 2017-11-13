<div class="wrap_autocomplete_material float_l">
<?php 
if(!isset($data['field_autocomplete_name']))
    $data['field_autocomplete_name'] = 'autocomplete_material_name';
$data['class_name'] = get_class($data['model']);
$idField = "#".$data['class_name']."_".$data['field_autocomplete_name'];

if(!isset($data['field_material_id']))
    $data['field_material_id'] = 'materials_id';
$idFieldMaterial = "#".$data['class_name']."_".$data['field_material_id'];

if(!isset($data['width']))
    $data['width'] = '360px;';
$readonly='';
$value='';
if(($data['model']->$data['name_relation_material'])){
    $value = $data['model']->$data['name_relation_material']->name;
    $readonly='readonly="1"';
}

if(isset($data['MaterialsJson'])){
    $MaterialsJson = $data['MaterialsJson'];
}else{
    $MaterialsJson = MyFunctionCustom::getMaterialsJson();
}


?> 
    <input  value="<?php echo $value;?>" class="float_l" style="<?php echo "width:".$data['width'];?> " type="text" name="<?php echo $data['field_autocomplete_name'];?>" id="<?php echo trim($idField,'#');?>" placeholder="Nhập mã vật tư hoặc tên vật tư" <?php echo $readonly;?> >    
    <span class="remove_row_item autocomplete_remove_material"></span>
</div>

<div class="clr"></div>
<script>
    $(document).ready(function(){
        <?php if(isset($data['custom_source'])):?>
                
        <?php else:?>
            var availableMaterials = <?php echo $MaterialsJson; ?>;
        <?php endif;?>
        
        $( "<?php echo $idField;?>" ).autocomplete({
            source: availableMaterials,
            select: function( event, ui ) {
                $( "<?php echo $idFieldMaterial;?>" ).val(ui.item.id);
                $( "<?php echo $idField;?>" ).attr('readonly',true);
            }
        });
        
        $('.autocomplete_remove_material').click(function(){
            $(this).closest('div.row').find( "<?php echo $idFieldMaterial;?>" ).val('');
            
            $(this).closest('div.row').find( "<?php echo $idField;?>" ).val('').attr('readonly', false);
        });
    
    }); 
    
</script>
