<?php
$this->breadcrumbs=array(
	Yii::t('translation','QL Quận/Huyện')=>array('index'),
	Yii::t('translation','Tạo Mới'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Ql Quận/Huyện') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Tạo Mới Quận/Huyện'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>