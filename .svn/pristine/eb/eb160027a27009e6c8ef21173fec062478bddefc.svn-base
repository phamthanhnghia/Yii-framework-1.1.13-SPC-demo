<?php
$this->breadcrumbs=array(
	Yii::t('translation','QL Tên Đường')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Cập Nhật'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'QL Tên Đường'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'Xem Tên Đường'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Tạo Mới Tên Đường'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Cập Nhật Tên Đường: '.$model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>