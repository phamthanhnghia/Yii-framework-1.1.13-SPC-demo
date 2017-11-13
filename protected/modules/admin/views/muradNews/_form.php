<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'murad-news-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>
    <?php if(!$model->isNewRecord): ?>
        <?php echo $model->getUrlDetail(array("url"=>1, "target"=>1)); ?>
    <?php endif; ?>
    <br><br><div class="clr"></div>
    <input type="submit" class="" value="Save">

    <div id="tabs">
        <ul>
            <?php foreach(Languages::getAlllanguage() as $key=> $lang): ?>
            <li class="<?php echo ($key=='') ? 'active' : ''; ?>">
                <a href="#<?php echo $lang->code ?>"><?php echo $lang->title;?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php foreach(Languages::getAlllanguage() as $key=> $lang): ?>
        <div id="<?php echo $lang->code ?>" class="">
           <?php $this->renderPartial(
                   '_form_translate',
                   array(
                           'model'      => $model->getDataWithLangauge($model, $lang->code),
                           'form'       => $form,
                           'language'   => $lang->code
                       )
               ); 
           ?>
        </div>
        <?php endforeach; ?>
    </div> <!-- end <div id="tabs">-->
    
    <div class="row">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id', $model->getDropdownCategory(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'category_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'category_id_2'); ?>
        <?php echo $form->dropDownList($model,'category_id_2', $model->getDropdownCategory(),array('empty'=>'Select')); ?>
        <?php echo $form->error($model,'category_id_2'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'order_display'); ?>
        <?php echo $form->dropDownList($model,'order_display', MyFormat::BuildNumberOrder(100),array('style'=>'')); ?>
        <?php echo $form->error($model,'order_display'); ?>
    </div>    
    
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $model->optionActive,array('style'=>'')); ?>
        <?php // echo $form->textField($model, "[vi]status", array('size' => 103, 'maxlength' => 255,'class'=>' ' )); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    
    <div class="row">
        <div class="note_red">
            <label>Recommend 775 x 421 (width x height). Allow <?php echo $model->allowImageType; ?>, max = <?php echo ActiveRecord::convertByte2Mb($model->maxImageFileSize); ?></label>
        </div>
        <?php echo $form->labelEx($model,'feature_image'); ?>
        <?php echo $form->fileField($model,'feature_image[]', array('accept'=>'image/*')); ?>
        <?php // echo $form->fileField($model,'feature_image[]', array('accept'=>'image/*', "multiple"=>1)); ?>
        <?php echo $form->error($model,'feature_image'); ?>
        <?php if(!empty($model->feature_image)): ?>
            File hiện tại 
            <?php echo $model->getImageThumbTemp(); ?>
        <?php endif;?>
    </div>
    
    <div class="row editor_area123 be_editor_full">
        <?php // echo $form->labelEx($model,'short_content'); ?>
            <div style="padding-left:141px;">
                <?php // echo $form->textArea($model,'short_content',array('rows'=>8, 'cols'=>120)); ?>
                    <?php
//                    $this->widget('ext.niceditor.nicEditorWidget', array(
//                            "model" => $model, // Data-Model
//                            "attribute" => 'short_content', // Attribute in the Data-Model
//                            "config" => array(
//                                "fullPanel"=>true,
////                                "maxHeight" => "200px",   
////                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
//                            ),
//                            "width" => "900px", // Optional default to 100%
//                            "height" => "200px", // Optional default to 150px
//                    ));
                ?>
            </div>
        <?php echo $form->error($model,'short_content'); ?>
    </div>
    <div class='clr'></div>
    <?php if(!$model->isNewRecord): ?>
        <?php include "_form_upload_multi.php"; ?>
    <?php endif; ?>
    <div class='clr'></div>
    
    
    <div class="row editor_area123 be_editor_full EditorScroll">
            <?php // echo $form->labelEx($model,'content'); ?>
                <div style="padding-left:141px;">
                    <?php // echo $form->textArea($model,'content',array('rows'=>3, 'cols'=>120, 'id'=>'ckeditor1')); ?>
                        <?php
//                        $this->widget('ext.niceditor.nicEditorWidget', array(
//                                "model" => $model, // Data-Model
//                                "attribute" => 'content', // Attribute in the Data-Model        
////                                "defaultValue"=>$model->content,
//                                "config" => array(
//                                    "fullPanel"=>true,
////                                "maxHeight" => "200px",   
////                                "buttonList"=>Yii::app()->params['niceditor_v_1'],
//                                ),
//                                "width" => "900px", // Optional default to 100%
//                                "height" => "500px", // Optional default to 150px
//                        ));
                        ?>
                </div>
            <?php echo $form->error($model,'content'); ?>
	</div>
	<div class='clr '></div>

	<div class="row buttons " style="padding-left: 141px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'label'=>$model->isNewRecord ? 'Create' :'Save',
                'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'small', // null, 'large', 'small' or 'mini'
                //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
            )); ?>	
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });
        jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1',innerHeight:'1000', innerWidth: '1050' });
    });
    
    $('.copyToClipboard').click(function(){
        var element_name = $(this).attr('data-class');
        copyToClipboard($('.'+element_name));
    });
//    BindClickClose('<?php echo BLOCK_UI_COLOR;?>');
    
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>

<!--<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>-->
<script>
//$(function(){
//    $('#Listing_photo_listing_anhdung').change(function(){
//            parent_form = $(this).closest('form');
//            div_show_image = parent_form.find('div.div_show_image');
//            var url_ = '<?php echo Yii::app()->createUrl("member/listing/ajax_upload_photo",array('id'=>$model->id)); ?>';
//            
//            parent_form.ajaxSubmit({
//                type: 'post',
//                url: url_,
//                beforeSend:function(data){
//                    $.blockUI({
////                        message: '', 
////                        overlayCSS:  { backgroundColor: '#fff' }
//                   });
//                },
//                success: function(data)
//                {
//                    div_show_image.html($(data).find('.div_show_image').html());
//                    parent_form.find('input:file').val('');
//                    fnBindSortable();
//                    $.unblockUI();
//                }
//            });// end parent_form.ajaxSubmit({
//    });
//    
//});

</script>

	
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/gasckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/gasckeditor/samples/js/sample.js"></script>-->
<!--<link href="<?php echo Yii::app()->theme->baseUrl; ?>/gasckeditor/samples/css/samples.css" rel="stylesheet" type="text/css" media="screen" />-->
<!--<link href="<?php echo Yii::app()->theme->baseUrl; ?>/gasckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" rel="stylesheet" type="text/css" media="screen" />-->
<script>
    // http://stackoverflow.com/questions/15659390/ckeditor-automatically-strips-classes-from-div
    $(function(){
        $(".ckeditor").each(function(){
           var id = $(this).attr('id');
            CKEDITOR.replace( id, {
                removePlugins: 'about, iframe, flash',
                height: 500,
                allowedContent: true,// Aug 13, 2016 chắc chắn phải open dòng này, không thì sẽ bị lỗi khi có tab và accordiontab // http://docs.ckeditor.com/#!/guide/dev_allowed_content_rules  == http://ckeditor.com/forums/CKEditor-3.x/ckeditor-remove-tag-attributes
                extraAllowedContent : '*(*)'
            });
        });
        
    });
    
     $( "#tabs" ).tabs({ active: 0 });
    
</script>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<?php
$gridCss = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview/styles.css';
Yii::app()->getClientScript()->registerCssFile($gridCss);
?>