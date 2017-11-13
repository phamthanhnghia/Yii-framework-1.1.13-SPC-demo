<?php
$this->breadcrumbs=array(
	'Loggers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Cập Nhật',
);

$menus = array(	
        array('label'=>'Logger Management', 'url'=>array('index')),
	array('label'=>'Xem Logger', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Tạo Mới Logger', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Cập Nhật Logger <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>