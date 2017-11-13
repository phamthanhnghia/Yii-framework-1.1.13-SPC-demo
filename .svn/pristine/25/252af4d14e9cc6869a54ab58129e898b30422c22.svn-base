<?php
$this->breadcrumbs=array(
	'Quản Lý Ngày Nghỉ Lễ'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Quản Lý Ngày Nghỉ Lễ', 'url'=>array('index')),
	array('label'=>'Tạo Mới Ngày Nghỉ Lễ', 'url'=>array('create')),
	array('label'=>'Cập Nhật Ngày Nghỉ Lễ', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Xóa Ngày Nghỉ Lễ', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Bạn chắc chắn muốn xóa ?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem Ngày Nghỉ Lễ: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'date:date',
	),
)); ?>
