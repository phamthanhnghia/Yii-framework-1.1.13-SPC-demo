<?php
$this->breadcrumbs=array(
	'Seos Management'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'Seo Management', 'url'=>array('index')),
	array('label'=>'View Seo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create Seo', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Seo: <?php echo $model->page_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>