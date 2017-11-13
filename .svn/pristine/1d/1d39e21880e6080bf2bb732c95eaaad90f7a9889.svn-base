<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/huongminh_ticket.css" />
<div class="digital_ticket">
    <div class="flash notice">
        Sử dụng New Ticket để đặt những vấn đề cần hỗ trợ liên quan đến sử dụng phần mềm<br> (vd: tạo sale, tạo khách hàng...). 
        Không cần trao đổi qua email. <a class="hight_light" href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/news',array('id'=>29));?>" target="_blank"> Xem hướng dẫn </a>
    </div>    
    <header>
        <span class="icon"></span>
        <h1 class="border_none">Support</h1>
        <div class="button-group"><a class="like_ticket_click button" href="#new_ticket">New Ticket</a>
        </div>
    </header>
    
    <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
        <div class="flash notice">
            <a data-dismiss="alert" class="close" href="javascript:void(0)">×</a>
            <?php echo Yii::app()->user->getFlash('successUpdate');?>
        </div>
    <?php endif; ?>  
    <?php if(Yii::app()->user->hasFlash('ErrorUpdate')): ?>
        <div class="flash notice_error">
            <a data-dismiss="alert" class="close" href="javascript:void(0)">×</a>
            <?php echo Yii::app()->user->getFlash('ErrorUpdate');?>
        </div>
    <?php endif; ?>  
    
<div id="new_ticket" class="in collapse display_none" style="height: auto;">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'new_ticket_form',
	'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'new_ticket'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
//            'afterValidate' => 'js:function(form, attribute, data, hasError){ không nên dùng hàm này nếu ko return true thì ko submit dc  }'
        ),
    )); ?>
    <!--<form method="post" id="" class="">-->        
        <fieldset>
            <div id="ticket_topic_field">
                <!--<input type="text" size="30" placeholder="Subject" name="ticket[topic]" id="ticket_topic" class="">-->
                <div class="row w-350" >
                    <?php // echo $form->labelEx($ModelCreate,'title'); ?>
                    <?php echo $form->textField($ModelCreate,'title',array('class'=>'ticket_topic', 'size'=>30,'maxlength'=>200,'placeholder'=>'Tiêu Đề')); ?>
                    <?php echo $form->error($ModelCreate,'title'); ?>
                </div>
            </div>
            <?php if(Yii::app()->user->role_id!=ROLE_ADMIN):?>
            <div class="styled-select">
                <div class="row ">
                    <?php // echo $form->labelEx($model,'send_to_id'); ?>
                    <?php  echo $form->dropDownList($ModelCreate,'send_to_id', GasTickets::GetListSendTo(),array('style'=>'','empty'=>'Admin - Quản trị')); ?>
                    <?php echo $form->error($ModelCreate,'send_to_id', array('style'=>'padding-top:70px;')); ?>
                </div>                
            </div>
            <?php else: ?>
                <div class="clr"></div>
                <?php include 'index_auto_search.php';?>
            <?php endif; ?>
            
            <?php  echo $form->textArea($ModelCreate,'message', array('style'=>'', 'cols'=>40,'placeholder'=>'Nội dung yêu cầu hỗ trợ ...')); ?>
            <?php echo $form->error($ModelCreate,'message', array('style'=>'')); ?>
            <input type="submit" value="Create Ticket" name="commit" class="button">            
        </fieldset>
    <!--</form>-->
    <?php $this->endWidget(); ?>    
</div><!-- <div id="new_ticket"  -->
    
<?php if(GasCheck::isAllowAccess('tickets', 'pick_ticket')): ?>
    <?php include 'index_need_process.php';?>
    <?php include 'index_need_process_done.php';?>
    <?php if(Yii::app()->user->role_id==ROLE_ADMIN):?>
        <?php include 'index_need_process_but_close.php';?>
    <?php endif;?>
    <?php include 'index_open.php';?>
    <?php include 'index_open_to_closed.php';?>
<?php else:?>
    <?php include 'index_open.php';?>
    <?php include 'index_open_to_closed.php';?>
<?php endif;?>

<!--<h2 class="section-header closed_tickets">Closed Tickets</h2>-->
    
</div>

<script>
    $(document).ready(function(){        
        $('#new_ticket').find('input:submit').click(function(){
            var form = $(this).closest('form');
            var elementError = form.find('.errorMessage:visible');
            var title = form.find('.ticket_topic').val();
            var message = form.find('textarea').val();
            if (elementError.length === 0 && $.trim(title)!='' && $.trim(message)!=''){
                if($('body').find('.blockUI').size()<1){
                    $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } });
                }
            }            
        });
        
        BindClickView();
        BindClickReply();
        BindClickClose();
        BindPickTicket();        
    });    
    
    function BindClickView(){
        $('.ticket').find('a.view, a.reply').live('click', function(){
            var div_content = $(this).attr('href');
            if($(div_content).is(':visible')){
                $(div_content).hide();
            }else{
                $(div_content).show();
            }
            return false;
        });    
        $('.like_ticket_click').live('click', function(){
            var div_content = $(this).attr('href');
            if($(div_content).is(':visible')){
                $(div_content).hide();
            }else{
                $(div_content).show();
            }
            return false;
        });    
    }
    
    function BindClickReply(){
        $('.new_reply').find('input:submit').live('click',function(){
            var form = $(this).closest('form');
            var message = form.find('textarea').val();            
            if($.trim(message)==''){
                form.find('.errorMessage').show();
                return false;
            }
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
            return true;
            
        }); 
    }
    
    function BindClickClose(){
        $('.btn_closed_tickets').live('click',function(){
            var alert_text = $(this).attr('alert_text');
            if(confirm(alert_text)){
                $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
                return true;
            }
            return false;
        }); 
    }
    
    function BindPickTicket(){
        $('.pick_ticket').live('click',function(){
            if(confirm('Bạn chắc chắn muốn xử lý ticket này?')){
                $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
                var div_wrap = $(this).closest('div.post_reply');
                var class_div_repplace = div_wrap.attr('data_class');
                var form = $(this).closest('form');
                var url_ = form.attr('action');
                $.ajax({
                    url: url_,
                    type:'post',
                    success: function(data){
                        if($(data).find('.'+class_div_repplace).size()>0){
                            var new_form = $(data).find('.'+class_div_repplace).html();
                            $('.'+class_div_repplace).html(new_form);
                        }else{
                            alert('Ticket này đã có người xử lý, nhấn f5 để cập nhật page');
                        }
                        $.unblockUI();
                    }
                });
            }
            return false;
        });
    }
    
    
</script>