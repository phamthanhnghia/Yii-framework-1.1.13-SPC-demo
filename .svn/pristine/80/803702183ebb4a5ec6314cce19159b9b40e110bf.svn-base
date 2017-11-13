<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'controllers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
        <div class="clr"></div>
        <div class="row" style="float:left;padding-left: 150px;">
            <label class="lbchkAllow" for="chkAllow">Allow All</label>
            <input  id="chkAllow" type="radio" name="chkAllow" class="chkAllowDeny" rel="allow" style="float:left;">
            <label class="lbchkAllow" for="chkDeny" style="padding-left: 50px;">Deny All</label>
            <input  id="chkDeny" type="radio" name="chkAllow" class="chkAllowDeny" rel="deny">
        </div>        
        
        <div class="clr"></div>
        <?php         
        foreach ($actions_controller as $key => $value)
        {
        ?>
        <div class="row" style="width: 30%;float:left;">
            <label for="UsersActions_user_id" style="width: 220px;"><?php echo ucfirst($value); ?></label>
            <?php echo CHtml::dropDownList("Actions[$value]", Controllers::canAccess($value, $model->id, Yii::app()->session['type']), array('allow' => 'Allow', 'deny' => 'Deny'),array('style'=>'width:70px;') ) ?>		
	</div>
            
        <?php } ?>
        <div class="clr"></div>
	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
    .lbchkAllow {color: red;font-weight: bold; font-size: 15px !important;}
</style>

<script>
    $(document).ready(function(){
        $('.chkAllowDeny').click(function(){
            var new_val = $(this).attr('rel');
            $('#controllers-form').find('select').val(new_val);
            fnFocusAllow();
        });
        fnFocusAllow();
        
        $('#controllers-form select').click(function(){
           fnApplyCss(this);
        });
    });
    
    function fnFocusAllow(){
        $('#controllers-form select').each(function(){
            fnApplyCss(this);
        });
    }
    
    function fnApplyCss(_this){
        var parent_div = $(_this).parent('div');
        if($(_this).val()=='allow'){
           parent_div.css({'background':'#0489B1'}); 
        }else
            parent_div.css({'background':'#FF8000'});         
    }
    
    
    
    
</script>