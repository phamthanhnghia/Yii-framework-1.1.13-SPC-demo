<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'Pages Management', 'url'=>array('index')),
	array('label'=>'View Pages', 'url'=>array('view', 'id'=>$model->id)),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Pages <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tags_most_used' => $tags_most_used)); ?>