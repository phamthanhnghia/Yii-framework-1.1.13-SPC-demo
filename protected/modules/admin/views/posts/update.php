<?php
$this->breadcrumbs=array(
	 Yii::t('translation','Posts')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	 Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation','Posts Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation','View Posts'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation','Create Posts'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo  Yii::t('translation','Update Posts')?> [ <?php echo $model->title; ?> ]</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tags_most_used' => $tags_most_used, 
        'mesg' => $mesg, 'list'=>$list, 'pages'=>$pages,)); ?>