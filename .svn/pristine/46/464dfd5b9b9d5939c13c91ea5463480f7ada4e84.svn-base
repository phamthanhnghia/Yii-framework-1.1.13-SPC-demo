<?php
$this->breadcrumbs=array(
	'QL Quận/Huyện'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'QL Quận/Huyện', 'url'=>array('index')),
	array('label'=>'Tạo Mới Quận/Huyện', 'url'=>array('create')),
	array('label'=>'Cập Nhật Quận/Huyện', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Xóa Quận/Huyện', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem Quận/Huyện: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
            array(
                'name'=>'province_id',
                'value'=>$model->province?$model->province->name:'',
            ),
		'name',
		'short_name',
		'status:status',
	),
)); ?>
