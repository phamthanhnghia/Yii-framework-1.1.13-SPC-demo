<?php
$this->breadcrumbs=array(
	'Gas Track Logins'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'GasTrackLogin Management', 'url'=>array('index')),
	array('label'=>'Tạo Mới GasTrackLogin', 'url'=>array('create')),
	array('label'=>'Cập Nhật GasTrackLogin', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Xóa GasTrackLogin', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Bạn chắc chắn muốn xóa ?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem GasTrackLogin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid_login',
		'ip_address',
		'country',
		'description',
		'created_date',
	),
)); ?>
