<?php
$this->breadcrumbs=array(
	$this->pluralTitle=>array('index'),
	'Tạo Mới',
);

$menus = array(		
        array('label'=>"$this->singleTitle Management", 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Tạo Mới <?php echo $this->singleTitle; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>