<?php
$this->breadcrumbs=array(
	Yii::t('translation','QL Quận/Huyện')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Quận/Huyện'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'Xem Quận/Huyện'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Tạo Mới Quận/Huyện'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Cập Nhật Quận/Huyện: '.$model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>