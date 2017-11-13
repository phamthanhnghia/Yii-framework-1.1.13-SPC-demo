<?php
$this->breadcrumbs=array(
	Yii::t('translation','Member')=>array('index'),
	$model->code_account." - ".$model->first_name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Member'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Member'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Member'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', "Cập nhật Member: $model->code_account - ".$model->first_name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>