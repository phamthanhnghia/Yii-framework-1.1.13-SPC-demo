<?php
$this->breadcrumbs=array(
	Yii::t('translation','QL Phường Xã')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Cập Nhật'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'QL Phường Xã'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'Xem Phường Xã'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Tạo Mới Phường Xã'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Cập Nhật Phường Xã: '.$model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>