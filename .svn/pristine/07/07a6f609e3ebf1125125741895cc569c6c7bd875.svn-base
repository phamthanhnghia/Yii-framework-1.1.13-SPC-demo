<?php
$this->breadcrumbs=array(
	'Admin Accounts',
);

$menus=array(
	array('label'=>'Create Admin Account', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#users-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('users-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('users-grid');
        }
    });
    return false;
});
");
?>

<h1>Admin Accounts</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->searchAdmin(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
//		'id',
		'email',
//		'password',
        array(
            'header' => 'Full Name',
            'type'=>'raw',
            'value'=>'$data->first_name . " " . $data->last_name'
        ),
        array(
            'name' => 'phone',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'name' => 'created_date',
            //'type'=>'date',
            'value'=> '($data->created_date!= "0000-00-00 00:00:00") ? date(ActiveRecord::getDateFormatPhp()." H:i:s" ,strtotime($data->created_date)) : ""',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header'=>'Status',
            'name'=>'status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'(Yii::app()->user->id==$data->id)?$data->status:array("status"=>$data->status,"id"=>$data->id)',
        ),
		array(
			'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                         'buttons'=>array(
                             'delete'=>array('visible'=> 'Yii::app()->user->id!=$data->id')
                       ),                     
					
		),
	),
));

//$this->widget( 'application.modules.auditTrail.widgets.portlets.ShowAuditTrail', array( 'model' => $model, ) );

?>
