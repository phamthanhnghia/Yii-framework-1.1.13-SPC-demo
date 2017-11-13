<?php
$this->breadcrumbs=array(
	'Subscriber Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'SubscriberGroup Management', 'url'=>array('index')),
	array('label'=>'View SubscriberGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create SubscriberGroup', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update SubscriberGroup <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>