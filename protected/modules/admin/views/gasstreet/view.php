<?php
$this->breadcrumbs=array(
	'QL Tên Đường'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'QL Tên Đường', 'url'=>array('index')),
	array('label'=>'Tạo Mới Tên Đường', 'url'=>array('create')),
	array('label'=>'Cập Nhật Tên Đường', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'XóaTên Đường', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem Tên Đường: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
           /*  array(
                'name'=>'province_id',
                'value'=>$model->province?$model->province->name:'',
            ), */            
		'name',
		'name_vi',
	),
)); ?>
