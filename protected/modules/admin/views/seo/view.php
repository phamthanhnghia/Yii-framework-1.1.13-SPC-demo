<?php
$this->breadcrumbs=array(
	'Seos Management'=>array('index'),
	$model->title,
);

$menus = array(
        array('label'=>'Seo Management', 'url'=>array('index')),
	array('label'=>'Create Seo', 'url'=>array('create')),
	array('label'=>'Update Seo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Seo', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Seo #<?php echo $model->page_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'module',
		'controller',
		'action',
                'title',
		'sample_link',
		'page_name',
		'variable',
		'keyword',
		'description',
),
)); ?>