<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></span>
	</div>        
        <div class="clr"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'menu_name'); ?>
		<?php echo $form->textField($model,'menu_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'menu_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_link'); ?>
		<?php echo $form->textField($model,'menu_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'menu_link'); ?>
	</div>
        
    <div class="row">
		<?php echo $form->labelEx($model,'module_name'); ?>
		<?php echo $form->dropDownList($model,'module_name',array(null => 'Front End', 'admin' => 'Admin', 'member' => 'Member','auditTrail' => 'Audit Trail')); ?>
		<?php echo $form->error($model,'module_name'); ?>
                <!--<div style="" id="" class="errorMessage">Module Name cannot be blank.</div>-->        
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller_name'); ?>
		<?php echo $form->textField($model,'controller_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'controller_name'); ?>
	</div>
        
        
        <?php /*
            <div class="row">
                <?php echo $form->labelEx($model,'controller_name'); ?>
                <?php echo $form->textField($model,'controller_name',array('size'=>30,'maxlength'=>100)); ?>
                <?php echo $form->error($model,'controller_name'); ?>
            </div>


    <div class="row">
        <?php echo $form->labelEx($model,'action_name'); ?>
        <?php echo $form->textField($model,'action_name',array('size'=>30,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'action_name'); ?>
    </div>
 */?>

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
		<?php echo $form->checkBox($model,'show_in_menu',
                (!empty($model->show_in_menu) && $model->show_in_menu==1)?array('checked'=>'checked'):array()); ?>
		<?php echo $form->error($model,'show_in_menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo Menus::getDropDownList('Menus[parent_id]','Menus_parent_id',$model->parent_id,true); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

    <div class="clr"></div>
    <div id="checkboxresult"></div>
    
    <div class="row buttons">
            <span class="btn-submit"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></span>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){

		validateNumber();

            $("input[name='roles[]']").change(function(){
			//alert(1);
		});

//                $("input[name='Menus[controller_name]']").trigger('change');
//                $("select[name='Menus[module_name]']").trigger('change');

	});
        
//        $("input[name='Menus[controller_name]']").change(getAction);
        
//        $("select[name='Menus[module_name]']").change(getAction);
        
        function getAction(){
            var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/getactions/getactionsname');?>";
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
            var request = $.ajax({
                type: "post",
                url: url,
                data: { controller: $("input[name='Menus[controller_name]']").val(), module: $("select[name='Menus[module_name]']").val()}
              }).done(function(msg) {
                $("textarea[name='actions[]']").html(msg);   
                $("select[name='Menus[module_name]']").parent('div').find('.errorMessage').html('').hide();
                $.unblockUI();
              });
              
              request.fail(function() {
                  $("select[name='Menus[module_name]']").parent('div').find('.errorMessage').html('Wrong controller!').show();
//                alert( "Wrong controller!");
                $.unblockUI();
              });  
              
              getCheckBox();          
        }
        
        function getCheckBox(){
            return ; // 11-11-2013 ANH DUNG FIX 
            var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/menus/getcheckbox');?>";
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
            var request = $.ajax({
                type: "post",
                url: url,
                data: { controller: $("input[name='Menus[controller_name]']").val(), module: $("select[name='Menus[module_name]']").val()}
              }).done(function(msg) {
                $("#checkboxresult").html(msg);     
                $.unblockUI();
              });
              
              request.fail(function() {
                alert( "Wrong controller!");
                $.unblockUI();
              });
        }
        
	function validateNumber(){
		$(".number").each(function(){
			$(this).unbind("keydown");
			$(this).bind("keydown",function(event){
			    if( !(event.keyCode == 8                                // backspace
			        || event.keyCode == 46                              // delete
			        || event.keyCode == 9							// tab
			        || event.keyCode == 190							// dấu chấm (point) 
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

<style>
    .menus-role-list input[type='checkbox'] { vertical-align: top;}
    
</style>