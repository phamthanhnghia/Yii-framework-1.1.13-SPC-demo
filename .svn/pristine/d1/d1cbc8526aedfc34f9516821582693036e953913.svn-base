<?php
$this->breadcrumbs=array(
	'Gas Track Logins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Cập Nhật',
);

$menus = array(	
        array('label'=>'GasTrackLogin Management', 'url'=>array('index')),
	array('label'=>'Xem GasTrackLogin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Tạo Mới GasTrackLogin', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Cập Nhật GasTrackLogin <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>