<?php
$this->breadcrumbs=array(
	'Controllers',
);

$menus=array(
	array('label'=>'Create Controllers', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('controllers-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>List Controllers</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'controllers-grid',
	'dataProvider'=>$model->search(),
	'template'=>'{pager}{summary}{items}{pager}{summary}', 
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),		
		array(
			'class'=>'CButtonColumn',
//                        'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view', 'edit')),
                        'template'=>'{view}{edit}{delete}',
                        'buttons'=>array
                        (
                            'edit' => array
                            (
                                'label'=>'Edit',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/admin/images/icon/update_icon.png',
                                'url'=>'Yii::app()->createUrl("admin/controllers/edit", array("id"=>$data->id))',
                            ),                            
                        ),
		),
		
		'controller_name',
		'module_name',
                'actions',
	),
)); ?>
