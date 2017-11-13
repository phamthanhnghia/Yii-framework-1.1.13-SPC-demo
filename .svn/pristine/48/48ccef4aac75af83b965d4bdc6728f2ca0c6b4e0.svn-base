<?php
$this->breadcrumbs=array(
	'SubscriberGroup',
);

$menus=array(
	array('label'=>'Create SubscriberGroup', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subscriber-group-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#subscriber-group-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('subscriber-group-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('subscriber-group-grid');
        }
    });
    return false;
});
");
?>

<h1>List Subscriber Groups</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscriber-group-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		'name',
		array(
            'header'=>'Status',
            'name'=>'status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->status,"id"=>$data->id)',
            ),
		
		array(
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                        'buttons'=>array(
                            'delete'=>array(
                                'visible'=>'count($data->subscriber_group)<1',
                            ),
                        ),                     
		),
	),
)); ?>
