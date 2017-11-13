<?php
$this->breadcrumbs=array(
	'Quản Lý Ngày Nghỉ Lễ'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Cập Nhật',
);

$menus = array(	
        array('label'=>'Quản Lý Ngày Nghỉ Lễ', 'url'=>array('index')),
	array('label'=>'Xem Ngày Nghỉ Lễ', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Tạo Mới Ngày Nghỉ Lễ', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Cập Nhật Ngày Nghỉ Lễ: <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>