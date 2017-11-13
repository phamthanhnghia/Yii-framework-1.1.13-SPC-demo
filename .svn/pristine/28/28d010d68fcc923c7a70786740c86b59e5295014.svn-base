<?php
$this->breadcrumbs=array(
	'Pages',
);

$menus=array(
    array('label'=>Yii::t('translation','Create'), 'url'=>array('create')),

);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pages-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pages-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pages-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pages-grid');
        }
    });
    return false;
});
");
?>

<h1>List Pages</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$visible = ControllerActionsName::checkVisibleButton($actions);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
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
        'title',
        array(
            'header' => 'URL',
            'type' => 'raw',
            'value' => 'CHtml::link(
                                        Yii::app()->createAbsoluteUrl("/site/view_page/slug/".$data->slug),
                                        Yii::app()->createAbsoluteUrl("/site/view_page/slug/".$data->slug),
                                        array("target"=>"_blank")
                                    )',
        ),
        'short_content:html',
        array(
            'header'=>'Created Date',
            'type'=>'datetime',
            'name'=>'created',
            'value'=>'$data->created',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
		array(
            'header'=>'Status',
            'name'=>'status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->status,"id"=>$data->id)',
            'visible'=>$visible,
        ),
		/*
		'post_type',
		'meta_keywords',
		'meta_desc',
		'featured_image',
		'order',
		'created',
		'modified',
		'slug',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view','update','delete')),
		),
	),
)); ?>
