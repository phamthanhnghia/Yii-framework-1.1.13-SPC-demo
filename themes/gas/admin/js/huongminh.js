$(function() {
    fnBindTrHmtable();
    fnBindFreezetablecolumns();
    // fix for menu ANH DUNG 11-22-2013
    var z_index=200;
    $('#navmenu > li').each(function(){
        $(this).css({'z-index':z_index});
        z_index--;
    });
    // fix for menu ANH DUNG 11-22-2013
    $('.cancel_iframe').click(function(){
        parent.$.fn.colorbox.close();
    });
    bindEventForHelpNumber();
    fnBindCloseFlash();
    fnBindClickShowHide();
    fnRowQtyPriceAmount();
    fnRowQtySum();
    fnSltSupportPercent();
    fnSltPercentDraft();
    fnPreventPaste(); // Dec 16, 2015
    fnAddSaveButton();
    jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1',innerHeight:'1000', innerWidth: '1050' });
}); 


function fnPreventPaste(){
    $('.PreventPaste').bind("paste",function(e) {
        e.preventDefault();
    });
}

$(window).scroll(function() {
    if ($(this).scrollTop()>0)
     {
//        $('.backtotop').fadeOut();
        $('.backtotop').show();
     }
    else
     {
         $('.backtotop').hide();
//      $('.backtotop').fadeIn();
     }
 });    

function fnBindCloseFlash(){
    $('.flash a.close').click(function(){ $(this).closest('div.flash').hide(); });
}

function showMsgWarning(msg){
     $('.inline_content_warning').html(msg);
     $.colorbox({width:"600px",height:'250px', inline:true, href:"#inline_content_warning"});
}        

function detecting_browsers_by_ducktyping(){
    var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
    var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
        // At least Safari 3+: "[object HTMLElementConstructor]"
    var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
    var isIE = /*@cc_on!@*/false || !!document.documentMode;   // At least IE6

    if(isFirefox)
        return 'firefox';
    else if(isChrome)
        return 'chrome';
    else if(isSafari)
        return 'safari';
    else if(isOpera)
        return 'opera';
    else if(isIE)
        return 'ie';
}

// format number: 200,000
function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}    

// PHP 'afterValidate'=>'js:function(form, data, hasError) {return fnAddCheckSubmit();}'
function fnAddCheckSubmit(){
    if(confirm('Bạn chắc chắn muốn lưu dữ liệu?'))
            return true;
    return false;
}	

function bindEventForHelpNumber(){
        $(".number_only").on('keyup blur change', function() {
        if($.isNumeric($(this).val()) && $.trim($(this).val())!=''){
            $(this).next('div').show().html(commaSeparateNumber($(this).val()*1));
        }
        else
            $(this).next('div').show().html('');
    });    
}

/** 02-13-2014 ANH DUNG
 * to do: overlay screen when user click submit
 * @param {string} BLOCK_UI_COLOR : color code
 */

function fnBindEventSubmitClick(BLOCK_UI_COLOR){
    $('.form').find('button:submit').click(function(){
        fnRunBlockUi(BLOCK_UI_COLOR);
    });
}

function fnRunBlockUi(BLOCK_UI_COLOR){// Oct 14, 2015
    $.blockUI({ overlayCSS: { backgroundColor: BLOCK_UI_COLOR } }); 
}

/** Feb 26, 2014
 * @returns {undefined}
 */
function fnBindRemoveIcon(){
    $('body').on('click', '.remove_icon_only', function(){
        if(confirm('Bạn chắc chắn muốn xóa?')){
            $(this).closest('tr').remove();
            fnRefreshOrderNumber();
            fnAfterRemoveIcon();
        }
    });
}

function fnAfterRemoveIcon(){} // không để làm gì cả, sẽ overide trong từng file cụ thể

/** Feb 26, 2014
 * @returns {undefined}
 */
function fnRefreshOrderNumber(){
    validateNumber();
    $('.materials_table').each(function(){
        var index = 1;
        $(this).find('.order_no').each(function(){
            $(this).text(index++);
        });
    });
}    

function fnShowhighLightTr(){
    $('.high_light_tr').each(function(){
        var tr_parent = $(this).closest('tr');    
        tr_parent.css({'background':'#F9966B'});
    });
    
    $('.high_light_td').each(function(){
        var tr_parent = $(this).closest('td');    
        tr_parent.css({'background':'#8BC34A'});
    });
    
    $('.high_light_tr1').each(function(){
        var tr_parent = $(this).closest('tr');    
        tr_parent.css({'background':'#8BC34A'});
    });
}

/** Apr 09, 2014 to do bind event for icon remove material */
function fnBindRemoveMaterial(){
    $('body').on('click', '.remove_material_js', function(){
        if(confirm('Bạn chắc chắn muốn xóa?')){
            var _parent = $(this).closest('.col_material');
            _parent.find('.other_material_id_hide').val('');
            _parent.find('.material_text').text('');
            _parent.find('.material_autocomplete').attr('readonly',false).val('');
        }
    });
}

/** Apr 09, 2014 to do bind event for icon remove material 
 * @param {string} ClassHideId tên class của input ẩn ex: other_material_id_hide
 * @param {string} ClassInputAutocomplete tên class của input autocomplete: ex: material_autocomplete
 * 
 * */
function fnBindRemoveMaterialFix(ClassHideId, ClassInputAutocomplete, ClassNeedEmptyText){
    ClassNeedEmptyText = typeof ClassNeedEmptyText !== 'undefined' ? ClassNeedEmptyText : 'material_text';
    $('body').on('click', '.remove_material_js', function(){
        if(confirm('Bạn chắc chắn muốn xóa?')){
            var _parent = $(this).closest('.col_material');
            _parent.find('.'+ClassHideId).val('');
            _parent.find('.'+ClassNeedEmptyText).text('');
            _parent.find('.'+ClassInputAutocomplete).attr('readonly',false).val('');
        }
    });
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

function validatePhoneNumber(){
    $(".phone_number_only").each(function(){
            $(this).unbind("keydown");
            $(this).bind("keydown",function(event){
            //alert(event.keyCode)
                if( !(event.keyCode == 8                                // backspace
                    || event.keyCode == 46                              // delete
                    || event.keyCode == 9							// tab
//                    || event.keyCode == 190							// dấu chấm (point) 
//                    || event.keyCode == 32							// dấu cách (space)
//                    || event.keyCode == 173							// dấu gạch ngang (-)
                    || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
                    || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
                    || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
                    ) {
                        event.preventDefault();     // Prevent character input
                    }
            });
    });
}

function fixTargetBlank() {
	$('.button-column a').attr('target', '_blank');
        $('.remove_html_only').html('');
//	$('.control-nav').find('.btn a').attr('target', '_blank');
}

function fnBindTrHmtable(){
    $('body').on('click', '.hm_table tr', function(){
        $('.hm_table tr').removeClass('selected');
        $(this).addClass('selected');
    });
}

// May 11, 2014 bind event select for tr of freezetablecolumns
function fnBindFreezetablecolumns(){
    $('body').on('click', '.freezetablecolumns tr', function(){
        var div_grid_view = $(this).closest('div.grid-view');
        div_grid_view.find('tr.selected').removeClass('selected');
        var tr_index = $(this).index();
        div_grid_view.find('.freezetablecolumns').each(function(){
            $(this).find('tbody tr').eq(tr_index).addClass('selected');
        });
    });    
    
    
    $('body').on('click', '.freezetablecolumns_only_tr tr', function(){
        var div_grid_view = $(this).closest('div.grid-view');
        div_grid_view.find('tr.selected').removeClass('selected');
        var tr_index = $(this).index();
        div_grid_view.find('.freezetablecolumns_only_tr').each(function(){
            $(this).find('tbody tr').eq(tr_index).addClass('selected');
        });
    });      
    
    /* có thể dùng kiểu này cũng dc, vì nó click hết cho các đại lý khi xem nhiều tab 
    $('.freezetablecolumns tr').live('click',function()
    {
        $('.freezetablecolumns tr').removeClass('selected');
        var tr_index = $(this).index();
        $('.freezetablecolumns').each(function(){
            $(this).find('tbody tr').eq(tr_index).addClass('selected');
        });
    });    
    
    $('.freezetablecolumns_only_tr tr').live('click',function()
    {
        $('.freezetablecolumns_only_tr tr').removeClass('selected');
        var tr_index = $(this).index();
        $('.freezetablecolumns_only_tr').each(function(){
            $(this).find('tbody tr').eq(tr_index).addClass('selected');
        });
    });    
    */
    
}

function fnAddClassOddEven(className){
    $('.'+className).each(function(){    
        $(this).find("tbody > tr:odd").addClass("odd");
        $(this).find("tbody > tr:even").addClass("even");
    })
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
 * @Author: ANH DUNG Sep 11, 2015
 */
function fnBindClickShowHide() {
    $('body').on('click', '.ClickShowHide', function(){
        var wrap_div = $(this).closest('.ClickShowHideWrap');
        wrap_div.find('.ClickShowHideItem').toggle();
    });
}

/**
 * @Author: ANH DUNG Jun 19, 2015
 * @Todo: dùng cho các table format qty*price = amount
 */
function fnRowQtyPriceAmount() {
//    $('.items_qty, .items_price').live('keyup',function()
    $('body').on('change', '.items_qty, .items_price', function(){
        // 1. for amount
        var wrap = $(this).closest('.RowQtyPriceAmount');
        var qty = wrap.find('.items_qty').val();
        var price = wrap.find('.items_price').val();
        var amount = qty*price*1;
        amount = fnConvertFloatNumber(amount);
        wrap.find('.items_amount').attr('data_gas', amount);
        wrap.find('.items_amount').text(commaSeparateNumber(amount));
        
        // 2. for grand total
        var items_grand_total = 0;
        $('.items_qty').each(function(){
            var wrap = $(this).closest('.RowQtyPriceAmount');
            var qty = wrap.find('.items_qty').val();
            var price = wrap.find('.items_price').val();
            var amount = qty*price*1;
            items_grand_total += amount;
        });
        
        items_grand_total = fnConvertFloatNumber(items_grand_total);
        var wrap_table = $(this).closest('.WrapRowQtyPriceAmount');
        wrap_table.find('.items_grand_total').text(commaSeparateNumber(items_grand_total));
    });
}

/**
 * @Author: ANH DUNG Now 06, 2015
 * @Todo: dùng cho các table format sum qty
 */
function fnRowQtySum() {
//    $('.items_qty, .items_price').live('keyup',function()
    $('body').on('change', '.items_qty', function(){
        // 1. for sum qty
        var qty_sum = 0;
        $('.items_qty').each(function(){
            var wrap = $(this).closest('.RowQtySum');
            var qty = wrap.find('.items_qty').val()*1;
            qty_sum += qty;
        });
        qty_sum = fnConvertFloatNumber(qty_sum);
        var wrap_table = $(this).closest('.WrapRowQtySum');
        wrap_table.find('.items_qty_sum').text(commaSeparateNumber(qty_sum));
    });
}

function fnRowSumAnyField(class_item, class_sum) {
    // 1. for sum qty
    var qty_sum = 0;
    $(class_item).each(function(){
        var qty = $(this).val()*1;
        qty_sum += qty;
    });
    qty_sum = fnConvertFloatNumber(qty_sum);
    $(class_sum).text(commaSeparateNumber(qty_sum));
}

/**
 * @Author: ANH DUNG Jun 16, 2015
 * @Todo: convert to number have comma
 * @Param: $model
 */
function fnConvertFloatNumber(number) {
    var res = parseFloat(number);
    res = Math.round(res * 100) / 100;
    if(isNaN(res)){
        res = 0;
    }
    return res;
}

/**
 * @Author: ANH DUNG Jun 19, 2015
 * @Todo: something
 */
function fnSltSupportPercent() {
    $('.support_percent').change(function(){
        var percent = $(this).val();
        var wrap = $(this).closest('.RowQtyPriceAmount');
        var amount_span = wrap.find('.items_amount');
        var amount = amount_span.attr('data_gas');
        var amount_after_discount = amount * (100 - percent)/100;
        amount_after_discount = fnConvertFloatNumber(amount_after_discount);
        wrap.find('.amount_final').html(commaSeparateNumber(amount_after_discount));
    });
}

/**
 * @Author: ANH DUNG Jun 19, 2015
 * @Todo: something
 */
function fnSltPercentDraft() {
    $('.percent_draft').change(function(){
        var percent = $(this).val();
        $('.support_percent').val(percent);
        $('.support_percent').trigger('change');
    });
}

/** Mar 11, 2014 -  ANH DUNG - COPY FROM MINDEDGE
 * Dùng để cập nhật url tiếp theo khi change select
 * @param {string} classOfSelect class of tag select
 * @param {string} requestUri 
 */
function fnUpdateNextUrl(classOfSelect, requestUri, attributeAdd){
    $(classOfSelect).find('option').each(function(){        
        $(this).attr('next',updateQueryStringParameter(requestUri, attributeAdd, $(this).val()));
    });  
    // reg event
    $(classOfSelect).change(function(){
        window.location= $('option:selected', this).attr('next');
    });
}

/**
* @param {String} uri
* @param {String} key : is name new attribute
* @param {String} value : is value of new attribute
* @returns {String}             */
// http://stackoverflow.com/questions/5999118/add-or-update-query-string-parameter
function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
  separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}  

function fnBindFixLabelRequired(){
    $('.fix_custom_label_required').each(function(){
        var label = $(this).find('label:first');
        if(label.find('span').size()<1){
            label.append('<span class="required"> *</span>');
        }
    });
}

/**
 * @Author: ANH DUNG Mar 14, 2016
 * @Todo: add one button save to form BE
 */
function fnAddSaveButton() {
    var html = '<div class="row buttons" style="padding-left: 141px;"><button class="btn btn-small" type="submit">Save</button></div>';
    $('.form .row:first').before(html);
    
}
