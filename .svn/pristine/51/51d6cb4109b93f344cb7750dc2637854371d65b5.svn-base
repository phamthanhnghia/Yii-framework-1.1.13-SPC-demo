<?php
$this->breadcrumbs=array(
	'Quản Lý Ngày Nghỉ Lễ',
);

$menus=array(
            array('label'=>'Quản Lý Ngày Nghỉ Lễ', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gas-leave-holidays-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#gas-leave-holidays-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-leave-holidays-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('gas-leave-holidays-grid');
        }
    });
    return false;
});
");
?>

<h1>Quản Lý Ngày Nghỉ Lễ</h1>

<?php echo CHtml::link('Tìm Kiếm Nâng Cao','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-leave-holidays-grid',
	'dataProvider'=>$model->search(),
        'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
        'template'=>'{pager}{summary}{items}{pager}{summary}', 
        'pager' => array(
            'maxButtonCount'=>  CmsFormatter::$PAGE_MAX_BUTTON,
        ),            
	'enableSorting' => false,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '10px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		'name',
                array(
                    'name'=>'date',
                    'type'=>'date',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),    
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>

<script>
$(document).ready(function() {
    fnUpdateColorbox();
});

function fnUpdateColorbox(){   
    fixTargetBlank();
}
</script>