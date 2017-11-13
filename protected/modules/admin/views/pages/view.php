<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$menus = array(
    array('label'=>'Index', 'url'=>array('index')),	
	array('label'=>'Update Pages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pages', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Pages <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
        array(
            'name' => 'URL',
            'type' => 'html',
            'value' => CHtml::link(
                                        Yii::app()->createAbsoluteUrl("/site/view_page/slug/".$model->slug),
                                        Yii::app()->createAbsoluteUrl("/site/view_page/slug/".$model->slug),
                                        array("target"=>"_blank")
                                    ),
        ),
        'short_content:html',
        array(
            'name'=>'content',
            'type' => 'html',
            'value'=> $content,
        ),
		array(
			'name'=>'status',
            'value'=>(!empty($model->status) && $model->status==1) ? 'Active' : 'Inactive',
		),
        /*
		array(
            'name'=>'layout_id',
            'value'=> $model->layouts->title,
        ),

		array(
            'name'=>'user_id',
            'value'=> $model->users->email,
        ),
        */
		'meta_keywords',
		'meta_desc',
		array(
            'name'=>'featured_image',
            'value'=> empty($model->featured_image)?"": $model->media->title,
        ),
//		'order',
		'created:datetime',
		'modified:datetime',
//		'slug',
	),
)); ?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".group4").colorbox({rel:'group4', slideshow:true});
    });
</script>