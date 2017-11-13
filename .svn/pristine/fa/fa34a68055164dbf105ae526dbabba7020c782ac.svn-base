<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    ' ' . $model->getName(),
);

$menus = array(
	array('label'=>"$this->pluralTitle Management", 'url'=>array('index')),
	array('label'=>"Tạo Mới $this->singleTitle", 'url'=>array('create')),
	array('label'=>"Cập Nhật {$model->getName()}", 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>"Xóa $this->singleTitle", 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Bạn chắc chắn muốn xóa ?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Xem: <?php echo $model->getName() ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'name'=>"name",
                    'type'=>"html",
                    'value'=> $model->getName(true),
                ),
		'code_real',
                array(
                    'name'=>"category_id",
                    'value'=> $model->getCategory(),
                ),
                array(
                    'name'=>"type",
                    'value'=> $model->getType(),
                ),
                array(
                    'name'=>"price_retail",
                    'value'=> $model->getPriceRetail(),
                ),
                array(
                    'name'=>"unit",
                    'value'=> $model->getUnit(),
                ),
                array(
                    'name'=>"unit_use",
                    'value'=> $model->getUnitUse(),
                ),
                array(
                    'name'=>"size",
                    'value'=> $model->getSize(),
                ),
                array(
                    'name'=>"short_description",
                    'type'=>"html",
                    'value'=> $model->getShortDescription(),
                ),
                array(
                    'name'=>"description",
                    'type'=>"html",
                    'value'=> $model->getDescription(),
                ),
                array(
                    'label'=>"Product Info",
                    'type'=>"html",
                    'value'=> $model->getInfo(),
                ),
                array(
                    'label'=>"How to use",
                    'type'=>"html",
                    'value'=> $model->getHowToUse(),
                ),
                array(
                    'label'=>"Component",
                    'type'=>"html",
                    'value'=> $model->getComponent(),
                ),
                array(
                    'name'=>"status",
                    'value'=> $model->getStatusText(),
                ),
	),
)); ?>

<?php include "view_multi_file.php"; ?>

