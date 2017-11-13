$(function() {
    fnBindChangeLang();
    updateLinkFeMenu();
});

function fnBindChangeLang(){
    $('.ChangeLang').click(function(){
        var ul = $(this).closest('ul');
        ul.find("input[name='lang']").val($(this).attr('data'));
        $(this).closest('form').submit();
    });
}

function fixTargetBlank() {
	$('.button-column a').attr('target', '_blank');
        $('.remove_html_only').html('');
//	$('.control-nav').find('.btn a').attr('target', '_blank');
}


function validateNumber(){     
//    console.log('Bind event input number');
    $(".number_only_v1").each(function(){
            $(this).unbind("keydown");
            $(this).bind("keydown",function(event){
                if( !(event.keyCode == 8                                // backspace
                    || event.keyCode == 46                              // delete
                    || event.keyCode == 110                              // dấu chám bên bàn phím nhỏ
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

    return;
    $(".number_only").each(function(){
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

function BindClickClose(BLOCK_UI_COLOR){ // Dec 15, 2014
    $('body').on('click', '.btn_closed_tickets', function(){
        var alert_text = $(this).attr('alert_text');
        if(confirm(alert_text)){
            $.blockUI({ overlayCSS: { backgroundColor: BLOCK_UI_COLOR } }); 
            return true;
        }
        return false;
    });
}

/**
 * @Author: ANH DUNG Aug 06, 2016
 */
function updateLinkFeMenu() {
    $('.FirstCatMenu').each(function(){
       $(this) .closest('.RootMenuLi').find('.RootMenuLink').attr('href', $(this).attr('href'));
    });
}
function CopyLinkTop(){
    $('.CopyLinkTop').each(function(){
        var href = $('.'+$(this).attr('DataRef')).attr('href');
        $(this).attr('href', href);
    });
}