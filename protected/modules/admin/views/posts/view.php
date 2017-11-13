<?php
$this->breadcrumbs=array(
	 Yii::t('translation','Posts')=>array('index'),
	$model->title,
);

$menus = array(
	array('label'=> Yii::t('translation','Post Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation','Create Posts'), 'url'=>array('create')),
	array('label'=> Yii::t('translation','Update Posts'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=> Yii::t('translation','Delete Posts'), 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Posts [ <?php echo $model->title; ?> ]</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        Yii::t('translation','title'),
        Yii::t('translation','slug'),
        array(
            'name'=>'content',
            'type' => 'html',
            'value'=> $content,
        ),
		array(
            'name'  => Yii::t('translation','status'),
            'type'=>'status',
        ),
//		Yii::t('translation','layout_id'),
// 		'user_id',
		array(
            'name'  => Yii::t('translation','user_id'),
            'value' =>Users::model()->getInforUser($model->user_id,'username'),
        ),
        Yii::t('translation','title_tag'),
        Yii::t('translation','meta_keywords'),
        Yii::t('translation','meta_desc'),
        Yii::t('translation','featured_image'),
//        Yii::t('translation','order'),
        array(
            'name'=> Yii::t('translation','created'),
            'type'=>empty($model->created) || ($model->created == "0000-00-00 00:00:00")?"raw":"datetime",
            'value'=>empty($model->created) || ($model->created == "0000-00-00 00:00:00")?"":$model->created,
        ),
        array(
            'name'=> Yii::t('translation','modified'),
            'type'=>empty($model->modified) || ($model->modified == "0000-00-00 00:00:00")?"raw":"datetime",
            'value'=>empty($model->modified) || ($model->modified == "0000-00-00 00:00:00")?"":$model->modified,
        ),
	),
)); ?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".group4").colorbox({rel:'group4', slideshow:true});
    });
</script>
