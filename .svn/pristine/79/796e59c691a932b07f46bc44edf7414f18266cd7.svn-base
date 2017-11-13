<?php
$this->breadcrumbs=array(
	'QL Tỉnh',
);

$menus=array(
	array('label'=> Yii::t('translation','Create GasProvince'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gas-province-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#gas-province-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-province-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('gas-province-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'QL Tỉnh'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-province-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
    'template'=>'{pager}{summary}{items}{pager}{summary}',     
	//'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'id',                       
            'htmlOptions' => array('style' => 'text-align:center;')
        ),	           
		 Yii::t('translation','name'),
		 Yii::t('translation','short_name'),
//		 Yii::t('translation','status'),
		array(
			'header' => 'Action',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
