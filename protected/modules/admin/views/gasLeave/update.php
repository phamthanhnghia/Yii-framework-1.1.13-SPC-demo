<?php
$this->breadcrumbs=array(
	'Quản Lý Nghỉ Phép'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Cập Nhật',
);

$menus = array(	
        array('label'=>'Quản Lý Nghỉ Phép', 'url'=>array('index')),
	array('label'=>'Xem Nghỉ Phép', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Tạo Mới Nghỉ Phép', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Cập Nhật Nghỉ Phép</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>