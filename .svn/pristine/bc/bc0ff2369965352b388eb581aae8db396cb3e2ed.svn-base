<?php
$this->breadcrumbs=array(
	 Yii::t('translation','Posts'),
);

$menus=array(
	array('label'=> Yii::t('translation','Create Posts'), 'url'=>array('create')),
);



$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('posts-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#posts-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('posts-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('posts-grid');
        }
    });
    return false;
});
");
?>



<h1>List Posts</h1>

<?php echo CHtml::link( Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'posts-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
			
		Yii::t('translation','title'),
        /*
        array(
            'name'  => Yii::t('translation','content'),
            'type'=>'html',
            'value'=>'$data->content',
        ),
        */
		array(
            'name'  => Yii::t('translation','status'),
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->status,"id" =>$data->id)',
        ),
		array('name'=> Yii::t('translation','user_id'),
			  'htmlOptions' => array('style' => 'text-align:center;'),
			  'value'=>'Users::model()->getInforUser($data->user_id,"username")',
			),

		array(
			'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
