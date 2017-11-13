/** Feb 24, 2015
 *  huongminh_ticket.js */

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

function BindClickReply(BLOCK_UI_COLOR){
    $('.new_reply').find('input:submit').live('click',function(){
        var form = $(this).closest('form');
        var message = form.find('textarea').val();            
        if($.trim(message)==''){
            form.find('.errorMessage').show();
            return false;
        }
        $.blockUI({ overlayCSS: { backgroundColor: BLOCK_UI_COLOR } }); 
        return true;

    }); 
}

function BindClickClose(BLOCK_UI_COLOR){
    $('.btn_closed_tickets').live('click',function(){
        var alert_text = $(this).attr('alert_text');
        if(confirm(alert_text)){
            $.blockUI({ overlayCSS: { backgroundColor: BLOCK_UI_COLOR } }); 
            return true;
        }
        return false;
    }); 
}

function BindPickTicket(BLOCK_UI_COLOR){
    $('.pick_ticket').live('click',function(){
        var data_msg = $(this).attr('data_msg');
        if(confirm(data_msg)){
            $.blockUI({ overlayCSS: { backgroundColor: BLOCK_UI_COLOR } }); 
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

function BindTicketSubmit(BLOCK_UI_COLOR){
    $('#new_ticket').find('input:submit').click(function(){
        var form = $(this).closest('form');
        var elementError = form.find('.errorMessage:visible');
        var title = form.find('.ticket_topic').val();
        var problem = form.find('.problem').val();
        var message = form.find('textarea').val();        
        if (elementError.length === 0 && $.trim(title)!='' && $.trim(problem)!='' && $.trim(message)!=''){
            if($('body').find('.blockUI').size()<1){
                $.blockUI({ overlayCSS: { backgroundColor: BLOCK_UI_COLOR } });
            }
        }            
    });
}