<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Pages Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Pages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tags_most_used' => $tags_most_used)); ?>