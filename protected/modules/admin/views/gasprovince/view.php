<?php
$this->breadcrumbs=array(
	'Gas Provinces'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'GasProvince Management', 'url'=>array('index')),
	array('label'=>'Create GasProvince', 'url'=>array('create')),
	array('label'=>'Update GasProvince', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GasProvince', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View GasProvince #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'name',
		'short_name',
		'status:status',
	),
)); ?>
