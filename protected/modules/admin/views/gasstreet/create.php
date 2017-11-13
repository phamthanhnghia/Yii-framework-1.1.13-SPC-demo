<?php
$this->breadcrumbs=array(
	Yii::t('translation','QL Tên Đường')=>array('index'),
	Yii::t('translation','Tạo Mới Đường'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'QL Tên Đường') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Tạo Mới Đường'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>