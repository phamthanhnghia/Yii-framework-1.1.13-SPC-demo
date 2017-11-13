<?php
$this->breadcrumbs=array(
	'Subscriber Management'=>array('index'),
	'Create Subscriber',
);

$menus=array(
	array('label'=>'Subscriber Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Subscriber</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>