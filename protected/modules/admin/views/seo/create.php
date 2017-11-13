<?php
$this->breadcrumbs=array(
	'Seos'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Seo Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Seo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>