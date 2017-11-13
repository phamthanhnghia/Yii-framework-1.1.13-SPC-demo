<?php
$this->breadcrumbs=array(
	'Track Login',
);

$menus=array(
            array('label'=>'Create GasTrackLogin', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gas-track-login-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#gas-track-login-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-track-login-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('gas-track-login-grid');
        }
    });
    return false;
});
");

?>

<h1>List Gas Track Logins</h1>

<?php echo CHtml::link('Tìm Kiếm Nâng Cao','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-track-login-grid',
	'dataProvider'=>$model->search(),
        'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
        'template'=>'{pager}{summary}{items}{pager}{summary}', 
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
            'name'=>'uid_login',
            'htmlOptions' => array('style' => 'width:60px;')
        ),            
        array(
            'name'=>'country',
            'htmlOptions' => array('style' => 'width:60px;')
        ),
        array(
            'name'=>'ip_address',
            'htmlOptions' => array('style' => 'width:80px;')
        ),            
        array(
            'name' => 'type',
            'value' => 'GasTrackLogin::$TYPE_TRACK[$data->type]',
            'htmlOptions' => array('style' => 'width:50px;')
        ),            

        array(
            'name'=>'username',
            'value'=>'$data->rUidLogin?$data->rUidLogin->username:""',
            'htmlOptions' => array('style' => 'width:100px;')
        ),
        array(
            'name'=>'full_name',
            'type'=>'FullNameTrackLogin',
            'value'=>'$data',
//            'value'=>'$data->rUidLogin?$data->rUidLogin->first_name:""',
            'htmlOptions' => array('style' => 'width:150px;')
        ),
        array(
            'name'=>'role_name',
            'type'=>'RoleNameUser',
            'value'=>'$data->rUidLogin?$data->rUidLogin->role_id:""',
            'htmlOptions' => array('style' => 'width:100px;'),
        ),
        array(
            'name' => 'created_date',
            'type' => 'Datetime',
            'htmlOptions' => array('style' => 'width:90px;')
        ),        
        array(
            'name' => 'description',
//            'htmlOptions' => array('style' => 'width:150px;')
        ),

//        array(
//            'header' => 'Actions',
//            'class'=>'CButtonColumn',
//            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
//        ),
	),
)); ?>

<script>
$(document).ready(function() {
    fnUpdateColorbox();
});

function fnUpdateColorbox(){
    fnShowhighLightTr();
//    fixTargetBlank();
}
</script>