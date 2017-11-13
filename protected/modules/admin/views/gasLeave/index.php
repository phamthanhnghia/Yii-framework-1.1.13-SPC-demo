<?php
$this->breadcrumbs=array(
	'Quản Lý Nghỉ Phép',
);

$menus=array(
            array('label'=>'Tạo Mới Nghỉ Phép', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$TextTitleInfo='';
?>

<h1>Quản Lý Nghỉ Phép</h1>

<div class="search-form search-form0 is_tab BindChangeSearchCondition" is_tab="0" style="">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'is_tab'=>0,
)); ?>
</div><!-- search-form -->

<?php include 'index_tab.php';?>

    
<script type="text/javascript">
$(document).ready(function() {
    $(".operations > .create > a").colorbox({iframe:true,
        innerHeight:'700', 
        innerWidth: '1100', overlayClose :false, escKey:false,close: "<span title='close'>close</span>"
    });
    
    fnUpdateColorbox(1);
    fnBindChangeSearchCondition();
});

//http://www.jacklmoore.com/colorbox/
function fnUpdateColorbox(CurrentTab){
    fixTargetBlank();
    fnShowhighLightTr();
    $(" .update").colorbox({iframe:true,
        innerHeight:'700', 
        innerWidth: '1100', overlayClose :false, escKey:false,close: "<span title='close'>close</span>"
    });
    $(" .view").colorbox({iframe:true,
        overlayClose :false, escKey:false,
        innerHeight:'1200', 
        innerWidth: '1100', close: "<span title='close'>close</span>"
    });
    
    if(CurrentTab==getSelectedTabIndex())
        $.unblockUI();
}

function fnBindChangeSearchCondition(){
    $('.BindChangeSearchCondition input, .BindChangeSearchCondition select').change(function(){
        var class_update_val = $(this).attr('class_update_val');
        var ValUpdate = $(this).val();
        $('.'+class_update_val).val(ValUpdate);        
    });
    
    $('.SubmitButton').click(function(){
        
//        var div_search = $(this).closest('div.is_tab');
//        var CurrentTab = div_search.attr('is_tab');
        var CurrentTab = getSelectedTabIndex();
        var tab1 = 0;
        var tab2 = 0;
        if(CurrentTab==0){
            tab1 = 2;
            tab2 = 3;
        }else if(CurrentTab==1){
            tab1 = 1;
            tab2 = 3;            
        }else if(CurrentTab==2){
            tab1 = 1;
            tab2 = 2;            
        }
        CurrentTab++;
        $('.search-form'+CurrentTab+' form').submit();
        $('.search-form'+tab1+' form').submit();
        $('.search-form'+tab2+' form').submit();
    });    
}


    function getSelectedTabIndex() { 
        return $("#tabs").tabs('option', 'selected');
    }

    function fnAfterSelectSaleOrAgent(user_id, idField, idFieldCustomer){
        fnAddValueUidToInput(user_id, idField, idFieldCustomer);
    }

    function fnAddValueUidToInput(user_id, idField, idFieldCustomer){
        var parent_div = $(idFieldCustomer).closest('div.row');
        var ClassToUpdate = parent_div.find('.uid_auto_hidden').attr('class_update_val');
        $('.'+ClassToUpdate).val(user_id);
    }
    function fnRemoveValueUidFromInput(this_, idField, idFieldCustomer){
        var parent_div = $(idFieldCustomer).closest('div.row');
        var ClassToUpdate = parent_div.find('.uid_auto_hidden').attr('class_update_val');
        $('.'+ClassToUpdate).val('');
    }
    function fnAfterRemove(this_, idField, idFieldCustomer){
        fnRemoveValueUidFromInput(this_, idField, idFieldCustomer);
    }

</script>
