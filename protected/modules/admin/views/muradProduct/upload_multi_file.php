<?php $aOrderNumber = MyFormat::BuildNumberOrder(GasFile::IMAGE_MAX_UPLOAD);

?>
<div class="row w-350 tb_file float_l" style=" margin-left: 150px;" >
        <div>
            <a href="javascript:void(0);" class="text_under_none item_b" style="line-height:25px" onclick="fnBuildRow(this);">
                <img style="float: left;margin-right:8px;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/add.png"> 
                Thêm Dòng
            </a>
        </div>
        <table class="materials_table hm_table">
            <thead>
                <tr>
                    <th class="item_c">#</th>
                    <th class="item_code item_c">File đính kèm. Cho phép <?php echo GasFile::$AllowFile;?></th>
                    <th class="item_c">Thứ Tự</th>
                    <th class="item_c">Xóa</th>
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
                            <?php echo $form->dropDownList($model->mDetail,'order_number[]', $aOrderNumber,array('class'=>'w-50', 
                                 'options' => array($item->order_number=>array('selected'=>true))
                                    )); ?>
                        </td>
                        <td class="item_c last"><span class="remove_icon_only"></span></td>
                    </tr> 
                    
                    <?php endforeach;?>
                <?php endif;?>
                
                <?php for($i=1; $i<=(GasFile::IMAGE_MAX_UPLOAD-count($model->aModelDetail)); $i++): ?>
                <?php $display = "";
                    if($i > GasFile::IMAGE_MAX_UPLOAD_SHOW)
                        $display = "display_none";
                ?>
                <tr class="materials_row <?php echo $display;?>">
                    <td class="item_c order_no"></td>
                    <td class="item_l w-400">
                        <?php echo $form->fileField($model->mDetail,'file_name[]',array('class'=>'input_file',)); ?>
                    </td>
                    <td class="item_c">
                        <?php echo $form->dropDownList($model->mDetail,'order_number[]', $aOrderNumber,array('class'=>'w-50', 
                             'options' => array($i=>array('selected'=>true))
                                )); ?>
                    </td>
                    <td class="item_c last"><span class="remove_icon_only"></span></td>
                </tr>
                <?php endfor;?>
            </tbody>
        </table>
    <?php echo $form->error($model,'file_name'); ?>
</div>
<div class="clr"></div>

<script>
    fnRefreshOrderNumber();
    fnBindRemoveIcon();
    function fnBuildRow(this_){
        $(this_).closest('.tb_file').find('.materials_table').find('tr:visible:last').next('tr').show();
    }
    
    $(document).ready(function(){
        jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
    });
    
</script>