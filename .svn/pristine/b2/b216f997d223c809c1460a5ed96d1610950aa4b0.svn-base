
<div class="search-form3 search-form-only-css is_tab" is_tab="3" style="">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
        'is_tab'=>3,
)); ?>
</div><!-- search-form -->
<?php
Yii::app()->clientScript->registerScript('search3', "
$('.search-form3 form').submit(function(){
	$.fn.yiiGridView.update('gas-bussiness-contract-grid3', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate3', "
$('#gas-bussiness-contract-grid3 a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-bussiness-contract-grid3', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('gas-bussiness-contract-grid3');
        }
    });
    return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-bussiness-contract-grid3',
	'dataProvider'=>$model->searchRejected(),
        'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox(2);}',
        'template'=>''
        . '<div class="clr hight_light item_b f_size_18">'.$TextTitleInfo.' Đơn không cho phép nghỉ</div>'
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
//                'type'=>'NameAndRole',
//                'value'=>'$data->rUidLeave',
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
                'header'=>'Ngày Duyệt',
                'value'=>'$data',
                'type'=>'LeaveStatusDateApproved',
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
                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view','delete')),
                'buttons'=>array(
                    'delete'=>array(
                        'visible'=> 'GasCheck::canDeleteData($data)',
                    ),
                ),                     
            ),
	),
)); ?>