<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'murad-product-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
<?php $aOrderNumber = MyFormat::BuildNumberOrder(GasFile::IMAGE_MAX_UPLOAD);
?>
<div class="row w-350 tb_file float_l" style=" margin-left: 150px;" >
        <table class="materials_table hm_table">
            <thead>
                <tr>
                    <th class="item_c">#</th>
                    <th class="item_code item_c">File đính kèm. Cho phép <?php echo GasFile::$AllowFile;?></th>
                    <th class="item_c">Thứ Tự</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($model->aModelDetail)):?>
                    <?php foreach($model->aModelDetail as $key=>$item):?>
                    <tr class="materials_row">
                        <td class="item_c order_no"></td>
                        <td class="item_c w-400">
                            <?php // echo $form->fileField($item,'file_name[]'); ?>
                            <?php if(!empty($item->file_name)): ?>
                            <p>
                                <?php echo $item->getImageThumbTemp();?>
                            </p>
                            <?php endif;?>
                            <?php echo $form->error($item,'file_name'); ?>
                            <?php echo $form->hiddenField($item,'aIdNotIn[]', array('value'=>$item->id)); ?>
                        </td>
                        <td class="item_c">
                            <?php echo $item->order_number; ?>
                        </td>
                    </tr> 
                    
                    <?php endforeach;?>
                <?php endif;?>
                
            </tbody>
        </table>
    <?php echo $form->error($model,'file_name'); ?>
</div>
<div class="clr"></div>
<?php $this->endWidget(); ?>

<script>
    fnRefreshOrderNumber();
    $(document).ready(function(){
        jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
    });
    
</script>
