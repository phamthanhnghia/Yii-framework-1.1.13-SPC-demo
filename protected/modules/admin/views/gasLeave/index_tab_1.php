
<div class="search-form search-form1 is_tab" is_tab="1" style="">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'is_tab'=>1,
)); ?>
</div><!-- search-form -->
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form1 form').submit(function(){
        $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
	$.fn.yiiGridView.update('gas-bussiness-contract-grid1', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});        
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#gas-bussiness-contract-grid1 a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-bussiness-contract-grid1', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {        
            $.fn.yiiGridView.update('gas-bussiness-contract-grid1');            
        }
    });
    return false;
});
");


?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-bussiness-contract-grid1',
	'dataProvider'=>$model->searchWaitApproved(),
        'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox(0);}',
        'template'=>'{pager}{summary}{items}{pager}{summary}', 
        'template'=>''
        . '<div class="clr hight_light item_b f_size_18">'.$TextTitleInfo.' Đơn xin nghỉ phép chờ duyệt</div>'
        . '{pager}{summary}{items}{pager}{summary}',     
        'pager' => array(
            'maxButtonCount'=>  CmsFormatter::$PAGE_MAX_BUTTON,
        ),            
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '10px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
                array(
                    'name'=>'c_name',
//                    'type'=>'NameAndRole',
//                    'value'=>'$data->rUidLeave',
                    'htmlOptions' => array('style' => 'width:200px;')
                ),
                array(
                    'header' => 'Ngày Nghỉ',
                    'type'=>'LeaveDate',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center;width:100px;')
                ),
                array(
                    'name'=>'leave_content',
                    'type'=>'html',
                    'value'=>'nl2br($data->leave_content)',
                ),
                            
                array(
                    'name'=>'uid_login',
                    'type'=>'OnlyNameUser',
                    'value'=>'$data->rUidLogin',
                    'htmlOptions' => array('style' => 'width:100px;')
                ),
                array(
                    'name'=>'to_uid_approved',
                    'type'=>'LeaveUserApproved',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'width:100px;')
                ),
                array(
                    'name'=>'status',
                    'type'=>'LeaveStatus',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'width:100px;')
                ),
                            
                array(
                    'name' => 'created_date',
                    'type' => 'Datetime',
                    'htmlOptions' => array('style' => 'width:50px;')
                ),                           
		array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                    'buttons'=>array(
                        'update'=>array(
                            'visible'=> 'GasCheck::AgentCanUpdateLeaveUser($data)',
                        ),
                        'delete'=>array(
                            'visible'=> 'GasCheck::canDeleteData($data)',
                        ),
                    ),                     
		),
	),
)); ?>