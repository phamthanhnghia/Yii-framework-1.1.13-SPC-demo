<?php
$this->breadcrumbs=array(
	 Yii::t('translation','Posts')=>array('index'),
	 Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation','Posts Management'), 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Posts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tags_most_used' => $tags_most_used,'list'=>$list, 'pages'=>$pages,'mesg' => $mesg,)); ?>