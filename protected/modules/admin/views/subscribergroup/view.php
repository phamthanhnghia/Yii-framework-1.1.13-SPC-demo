<?php
$this->breadcrumbs=array(
	'Subscriber Groups'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'SubscriberGroup Management', 'url'=>array('index')),
	array('label'=>'Create SubscriberGroup', 'url'=>array('create')),
	array('label'=>'Update SubscriberGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SubscriberGroup', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View SubscriberGroup #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'status:status',
	),
)); ?>
