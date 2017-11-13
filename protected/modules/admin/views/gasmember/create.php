<?php
$this->breadcrumbs=array(
	Yii::t('translation','Member')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Member') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Tạo Mới Member'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>