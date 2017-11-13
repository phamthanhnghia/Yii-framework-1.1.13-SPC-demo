<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>    
<div class="form popup-form">

        <h1 class="h1-in-form">Cập Nhật Nhân Viên Phát Triển Thị Trường Cho Giám Sát PTTT: 
			<?php echo $model->one?$model->one->first_name:'';?></h1>
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'one-many-form',
                //'enableAjaxValidation'=>false,
				 'enableClientValidation'=>true,
				/* 'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),	 */			 
        )); ?>
                <?php //echo $form->errorSummary($model); ?>
			<?php if($msg): ?>
			<div class="success_div"><?php echo $msg;?></div>
			<?php endif ?>

		<div class='clr'></div>
                <div class="row" style="text-align: center;">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'label'=>'Save',
                    'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'=>'small', // null, 'large', 'small' or 'mini'
                    'htmlOptions' => array('class' => 'submit-blockui'),
                )); ?>	
					<input type="button" class="success_close" value="Close">
				</div>			
		<div class='clr'></div>	
        <div class="row" style="float:left;padding-left: 150px;">
            <label class="lbchkAllow" for="chkAllow">Check All</label>
            <input  id="chkAllow" type="checkbox" name="chkAllow" class="chkAllowDeny" rel="allow" style="float:left;">
        </div>        
        
        <div class="clr"></div>			
            <div class="row multi-checkbox">
                    <?php echo $form->checkBoxList($model, 'many_id', Users::getArrUserPTTT(ROLE_EMPLOYEE_MARKET_DEVELOPMENT, array('order'=>"code_bussiness ASC")),
                        array(   
                            'separator'=>'',
                            'template'=>'<div class="list-input">{input}&nbsp;{label}</div>',
                            'multiple'=>true,
                            'style'=>'width:20px;',
                        ));
                    ?>
            </div>
		<style>
/*		.popup-form .list-input { float:left; width:300px; padding-bottom: 5px;}
		.popup-form .list-input label{ width:260px !important; }
		.popup-form #types { font-weight: bold; }*/
		</style>            
		<div class='clr'></div>
                <div class="row" style="text-align: center;">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'label'=>'Save',
                            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                            'size'=>'small', // null, 'large', 'small' or 'mini'
                            'htmlOptions' => array('class' => 'submit-blockui'),
                        )); ?>	
                        <input type="button" class="success_close" value="Close">
                </div>

        <?php $this->endWidget(); ?>

</div><!-- form -->
<style>
    .lbchkAllow {color: red;font-weight: bold; font-size: 15px !important;}
</style>

<script>
    $(document).ready(function(){
        $('.chkAllowDeny').click(function(){
			if($(this).is(':checked'))
				$('.multi-checkbox').find('input:checkbox').attr('checked',true);
			else
				$('.multi-checkbox').find('input:checkbox').attr('checked',false);            
        });
    });
</script>

<script>
    $(document).ready(function(){
        //parent.$.fn.yiiGridView.update("users-grid");   
        fnBuildNameSelect();
        $('.success_close').click(function(){
            parent.$.colorbox.close();
        });
        
         $('.submit-blockui').live('click',function(){
            $('.form').block({
                message: '', 
                overlayCSS:  { backgroundColor: '#fff' }
           }); 
//           $('.form').unblock(); 
        }); 
		
    });
	
	
	function fnBuildNameSelect(){
		var html_update = '';
		html_update += '<ul>';
		var i=1;
		$('.multi-checkbox').find('input:checkbox').each(function(){
			if($(this).is(':checked')){
				var parent_div = $(this).parent('div');
				var label = parent_div.find('label').text();
				html_update += '<li>'+i+'.  '+label+'</li>';
				i++;
			}
		});
		html_update += '</ul>';
		parent.$(".for_update_maintain").html(html_update);
	}	
</script>