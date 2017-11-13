<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _form.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cms-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></span>
	</div>        
        <div class="clr"></div>        
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('style'=>'width:900px','maxlength'=>450)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	
        <div class="row hide_div">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row hide_div">
		<?php echo $form->labelEx($model,'banner'); ?>
		<?php echo $form->fileField($model,'banner'); ?>
                <input type="checkbox" name="Cms[useBanner]"> Delete current banner<br/>
                <div style="text-align: center;">
                    <?php if(!empty($model->banner)) echo CHtml::image(Yii::app()->baseUrl.'/upload/cms/banner/'.$model->banner); ?>
                </div>
		<?php echo $form->error($model,'banner'); ?>
	</div>

        <div class='clr'></div>
        <div class="row hide_div">
            <?php echo $form->labelEx($model,'link'); ?>
            <?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'link'); ?>
        </div>

        <div class="row" >
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status',ActiveRecord::getUserStatus());?>
            <?php echo $form->error($model,'status'); ?>
        </div>

        <?php
        $tmp_ = array();
        for($i=1;$i<50;$i++)
            $tmp_[$i]=$i;
        ?>
	<div class="row">
		<?php echo $form->labelEx($model,'display_order'); ?>
                <?php echo $form->dropDownList($model,'display_order',$tmp_); ?>
		<?php echo $form->error($model,'display_order'); ?>
	</div>
        

        <div class="row">
            <?php echo $form->labelEx($model,'show_in_menu'); ?>
            <?php echo $form->dropDownList($model,'show_in_menu',  CmsFormatter::$yesNoFormat);?>
            <?php echo $form->error($model,'show_in_menu'); ?>
        </div>
    
        <div class='clr'></div>

        <div class="row">
            <?php echo $form->labelEx($model,'cms_content'); ?>
            <div style="float:left;">
                <?php
                    $this->widget('ext.niceditor.nicEditorWidget', array(
                            "model" => $model, // Data-Model
                            "attribute" => 'cms_content', // Attribute in the Data-Model        
                            "config" => array(
                                    "buttonList"=>Yii::app()->params['niceditor_v_1'],
                            ),
                            "width" => '900px', // Optional default to 100%
                            "height" => "600px", // Optional default to 150px
                    ));
                ?>      
            </div>
            <?php echo $form->error($model,'cms_content'); ?>
        </div>

        <div class='clr'></div>
        <div class="row">
            <?php echo $form->labelEx($model,'short_content'); ?>
            <div style="float:left;">
                <?php
                    $this->widget('ext.niceditor.nicEditorWidget', array(
                            "model" => $model, // Data-Model
                            "attribute" => 'short_content', // Attribute in the Data-Model        
                            "config" => array(
                                    "buttonList"=>Yii::app()->params['niceditor_v_1'],
                            ),
                            "width" => EDITOR_WIDTH, // Optional default to 100%
                            "height" => "60px", // Optional default to 150px
                    ));
                ?>      
            </div>
            <?php echo $form->error($model,'short_content'); ?>
        </div>
        <div class='clr'></div>
        
        <div class="row buttons" style="padding-left: 141px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stringToSlug.js"></script>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stringToSlug.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		validateNumber();
                $("#Cms_title").stringToSlug({
			setEvents: 'keyup keydown blur',
			getPut: '#Cms_slug',
			space: '-'
		});                
	});

	function validateNumber(){
		$(".number").each(function(){
			$(this).unbind("keydown");
			$(this).bind("keydown",function(event){
			    if( !(event.keyCode == 8                                // backspace
			        || event.keyCode == 46                              // delete
			        || event.keyCode == 9							// tab
			        || event.keyCode == 190							// dáº¥u cháº¥m (point) 
			        || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
			        || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
			        || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
			        ) {
			            event.preventDefault();     // Prevent character input
			    	}
			});
		});
	}
	
</script>