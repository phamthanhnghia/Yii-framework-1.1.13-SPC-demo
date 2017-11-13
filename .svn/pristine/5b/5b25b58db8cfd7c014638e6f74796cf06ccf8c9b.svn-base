<?php
$this->breadcrumbs=array(
	'QL Phường Xã'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'QL Phường Xã', 'url'=>array('index')),
	array('label'=>'Tạo Mới Phường Xã', 'url'=>array('create')),
	array('label'=>'Cập Nhật Phường Xã', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Xóa Phường Xã', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem Phường Xã: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            array(
                'name'=>'province_id',
                'value'=>$model->province?$model->province->name:'',
            ),    
            array(
                'name'=>'district_id',
                'value'=>$model->district?$model->district->name:'',
            ),                
		'name',
		'name_vi',
	),
)); ?>
