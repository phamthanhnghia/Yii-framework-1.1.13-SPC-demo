<?php
$this->breadcrumbs=array(
	Yii::t('translation','Đại Lý')=>array('index'),
	$model->first_name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Đại Lý'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Đại Lý'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Đại Lý'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Cập nhật Đại Lý: '.$model->first_name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>