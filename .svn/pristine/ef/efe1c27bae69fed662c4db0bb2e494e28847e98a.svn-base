<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    ' ' . $this->singleTitle . ' : ',
);

$menus = array(
	array('label'=>"$this->pluralTitle Management", 'url'=>array('index')),
	array('label'=>"Tạo Mới $this->singleTitle", 'url'=>array('create')),
	array('label'=>"Cập Nhật $this->singleTitle", 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>"Xóa $this->singleTitle", 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Bạn chắc chắn muốn xóa ?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem: <?php echo $this->singleTitle; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'name',
		'description',
		'file_name',
		'link',
		'status',
		'order_display',
		'created_date',
	),
)); ?>
