<?php
$this->breadcrumbs=array(
	'Loggers'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'Logger Management', 'url'=>array('index')),
	array('label'=>'Tạo Mới Logger', 'url'=>array('create')),
	array('label'=>'Cập Nhật Logger', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Xóa Logger', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Bạn chắc chắn muốn xóa ?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem Logger #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ip_address',
		'country',
		'level',
		'category',
		'logtime',
		'message',
		'created_date',
		'description',
	),
)); ?>
